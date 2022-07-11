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

use BadPixxel\Md2Pdf\Models\Styles\SplashSyncStyle;

/**
 * Markdown Invoice Demo Document
 */
class SplashInvoicePdf extends EmptyPdf
{
    /**
     * Pdf Constructor
     */
    public function __construct()
    {
        parent::__construct();

        //====================================================================//
        // Set-up SplashSync Pdf
        SplashSyncStyle::setupStyles($this);

        //====================================================================//
        // Set-up Pdf Metadata
        $this->setTitle("Splash Invoice");
        $this->setSubtitle("Markdown Pdf with Tables");
        //====================================================================//
        // Set-up Pdf Contents
        $this->addContent("Samples/Invoice/top.html.twig");
        $this->addContent("Layouts/address.html.twig", array(
            "leftTemplate" => "Samples/Invoice/address.md.twig",
            "rightTemplate" => "Samples/Invoice/address.md.twig",
        ));
        $this->addContent("Samples/Invoice/table.html.twig");

        //====================================================================//
        // Invoice Totals
        $this->addContent("Layouts/2-columns.html.twig", array(
            "leftContents" => "&nbsp;",
            "rightTemplate" => "Samples/Invoice/totals.md.twig",
            "rightClass" => "spl-invoice-totals",
        ));

        //====================================================================//
        // Bottom Fixed Block
        $this->addContent("Layouts/fixed.bottom.html.twig", array(
            "template" => "Samples/Layout/sample_block.md.twig",
            "divClass" => "column",
            "description" => "Bottom Fixed Block",
            "max" => 500
        ));
    }
}
