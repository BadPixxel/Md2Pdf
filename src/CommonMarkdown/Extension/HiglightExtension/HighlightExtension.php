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

namespace BadPixxel\Md2Pdf\CommonMarkdown\Extension\HiglightExtension;

use BadPixxel\Md2Pdf\CommonMarkdown\Extension\HiglightExtension\Renderer\Block\HighlightedCodeRenderer;
use function HighlightUtilities\getStyleSheet;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\ExtensionInterface;

/**
 * Raw Code Blocks Highlight Extension
 *
 * @see https://github.com/scrivo/highlight.php
 */
class HighlightExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment
            ->addRenderer(FencedCode::class, new HighlightedCodeRenderer(), 10)
        ;
    }

    /**
     * Load Highlighter Css from Vendor Files
     *
     * @param string $theme
     *
     * @return string
     */
    public static function getHighlightStyles(string $theme): string
    {
        try {
            return (string) getStyleSheet($theme);
        } catch (\Throwable $ex) {
            try {
                return (string) getStyleSheet("atom-one-dark");
            } catch (\Throwable $ex) {
                return "";
            }
        }
    }
}
