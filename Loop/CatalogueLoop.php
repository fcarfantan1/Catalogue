<?php

namespace Catalogue\Loop;

use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\BaseI18nLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Element\ArraySearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Event\TheliaEvents;
use Catalogue\Model\CataloguePdfConfigQuery;
use Catalogue\Model\CataloguePdfConfig;
use Catalogue\Catalogue;
use Thelia\Core\Event\Document\DocumentEvent;
use Thelia\Core\Event\Image\ImageEvent;
use Thelia\Log\Tlog;

class CatalogueLoop extends BaseI18nLoop implements PropelSearchLoopInterface
{
    public function buildModelCriteria()
    {
        $search = CataloguePdfConfigQuery::create();
        $this->configureI18nProcessing($search, ['TITLE', 'SUBTITLE', "TITRE_DATE_DEBUT", 'ADRESSE_VOIE', 'TEXTE_SITE']);
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
            $loopResultRow->set("RESPONSABLE_NOM", $cataloguePdfconfig->getResponsableNom());
            $loopResultRow->set("RESPONSABLE_PRENOM", $cataloguePdfconfig->getResponsablePrenom());
            $loopResultRow->set("TITLE", $cataloguePdfconfig->getVirtualColumn('i18n_TITLE'));
            $loopResultRow->set("SUBTITLE", $cataloguePdfconfig->getVirtualColumn('i18n_SUBTITLE'));
            $loopResultRow->set("TEL_MOBILE", $cataloguePdfconfig->getTelMobile());
            $loopResultRow->set("TEL_FIXE", $cataloguePdfconfig->getTelFixe());
            $loopResultRow->set("TEXTE_INTRO", $cataloguePdfconfig->getVirtualColumn('i18n_TEXTE_SITE'));
            $loopResultRow->set("ADRESSE_VOIE", $cataloguePdfconfig->getVirtualColumn('i18n_ADRESSE_VOIE'));
            $loopResultRow->set("ADRESSE_VOIE_NUMERO", $cataloguePdfconfig->getAdresseVoieNumero());
            $loopResultRow->set("ADRESSE_CODEPOSTAL", $cataloguePdfconfig->getAdresseCodePostal());
            $loopResultRow->set("ADRESSE_COMMUNE", $cataloguePdfconfig->getAdresseCommune());
            $loopResultRow->set("ORIGINAL_IMAGE_URL", $event->getFileUrl());
            $loopResultRow->set("IMAGE_URL", $event->getFileUrl());
            $loopResultRow->set("CATALOGUE_URL_SITE", Catalogue::getConfigValue('url_site'));
            $loopResultRow->set("TITRE_DATE_DEBUT", $cataloguePdfconfig->getVirtualColumn('i18n_TITRE_DATE_DEBUT'));
            $loopResultRow->set("SIRET", $cataloguePdfconfig->getSiret());
            $loopResult->addRow($loopResultRow);
        }
        return $loopResult;
    }
}
