<?php

namespace Base;

use \SessionRungroup as ChildSessionRungroup;
use \SessionRungroupQuery as ChildSessionRungroupQuery;
use \Exception;
use \PDO;
use Map\SessionRungroupTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'session_rungroup' table.
 *
 *
 *
 * @method     ChildSessionRungroupQuery orderBySessionRungroupPk($order = Criteria::ASC) Order by the session_rungroup_pk column
 * @method     ChildSessionRungroupQuery orderBySessionFk($order = Criteria::ASC) Order by the session_fk column
 * @method     ChildSessionRungroupQuery orderByRungroupFk($order = Criteria::ASC) Order by the rungroup_fk column
 * @method     ChildSessionRungroupQuery orderBySortOrder($order = Criteria::ASC) Order by the sort_order column
 *
 * @method     ChildSessionRungroupQuery groupBySessionRungroupPk() Group by the session_rungroup_pk column
 * @method     ChildSessionRungroupQuery groupBySessionFk() Group by the session_fk column
 * @method     ChildSessionRungroupQuery groupByRungroupFk() Group by the rungroup_fk column
 * @method     ChildSessionRungroupQuery groupBySortOrder() Group by the sort_order column
 *
 * @method     ChildSessionRungroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSessionRungroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSessionRungroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSessionRungroupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSessionRungroupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSessionRungroupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSessionRungroupQuery leftJoinSession($relationAlias = null) Adds a LEFT JOIN clause to the query using the Session relation
 * @method     ChildSessionRungroupQuery rightJoinSession($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Session relation
 * @method     ChildSessionRungroupQuery innerJoinSession($relationAlias = null) Adds a INNER JOIN clause to the query using the Session relation
 *
 * @method     ChildSessionRungroupQuery joinWithSession($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Session relation
 *
 * @method     ChildSessionRungroupQuery leftJoinWithSession() Adds a LEFT JOIN clause and with to the query using the Session relation
 * @method     ChildSessionRungroupQuery rightJoinWithSession() Adds a RIGHT JOIN clause and with to the query using the Session relation
 * @method     ChildSessionRungroupQuery innerJoinWithSession() Adds a INNER JOIN clause and with to the query using the Session relation
 *
 * @method     ChildSessionRungroupQuery leftJoinRungroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rungroup relation
 * @method     ChildSessionRungroupQuery rightJoinRungroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rungroup relation
 * @method     ChildSessionRungroupQuery innerJoinRungroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Rungroup relation
 *
 * @method     ChildSessionRungroupQuery joinWithRungroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Rungroup relation
 *
 * @method     ChildSessionRungroupQuery leftJoinWithRungroup() Adds a LEFT JOIN clause and with to the query using the Rungroup relation
 * @method     ChildSessionRungroupQuery rightJoinWithRungroup() Adds a RIGHT JOIN clause and with to the query using the Rungroup relation
 * @method     ChildSessionRungroupQuery innerJoinWithRungroup() Adds a INNER JOIN clause and with to the query using the Rungroup relation
 *
 * @method     \SessionQuery|\RungroupQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSessionRungroup findOne(ConnectionInterface $con = null) Return the first ChildSessionRungroup matching the query
 * @method     ChildSessionRungroup findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSessionRungroup matching the query, or a new ChildSessionRungroup object populated from the query conditions when no match is found
 *
 * @method     ChildSessionRungroup findOneBySessionRungroupPk(int $session_rungroup_pk) Return the first ChildSessionRungroup filtered by the session_rungroup_pk column
 * @method     ChildSessionRungroup findOneBySessionFk(int $session_fk) Return the first ChildSessionRungroup filtered by the session_fk column
 * @method     ChildSessionRungroup findOneByRungroupFk(int $rungroup_fk) Return the first ChildSessionRungroup filtered by the rungroup_fk column
 * @method     ChildSessionRungroup findOneBySortOrder(int $sort_order) Return the first ChildSessionRungroup filtered by the sort_order column *

 * @method     ChildSessionRungroup requirePk($key, ConnectionInterface $con = null) Return the ChildSessionRungroup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionRungroup requireOne(ConnectionInterface $con = null) Return the first ChildSessionRungroup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSessionRungroup requireOneBySessionRungroupPk(int $session_rungroup_pk) Return the first ChildSessionRungroup filtered by the session_rungroup_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionRungroup requireOneBySessionFk(int $session_fk) Return the first ChildSessionRungroup filtered by the session_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionRungroup requireOneByRungroupFk(int $rungroup_fk) Return the first ChildSessionRungroup filtered by the rungroup_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSessionRungroup requireOneBySortOrder(int $sort_order) Return the first ChildSessionRungroup filtered by the sort_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSessionRungroup[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSessionRungroup objects based on current ModelCriteria
 * @method     ChildSessionRungroup[]|ObjectCollection findBySessionRungroupPk(int $session_rungroup_pk) Return ChildSessionRungroup objects filtered by the session_rungroup_pk column
 * @method     ChildSessionRungroup[]|ObjectCollection findBySessionFk(int $session_fk) Return ChildSessionRungroup objects filtered by the session_fk column
 * @method     ChildSessionRungroup[]|ObjectCollection findByRungroupFk(int $rungroup_fk) Return ChildSessionRungroup objects filtered by the rungroup_fk column
 * @method     ChildSessionRungroup[]|ObjectCollection findBySortOrder(int $sort_order) Return ChildSessionRungroup objects filtered by the sort_order column
 * @method     ChildSessionRungroup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SessionRungroupQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SessionRungroupQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\SessionRungroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSessionRungroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSessionRungroupQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSessionRungroupQuery) {
            return $criteria;
        }
        $query = new ChildSessionRungroupQuery();
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
     * @return ChildSessionRungroup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SessionRungroupTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SessionRungroupTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSessionRungroup A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT session_rungroup_pk, session_fk, rungroup_fk, sort_order FROM session_rungroup WHERE session_rungroup_pk = :p0';
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
            /** @var ChildSessionRungroup $obj */
            $obj = new ChildSessionRungroup();
            $obj->hydrate($row);
            SessionRungroupTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSessionRungroup|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSessionRungroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SessionRungroupTableMap::COL_SESSION_RUNGROUP_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSessionRungroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SessionRungroupTableMap::COL_SESSION_RUNGROUP_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the session_rungroup_pk column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionRungroupPk(1234); // WHERE session_rungroup_pk = 1234
     * $query->filterBySessionRungroupPk(array(12, 34)); // WHERE session_rungroup_pk IN (12, 34)
     * $query->filterBySessionRungroupPk(array('min' => 12)); // WHERE session_rungroup_pk > 12
     * </code>
     *
     * @param     mixed $sessionRungroupPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionRungroupQuery The current query, for fluid interface
     */
    public function filterBySessionRungroupPk($sessionRungroupPk = null, $comparison = null)
    {
        if (is_array($sessionRungroupPk)) {
            $useMinMax = false;
            if (isset($sessionRungroupPk['min'])) {
                $this->addUsingAlias(SessionRungroupTableMap::COL_SESSION_RUNGROUP_PK, $sessionRungroupPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sessionRungroupPk['max'])) {
                $this->addUsingAlias(SessionRungroupTableMap::COL_SESSION_RUNGROUP_PK, $sessionRungroupPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionRungroupTableMap::COL_SESSION_RUNGROUP_PK, $sessionRungroupPk, $comparison);
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
     * @return $this|ChildSessionRungroupQuery The current query, for fluid interface
     */
    public function filterBySessionFk($sessionFk = null, $comparison = null)
    {
        if (is_array($sessionFk)) {
            $useMinMax = false;
            if (isset($sessionFk['min'])) {
                $this->addUsingAlias(SessionRungroupTableMap::COL_SESSION_FK, $sessionFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sessionFk['max'])) {
                $this->addUsingAlias(SessionRungroupTableMap::COL_SESSION_FK, $sessionFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionRungroupTableMap::COL_SESSION_FK, $sessionFk, $comparison);
    }

    /**
     * Filter the query on the rungroup_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByRungroupFk(1234); // WHERE rungroup_fk = 1234
     * $query->filterByRungroupFk(array(12, 34)); // WHERE rungroup_fk IN (12, 34)
     * $query->filterByRungroupFk(array('min' => 12)); // WHERE rungroup_fk > 12
     * </code>
     *
     * @see       filterByRungroup()
     *
     * @param     mixed $rungroupFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionRungroupQuery The current query, for fluid interface
     */
    public function filterByRungroupFk($rungroupFk = null, $comparison = null)
    {
        if (is_array($rungroupFk)) {
            $useMinMax = false;
            if (isset($rungroupFk['min'])) {
                $this->addUsingAlias(SessionRungroupTableMap::COL_RUNGROUP_FK, $rungroupFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rungroupFk['max'])) {
                $this->addUsingAlias(SessionRungroupTableMap::COL_RUNGROUP_FK, $rungroupFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionRungroupTableMap::COL_RUNGROUP_FK, $rungroupFk, $comparison);
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
     * @return $this|ChildSessionRungroupQuery The current query, for fluid interface
     */
    public function filterBySortOrder($sortOrder = null, $comparison = null)
    {
        if (is_array($sortOrder)) {
            $useMinMax = false;
            if (isset($sortOrder['min'])) {
                $this->addUsingAlias(SessionRungroupTableMap::COL_SORT_ORDER, $sortOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortOrder['max'])) {
                $this->addUsingAlias(SessionRungroupTableMap::COL_SORT_ORDER, $sortOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionRungroupTableMap::COL_SORT_ORDER, $sortOrder, $comparison);
    }

    /**
     * Filter the query by a related \Session object
     *
     * @param \Session|ObjectCollection $session The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSessionRungroupQuery The current query, for fluid interface
     */
    public function filterBySession($session, $comparison = null)
    {
        if ($session instanceof \Session) {
            return $this
                ->addUsingAlias(SessionRungroupTableMap::COL_SESSION_FK, $session->getSessionPk(), $comparison);
        } elseif ($session instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SessionRungroupTableMap::COL_SESSION_FK, $session->toKeyValue('PrimaryKey', 'SessionPk'), $comparison);
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
     * @return $this|ChildSessionRungroupQuery The current query, for fluid interface
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
     * Filter the query by a related \Rungroup object
     *
     * @param \Rungroup|ObjectCollection $rungroup The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSessionRungroupQuery The current query, for fluid interface
     */
    public function filterByRungroup($rungroup, $comparison = null)
    {
        if ($rungroup instanceof \Rungroup) {
            return $this
                ->addUsingAlias(SessionRungroupTableMap::COL_RUNGROUP_FK, $rungroup->getRungroupPk(), $comparison);
        } elseif ($rungroup instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SessionRungroupTableMap::COL_RUNGROUP_FK, $rungroup->toKeyValue('PrimaryKey', 'RungroupPk'), $comparison);
        } else {
            throw new PropelException('filterByRungroup() only accepts arguments of type \Rungroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Rungroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSessionRungroupQuery The current query, for fluid interface
     */
    public function joinRungroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Rungroup');

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
            $this->addJoinObject($join, 'Rungroup');
        }

        return $this;
    }

    /**
     * Use the Rungroup relation Rungroup object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RungroupQuery A secondary query class using the current class as primary query
     */
    public function useRungroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRungroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Rungroup', '\RungroupQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSessionRungroup $sessionRungroup Object to remove from the list of results
     *
     * @return $this|ChildSessionRungroupQuery The current query, for fluid interface
     */
    public function prune($sessionRungroup = null)
    {
        if ($sessionRungroup) {
            $this->addUsingAlias(SessionRungroupTableMap::COL_SESSION_RUNGROUP_PK, $sessionRungroup->getSessionRungroupPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the session_rungroup table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SessionRungroupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SessionRungroupTableMap::clearInstancePool();
            SessionRungroupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SessionRungroupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SessionRungroupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SessionRungroupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SessionRungroupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SessionRungroupQuery
