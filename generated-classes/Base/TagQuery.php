<?php

namespace Base;

use \Tag as ChildTag;
use \TagQuery as ChildTagQuery;
use \Exception;
use \PDO;
use Map\TagTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tag' table.
 *
 *
 *
 * @method     ChildTagQuery orderByTagPk($order = Criteria::ASC) Order by the tag_pk column
 * @method     ChildTagQuery orderByTagName($order = Criteria::ASC) Order by the tag_name column
 *
 * @method     ChildTagQuery groupByTagPk() Group by the tag_pk column
 * @method     ChildTagQuery groupByTagName() Group by the tag_name column
 *
 * @method     ChildTagQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTagQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTagQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTagQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTagQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTagQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTagQuery leftJoinDrillTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the DrillTag relation
 * @method     ChildTagQuery rightJoinDrillTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DrillTag relation
 * @method     ChildTagQuery innerJoinDrillTag($relationAlias = null) Adds a INNER JOIN clause to the query using the DrillTag relation
 *
 * @method     ChildTagQuery joinWithDrillTag($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DrillTag relation
 *
 * @method     ChildTagQuery leftJoinWithDrillTag() Adds a LEFT JOIN clause and with to the query using the DrillTag relation
 * @method     ChildTagQuery rightJoinWithDrillTag() Adds a RIGHT JOIN clause and with to the query using the DrillTag relation
 * @method     ChildTagQuery innerJoinWithDrillTag() Adds a INNER JOIN clause and with to the query using the DrillTag relation
 *
 * @method     \DrillTagQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTag findOne(ConnectionInterface $con = null) Return the first ChildTag matching the query
 * @method     ChildTag findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTag matching the query, or a new ChildTag object populated from the query conditions when no match is found
 *
 * @method     ChildTag findOneByTagPk(int $tag_pk) Return the first ChildTag filtered by the tag_pk column
 * @method     ChildTag findOneByTagName(string $tag_name) Return the first ChildTag filtered by the tag_name column *

 * @method     ChildTag requirePk($key, ConnectionInterface $con = null) Return the ChildTag by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTag requireOne(ConnectionInterface $con = null) Return the first ChildTag matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTag requireOneByTagPk(int $tag_pk) Return the first ChildTag filtered by the tag_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTag requireOneByTagName(string $tag_name) Return the first ChildTag filtered by the tag_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTag[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTag objects based on current ModelCriteria
 * @method     ChildTag[]|ObjectCollection findByTagPk(int $tag_pk) Return ChildTag objects filtered by the tag_pk column
 * @method     ChildTag[]|ObjectCollection findByTagName(string $tag_name) Return ChildTag objects filtered by the tag_name column
 * @method     ChildTag[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TagQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TagQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\Tag', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTagQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTagQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTagQuery) {
            return $criteria;
        }
        $query = new ChildTagQuery();
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
     * @return ChildTag|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TagTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TagTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTag A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT tag_pk, tag_name FROM tag WHERE tag_pk = :p0';
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
            /** @var ChildTag $obj */
            $obj = new ChildTag();
            $obj->hydrate($row);
            TagTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTag|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TagTableMap::COL_TAG_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TagTableMap::COL_TAG_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the tag_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByTagPk(1234); // WHERE tag_pk = 1234
     * $query->filterByTagPk(array(12, 34)); // WHERE tag_pk IN (12, 34)
     * $query->filterByTagPk(array('min' => 12)); // WHERE tag_pk > 12
     * </code>
     *
     * @param     mixed $tagPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTagQuery The current query, for fluid interface
     */
    public function filterByTagPk($tagPk = null, $comparison = null)
    {
        if (is_array($tagPk)) {
            $useMinMax = false;
            if (isset($tagPk['min'])) {
                $this->addUsingAlias(TagTableMap::COL_TAG_PK, $tagPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tagPk['max'])) {
                $this->addUsingAlias(TagTableMap::COL_TAG_PK, $tagPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TagTableMap::COL_TAG_PK, $tagPk, $comparison);
    }

    /**
     * Filter the query on the tag_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTagName('fooValue');   // WHERE tag_name = 'fooValue'
     * $query->filterByTagName('%fooValue%', Criteria::LIKE); // WHERE tag_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tagName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTagQuery The current query, for fluid interface
     */
    public function filterByTagName($tagName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tagName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TagTableMap::COL_TAG_NAME, $tagName, $comparison);
    }

    /**
     * Filter the query by a related \DrillTag object
     *
     * @param \DrillTag|ObjectCollection $drillTag the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTagQuery The current query, for fluid interface
     */
    public function filterByDrillTag($drillTag, $comparison = null)
    {
        if ($drillTag instanceof \DrillTag) {
            return $this
                ->addUsingAlias(TagTableMap::COL_TAG_PK, $drillTag->getTagFk(), $comparison);
        } elseif ($drillTag instanceof ObjectCollection) {
            return $this
                ->useDrillTagQuery()
                ->filterByPrimaryKeys($drillTag->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDrillTag() only accepts arguments of type \DrillTag or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DrillTag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTagQuery The current query, for fluid interface
     */
    public function joinDrillTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DrillTag');

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
            $this->addJoinObject($join, 'DrillTag');
        }

        return $this;
    }

    /**
     * Use the DrillTag relation DrillTag object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DrillTagQuery A secondary query class using the current class as primary query
     */
    public function useDrillTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDrillTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DrillTag', '\DrillTagQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTag $tag Object to remove from the list of results
     *
     * @return $this|ChildTagQuery The current query, for fluid interface
     */
    public function prune($tag = null)
    {
        if ($tag) {
            $this->addUsingAlias(TagTableMap::COL_TAG_PK, $tag->getTagPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tag table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TagTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TagTableMap::clearInstancePool();
            TagTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TagTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TagTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TagTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TagTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TagQuery
