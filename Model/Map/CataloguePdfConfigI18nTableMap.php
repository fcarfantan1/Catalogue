<?php

namespace Catalogue\Model\Map;

use Catalogue\Model\CataloguePdfConfigI18n;
use Catalogue\Model\CataloguePdfConfigI18nQuery;
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
 * This class defines the structure of the 'catalogue_pdf_config_i18n' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CataloguePdfConfigI18nTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Catalogue.Model.Map.CataloguePdfConfigI18nTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'catalogue_pdf_config_i18n';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Catalogue\\Model\\CataloguePdfConfigI18n';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Catalogue.Model.CataloguePdfConfigI18n';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the ID field
     */
    const ID = 'catalogue_pdf_config_i18n.ID';

    /**
     * the column name for the LOCALE field
     */
    const LOCALE = 'catalogue_pdf_config_i18n.LOCALE';

    /**
     * the column name for the TITLE field
     */
    const TITLE = 'catalogue_pdf_config_i18n.TITLE';

    /**
     * the column name for the SUBTITLE field
     */
    const SUBTITLE = 'catalogue_pdf_config_i18n.SUBTITLE';

    /**
     * the column name for the TITRE_DATE_DEBUT field
     */
    const TITRE_DATE_DEBUT = 'catalogue_pdf_config_i18n.TITRE_DATE_DEBUT';

    /**
     * the column name for the ALT field
     */
    const ALT = 'catalogue_pdf_config_i18n.ALT';

    /**
     * the column name for the ADRESSE_VOIE field
     */
    const ADRESSE_VOIE = 'catalogue_pdf_config_i18n.ADRESSE_VOIE';

    /**
     * the column name for the TEXTE_SITE field
     */
    const TEXTE_SITE = 'catalogue_pdf_config_i18n.TEXTE_SITE';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Locale', 'Title', 'Subtitle', 'TitreDateDebut', 'Alt', 'AdresseVoie', 'TexteSite', ),
        self::TYPE_STUDLYPHPNAME => array('id', 'locale', 'title', 'subtitle', 'titreDateDebut', 'alt', 'adresseVoie', 'texteSite', ),
        self::TYPE_COLNAME       => array(CataloguePdfConfigI18nTableMap::ID, CataloguePdfConfigI18nTableMap::LOCALE, CataloguePdfConfigI18nTableMap::TITLE, CataloguePdfConfigI18nTableMap::SUBTITLE, CataloguePdfConfigI18nTableMap::TITRE_DATE_DEBUT, CataloguePdfConfigI18nTableMap::ALT, CataloguePdfConfigI18nTableMap::ADRESSE_VOIE, CataloguePdfConfigI18nTableMap::TEXTE_SITE, ),
        self::TYPE_RAW_COLNAME   => array('ID', 'LOCALE', 'TITLE', 'SUBTITLE', 'TITRE_DATE_DEBUT', 'ALT', 'ADRESSE_VOIE', 'TEXTE_SITE', ),
        self::TYPE_FIELDNAME     => array('id', 'locale', 'title', 'subtitle', 'titre_date_debut', 'alt', 'adresse_voie', 'texte_site', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Locale' => 1, 'Title' => 2, 'Subtitle' => 3, 'TitreDateDebut' => 4, 'Alt' => 5, 'AdresseVoie' => 6, 'TexteSite' => 7, ),
        self::TYPE_STUDLYPHPNAME => array('id' => 0, 'locale' => 1, 'title' => 2, 'subtitle' => 3, 'titreDateDebut' => 4, 'alt' => 5, 'adresseVoie' => 6, 'texteSite' => 7, ),
        self::TYPE_COLNAME       => array(CataloguePdfConfigI18nTableMap::ID => 0, CataloguePdfConfigI18nTableMap::LOCALE => 1, CataloguePdfConfigI18nTableMap::TITLE => 2, CataloguePdfConfigI18nTableMap::SUBTITLE => 3, CataloguePdfConfigI18nTableMap::TITRE_DATE_DEBUT => 4, CataloguePdfConfigI18nTableMap::ALT => 5, CataloguePdfConfigI18nTableMap::ADRESSE_VOIE => 6, CataloguePdfConfigI18nTableMap::TEXTE_SITE => 7, ),
        self::TYPE_RAW_COLNAME   => array('ID' => 0, 'LOCALE' => 1, 'TITLE' => 2, 'SUBTITLE' => 3, 'TITRE_DATE_DEBUT' => 4, 'ALT' => 5, 'ADRESSE_VOIE' => 6, 'TEXTE_SITE' => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'locale' => 1, 'title' => 2, 'subtitle' => 3, 'titre_date_debut' => 4, 'alt' => 5, 'adresse_voie' => 6, 'texte_site' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('catalogue_pdf_config_i18n');
        $this->setPhpName('CataloguePdfConfigI18n');
        $this->setClassName('\\Catalogue\\Model\\CataloguePdfConfigI18n');
        $this->setPackage('Catalogue.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'catalogue_pdf_config', 'ID', true, null, null);
        $this->addPrimaryKey('LOCALE', 'Locale', 'VARCHAR', true, 5, 'en_US');
        $this->addColumn('TITLE', 'Title', 'VARCHAR', false, 255, null);
        $this->addColumn('SUBTITLE', 'Subtitle', 'VARCHAR', false, 255, null);
        $this->addColumn('TITRE_DATE_DEBUT', 'TitreDateDebut', 'VARCHAR', false, 255, null);
        $this->addColumn('ALT', 'Alt', 'VARCHAR', false, 255, null);
        $this->addColumn('ADRESSE_VOIE', 'AdresseVoie', 'VARCHAR', false, 255, null);
        $this->addColumn('TEXTE_SITE', 'TexteSite', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CataloguePdfConfig', '\\Catalogue\\Model\\CataloguePdfConfig', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Catalogue\Model\CataloguePdfConfigI18n $obj A \Catalogue\Model\CataloguePdfConfigI18n object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getId(), (string) $obj->getLocale()));
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Catalogue\Model\CataloguePdfConfigI18n object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Catalogue\Model\CataloguePdfConfigI18n) {
                $key = serialize(array((string) $value->getId(), (string) $value->getLocale()));

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Catalogue\Model\CataloguePdfConfigI18n object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Locale', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Locale', TableMap::TYPE_PHPNAME, $indexType)]));
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

            return $pks;
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
        return $withPrefix ? CataloguePdfConfigI18nTableMap::CLASS_DEFAULT : CataloguePdfConfigI18nTableMap::OM_CLASS;
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
     * @return array (CataloguePdfConfigI18n object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CataloguePdfConfigI18nTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CataloguePdfConfigI18nTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CataloguePdfConfigI18nTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CataloguePdfConfigI18nTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CataloguePdfConfigI18nTableMap::addInstanceToPool($obj, $key);
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
            $key = CataloguePdfConfigI18nTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CataloguePdfConfigI18nTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CataloguePdfConfigI18nTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CataloguePdfConfigI18nTableMap::ID);
            $criteria->addSelectColumn(CataloguePdfConfigI18nTableMap::LOCALE);
            $criteria->addSelectColumn(CataloguePdfConfigI18nTableMap::TITLE);
            $criteria->addSelectColumn(CataloguePdfConfigI18nTableMap::SUBTITLE);
            $criteria->addSelectColumn(CataloguePdfConfigI18nTableMap::TITRE_DATE_DEBUT);
            $criteria->addSelectColumn(CataloguePdfConfigI18nTableMap::ALT);
            $criteria->addSelectColumn(CataloguePdfConfigI18nTableMap::ADRESSE_VOIE);
            $criteria->addSelectColumn(CataloguePdfConfigI18nTableMap::TEXTE_SITE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.LOCALE');
            $criteria->addSelectColumn($alias . '.TITLE');
            $criteria->addSelectColumn($alias . '.SUBTITLE');
            $criteria->addSelectColumn($alias . '.TITRE_DATE_DEBUT');
            $criteria->addSelectColumn($alias . '.ALT');
            $criteria->addSelectColumn($alias . '.ADRESSE_VOIE');
            $criteria->addSelectColumn($alias . '.TEXTE_SITE');
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
        return Propel::getServiceContainer()->getDatabaseMap(CataloguePdfConfigI18nTableMap::DATABASE_NAME)->getTable(CataloguePdfConfigI18nTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(CataloguePdfConfigI18nTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(CataloguePdfConfigI18nTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new CataloguePdfConfigI18nTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a CataloguePdfConfigI18n or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CataloguePdfConfigI18n object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CataloguePdfConfigI18nTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Catalogue\Model\CataloguePdfConfigI18n) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CataloguePdfConfigI18nTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(CataloguePdfConfigI18nTableMap::ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(CataloguePdfConfigI18nTableMap::LOCALE, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = CataloguePdfConfigI18nQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { CataloguePdfConfigI18nTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { CataloguePdfConfigI18nTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the catalogue_pdf_config_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CataloguePdfConfigI18nQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CataloguePdfConfigI18n or Criteria object.
     *
     * @param mixed               $criteria Criteria or CataloguePdfConfigI18n object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CataloguePdfConfigI18nTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CataloguePdfConfigI18n object
        }


        // Set the correct dbName
        $query = CataloguePdfConfigI18nQuery::create()->mergeWith($criteria);

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

} // CataloguePdfConfigI18nTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CataloguePdfConfigI18nTableMap::buildTableMap();
