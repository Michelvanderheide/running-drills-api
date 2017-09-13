<?php

namespace Base;

use \DrillCategoryMapping as ChildDrillCategoryMapping;
use \DrillCategoryMappingQuery as ChildDrillCategoryMappingQuery;
use \Exception;
use \PDO;
use Map\DrillCategoryMappingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'drill_category_mapping' table.
 *
 *
 *
 * @method     ChildDrillCategoryMappingQuery orderByDrillCategoryMappingPk($order = Criteria::ASC) Order by the drill_category_mapping_pk column
 * @method     ChildDrillCategoryMappingQuery orderByDrillFk($order = Criteria::ASC) Order by the drill_fk column
 * @method     ChildDrillCategoryMappingQuery orderByCategoryFk($order = Criteria::ASC) Order by the category_fk column
 *
 * @method     ChildDrillCategoryMappingQuery groupByDrillCategoryMappingPk() Group by the drill_category_mapping_pk column
 * @method     ChildDrillCategoryMappingQuery groupByDrillFk() Group by the drill_fk column
 * @method     ChildDrillCategoryMappingQuery groupByCategoryFk() Group by the category_fk column
 *
 * @method     ChildDrillCategoryMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDrillCategoryMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDrillCategoryMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDrillCategoryMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDrillCategoryMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDrillCategoryMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDrillCategoryMappingQuery leftJoinDrill($relationAlias = null) Adds a LEFT JOIN clause to the query using the Drill relation
 * @method     ChildDrillCategoryMappingQuery rightJoinDrill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Drill relation
 * @method     ChildDrillCategoryMappingQuery innerJoinDrill($relationAlias = null) Adds a INNER JOIN clause to the query using the Drill relation
 *
 * @method     ChildDrillCategoryMappingQuery joinWithDrill($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Drill relation
 *
 * @method     ChildDrillCategoryMappingQuery leftJoinWithDrill() Adds a LEFT JOIN clause and with to the query using the Drill relation
 * @method     ChildDrillCategoryMappingQuery rightJoinWithDrill() Adds a RIGHT JOIN clause and with to the query using the Drill relation
 * @method     ChildDrillCategoryMappingQuery innerJoinWithDrill() Adds a INNER JOIN clause and with to the query using the Drill relation
 *
 * @method     ChildDrillCategoryMappingQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ChildDrillCategoryMappingQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ChildDrillCategoryMappingQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ChildDrillCategoryMappingQuery joinWithCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Category relation
 *
 * @method     ChildDrillCategoryMappingQuery leftJoinWithCategory() Adds a LEFT JOIN clause and with to the query using the Category relation
 * @method     ChildDrillCategoryMappingQuery rightJoinWithCategory() Adds a RIGHT JOIN clause and with to the query using the Category relation
 * @method     ChildDrillCategoryMappingQuery innerJoinWithCategory() Adds a INNER JOIN clause and with to the query using the Category relation
 *
 * @method     \DrillQuery|\CategoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDrillCategoryMapping findOne(ConnectionInterface $con = null) Return the first ChildDrillCategoryMapping matching the query
 * @method     ChildDrillCategoryMapping findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDrillCategoryMapping matching the query, or a new ChildDrillCategoryMapping object populated from the query conditions when no match is found
 *
 * @method     ChildDrillCategoryMapping findOneByDrillCategoryMappingPk(int $drill_category_mapping_pk) Return the first ChildDrillCategoryMapping filtered by the drill_category_mapping_pk column
 * @method     ChildDrillCategoryMapping findOneByDrillFk(int $drill_fk) Return the first ChildDrillCategoryMapping filtered by the drill_fk column
 * @method     ChildDrillCategoryMapping findOneByCategoryFk(int $category_fk) Return the first ChildDrillCategoryMapping filtered by the category_fk column *

 * @method     ChildDrillCategoryMapping requirePk($key, ConnectionInterface $con = null) Return the ChildDrillCategoryMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrillCategoryMapping requireOne(ConnectionInterface $con = null) Return the first ChildDrillCategoryMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDrillCategoryMapping requireOneByDrillCategoryMappingPk(int $drill_category_mapping_pk) Return the first ChildDrillCategoryMapping filtered by the drill_category_mapping_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrillCategoryMapping requireOneByDrillFk(int $drill_fk) Return the first ChildDrillCategoryMapping filtered by the drill_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrillCategoryMapping requireOneByCategoryFk(int $category_fk) Return the first ChildDrillCategoryMapping filtered by the category_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDrillCategoryMapping[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDrillCategoryMapping objects based on current ModelCriteria
 * @method     ChildDrillCategoryMapping[]|ObjectCollection findByDrillCategoryMappingPk(int $drill_category_mapping_pk) Return ChildDrillCategoryMapping objects filtered by the drill_category_mapping_pk column
 * @method     ChildDrillCategoryMapping[]|ObjectCollection findByDrillFk(int $drill_fk) Return ChildDrillCategoryMapping objects filtered by the drill_fk column
 * @method     ChildDrillCategoryMapping[]|ObjectCollection findByCategoryFk(int $category_fk) Return ChildDrillCategoryMapping objects filtered by the category_fk column
 * @method     ChildDrillCategoryMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DrillCategoryMappingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DrillCategoryMappingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\DrillCategoryMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDrillCategoryMappingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDrillCategoryMappingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDrillCategoryMappingQuery) {
            return $criteria;
        }
        $query = new ChildDrillCategoryMappingQuery();
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
     * @return ChildDrillCategoryMapping|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DrillCategoryMappingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DrillCategoryMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDrillCategoryMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT drill_category_mapping_pk, drill_fk, category_fk FROM drill_category_mapping WHERE drill_category_mapping_pk = :p0';
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
            /** @var ChildDrillCategoryMapping $obj */
            $obj = new ChildDrillCategoryMapping();
            $obj->hydrate($row);
            DrillCategoryMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDrillCategoryMapping|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDrillCategoryMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DrillCategoryMappingTableMap::COL_DRILL_CATEGORY_MAPPING_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDrillCategoryMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DrillCategoryMappingTableMap::COL_DRILL_CATEGORY_MAPPING_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the drill_category_mapping_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByDrillCategoryMappingPk(1234); // WHERE drill_category_mapping_pk = 1234
     * $query->filterByDrillCategoryMappingPk(array(12, 34)); // WHERE drill_category_mapping_pk IN (12, 34)
     * $query->filterByDrillCategoryMappingPk(array('min' => 12)); // WHERE drill_category_mapping_pk > 12
     * </code>
     *
     * @param     mixed $drillCategoryMappingPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillCategoryMappingQuery The current query, for fluid interface
     */
    public function filterByDrillCategoryMappingPk($drillCategoryMappingPk = null, $comparison = null)
    {
        if (is_array($drillCategoryMappingPk)) {
            $useMinMax = false;
            if (isset($drillCategoryMappingPk['min'])) {
                $this->addUsingAlias(DrillCategoryMappingTableMap::COL_DRILL_CATEGORY_MAPPING_PK, $drillCategoryMappingPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($drillCategoryMappingPk['max'])) {
                $this->addUsingAlias(DrillCategoryMappingTableMap::COL_DRILL_CATEGORY_MAPPING_PK, $drillCategoryMappingPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillCategoryMappingTableMap::COL_DRILL_CATEGORY_MAPPING_PK, $drillCategoryMappingPk, $comparison);
    }

    /**
     * Filter the query on the drill_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByDrillFk(1234); // WHERE drill_fk = 1234
     * $query->filterByDrillFk(array(12, 34)); // WHERE drill_fk IN (12, 34)
     * $query->filterByDrillFk(array('min' => 12)); // WHERE drill_fk > 12
     * </code>
     *
     * @see       filterByDrill()
     *
     * @param     mixed $drillFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillCategoryMappingQuery The current query, for fluid interface
     */
    public function filterByDrillFk($drillFk = null, $comparison = null)
    {
        if (is_array($drillFk)) {
            $useMinMax = false;
            if (isset($drillFk['min'])) {
                $this->addUsingAlias(DrillCategoryMappingTableMap::COL_DRILL_FK, $drillFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($drillFk['max'])) {
                $this->addUsingAlias(DrillCategoryMappingTableMap::COL_DRILL_FK, $drillFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillCategoryMappingTableMap::COL_DRILL_FK, $drillFk, $comparison);
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
     * @return $this|ChildDrillCategoryMappingQuery The current query, for fluid interface
     */
    public function filterByCategoryFk($categoryFk = null, $comparison = null)
    {
        if (is_array($categoryFk)) {
            $useMinMax = false;
            if (isset($categoryFk['min'])) {
                $this->addUsingAlias(DrillCategoryMappingTableMap::COL_CATEGORY_FK, $categoryFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryFk['max'])) {
                $this->addUsingAlias(DrillCategoryMappingTableMap::COL_CATEGORY_FK, $categoryFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillCategoryMappingTableMap::COL_CATEGORY_FK, $categoryFk, $comparison);
    }

    /**
     * Filter the query by a related \Drill object
     *
     * @param \Drill|ObjectCollection $drill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDrillCategoryMappingQuery The current query, for fluid interface
     */
    public function filterByDrill($drill, $comparison = null)
    {
        if ($drill instanceof \Drill) {
            return $this
                ->addUsingAlias(DrillCategoryMappingTableMap::COL_DRILL_FK, $drill->getDrillPk(), $comparison);
        } elseif ($drill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DrillCategoryMappingTableMap::COL_DRILL_FK, $drill->toKeyValue('PrimaryKey', 'DrillPk'), $comparison);
        } else {
            throw new PropelException('filterByDrill() only accepts arguments of type \Drill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Drill relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDrillCategoryMappingQuery The current query, for fluid interface
     */
    public function joinDrill($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Drill');

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
            $this->addJoinObject($join, 'Drill');
        }

        return $this;
    }

    /**
     * Use the Drill relation Drill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DrillQuery A secondary query class using the current class as primary query
     */
    public function useDrillQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDrill($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Drill', '\DrillQuery');
    }

    /**
     * Filter the query by a related \Category object
     *
     * @param \Category|ObjectCollection $category The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDrillCategoryMappingQuery The current query, for fluid interface
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof \Category) {
            return $this
                ->addUsingAlias(DrillCategoryMappingTableMap::COL_CATEGORY_FK, $category->getCategoryPk(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DrillCategoryMappingTableMap::COL_CATEGORY_FK, $category->toKeyValue('PrimaryKey', 'CategoryPk'), $comparison);
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
     * @return $this|ChildDrillCategoryMappingQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildDrillCategoryMapping $drillCategoryMapping Object to remove from the list of results
     *
     * @return $this|ChildDrillCategoryMappingQuery The current query, for fluid interface
     */
    public function prune($drillCategoryMapping = null)
    {
        if ($drillCategoryMapping) {
            $this->addUsingAlias(DrillCategoryMappingTableMap::COL_DRILL_CATEGORY_MAPPING_PK, $drillCategoryMapping->getDrillCategoryMappingPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the drill_category_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DrillCategoryMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DrillCategoryMappingTableMap::clearInstancePool();
            DrillCategoryMappingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DrillCategoryMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DrillCategoryMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DrillCategoryMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DrillCategoryMappingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DrillCategoryMappingQuery
