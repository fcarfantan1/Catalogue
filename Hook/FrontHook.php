<?php
namespace Catalogue\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Catalogue\Model\Config\CataloguePdfConfigValue;
use Catalogue\Catalogue;


/**
 * Class FrontHook
 * @package Catalogue\Hook
 * @author François Carfantan <f.carfantan@orange.fr>
 */
class FrontHook extends BaseHook {

    
    public function onMainNavbarCatalogue(HookRenderEvent $event){
   $catalogConfigId = Catalogue::getConfigValue(CataloguePdfConfigValue::CATALOGUE_FOLDER_ID);
   $event->add($this->render("catalogue.html"));
    //    $html='<li><a href="';
    //    $html=$html.'catalogue/pdf';
    //    $html=$html.'">Télécharger notre catalogue</a></li>';
    //    $event->add($html);
    }

    

}
?>
