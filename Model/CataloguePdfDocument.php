<?php

namespace Catalogue\Model;

use Catalogue\Model\Base\CataloguePdfDocument as BaseCataloguePdfDocument;
use Thelia\Files\FileModelInterface;

/**
 * Skeleton subclass for representing a row from the 'catalogue_pdf_document' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class CataloguePdfDocument extends BaseCataloguePdfDocument implements FileModelInterface
{

    
    public function setParentId($id){

    }
    public function getParentId(){
        return $this->getId;
    }
    public function getParentFileModel(){
        return new static;
    }
    public function getUpdateFormId(){
        return 'catalogue.pdf';
    }
    public function getQueryInstance(){
        return $this;
    }
    public function getRedirectionUrl(){
        return '/admin/module/Catalogue';
    }
    public function getUploadDir(){
        $catalogue = new \Catalogue\Catalogue();
        return $catalogue->getDocumentUploadDir();
    }
    public function setChapo($chapo){
        return $this;
    }
    public function setDescription($description){
        return $this;
    }
    public function setPostscriptum($postcriptum){
        return $this;
    }
    public function setVisible($visible){
        return $this;
    }

}
