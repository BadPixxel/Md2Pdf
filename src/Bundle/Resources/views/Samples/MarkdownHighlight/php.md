## Language: Php 

```php
// Render Document
$pdfBuilder = new DomPdfBuilder(TwigRenderer::getStatic());
$pdfBuilder->build($document)->stream($document->getName(), array(
    'Attachment' => false,
));
```
