<?php
namespace Catalogue\Loop;

use Catalogue\Model\CataloguePdfPriceQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\ArraySearchLoopInterface;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Log\Tlog;

class PriceLoop extends BaseLoop implements PropelSearchLoopInterface {
  public function getArgDefinitions(){
   return new ArgumentCollection(
             Argument::createIntListTypeArgument('tarif', null, true)
         );
  }
//     public function buildArray(){
//     $items=array();
//     for($i=0;$i<5;$i++){
//        $items[] = $i;
//     }
//     return $items;
// }
// public function parseResults(LoopResult $loopResult){
//   Tlog::getInstance()->addInfo("entree de la boucle");
//     foreach($loopResult->getResultDataCollection() as $item){
//         Tlog::getInstance()->addInfo("une entree prix"); 
//         $loopResultRow=new loopResultRow();
//         $loopResultRow->set("PRICE", $item);
//         $loopResult->addRow($loopResultRow);
//     }
//     return $loopResult;
// }
 public function buildModelCriteria()
    {

     $search = CataloguePdfPriceQuery::create()
        ->filterByCataloguePdfTarifId($this->getTarif())
        ->orderByCataloguePdfConditionnementId();
       
          

     return $search;

    }
    public function parseResults(LoopResult $loopResult)
    {
          foreach ($loopResult->getResultDataCollection() as $price) {
             $loopResultRow = new LoopResultRow();
                // $loopResultRow->set("CONDITIONNEMENT",$price->getConditionnementId());
             // $loopResultRow->set("TARIF", $price->getTarif());
             $loopResultRow->set("VALUE", $price->getValue());
                $loopResult->addRow($loopResultRow);
     }

     return $loopResult;
    }



}


