<?php
 namespace Catalogue\Loop;

 use Thelia\Core\Template\Element\BaseLoop;
 use Thelia\Core\Template\Element\BaseI18nLoop;
 use Thelia\Core\Template\Element\LoopResult;
 use Thelia\Core\Template\Element\LoopResultRow;
 use Thelia\Core\Template\Element\PropelSearchLoopInterface;
 use Thelia\Core\Template\Element\SearchLoopInterface;
 use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
 use Thelia\Core\Template\Loop\Argument\Argument;
 use Thelia\Model\ProductQuery;
 use Catalogue\Loop\Functions;
 use Thelia\Log\Tlog;

 class CsvLoop extends BaseI18nLoop implements PropelSearchLoopInterface {

    

     public function getArgDefinitions()
     {
         return new ArgumentCollection(
            
         );
     }

     public function buildModelCriteria()
     {
        $search = ProductQuery::create();
        $this->configureI18nProcessing($search, ['TITLE','DESCRIPTION', 'POSTSCRIPTUM']);
         return $search;
     }
     
     public function parseResults(LoopResult $loopResult)
     {
          foreach ($loopResult->getResultDataCollection() as $product) {
             $loopResultRow = new LoopResultRow($product);
     
             $loopResultRow->set("REF", $product->getRef());
             $loopResultRow->set("FAMILY", Functions::parseFamilyDescription( $product->getVirtualColumn('i18n_DESCRIPTION')));
             $loopResultRow->set("TITLE",  $product->getVirtualColumn('i18n_TITLE'));
             $loopResultRow->set("DESCRIPTION", Functions::parseDescription($product->getVirtualColumn('i18n_DESCRIPTION')));
             $loopResultRow->set("ORIGIN", Functions::parseOrigin($product->getVirtualColumn('i18n_POSTSCRIPTUM')));
             $loopResult->addRow($loopResultRow);
         }
     
         return $loopResult;
     }
    }
