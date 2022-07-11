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

use BadPixxel\Md2Pdf\Models\AbstractPdfDocument;
use BadPixxel\Md2Pdf\Services\DomPdfBuilder;
use BadPixxel\Md2Pdf\Services\TwigRenderer;

require_once __DIR__.'/vendor/autoload.php';

//==============================================================================
// Detect Document Name
$prefix = "\\BadPixxel\\Md2Pdf\\Samples\\";
$document = $docClass = null;
foreach ($_SERVER['argv'] as $arg) {
    $expl = explode("=", $arg);
    $docClass = (2 == count($expl)) ? $expl[1] : $expl[0];
    if (class_exists($prefix.$docClass)) {
        $docClass = $prefix.$docClass;
        $document = new $docClass();

        break;
    }
    if (class_exists($docClass)) {
        $document = new $docClass();

        break;
    }
}

//==============================================================================
// Check Document Class
if (!$document instanceof AbstractPdfDocument) {
    throw new Exception(sprintf(
        "Document must be a %s, %s given",
        AbstractPdfDocument::class,
        $docClass
    ));
}

//==============================================================================
// Render Document
$pdfBuilder = new DomPdfBuilder(TwigRenderer::getStatic());
$pdfBuilder->build($document)->stream($document->getName(), array(
    'Attachment' => false,
));
