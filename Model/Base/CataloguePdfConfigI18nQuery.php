<?php

namespace Catalogue\Model\Base;

use \Exception;
use \PDO;
use Catalogue\Model\CataloguePdfConfigI18n as ChildCataloguePdfConfigI18n;
use Catalogue\Model\CataloguePdfConfigI18nQuery as ChildCataloguePdfConfigI18nQuery;
use Catalogue\Model\Map\CataloguePdfConfigI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'catalogue_pdf_config_i18n' table.
 *
 *
 *
 * @method     ChildCataloguePdfConfigI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCataloguePdfConfigI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildCataloguePdfConfigI18nQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildCataloguePdfConfigI18nQuery orderBySubtitle($order = Criteria::ASC) Order by the subtitle column
 * @method     ChildCataloguePdfConfigI18nQuery orderByTitreDateDebut($order = Criteria::ASC) Order by the titre_date_debut column
 * @method     ChildCataloguePdfConfigI18nQuery orderByAlt($order = Criteria::ASC) Order by the alt column
 * @method     ChildCataloguePdfConfigI18nQuery orderByAdresseVoie($order = Criteria::ASC) Order by the adresse_voie column
 * @method     ChildCataloguePdfConfigI18nQuery orderByTexteSite($order = Criteria::ASC) Order by the texte_site column
 *
 * @method     ChildCataloguePdfConfigI18nQuery groupById() Group by the id column
 * @method     ChildCataloguePdfConfigI18nQuery groupByLocale() Group by the locale column
 * @method     ChildCataloguePdfConfigI18nQuery groupByTitle() Group by the title column
 * @method     ChildCataloguePdfConfigI18nQuery groupBySubtitle() Group by the subtitle column
 * @method     ChildCataloguePdfConfigI18nQuery groupByTitreDateDebut() Group by the titre_date_debut column
 * @method     ChildCataloguePdfConfigI18nQuery groupByAlt() Group by the alt column
 * @method     ChildCataloguePdfConfigI18nQuery groupByAdresseVoie() Group by the adresse_voie column
 * @method     ChildCataloguePdfConfigI18nQuery groupByTexteSite() Group by the texte_site column
 *
 * @method     ChildCataloguePdfConfigI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCataloguePdfConfigI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCataloguePdfConfigI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCataloguePdfConfigI18nQuery leftJoinCataloguePdfConfig($relationAlias = null) Adds a LEFT JOIN clause to the query using the CataloguePdfConfig relation
 * @method     ChildCataloguePdfConfigI18nQuery rightJoinCataloguePdfConfig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CataloguePdfConfig relation
 * @method     ChildCataloguePdfConfigI18nQuery innerJoinCataloguePdfConfig($relationAlias = null) Adds a INNER JOIN clause to the query using the CataloguePdfConfig relation
 *
 * @method     ChildCataloguePdfConfigI18n findOne(ConnectionInterface $con = null) Return the first ChildCataloguePdfConfigI18n matching the query
 * @method     ChildCataloguePdfConfigI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCataloguePdfConfigI18n matching the query, or a new ChildCataloguePdfConfigI18n object populated from the query conditions when no match is found
 *
 * @method     ChildCataloguePdfConfigI18n findOneById(int $id) Return the first ChildCataloguePdfConfigI18n filtered by the id column
 * @method     ChildCataloguePdfConfigI18n findOneByLocale(string $locale) Return the first ChildCataloguePdfConfigI18n filtered by the locale column
 * @method     ChildCataloguePdfConfigI18n findOneByTitle(string $title) Return the first ChildCataloguePdfConfigI18n filtered by the title column
 * @method     ChildCataloguePdfConfigI18n findOneBySubtitle(string $subtitle) Return the first ChildCataloguePdfConfigI18n filtered by the subtitle column
 * @method     ChildCataloguePdfConfigI18n findOneByTitreDateDebut(string $titre_date_debut) Return the first ChildCataloguePdfConfigI18n filtered by the titre_date_debut column
 * @method     ChildCataloguePdfConfigI18n findOneByAlt(string $alt) Return the first ChildCataloguePdfConfigI18n filtered by the alt column
 * @method     ChildCataloguePdfConfigI18n findOneByAdresseVoie(string $adresse_voie) Return the first ChildCataloguePdfConfigI18n filtered by the adresse_voie column
 * @method     ChildCataloguePdfConfigI18n findOneByTexteSite(string $texte_site) Return the first ChildCataloguePdfConfigI18n filtered by the texte_site column
 *
 * @method     array findById(int $id) Return ChildCataloguePdfConfigI18n objects filtered by the id column
 * @method     array findByLocale(string $locale) Return ChildCataloguePdfConfigI18n objects filtered by the locale column
 * @method     array findByTitle(string $title) Return ChildCataloguePdfConfigI18n objects filtered by the title column
 * @method     array findBySubtitle(string $subtitle) Return ChildCataloguePdfConfigI18n objects filtered by the subtitle column
 * @method     array findByTitreDateDebut(string $titre_date_debut) Return ChildCataloguePdfConfigI18n objects filtered by the titre_date_debut column
 * @method     array findByAlt(string $alt) Return ChildCataloguePdfConfigI18n objects filtered by the alt column
 * @method     array findByAdresseVoie(string $adresse_voie) Return ChildCataloguePdfConfigI18n objects filtered by the adresse_voie column
 * @method     array findByTexteSite(string $texte_site) Return ChildCataloguePdfConfigI18n objects filtered by the texte_site column
 *
 */
abstract class CataloguePdfConfigI18nQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Catalogue\Model\Base\CataloguePdfConfigI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\Catalogue\\Model\\CataloguePdfConfigI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCataloguePdfConfigI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCataloguePdfConfigI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \Catalogue\Model\CataloguePdfConfigI18nQuery) {
            return $criteria;
        }
        $query = new \Catalogue\Model\CataloguePdfConfigI18nQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCataloguePdfConfigI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CataloguePdfConfigI18nTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CataloguePdfConfigI18nTableMap::DATABASE_NAME);
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
     * @return   ChildCataloguePdfConfigI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, LOCALE, TITLE, SUBTITLE, TITRE_DATE_DEBUT, ALT, ADRESSE_VOIE, TEXTE_SITE FROM catalogue_pdf_config_i18n WHERE ID = :p0 AND LOCALE = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildCataloguePdfConfigI18n();
            $obj->hydrate($row);
            CataloguePdfConfigI18nTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildCataloguePdfConfigI18n|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CataloguePdfConfigI18nTableMap::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CataloguePdfConfigI18nTableMap::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CataloguePdfConfigI18nTableMap::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CataloguePdfConfigI18nTableMap::LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByCataloguePdfConfig()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CataloguePdfConfigI18nTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CataloguePdfConfigI18nTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigI18nTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigI18nTableMap::LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigI18nTableMap::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the subtitle column
     *
     * Example usage:
     * <code>
     * $query->filterBySubtitle('fooValue');   // WHERE subtitle = 'fooValue'
     * $query->filterBySubtitle('%fooValue%'); // WHERE subtitle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subtitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function filterBySubtitle($subtitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subtitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subtitle)) {
                $subtitle = str_replace('*', '%', $subtitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigI18nTableMap::SUBTITLE, $subtitle, $comparison);
    }

    /**
     * Filter the query on the titre_date_debut column
     *
     * Example usage:
     * <code>
     * $query->filterByTitreDateDebut('fooValue');   // WHERE titre_date_debut = 'fooValue'
     * $query->filterByTitreDateDebut('%fooValue%'); // WHERE titre_date_debut LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titreDateDebut The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function filterByTitreDateDebut($titreDateDebut = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titreDateDebut)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $titreDateDebut)) {
                $titreDateDebut = str_replace('*', '%', $titreDateDebut);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigI18nTableMap::TITRE_DATE_DEBUT, $titreDateDebut, $comparison);
    }

    /**
     * Filter the query on the alt column
     *
     * Example usage:
     * <code>
     * $query->filterByAlt('fooValue');   // WHERE alt = 'fooValue'
     * $query->filterByAlt('%fooValue%'); // WHERE alt LIKE '%fooValue%'
     * </code>
     *
     * @param     string $alt The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function filterByAlt($alt = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($alt)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $alt)) {
                $alt = str_replace('*', '%', $alt);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigI18nTableMap::ALT, $alt, $comparison);
    }

    /**
     * Filter the query on the adresse_voie column
     *
     * Example usage:
     * <code>
     * $query->filterByAdresseVoie('fooValue');   // WHERE adresse_voie = 'fooValue'
     * $query->filterByAdresseVoie('%fooValue%'); // WHERE adresse_voie LIKE '%fooValue%'
     * </code>
     *
     * @param     string $adresseVoie The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function filterByAdresseVoie($adresseVoie = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adresseVoie)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $adresseVoie)) {
                $adresseVoie = str_replace('*', '%', $adresseVoie);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigI18nTableMap::ADRESSE_VOIE, $adresseVoie, $comparison);
    }

    /**
     * Filter the query on the texte_site column
     *
     * Example usage:
     * <code>
     * $query->filterByTexteSite('fooValue');   // WHERE texte_site = 'fooValue'
     * $query->filterByTexteSite('%fooValue%'); // WHERE texte_site LIKE '%fooValue%'
     * </code>
     *
     * @param     string $texteSite The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function filterByTexteSite($texteSite = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($texteSite)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $texteSite)) {
                $texteSite = str_replace('*', '%', $texteSite);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CataloguePdfConfigI18nTableMap::TEXTE_SITE, $texteSite, $comparison);
    }

    /**
     * Filter the query by a related \Catalogue\Model\CataloguePdfConfig object
     *
     * @param \Catalogue\Model\CataloguePdfConfig|ObjectCollection $cataloguePdfConfig The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function filterByCataloguePdfConfig($cataloguePdfConfig, $comparison = null)
    {
        if ($cataloguePdfConfig instanceof \Catalogue\Model\CataloguePdfConfig) {
            return $this
                ->addUsingAlias(CataloguePdfConfigI18nTableMap::ID, $cataloguePdfConfig->getId(), $comparison);
        } elseif ($cataloguePdfConfig instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CataloguePdfConfigI18nTableMap::ID, $cataloguePdfConfig->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCataloguePdfConfig() only accepts arguments of type \Catalogue\Model\CataloguePdfConfig or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CataloguePdfConfig relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function joinCataloguePdfConfig($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CataloguePdfConfig');

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
            $this->addJoinObject($join, 'CataloguePdfConfig');
        }

        return $this;
    }

    /**
     * Use the CataloguePdfConfig relation CataloguePdfConfig object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Catalogue\Model\CataloguePdfConfigQuery A secondary query class using the current class as primary query
     */
    public function useCataloguePdfConfigQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinCataloguePdfConfig($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CataloguePdfConfig', '\Catalogue\Model\CataloguePdfConfigQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCataloguePdfConfigI18n $cataloguePdfConfigI18n Object to remove from the list of results
     *
     * @return ChildCataloguePdfConfigI18nQuery The current query, for fluid interface
     */
    public function prune($cataloguePdfConfigI18n = null)
    {
        if ($cataloguePdfConfigI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CataloguePdfConfigI18nTableMap::ID), $cataloguePdfConfigI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CataloguePdfConfigI18nTableMap::LOCALE), $cataloguePdfConfigI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the catalogue_pdf_config_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CataloguePdfConfigI18nTableMap::DATABASE_NAME);
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
            CataloguePdfConfigI18nTableMap::clearInstancePool();
            CataloguePdfConfigI18nTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildCataloguePdfConfigI18n or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildCataloguePdfConfigI18n object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CataloguePdfConfigI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CataloguePdfConfigI18nTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        CataloguePdfConfigI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CataloguePdfConfigI18nTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // CataloguePdfConfigI18nQuery
