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
 * Markdown Tables Demo Document
 */
class MarkdownTablesPdf extends EmptyPdf
{
    /**
     * Pdf Constructor
     */
    public function __construct()
    {
        parent::__construct();
        //====================================================================//
        // Set-up Pdf Metadata
        $this->setTitle("Markdown Tables");
        $this->setSubtitle("Markdown Pdf with Tables");
        //====================================================================//
        // Set-up Pdf Contents
        $this->addContent("Samples/MarkdownTables/intro.md");
        $this->addContent("Samples/MarkdownTables/simple.md");
        $this->addContent("Samples/MarkdownTables/advanced.md");
        //====================================================================//
        // Set-up DomPdf Options
        $this->setDomPdfOptions(array(
            'isRemoteEnabled' => true
        ));
    }
}
