<?php

namespace Map;

use \RungroupAccount;
use \RungroupAccountQuery;
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
 * This class defines the structure of the 'rungroup_account' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RungroupAccountTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.RungroupAccountTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'runningdrills';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'rungroup_account';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\RungroupAccount';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'RungroupAccount';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the rungroup_account_pk field
     */
    const COL_RUNGROUP_ACCOUNT_PK = 'rungroup_account.rungroup_account_pk';

    /**
     * the column name for the account_fk field
     */
    const COL_ACCOUNT_FK = 'rungroup_account.account_fk';

    /**
     * the column name for the rungroup_fk field
     */
    const COL_RUNGROUP_FK = 'rungroup_account.rungroup_fk';

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
        self::TYPE_PHPNAME       => array('RungroupAccountPk', 'AccountFk', 'RungroupFk', ),
        self::TYPE_CAMELNAME     => array('rungroupAccountPk', 'accountFk', 'rungroupFk', ),
        self::TYPE_COLNAME       => array(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK, RungroupAccountTableMap::COL_ACCOUNT_FK, RungroupAccountTableMap::COL_RUNGROUP_FK, ),
        self::TYPE_FIELDNAME     => array('rungroup_account_pk', 'account_fk', 'rungroup_fk', ),
        self::TYPE_NUM           => array(0, 1, 2, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('RungroupAccountPk' => 0, 'AccountFk' => 1, 'RungroupFk' => 2, ),
        self::TYPE_CAMELNAME     => array('rungroupAccountPk' => 0, 'accountFk' => 1, 'rungroupFk' => 2, ),
        self::TYPE_COLNAME       => array(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK => 0, RungroupAccountTableMap::COL_ACCOUNT_FK => 1, RungroupAccountTableMap::COL_RUNGROUP_FK => 2, ),
        self::TYPE_FIELDNAME     => array('rungroup_account_pk' => 0, 'account_fk' => 1, 'rungroup_fk' => 2, ),
        self::TYPE_NUM           => array(0, 1, 2, )
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
        $this->setName('rungroup_account');
        $this->setPhpName('RungroupAccount');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\RungroupAccount');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('rungroup_account_rungroup_account_pk_seq');
        // columns
        $this->addPrimaryKey('rungroup_account_pk', 'RungroupAccountPk', 'INTEGER', true, null, null);
        $this->addForeignKey('account_fk', 'AccountFk', 'INTEGER', 'account', 'account_pk', true, null, null);
        $this->addForeignKey('rungroup_fk', 'RungroupFk', 'INTEGER', 'rungroup', 'rungroup_pk', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Account', '\\Account', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':account_fk',
    1 => ':account_pk',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Rungroup', '\\Rungroup', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':rungroup_fk',
    1 => ':rungroup_pk',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RungroupAccountPk', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RungroupAccountPk', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RungroupAccountPk', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RungroupAccountPk', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RungroupAccountPk', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RungroupAccountPk', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('RungroupAccountPk', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? RungroupAccountTableMap::CLASS_DEFAULT : RungroupAccountTableMap::OM_CLASS;
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
     * @return array           (RungroupAccount object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RungroupAccountTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RungroupAccountTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RungroupAccountTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RungroupAccountTableMap::OM_CLASS;
            /** @var RungroupAccount $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RungroupAccountTableMap::addInstanceToPool($obj, $key);
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
            $key = RungroupAccountTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RungroupAccountTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var RungroupAccount $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RungroupAccountTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK);
            $criteria->addSelectColumn(RungroupAccountTableMap::COL_ACCOUNT_FK);
            $criteria->addSelectColumn(RungroupAccountTableMap::COL_RUNGROUP_FK);
        } else {
            $criteria->addSelectColumn($alias . '.rungroup_account_pk');
            $criteria->addSelectColumn($alias . '.account_fk');
            $criteria->addSelectColumn($alias . '.rungroup_fk');
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
        return Propel::getServiceContainer()->getDatabaseMap(RungroupAccountTableMap::DATABASE_NAME)->getTable(RungroupAccountTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RungroupAccountTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RungroupAccountTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RungroupAccountTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a RungroupAccount or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or RungroupAccount object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RungroupAccountTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \RungroupAccount) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RungroupAccountTableMap::DATABASE_NAME);
            $criteria->add(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK, (array) $values, Criteria::IN);
        }

        $query = RungroupAccountQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RungroupAccountTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RungroupAccountTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the rungroup_account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RungroupAccountQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a RungroupAccount or Criteria object.
     *
     * @param mixed               $criteria Criteria or RungroupAccount object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RungroupAccountTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from RungroupAccount object
        }

        if ($criteria->containsKey(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK) && $criteria->keyContainsValue(RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RungroupAccountTableMap::COL_RUNGROUP_ACCOUNT_PK.')');
        }


        // Set the correct dbName
        $query = RungroupAccountQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RungroupAccountTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RungroupAccountTableMap::buildTableMap();
