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

use BadPixxel\Md2Pdf\Services\MarkdownRenderer;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Node\Block\Document;

/**
 * Access to Markdown Converter
 */
trait MarkdownConverterTrait
{
    use MarkdownOptionsTrait;

    /**
     * @var null|MarkdownConverter
     */
    private ?MarkdownConverter $markdownRenderer;

    /**
     * @var null|Document
     */
    private ?Document $mdDocument = null;

    //==============================================================================
    // MAIN METHODS
    //==============================================================================

    /**
     * Convert RAW Markdown Contents to Html
     *
     * To get Contents Metadata, uses getMdContents()
     *
     * @return string
     */
    public function convertMd2Html(string $mdContents): string
    {
        $mdContents = $this->getMarkdownConverter()->convert($mdContents);

//        dump($this->getMarkdownConverter());
//        exit;

        $this->mdDocument = $mdContents->getDocument();

        return $mdContents->getContent();
    }

    /**
     * Get Last Generated Markdown Document Metadata
     *
     * @return null|Document
     */
    public function getMdDocument(): ?Document
    {
        return $this->mdDocument;
    }

    //==============================================================================
    // BUILD RENDERER
    //==============================================================================

    /**
     * Get a Markdown Converter Configured for this Document
     *
     * @return MarkdownConverter
     */
    public function getMarkdownConverter(): MarkdownConverter
    {
        $this->markdownRenderer = $this->markdownRenderer ?? MarkdownRenderer::getInstance(
            $this->getMarkdownOptions()
        );

        return $this->markdownRenderer;
    }
}
