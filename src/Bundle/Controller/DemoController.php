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

namespace BadPixxel\Md2Pdf\Bundle\Controller;

use BadPixxel\Md2Pdf\Models\AbstractPdfDocument;
use BadPixxel\Md2Pdf\Services\DomPdfBuilder;
use BadPixxel\Md2Pdf\Services\TwigRenderer;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Md2Pdf Bundle Demonstration Pages Controller
 */
class DemoController extends AbstractController
{
    const CLASS_PREFIX = "\\BadPixxel\\Md2Pdf\\Samples\\";

    /**
     * @throws Exception
     *
     * @return Response
     */
    public function indexAction() : Response
    {
        return $this->render('@Md2Pdf/Demo/index.html.twig', array());
    }

    /**
     * @param string $pdfClass
     *
     * @return Response
     */
    public function htmlAction(string $pdfClass, TwigRenderer $renderer) : Response
    {
        $document = $this->getDocument($pdfClass);
        $renderer->render($document, array());

        return $this->render('@Md2Pdf/Demo/html.html.twig', array(
            'pdfClass' => $pdfClass,
            'document' => $document,
            'mdDocument' => $document->getMdDocument(),
        ));
    }

    /**
     * @param string       $pdfClass
     * @param TwigRenderer $renderer
     *
     * @return Response
     */
    public function htmlRenderAction(string $pdfClass, TwigRenderer $renderer) : Response
    {
        return new Response(
            $renderer->render($this->getDocument($pdfClass), array())
        );
    }

    /**
     * @param string $pdfClass
     *
     * @return Response
     */
    public function pdfAction(TwigRenderer $renderer, string $pdfClass) : Response
    {
        $document = $this->getDocument($pdfClass);
        $renderer->render($document, array());

        return $this->render('@Md2Pdf/Demo/pdf.html.twig', array(
            'pdfClass' => $pdfClass,
            'document' => $document,
            'mdDocument' => $document->getMdDocument(),
        ));
    }

    /**
     * @param string        $pdfClass
     * @param DomPdfBuilder $builder
     *
     * @return Response
     */
    public function pdfRenderAction(string $pdfClass, DomPdfBuilder $builder) : Response
    {
        $document = $this->getDocument($pdfClass);

        $builder->build($document)->stream($document->getName(), array(
            'Attachment' => false,
        ));

        return new Response("OK");
    }

    /**
     * Load Pdf Document Class
     *
     * @param string $pdfClass
     *
     * @return AbstractPdfDocument
     */
    private function getDocument(string $pdfClass) : AbstractPdfDocument
    {
        $docClass = self::CLASS_PREFIX.$pdfClass;
        //==============================================================================
        // Safety Checks
        if (!class_exists($docClass)) {
            throw $this->createNotFoundException($docClass);
        }
        $document = new $docClass();
        if (!($document instanceof AbstractPdfDocument)) {
            throw $this->createNotFoundException($docClass);
        }

        return $document;
    }
}
