<?php

namespace Catalogue\Model;

use Catalogue\Model\Base\CataloguePdfConfig as BaseCataloguePdfConfig;
use Thelia\Files\FileModelInterface;
use Propel\Runtime\Connection\ConnectionInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;

class CataloguePdfConfig extends BaseCataloguePdfConfig implements FileModelInterface
{
    public function preDelete(ConnectionInterface $con = null)
    {
        $catalogue = new \Catalogue\Catalogue();

        $fs = new Filesystem();

        try {
            $fs->remove($catalogue->getUploadDir() . DS . $this->getFile());

            return true;
        } catch (IOException $e) {
            return false;
        }
    }
     /**
     * Set file parent id
     *
     * @param int $parentId parent id
     *
     * @return $this
     */
    public function setChapo($chapo)
    {
        return $this;
    }

    /**
     * Get file parent id
     *
     * @return int parent id
     */
    public function getChapo()
    {
        return $this->getChapo();
    }
     /**
     * Set file parent id
     *
     * @param int $parentId parent id
     *
     * @return $this
     */
    public function setDescription($description)
    {
        return $this;
    }

    /**
     * Get file parent id
     *
     * @return int parent id
     */
    public function getDescription()
    {
        return $this->getDescription();
    }

    public function setPostscriptum($postscriptum)
    {
        return $this;
    }

    /**
     * Get file parent id
     *
     * @return int parent id
     */
    public function getPostscriptum()
    {
        return $this->getPostscriptum();
    }

    



    /**
     * Set file parent id
     *
     * @param int $parentId parent id
     *
     * @return $this
     */
    public function setParentId($parentId)
    {
        return $this;
    }

    /**
     * Get file parent id
     *
     * @return int parent id
     */
    public function getParentId()
    {
        return $this->getId();
    }

    /**
     * @return FileModelParentInterface the parent file model
     */
    public function getParentFileModel()
    {
        return new static;
    }

    /**
     * Get the ID of the form used to change this object information
     *
     * @return BaseForm the form
     */
    public function getUpdateFormId()
    {
        return 'catalogue.image';
    }

    /**
     * @return string the path to the upload directory where files are stored, without final slash
     */
    public function getUploadDir()
    {
        $catalogueDir = new \Catalogue\Catalogue();
        return $catalogueDir->getUploadDir();
    }

    /**
     * @param int $objectId the object ID
     *
     * @return string the URL to redirect to after update from the back-office
     */
    public function getRedirectionUrl()
    {
        return '/admin/module/Catalogue';
    }

    /**
     * Get the Query instance for this object
     *
     * @return ModelCriteria
     */
    public function getQueryInstance()
    {
        return CataloguePdfQuery::create();
    }

    /**
     * @param  bool $visible true if the file is visible, false otherwise
     * @return FileModelInterface
     */
    public function setVisible($visible)
    {
        // Not implemented

        return $this;
    }
}
