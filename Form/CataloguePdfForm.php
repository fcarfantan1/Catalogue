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



use Thelia\Form\BaseForm;

/**
 * Class CatalogueImageForm
 * @package Catalogue\Form
 * @author francois carfantan <f.carfantan@orange.fr>
 **/

class CataloguePdfForm extends BaseForm
{
    /**
     * @inheritdoc
     */
    protected function buildForm()
    {
        $this->formBuilder
            ->add(
                'import_file',
                'file',
                [
                    'constraints' => [
                    ],
                    'label' => 'Catalogue file',
                    'label_attr' => [
                        'for' => 'file'
                    ]
                ]
            )
            ->add(
                'catalog_year',
                'number',
                [
                    'constraints' => [
                    ],
                    'label' => 'Catalog year',
                    'label_attr' => [
                        'for' => 'catalog_year'
                    ]
                ]
            );
    }

    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return 'catalogue_pdf';
    }
}