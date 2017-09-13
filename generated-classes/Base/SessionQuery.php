<?php

namespace Base;

use \Session as ChildSession;
use \SessionQuery as ChildSessionQuery;
use \Exception;
use \PDO;
use Map\SessionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'session' table.
 *
 *
 *
 * @method     ChildSessionQuery orderBySessionPk($order = Criteria::ASC) Order by the session_pk column
 * @method     ChildSessionQuery orderByGuid($order = Criteria::ASC) Order by the guid column
 * @method     ChildSessionQuery orderBySessionDate($order = Criteria::ASC) Order by the session_date column
 * @method     ChildSessionQuery orderBySessionName($order = Criteria::ASC) Order by the session_name column
 * @method     ChildSessionQuery orderBySessionDescription($order = Criteria::ASC) Order by the session_description column
 * @method     ChildSessionQuery orderBySessionDescriptionHtml($order = Criteria::ASC) Order by the session_description_html column
 *
 * @method     ChildSessionQuery groupBySessionPk() Group by the session_pk column
 * @method     ChildSessionQuery groupByGuid() Group by the guid column
 * @method     ChildSessionQuery groupBySessionDate() Group by the session_date column
 * @method     ChildSessionQuery groupBySessionName() Group by the session_name column
 * @method     ChildSessionQuery groupBySessionDescription() Group by the session_description column
 * @method     ChildSessionQuery groupBySessionDescriptionHtml() Group by the session_description_html column
 *
 * @method     ChildSessionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSessionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSessionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSessionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSessionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSessionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSessionQuery leftJoinSessionDrill($relationAlias = null) Adds a LEFT JOIN clause to the query using the SessionDrill relation
 * @method     ChildSessionQuery rightJoinSessionDrill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SessionDrill relation
 * @method     ChildSessionQuery innerJoinSessionDrill($relationAlias = null) Adds a INNER JOIN clause to the query using the SessionDrill relation
 *
 * @method     ChildSessionQuery joinWithSessionDrill($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SessionDrill relation
 *
 * @method     ChildSessionQuery leftJoinWithSessionDrill() Adds a LEFT JOIN clause and with to the query using the SessionDrill relation
 * @method     ChildSessionQuery rightJoinWithSessionDrill() Adds a RIGHT JOIN clause and with to the query using the SessionDrill relation
 * @method     ChildSessionQuery innerJoinWithSessionDrill() Adds a INNER JOIN clause and with to the query using the SessionDrill relation
 *
 * @method     ChildSessionQuery leftJoinSessionRungroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the SessionRungroup relation
 * @method     ChildSessionQuery rightJoinSessionRungroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SessionRungroup relation
 * @method     ChildSessionQuery innerJoinSessionRungroup($relationAlias = null) Adds a INNER JOIN clause to the query using the SessionRungroup relation
 *
 * @method     ChildSessionQuery joinWithSessionRungroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SessionRungroup relation
 *
 * @method     ChildSessionQuery leftJoinWithSessionRungroup() Adds a LEFT JOIN clause and with to the query using the SessionRungroup relation
 * @method     ChildSessionQuery rightJoinWithSessionRungroup() Adds a RIGHT JOIN clause and with to the query using the SessionRungroup relation
 * @method     ChildSessionQuery innerJoinWithSessionRungroup() Adds a INNER JOIN clause and with to the query using the SessionRungroup relation
 *
 * @method     \SessionDrillQuery|\SessionRungroupQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSession findOne(ConnectionInterface $con = null) Return the first ChildSession matching the query
 * @method     ChildSession findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSession matching the query, or a new ChildSession object populated from the query conditions when no match is found
 *
 * @method     ChildSession findOneBySessionPk(int $session_pk) Return the first ChildSession filtered by the session_pk column
 * @method     ChildSession findOneByGuid(string $guid) Return the first ChildSession filtered by the guid column
 * @method     ChildSession findOneBySessionDate(string $session_date) Return the first ChildSession filtered by the session_date column
 * @method     ChildSession findOneBySessionName(string $session_name) Return the first ChildSession filtered by the session_name column
 * @method     ChildSession findOneBySessionDescription(string $session_description) Return the first ChildSession filtered by the session_description column
 * @method     ChildSession findOneBySessionDescriptionHtml(string $session_description_html) Return the first ChildSession filtered by the session_description_html column *

 * @method     ChildSession requirePk($key, ConnectionInterface $con = null) Return the ChildSession by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSession requireOne(ConnectionInterface $con = null) Return the first ChildSession matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSession requireOneBySessionPk(int $session_pk) Return the first ChildSession filtered by the session_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSession requireOneByGuid(string $guid) Return the first ChildSession filtered by the guid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSession requireOneBySessionDate(string $session_date) Return the first ChildSession filtered by the session_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSession requireOneBySessionName(string $session_name) Return the first ChildSession filtered by the session_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSession requireOneBySessionDescription(string $session_description) Return the first ChildSession filtered by the session_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSession requireOneBySessionDescriptionHtml(string $session_description_html) Return the first ChildSession filtered by the session_description_html column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSession[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSession objects based on current ModelCriteria
 * @method     ChildSession[]|ObjectCollection findBySessionPk(int $session_pk) Return ChildSession objects filtered by the session_pk column
 * @method     ChildSession[]|ObjectCollection findByGuid(string $guid) Return ChildSession objects filtered by the guid column
 * @method     ChildSession[]|ObjectCollection findBySessionDate(string $session_date) Return ChildSession objects filtered by the session_date column
 * @method     ChildSession[]|ObjectCollection findBySessionName(string $session_name) Return ChildSession objects filtered by the session_name column
 * @method     ChildSession[]|ObjectCollection findBySessionDescription(string $session_description) Return ChildSession objects filtered by the session_description column
 * @method     ChildSession[]|ObjectCollection findBySessionDescriptionHtml(string $session_description_html) Return ChildSession objects filtered by the session_description_html column
 * @method     ChildSession[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SessionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SessionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\Session', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSessionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSessionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSessionQuery) {
            return $criteria;
        }
        $query = new ChildSessionQuery();
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
     * @return ChildSession|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SessionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SessionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSession A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT session_pk, guid, session_date, session_name, session_description, session_description_html FROM session WHERE session_pk = :p0';
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
            /** @var ChildSession $obj */
            $obj = new ChildSession();
            $obj->hydrate($row);
            SessionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSession|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SessionTableMap::COL_SESSION_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SessionTableMap::COL_SESSION_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the session_pk column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionPk(1234); // WHERE session_pk = 1234
     * $query->filterBySessionPk(array(12, 34)); // WHERE session_pk IN (12, 34)
     * $query->filterBySessionPk(array('min' => 12)); // WHERE session_pk > 12
     * </code>
     *
     * @param     mixed $sessionPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterBySessionPk($sessionPk = null, $comparison = null)
    {
        if (is_array($sessionPk)) {
            $useMinMax = false;
            if (isset($sessionPk['min'])) {
                $this->addUsingAlias(SessionTableMap::COL_SESSION_PK, $sessionPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sessionPk['max'])) {
                $this->addUsingAlias(SessionTableMap::COL_SESSION_PK, $sessionPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionTableMap::COL_SESSION_PK, $sessionPk, $comparison);
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
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterByGuid($guid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($guid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionTableMap::COL_GUID, $guid, $comparison);
    }

    /**
     * Filter the query on the session_date column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionDate('2011-03-14'); // WHERE session_date = '2011-03-14'
     * $query->filterBySessionDate('now'); // WHERE session_date = '2011-03-14'
     * $query->filterBySessionDate(array('max' => 'yesterday')); // WHERE session_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $sessionDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterBySessionDate($sessionDate = null, $comparison = null)
    {
        if (is_array($sessionDate)) {
            $useMinMax = false;
            if (isset($sessionDate['min'])) {
                $this->addUsingAlias(SessionTableMap::COL_SESSION_DATE, $sessionDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sessionDate['max'])) {
                $this->addUsingAlias(SessionTableMap::COL_SESSION_DATE, $sessionDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionTableMap::COL_SESSION_DATE, $sessionDate, $comparison);
    }

    /**
     * Filter the query on the session_name column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionName('fooValue');   // WHERE session_name = 'fooValue'
     * $query->filterBySessionName('%fooValue%', Criteria::LIKE); // WHERE session_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sessionName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterBySessionName($sessionName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sessionName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionTableMap::COL_SESSION_NAME, $sessionName, $comparison);
    }

    /**
     * Filter the query on the session_description column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionDescription('fooValue');   // WHERE session_description = 'fooValue'
     * $query->filterBySessionDescription('%fooValue%', Criteria::LIKE); // WHERE session_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sessionDescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterBySessionDescription($sessionDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sessionDescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionTableMap::COL_SESSION_DESCRIPTION, $sessionDescription, $comparison);
    }

    /**
     * Filter the query on the session_description_html column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionDescriptionHtml('fooValue');   // WHERE session_description_html = 'fooValue'
     * $query->filterBySessionDescriptionHtml('%fooValue%', Criteria::LIKE); // WHERE session_description_html LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sessionDescriptionHtml The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterBySessionDescriptionHtml($sessionDescriptionHtml = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sessionDescriptionHtml)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionTableMap::COL_SESSION_DESCRIPTION_HTML, $sessionDescriptionHtml, $comparison);
    }

    /**
     * Filter the query by a related \SessionDrill object
     *
     * @param \SessionDrill|ObjectCollection $sessionDrill the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSessionQuery The current query, for fluid interface
     */
    public function filterBySessionDrill($sessionDrill, $comparison = null)
    {
        if ($sessionDrill instanceof \SessionDrill) {
            return $this
                ->addUsingAlias(SessionTableMap::COL_SESSION_PK, $sessionDrill->getSessionFk(), $comparison);
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
     * @return $this|ChildSessionQuery The current query, for fluid interface
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
     * Filter the query by a related \SessionRungroup object
     *
     * @param \SessionRungroup|ObjectCollection $sessionRungroup the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSessionQuery The current query, for fluid interface
     */
    public function filterBySessionRungroup($sessionRungroup, $comparison = null)
    {
        if ($sessionRungroup instanceof \SessionRungroup) {
            return $this
                ->addUsingAlias(SessionTableMap::COL_SESSION_PK, $sessionRungroup->getSessionFk(), $comparison);
        } elseif ($sessionRungroup instanceof ObjectCollection) {
            return $this
                ->useSessionRungroupQuery()
                ->filterByPrimaryKeys($sessionRungroup->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySessionRungroup() only accepts arguments of type \SessionRungroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SessionRungroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function joinSessionRungroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SessionRungroup');

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
            $this->addJoinObject($join, 'SessionRungroup');
        }

        return $this;
    }

    /**
     * Use the SessionRungroup relation SessionRungroup object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SessionRungroupQuery A secondary query class using the current class as primary query
     */
    public function useSessionRungroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSessionRungroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SessionRungroup', '\SessionRungroupQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSession $session Object to remove from the list of results
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function prune($session = null)
    {
        if ($session) {
            $this->addUsingAlias(SessionTableMap::COL_SESSION_PK, $session->getSessionPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the session table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SessionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SessionTableMap::clearInstancePool();
            SessionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SessionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SessionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SessionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SessionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SessionQuery
