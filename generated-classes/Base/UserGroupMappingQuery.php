<?php

namespace Base;

use \UserGroupMapping as ChildUserGroupMapping;
use \UserGroupMappingQuery as ChildUserGroupMappingQuery;
use \Exception;
use \PDO;
use Map\UserGroupMappingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_group_mapping' table.
 *
 *
 *
 * @method     ChildUserGroupMappingQuery orderByUserGroupMappingPk($order = Criteria::ASC) Order by the user_group_mapping_pk column
 * @method     ChildUserGroupMappingQuery orderByUserFk($order = Criteria::ASC) Order by the user_fk column
 * @method     ChildUserGroupMappingQuery orderByGroupFk($order = Criteria::ASC) Order by the group_fk column
 *
 * @method     ChildUserGroupMappingQuery groupByUserGroupMappingPk() Group by the user_group_mapping_pk column
 * @method     ChildUserGroupMappingQuery groupByUserFk() Group by the user_fk column
 * @method     ChildUserGroupMappingQuery groupByGroupFk() Group by the group_fk column
 *
 * @method     ChildUserGroupMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserGroupMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserGroupMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserGroupMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserGroupMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserGroupMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserGroupMappingQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUserGroupMappingQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUserGroupMappingQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildUserGroupMappingQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildUserGroupMappingQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildUserGroupMappingQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildUserGroupMappingQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildUserGroupMappingQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method     ChildUserGroupMappingQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method     ChildUserGroupMappingQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method     ChildUserGroupMappingQuery joinWithGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Group relation
 *
 * @method     ChildUserGroupMappingQuery leftJoinWithGroup() Adds a LEFT JOIN clause and with to the query using the Group relation
 * @method     ChildUserGroupMappingQuery rightJoinWithGroup() Adds a RIGHT JOIN clause and with to the query using the Group relation
 * @method     ChildUserGroupMappingQuery innerJoinWithGroup() Adds a INNER JOIN clause and with to the query using the Group relation
 *
 * @method     \UserQuery|\GroupQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserGroupMapping findOne(ConnectionInterface $con = null) Return the first ChildUserGroupMapping matching the query
 * @method     ChildUserGroupMapping findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserGroupMapping matching the query, or a new ChildUserGroupMapping object populated from the query conditions when no match is found
 *
 * @method     ChildUserGroupMapping findOneByUserGroupMappingPk(int $user_group_mapping_pk) Return the first ChildUserGroupMapping filtered by the user_group_mapping_pk column
 * @method     ChildUserGroupMapping findOneByUserFk(int $user_fk) Return the first ChildUserGroupMapping filtered by the user_fk column
 * @method     ChildUserGroupMapping findOneByGroupFk(int $group_fk) Return the first ChildUserGroupMapping filtered by the group_fk column *

 * @method     ChildUserGroupMapping requirePk($key, ConnectionInterface $con = null) Return the ChildUserGroupMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserGroupMapping requireOne(ConnectionInterface $con = null) Return the first ChildUserGroupMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserGroupMapping requireOneByUserGroupMappingPk(int $user_group_mapping_pk) Return the first ChildUserGroupMapping filtered by the user_group_mapping_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserGroupMapping requireOneByUserFk(int $user_fk) Return the first ChildUserGroupMapping filtered by the user_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserGroupMapping requireOneByGroupFk(int $group_fk) Return the first ChildUserGroupMapping filtered by the group_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserGroupMapping[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserGroupMapping objects based on current ModelCriteria
 * @method     ChildUserGroupMapping[]|ObjectCollection findByUserGroupMappingPk(int $user_group_mapping_pk) Return ChildUserGroupMapping objects filtered by the user_group_mapping_pk column
 * @method     ChildUserGroupMapping[]|ObjectCollection findByUserFk(int $user_fk) Return ChildUserGroupMapping objects filtered by the user_fk column
 * @method     ChildUserGroupMapping[]|ObjectCollection findByGroupFk(int $group_fk) Return ChildUserGroupMapping objects filtered by the group_fk column
 * @method     ChildUserGroupMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserGroupMappingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserGroupMappingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\UserGroupMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserGroupMappingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserGroupMappingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserGroupMappingQuery) {
            return $criteria;
        }
        $query = new ChildUserGroupMappingQuery();
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
     * @return ChildUserGroupMapping|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserGroupMappingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserGroupMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUserGroupMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT user_group_mapping_pk, user_fk, group_fk FROM user_group_mapping WHERE user_group_mapping_pk = :p0';
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
            /** @var ChildUserGroupMapping $obj */
            $obj = new ChildUserGroupMapping();
            $obj->hydrate($row);
            UserGroupMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUserGroupMapping|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserGroupMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserGroupMappingTableMap::COL_USER_GROUP_MAPPING_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserGroupMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserGroupMappingTableMap::COL_USER_GROUP_MAPPING_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the user_group_mapping_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByUserGroupMappingPk(1234); // WHERE user_group_mapping_pk = 1234
     * $query->filterByUserGroupMappingPk(array(12, 34)); // WHERE user_group_mapping_pk IN (12, 34)
     * $query->filterByUserGroupMappingPk(array('min' => 12)); // WHERE user_group_mapping_pk > 12
     * </code>
     *
     * @param     mixed $userGroupMappingPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserGroupMappingQuery The current query, for fluid interface
     */
    public function filterByUserGroupMappingPk($userGroupMappingPk = null, $comparison = null)
    {
        if (is_array($userGroupMappingPk)) {
            $useMinMax = false;
            if (isset($userGroupMappingPk['min'])) {
                $this->addUsingAlias(UserGroupMappingTableMap::COL_USER_GROUP_MAPPING_PK, $userGroupMappingPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userGroupMappingPk['max'])) {
                $this->addUsingAlias(UserGroupMappingTableMap::COL_USER_GROUP_MAPPING_PK, $userGroupMappingPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGroupMappingTableMap::COL_USER_GROUP_MAPPING_PK, $userGroupMappingPk, $comparison);
    }

    /**
     * Filter the query on the user_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByUserFk(1234); // WHERE user_fk = 1234
     * $query->filterByUserFk(array(12, 34)); // WHERE user_fk IN (12, 34)
     * $query->filterByUserFk(array('min' => 12)); // WHERE user_fk > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserGroupMappingQuery The current query, for fluid interface
     */
    public function filterByUserFk($userFk = null, $comparison = null)
    {
        if (is_array($userFk)) {
            $useMinMax = false;
            if (isset($userFk['min'])) {
                $this->addUsingAlias(UserGroupMappingTableMap::COL_USER_FK, $userFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userFk['max'])) {
                $this->addUsingAlias(UserGroupMappingTableMap::COL_USER_FK, $userFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGroupMappingTableMap::COL_USER_FK, $userFk, $comparison);
    }

    /**
     * Filter the query on the group_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupFk(1234); // WHERE group_fk = 1234
     * $query->filterByGroupFk(array(12, 34)); // WHERE group_fk IN (12, 34)
     * $query->filterByGroupFk(array('min' => 12)); // WHERE group_fk > 12
     * </code>
     *
     * @see       filterByGroup()
     *
     * @param     mixed $groupFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserGroupMappingQuery The current query, for fluid interface
     */
    public function filterByGroupFk($groupFk = null, $comparison = null)
    {
        if (is_array($groupFk)) {
            $useMinMax = false;
            if (isset($groupFk['min'])) {
                $this->addUsingAlias(UserGroupMappingTableMap::COL_GROUP_FK, $groupFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupFk['max'])) {
                $this->addUsingAlias(UserGroupMappingTableMap::COL_GROUP_FK, $groupFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGroupMappingTableMap::COL_GROUP_FK, $groupFk, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserGroupMappingQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(UserGroupMappingTableMap::COL_USER_FK, $user->getUserPk(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserGroupMappingTableMap::COL_USER_FK, $user->toKeyValue('PrimaryKey', 'UserPk'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserGroupMappingQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Filter the query by a related \Group object
     *
     * @param \Group|ObjectCollection $group The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserGroupMappingQuery The current query, for fluid interface
     */
    public function filterByGroup($group, $comparison = null)
    {
        if ($group instanceof \Group) {
            return $this
                ->addUsingAlias(UserGroupMappingTableMap::COL_GROUP_FK, $group->getGroupPk(), $comparison);
        } elseif ($group instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserGroupMappingTableMap::COL_GROUP_FK, $group->toKeyValue('PrimaryKey', 'GroupPk'), $comparison);
        } else {
            throw new PropelException('filterByGroup() only accepts arguments of type \Group or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Group relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserGroupMappingQuery The current query, for fluid interface
     */
    public function joinGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Group');

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
            $this->addJoinObject($join, 'Group');
        }

        return $this;
    }

    /**
     * Use the Group relation Group object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GroupQuery A secondary query class using the current class as primary query
     */
    public function useGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Group', '\GroupQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserGroupMapping $userGroupMapping Object to remove from the list of results
     *
     * @return $this|ChildUserGroupMappingQuery The current query, for fluid interface
     */
    public function prune($userGroupMapping = null)
    {
        if ($userGroupMapping) {
            $this->addUsingAlias(UserGroupMappingTableMap::COL_USER_GROUP_MAPPING_PK, $userGroupMapping->getUserGroupMappingPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_group_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserGroupMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserGroupMappingTableMap::clearInstancePool();
            UserGroupMappingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserGroupMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserGroupMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserGroupMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserGroupMappingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserGroupMappingQuery
