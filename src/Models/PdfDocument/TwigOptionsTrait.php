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

use BadPixxel\Md2Pdf\CommonMarkdown\Extension\HiglightExtension\HighlightExtension;

trait TwigOptionsTrait
{
    /**
     * Get All Options for Twig Rendering
     *
     * @return array
     */
    public function getTwigOptions(): array
    {
        return array_merge_recursive(
            $this->getMetaTwigOptions(),
            array(
                "document" => $this,
                "useFontawesome" => $this->isUseFontawesome(),
            )
        );
    }

    /**
     * @return array
     */
    public function getMetaTwigOptions(): array
    {
        return array(
            "name" => $this->getname(),
            "title" => $this->getTitle(),
            "subtitle" => $this->getSubtitle(),
            "licence" => $this->getLicence(),
            "description" => $this->getDescription(),
            "logo" => $this->getLogo(),
            "hljsCss" => HighlightExtension::getHighlightStyles(
                $this->getHighlightTheme()
            ),
        );
    }
}
