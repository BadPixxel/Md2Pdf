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

namespace BadPixxel\Md2Pdf\Services;

use BadPixxel\Md2Pdf\CommonMarkdown\Extension\FontawesomeParser\FontawesomeParser;
use BadPixxel\Md2Pdf\CommonMarkdown\Extension\HiglightExtension\HighlightExtension;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\MarkdownConverter;

class MarkdownRenderer
{
    /**
     * Service Constructor
     *
     * @param array $config
     *
     * @return MarkdownConverter
     */
    public static function getInstance(array $config = array()): MarkdownConverter
    {
        //==============================================================================
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment($config);

        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new AttributesExtension());
        $environment->addExtension(new DefaultAttributesExtension());
        $environment->addExtension(new StrikethroughExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new HeadingPermalinkExtension());
        $environment->addExtension(new FrontMatterExtension());
        $environment->addExtension(new TableOfContentsExtension());
        $environment->addExtension(new HighlightExtension());

        $environment->addInlineParser(new FontawesomeParser());
        //==============================================================================
        // Instantiate the converter engine and start converting some Markdown!
        return new MarkdownConverter($environment);
    }
}
