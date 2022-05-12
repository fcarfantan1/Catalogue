<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace Catalogue\Controller\Back;

use Symfony\Component\HttpFoundation\JsonResponse;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Event\PdfEvent;
use Thelia\Core\Event\TheliaEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Log\Tlog;
use Thelia\Core\HttpFoundation\Response;

use Thelia\Tools\URL;
use Catalogue\Loop\PdfLoop;

/**
 * Class Configuration
 * @package Catalogue\Controller
 * @author Francois Carfantan <f.carfantan@orange.fr>
 */

class CatalogueController extends BaseAdminController
{
    public function createPdfAction(){
        try {
            $catalogueHtml = $this->renderRaw('catalogue');
            $pdfEvent = new PdfEvent($catalogueHtml);
    
            $this->dispatch(TheliaEvents::GENERATE_PDF, $pdfEvent);
    
            if ($pdfEvent->hasPdf()) {
                return $this->pdfResponse($pdfEvent->getPdf(), 'catalogue');
            }
         } catch (\Exception $e) {
             Tlog::getInstance()->error("erreur de création du catalogue pdf : ".$e);
         }
     
    //   $lang=$this->getRequest()->getSession()->getLang()->getLocale();
    //    return $this->render('catalogue',['LANG'=>$lang]);
   }
   private function baseProductSearch($params)
    {
        $productLoop = new PdfLoop($this->getContainer());
        
        $productLoop->initializeArgs($params);
        $resultat = $productLoop->exec($paginate);
        $export =  "\""."Reference"
        ."\";\""."Famille"
        ."\";\""."Nom Botanique"
        ."\";\""."Description"
        ."\";\""."Origine"
        ."\";\r\n";
        Tlog::getInstance()->info("export : ".$export);
        foreach($resultat as $item){
           
            $export .=
                "\"".$item->get("REF")
                ."\";\"".$item->get("FAMILY")
                ."\";\"".$item->get("TITLE")
                ."\";\"".preg_replace("/<.?p>/","",$item->get("DESCRIPTION"))
                ."\";\"".$item->get("ORIGIN")
                ."\";\r\n";
        }
        
        return $export;
    }
   
  
   }
  


