<?php

declare(strict_types=1);

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

namespace BadPixxel\Md2Pdf\CommonMarkdown\Extension\HiglightExtension\Renderer\Block;

use Exception;
use Highlight\Highlighter;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

/**
 * Raw Code Blocks Highlighter
 *
 * @see https://github.com/scrivo/highlight.php
 */
final class HighlightedCodeRenderer implements NodeRendererInterface
{
    /**
     * @param FencedCode $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        FencedCode::assertInstanceOf($node);
        $attrs = $node->data->getData('attributes');

        try {
            //==============================================================================
            // Instantiate the Highlighter.
            $highlighter = new Highlighter();
            $highlighter->getTabReplace();
            //==============================================================================
            // Highlight Code.
            $infoWords = $node->getInfoWords();
            if (1 === \count($infoWords) && '' !== $infoWords[0]) {
                $highlighted = $highlighter->highlight($infoWords[0], $node->getLiteral());
            } elseif (\count($infoWords) > 1 && '' !== $infoWords[0]) {
                $highlighter->setAutodetectLanguages($infoWords);
                $highlighted = $highlighter->highlightAuto($node->getLiteral());
            } else {
                $highlighter->setAutodetectLanguages(array('python', 'perl', 'php', 'bash', 'js'));
                $highlighted = $highlighter->highlightAuto($node->getLiteral());
            }
            $attrs->set('class', 'hljs language-'.$highlighted->language);
            /** @var array<string, string> $attributes */
            $attributes = $attrs->export();
            //==============================================================================
            // Render Highlighted Code.
            return new HtmlElement('pre', array(), new HtmlElement(
                'code',
                $attributes,
                $highlighted->value,
            ));
        } catch (Exception $e) {
            /** @var array<string, string> $attributes */
            $attributes = $attrs->export();
            //==============================================================================
            // This is thrown if the specified language does not exist
            return new HtmlElement('pre', array(), new HtmlElement(
                'code',
                $attributes,
                htmlentities($node->getLiteral())
            ));
        }
    }
}
