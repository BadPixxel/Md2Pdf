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

namespace BadPixxel\Md2Pdf\Models\PdfDocument;

trait TemplatesTrait
{
    /**
     * Base Twig Template for Pdf Rendering
     *
     * @var string
     */
    private string $base = "base.pdf.twig";

    /**
     * Styles Template for Pdf Rendering
     *
     * @var string
     */
    private string $styles = "Styles/default.html.twig";

    /**
     * Pages Header
     *
     * @var array{ 'options': null|scalar[], 'template': ?string }
     */
    private array $header = array("template" => null, "options" => array());

    /**
     * Pages Cover
     *
     * @var array{ 'options': null|scalar[], 'template': ?string }
     */
    private array $cover = array("template" => null, "options" => array());

    /**
     * Pages Footer
     *
     * @var array{ 'options': null|scalar[], 'template': ?string }
     */
    private array $footer = array("template" => null, "options" => array());

    /**
     * @return string
     */
    public function getBase(): string
    {
        return $this->base;
    }

    /**
     * @param string $base
     *
     * @return self
     */
    public function setBase(string $base): self
    {
        $this->base = $base;

        return $this;
    }
    /**
     * @return string
     */
    public function getStyles(): string
    {
        return $this->styles;
    }

    /**
     * @param string $styles
     *
     * @return self
     */
    public function setStyles(string $styles): self
    {
        $this->styles = $styles;

        return $this;
    }

    /**
     * Get Header Page Template
     *
     * @return string
     */
    public function getHeaderTemplate(): string
    {
        return $this->header["template"] ?? "";
    }

    /**
     * Get Header Page Options
     *
     * @return array<string, scalar>
     */
    public function getHeaderOptions(): array
    {
        return $this->header["options"] ?? array();
    }

    /**
     * Set Header template with Options
     *
     * @param string $template
     * @param array  $options
     *
     * @return self
     */
    public function setHeader(string $template, array $options = array()): self
    {
        $this->header = array(
            "template" => $template,
            "options" => $options
        );

        return $this;
    }

    /**
     * Get Cover Page Template
     *
     * @return string
     */
    public function getCoverTemplate(): string
    {
        return $this->cover["template"] ?? "";
    }

    /**
     * Get Cover Page Options
     *
     * @return array<string, scalar>
     */
    public function getCoverOptions(): array
    {
        return $this->cover["options"] ?? array();
    }

    /**
     * Set Cover template with Options
     *
     * @param string $template
     * @param array  $options
     *
     * @return self
     */
    public function setCover(string $template, array $options = array()): self
    {
        $this->cover = array(
            "template" => $template,
            "options" => $options
        );

        return $this;
    }

    /**
     * Get Footer Page Template
     *
     * @return string
     */
    public function getFooterTemplate(): string
    {
        return $this->footer["template"] ?? "";
    }

    /**
     * Get Footer Page Options
     *
     * @return array<string, scalar>
     */
    public function getFooterOptions(): array
    {
        return $this->footer["options"] ?? array();
    }

    /**
     * Set Footer template with Options
     *
     * @param string $template
     * @param array  $options
     *
     * @return self
     */
    public function setFooter(string $template, array $options = array()): self
    {
        $this->footer = array(
            "template" => $template,
            "options" => $options
        );

        return $this;
    }
}
