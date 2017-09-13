<?php

namespace Base;

use \RungroupAccount as ChildRungroupAccount;
use \RungroupAccountQuery as ChildRungroupAccountQuery;
use \Exception;
use \PDO;
use Map\RungroupAccountTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rungroup_account' table.
 *
 *
 *
 * @method     ChildRungroupAccountQuery orderByRungroupAccountPk($order = Criteria::ASC) Order by the rungroup_account_pk column
 * @method     ChildRungroupAccountQuery orderByAccountFk($order = Criteria::ASC) Order by the account_fk column
 * @method     ChildRungroupAccountQuery orderByRungroupFk($order = Criteria::ASC) Order by the rungroup_fk column
 *
 * @method     ChildRungroupAccountQuery groupByRungroupAccountPk() Group by the rungroup_account_pk column
 * @method     ChildRungroupAccountQuery groupByAccountFk() Group by the account_fk column
 * @method     ChildRungroupAccountQuery groupByRungroupFk() Group by the rungroup_fk column
 *
 * @method     ChildRungroupAccountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRungroupAccountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRungroupAccountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRungroupAccountQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRungroupAccountQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRungroupAccountQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRungroupAccountQuery leftJoinAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Account relation
 * @method     ChildRungroupAccountQuery rightJoinAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Account relation
 * @method     ChildRungroupAccountQuery innerJoinAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the Account relation
 *
 * @method     ChildRungroupAccountQuery joinWithAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Account relation
 *
 * @method     ChildRungroupAccountQuery leftJoinWithAccount() Adds a LEFT JOIN clause and with to the query using the Account relation
 * @method     ChildRungroupAccountQuery rightJoinWithAccount() Adds a RIGHT JOIN clause and with to the query using the Account relation
 * @method     ChildRungroupAccountQuery innerJoinWithAccount() Adds a INNER JOIN clause and with to the query using the Account relation
 *
 * @method     ChildRungroupAccountQuery leftJoinRungroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rungroup relation
 * @method     ChildRungroupAccountQuery rightJoinRungroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rungroup relation
 * @method     ChildRungroupAccountQuery innerJoinRungroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Rungroup relation
 *
 * @method     ChildRungroupAccountQuery joinWithRungroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Rungroup relation
 *
 * @method     ChildRungroupAccountQuery leftJoinWithRungroup() Adds a LEFT JOIN clause and with to the query using the Rungroup relation
 * @method     ChildRungroupAccountQuery rightJoinWithRungroup() Adds a RIGHT JOIN clause and with to the query using the Rungroup relation
 * @method     ChildRungroupAccountQuery innerJoinWithRungroup() Adds a INNER JOIN clause and with to the query using the Rungroup relation
 *
 * @method     \AccountQuery|\RungroupQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRungroupAccount findOne(ConnectionInterface $con = null) Return the first ChildRungroupAccount matching the query
 * @method     ChildRungroupAccount findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRungroupAccount matching the query, or a new ChildRungroupAccount object populated from the query conditions when no match is found
 *
 * @method     ChildRungroupAccount findOneByRungroupAccountPk(int $rungroup_account_pk) Return the first ChildRungroupAccount filtered by the rungroup_account_pk column
 * @method     ChildRungroupAccount findOneByAccountFk(int $account_fk) Return the first ChildRungroupAccount filtered by the account_fk column
 * @method     ChildRungroupAccount findOneByRungroupFk(int $rungroup_fk) Return the first ChildRungroupAccount filtered by the rungroup_fk column *

 * @method     ChildRungroupAccount requirePk($key, ConnectionInterface $con = null) Return the ChildRungroupAccount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRungroupAccount requireOne(ConnectionInterface $con = null) Return the first ChildRungroupAccount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRungroupAccount requireOneByRungroupAccountPk(int $rungroup_account_pk) Return the first ChildRungroupAccount filtered by the rungroup_account_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRungroupAccount requireOneByAccountFk(int $account_fk) Return the first ChildRungroupAccount filtered by the account_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRungroupAccount requireOneByRungroupFk(int $rungroup_fk) Return the first ChildRungroupAccount filtered by the rungroup_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRungroupAccount[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRungroupAccount objects based on current ModelCriteria
 * @method     ChildRungroupAccount[]|ObjectCollection findByRungroupAccountPk(int $rungroup_account_pk) Return ChildRungroupAccount objects filtered by the rungroup_account_pk column
 * @method     ChildRungroupAccount[]|ObjectCollection findByAccountFk(int $account_fk) Return ChildRungroupAccount objects filtered by the account_fk column
 * @method     ChildRungroupAccount[]|ObjectCollection findByRungroupFk(int $rungroup_fk) Return ChildRungroupAccount objects filtered by the rungroup_fk column
 * @method     ChildRungroupAccount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RungroupAccountQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RungroupAccountQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\RungroupAccount', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRungroupAccountQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRungroupAccountQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRungroupAccountQuery) {
            return $criteria;
        }
        $query = new ChildRungroupAccountQuery();
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
     * @return ChildRungroupAccount|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RungroupAccountTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RungroupAccountTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRungroupAccount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT rungroup_account_pk, account_fk, rungroup_fk FROM rungroup_account WHERE rungroup_account_pk = :p0';
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
            /** @var ChildRungroupAccount $obj */
            $obj = new ChildRungroupAccount();
            $obj->hydrate($row);
            RungroupAccountTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRungroupAccount|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRungroupAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRungroupAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the rungroup_account_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByRungroupAccountPk(1234); // WHERE rungroup_account_pk = 1234
     * $query->filterByRungroupAccountPk(array(12, 34)); // WHERE rungroup_account_pk IN (12, 34)
     * $query->filterByRungroupAccountPk(array('min' => 12)); // WHERE rungroup_account_pk > 12
     * </code>
     *
     * @param     mixed $rungroupAccountPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRungroupAccountQuery The current query, for fluid interface
     */
    public function filterByRungroupAccountPk($rungroupAccountPk = null, $comparison = null)
    {
        if (is_array($rungroupAccountPk)) {
            $useMinMax = false;
            if (isset($rungroupAccountPk['min'])) {
                $this->addUsingAlias(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK, $rungroupAccountPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rungroupAccountPk['max'])) {
                $this->addUsingAlias(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK, $rungroupAccountPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK, $rungroupAccountPk, $comparison);
    }

    /**
     * Filter the query on the account_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountFk(1234); // WHERE account_fk = 1234
     * $query->filterByAccountFk(array(12, 34)); // WHERE account_fk IN (12, 34)
     * $query->filterByAccountFk(array('min' => 12)); // WHERE account_fk > 12
     * </code>
     *
     * @see       filterByAccount()
     *
     * @param     mixed $accountFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRungroupAccountQuery The current query, for fluid interface
     */
    public function filterByAccountFk($accountFk = null, $comparison = null)
    {
        if (is_array($accountFk)) {
            $useMinMax = false;
            if (isset($accountFk['min'])) {
                $this->addUsingAlias(RungroupAccountTableMap::COL_ACCOUNT_FK, $accountFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accountFk['max'])) {
                $this->addUsingAlias(RungroupAccountTableMap::COL_ACCOUNT_FK, $accountFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RungroupAccountTableMap::COL_ACCOUNT_FK, $accountFk, $comparison);
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
     * @return $this|ChildRungroupAccountQuery The current query, for fluid interface
     */
    public function filterByRungroupFk($rungroupFk = null, $comparison = null)
    {
        if (is_array($rungroupFk)) {
            $useMinMax = false;
            if (isset($rungroupFk['min'])) {
                $this->addUsingAlias(RungroupAccountTableMap::COL_RUNGROUP_FK, $rungroupFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rungroupFk['max'])) {
                $this->addUsingAlias(RungroupAccountTableMap::COL_RUNGROUP_FK, $rungroupFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RungroupAccountTableMap::COL_RUNGROUP_FK, $rungroupFk, $comparison);
    }

    /**
     * Filter the query by a related \Account object
     *
     * @param \Account|ObjectCollection $account The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRungroupAccountQuery The current query, for fluid interface
     */
    public function filterByAccount($account, $comparison = null)
    {
        if ($account instanceof \Account) {
            return $this
                ->addUsingAlias(RungroupAccountTableMap::COL_ACCOUNT_FK, $account->getAccountPk(), $comparison);
        } elseif ($account instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RungroupAccountTableMap::COL_ACCOUNT_FK, $account->toKeyValue('PrimaryKey', 'AccountPk'), $comparison);
        } else {
            throw new PropelException('filterByAccount() only accepts arguments of type \Account or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Account relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRungroupAccountQuery The current query, for fluid interface
     */
    public function joinAccount($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Account');

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
            $this->addJoinObject($join, 'Account');
        }

        return $this;
    }

    /**
     * Use the Account relation Account object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AccountQuery A secondary query class using the current class as primary query
     */
    public function useAccountQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAccount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Account', '\AccountQuery');
    }

    /**
     * Filter the query by a related \Rungroup object
     *
     * @param \Rungroup|ObjectCollection $rungroup The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRungroupAccountQuery The current query, for fluid interface
     */
    public function filterByRungroup($rungroup, $comparison = null)
    {
        if ($rungroup instanceof \Rungroup) {
            return $this
                ->addUsingAlias(RungroupAccountTableMap::COL_RUNGROUP_FK, $rungroup->getRungroupPk(), $comparison);
        } elseif ($rungroup instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RungroupAccountTableMap::COL_RUNGROUP_FK, $rungroup->toKeyValue('PrimaryKey', 'RungroupPk'), $comparison);
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
     * @return $this|ChildRungroupAccountQuery The current query, for fluid interface
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
     * @param   ChildRungroupAccount $rungroupAccount Object to remove from the list of results
     *
     * @return $this|ChildRungroupAccountQuery The current query, for fluid interface
     */
    public function prune($rungroupAccount = null)
    {
        if ($rungroupAccount) {
            $this->addUsingAlias(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK, $rungroupAccount->getRungroupAccountPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rungroup_account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RungroupAccountTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RungroupAccountTableMap::clearInstancePool();
            RungroupAccountTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RungroupAccountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RungroupAccountTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RungroupAccountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RungroupAccountTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RungroupAccountQuery
