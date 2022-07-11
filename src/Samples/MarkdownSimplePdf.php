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
 * Markdown Simple Syntax Demo Document
 */
class MarkdownSimplePdf extends EmptyPdf
{
    /**
     * Pdf Constructor
     */
    public function __construct()
    {
        parent::__construct();
        //====================================================================//
        // Set-up Pdf Metadata
        $this->setTitle("Only Simple Markdown");
        $this->setSubtitle("Simple Markdown with Basic Syntax");
        //====================================================================//
        // Set-up Pdf Contents
        $this->addContent("Samples/MarkdownSimple/contents.md");
        //====================================================================//
        // Set-up DomPdf Options
        $this->setDomPdfOptions(array(
            'isRemoteEnabled' => true
        ));
    }
}
