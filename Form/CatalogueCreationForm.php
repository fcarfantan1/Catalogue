<?php

namespace Catalogue\Form;

use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use Catalogue\Model\CataloguePdfConfigQuery;
use Thelia\Form\StandardDescriptionFieldsTrait;

/**
 * Class Configuration
 * @package Catalogue\Form
 * @author François Carfantan <f.carfantan@orange.fr>
 */
class CatalogueCreationForm extends BaseForm {
    use StandardDescriptionFieldsTrait;
    protected function buildForm($change_mode = false)
    {
        

        $form = $this->formBuilder;
  
        $form->add(
            "year",
            "text",array(
            "label"=> Translator::getInstance()->trans("year", array(), 'catalogue.bo.spiced'))
                );
        $this->addStandardDescFields(array());

    }


    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return "catalogue_creation_form";
    }


} 
