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
 * Splash Sync Style Report Demo Document
 */
class SplashSyncReportPdf extends EmptyPdf
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

        $faker = $this->getFaker();
        //====================================================================//
        // Set-up Pdf Metadata
        $this->setTitle("Splash Sync Sample Report");
        $this->setSubtitle("Just a Sample Report with Splash Sync Styles");
        //====================================================================//
        // Set-up Pdf Cover
        $this->setCover("Blocks/cover.md.twig", array(
            "introduction" => $faker->realText(500),
            "author" => "**Author:** ".$faker->name,
            "version" => "**Version:** V".$faker->randomDigitNotNull.".".$faker->randomDigitNotNull,
            "disclaimer" => $faker->realText(300),
        ));
        //====================================================================//
        // Set-up Pdf Contents
        $this->addContent("Blocks/tableOfContents.md.twig", array(
            "title" => "Table of Contents",
            "only" => true
        ));
        $this->addContent("Samples/Report/contents.md.twig");

        //====================================================================//
        // Set-up PDF Fake Data
        $this->setSettings(array(
            //            "title" => $faker->realText(20),
            //            "subtitle" => ,
        ));
    }
}
