<?php
namespace Catalogue\Hook;
use Thelia\Core\Event\Hook\HookRenderBlockEvent;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Tools\URL;


/**
 * Class CatalogHook
 * @package Test\Hook
 * @author François Carfantan <f.carfantan@orange.fr>
 */
class BackHook extends BaseHook {

    public function onMainTopMenuTools(HookRenderBlockEvent $event)
    {
          $event->add(
            [
                'id' => 'tools_menu_catalogue_pdf',
                'class' => '',
                'url' =>  URL::getInstance()->absoluteUrl('admin/module/catalogue/pdf'),
                'title'=> 'Catalogue Clients'
            ]
        );
    }

    

}
?>
