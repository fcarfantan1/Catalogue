<?php

namespace Catalogue\Events;
use Propel\Runtime\Util\PropelDateTime;
use Thelia\Log\Tlog;
class CatalogueUpdateEvent extends HookFetesEvent
{
protected $title;
    protected $price_id;
    protected $tarif_id;
    protected $conditionnment_id;
    protected $value;

    
    public function __construct($price_id)
    {
        Tlog::getInstance()->addDebug("FCA : ".$price_id);
        parent::__construct();
        $this->price_id=$price_id;
    }

    public function setPriceId($p)
    {
        $this->price_id=$p;
    }
    public function getPriceId()
    {

        return $this->price_id;
    }

    /**
     * Get the [description] column value.
     *
     * @return   int
     */
    public function setConditionnementId($c)
    {

       $this->conditionnement_id=$c;
    }

    public function getConditionnmentId()
    {

        return $this->conditionnement_id;
    }

    
    public function setTarifId($t)
    {

        $this->tarif_id=$t;
    }

    
    public function getTarifId()
    {

        return $this->tarif_id;
    }

    
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($v){
        $this->value=$v;
    }
}