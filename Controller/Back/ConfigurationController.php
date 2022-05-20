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

use Thelia\Core\Event\File\FileCreateOrUpdateEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Log\Tlog;
use Catalogue\Model\CataloguePdfConfig;
use Catalogue\Model\CataloguePdfConfigQuery;
use Catalogue\Model\CataloguePdfDocument;
use Catalogue\Model\CataloguePdfDocumentQuery;
use Thelia\Model\Lang;
use Thelia\Model\LangQuery;
use Thelia\Form\Exception\FormValidationException;
use Thelia\Tools\URL;



/**
 * Class ConfigurationController
 * @package Catalogue\Controller
 * @author Francois Carfantan <f.carfantan@orange.fr>
 */
class ConfigurationController extends BaseAdminController
{
   
//    public function updateAction()
//     {
//         if (null !== $response = $this->checkAuth(AdminResources::MODULE, ['catalogue'], AccessManager::UPDATE)) {
//             return $response;
//         }

//         $form = $this->createForm('catalogue.update.form');

//         $error_message = null;

//         try {
//             $updateForm = $this->validateForm($form);

//             $catalogues = CataloguePdfConfigQuery::create();

//             $locale = $this->getCurrentEditionLocale();

//             /** @var Catalogue $catalogue */
//             foreach ($catalogues as $catalogue) {
//                 $id = $catalogue->getId();

//                 $catalogue
//                     ->setLocale($locale)
//                     ->setSubtitle($this->getFormFieldValue($updateForm,'subtitle'))
//                     ->setTitle($this->getFormFieldValue($updateForm, 'title'))
//                     ->setTitreDateDebut($this->getFormFieldValue($updateForm, 'titre_date_debut'))
//                     ->setResponsableNom($this->getFormFieldValue($updateForm,'responsable_nom'))
//                     ->setResponsableNom($this->getFormFieldValue($updateForm,'responsable_nom'))
//                     ->setResponsablePreNom($this->getFormFieldValue($updateForm,'responsable_prenom'))
//                     ->setTelFixe($this->getFormFieldValue($updateForm,'tel_fixe'))
//                     ->setTelMobile($this->getFormFieldValue($updateForm,'tel_mobile'))
//                     ->setAdresseVoie($this->getFormFieldValue($updateForm,'adresse_voie'))
//                     ->setTexteSite($this->getFormFieldValue($updateForm,'texte_site'))
//                     ->setAdresseCodepostal($this->getFormFieldValue($updateForm,'adresse_codepostal'))
//                     ->setAdresseCommune($this->getFormFieldValue($updateForm,'adresse_commune'))
//                     ->setSiret($this->getFormFieldValue($updateForm,'siret'))
//                 ->save();
//             }

//             $response =  $this->redirectToConfigurationPage();

//         } catch (FormValidationException $e) {
//             $error_message = $this->createStandardFormValidationErrorMessage($e);
//         }

//         if (null !== $error_message) {
//             $this->setupFormErrorContext(
//                 'catalogue upload',
//                 $error_message,
//                 $form
//             );

//             $response = $this->render("module-configure", [ 'module_code' => 'Catalogue' ]);
//         }

//         return $response;

//     }
    
    public function uploadImage()
    {
        if (null !== $response = $this->checkAuth(AdminResources::MODULE, ['catalogue'], AccessManager::CREATE)) {
            return $response;
        }
        Tlog::getInstance()->addDebug("uploadImage");
        $request = $this->getRequest();
        $form = $this->createForm('catalogue.image');
        $error_message = null;
        try {
            $this->validateForm($form);

            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $fileBeingUploaded */
            $fileBeingUploaded = $request->files->get(sprintf('%s[file]', $form->getName()), null, true);
            /** FCA **************/
            $fileOldModel=CataloguePdfConfigQuery::create()->findOne();
           
            if ($fileOldModel==null)
            {
               // Tlog::getInstance()->addDebug("file old model est null");
            /**                   **/
            $fileModel = new CataloguePdfConfig();
            $fileCreateOrUpdateEvent = new FileCreateOrUpdateEvent(1);
            $fileCreateOrUpdateEvent->setModel($fileModel);
    
            $fileCreateOrUpdateEvent->setUploadedFile($fileBeingUploaded);

            $this->dispatch(
                TheliaEvents::IMAGE_SAVE,
                $fileCreateOrUpdateEvent
            );
            } 
            else {
               // Tlog::getInstance()->addDebug("file old model n'est pas null");
               $imageId = $fileOldModel->getId();
               $catalogue = CataloguePdfConfigQuery::create()->findPk($imageId);
               $fileCreateOrUpdateEvent = new FileCreateOrUpdateEvent(1);
               $fileCreateOrUpdateEvent->setModel($fileOldModel);
               $fileCreateOrUpdateEvent->setUploadedFile($fileBeingUploaded);
            $this->dispatch(
                TheliaEvents::IMAGE_SAVE,$fileCreateOrUpdateEvent
            );

            }  
           
            // Compensate issue #1005
            $langs = LangQuery::create()->find();

            /** @var Lang $lang */
            foreach ($langs as $lang) {
                $fileCreateOrUpdateEvent->getModel()->setLocale($lang->getLocale())->setTitle('')->save();
            }
            $response =  $this->redirectToConfigurationPage();

        } catch (FormValidationException $e) {
            $error_message = $this->createStandardFormValidationErrorMessage($e);
        }

        if (null !== $error_message) {
            $this->setupFormErrorContext(
                'cataloguePdfConfig upload',
                $error_message,
                $form
            );

            $response = $this->render(
                "module-configure",
                [
                    'module_code' => 'CataloguePdfConfig'
                ]
            );
        }

        return $response;
    }
    // public function uploadPdfCatalogue(){
    //     if (null !== $response = $this->checkAuth(AdminResources::MODULE, ['catalogue'], AccessManager::CREATE)) {
    //         return $response;
    //     }
    //     Tlog::getInstance()->addDebug("uploadPdfCatalogue");
    //     $request = $this->getRequest();
    //     $form = $this->createForm('catalogue.file');
    //     $error_message = null;
    //     try {
    //         $this->validateForm($form);

    //         /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $fileBeingUploaded */
    //         $fileBeingUploaded = $request->files->get(sprintf('%s[import_file]', $form->getName()), null, true);
    //         Tlog::getInstance()->addDebug("uploadPdfCatalogue :".$fileBeingUploaded);
    //     }
    //     catch (FormValidationException $e) {
    //         $error_message = $this->createStandardFormValidationErrorMessage($e);
    //     }

    // }
    public function uploadPdf()
    {
        if (null !== $response = $this->checkAuth(AdminResources::MODULE, ['catalogue'], AccessManager::CREATE)) {
            return $response;
        }

        $request = $this->getRequest();
        $form = $this->createForm('catalogue.pdf');
        $error_message = null;
        try {
            $vForm = $this->validateForm($form);
            $configId = CataloguePdfConfigQuery::create()->select('id')->findOne();
            $fileModel = CataloguePdfDocumentQuery::create()->findOne();
            if(is_null($fileModel)){
                $fileModel = new CataloguePdfDocument();
                $fileModel->setConfigId($configId);
            }
            $fileBeingUploaded = $request->files->get('catalogue_pdf')['import_file'];
            $fileModel->setPublicationYear($this->getFormFieldValue($vForm,'catalog_year'));
            $fileCreateOrUpdateEvent = new FileCreateOrUpdateEvent(1);
            $fileCreateOrUpdateEvent->setModel($fileModel);
            $fileCreateOrUpdateEvent->setUploadedFile($fileBeingUploaded);

            $this->dispatch(
                TheliaEvents::DOCUMENT_SAVE,
                $fileCreateOrUpdateEvent
            );

            // Compensate issue #1005
            $langs = LangQuery::create()->find();
           
            /** @var Lang $lang */
            foreach ($langs as $lang) {
                $fileCreateOrUpdateEvent->getModel()->setLocale($lang->getLocale())->setTitle('')->save();
            }

            $response =  $this->redirectToConfigurationPage();

        } catch (FormValidationException $e) {
            $error_message = $this->createStandardFormValidationErrorMessage($e);
        }

        if (null !== $error_message) {
            $this->setupFormErrorContext(
                'catalogue upload',
                $error_message,
                $form
            );
            Tlog::getInstance()->addError("FCA ".$error_message);
            $response = $this->render(
                "module-configure",
                [
                    'module_code' => 'Catalogue'
                ]
            );
        }

        return $response;
    }

    public function deleteAll()
    {
        $catalogueConfigQuery= CataloguePdfConfigQuery::create();
        $catalogueConfigQuery->doDeleteAll();
    }
   
    public function deleteAction()
    {
        if (null !== $response = $this->checkAuth(AdminResources::MODULE, ['catalogue'], AccessManager::DELETE)) {
            return $response;
        }

        $imageId = $this->getRequest()->request->get('image_id');

        if ($imageId != "") {
            $catalogue = CataloguePdfConfigQuery::create()->findPk($imageId);

            if (null !== $catalogue) {
                $catalogue->delete();
            }
        }

        return $this->redirectToConfigurationPage();
    }
     
    /**
     * @param Form $form
     * @param string $fieldName
     * @param int $id
     * @return string
     */
    protected function getFormFieldValue($form, $fieldName)
    {
        $value = $form->get($fieldName)->getData();

        return $value;
    }
     protected function redirectToConfigurationPage()
    {
        return RedirectResponse::create(URL::getInstance()->absoluteUrl('/admin/module/Catalogue'));
    }
    
 
}
