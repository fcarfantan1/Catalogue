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

namespace Catalogue;

use Thelia\Module\BaseModule;
use Thelia\Core\Template\TemplateDefinition;
use Thelia\Model\ConfigQuery;

class Catalogue extends BaseModule
{
    /** @var string */
    const DOMAIN_NAME = 'catalogue';

    /*
     * You may now override BaseModuleInterface methods, such as:
     * install, destroy, preActivation, postActivation, preDeactivation, postDeactivation
     *
     * Have fun !
     */
    public function getHooks() 
  {
     return array(
    
          // Only register the title in the default language
          array(
              "type" => TemplateDefinition::BACK_OFFICE,
              "code" => "hook_catalogue",
              "title" => "Catalogue pdf",
              "description" => "Exportation du catalogue en pdf",
          )
     );
  }
  public function getUploadDir()
  {
      $uploadDir = ConfigQuery::read('images_library_path');

      if ($uploadDir === null) {
          $uploadDir = THELIA_LOCAL_DIR . 'media' . DS . 'images';
      } else {
          $uploadDir = THELIA_ROOT . $uploadDir;
      }

      return $uploadDir . DS . Catalogue::DOMAIN_NAME;
  }
  public function getDocumentUploadDir()
  {
      $uploadDir = ConfigQuery::read('documents_library_path');

      if ($uploadDir === null) {
          $uploadDir = THELIA_LOCAL_DIR . 'media' . DS . 'documents';
      } else {
          $uploadDir = THELIA_ROOT . $uploadDir;
      }

      return $uploadDir . DS . Catalogue::DOMAIN_NAME;
  }
}
