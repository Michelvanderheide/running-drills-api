<?php

namespace Map;

use \SessionDrill;
use \SessionDrillQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'session_drill' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SessionDrillTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SessionDrillTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'runningdrills';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'session_drill';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SessionDrill';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SessionDrill';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the session_drill_pk field
     */
    const COL_SESSION_DRILL_PK = 'session_drill.session_drill_pk';

    /**
     * the column name for the drill_fk field
     */
    const COL_DRILL_FK = 'session_drill.drill_fk';

    /**
     * the column name for the session_fk field
     */
    const COL_SESSION_FK = 'session_drill.session_fk';

    /**
     * the column name for the sort_order field
     */
    const COL_SORT_ORDER = 'session_drill.sort_order';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('SessionDrillPk', 'DrillFk', 'SessionFk', 'SortOrder', ),
        self::TYPE_CAMELNAME     => array('sessionDrillPk', 'drillFk', 'sessionFk', 'sortOrder', ),
        self::TYPE_COLNAME       => array(SessionDrillTableMap::COL_SESSION_DRILL_PK, SessionDrillTableMap::COL_DRILL_FK, SessionDrillTableMap::COL_SESSION_FK, SessionDrillTableMap::COL_SORT_ORDER, ),
        self::TYPE_FIELDNAME     => array('session_drill_pk', 'drill_fk', 'session_fk', 'sort_order', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('SessionDrillPk' => 0, 'DrillFk' => 1, 'SessionFk' => 2, 'SortOrder' => 3, ),
        self::TYPE_CAMELNAME     => array('sessionDrillPk' => 0, 'drillFk' => 1, 'sessionFk' => 2, 'sortOrder' => 3, ),
        self::TYPE_COLNAME       => array(SessionDrillTableMap::COL_SESSION_DRILL_PK => 0, SessionDrillTableMap::COL_DRILL_FK => 1, SessionDrillTableMap::COL_SESSION_FK => 2, SessionDrillTableMap::COL_SORT_ORDER => 3, ),
        self::TYPE_FIELDNAME     => array('session_drill_pk' => 0, 'drill_fk' => 1, 'session_fk' => 2, 'sort_order' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('session_drill');
        $this->setPhpName('SessionDrill');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SessionDrill');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('session_drill_session_drill_pk_seq');
        // columns
        $this->addPrimaryKey('session_drill_pk', 'SessionDrillPk', 'INTEGER', true, null, null);
        $this->addForeignKey('drill_fk', 'DrillFk', 'INTEGER', 'drill', 'drill_pk', true, null, null);
        $this->addForeignKey('session_fk', 'SessionFk', 'INTEGER', 'session', 'session_pk', true, null, null);
        $this->addColumn('sort_order', 'SortOrder', 'INTEGER', true, null, 0);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Drill', '\\Drill', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':drill_fk',
    1 => ':drill_pk',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Session', '\\Session', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':session_fk',
    1 => ':session_pk',
  ),
), 'CASCADE', null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionDrillPk', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionDrillPk', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionDrillPk', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionDrillPk', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionDrillPk', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionDrillPk', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('SessionDrillPk', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? SessionDrillTableMap::CLASS_DEFAULT : SessionDrillTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (SessionDrill object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SessionDrillTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SessionDrillTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SessionDrillTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SessionDrillTableMap::OM_CLASS;
            /** @var SessionDrill $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SessionDrillTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SessionDrillTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SessionDrillTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SessionDrill $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SessionDrillTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SessionDrillTableMap::COL_SESSION_DRILL_PK);
            $criteria->addSelectColumn(SessionDrillTableMap::COL_DRILL_FK);
            $criteria->addSelectColumn(SessionDrillTableMap::COL_SESSION_FK);
            $criteria->addSelectColumn(SessionDrillTableMap::COL_SORT_ORDER);
        } else {
            $criteria->addSelectColumn($alias . '.session_drill_pk');
            $criteria->addSelectColumn($alias . '.drill_fk');
            $criteria->addSelectColumn($alias . '.session_fk');
            $criteria->addSelectColumn($alias . '.sort_order');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(SessionDrillTableMap::DATABASE_NAME)->getTable(SessionDrillTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SessionDrillTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SessionDrillTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SessionDrillTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SessionDrill or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SessionDrill object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SessionDrillTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SessionDrill) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SessionDrillTableMap::DATABASE_NAME);
            $criteria->add(SessionDrillTableMap::COL_SESSION_DRILL_PK, (array) $values, Criteria::IN);
        }

        $query = SessionDrillQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SessionDrillTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SessionDrillTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the session_drill table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SessionDrillQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SessionDrill or Criteria object.
     *
     * @param mixed               $criteria Criteria or SessionDrill object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SessionDrillTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SessionDrill object
        }

        if ($criteria->containsKey(SessionDrillTableMap::COL_SESSION_DRILL_PK) && $criteria->keyContainsValue(SessionDrillTableMap::COL_SESSION_DRILL_PK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SessionDrillTableMap::COL_SESSION_DRILL_PK.')');
        }


        // Set the correct dbName
        $query = SessionDrillQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SessionDrillTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SessionDrillTableMap::buildTableMap();
