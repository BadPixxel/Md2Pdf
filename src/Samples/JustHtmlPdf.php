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

namespace BadPixxel\Md2Pdf\Samples;

/**
 * Sample Pdf with Html Contents Only
 */
class JustHtmlPdf extends EmptyPdf
{
    /**
     * Pdf Constructor
     */
    public function __construct()
    {
        parent::__construct();
        //====================================================================//
        // Set-up Pdf Metadata
        $this->setTitle("Just Html PDF");
        $this->setSubtitle("No Markdown, Just HTML Contents");
        //====================================================================//
        // Set-up Pdf Contents
        $this->addContent("Samples/JustHtml/contents.html.twig");
    }

    /**
     * Generate File Licence
     *
     * @return string
     */
    public function buildLicence(): string
    {
        $licence = "<span style='color: red;'>DEMO</span>";
        $licence .= "&nbsp;|&nbsp;This is a Licence!";

        return $licence;
    }
}
