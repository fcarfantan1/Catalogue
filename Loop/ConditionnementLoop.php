<?php
namespace Catalogue\Loop;

use Catalogue\Model\ConditionnementQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Core\Template\Loop\Argument\Argument;

class PriceLoop extends BaseLoop implements PropelSearchLoopInterface {
		 public function buildModelCriteria()
		{

			$search = ConditionnementQuery::create();
            $search->orderByPosition($order = Criteria::ASC);

			return $search;

		}
		public function parseResults(LoopResult $loopResult)
		{
            //var_dump($loopResult->getResultDataCollection());
			foreach ($loopResult->getResultDataCollection() as $conditionnement) {

				$loopResultRow = new LoopResultRow();
				$loopResultRow->set("ID",$conditionnement->getId());
                $loopResultRow->set("TITLE",$conditionnement->getTitle());
                $loopResult->addRow($loopResultRow);
     }

     return $loopResult;
		}
	

}


