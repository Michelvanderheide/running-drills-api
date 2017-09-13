<?php

namespace Base;

use \Rungroup as ChildRungroup;
use \RungroupQuery as ChildRungroupQuery;
use \Exception;
use \PDO;
use Map\RungroupTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rungroup' table.
 *
 *
 *
 * @method     ChildRungroupQuery orderByRungroupPk($order = Criteria::ASC) Order by the rungroup_pk column
 * @method     ChildRungroupQuery orderByRungroupName($order = Criteria::ASC) Order by the rungroup_name column
 *
 * @method     ChildRungroupQuery groupByRungroupPk() Group by the rungroup_pk column
 * @method     ChildRungroupQuery groupByRungroupName() Group by the rungroup_name column
 *
 * @method     ChildRungroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRungroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRungroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRungroupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRungroupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRungroupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRungroupQuery leftJoinRungroupAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the RungroupAccount relation
 * @method     ChildRungroupQuery rightJoinRungroupAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RungroupAccount relation
 * @method     ChildRungroupQuery innerJoinRungroupAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the RungroupAccount relation
 *
 * @method     ChildRungroupQuery joinWithRungroupAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RungroupAccount relation
 *
 * @method     ChildRungroupQuery leftJoinWithRungroupAccount() Adds a LEFT JOIN clause and with to the query using the RungroupAccount relation
 * @method     ChildRungroupQuery rightJoinWithRungroupAccount() Adds a RIGHT JOIN clause and with to the query using the RungroupAccount relation
 * @method     ChildRungroupQuery innerJoinWithRungroupAccount() Adds a INNER JOIN clause and with to the query using the RungroupAccount relation
 *
 * @method     ChildRungroupQuery leftJoinSessionRungroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the SessionRungroup relation
 * @method     ChildRungroupQuery rightJoinSessionRungroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SessionRungroup relation
 * @method     ChildRungroupQuery innerJoinSessionRungroup($relationAlias = null) Adds a INNER JOIN clause to the query using the SessionRungroup relation
 *
 * @method     ChildRungroupQuery joinWithSessionRungroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SessionRungroup relation
 *
 * @method     ChildRungroupQuery leftJoinWithSessionRungroup() Adds a LEFT JOIN clause and with to the query using the SessionRungroup relation
 * @method     ChildRungroupQuery rightJoinWithSessionRungroup() Adds a RIGHT JOIN clause and with to the query using the SessionRungroup relation
 * @method     ChildRungroupQuery innerJoinWithSessionRungroup() Adds a INNER JOIN clause and with to the query using the SessionRungroup relation
 *
 * @method     \RungroupAccountQuery|\SessionRungroupQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRungroup findOne(ConnectionInterface $con = null) Return the first ChildRungroup matching the query
 * @method     ChildRungroup findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRungroup matching the query, or a new ChildRungroup object populated from the query conditions when no match is found
 *
 * @method     ChildRungroup findOneByRungroupPk(int $rungroup_pk) Return the first ChildRungroup filtered by the rungroup_pk column
 * @method     ChildRungroup findOneByRungroupName(string $rungroup_name) Return the first ChildRungroup filtered by the rungroup_name column *

 * @method     ChildRungroup requirePk($key, ConnectionInterface $con = null) Return the ChildRungroup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRungroup requireOne(ConnectionInterface $con = null) Return the first ChildRungroup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRungroup requireOneByRungroupPk(int $rungroup_pk) Return the first ChildRungroup filtered by the rungroup_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRungroup requireOneByRungroupName(string $rungroup_name) Return the first ChildRungroup filtered by the rungroup_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRungroup[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRungroup objects based on current ModelCriteria
 * @method     ChildRungroup[]|ObjectCollection findByRungroupPk(int $rungroup_pk) Return ChildRungroup objects filtered by the rungroup_pk column
 * @method     ChildRungroup[]|ObjectCollection findByRungroupName(string $rungroup_name) Return ChildRungroup objects filtered by the rungroup_name column
 * @method     ChildRungroup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RungroupQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RungroupQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\Rungroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRungroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRungroupQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRungroupQuery) {
            return $criteria;
        }
        $query = new ChildRungroupQuery();
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
     * @return ChildRungroup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RungroupTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RungroupTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRungroup A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT rungroup_pk, rungroup_name FROM rungroup WHERE rungroup_pk = :p0';
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
            /** @var ChildRungroup $obj */
            $obj = new ChildRungroup();
            $obj->hydrate($row);
            RungroupTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRungroup|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRungroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RungroupTableMap::COL_RUNGROUP_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRungroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RungroupTableMap::COL_RUNGROUP_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the rungroup_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByRungroupPk(1234); // WHERE rungroup_pk = 1234
     * $query->filterByRungroupPk(array(12, 34)); // WHERE rungroup_pk IN (12, 34)
     * $query->filterByRungroupPk(array('min' => 12)); // WHERE rungroup_pk > 12
     * </code>
     *
     * @param     mixed $rungroupPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRungroupQuery The current query, for fluid interface
     */
    public function filterByRungroupPk($rungroupPk = null, $comparison = null)
    {
        if (is_array($rungroupPk)) {
            $useMinMax = false;
            if (isset($rungroupPk['min'])) {
                $this->addUsingAlias(RungroupTableMap::COL_RUNGROUP_PK, $rungroupPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rungroupPk['max'])) {
                $this->addUsingAlias(RungroupTableMap::COL_RUNGROUP_PK, $rungroupPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RungroupTableMap::COL_RUNGROUP_PK, $rungroupPk, $comparison);
    }

    /**
     * Filter the query on the rungroup_name column
     *
     * Example usage:
     * <code>
     * $query->filterByRungroupName('fooValue');   // WHERE rungroup_name = 'fooValue'
     * $query->filterByRungroupName('%fooValue%', Criteria::LIKE); // WHERE rungroup_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rungroupName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRungroupQuery The current query, for fluid interface
     */
    public function filterByRungroupName($rungroupName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rungroupName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RungroupTableMap::COL_RUNGROUP_NAME, $rungroupName, $comparison);
    }

    /**
     * Filter the query by a related \RungroupAccount object
     *
     * @param \RungroupAccount|ObjectCollection $rungroupAccount the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRungroupQuery The current query, for fluid interface
     */
    public function filterByRungroupAccount($rungroupAccount, $comparison = null)
    {
        if ($rungroupAccount instanceof \RungroupAccount) {
            return $this
                ->addUsingAlias(RungroupTableMap::COL_RUNGROUP_PK, $rungroupAccount->getRungroupFk(), $comparison);
        } elseif ($rungroupAccount instanceof ObjectCollection) {
            return $this
                ->useRungroupAccountQuery()
                ->filterByPrimaryKeys($rungroupAccount->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRungroupAccount() only accepts arguments of type \RungroupAccount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RungroupAccount relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRungroupQuery The current query, for fluid interface
     */
    public function joinRungroupAccount($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RungroupAccount');

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
            $this->addJoinObject($join, 'RungroupAccount');
        }

        return $this;
    }

    /**
     * Use the RungroupAccount relation RungroupAccount object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RungroupAccountQuery A secondary query class using the current class as primary query
     */
    public function useRungroupAccountQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRungroupAccount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RungroupAccount', '\RungroupAccountQuery');
    }

    /**
     * Filter the query by a related \SessionRungroup object
     *
     * @param \SessionRungroup|ObjectCollection $sessionRungroup the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRungroupQuery The current query, for fluid interface
     */
    public function filterBySessionRungroup($sessionRungroup, $comparison = null)
    {
        if ($sessionRungroup instanceof \SessionRungroup) {
            return $this
                ->addUsingAlias(RungroupTableMap::COL_RUNGROUP_PK, $sessionRungroup->getRungroupFk(), $comparison);
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
     * @return $this|ChildRungroupQuery The current query, for fluid interface
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
     * @param   ChildRungroup $rungroup Object to remove from the list of results
     *
     * @return $this|ChildRungroupQuery The current query, for fluid interface
     */
    public function prune($rungroup = null)
    {
        if ($rungroup) {
            $this->addUsingAlias(RungroupTableMap::COL_RUNGROUP_PK, $rungroup->getRungroupPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rungroup table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RungroupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RungroupTableMap::clearInstancePool();
            RungroupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RungroupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RungroupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RungroupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RungroupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RungroupQuery
