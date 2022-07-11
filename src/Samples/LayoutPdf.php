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
 * Layout Demo Document
 */
class LayoutPdf extends EmptyPdf
{
    /**
     * Pdf Constructor
     */
    public function __construct()
    {
        parent::__construct();
        //====================================================================//
        // Set-up Styles
        $this->setStyles("Samples/Layout/highlights.css.twig");
        //====================================================================//
        // Set-up Header / Footer
        $this->setHeader("Samples/Layout/header.html.twig");
        $this->setFooter("Samples/Layout/footer.html.twig");

        //====================================================================//
        // Set-up Pdf Metadata
        $this->setTitle("Layout Démo");
        $this->setSubtitle("Exemple of Layout from Markdown");
        //====================================================================//
        // Set-up Pdf Cover
        $this->setCover("Samples/Layout/cover.md");
        //====================================================================//
        // Set-up Pdf Contents
        //====================================================================//
        $this->addColumns();
        $this->addContent("Layouts/page_break.md.twig", array());
        $this->addMedias();
        $this->addFixedBlock();

        //====================================================================//
        // Set-up PDF Fake Data
        $faker = $this->getFaker();
        $this->setSettings(array(
            "title" => $faker->realText(20),
            "subtitle" => $faker->realText(50),
        ));
    }

    /**
     * Pdf Constructor
     */
    public function addColumns(): void
    {
        //====================================================================//
        // Adresses Layout
        $this->addContent("Layouts/h2.md.twig", array(
            "title" => "Address: Layouts/address.html.twig",
        ));
        $this->addContent("Layouts/address.html.twig", array(
            "leftTemplate" => "Samples/Invoice/address.md.twig",
            "leftClass" => "column",
            "rightTemplate" => "Samples/Invoice/address.md.twig",
            "rightClass" => "column",
        ));
        //====================================================================//
        // 2 Columns Layout
        $this->addContent("Layouts/h2.md.twig", array(
            "title" => "Two Columns: Layouts/2-columns.html.twig",
        ));
        $this->addContent("Layouts/2-columns.html.twig", array(
            "leftTemplate" => "Samples/Layout/sample_block.md.twig",
            "leftClass" => "column",
            "rightContents" => "**This Is a Test**
                 <br />This Is a Test
                 <br />This Is a Test",
            "rightClass" => "column",
        ));
        //====================================================================//
        // 3 Columns Layout
        $this->addContent("Layouts/h2.md.twig", array(
            "title" => "Three Columns: Layouts/3-columns.html.twig",
        ));
        $this->addContent("Layouts/3-columns.html.twig", array(
            "leftTemplate" => "Samples/Layout/sample_block.md.twig",
            "leftClass" => "column",
            "centerTemplate" => "Samples/Layout/sample_block.md.twig",
            "centerClass" => "column",
            "rightTemplate" => "Samples/Layout/sample_block.md.twig",
            "rightClass" => "column",
        ));
    }

    /**
     * Pdf Constructor
     */
    public function addMedias(): void
    {
        //====================================================================//
        // Media Left Layout
        $this->addContent("Layouts/h2.md.twig", array(
            "title" => "Media on Left: Layouts/media-left.html.twig",
        ));
        $this->addContent("Layouts/media-left.html.twig", array(
            "leftContents" => "### My Media<br />",
            "leftClass" => "column",
            "rightTemplate" => "Samples/Layout/sample_block.md.twig",
            "rightClass" => "column",
        ));
        //====================================================================//
        // Media Right Layout
        $this->addContent("Layouts/h2.md.twig", array(
            "title" => "Media on Left: Layouts/media-right.html.twig",
        ));
        $this->addContent("Layouts/media-right.html.twig", array(
            "leftTemplate" => "Samples/Layout/sample_block.md.twig",
            "leftClass" => "column",
            "rightContents" => "### My Media<br />",
            "rightClass" => "column",
        ));
    }

    /**
     * Pdf Constructor
     */
    public function addFixedBlock(): void
    {
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
