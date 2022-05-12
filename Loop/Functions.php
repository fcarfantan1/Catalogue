<?php
namespace Catalogue\Loop;
use Thelia\Log\Tlog;

class Functions{
    public static function parseFamilyDescription($description){
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
    public static function parseName($description){
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
     public static function hasOrigin($postscriptum){
        $pattern='/Origine?\\s*:\\s*(.+)/';
        return(preg_match($pattern,$postscriptum,$matches));
     }
     public static function parseOrigin($postscriptum){
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
     public static function parseDescription($description){
     
     return html_entity_decode($description);
     
     }
}


