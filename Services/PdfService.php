<?php

namespace Catalogue\Services;

use Catalogue\Model\CataloguePdfConfigQuery;
use Catalogue\Model\CataloguePdfDocumentQuery;
use Thelia\Core\Event\Document\DocumentEvent;
use Thelia\Core\Event\TheliaEvents;
/**
 * Class PdfService
 *
 * @package TracabilitePP\Services
 * @author  François  Carfantan <f.carfantan@orange.fr>
 */
class PdfService
{
    public function getDocumentUrl(){
        $configId = CataloguePdfConfigQuery::create()
            ->select('id')
            ->findOne();
        // $document = CataloguePdfDocumentQuery::create()
        //     ->findOneByConfigId($configId);
        //     $pdfEvent = new DocumentEvent();
        //     $pdfEvent->setSourceFilepath($document->getUploadDir() . DS . $document->getFile());
        //     $pdfEvent->dispatcher->dispatch(TheliaEvents::DOCUMENT_PROCESS, $pdfEvent);
        // return $pdfEvent->getFileUrl();
        return "toto";
    }
}
