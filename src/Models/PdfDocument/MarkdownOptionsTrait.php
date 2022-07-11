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

/**
 * Storage & Configuration of Markdown Converter
 */
trait MarkdownOptionsTrait
{
    /**
     * Common Options for Markdown Converter
     *
     * @var array<string, scalar>
     */
    private array $commonOptions = array(
        'html_input' => 'allow'
    );

    /**
     * Common Options for Default Attributes Extension
     *
     * @var array<string, scalar>
     */
    private array $attributesOptions = array(
    );

    /**
     * Common Options for Tables Extension
     *
     * @var array<string, array|scalar>
     */
    private array $tablesOptions = array(
        'wrap' => array(
            'enabled' => true,
            'tag' => 'div',
            'attributes' => array('class' => 'table-center table-bordered'),
        ),
    );

    /**
     * Common Options for Heading Permalink Extension
     *
     * @var array<string, scalar>
     */
    private array $headingPermalinkOptions = array(
        'html_class' => 'permalink',
        'symbol' => " ",
        'aria_hidden' => true,
    );

    /**
     * Common Options for Table of Contents Extension
     *
     * @var array<string, scalar>
     */
    private array $tocOptions = array(
        'position' => 'placeholder',
        'placeholder' => '[TableOfContents]',
        'normalize' => 'as-is',
        'style' => 'ordered',
        'max_heading_level' => 3,
    );

    //==============================================================================
    // OPTION SETTERS
    //==============================================================================

    /**
     * Common Options for Markdown Converter.
     *
     * @param array $options
     *
     * @return self
     */
    public function setMdCommonOptions(array $options): self
    {
        $this->commonOptions = array_replace_recursive($this->commonOptions, $options);

        return $this;
    }

    /**
     * Common Options for Attributes Extension.
     *
     * @param array $options
     *
     * @return self
     */
    public function setMdDefaultAttributesOptions(array $options): self
    {
        $this->attributesOptions = array_replace_recursive($this->attributesOptions, $options);

        return $this;
    }

    /**
     * Common Options for Tables Extension.
     *
     * @param array $options
     *
     * @return self
     */
    public function setMdTablesOptions(array $options): self
    {
        $this->tablesOptions = array_replace_recursive($this->tablesOptions, $options);

        return $this;
    }

    /**
     * Common Options for Heading Permalink Extension.
     *
     * @param array $options
     *
     * @return self
     */
    public function setMdHeadingPermalinkOptions(array $options): self
    {
        $this->headingPermalinkOptions = array_replace_recursive($this->headingPermalinkOptions, $options);

        return $this;
    }

    /**
     * Common Options for Table of Contents Extension.
     *
     * @param array $options
     *
     * @return self
     */
    public function setMdTableOfContentsOptions(array $options): self
    {
        $this->tocOptions = array_replace_recursive($this->tocOptions, $options);

        return $this;
    }

    //==============================================================================
    // OPTIONS ARRAY BUILDER
    //==============================================================================

    /**
     * Generate Markdown Converter Options.
     *
     * @return array
     */
    private function getMarkdownOptions(): array
    {
        return array_replace_recursive(
            $this->commonOptions,
            array('table' => $this->tablesOptions),
            array('default_attributes' => $this->attributesOptions),
            array('heading_permalink' => $this->headingPermalinkOptions),
            array('table_of_contents' => $this->tocOptions),
        );
    }
}
