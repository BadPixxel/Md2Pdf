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

use BadPixxel\Md2Pdf\Models\AbstractPdfDocument;
use Dompdf\Dompdf;

class DomPdfBuilder
{
    /**
     * @var TwigRenderer
     */
    private TwigRenderer $renderer;

    /**
     * Service Constructor.
     *
     * @param TwigRenderer $twigRenderer
     */
    public function __construct(TwigRenderer $twigRenderer)
    {
        $this->renderer = $twigRenderer;
    }

    /**
     * Generate Pdf Document as DomPdf instance.
     *
     * @param AbstractPdfDocument $document
     * @param array               $data
     *
     * @return Dompdf
     */
    public function build(AbstractPdfDocument $document, array $data = array())
    {
        //====================================================================//
        // Retrieve the Raw Pdf HTML
        $html = $this->renderer->render($document, $data);
        //====================================================================//
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($document->getDomPdfOptions());
        //====================================================================//
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        //====================================================================//
        // Render the HTML as PDF
        $dompdf->render();
        //====================================================================//
        // Return DomPdf Instance
        return $dompdf;
    }
}
