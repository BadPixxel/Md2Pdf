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

namespace BadPixxel\Md2Pdf\Models;

use BadPixxel\Md2Pdf\Models\PdfDocument\ContentsTrait;
use BadPixxel\Md2Pdf\Models\PdfDocument\DomPdfOptionsTrait;
use BadPixxel\Md2Pdf\Models\PdfDocument\MarkdownConverterTrait;
use BadPixxel\Md2Pdf\Models\PdfDocument\MetadataTrait;
use BadPixxel\Md2Pdf\Models\PdfDocument\SettingsTrait;
use BadPixxel\Md2Pdf\Models\PdfDocument\TemplatesTrait;
use BadPixxel\Md2Pdf\Models\PdfDocument\TwigOptionsTrait;

/**
 * Base Class for Building Pdf Documents
 */
abstract class AbstractPdfDocument
{
    use ContentsTrait;
    use TemplatesTrait;
    use SettingsTrait;
    use MetadataTrait;
    use TwigOptionsTrait;
    use MarkdownConverterTrait;
    use DomPdfOptionsTrait;
}
