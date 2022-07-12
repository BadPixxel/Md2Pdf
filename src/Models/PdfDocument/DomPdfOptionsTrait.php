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

use Dompdf\Options;

trait DomPdfOptionsTrait
{
    /**
     * Options Override for Dom Pdf
     *
     * @var array<string, bool|int|string>
     */
    private array $domPdfOptions = array(
        'paperSize' => 'A4',
        'paperOrientation' => 'portrait',
        'defaultFont' => 'DejaVu Sans',
        'isRemoteEnabled' => false,
        'isJavascriptEnabled' => false,
    );

    /**
     * Define Default CSS Variables for Dom Pdf Styles
     * Convert var(--primary-color) to #A1B2C3
     *
     * @var array<string, string>
     */
    private array $domPdfCssVariables = array(
        "primary-color" => "#e00e21",
        "secondary-color" => "#013f55",
        "danger-color" => "#f00114",
        "warning-color" => "#e3c702",
        "info-color" => "#d6522d",
        "success-color" => "#029a50",
        "light-color" => "#d1d9d5",
        "white-color" => "#ffffff",
        "dark-color" => "#000000",
    );

    /**
     * Generate Dom Pdf Options.
     *
     * @return Options
     */
    public function getDomPdfOptions(): Options
    {
        $pdfOptions = new Options();
        $options = $this->domPdfOptions;
        //====================================================================//
        // Setup DomPdf Fonts
        $pdfOptions->setFontCache(sys_get_temp_dir());
        $pdfOptions->setFontDir(sys_get_temp_dir());
        //====================================================================//
        // Setup Root Path for Files
        if (!empty($options["projectPath"]) && is_string($options["projectPath"])) {
            $pdfOptions->setChroot($options["projectPath"]);
            unset($options["projectPath"]);
        }
        //====================================================================//
        // Setup Paper Size
        if (!empty($options["paperSize"]) && is_string($options["paperSize"])) {
            if (!empty($options["paperOrientation"]) && is_string($options["paperOrientation"])) {
                $pdfOptions->setDefaultPaperSize($options["paperSize"]);
                $pdfOptions->setDefaultPaperOrientation($options["paperOrientation"]);
                unset($options["paperSize"], $options["paperOrientation"]);
            }
        }
        //====================================================================//
        // Setup DomPdf Options
        foreach ($this->domPdfOptions as $key => $value) {
            $pdfOptions->set($key, $value);
        }

        return $pdfOptions;
    }

    /**
     * Set Dom Pdf Options.
     *
     * @param array $options
     *
     * @return self
     */
    public function setDomPdfOptions(array $options): self
    {
        $this->domPdfOptions = array_replace_recursive($this->domPdfOptions, $options);

        return $this;
    }

    /**
     * Get Default Css Variables for Dom Pdf CSS.
     *
     * @return array<string, string>
     */
    public function getDomPdfCssVariables(): array
    {
        return $this->domPdfCssVariables;
    }

    /**
     * Set Default Css Variables for Dom Pdf CSS.
     *
     * @param array<string, string> $replacements
     *
     * @return self
     */
    public function setDomPdfCssVariables(array $replacements): self
    {
        $this->domPdfCssVariables = array_replace_recursive($this->domPdfCssVariables, $replacements);

        return $this;
    }
}
