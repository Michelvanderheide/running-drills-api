<?php

namespace Base;

use \Group as ChildGroup;
use \GroupQuery as ChildGroupQuery;
use \Exception;
use \PDO;
use Map\GroupTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'group' table.
 *
 *
 *
 * @method     ChildGroupQuery orderByGroupPk($order = Criteria::ASC) Order by the group_pk column
 * @method     ChildGroupQuery orderByGroupName($order = Criteria::ASC) Order by the group_name column
 *
 * @method     ChildGroupQuery groupByGroupPk() Group by the group_pk column
 * @method     ChildGroupQuery groupByGroupName() Group by the group_name column
 *
 * @method     ChildGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGroupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGroupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGroupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGroupQuery leftJoinUserGroupMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserGroupMapping relation
 * @method     ChildGroupQuery rightJoinUserGroupMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserGroupMapping relation
 * @method     ChildGroupQuery innerJoinUserGroupMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the UserGroupMapping relation
 *
 * @method     ChildGroupQuery joinWithUserGroupMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserGroupMapping relation
 *
 * @method     ChildGroupQuery leftJoinWithUserGroupMapping() Adds a LEFT JOIN clause and with to the query using the UserGroupMapping relation
 * @method     ChildGroupQuery rightJoinWithUserGroupMapping() Adds a RIGHT JOIN clause and with to the query using the UserGroupMapping relation
 * @method     ChildGroupQuery innerJoinWithUserGroupMapping() Adds a INNER JOIN clause and with to the query using the UserGroupMapping relation
 *
 * @method     \UserGroupMappingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGroup findOne(ConnectionInterface $con = null) Return the first ChildGroup matching the query
 * @method     ChildGroup findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGroup matching the query, or a new ChildGroup object populated from the query conditions when no match is found
 *
 * @method     ChildGroup findOneByGroupPk(int $group_pk) Return the first ChildGroup filtered by the group_pk column
 * @method     ChildGroup findOneByGroupName(string $group_name) Return the first ChildGroup filtered by the group_name column *

 * @method     ChildGroup requirePk($key, ConnectionInterface $con = null) Return the ChildGroup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOne(ConnectionInterface $con = null) Return the first ChildGroup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroup requireOneByGroupPk(int $group_pk) Return the first ChildGroup filtered by the group_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByGroupName(string $group_name) Return the first ChildGroup filtered by the group_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroup[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGroup objects based on current ModelCriteria
 * @method     ChildGroup[]|ObjectCollection findByGroupPk(int $group_pk) Return ChildGroup objects filtered by the group_pk column
 * @method     ChildGroup[]|ObjectCollection findByGroupName(string $group_name) Return ChildGroup objects filtered by the group_name column
 * @method     ChildGroup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GroupQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GroupQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\Group', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGroupQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGroupQuery) {
            return $criteria;
        }
        $query = new ChildGroupQuery();
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
     * @return ChildGroup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GroupTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GroupTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGroup A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT group_pk, group_name FROM group WHERE group_pk = :p0';
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
            /** @var ChildGroup $obj */
            $obj = new ChildGroup();
            $obj->hydrate($row);
            GroupTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGroup|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GroupTableMap::COL_GROUP_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GroupTableMap::COL_GROUP_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the group_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupPk(1234); // WHERE group_pk = 1234
     * $query->filterByGroupPk(array(12, 34)); // WHERE group_pk IN (12, 34)
     * $query->filterByGroupPk(array('min' => 12)); // WHERE group_pk > 12
     * </code>
     *
     * @param     mixed $groupPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByGroupPk($groupPk = null, $comparison = null)
    {
        if (is_array($groupPk)) {
            $useMinMax = false;
            if (isset($groupPk['min'])) {
                $this->addUsingAlias(GroupTableMap::COL_GROUP_PK, $groupPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupPk['max'])) {
                $this->addUsingAlias(GroupTableMap::COL_GROUP_PK, $groupPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_GROUP_PK, $groupPk, $comparison);
    }

    /**
     * Filter the query on the group_name column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupName('fooValue');   // WHERE group_name = 'fooValue'
     * $query->filterByGroupName('%fooValue%', Criteria::LIKE); // WHERE group_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $groupName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByGroupName($groupName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_GROUP_NAME, $groupName, $comparison);
    }

    /**
     * Filter the query by a related \UserGroupMapping object
     *
     * @param \UserGroupMapping|ObjectCollection $userGroupMapping the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGroupQuery The current query, for fluid interface
     */
    public function filterByUserGroupMapping($userGroupMapping, $comparison = null)
    {
        if ($userGroupMapping instanceof \UserGroupMapping) {
            return $this
                ->addUsingAlias(GroupTableMap::COL_GROUP_PK, $userGroupMapping->getGroupFk(), $comparison);
        } elseif ($userGroupMapping instanceof ObjectCollection) {
            return $this
                ->useUserGroupMappingQuery()
                ->filterByPrimaryKeys($userGroupMapping->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserGroupMapping() only accepts arguments of type \UserGroupMapping or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserGroupMapping relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function joinUserGroupMapping($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserGroupMapping');

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
            $this->addJoinObject($join, 'UserGroupMapping');
        }

        return $this;
    }

    /**
     * Use the UserGroupMapping relation UserGroupMapping object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserGroupMappingQuery A secondary query class using the current class as primary query
     */
    public function useUserGroupMappingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserGroupMapping($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserGroupMapping', '\UserGroupMappingQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGroup $group Object to remove from the list of results
     *
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function prune($group = null)
    {
        if ($group) {
            $this->addUsingAlias(GroupTableMap::COL_GROUP_PK, $group->getGroupPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the group table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GroupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GroupTableMap::clearInstancePool();
            GroupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GroupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GroupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GroupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GroupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GroupQuery
