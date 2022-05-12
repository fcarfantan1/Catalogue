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


use Symfony\Component\Validator\Constraints\Image;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use Catalogue\Catalogue;

/**
 * Class CatalogueImageForm
 * @package Catalogue\Form
 * @author francois carfantan <f.carfantan@orange.fr>
 **/

class CatalogueImageForm extends BaseForm
{
    /**
     * @inheritdoc
     */
    protected function buildForm()
    {
        $this->formBuilder
            ->add(
                'file',
                'file',
                [
                    'constraints' => [
                        new Image()
                    ],
                    'label' => 'Catalogue image',
                    'label_attr' => [
                        'for' => 'file'
                    ]
                ]
            );
    }

    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return 'catalogue_image';
    }
}