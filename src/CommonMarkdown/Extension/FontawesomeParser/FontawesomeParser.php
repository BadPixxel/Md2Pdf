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

namespace BadPixxel\Md2Pdf\CommonMarkdown\Extension\FontawesomeParser;

use League\CommonMark\Extension\CommonMark\Node\Inline\HtmlInline;
use League\CommonMark\Parser\Inline\InlineParserInterface;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;

class FontawesomeParser implements InlineParserInterface
{
    /**
     * @return InlineParserMatch
     */
    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::oneOf('@fa:', '@fas:', '@far:', '@fal:', '@fad:', '@fab:');
    }

    /**
     * @param InlineParserContext $inlineContext
     *
     * @return bool
     */
    public function parse(InlineParserContext $inlineContext): bool
    {
        $cursor = $inlineContext->getCursor();
        //==============================================================================
        // Decode FA Tag
        $tag = (string) strtok($cursor->getRemainder(), " ");
        $definition = explode(':', $tag);
        //==============================================================================
        // Advance the cursor past the 2 matched chars since we're able to parse them successfully
        $cursor->advanceBy(strlen($tag));
        //==============================================================================
        // Build FA Icon Html Element
        $inlineContext->getContainer()->appendChild(
            new HtmlInline(self::build(
                $definition[0],
                $definition[1] ?? "",
                $definition[2] ?? ""
            ))
        );

        return true;
    }

    /**
     * Build FA Icon Html Element
     *
     * @param string      $type
     * @param string      $code
     * @param null|string $options
     *
     * @return string
     */
    private static function build(string $type, string $code, ?string $options): string
    {
        if (!$code) {
            return "";
        }

        return sprintf(
            '<i class="%s fa-%s %s"></i>',
            substr($type, 1),
            $code,
            implode(" ", explode(",", (string) $options))
        );
    }
}
