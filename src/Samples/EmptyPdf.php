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

use BadPixxel\Md2Pdf\Models\AbstractPdfDocument;
use Faker;

/**
 * Empty Demo Document
 */
class EmptyPdf extends AbstractPdfDocument
{
    /**
     * Pdf Constructor
     */
    public function __construct()
    {
        //====================================================================//
        // Set-up Pdf Metadata
        $this->setTitle("Empty PDF");
        $this->setLogo(dirname(__DIR__, 2)."/src/Bundle/Resources/public/img/sample-logo.png");
        //====================================================================//
        // Set-up Pdf Header
        $this->setHeader("Blocks/Default/header.html.twig");
        //====================================================================//
        // Set-up Pdf Footer
        $this->setLicence($this->buildLicence());
        $this->setFooter("Blocks/Default/footer.html.twig");

        $this->setDomPdfOptions(array(
            'projectPath' => dirname(__DIR__, 2)."/src/Bundle/Resources/public"
        ));
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

    /**
     * Generate File Licence
     *
     * @return Faker\Generator
     */
    public function getFaker(): Faker\Generator
    {
        return Faker\Factory::create();
    }
}
