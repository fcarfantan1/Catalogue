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
use Catalogue\Model\CataloguePdfConfigQuery;
use Thelia\Form\BaseForm;

/**
 * Class CatalogueUpdateForm
 * @package Catalogue\Form
 * @author manuel raynaud <mraynaud@openstudio.fr>
 */
class CatalogueUpdateForm extends BaseForm
{
    /**
     * @inheritdoc
     */
    protected function buildForm()
    {
        $catalogue=CataloguePdfConfigQuery::create()->findOne();
            $this->formBuilder->add(
                'alt' ,
                'text',
                [
                    'label' => $this->translator->trans('Alternative image text', [], Catalogue::DOMAIN_NAME),
                    'label_attr' => [
                        'for' => 'alt'
                    ],
                    'required' => false,
                    'attr' => [
                        'placeholder' => $this->translator->trans(
                            'Displayed when image is not visible',
                            [],
                            Catalogue::DOMAIN_NAME
                        )
                    ]
                ]
                )->add(
                'url',
                'url',
                [
                    'label' => $this->translator->trans('Image URL', [], Catalogue::DOMAIN_NAME),
                    'label_attr' => [
                        'for' => 'url'
                    ],
                    'required' => false,
                    'attr' => [
                        'placeholder' => $this->translator->trans(
                            'Please enter a valid URL',
                            [],
                            Catalogue::DOMAIN_NAME
                        )
                    ]
                ]
            )->add(
                'title',
                'text',
                [
                    'constraints' => [],
                    'required' => false,
                    'label' => $this->translator->trans('Title',
                        [],
                        Catalogue::DOMAIN_NAME
                ),
                    'label_attr' => [
                        'for' => 'title_field'
                    ],
                    'attr' => [
                        'placeholder' => $this->translator->trans('The Catalogue Title',
                        [],
                        Catalogue::DOMAIN_NAME
                )
                    ]
                ]
            )->add(
                    'subtitle',
                    'text',
                    [
                        'constraints' => [],
                        'required' => false,
                        'label' => $this->translator->trans('Subtitle',
                        [],
                        Catalogue::DOMAIN_NAME
                ),
                        'label_attr' => [
                            'for' => 'subtitle_field'
                        ],
                        'attr' => [
                            'placeholder' => $this->translator->trans('The Catalogue Subtitle',
                            [],
                            Catalogue::DOMAIN_NAME
                    )
                        ]
                    ]
            
            )->add(
                'titre_date_debut',
                'text',
                [
                    'constraints' => [],
                    'required' => false,
                    'label' => $this->translator->trans('date de début d\'application',
                    [],
                    Catalogue::DOMAIN_NAME
                ),
                    'label_attr' => [
                        'for' => 'date_text_field'
                    ],
                    'attr' => [
                        'rows' => 3,
                        'placeholder' => $this->translator->trans('The available date', [],
                        Catalogue::DOMAIN_NAME)
                    ]
                ]
                )->add(
                    'texte_site',
                    'textarea',
                    [
                        'constraints' => [],
                        'required' => false,
                        'label' => $this->translator->trans('Texte d\'introduction', [],
                        Catalogue::DOMAIN_NAME),
                        'label_attr' => [
                            'for' => 'texte_site'
                        ],
                        'attr' => [
                            'placeholder' => $this->translator->trans('Introduction Text', [],
                            Catalogue::DOMAIN_NAME)
                        ]
                    ]
                )->add(
                    'responsable_nom',
                    'text',
                    [
                        'constraints' => [],
                        'required' => false,
                        'label' => $this->translator->trans('Nom', [],
                        Catalogue::DOMAIN_NAME),
                        'label_attr' => [
                            'for' => 'responsable_nom'
                        ],
                        'attr' => [
                            'placeholder' => $this->translator->trans('The owner name', [],
                            Catalogue::DOMAIN_NAME)
                        ]
                    ]
                    )->add(
                        'responsable_prenom',
                        'text',
                        [
                            'constraints' => [],
                            'required' => false,
                            'label' => $this->translator->trans('Prenom', [],
                            Catalogue::DOMAIN_NAME),
                            'label_attr' => [
                                'for' => 'responsable_prenom'
                            ],
                            'attr' => [
                                'placeholder' => $this->translator->trans('The owner forename', [],
                                Catalogue::DOMAIN_NAME)
                            ]
                        ]
                        )->add(
                            'tel_fixe',
                            'text',
                            [
                                'constraints' => [],
                                'required' => false,
                                'label' => $this->translator->trans('Téléphone fixe', [],
                                Catalogue::DOMAIN_NAME),
                                'label_attr' => [
                                    'for' => 'tel_fixe'
                                ],
                                'attr' => [
                                    'placeholder' => $this->translator->trans('Home Phone', [],
                                    Catalogue::DOMAIN_NAME)
                                ]
                            ]
                            )->add(
                                'tel_mobile',
                                'text',
                                [
                                    'constraints' => [],
                                    'required' => false,
                                    'label' => $this->translator->trans('Téléphone mobile', [],
                                    Catalogue::DOMAIN_NAME),
                                    'label_attr' => [
                                        'for' => 'tel_mobile'
                                    ],
                                    'attr' => [
                                        'placeholder' => $this->translator->trans('Mobile Phone' ,[],
                                        Catalogue::DOMAIN_NAME)
                                    ]
                                ]
                                )->add(
                                    'adresse_voie',
                                    'text',
                                    [
                                        'constraints' => [],
                                        'required' => false,
                                        'label' => $this->translator->trans('Adresse' ,[],
                                        Catalogue::DOMAIN_NAME),
                                        'label_attr' => [
                                            'for' => 'adresse_voie'
                                        ],
                                        'attr' => [
                                            'placeholder' => $this->translator->trans('Address', [],
                                            Catalogue::DOMAIN_NAME)
                                        ]
                                    ]
                                )->add(
                                    'adresse_codepostal',
                                    'text',
                                    [
                                        'constraints' => [],
                                        'required' => false,
                                        'label' => $this->translator->trans('Code Postal', [],
                                        Catalogue::DOMAIN_NAME),
                                        'label_attr' => [
                                            'for' => 'adresse_codepostal'
                                        ],
                                        'attr' => [
                                            'placeholder' => $this->translator->trans('ZipCode', [],
                                            Catalogue::DOMAIN_NAME)
                                        ]
                                    ]
                                )->add(
                                    'adresse_commune',
                                    'text',
                                    [
                                        'constraints' => [],
                                        'required' => false,
                                        'label' => $this->translator->trans('Commune', [],
                                        Catalogue::DOMAIN_NAME),
                                        'label_attr' => [
                                            'for' => 'adresse_commune'
                                        ],
                                        'attr' => [
                                            'placeholder' => $this->translator->trans('City', [],
                                            Catalogue::DOMAIN_NAME)
                                        ]
                                    ]
                                    )->add(
                                        'siret',
                                        'text',
                                        [
                                            'constraints' => [],
                                            'required' => false,
                                            'label' => $this->translator->trans('siret', [],
                                            Catalogue::DOMAIN_NAME),
                                            'label_attr' => [
                                                'for' => 'siret'
                                            ],
                                            'attr' => [
                                                'placeholder' => $this->translator->trans('siret', [],
                                                Catalogue::DOMAIN_NAME)
                                            ]
                                        ]
                                
            );
        }
    

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return "Catalogue_update";
    }
}