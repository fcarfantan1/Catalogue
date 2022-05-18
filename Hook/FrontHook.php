<?php
namespace Catalogue\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Catalogue\Model\Config\CataloguePdfConfigValue;
use Catalogue\Catalogue;
use Catalogue\Model\CataloguePdfConfigQuery;
use Catalogue\Model\CataloguePdfDocumentQuery;
use Thelia\Core\Event\Document\DocumentEvent;
use Thelia\Core\Event\TheliaEvents;

/**
 * Class FrontHook
 * @package Catalogue\Hook
 * @author François Carfantan <f.carfantan@orange.fr>
 */
class FrontHook extends BaseHook {

    
    public function onMainNavbarCatalogue(HookRenderEvent $event){

        $htmlContent = sprintf('<li><a href="%s">Télécharger notre catalogue</a></li>',$this->getPdf());
        $event->add($htmlContent);
    }
    public function getPdf(){
        $configId = CataloguePdfConfigQuery::create()
            ->select('id')
            ->findOne();
        $document = CataloguePdfDocumentQuery::create()
            ->findOneByConfigId($configId);
            $pdfEvent = new DocumentEvent();
            $pdfEvent->setSourceFilepath($document->getUploadDir() . DS . $document->getFile())
            ->setCacheSubdirectory('catalogue');
            $this->dispatcher->dispatch(TheliaEvents::DOCUMENT_PROCESS, $pdfEvent);
        return $pdfEvent->getDocumentUrl();
    }
    

}
?>
