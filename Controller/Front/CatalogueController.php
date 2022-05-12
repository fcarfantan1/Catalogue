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

namespace Catalogue\Controller\Front;

use Symfony\Component\HttpFoundation\JsonResponse;
use Thelia\Controller\Front\BaseFrontController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Event\PdfEvent;
use Thelia\Core\Event\TheliaEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Log\Tlog;

use Thelia\Tools\URL;

/**
 * Class Configuration
 * @package Catalogue\Controller
 * @author Francois Carfantan <f.carfantan@orange.fr>
 */
class CatalogueController extends BaseFrontController
{
    public function createPdfAction(){
    	 return $this->render('catalogue');
      
   }
  

}
