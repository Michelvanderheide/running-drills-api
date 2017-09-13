<?php

namespace Base;

use \Account as ChildAccount;
use \AccountQuery as ChildAccountQuery;
use \Exception;
use \PDO;
use Map\AccountTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'account' table.
 *
 *
 *
 * @method     ChildAccountQuery orderByAccountPk($order = Criteria::ASC) Order by the account_pk column
 * @method     ChildAccountQuery orderByGuid($order = Criteria::ASC) Order by the guid column
 * @method     ChildAccountQuery orderByAccountName($order = Criteria::ASC) Order by the account_name column
 * @method     ChildAccountQuery orderByAccountEmail($order = Criteria::ASC) Order by the account_email column
 * @method     ChildAccountQuery orderByAccountPassword($order = Criteria::ASC) Order by the account_password column
 * @method     ChildAccountQuery orderByIsRemoved($order = Criteria::ASC) Order by the is_removed column
 *
 * @method     ChildAccountQuery groupByAccountPk() Group by the account_pk column
 * @method     ChildAccountQuery groupByGuid() Group by the guid column
 * @method     ChildAccountQuery groupByAccountName() Group by the account_name column
 * @method     ChildAccountQuery groupByAccountEmail() Group by the account_email column
 * @method     ChildAccountQuery groupByAccountPassword() Group by the account_password column
 * @method     ChildAccountQuery groupByIsRemoved() Group by the is_removed column
 *
 * @method     ChildAccountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAccountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAccountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAccountQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAccountQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAccountQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAccountQuery leftJoinRungroupAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the RungroupAccount relation
 * @method     ChildAccountQuery rightJoinRungroupAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RungroupAccount relation
 * @method     ChildAccountQuery innerJoinRungroupAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the RungroupAccount relation
 *
 * @method     ChildAccountQuery joinWithRungroupAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RungroupAccount relation
 *
 * @method     ChildAccountQuery leftJoinWithRungroupAccount() Adds a LEFT JOIN clause and with to the query using the RungroupAccount relation
 * @method     ChildAccountQuery rightJoinWithRungroupAccount() Adds a RIGHT JOIN clause and with to the query using the RungroupAccount relation
 * @method     ChildAccountQuery innerJoinWithRungroupAccount() Adds a INNER JOIN clause and with to the query using the RungroupAccount relation
 *
 * @method     \RungroupAccountQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAccount findOne(ConnectionInterface $con = null) Return the first ChildAccount matching the query
 * @method     ChildAccount findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAccount matching the query, or a new ChildAccount object populated from the query conditions when no match is found
 *
 * @method     ChildAccount findOneByAccountPk(int $account_pk) Return the first ChildAccount filtered by the account_pk column
 * @method     ChildAccount findOneByGuid(string $guid) Return the first ChildAccount filtered by the guid column
 * @method     ChildAccount findOneByAccountName(string $account_name) Return the first ChildAccount filtered by the account_name column
 * @method     ChildAccount findOneByAccountEmail(string $account_email) Return the first ChildAccount filtered by the account_email column
 * @method     ChildAccount findOneByAccountPassword(string $account_password) Return the first ChildAccount filtered by the account_password column
 * @method     ChildAccount findOneByIsRemoved(boolean $is_removed) Return the first ChildAccount filtered by the is_removed column *

 * @method     ChildAccount requirePk($key, ConnectionInterface $con = null) Return the ChildAccount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOne(ConnectionInterface $con = null) Return the first ChildAccount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccount requireOneByAccountPk(int $account_pk) Return the first ChildAccount filtered by the account_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByGuid(string $guid) Return the first ChildAccount filtered by the guid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByAccountName(string $account_name) Return the first ChildAccount filtered by the account_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByAccountEmail(string $account_email) Return the first ChildAccount filtered by the account_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByAccountPassword(string $account_password) Return the first ChildAccount filtered by the account_password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccount requireOneByIsRemoved(boolean $is_removed) Return the first ChildAccount filtered by the is_removed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccount[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAccount objects based on current ModelCriteria
 * @method     ChildAccount[]|ObjectCollection findByAccountPk(int $account_pk) Return ChildAccount objects filtered by the account_pk column
 * @method     ChildAccount[]|ObjectCollection findByGuid(string $guid) Return ChildAccount objects filtered by the guid column
 * @method     ChildAccount[]|ObjectCollection findByAccountName(string $account_name) Return ChildAccount objects filtered by the account_name column
 * @method     ChildAccount[]|ObjectCollection findByAccountEmail(string $account_email) Return ChildAccount objects filtered by the account_email column
 * @method     ChildAccount[]|ObjectCollection findByAccountPassword(string $account_password) Return ChildAccount objects filtered by the account_password column
 * @method     ChildAccount[]|ObjectCollection findByIsRemoved(boolean $is_removed) Return ChildAccount objects filtered by the is_removed column
 * @method     ChildAccount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AccountQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\AccountQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\Account', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAccountQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAccountQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAccountQuery) {
            return $criteria;
        }
        $query = new ChildAccountQuery();
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
     * @return ChildAccount|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AccountTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AccountTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAccount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT account_pk, guid, account_name, account_email, account_password, is_removed FROM account WHERE account_pk = :p0';
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
            /** @var ChildAccount $obj */
            $obj = new ChildAccount();
            $obj->hydrate($row);
            AccountTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAccount|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the account_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountPk(1234); // WHERE account_pk = 1234
     * $query->filterByAccountPk(array(12, 34)); // WHERE account_pk IN (12, 34)
     * $query->filterByAccountPk(array('min' => 12)); // WHERE account_pk > 12
     * </code>
     *
     * @param     mixed $accountPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByAccountPk($accountPk = null, $comparison = null)
    {
        if (is_array($accountPk)) {
            $useMinMax = false;
            if (isset($accountPk['min'])) {
                $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_PK, $accountPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accountPk['max'])) {
                $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_PK, $accountPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_PK, $accountPk, $comparison);
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
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByGuid($guid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($guid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_GUID, $guid, $comparison);
    }

    /**
     * Filter the query on the account_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountName('fooValue');   // WHERE account_name = 'fooValue'
     * $query->filterByAccountName('%fooValue%', Criteria::LIKE); // WHERE account_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accountName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByAccountName($accountName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accountName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_NAME, $accountName, $comparison);
    }

    /**
     * Filter the query on the account_email column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountEmail('fooValue');   // WHERE account_email = 'fooValue'
     * $query->filterByAccountEmail('%fooValue%', Criteria::LIKE); // WHERE account_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accountEmail The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByAccountEmail($accountEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accountEmail)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_EMAIL, $accountEmail, $comparison);
    }

    /**
     * Filter the query on the account_password column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountPassword('fooValue');   // WHERE account_password = 'fooValue'
     * $query->filterByAccountPassword('%fooValue%', Criteria::LIKE); // WHERE account_password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accountPassword The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByAccountPassword($accountPassword = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accountPassword)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_PASSWORD, $accountPassword, $comparison);
    }

    /**
     * Filter the query on the is_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByIsRemoved(true); // WHERE is_removed = true
     * $query->filterByIsRemoved('yes'); // WHERE is_removed = true
     * </code>
     *
     * @param     boolean|string $isRemoved The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function filterByIsRemoved($isRemoved = null, $comparison = null)
    {
        if (is_string($isRemoved)) {
            $isRemoved = in_array(strtolower($isRemoved), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AccountTableMap::COL_IS_REMOVED, $isRemoved, $comparison);
    }

    /**
     * Filter the query by a related \RungroupAccount object
     *
     * @param \RungroupAccount|ObjectCollection $rungroupAccount the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAccountQuery The current query, for fluid interface
     */
    public function filterByRungroupAccount($rungroupAccount, $comparison = null)
    {
        if ($rungroupAccount instanceof \RungroupAccount) {
            return $this
                ->addUsingAlias(AccountTableMap::COL_ACCOUNT_PK, $rungroupAccount->getAccountFk(), $comparison);
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
     * @return $this|ChildAccountQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildAccount $account Object to remove from the list of results
     *
     * @return $this|ChildAccountQuery The current query, for fluid interface
     */
    public function prune($account = null)
    {
        if ($account) {
            $this->addUsingAlias(AccountTableMap::COL_ACCOUNT_PK, $account->getAccountPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AccountTableMap::clearInstancePool();
            AccountTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AccountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AccountTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AccountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AccountTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AccountQuery
