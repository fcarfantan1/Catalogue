<?php

namespace Catalogue\Model\Map;

use Catalogue\Model\CataloguePdfConfig;
use Catalogue\Model\CataloguePdfConfigQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'catalogue_pdf_config' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CataloguePdfConfigTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Catalogue.Model.Map.CataloguePdfConfigTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'catalogue_pdf_config';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Catalogue\\Model\\CataloguePdfConfig';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Catalogue.Model.CataloguePdfConfig';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the ID field
     */
    const ID = 'catalogue_pdf_config.ID';

    /**
     * the column name for the FILE field
     */
    const FILE = 'catalogue_pdf_config.FILE';

    /**
     * the column name for the URL field
     */
    const URL = 'catalogue_pdf_config.URL';

    /**
     * the column name for the RESPONSABLE_NOM field
     */
    const RESPONSABLE_NOM = 'catalogue_pdf_config.RESPONSABLE_NOM';

    /**
     * the column name for the RESPONSABLE_PRENOM field
     */
    const RESPONSABLE_PRENOM = 'catalogue_pdf_config.RESPONSABLE_PRENOM';

    /**
     * the column name for the TEL_FIXE field
     */
    const TEL_FIXE = 'catalogue_pdf_config.TEL_FIXE';

    /**
     * the column name for the TEL_MOBILE field
     */
    const TEL_MOBILE = 'catalogue_pdf_config.TEL_MOBILE';

    /**
     * the column name for the ADRESSE_VOIE_NUMERO field
     */
    const ADRESSE_VOIE_NUMERO = 'catalogue_pdf_config.ADRESSE_VOIE_NUMERO';

    /**
     * the column name for the ADRESSE_CODEPOSTAL field
     */
    const ADRESSE_CODEPOSTAL = 'catalogue_pdf_config.ADRESSE_CODEPOSTAL';

    /**
     * the column name for the ADRESSE_COMMUNE field
     */
    const ADRESSE_COMMUNE = 'catalogue_pdf_config.ADRESSE_COMMUNE';

    /**
     * the column name for the SIRET field
     */
    const SIRET = 'catalogue_pdf_config.SIRET';

    /**
     * the column name for the CREATED_AT field
     */
    const CREATED_AT = 'catalogue_pdf_config.CREATED_AT';

    /**
     * the column name for the UPDATED_AT field
     */
    const UPDATED_AT = 'catalogue_pdf_config.UPDATED_AT';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    // i18n behavior

    /**
     * The default locale to use for translations.
     *
     * @var string
     */
    const DEFAULT_LOCALE = 'en_US';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'File', 'Url', 'ResponsableNom', 'ResponsablePrenom', 'TelFixe', 'TelMobile', 'AdresseVoieNumero', 'AdresseCodepostal', 'AdresseCommune', 'Siret', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_STUDLYPHPNAME => array('id', 'file', 'url', 'responsableNom', 'responsablePrenom', 'telFixe', 'telMobile', 'adresseVoieNumero', 'adresseCodepostal', 'adresseCommune', 'siret', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(CataloguePdfConfigTableMap::ID, CataloguePdfConfigTableMap::FILE, CataloguePdfConfigTableMap::URL, CataloguePdfConfigTableMap::RESPONSABLE_NOM, CataloguePdfConfigTableMap::RESPONSABLE_PRENOM, CataloguePdfConfigTableMap::TEL_FIXE, CataloguePdfConfigTableMap::TEL_MOBILE, CataloguePdfConfigTableMap::ADRESSE_VOIE_NUMERO, CataloguePdfConfigTableMap::ADRESSE_CODEPOSTAL, CataloguePdfConfigTableMap::ADRESSE_COMMUNE, CataloguePdfConfigTableMap::SIRET, CataloguePdfConfigTableMap::CREATED_AT, CataloguePdfConfigTableMap::UPDATED_AT, ),
        self::TYPE_RAW_COLNAME   => array('ID', 'FILE', 'URL', 'RESPONSABLE_NOM', 'RESPONSABLE_PRENOM', 'TEL_FIXE', 'TEL_MOBILE', 'ADRESSE_VOIE_NUMERO', 'ADRESSE_CODEPOSTAL', 'ADRESSE_COMMUNE', 'SIRET', 'CREATED_AT', 'UPDATED_AT', ),
        self::TYPE_FIELDNAME     => array('id', 'file', 'url', 'responsable_nom', 'responsable_prenom', 'tel_fixe', 'tel_mobile', 'adresse_voie_numero', 'adresse_codepostal', 'adresse_commune', 'siret', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'File' => 1, 'Url' => 2, 'ResponsableNom' => 3, 'ResponsablePrenom' => 4, 'TelFixe' => 5, 'TelMobile' => 6, 'AdresseVoieNumero' => 7, 'AdresseCodepostal' => 8, 'AdresseCommune' => 9, 'Siret' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, ),
        self::TYPE_STUDLYPHPNAME => array('id' => 0, 'file' => 1, 'url' => 2, 'responsableNom' => 3, 'responsablePrenom' => 4, 'telFixe' => 5, 'telMobile' => 6, 'adresseVoieNumero' => 7, 'adresseCodepostal' => 8, 'adresseCommune' => 9, 'siret' => 10, 'createdAt' => 11, 'updatedAt' => 12, ),
        self::TYPE_COLNAME       => array(CataloguePdfConfigTableMap::ID => 0, CataloguePdfConfigTableMap::FILE => 1, CataloguePdfConfigTableMap::URL => 2, CataloguePdfConfigTableMap::RESPONSABLE_NOM => 3, CataloguePdfConfigTableMap::RESPONSABLE_PRENOM => 4, CataloguePdfConfigTableMap::TEL_FIXE => 5, CataloguePdfConfigTableMap::TEL_MOBILE => 6, CataloguePdfConfigTableMap::ADRESSE_VOIE_NUMERO => 7, CataloguePdfConfigTableMap::ADRESSE_CODEPOSTAL => 8, CataloguePdfConfigTableMap::ADRESSE_COMMUNE => 9, CataloguePdfConfigTableMap::SIRET => 10, CataloguePdfConfigTableMap::CREATED_AT => 11, CataloguePdfConfigTableMap::UPDATED_AT => 12, ),
        self::TYPE_RAW_COLNAME   => array('ID' => 0, 'FILE' => 1, 'URL' => 2, 'RESPONSABLE_NOM' => 3, 'RESPONSABLE_PRENOM' => 4, 'TEL_FIXE' => 5, 'TEL_MOBILE' => 6, 'ADRESSE_VOIE_NUMERO' => 7, 'ADRESSE_CODEPOSTAL' => 8, 'ADRESSE_COMMUNE' => 9, 'SIRET' => 10, 'CREATED_AT' => 11, 'UPDATED_AT' => 12, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'file' => 1, 'url' => 2, 'responsable_nom' => 3, 'responsable_prenom' => 4, 'tel_fixe' => 5, 'tel_mobile' => 6, 'adresse_voie_numero' => 7, 'adresse_codepostal' => 8, 'adresse_commune' => 9, 'siret' => 10, 'created_at' => 11, 'updated_at' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('catalogue_pdf_config');
        $this->setPhpName('CataloguePdfConfig');
        $this->setClassName('\\Catalogue\\Model\\CataloguePdfConfig');
        $this->setPackage('Catalogue.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('FILE', 'File', 'VARCHAR', false, 255, null);
        $this->addColumn('URL', 'Url', 'VARCHAR', false, 255, null);
        $this->addColumn('RESPONSABLE_NOM', 'ResponsableNom', 'VARCHAR', false, 255, null);
        $this->addColumn('RESPONSABLE_PRENOM', 'ResponsablePrenom', 'VARCHAR', false, 255, null);
        $this->addColumn('TEL_FIXE', 'TelFixe', 'VARCHAR', false, 255, null);
        $this->addColumn('TEL_MOBILE', 'TelMobile', 'VARCHAR', false, 255, null);
        $this->addColumn('ADRESSE_VOIE_NUMERO', 'AdresseVoieNumero', 'VARCHAR', false, 255, null);
        $this->addColumn('ADRESSE_CODEPOSTAL', 'AdresseCodepostal', 'VARCHAR', false, 255, null);
        $this->addColumn('ADRESSE_COMMUNE', 'AdresseCommune', 'VARCHAR', false, 255, null);
        $this->addColumn('SIRET', 'Siret', 'VARCHAR', false, 255, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CataloguePdfConfigI18n', '\\Catalogue\\Model\\CataloguePdfConfigI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'CataloguePdfConfigI18ns');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'title,subtitle,titre_date_debut,alt,adresse_voie,texte_site', 'locale_column' => 'locale', 'locale_length' => '5', 'default_locale' => '', 'locale_alias' => '', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to catalogue_pdf_config     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in ".$this->getClassNameFromBuilder($joinedTableTableMapBuilder)." instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
                CataloguePdfConfigI18nTableMap::clearInstancePool();
            }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {

            return (int) $row[
                            $indexType == TableMap::TYPE_NUM
                            ? 0 + $offset
                            : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
                        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? CataloguePdfConfigTableMap::CLASS_DEFAULT : CataloguePdfConfigTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     * @return array (CataloguePdfConfig object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CataloguePdfConfigTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CataloguePdfConfigTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CataloguePdfConfigTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CataloguePdfConfigTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CataloguePdfConfigTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = CataloguePdfConfigTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CataloguePdfConfigTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CataloguePdfConfigTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::ID);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::FILE);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::URL);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::RESPONSABLE_NOM);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::RESPONSABLE_PRENOM);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::TEL_FIXE);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::TEL_MOBILE);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::ADRESSE_VOIE_NUMERO);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::ADRESSE_CODEPOSTAL);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::ADRESSE_COMMUNE);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::SIRET);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::CREATED_AT);
            $criteria->addSelectColumn(CataloguePdfConfigTableMap::UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.FILE');
            $criteria->addSelectColumn($alias . '.URL');
            $criteria->addSelectColumn($alias . '.RESPONSABLE_NOM');
            $criteria->addSelectColumn($alias . '.RESPONSABLE_PRENOM');
            $criteria->addSelectColumn($alias . '.TEL_FIXE');
            $criteria->addSelectColumn($alias . '.TEL_MOBILE');
            $criteria->addSelectColumn($alias . '.ADRESSE_VOIE_NUMERO');
            $criteria->addSelectColumn($alias . '.ADRESSE_CODEPOSTAL');
            $criteria->addSelectColumn($alias . '.ADRESSE_COMMUNE');
            $criteria->addSelectColumn($alias . '.SIRET');
            $criteria->addSelectColumn($alias . '.CREATED_AT');
            $criteria->addSelectColumn($alias . '.UPDATED_AT');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(CataloguePdfConfigTableMap::DATABASE_NAME)->getTable(CataloguePdfConfigTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(CataloguePdfConfigTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(CataloguePdfConfigTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new CataloguePdfConfigTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a CataloguePdfConfig or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CataloguePdfConfig object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CataloguePdfConfigTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Catalogue\Model\CataloguePdfConfig) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CataloguePdfConfigTableMap::DATABASE_NAME);
            $criteria->add(CataloguePdfConfigTableMap::ID, (array) $values, Criteria::IN);
        }

        $query = CataloguePdfConfigQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { CataloguePdfConfigTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { CataloguePdfConfigTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the catalogue_pdf_config table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CataloguePdfConfigQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CataloguePdfConfig or Criteria object.
     *
     * @param mixed               $criteria Criteria or CataloguePdfConfig object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CataloguePdfConfigTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CataloguePdfConfig object
        }

        if ($criteria->containsKey(CataloguePdfConfigTableMap::ID) && $criteria->keyContainsValue(CataloguePdfConfigTableMap::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CataloguePdfConfigTableMap::ID.')');
        }


        // Set the correct dbName
        $query = CataloguePdfConfigQuery::create()->mergeWith($criteria);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = $query->doInsert($con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

} // CataloguePdfConfigTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CataloguePdfConfigTableMap::buildTableMap();
