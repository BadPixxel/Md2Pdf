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

namespace BadPixxel\Md2Pdf\Models\Styles;

use BadPixxel\Md2Pdf\Models\AbstractPdfDocument;

/**
 * Styles Helper for BadPixxel Documents
 */
class BadPixxelStyle
{
    /**
     * @var array<string, string>
     */
    private static array $cssColors = array(
        "primary-color" => "Gold",
        "secondary-color" => "Black",
        "danger-color" => "#f00114",
        "warning-color" => "#e3c702",
        "info-color" => "#d6522d",
        "success-color" => "#029a50",
        "light-color" => "Black",
        "white-color" => "#ffffff",
        "dark-color" => "White",
    );

    /**
     * @param AbstractPdfDocument $document
     *
     * @return void
     */
    public static function setupStyles(AbstractPdfDocument $document): void
    {
        $document->setDomPdfCssVariables(self::$cssColors);
    }
}
