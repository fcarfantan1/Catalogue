<?php


namespace Catalogue\Form;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Thelia\log\Tlog;

/*
 *
 * @package Catalogue
 * @author  François Carfantan <f.carfantan@orange.fr>
 *
 */
class CatalogueModificationForm extends CatalogueCreationForm
{
  protected function buildForm()
    {
        parent::buildForm(true);
        Tlog::getInstance()->addDebug("FCA : CatalogueModificationForm2");


         $this->formBuilder
            ->add("id", "hidden", array(
                    "constraints" => array(new GreaterThan(array('value' => 0))),
            ));
       
    }
    
    public function getName()
    {
        return 'catalogue_modification_form';
    }
}

