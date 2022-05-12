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

namespace Catalogue\Form;

use Catalogue\Catalogue;
use Catalogue\Model\Config\Base\CatalogueConfigValue;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

/**
 * Class Configuration
 * @package Catalogue\Form
 * @author Thomas Arnaud <tarnaud@openstudio.fr>
 */
class Configuration extends BaseForm
{

    protected function buildForm()
    {
        $this->formBuilder
            ->add(
                "enabled",
                "checkbox",
                array(
                    "label" => "Enabled",
                    "label_attr" => [
                        "for" => "enabled",
                        "help" => Translator::getInstance()->trans(
                            'Check if you want to activate Catalogue',
                            [],
                            Catalogue::DOMAIN_NAME
                        )
                    ],
                    "required" => false,
                    "constraints" => array(
                    ),
                    "value" => Catalogue::getConfigValue(CatalogueConfigValue::ENABLED, 1),
                )
            );
    }

    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return "Catalogue_enable";
    }
}
