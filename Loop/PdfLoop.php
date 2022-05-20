<?php

namespace Catalogue\Loop;

use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Loop\Product;
use Thelia\log\Tlog;


/**
 * Class PdfLoop
 * @package Catalogue\Loop
 * @author François Carfantan f.carfantan@orange.fr
 */
class PdfLoop extends Product
{
  
    public function parseResults(LoopResult $loopResult)
    {
     foreach ($loopResult->getResultDataCollection() as $product) {
        $loopResultRow = new LoopResultRow($product);
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
        ->set("TEMPLATE", $product->getTemplateId());
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
return html_entity_decode($description);

}


}
