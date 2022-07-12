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
 * Markdown Highlight Syntax Demo Document
 */
class MarkdownHighlighterPdf extends EmptyPdf
{
    /**
     * Pdf Constructor
     */
    public function __construct()
    {
        parent::__construct();
        //====================================================================//
        // Set-up Pdf Metadata
        $this->setTitle("Markdown Highlight");
        $this->setSubtitle("Markdown Code Highlight Demo");
        //====================================================================//
        // Set-up Pdf Contents
        $this->addContent("Samples/MarkdownHighlight/intro.md");
        $this->addContent("Samples/MarkdownHighlight/bash.md");
        $this->addContent("Samples/MarkdownHighlight/php.md");
        $this->addContent("Samples/MarkdownHighlight/json.md");
        $this->addContent("Samples/MarkdownHighlight/xml.md");
        $this->addContent("Samples/MarkdownHighlight/others.md");
    }
}
