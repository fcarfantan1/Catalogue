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

        $htmlContent = sprintf('<li><a href="%s">Catalogue %s</a></li>',$this->getPdf()['url'],$this->getPdf()['year']);
        $event->add($htmlContent);
    }
    public function getPdf(){
        $catalogue = new Catalogue();
        $configId = CataloguePdfConfigQuery::create()
            ->select('id')
            ->findOne();
        $document = CataloguePdfDocumentQuery::create()
            ->findOneByConfigId($configId);
            $pdfEvent = new DocumentEvent();
            if($document!=null){
                $pdfEvent->setSourceFilepath($catalogue->getDocumentUploadDir() . DS . $document->getFile())
                ->setCacheSubdirectory('catalogue');
                $this->dispatcher->dispatch(TheliaEvents::DOCUMENT_PROCESS, $pdfEvent);
            return ['url'=>$pdfEvent->getDocumentUrl(),'year'=>$document->getPublicationYear()];
            }
           return null;
    }
    

}
?>
