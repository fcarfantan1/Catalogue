<?php

namespace Catalogue\Model\Base;

use \Exception;
use \PDO;
use Catalogue\Model\CataloguePdfConfig as ChildCataloguePdfConfig;
use Catalogue\Model\CataloguePdfConfigI18nQuery as ChildCataloguePdfConfigI18nQuery;
use Catalogue\Model\CataloguePdfConfigQuery as ChildCataloguePdfConfigQuery;
use Catalogue\Model\Map\CataloguePdfConfigTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'catalogue_pdf_config' table.
 *
 *
 *
 * @method     ChildCataloguePdfConfigQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCataloguePdfConfigQuery orderByFile($order = Criteria::ASC) Order by the file column
 * @method     ChildCataloguePdfConfigQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildCataloguePdfConfigQuery orderByResponsableNom($order = Criteria::ASC) Order by the responsable_nom column
 * @method     ChildCataloguePdfConfigQuery orderByResponsablePrenom($order = Criteria::ASC) Order by the responsable_prenom column
 * @method     ChildCataloguePdfConfigQuery orderByTelFixe($order = Criteria::ASC) Order by the tel_fixe column
 * @method     ChildCataloguePdfConfigQuery orderByTelMobile($order = Criteria::ASC) Order by the tel_mobile column
 * @method     ChildCataloguePdfConfigQuery orderByAdresseVoieNumero($order = Criteria::ASC) Order by the adresse_voie_numero column
 * @method     ChildCataloguePdfConfigQuery orderByAdresseCodepostal($order = Criteria::ASC) Order by the adresse_codepostal column
 * @method     ChildCataloguePdfConfigQuery orderByAdresseCommune($order = Criteria::ASC) Order by the adresse_commune column
 * @method     ChildCataloguePdfConfigQuery orderBySiret($order = Criteria::ASC) Order by the siret column
 * @method     ChildCataloguePdfConfigQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCataloguePdfConfigQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCataloguePdfConfigQuery groupById() Group by the id column
 * @method     ChildCataloguePdfConfigQuery groupByFile() Group by the file column
 * @method     ChildCataloguePdfConfigQuery groupByUrl() Group by the url column
 * @method     ChildCataloguePdfConfigQuery groupByResponsableNom() Group by the responsable_nom column
 * @method     ChildCataloguePdfConfigQuery groupByResponsablePrenom() Group by the responsable_prenom column
 * @method     ChildCataloguePdfConfigQuery groupByTelFixe() Group by the tel_fixe column
 * @method     ChildCataloguePdfConfigQuery groupByTelMobile() Group by the tel_mobile column
 * @method     ChildCataloguePdfConfigQuery groupByAdresseVoieNumero() Group by the adresse_voie_numero column
 * @method     ChildCataloguePdfConfigQuery groupByAdresseCodepostal() Group by the adresse_codepostal column
 * @method     ChildCataloguePdfConfigQuery groupByAdresseCommune() Group by the adresse_commune column
 * @method     ChildCataloguePdfConfigQuery groupBySiret() Group by the siret column
 * @method     ChildCataloguePdfConfigQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCataloguePdfConfigQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCataloguePdfConfigQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCataloguePdfConfigQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCataloguePdfConfigQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCataloguePdfConfigQuery leftJoinCataloguePdfConfigI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the CataloguePdfConfigI18n relation
 * @method     ChildCataloguePdfConfigQuery rightJoinCataloguePdfConfigI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CataloguePdfConfigI18n relation
 * @method     ChildCataloguePdfConfigQuery innerJoinCataloguePdfConfigI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the CataloguePdfConfigI18n relation
 *
 * @method     ChildCataloguePdfConfig findOne(ConnectionInterface $con = null) Return the first ChildCataloguePdfConfig matching the query
 * @method     ChildCataloguePdfConfig findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCataloguePdfConfig matching the query, or a new ChildCataloguePdfConfig object populated from the query conditions when no match is found
 *
 * @method     ChildCataloguePdfConfig findOneById(int $id) Return the first ChildCataloguePdfConfig filtered by the id column
 * @method     ChildCataloguePdfConfig findOneByFile(string $file) Return the first ChildCataloguePdfConfig filtered by the file column
 * @method     ChildCataloguePdfConfig findOneByUrl(string $url) Return the first ChildCataloguePdfConfig filtered by the url column
 * @method     ChildCataloguePdfConfig findOneByResponsableNom(string $responsable_nom) Return the first ChildCataloguePdfConfig filtered by the responsable_nom column
 * @method     ChildCataloguePdfConfig findOneByResponsablePrenom(string $responsable_prenom) Return the first ChildCataloguePdfConfig filtered by the responsable_prenom column
 * @method     ChildCataloguePdfConfig findOneByTelFixe(string $tel_fixe) Return the first ChildCataloguePdfConfig filtered by the tel_fixe column
 * @method     ChildCataloguePdfConfig findOneByTelMobile(string $tel_mobile) Return the first ChildCataloguePdfConfig filtered by the tel_mobile column
 * @method     ChildCataloguePdfConfig findOneByAdresseVoieNumero(string $adresse_voie_numero) Return the first ChildCataloguePdfConfig filtered by the adresse_voie_numero column
 * @method     ChildCataloguePdfConfig findOneByAdresseCodepostal(string $adresse_codepostal) Return the first ChildCataloguePdfConfig filtered by the adresse_codepostal column
 * @method     ChildCataloguePdfConfig findOneByAdresseCommune(string $adresse_commune) Return the first ChildCataloguePdfConfig filtered by the adresse_commune column
 * @method     ChildCataloguePdfConfig findOneBySiret(string $siret) Return the first ChildCataloguePdfConfig filtered by the siret column
 * @method     ChildCataloguePdfConfig findOneByCreatedAt(string $created_at) Return the first ChildCataloguePdfConfig filtered by the created_at column
 * @method     ChildCataloguePdfConfig findOneByUpdatedAt(string $updated_at) Return the first ChildCataloguePdfConfig filtered by the updated_at column
 *
 * @method     array findById(int $id) Return ChildCataloguePdfConfig objects filtered by the id column
 * @method     array findByFile(string $file) Return ChildCataloguePdfConfig objects filtered by the file column
 * @method     array findByUrl(string $url) Return ChildCataloguePdfConfig objects filtered by the url column
 * @method     array findByResponsableNom(string $responsable_nom) Return ChildCataloguePdfConfig objects filtered by the responsable_nom column
 * @method     array findByResponsablePrenom(string $responsable_prenom) Return ChildCataloguePdfConfig objects filtered by the responsable_prenom column
 * @method     array findByTelFixe(string $tel_fixe) Return ChildCataloguePdfConfig objects filtered by the tel_fixe column
 * @method     array findByTelMobile(string $tel_mobile) Return ChildCataloguePdfConfig objects filtered by the tel_mobile column
 * @method     array findByAdresseVoieNumero(string $adresse_voie_numero) Return ChildCataloguePdfConfig objects filtered by the adresse_voie_numero column
 * @method     array findByAdresseCodepostal(string $adresse_codepostal) Return ChildCataloguePdfConfig objects filtered by the adresse_codepostal column
 * @method     array findByAdresseCommune(string $adresse_commune) Return ChildCataloguePdfConfig objects filtered by the adresse_commune column
 * @method     array findBySiret(string $siret) Return ChildCataloguePdfConfig objects filtered by the siret column
 * @method     array findByCreatedAt(string $created_at) Return ChildCataloguePdfConfig objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildCataloguePdfConfig objects filtered by the updated_at column
 *
 */
abstract class CataloguePdfConfigQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Catalogue\Model\Base\CataloguePdfConfigQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\Catalogue\\Model\\CataloguePdfConfig', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCataloguePdfConfigQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCataloguePdfConfigQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \Catalogue\Model\CataloguePdfConfigQuery) {
            return $criteria;
        }
        $query = new \Catalogue\Model\CataloguePdfConfigQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCataloguePdfConfig|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CataloguePdfConfigTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CataloguePdfConfigTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildCataloguePdfConfig A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, FILE, URL, RESPONSABLE_NOM, RESPONSABLE_PRENOM, TEL_FIXE, TEL_MOBILE, ADRESSE_VOIE_NUMERO, ADRESSE_CODEPOSTAL, ADRESSE_COMMUNE, SIRET, CREATED_AT, UPDATED_AT FROM catalogue_pdf_config WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildCataloguePdfConfig();
            $obj->hydrate($row);
            CataloguePdfConfigTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCataloguePdfConfig|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CataloguePdfConfigTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CataloguePdfConfigTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CataloguePdfConfigTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CataloguePdfConfigTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the file column
     *
     * Example usage:
     * <code>
     * $query->filterByFile('fooValue');   // WHERE file = 'fooValue'
     * $query->filterByFile('%fooValue%'); // WHERE file LIKE '%fooValue%'
     * </code>
     *
     * @param     string $file The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByFile($file = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($file)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $file)) {
                $file = str_replace('*', '%', $file);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::FILE, $file, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::URL, $url, $comparison);
    }

    /**
     * Filter the query on the responsable_nom column
     *
     * Example usage:
     * <code>
     * $query->filterByResponsableNom('fooValue');   // WHERE responsable_nom = 'fooValue'
     * $query->filterByResponsableNom('%fooValue%'); // WHERE responsable_nom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $responsableNom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByResponsableNom($responsableNom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($responsableNom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $responsableNom)) {
                $responsableNom = str_replace('*', '%', $responsableNom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::RESPONSABLE_NOM, $responsableNom, $comparison);
    }

    /**
     * Filter the query on the responsable_prenom column
     *
     * Example usage:
     * <code>
     * $query->filterByResponsablePrenom('fooValue');   // WHERE responsable_prenom = 'fooValue'
     * $query->filterByResponsablePrenom('%fooValue%'); // WHERE responsable_prenom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $responsablePrenom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByResponsablePrenom($responsablePrenom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($responsablePrenom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $responsablePrenom)) {
                $responsablePrenom = str_replace('*', '%', $responsablePrenom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::RESPONSABLE_PRENOM, $responsablePrenom, $comparison);
    }

    /**
     * Filter the query on the tel_fixe column
     *
     * Example usage:
     * <code>
     * $query->filterByTelFixe('fooValue');   // WHERE tel_fixe = 'fooValue'
     * $query->filterByTelFixe('%fooValue%'); // WHERE tel_fixe LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telFixe The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByTelFixe($telFixe = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telFixe)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telFixe)) {
                $telFixe = str_replace('*', '%', $telFixe);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::TEL_FIXE, $telFixe, $comparison);
    }

    /**
     * Filter the query on the tel_mobile column
     *
     * Example usage:
     * <code>
     * $query->filterByTelMobile('fooValue');   // WHERE tel_mobile = 'fooValue'
     * $query->filterByTelMobile('%fooValue%'); // WHERE tel_mobile LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telMobile The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByTelMobile($telMobile = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telMobile)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telMobile)) {
                $telMobile = str_replace('*', '%', $telMobile);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::TEL_MOBILE, $telMobile, $comparison);
    }

    /**
     * Filter the query on the adresse_voie_numero column
     *
     * Example usage:
     * <code>
     * $query->filterByAdresseVoieNumero('fooValue');   // WHERE adresse_voie_numero = 'fooValue'
     * $query->filterByAdresseVoieNumero('%fooValue%'); // WHERE adresse_voie_numero LIKE '%fooValue%'
     * </code>
     *
     * @param     string $adresseVoieNumero The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByAdresseVoieNumero($adresseVoieNumero = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adresseVoieNumero)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $adresseVoieNumero)) {
                $adresseVoieNumero = str_replace('*', '%', $adresseVoieNumero);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::ADRESSE_VOIE_NUMERO, $adresseVoieNumero, $comparison);
    }

    /**
     * Filter the query on the adresse_codepostal column
     *
     * Example usage:
     * <code>
     * $query->filterByAdresseCodepostal('fooValue');   // WHERE adresse_codepostal = 'fooValue'
     * $query->filterByAdresseCodepostal('%fooValue%'); // WHERE adresse_codepostal LIKE '%fooValue%'
     * </code>
     *
     * @param     string $adresseCodepostal The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByAdresseCodepostal($adresseCodepostal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adresseCodepostal)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $adresseCodepostal)) {
                $adresseCodepostal = str_replace('*', '%', $adresseCodepostal);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::ADRESSE_CODEPOSTAL, $adresseCodepostal, $comparison);
    }

    /**
     * Filter the query on the adresse_commune column
     *
     * Example usage:
     * <code>
     * $query->filterByAdresseCommune('fooValue');   // WHERE adresse_commune = 'fooValue'
     * $query->filterByAdresseCommune('%fooValue%'); // WHERE adresse_commune LIKE '%fooValue%'
     * </code>
     *
     * @param     string $adresseCommune The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByAdresseCommune($adresseCommune = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adresseCommune)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $adresseCommune)) {
                $adresseCommune = str_replace('*', '%', $adresseCommune);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::ADRESSE_COMMUNE, $adresseCommune, $comparison);
    }

    /**
     * Filter the query on the siret column
     *
     * Example usage:
     * <code>
     * $query->filterBySiret('fooValue');   // WHERE siret = 'fooValue'
     * $query->filterBySiret('%fooValue%'); // WHERE siret LIKE '%fooValue%'
     * </code>
     *
     * @param     string $siret The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterBySiret($siret = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($siret)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $siret)) {
                $siret = str_replace('*', '%', $siret);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::SIRET, $siret, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CataloguePdfConfigTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CataloguePdfConfigTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CataloguePdfConfigTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CataloguePdfConfigTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Catalogue\Model\CataloguePdfConfigI18n object
     *
     * @param \Catalogue\Model\CataloguePdfConfigI18n|ObjectCollection $cataloguePdfConfigI18n  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function filterByCataloguePdfConfigI18n($cataloguePdfConfigI18n, $comparison = null)
    {
        if ($cataloguePdfConfigI18n instanceof \Catalogue\Model\CataloguePdfConfigI18n) {
            return $this
                ->addUsingAlias(CataloguePdfConfigTableMap::ID, $cataloguePdfConfigI18n->getId(), $comparison);
        } elseif ($cataloguePdfConfigI18n instanceof ObjectCollection) {
            return $this
                ->useCataloguePdfConfigI18nQuery()
                ->filterByPrimaryKeys($cataloguePdfConfigI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCataloguePdfConfigI18n() only accepts arguments of type \Catalogue\Model\CataloguePdfConfigI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CataloguePdfConfigI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function joinCataloguePdfConfigI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CataloguePdfConfigI18n');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'CataloguePdfConfigI18n');
        }

        return $this;
    }

    /**
     * Use the CataloguePdfConfigI18n relation CataloguePdfConfigI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Catalogue\Model\CataloguePdfConfigI18nQuery A secondary query class using the current class as primary query
     */
    public function useCataloguePdfConfigI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinCataloguePdfConfigI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CataloguePdfConfigI18n', '\Catalogue\Model\CataloguePdfConfigI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCataloguePdfConfig $cataloguePdfConfig Object to remove from the list of results
     *
     * @return ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function prune($cataloguePdfConfig = null)
    {
        if ($cataloguePdfConfig) {
            $this->addUsingAlias(CataloguePdfConfigTableMap::ID, $cataloguePdfConfig->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the catalogue_pdf_config table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CataloguePdfConfigTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CataloguePdfConfigTableMap::clearInstancePool();
            CataloguePdfConfigTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildCataloguePdfConfig or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildCataloguePdfConfig object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CataloguePdfConfigTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CataloguePdfConfigTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        CataloguePdfConfigTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CataloguePdfConfigTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(CataloguePdfConfigTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(CataloguePdfConfigTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(CataloguePdfConfigTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(CataloguePdfConfigTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(CataloguePdfConfigTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(CataloguePdfConfigTableMap::CREATED_AT);
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'CataloguePdfConfigI18n';

        return $this
            ->joinCataloguePdfConfigI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildCataloguePdfConfigQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('CataloguePdfConfigI18n');
        $this->with['CataloguePdfConfigI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildCataloguePdfConfigI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CataloguePdfConfigI18n', '\Catalogue\Model\CataloguePdfConfigI18nQuery');
    }

} // CataloguePdfConfigQuery
