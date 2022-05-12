<?php

namespace Catalogue\Loop;

use Propel\Runtime\ActiveQuery\Criteria;
use Thelia\Core\Event\Image\ImageEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Core\Template\Loop\Product;
use Thelia\Type\EnumListType;
use Thelia\Type\EnumType;
use Thelia\Type\TypeCollection;
use Thelia\log\Tlog;
use TracabilitePP\Model\ProductLotQuery;

/**
 * Class PdfLoop
 * @package Catalogue\Loop
 * @author François Carfantan f.carfantan@orange.fr
 */
class PdfLoop extends Product
{
  
    public function parseResults(LoopResult $loopResult)
    {
     $maintenant = date("Y-m-d");
     foreach ($loopResult->getResultDataCollection() as $product) {
        $loopResultRow = new LoopResultRow($product);
        $price = $product->getVirtualColumn('price');
        $id=$product->getId();
        
        $loopResultRow
        ->set("ID", $product->getId())
        ->set("REF", $product->getRef())
        ->set("LOCALE", $this->locale)
        ->set("TITLE", $product->getVirtualColumn('i18n_TITLE'))
        ->set("CHAPO", $product->getVirtualColumn('i18n_CHAPO'))
        ->set("DESCRIPTION", $this->parseDescription($product->getVirtualColumn('i18n_DESCRIPTION')))
        ->set("FAMILY",$this->parseFamilyDescription( $product->getVirtualColumn('i18n_DESCRIPTION')))
        ->set("NAME",$this->parseName( $product->getVirtualColumn('i18n_DESCRIPTION')))
        ->set("ORIGIN", $this->parseOrigin($product->getVirtualColumn('i18n_POSTSCRIPTUM')))
        ->set("HAS_ORIGIN",$this->hasOrigin($product->getVirtualColumn('i18n_POSTSCRIPTUM'))!="")
        ->set("URL", $this->getReturnUrl() ? $product->getUrl($this->locale) : null)
        ->set("META_TITLE", $product->getVirtualColumn('i18n_META_TITLE'))
        ->set("META_DESCRIPTION", $product->getVirtualColumn('i18n_META_DESCRIPTION'))
        ->set("META_KEYWORDS", $product->getVirtualColumn('i18n_META_KEYWORDS'))
        ->set("POSITION", $product->getVirtualColumn('position_delegate'))
        ->set("VIRTUAL", $product->getVirtual() ? "1" : "0")
        ->set("VISIBLE", $product->getVisible() ? "1" : "0")
        ->set("TEMPLATE", $product->getTemplateId())
        ->set("DEFAULT_CATEGORY", $defaultCategoryId)
        ->set("TAX_RULE_ID", $product->getTaxRuleId())
        ->set("BRAND_ID", $product->getBrandId() ?: 0)
        ->set("SHOW_ORIGINAL_PRICE", $display_initial_price);
        $loopResult->addRow($loopResultRow);
}

return $loopResult;
}

private function parseFamilyDescription($description){
 $pattern = "/Famille\s*:\s*(.*)\.?\s*<\//";
 if(preg_match($pattern,$description,$matches))
 {
   return $matches[1];
}
else{
   return "";
}

return $matches;
}

private function parseName($description){
   $nbptag=substr_count($description,"<p");
   
   $pattern="/<p>Fami.*\s:\s.*<\/p>\s<p>(.*)<\/p>\s<p>(.*)<\/p>/";
   if(preg_match($pattern,$description,$matches) ){
      if(strlen($matches[1])<40){
         return $matches[1];
      }
      else{
         return "";
      }
       
   }
   else{
      
      return "";
   }

}
private function hasOrigin($postscriptum){
   $pattern='/Origine?\\s*:\\s*(.+)/';
   return(preg_match($pattern,$postscriptum,$matches));
}
private function parseOrigin($postscriptum){
  $pattern='/Origine?\\s*:\\s*(.+)/';
  if(preg_match($pattern,$postscriptum,$matches))
  {
    return $matches[1];
 }
 else{
   Tlog::getInstance()->addDebug("resultat nul");
    return "";
 }
}
private function parseDescription($description){
//   $pattern="/";
//   $nbptag=substr_count($description,"<p");
//   for($i=0;$i<$nbptag;$i++){
//     $pattern=$pattern."<p>(.*)<\/p>\s*";
//   }
//   $pattern=$pattern."/";
//   if(preg_match($pattern,$description,$matches))
//   {
//      if(strlen($matches[$nbptag])>10){
//       return html_entity_decode($matches[$nbptag]);
//      }
//      else{
//       return html_entity_decode($matches[$nbptag-1]);
//      }
    
//  }
//  else{
//     return "";
//  }
return html_entity_decode($description);

}


}
