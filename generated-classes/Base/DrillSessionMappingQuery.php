<?php

namespace Base;

use \DrillSessionMapping as ChildDrillSessionMapping;
use \DrillSessionMappingQuery as ChildDrillSessionMappingQuery;
use \Exception;
use \PDO;
use Map\DrillSessionMappingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'drill_session_mapping' table.
 *
 *
 *
 * @method     ChildDrillSessionMappingQuery orderByDrillSessionMappingPk($order = Criteria::ASC) Order by the drill_session_mapping_pk column
 * @method     ChildDrillSessionMappingQuery orderByDrillFk($order = Criteria::ASC) Order by the drill_fk column
 * @method     ChildDrillSessionMappingQuery orderBySessionFk($order = Criteria::ASC) Order by the session_fk column
 * @method     ChildDrillSessionMappingQuery orderBySortOrder($order = Criteria::ASC) Order by the sort_order column
 *
 * @method     ChildDrillSessionMappingQuery groupByDrillSessionMappingPk() Group by the drill_session_mapping_pk column
 * @method     ChildDrillSessionMappingQuery groupByDrillFk() Group by the drill_fk column
 * @method     ChildDrillSessionMappingQuery groupBySessionFk() Group by the session_fk column
 * @method     ChildDrillSessionMappingQuery groupBySortOrder() Group by the sort_order column
 *
 * @method     ChildDrillSessionMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDrillSessionMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDrillSessionMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDrillSessionMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDrillSessionMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDrillSessionMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDrillSessionMappingQuery leftJoinDrill($relationAlias = null) Adds a LEFT JOIN clause to the query using the Drill relation
 * @method     ChildDrillSessionMappingQuery rightJoinDrill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Drill relation
 * @method     ChildDrillSessionMappingQuery innerJoinDrill($relationAlias = null) Adds a INNER JOIN clause to the query using the Drill relation
 *
 * @method     ChildDrillSessionMappingQuery joinWithDrill($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Drill relation
 *
 * @method     ChildDrillSessionMappingQuery leftJoinWithDrill() Adds a LEFT JOIN clause and with to the query using the Drill relation
 * @method     ChildDrillSessionMappingQuery rightJoinWithDrill() Adds a RIGHT JOIN clause and with to the query using the Drill relation
 * @method     ChildDrillSessionMappingQuery innerJoinWithDrill() Adds a INNER JOIN clause and with to the query using the Drill relation
 *
 * @method     ChildDrillSessionMappingQuery leftJoinSession($relationAlias = null) Adds a LEFT JOIN clause to the query using the Session relation
 * @method     ChildDrillSessionMappingQuery rightJoinSession($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Session relation
 * @method     ChildDrillSessionMappingQuery innerJoinSession($relationAlias = null) Adds a INNER JOIN clause to the query using the Session relation
 *
 * @method     ChildDrillSessionMappingQuery joinWithSession($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Session relation
 *
 * @method     ChildDrillSessionMappingQuery leftJoinWithSession() Adds a LEFT JOIN clause and with to the query using the Session relation
 * @method     ChildDrillSessionMappingQuery rightJoinWithSession() Adds a RIGHT JOIN clause and with to the query using the Session relation
 * @method     ChildDrillSessionMappingQuery innerJoinWithSession() Adds a INNER JOIN clause and with to the query using the Session relation
 *
 * @method     \DrillQuery|\SessionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDrillSessionMapping findOne(ConnectionInterface $con = null) Return the first ChildDrillSessionMapping matching the query
 * @method     ChildDrillSessionMapping findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDrillSessionMapping matching the query, or a new ChildDrillSessionMapping object populated from the query conditions when no match is found
 *
 * @method     ChildDrillSessionMapping findOneByDrillSessionMappingPk(int $drill_session_mapping_pk) Return the first ChildDrillSessionMapping filtered by the drill_session_mapping_pk column
 * @method     ChildDrillSessionMapping findOneByDrillFk(int $drill_fk) Return the first ChildDrillSessionMapping filtered by the drill_fk column
 * @method     ChildDrillSessionMapping findOneBySessionFk(int $session_fk) Return the first ChildDrillSessionMapping filtered by the session_fk column
 * @method     ChildDrillSessionMapping findOneBySortOrder(int $sort_order) Return the first ChildDrillSessionMapping filtered by the sort_order column *

 * @method     ChildDrillSessionMapping requirePk($key, ConnectionInterface $con = null) Return the ChildDrillSessionMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrillSessionMapping requireOne(ConnectionInterface $con = null) Return the first ChildDrillSessionMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDrillSessionMapping requireOneByDrillSessionMappingPk(int $drill_session_mapping_pk) Return the first ChildDrillSessionMapping filtered by the drill_session_mapping_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrillSessionMapping requireOneByDrillFk(int $drill_fk) Return the first ChildDrillSessionMapping filtered by the drill_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrillSessionMapping requireOneBySessionFk(int $session_fk) Return the first ChildDrillSessionMapping filtered by the session_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDrillSessionMapping requireOneBySortOrder(int $sort_order) Return the first ChildDrillSessionMapping filtered by the sort_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDrillSessionMapping[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDrillSessionMapping objects based on current ModelCriteria
 * @method     ChildDrillSessionMapping[]|ObjectCollection findByDrillSessionMappingPk(int $drill_session_mapping_pk) Return ChildDrillSessionMapping objects filtered by the drill_session_mapping_pk column
 * @method     ChildDrillSessionMapping[]|ObjectCollection findByDrillFk(int $drill_fk) Return ChildDrillSessionMapping objects filtered by the drill_fk column
 * @method     ChildDrillSessionMapping[]|ObjectCollection findBySessionFk(int $session_fk) Return ChildDrillSessionMapping objects filtered by the session_fk column
 * @method     ChildDrillSessionMapping[]|ObjectCollection findBySortOrder(int $sort_order) Return ChildDrillSessionMapping objects filtered by the sort_order column
 * @method     ChildDrillSessionMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DrillSessionMappingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DrillSessionMappingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\DrillSessionMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDrillSessionMappingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDrillSessionMappingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDrillSessionMappingQuery) {
            return $criteria;
        }
        $query = new ChildDrillSessionMappingQuery();
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
     * @return ChildDrillSessionMapping|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DrillSessionMappingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DrillSessionMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDrillSessionMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT drill_session_mapping_pk, drill_fk, session_fk, sort_order FROM drill_session_mapping WHERE drill_session_mapping_pk = :p0';
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
            /** @var ChildDrillSessionMapping $obj */
            $obj = new ChildDrillSessionMapping();
            $obj->hydrate($row);
            DrillSessionMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDrillSessionMapping|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDrillSessionMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DrillSessionMappingTableMap::COL_DRILL_SESSION_MAPPING_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDrillSessionMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DrillSessionMappingTableMap::COL_DRILL_SESSION_MAPPING_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the drill_session_mapping_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByDrillSessionMappingPk(1234); // WHERE drill_session_mapping_pk = 1234
     * $query->filterByDrillSessionMappingPk(array(12, 34)); // WHERE drill_session_mapping_pk IN (12, 34)
     * $query->filterByDrillSessionMappingPk(array('min' => 12)); // WHERE drill_session_mapping_pk > 12
     * </code>
     *
     * @param     mixed $drillSessionMappingPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillSessionMappingQuery The current query, for fluid interface
     */
    public function filterByDrillSessionMappingPk($drillSessionMappingPk = null, $comparison = null)
    {
        if (is_array($drillSessionMappingPk)) {
            $useMinMax = false;
            if (isset($drillSessionMappingPk['min'])) {
                $this->addUsingAlias(DrillSessionMappingTableMap::COL_DRILL_SESSION_MAPPING_PK, $drillSessionMappingPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($drillSessionMappingPk['max'])) {
                $this->addUsingAlias(DrillSessionMappingTableMap::COL_DRILL_SESSION_MAPPING_PK, $drillSessionMappingPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillSessionMappingTableMap::COL_DRILL_SESSION_MAPPING_PK, $drillSessionMappingPk, $comparison);
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
     * @return $this|ChildDrillSessionMappingQuery The current query, for fluid interface
     */
    public function filterByDrillFk($drillFk = null, $comparison = null)
    {
        if (is_array($drillFk)) {
            $useMinMax = false;
            if (isset($drillFk['min'])) {
                $this->addUsingAlias(DrillSessionMappingTableMap::COL_DRILL_FK, $drillFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($drillFk['max'])) {
                $this->addUsingAlias(DrillSessionMappingTableMap::COL_DRILL_FK, $drillFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillSessionMappingTableMap::COL_DRILL_FK, $drillFk, $comparison);
    }

    /**
     * Filter the query on the session_fk column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionFk(1234); // WHERE session_fk = 1234
     * $query->filterBySessionFk(array(12, 34)); // WHERE session_fk IN (12, 34)
     * $query->filterBySessionFk(array('min' => 12)); // WHERE session_fk > 12
     * </code>
     *
     * @see       filterBySession()
     *
     * @param     mixed $sessionFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillSessionMappingQuery The current query, for fluid interface
     */
    public function filterBySessionFk($sessionFk = null, $comparison = null)
    {
        if (is_array($sessionFk)) {
            $useMinMax = false;
            if (isset($sessionFk['min'])) {
                $this->addUsingAlias(DrillSessionMappingTableMap::COL_SESSION_FK, $sessionFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sessionFk['max'])) {
                $this->addUsingAlias(DrillSessionMappingTableMap::COL_SESSION_FK, $sessionFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillSessionMappingTableMap::COL_SESSION_FK, $sessionFk, $comparison);
    }

    /**
     * Filter the query on the sort_order column
     *
     * Example usage:
     * <code>
     * $query->filterBySortOrder(1234); // WHERE sort_order = 1234
     * $query->filterBySortOrder(array(12, 34)); // WHERE sort_order IN (12, 34)
     * $query->filterBySortOrder(array('min' => 12)); // WHERE sort_order > 12
     * </code>
     *
     * @param     mixed $sortOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDrillSessionMappingQuery The current query, for fluid interface
     */
    public function filterBySortOrder($sortOrder = null, $comparison = null)
    {
        if (is_array($sortOrder)) {
            $useMinMax = false;
            if (isset($sortOrder['min'])) {
                $this->addUsingAlias(DrillSessionMappingTableMap::COL_SORT_ORDER, $sortOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortOrder['max'])) {
                $this->addUsingAlias(DrillSessionMappingTableMap::COL_SORT_ORDER, $sortOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DrillSessionMappingTableMap::COL_SORT_ORDER, $sortOrder, $comparison);
    }

    /**
     * Filter the query by a related \Drill object
     *
     * @param \Drill|ObjectCollection $drill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDrillSessionMappingQuery The current query, for fluid interface
     */
    public function filterByDrill($drill, $comparison = null)
    {
        if ($drill instanceof \Drill) {
            return $this
                ->addUsingAlias(DrillSessionMappingTableMap::COL_DRILL_FK, $drill->getDrillPk(), $comparison);
        } elseif ($drill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DrillSessionMappingTableMap::COL_DRILL_FK, $drill->toKeyValue('PrimaryKey', 'DrillPk'), $comparison);
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
     * @return $this|ChildDrillSessionMappingQuery The current query, for fluid interface
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
     * Filter the query by a related \Session object
     *
     * @param \Session|ObjectCollection $session The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDrillSessionMappingQuery The current query, for fluid interface
     */
    public function filterBySession($session, $comparison = null)
    {
        if ($session instanceof \Session) {
            return $this
                ->addUsingAlias(DrillSessionMappingTableMap::COL_SESSION_FK, $session->getSessionPk(), $comparison);
        } elseif ($session instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DrillSessionMappingTableMap::COL_SESSION_FK, $session->toKeyValue('PrimaryKey', 'SessionPk'), $comparison);
        } else {
            throw new PropelException('filterBySession() only accepts arguments of type \Session or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Session relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDrillSessionMappingQuery The current query, for fluid interface
     */
    public function joinSession($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Session');

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
            $this->addJoinObject($join, 'Session');
        }

        return $this;
    }

    /**
     * Use the Session relation Session object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SessionQuery A secondary query class using the current class as primary query
     */
    public function useSessionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSession($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Session', '\SessionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDrillSessionMapping $drillSessionMapping Object to remove from the list of results
     *
     * @return $this|ChildDrillSessionMappingQuery The current query, for fluid interface
     */
    public function prune($drillSessionMapping = null)
    {
        if ($drillSessionMapping) {
            $this->addUsingAlias(DrillSessionMappingTableMap::COL_DRILL_SESSION_MAPPING_PK, $drillSessionMapping->getDrillSessionMappingPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the drill_session_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DrillSessionMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DrillSessionMappingTableMap::clearInstancePool();
            DrillSessionMappingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DrillSessionMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DrillSessionMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DrillSessionMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DrillSessionMappingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DrillSessionMappingQuery
