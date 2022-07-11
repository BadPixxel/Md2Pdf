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

trait ContentsTrait
{
    /**
     * @var array<int|string, array<string, scalar[]|string>>
     */
    private array $contents = array();

    /**
     * @return array<int|string, array<string, scalar[]|string>>
     */
    public function getContents(): array
    {
        return $this->contents;
    }

    /**
     * @param string $template
     * @param array  $options
     *
     * @return self
     */
    public function addContent(string $template, array $options = array()): self
    {
        $this->contents[] = array(
            "template" => $template,
            "options" => $options
        );

        return $this;
    }
}
