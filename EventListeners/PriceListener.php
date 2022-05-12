<?php


namespace Catalogue\EventListeners;

use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Propel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


/**
 * Class HookFetesListener
 * @package HookFetes
 * @author FrançoisCarfantan <f.carfantan@orange.fr>
 */
class PriceListener implements EventSubscriberInterface
{
    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            CataloguePriceEvents::UPDATE => 'update_price';
        ];
    }
}
