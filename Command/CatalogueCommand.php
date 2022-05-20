<?php

namespace Catalogue\Command;

use Catalogue\Model\CataloguePdfConfigQuery;
use Catalogue\Model\Map\CataloguePdfConfigTableMap;
use Catalogue\Model\CataloguePdfDocumentQuery;
use Catalogue\Services\PdfService;
use Doctrine\Common\Collections\Criteria;
use PDO;
use Propel\Runtime\Propel;
use Thelia\Model\ModuleImageQuery;
use Thelia\Core\Event\Image\ImageEvent;
use Thelia\Core\Event\TheliaEvents;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TracabilitePP\Model\TracabiliteQuery;
use Thelia\Command\ContainerAwareCommand;
use Thelia\Core\Event\Document\DocumentEvent;
use Thelia\Model\Map\ProductI18nTableMap;
use Thelia\Model\Map\ProductTableMap;


class CatalogueCommand extends ContainerAwareCommand
{

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }
    protected function configure()
    {
        $this
            ->setName("catalogue:identifiant")
            ->setDescription("catalogue");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id= CataloguePdfConfigQuery::create()
        ->select(CataloguePdfConfigTableMap::ID)
        ->findOne();
       $output->writeln($this->getDocumentUrl());
    }
    public function getDocumentUrl(){
        $configId = CataloguePdfConfigQuery::create()
            ->select('id')
            ->findOne();
        $document = CataloguePdfDocumentQuery::create()
            ->findOneByConfigId($configId);
            $pdfEvent = new DocumentEvent();
            $pdfEvent->setSourceFilepath($document->getUploadDir() . DS . $document->getFile());
            $this->getContainer()->dispatcher->dispatch(TheliaEvents::DOCUMENT_PROCESS, $pdfEvent);
        return $pdfEvent->getFileUrl();
    }
   
}
