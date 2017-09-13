<?php

namespace Base;

use \PersonGroupMapping as ChildPersonGroupMapping;
use \PersonGroupMappingQuery as ChildPersonGroupMappingQuery;
use \Exception;
use \PDO;
use Map\PersonGroupMappingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'person_group_mapping' table.
 *
 *
 *
 * @method     ChildPersonGroupMappingQuery orderByPersonGroupMappingPk($order = Criteria::ASC) Order by the person_group_mapping_pk column
 * @method     ChildPersonGroupMappingQuery orderByPersonFk($order = Criteria::ASC) Order by the person_fk column
 * @method     ChildPersonGroupMappingQuery orderByGroupFk($order = Criteria::ASC) Order by the group_fk column
 *
 * @method     ChildPersonGroupMappingQuery groupByPersonGroupMappingPk() Group by the person_group_mapping_pk column
 * @method     ChildPersonGroupMappingQuery groupByPersonFk() Group by the person_fk column
 * @method     ChildPersonGroupMappingQuery groupByGroupFk() Group by the group_fk column
 *
 * @method     ChildPersonGroupMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPersonGroupMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPersonGroupMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPersonGroupMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPersonGroupMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPersonGroupMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPersonGroupMappingQuery leftJoinPerson($relationAlias = null) Adds a LEFT JOIN clause to the query using the Person relation
 * @method     ChildPersonGroupMappingQuery rightJoinPerson($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Person relation
 * @method     ChildPersonGroupMappingQuery innerJoinPerson($relationAlias = null) Adds a INNER JOIN clause to the query using the Person relation
 *
 * @method     ChildPersonGroupMappingQuery joinWithPerson($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Person relation
 *
 * @method     ChildPersonGroupMappingQuery leftJoinWithPerson() Adds a LEFT JOIN clause and with to the query using the Person relation
 * @method     ChildPersonGroupMappingQuery rightJoinWithPerson() Adds a RIGHT JOIN clause and with to the query using the Person relation
 * @method     ChildPersonGroupMappingQuery innerJoinWithPerson() Adds a INNER JOIN clause and with to the query using the Person relation
 *
 * @method     ChildPersonGroupMappingQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method     ChildPersonGroupMappingQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method     ChildPersonGroupMappingQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method     ChildPersonGroupMappingQuery joinWithGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Group relation
 *
 * @method     ChildPersonGroupMappingQuery leftJoinWithGroup() Adds a LEFT JOIN clause and with to the query using the Group relation
 * @method     ChildPersonGroupMappingQuery rightJoinWithGroup() Adds a RIGHT JOIN clause and with to the query using the Group relation
 * @method     ChildPersonGroupMappingQuery innerJoinWithGroup() Adds a INNER JOIN clause and with to the query using the Group relation
 *
 * @method     \PersonQuery|\GroupQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPersonGroupMapping findOne(ConnectionInterface $con = null) Return the first ChildPersonGroupMapping matching the query
 * @method     ChildPersonGroupMapping findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPersonGroupMapping matching the query, or a new ChildPersonGroupMapping object populated from the query conditions when no match is found
 *
 * @method     ChildPersonGroupMapping findOneByPersonGroupMappingPk(int $person_group_mapping_pk) Return the first ChildPersonGroupMapping filtered by the person_group_mapping_pk column
 * @method     ChildPersonGroupMapping findOneByPersonFk(int $person_fk) Return the first ChildPersonGroupMapping filtered by the person_fk column
 * @method     ChildPersonGroupMapping findOneByGroupFk(int $group_fk) Return the first ChildPersonGroupMapping filtered by the group_fk column *

 * @method     ChildPersonGroupMapping requirePk($key, ConnectionInterface $con = null) Return the ChildPersonGroupMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonGroupMapping requireOne(ConnectionInterface $con = null) Return the first ChildPersonGroupMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPersonGroupMapping requireOneByPersonGroupMappingPk(int $person_group_mapping_pk) Return the first ChildPersonGroupMapping filtered by the person_group_mapping_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonGroupMapping requireOneByPersonFk(int $person_fk) Return the first ChildPersonGroupMapping filtered by the person_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonGroupMapping requireOneByGroupFk(int $group_fk) Return the first ChildPersonGroupMapping filtered by the group_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPersonGroupMapping[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPersonGroupMapping objects based on current ModelCriteria
 * @method     ChildPersonGroupMapping[]|ObjectCollection findByPersonGroupMappingPk(int $person_group_mapping_pk) Return ChildPersonGroupMapping objects filtered by the person_group_mapping_pk column
 * @method     ChildPersonGroupMapping[]|ObjectCollection findByPersonFk(int $person_fk) Return ChildPersonGroupMapping objects filtered by the person_fk column
 * @method     ChildPersonGroupMapping[]|ObjectCollection findByGroupFk(int $group_fk) Return ChildPersonGroupMapping objects filtered by the group_fk column
 * @method     ChildPersonGroupMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PersonGroupMappingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PersonGroupMappingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\PersonGroupMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPersonGroupMappingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPersonGroupMappingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPersonGroupMappingQuery) {
            return $criteria;
        }
        $query = new ChildPersonGroupMappingQuery();
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
     * @return ChildPersonGroupMapping|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PersonGroupMappingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PersonGroupMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPersonGroupMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT person_group_mapping_pk, person_fk, group_fk FROM person_group_mapping WHERE person_group_mapping_pk = :p0';
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
            /** @var ChildPersonGroupMapping $obj */
            $obj = new ChildPersonGroupMapping();
            $obj->hydrate($row);
            PersonGroupMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPersonGroupMapping|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPersonGroupMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PersonGroupMappingTableMap::COL_PERSON_GROUP_MAPPING_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPersonGroupMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PersonGroupMappingTableMap::COL_PERSON_GROUP_MAPPING_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the person_group_mapping_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonGroupMappingPk(1234); // WHERE person_group_mapping_pk = 1234
     * $query->filterByPersonGroupMappingPk(array(12, 34)); // WHERE person_group_mapping_pk IN (12, 34)
     * $query->filterByPersonGroupMappingPk(array('min' => 12)); // WHERE person_group_mapping_pk > 12
     * </code>
     *
     * @param     mixed $personGroupMappingPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonGroupMappingQuery The current query, for fluid interface
     */
    public function filterByPersonGroupMappingPk($personGroupMappingPk = null, $comparison = null)
    {
        if (is_array($personGroupMappingPk)) {
            $useMinMax = false;
            if (isset($personGroupMappingPk['min'])) {
                $this->addUsingAlias(PersonGroupMappingTableMap::COL_PERSON_GROUP_MAPPING_PK, $personGroupMappingPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personGroupMappingPk['max'])) {
                $this->addUsingAlias(PersonGroupMappingTableMap::COL_PERSON_GROUP_MAPPING_PK, $personGroupMappingPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonGroupMappingTableMap::COL_PERSON_GROUP_MAPPING_PK, $personGroupMappingPk, $comparison);
    }

    /**
     * Filter the query on the person_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonFk(1234); // WHERE person_fk = 1234
     * $query->filterByPersonFk(array(12, 34)); // WHERE person_fk IN (12, 34)
     * $query->filterByPersonFk(array('min' => 12)); // WHERE person_fk > 12
     * </code>
     *
     * @see       filterByPerson()
     *
     * @param     mixed $personFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonGroupMappingQuery The current query, for fluid interface
     */
    public function filterByPersonFk($personFk = null, $comparison = null)
    {
        if (is_array($personFk)) {
            $useMinMax = false;
            if (isset($personFk['min'])) {
                $this->addUsingAlias(PersonGroupMappingTableMap::COL_PERSON_FK, $personFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personFk['max'])) {
                $this->addUsingAlias(PersonGroupMappingTableMap::COL_PERSON_FK, $personFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonGroupMappingTableMap::COL_PERSON_FK, $personFk, $comparison);
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
     * @return $this|ChildPersonGroupMappingQuery The current query, for fluid interface
     */
    public function filterByGroupFk($groupFk = null, $comparison = null)
    {
        if (is_array($groupFk)) {
            $useMinMax = false;
            if (isset($groupFk['min'])) {
                $this->addUsingAlias(PersonGroupMappingTableMap::COL_GROUP_FK, $groupFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupFk['max'])) {
                $this->addUsingAlias(PersonGroupMappingTableMap::COL_GROUP_FK, $groupFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonGroupMappingTableMap::COL_GROUP_FK, $groupFk, $comparison);
    }

    /**
     * Filter the query by a related \Person object
     *
     * @param \Person|ObjectCollection $person The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersonGroupMappingQuery The current query, for fluid interface
     */
    public function filterByPerson($person, $comparison = null)
    {
        if ($person instanceof \Person) {
            return $this
                ->addUsingAlias(PersonGroupMappingTableMap::COL_PERSON_FK, $person->getPersonPk(), $comparison);
        } elseif ($person instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersonGroupMappingTableMap::COL_PERSON_FK, $person->toKeyValue('PrimaryKey', 'PersonPk'), $comparison);
        } else {
            throw new PropelException('filterByPerson() only accepts arguments of type \Person or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Person relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersonGroupMappingQuery The current query, for fluid interface
     */
    public function joinPerson($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Person');

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
            $this->addJoinObject($join, 'Person');
        }

        return $this;
    }

    /**
     * Use the Person relation Person object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PersonQuery A secondary query class using the current class as primary query
     */
    public function usePersonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPerson($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Person', '\PersonQuery');
    }

    /**
     * Filter the query by a related \Group object
     *
     * @param \Group|ObjectCollection $group The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersonGroupMappingQuery The current query, for fluid interface
     */
    public function filterByGroup($group, $comparison = null)
    {
        if ($group instanceof \Group) {
            return $this
                ->addUsingAlias(PersonGroupMappingTableMap::COL_GROUP_FK, $group->getGroupPk(), $comparison);
        } elseif ($group instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersonGroupMappingTableMap::COL_GROUP_FK, $group->toKeyValue('PrimaryKey', 'GroupPk'), $comparison);
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
     * @return $this|ChildPersonGroupMappingQuery The current query, for fluid interface
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
     * @param   ChildPersonGroupMapping $personGroupMapping Object to remove from the list of results
     *
     * @return $this|ChildPersonGroupMappingQuery The current query, for fluid interface
     */
    public function prune($personGroupMapping = null)
    {
        if ($personGroupMapping) {
            $this->addUsingAlias(PersonGroupMappingTableMap::COL_PERSON_GROUP_MAPPING_PK, $personGroupMapping->getPersonGroupMappingPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the person_group_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonGroupMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PersonGroupMappingTableMap::clearInstancePool();
            PersonGroupMappingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PersonGroupMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PersonGroupMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PersonGroupMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PersonGroupMappingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PersonGroupMappingQuery
