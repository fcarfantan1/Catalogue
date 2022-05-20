<?php

namespace Catalogue\Loop;

use Thelia\Core\Template\Element\BaseI18nLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Core\Event\TheliaEvents;
use Catalogue\Model\CataloguePdfConfigQuery;
use Catalogue\Catalogue;
use Thelia\Core\Event\Image\ImageEvent;


class CatalogueLoop extends BaseI18nLoop implements PropelSearchLoopInterface
{
    public function buildModelCriteria()
    {
        $search = CataloguePdfConfigQuery::create();
        $this->configureI18nProcessing($search, ['TITLE']);
        return $search;
    }
    public function getArgDefinitions()
    {
        return new ArgumentCollection();
    }
    public function parseResults(LoopResult $loopResult)
    {
        foreach ($loopResult->getResultDataCollection() as $cataloguePdfconfig) {
            $loopResultRow = new LoopResultRow();
            $loopResultRow->set("LOCALE", "fr_FR");
            $event = new ImageEvent();
            $event->setSourceFilepath($cataloguePdfconfig->getUploadDir() . DS . $cataloguePdfconfig->getFile())
                ->setCacheSubdirectory('catalogue');
            $this->dispatcher->dispatch(TheliaEvents::IMAGE_PROCESS, $event);
            $loopResultRow->set("ID", $cataloguePdfconfig->getId());
            $loopResultRow->set("TITLE", $cataloguePdfconfig->getVirtualColumn('i18n_TITLE'));
            $loopResultRow->set("IMAGE_URL", $event->getFileUrl());
            $loopResult->addRow($loopResultRow);
        }
        return $loopResult;
    }
}
