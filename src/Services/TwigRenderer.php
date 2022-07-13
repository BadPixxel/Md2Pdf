<?php

/*
 *  Copyright (C) BadPixxel <www.badpixxel.com>
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace BadPixxel\Md2Pdf\Services;

use BadPixxel\Md2Pdf\Models\AbstractPdfDocument;
use Exception;
use Twig\Environment;
use Twig\Extra\Markdown\DefaultMarkdown;
use Twig\Extra\Markdown\MarkdownExtension;
use Twig\Extra\Markdown\MarkdownRuntime;
use Twig\Loader\ChainLoader;
use Twig\Loader\FilesystemLoader;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

/**
 *
 */
class TwigRenderer
{
    /**
     * @var Environment
     */
    private Environment $twig;

    /**
     * Service Constructor
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
        $this->ensureTwigLocalPath();
    }

    /**
     * Get Local Static Instance
     *
     * @param null|string $templatePath
     * @param array       $options
     *
     * @throws Exception
     *
     * @return TwigRenderer
     */
    public static function getStatic(string $templatePath = null, array $options = array()): self
    {
        $templatePath = $templatePath ?? dirname(__DIR__, 2)."/src/Bundle/Resources/views";
        //==============================================================================
        // Safety Checks
        if (!is_dir($templatePath)) {
            throw new Exception(sprintf("Template Path %s is not a directory.", $templatePath));
        }
        //==============================================================================
        // Create Loader
        $loader = new ChainLoader(array(
            new FilesystemLoader($templatePath)));
        //==============================================================================
        // Create Engine
        $twig = new Environment($loader, array_replace_recursive(
            array(
                'cache' => sys_get_temp_dir().'/twig/cache',
                'debug' => true,
                'auto_reload' => true
            ),
            $options
        ));
        $twig->addExtension(new MarkdownExtension());
        $twig->addRuntimeLoader(new class implements RuntimeLoaderInterface {
            public function load(string $class)
            {
                if (MarkdownRuntime::class === $class) {
                    return new MarkdownRuntime(new DefaultMarkdown());
                }

                return null;
            }
        });

        return new self($twig);
    }

    /**
     * Render a Template
     *
     * @param AbstractPdfDocument $document
     * @param array               $data
     *
     * @return string
     */
    public function render(AbstractPdfDocument $document, array $data = array()): string
    {
        //==============================================================================
        // Merge All Options
        $data = array_replace_recursive(
            $document->getTwigOptions(),
            $document->setSettings($data)->getSettings()
        );
        //==============================================================================
        // Render All Pdf Parts
        $pdfData = array_replace_recursive(
            array(
                // Pdf Document Styles CSS
                "part_styles" => $this->replaceCssVariables(
                    $this->renderPart($document->getStyles(), $data),
                    $document->getDomPdfCssVariables()
                ),
                // Pdf Document Header
                "part_header" => $this->renderPart(
                    $document->getHeaderTemplate(),
                    array_replace_recursive($data, $document->getHeaderOptions())
                ),
                // Pdf Document Footer
                "part_footer" => $this->renderPart(
                    $document->getFooterTemplate(),
                    array_replace_recursive($data, $document->getFooterOptions())
                ),
                // Pdf Document Cover Contents
                "part_cover" => $document->convertMd2Html(
                    $this->renderPart(
                        $document->getCoverTemplate(),
                        array_replace_recursive($data, $document->getCoverOptions())
                    )
                ),
                // Pdf Document Main Contents
                "part_contents" => $document->convertMd2Html(
                    $this->renderParts($document->getContents(), $data)
                ),
            ),
            $data
        );

        //==============================================================================
        // Render Whole Pdf as Html
        return $this->renderPart($document->getBase(), $pdfData);
    }

    /**
     * Render Multiple Templates
     *
     * @param array $contents
     * @param array $data
     *
     * @return string
     */
    private function renderParts(array $contents, array $data = array()): string
    {
        $rawContents = "";
        foreach ($contents as $content) {
            $options = ($content['options']["only"] ?? false)
                ? $content['options'] ?? array()
                : array_replace_recursive($data, $content['options'] ?? array())
            ;

            $rawContents .= $this->renderPart(
                $content['template'] ?? "",
                $options
            );
        }

        return $rawContents;
    }

    /**
     * Render a Template to Raw Html or Markdown
     *
     * @param null|string $template
     * @param array       $data
     *
     * @return string
     */
    private function renderPart(?string $template, array $data = array()): string
    {
        //==============================================================================
        // Detect Empty Part
        if (empty($template)) {
            return "";
        }
        //==============================================================================
        // Safety Check
        if (!$this->twig->getLoader()->exists($template)) {
            return "Not Found: ".$template;
        }

        try {
            $extension = pathinfo($template, PATHINFO_EXTENSION);
            //==============================================================================
            // Render Twig Templates
            if ("twig" == $extension) {
                return $this->twig->render($template, $data);
            }
            //==============================================================================
            // Load Raw Md Files
            if ("md" == $extension) {
                return (string) file_get_contents(
                    $this->twig->load($template)->getSourceContext()->getPath()
                );
            }

            return $this->twig->render($template, $data);
        } catch (Exception $e) {
            return "Failed to render ".$template.": ".$e->getMessage();
        }
    }

    /**
     * Replace CSS Variables
     *
     * @param string                $rawCssContents
     * @param array<string, string> $replacements
     *
     * @return string
     */
    private function replaceCssVariables(string $rawCssContents, array $replacements = array()): string
    {
        foreach ($replacements as $key => $value) {
            $rawCssContents = str_replace(
                sprintf("var(--%s)", $key),
                $value,
                $rawCssContents
            );
        }

        return $rawCssContents;
    }

    /**
     * Ensure Bundle Local Views Path are Registered in Twig
     */
    private function ensureTwigLocalPath(): void
    {
        $path = dirname(__DIR__, 2)."/src/Bundle/Resources/views";
        /** @var ChainLoader|FilesystemLoader $loaders */
        $loaders = $this->twig->getLoader();
        if ($loaders instanceof FilesystemLoader) {
            if (!in_array($path, $loaders->getPaths(), true)) {
                $loaders->addPath($path);
            }

            return;
        }
        foreach ($loaders->getLoaders() as $loader) {
            if ($loader instanceof FilesystemLoader) {
                if (!in_array($path, $loader->getPaths(), true)) {
                    $loader->addPath($path);
                }
            }
        }
    }
}
