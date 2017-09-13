<?php

namespace Base;

use \DrillTagMapping as ChildDrillTagMapping;
use \DrillTagMappingQuery as ChildDrillTagMappingQuery;
use \Exception;
use \PDO;
use Map\DrillTagMappingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'drill_tag_mapping' table.
 *
 *
 *
 * @method     ChildDrillTagMappingQuery orderByDrillTagMappingPk($order = Criteria::ASC) Order by the drill_tag_mapping_pk column
 * @method     ChildDrillTagMappingQuery orderByTagFk($order = Criteria::ASC) Order by the tag_fk column
 * @method     ChildDrillTagMappingQuery orderByDrillFk($order = Criteria::ASC) Order by the drill_fk column
 *
 * @method     ChildDrillTagMappingQuery groupByDrillTagMappingPk() Group by the drill_tag_mapping_pk column
 * @method     ChildDrillTagMappingQuery groupByTagFk() Group by the tag_fk column
 * @method     ChildDrillTagMappingQuery groupByDrillFk() Group by the drill_fk column
 *
 * @method     ChildDrillTagMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDrillTagMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDrillTagMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDrillTagMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDrillTagMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDrillTagMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDrillTagMappingQuery leftJoinTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tag relation
 * @method     ChildDrillTagMappingQuery rightJoinTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tag relation
 * @method     ChildDrillTagMappingQuery innerJoinTag($relationAlias = null) Adds a INNER JOIN clause to the query using the Tag relation
 *
 * @method     ChildDrillTagMappingQuery joinWithTag($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tag relation
 *
 * @method     ChildDrillTagMappingQuery leftJoinWithTag() Adds a LEFT JOIN clause and with to the query using the Tag relation
 * @method     ChildDrillTagMappingQuery rightJoinWithTag() Adds a RIGHT JOIN clause and with to the query using the Tag relation
 * @method     ChildDrillTagMappingQuery innerJoinWithTag() Adds a INNER JOIN clause and with to the query using the Tag relation
 *
 * @method     ChildDrillTagMappingQuery leftJoinDrill($relationAlias = null) Adds a LEFT JOIN clause to the query using the Drill relation
 * @method     ChildDrillTagMappingQuery rightJoinDrill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Drill relation
 * @method     ChildDrillTagMappingQuery innerJoinDrill($relationAlias = null) Adds a INNER JOIN clause to the query using the Drill relation
 *
 * @method     ChildDrillTagMappingQuery joinWithDrill($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Drill relation
 *
 * @method     ChildDrillTagMappingQuery leftJoinWithDrill() Adds a LEFT JOIN clause and with to the query using the Drill relation
 * @method     ChildDrillTagMappingQuery rightJoinWithDrill() Adds a RIGHT JOIN clause and with to the query using the Drill relation
 * @method     ChildDrillTagMappingQuery innerJoinWithDrill() Adds a INNER JOIN clause and with to the query using the Drill relation
 *
 * @method     \TagQuery|\DrillQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDrillTagMapping findOne(ConnectionInterface $con = null) Return the first ChildDrillTagMapping matching the query
 * @method     ChildDrillTagMapping findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDrillTagMapping matching the query, or a new ChildDrillTagMapping object populated from the query conditions when no match is found
 *
 * @method     ChildDrillTagMapping findOneByDrillTagMappingPk(int $drill_tag_mapping_pk) Return the first ChildDrillTagMapping filtered by the drill_tag_mapping_pk column
 * @method     ChildDrillTagMapping findOneByTagFk(int $tag_fk) Return the first ChildDrillTagMapping filtered by the tag_fk column
 * @method     ChildDrillTagMapping findOneByDrillFk(int $drill_fk) Return the first ChildDrillTagMapping filtered by the drill_fk column *

 * @method     ChildDrillTagMapping requirePk($key, ConnectionInterface $con = null) Return the ChildDrillTagMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrillTagMapping requireOne(ConnectionInterface $con = null) Return the first ChildDrillTagMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDrillTagMapping requireOneByDrillTagMappingPk(int $drill_tag_mapping_pk) Return the first ChildDrillTagMapping filtered by the drill_tag_mapping_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrillTagMapping requireOneByTagFk(int $tag_fk) Return the first ChildDrillTagMapping filtered by the tag_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrillTagMapping requireOneByDrillFk(int $drill_fk) Return the first ChildDrillTagMapping filtered by the drill_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDrillTagMapping[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDrillTagMapping objects based on current ModelCriteria
 * @method     ChildDrillTagMapping[]|ObjectCollection findByDrillTagMappingPk(int $drill_tag_mapping_pk) Return ChildDrillTagMapping objects filtered by the drill_tag_mapping_pk column
 * @method     ChildDrillTagMapping[]|ObjectCollection findByTagFk(int $tag_fk) Return ChildDrillTagMapping objects filtered by the tag_fk column
 * @method     ChildDrillTagMapping[]|ObjectCollection findByDrillFk(int $drill_fk) Return ChildDrillTagMapping objects filtered by the drill_fk column
 * @method     ChildDrillTagMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DrillTagMappingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DrillTagMappingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\DrillTagMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDrillTagMappingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDrillTagMappingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDrillTagMappingQuery) {
            return $criteria;
        }
        $query = new ChildDrillTagMappingQuery();
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
     * @return ChildDrillTagMapping|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DrillTagMappingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DrillTagMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDrillTagMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT drill_tag_mapping_pk, tag_fk, drill_fk FROM drill_tag_mapping WHERE drill_tag_mapping_pk = :p0';
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
            /** @var ChildDrillTagMapping $obj */
            $obj = new ChildDrillTagMapping();
            $obj->hydrate($row);
            DrillTagMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDrillTagMapping|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDrillTagMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DrillTagMappingTableMap::COL_DRILL_TAG_MAPPING_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDrillTagMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DrillTagMappingTableMap::COL_DRILL_TAG_MAPPING_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the drill_tag_mapping_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByDrillTagMappingPk(1234); // WHERE drill_tag_mapping_pk = 1234
     * $query->filterByDrillTagMappingPk(array(12, 34)); // WHERE drill_tag_mapping_pk IN (12, 34)
     * $query->filterByDrillTagMappingPk(array('min' => 12)); // WHERE drill_tag_mapping_pk > 12
     * </code>
     *
     * @param     mixed $drillTagMappingPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillTagMappingQuery The current query, for fluid interface
     */
    public function filterByDrillTagMappingPk($drillTagMappingPk = null, $comparison = null)
    {
        if (is_array($drillTagMappingPk)) {
            $useMinMax = false;
            if (isset($drillTagMappingPk['min'])) {
                $this->addUsingAlias(DrillTagMappingTableMap::COL_DRILL_TAG_MAPPING_PK, $drillTagMappingPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($drillTagMappingPk['max'])) {
                $this->addUsingAlias(DrillTagMappingTableMap::COL_DRILL_TAG_MAPPING_PK, $drillTagMappingPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTagMappingTableMap::COL_DRILL_TAG_MAPPING_PK, $drillTagMappingPk, $comparison);
    }

    /**
     * Filter the query on the tag_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByTagFk(1234); // WHERE tag_fk = 1234
     * $query->filterByTagFk(array(12, 34)); // WHERE tag_fk IN (12, 34)
     * $query->filterByTagFk(array('min' => 12)); // WHERE tag_fk > 12
     * </code>
     *
     * @see       filterByTag()
     *
     * @param     mixed $tagFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillTagMappingQuery The current query, for fluid interface
     */
    public function filterByTagFk($tagFk = null, $comparison = null)
    {
        if (is_array($tagFk)) {
            $useMinMax = false;
            if (isset($tagFk['min'])) {
                $this->addUsingAlias(DrillTagMappingTableMap::COL_TAG_FK, $tagFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tagFk['max'])) {
                $this->addUsingAlias(DrillTagMappingTableMap::COL_TAG_FK, $tagFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTagMappingTableMap::COL_TAG_FK, $tagFk, $comparison);
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
     * @return $this|ChildDrillTagMappingQuery The current query, for fluid interface
     */
    public function filterByDrillFk($drillFk = null, $comparison = null)
    {
        if (is_array($drillFk)) {
            $useMinMax = false;
            if (isset($drillFk['min'])) {
                $this->addUsingAlias(DrillTagMappingTableMap::COL_DRILL_FK, $drillFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($drillFk['max'])) {
                $this->addUsingAlias(DrillTagMappingTableMap::COL_DRILL_FK, $drillFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillTagMappingTableMap::COL_DRILL_FK, $drillFk, $comparison);
    }

    /**
     * Filter the query by a related \Tag object
     *
     * @param \Tag|ObjectCollection $tag The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDrillTagMappingQuery The current query, for fluid interface
     */
    public function filterByTag($tag, $comparison = null)
    {
        if ($tag instanceof \Tag) {
            return $this
                ->addUsingAlias(DrillTagMappingTableMap::COL_TAG_FK, $tag->getTagPk(), $comparison);
        } elseif ($tag instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DrillTagMappingTableMap::COL_TAG_FK, $tag->toKeyValue('PrimaryKey', 'TagPk'), $comparison);
        } else {
            throw new PropelException('filterByTag() only accepts arguments of type \Tag or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDrillTagMappingQuery The current query, for fluid interface
     */
    public function joinTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tag');

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
            $this->addJoinObject($join, 'Tag');
        }

        return $this;
    }

    /**
     * Use the Tag relation Tag object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TagQuery A secondary query class using the current class as primary query
     */
    public function useTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tag', '\TagQuery');
    }

    /**
     * Filter the query by a related \Drill object
     *
     * @param \Drill|ObjectCollection $drill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDrillTagMappingQuery The current query, for fluid interface
     */
    public function filterByDrill($drill, $comparison = null)
    {
        if ($drill instanceof \Drill) {
            return $this
                ->addUsingAlias(DrillTagMappingTableMap::COL_DRILL_FK, $drill->getDrillPk(), $comparison);
        } elseif ($drill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DrillTagMappingTableMap::COL_DRILL_FK, $drill->toKeyValue('PrimaryKey', 'DrillPk'), $comparison);
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
     * @return $this|ChildDrillTagMappingQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildDrillTagMapping $drillTagMapping Object to remove from the list of results
     *
     * @return $this|ChildDrillTagMappingQuery The current query, for fluid interface
     */
    public function prune($drillTagMapping = null)
    {
        if ($drillTagMapping) {
            $this->addUsingAlias(DrillTagMappingTableMap::COL_DRILL_TAG_MAPPING_PK, $drillTagMapping->getDrillTagMappingPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the drill_tag_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DrillTagMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DrillTagMappingTableMap::clearInstancePool();
            DrillTagMappingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DrillTagMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DrillTagMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DrillTagMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DrillTagMappingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DrillTagMappingQuery
