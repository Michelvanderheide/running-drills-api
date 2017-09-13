<?php

namespace Base;

use \Drill as ChildDrill;
use \DrillQuery as ChildDrillQuery;
use \Exception;
use \PDO;
use Map\DrillTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'drill' table.
 *
 *
 *
 * @method     ChildDrillQuery orderByDrillPk($order = Criteria::ASC) Order by the drill_pk column
 * @method     ChildDrillQuery orderByGuid($order = Criteria::ASC) Order by the guid column
 * @method     ChildDrillQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDrillQuery orderByCategoryFk($order = Criteria::ASC) Order by the category_fk column
 * @method     ChildDrillQuery orderByDrillTitle($order = Criteria::ASC) Order by the drill_title column
 * @method     ChildDrillQuery orderByDrillDescription($order = Criteria::ASC) Order by the drill_description column
 * @method     ChildDrillQuery orderByDrillDescriptionHtml($order = Criteria::ASC) Order by the drill_description_html column
 * @method     ChildDrillQuery orderByDrillIntervals($order = Criteria::ASC) Order by the drill_intervals column
 * @method     ChildDrillQuery orderByDrillImage($order = Criteria::ASC) Order by the drill_image column
 * @method     ChildDrillQuery orderByDrillVideo($order = Criteria::ASC) Order by the drill_video column
 *
 * @method     ChildDrillQuery groupByDrillPk() Group by the drill_pk column
 * @method     ChildDrillQuery groupByGuid() Group by the guid column
 * @method     ChildDrillQuery groupById() Group by the id column
 * @method     ChildDrillQuery groupByCategoryFk() Group by the category_fk column
 * @method     ChildDrillQuery groupByDrillTitle() Group by the drill_title column
 * @method     ChildDrillQuery groupByDrillDescription() Group by the drill_description column
 * @method     ChildDrillQuery groupByDrillDescriptionHtml() Group by the drill_description_html column
 * @method     ChildDrillQuery groupByDrillIntervals() Group by the drill_intervals column
 * @method     ChildDrillQuery groupByDrillImage() Group by the drill_image column
 * @method     ChildDrillQuery groupByDrillVideo() Group by the drill_video column
 *
 * @method     ChildDrillQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDrillQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDrillQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDrillQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDrillQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDrillQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDrillQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ChildDrillQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ChildDrillQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ChildDrillQuery joinWithCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Category relation
 *
 * @method     ChildDrillQuery leftJoinWithCategory() Adds a LEFT JOIN clause and with to the query using the Category relation
 * @method     ChildDrillQuery rightJoinWithCategory() Adds a RIGHT JOIN clause and with to the query using the Category relation
 * @method     ChildDrillQuery innerJoinWithCategory() Adds a INNER JOIN clause and with to the query using the Category relation
 *
 * @method     ChildDrillQuery leftJoinSessionDrill($relationAlias = null) Adds a LEFT JOIN clause to the query using the SessionDrill relation
 * @method     ChildDrillQuery rightJoinSessionDrill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SessionDrill relation
 * @method     ChildDrillQuery innerJoinSessionDrill($relationAlias = null) Adds a INNER JOIN clause to the query using the SessionDrill relation
 *
 * @method     ChildDrillQuery joinWithSessionDrill($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SessionDrill relation
 *
 * @method     ChildDrillQuery leftJoinWithSessionDrill() Adds a LEFT JOIN clause and with to the query using the SessionDrill relation
 * @method     ChildDrillQuery rightJoinWithSessionDrill() Adds a RIGHT JOIN clause and with to the query using the SessionDrill relation
 * @method     ChildDrillQuery innerJoinWithSessionDrill() Adds a INNER JOIN clause and with to the query using the SessionDrill relation
 *
 * @method     ChildDrillQuery leftJoinDrillTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the DrillTag relation
 * @method     ChildDrillQuery rightJoinDrillTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DrillTag relation
 * @method     ChildDrillQuery innerJoinDrillTag($relationAlias = null) Adds a INNER JOIN clause to the query using the DrillTag relation
 *
 * @method     ChildDrillQuery joinWithDrillTag($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DrillTag relation
 *
 * @method     ChildDrillQuery leftJoinWithDrillTag() Adds a LEFT JOIN clause and with to the query using the DrillTag relation
 * @method     ChildDrillQuery rightJoinWithDrillTag() Adds a RIGHT JOIN clause and with to the query using the DrillTag relation
 * @method     ChildDrillQuery innerJoinWithDrillTag() Adds a INNER JOIN clause and with to the query using the DrillTag relation
 *
 * @method     \CategoryQuery|\SessionDrillQuery|\DrillTagQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDrill findOne(ConnectionInterface $con = null) Return the first ChildDrill matching the query
 * @method     ChildDrill findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDrill matching the query, or a new ChildDrill object populated from the query conditions when no match is found
 *
 * @method     ChildDrill findOneByDrillPk(int $drill_pk) Return the first ChildDrill filtered by the drill_pk column
 * @method     ChildDrill findOneByGuid(string $guid) Return the first ChildDrill filtered by the guid column
 * @method     ChildDrill findOneById(string $id) Return the first ChildDrill filtered by the id column
 * @method     ChildDrill findOneByCategoryFk(int $category_fk) Return the first ChildDrill filtered by the category_fk column
 * @method     ChildDrill findOneByDrillTitle(string $drill_title) Return the first ChildDrill filtered by the drill_title column
 * @method     ChildDrill findOneByDrillDescription(string $drill_description) Return the first ChildDrill filtered by the drill_description column
 * @method     ChildDrill findOneByDrillDescriptionHtml(string $drill_description_html) Return the first ChildDrill filtered by the drill_description_html column
 * @method     ChildDrill findOneByDrillIntervals(string $drill_intervals) Return the first ChildDrill filtered by the drill_intervals column
 * @method     ChildDrill findOneByDrillImage(string $drill_image) Return the first ChildDrill filtered by the drill_image column
 * @method     ChildDrill findOneByDrillVideo(string $drill_video) Return the first ChildDrill filtered by the drill_video column *

 * @method     ChildDrill requirePk($key, ConnectionInterface $con = null) Return the ChildDrill by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrill requireOne(ConnectionInterface $con = null) Return the first ChildDrill matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDrill requireOneByDrillPk(int $drill_pk) Return the first ChildDrill filtered by the drill_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrill requireOneByGuid(string $guid) Return the first ChildDrill filtered by the guid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrill requireOneById(string $id) Return the first ChildDrill filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrill requireOneByCategoryFk(int $category_fk) Return the first ChildDrill filtered by the category_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrill requireOneByDrillTitle(string $drill_title) Return the first ChildDrill filtered by the drill_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrill requireOneByDrillDescription(string $drill_description) Return the first ChildDrill filtered by the drill_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrill requireOneByDrillDescriptionHtml(string $drill_description_html) Return the first ChildDrill filtered by the drill_description_html column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrill requireOneByDrillIntervals(string $drill_intervals) Return the first ChildDrill filtered by the drill_intervals column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrill requireOneByDrillImage(string $drill_image) Return the first ChildDrill filtered by the drill_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrill requireOneByDrillVideo(string $drill_video) Return the first ChildDrill filtered by the drill_video column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDrill[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDrill objects based on current ModelCriteria
 * @method     ChildDrill[]|ObjectCollection findByDrillPk(int $drill_pk) Return ChildDrill objects filtered by the drill_pk column
 * @method     ChildDrill[]|ObjectCollection findByGuid(string $guid) Return ChildDrill objects filtered by the guid column
 * @method     ChildDrill[]|ObjectCollection findById(string $id) Return ChildDrill objects filtered by the id column
 * @method     ChildDrill[]|ObjectCollection findByCategoryFk(int $category_fk) Return ChildDrill objects filtered by the category_fk column
 * @method     ChildDrill[]|ObjectCollection findByDrillTitle(string $drill_title) Return ChildDrill objects filtered by the drill_title column
 * @method     ChildDrill[]|ObjectCollection findByDrillDescription(string $drill_description) Return ChildDrill objects filtered by the drill_description column
 * @method     ChildDrill[]|ObjectCollection findByDrillDescriptionHtml(string $drill_description_html) Return ChildDrill objects filtered by the drill_description_html column
 * @method     ChildDrill[]|ObjectCollection findByDrillIntervals(string $drill_intervals) Return ChildDrill objects filtered by the drill_intervals column
 * @method     ChildDrill[]|ObjectCollection findByDrillImage(string $drill_image) Return ChildDrill objects filtered by the drill_image column
 * @method     ChildDrill[]|ObjectCollection findByDrillVideo(string $drill_video) Return ChildDrill objects filtered by the drill_video column
 * @method     ChildDrill[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DrillQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DrillQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\Drill', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDrillQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDrillQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDrillQuery) {
            return $criteria;
        }
        $query = new ChildDrillQuery();
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
     * @return ChildDrill|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DrillTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DrillTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDrill A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT drill_pk, guid, id, category_fk, drill_title, drill_description, drill_description_html, drill_intervals, drill_image, drill_video FROM drill WHERE drill_pk = :p0';
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
            /** @var ChildDrill $obj */
            $obj = new ChildDrill();
            $obj->hydrate($row);
            DrillTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDrill|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
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
    public function findPks($keys, ConnectionInterface $con = null)
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
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DrillTableMap::COL_DRILL_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DrillTableMap::COL_DRILL_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the drill_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByDrillPk(1234); // WHERE drill_pk = 1234
     * $query->filterByDrillPk(array(12, 34)); // WHERE drill_pk IN (12, 34)
     * $query->filterByDrillPk(array('min' => 12)); // WHERE drill_pk > 12
     * </code>
     *
     * @param     mixed $drillPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterByDrillPk($drillPk = null, $comparison = null)
    {
        if (is_array($drillPk)) {
            $useMinMax = false;
            if (isset($drillPk['min'])) {
                $this->addUsingAlias(DrillTableMap::COL_DRILL_PK, $drillPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($drillPk['max'])) {
                $this->addUsingAlias(DrillTableMap::COL_DRILL_PK, $drillPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTableMap::COL_DRILL_PK, $drillPk, $comparison);
    }

    /**
     * Filter the query on the guid column
     *
     * Example usage:
     * <code>
     * $query->filterByGuid('fooValue');   // WHERE guid = 'fooValue'
     * $query->filterByGuid('%fooValue%', Criteria::LIKE); // WHERE guid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $guid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterByGuid($guid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($guid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTableMap::COL_GUID, $guid, $comparison);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the category_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryFk(1234); // WHERE category_fk = 1234
     * $query->filterByCategoryFk(array(12, 34)); // WHERE category_fk IN (12, 34)
     * $query->filterByCategoryFk(array('min' => 12)); // WHERE category_fk > 12
     * </code>
     *
     * @see       filterByCategory()
     *
     * @param     mixed $categoryFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterByCategoryFk($categoryFk = null, $comparison = null)
    {
        if (is_array($categoryFk)) {
            $useMinMax = false;
            if (isset($categoryFk['min'])) {
                $this->addUsingAlias(DrillTableMap::COL_CATEGORY_FK, $categoryFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryFk['max'])) {
                $this->addUsingAlias(DrillTableMap::COL_CATEGORY_FK, $categoryFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTableMap::COL_CATEGORY_FK, $categoryFk, $comparison);
    }

    /**
     * Filter the query on the drill_title column
     *
     * Example usage:
     * <code>
     * $query->filterByDrillTitle('fooValue');   // WHERE drill_title = 'fooValue'
     * $query->filterByDrillTitle('%fooValue%', Criteria::LIKE); // WHERE drill_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $drillTitle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterByDrillTitle($drillTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drillTitle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTableMap::COL_DRILL_TITLE, $drillTitle, $comparison);
    }

    /**
     * Filter the query on the drill_description column
     *
     * Example usage:
     * <code>
     * $query->filterByDrillDescription('fooValue');   // WHERE drill_description = 'fooValue'
     * $query->filterByDrillDescription('%fooValue%', Criteria::LIKE); // WHERE drill_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $drillDescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterByDrillDescription($drillDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drillDescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTableMap::COL_DRILL_DESCRIPTION, $drillDescription, $comparison);
    }

    /**
     * Filter the query on the drill_description_html column
     *
     * Example usage:
     * <code>
     * $query->filterByDrillDescriptionHtml('fooValue');   // WHERE drill_description_html = 'fooValue'
     * $query->filterByDrillDescriptionHtml('%fooValue%', Criteria::LIKE); // WHERE drill_description_html LIKE '%fooValue%'
     * </code>
     *
     * @param     string $drillDescriptionHtml The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterByDrillDescriptionHtml($drillDescriptionHtml = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drillDescriptionHtml)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTableMap::COL_DRILL_DESCRIPTION_HTML, $drillDescriptionHtml, $comparison);
    }

    /**
     * Filter the query on the drill_intervals column
     *
     * Example usage:
     * <code>
     * $query->filterByDrillIntervals('fooValue');   // WHERE drill_intervals = 'fooValue'
     * $query->filterByDrillIntervals('%fooValue%', Criteria::LIKE); // WHERE drill_intervals LIKE '%fooValue%'
     * </code>
     *
     * @param     string $drillIntervals The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterByDrillIntervals($drillIntervals = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drillIntervals)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTableMap::COL_DRILL_INTERVALS, $drillIntervals, $comparison);
    }

    /**
     * Filter the query on the drill_image column
     *
     * Example usage:
     * <code>
     * $query->filterByDrillImage('fooValue');   // WHERE drill_image = 'fooValue'
     * $query->filterByDrillImage('%fooValue%', Criteria::LIKE); // WHERE drill_image LIKE '%fooValue%'
     * </code>
     *
     * @param     string $drillImage The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterByDrillImage($drillImage = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drillImage)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTableMap::COL_DRILL_IMAGE, $drillImage, $comparison);
    }

    /**
     * Filter the query on the drill_video column
     *
     * Example usage:
     * <code>
     * $query->filterByDrillVideo('fooValue');   // WHERE drill_video = 'fooValue'
     * $query->filterByDrillVideo('%fooValue%', Criteria::LIKE); // WHERE drill_video LIKE '%fooValue%'
     * </code>
     *
     * @param     string $drillVideo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function filterByDrillVideo($drillVideo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drillVideo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTableMap::COL_DRILL_VIDEO, $drillVideo, $comparison);
    }

    /**
     * Filter the query by a related \Category object
     *
     * @param \Category|ObjectCollection $category The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDrillQuery The current query, for fluid interface
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof \Category) {
            return $this
                ->addUsingAlias(DrillTableMap::COL_CATEGORY_FK, $category->getCategoryPk(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DrillTableMap::COL_CATEGORY_FK, $category->toKeyValue('PrimaryKey', 'CategoryPk'), $comparison);
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type \Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

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
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', '\CategoryQuery');
    }

    /**
     * Filter the query by a related \SessionDrill object
     *
     * @param \SessionDrill|ObjectCollection $sessionDrill the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDrillQuery The current query, for fluid interface
     */
    public function filterBySessionDrill($sessionDrill, $comparison = null)
    {
        if ($sessionDrill instanceof \SessionDrill) {
            return $this
                ->addUsingAlias(DrillTableMap::COL_DRILL_PK, $sessionDrill->getDrillFk(), $comparison);
        } elseif ($sessionDrill instanceof ObjectCollection) {
            return $this
                ->useSessionDrillQuery()
                ->filterByPrimaryKeys($sessionDrill->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySessionDrill() only accepts arguments of type \SessionDrill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SessionDrill relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function joinSessionDrill($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SessionDrill');

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
            $this->addJoinObject($join, 'SessionDrill');
        }

        return $this;
    }

    /**
     * Use the SessionDrill relation SessionDrill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SessionDrillQuery A secondary query class using the current class as primary query
     */
    public function useSessionDrillQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSessionDrill($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SessionDrill', '\SessionDrillQuery');
    }

    /**
     * Filter the query by a related \DrillTag object
     *
     * @param \DrillTag|ObjectCollection $drillTag the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDrillQuery The current query, for fluid interface
     */
    public function filterByDrillTag($drillTag, $comparison = null)
    {
        if ($drillTag instanceof \DrillTag) {
            return $this
                ->addUsingAlias(DrillTableMap::COL_DRILL_PK, $drillTag->getDrillFk(), $comparison);
        } elseif ($drillTag instanceof ObjectCollection) {
            return $this
                ->useDrillTagQuery()
                ->filterByPrimaryKeys($drillTag->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDrillTag() only accepts arguments of type \DrillTag or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DrillTag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function joinDrillTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DrillTag');

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
            $this->addJoinObject($join, 'DrillTag');
        }

        return $this;
    }

    /**
     * Use the DrillTag relation DrillTag object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DrillTagQuery A secondary query class using the current class as primary query
     */
    public function useDrillTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDrillTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DrillTag', '\DrillTagQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDrill $drill Object to remove from the list of results
     *
     * @return $this|ChildDrillQuery The current query, for fluid interface
     */
    public function prune($drill = null)
    {
        if ($drill) {
            $this->addUsingAlias(DrillTableMap::COL_DRILL_PK, $drill->getDrillPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the drill table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DrillTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DrillTableMap::clearInstancePool();
            DrillTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DrillTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DrillTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DrillTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DrillTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DrillQuery
