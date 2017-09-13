<?php

namespace Map;

use \Drill;
use \DrillQuery;
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
 * This class defines the structure of the 'drill' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class DrillTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.DrillTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'runningdrills';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'drill';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Drill';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Drill';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the drill_pk field
     */
    const COL_DRILL_PK = 'drill.drill_pk';

    /**
     * the column name for the guid field
     */
    const COL_GUID = 'drill.guid';

    /**
     * the column name for the id field
     */
    const COL_ID = 'drill.id';

    /**
     * the column name for the category_fk field
     */
    const COL_CATEGORY_FK = 'drill.category_fk';

    /**
     * the column name for the drill_title field
     */
    const COL_DRILL_TITLE = 'drill.drill_title';

    /**
     * the column name for the drill_description field
     */
    const COL_DRILL_DESCRIPTION = 'drill.drill_description';

    /**
     * the column name for the drill_description_html field
     */
    const COL_DRILL_DESCRIPTION_HTML = 'drill.drill_description_html';

    /**
     * the column name for the drill_intervals field
     */
    const COL_DRILL_INTERVALS = 'drill.drill_intervals';

    /**
     * the column name for the drill_image field
     */
    const COL_DRILL_IMAGE = 'drill.drill_image';

    /**
     * the column name for the drill_video field
     */
    const COL_DRILL_VIDEO = 'drill.drill_video';

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
        self::TYPE_PHPNAME       => array('DrillPk', 'Guid', 'Id', 'CategoryFk', 'DrillTitle', 'DrillDescription', 'DrillDescriptionHtml', 'DrillIntervals', 'DrillImage', 'DrillVideo', ),
        self::TYPE_CAMELNAME     => array('drillPk', 'guid', 'id', 'categoryFk', 'drillTitle', 'drillDescription', 'drillDescriptionHtml', 'drillIntervals', 'drillImage', 'drillVideo', ),
        self::TYPE_COLNAME       => array(DrillTableMap::COL_DRILL_PK, DrillTableMap::COL_GUID, DrillTableMap::COL_ID, DrillTableMap::COL_CATEGORY_FK, DrillTableMap::COL_DRILL_TITLE, DrillTableMap::COL_DRILL_DESCRIPTION, DrillTableMap::COL_DRILL_DESCRIPTION_HTML, DrillTableMap::COL_DRILL_INTERVALS, DrillTableMap::COL_DRILL_IMAGE, DrillTableMap::COL_DRILL_VIDEO, ),
        self::TYPE_FIELDNAME     => array('drill_pk', 'guid', 'id', 'category_fk', 'drill_title', 'drill_description', 'drill_description_html', 'drill_intervals', 'drill_image', 'drill_video', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('DrillPk' => 0, 'Guid' => 1, 'Id' => 2, 'CategoryFk' => 3, 'DrillTitle' => 4, 'DrillDescription' => 5, 'DrillDescriptionHtml' => 6, 'DrillIntervals' => 7, 'DrillImage' => 8, 'DrillVideo' => 9, ),
        self::TYPE_CAMELNAME     => array('drillPk' => 0, 'guid' => 1, 'id' => 2, 'categoryFk' => 3, 'drillTitle' => 4, 'drillDescription' => 5, 'drillDescriptionHtml' => 6, 'drillIntervals' => 7, 'drillImage' => 8, 'drillVideo' => 9, ),
        self::TYPE_COLNAME       => array(DrillTableMap::COL_DRILL_PK => 0, DrillTableMap::COL_GUID => 1, DrillTableMap::COL_ID => 2, DrillTableMap::COL_CATEGORY_FK => 3, DrillTableMap::COL_DRILL_TITLE => 4, DrillTableMap::COL_DRILL_DESCRIPTION => 5, DrillTableMap::COL_DRILL_DESCRIPTION_HTML => 6, DrillTableMap::COL_DRILL_INTERVALS => 7, DrillTableMap::COL_DRILL_IMAGE => 8, DrillTableMap::COL_DRILL_VIDEO => 9, ),
        self::TYPE_FIELDNAME     => array('drill_pk' => 0, 'guid' => 1, 'id' => 2, 'category_fk' => 3, 'drill_title' => 4, 'drill_description' => 5, 'drill_description_html' => 6, 'drill_intervals' => 7, 'drill_image' => 8, 'drill_video' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('drill');
        $this->setPhpName('Drill');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Drill');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('drill_drill_pk_seq');
        // columns
        $this->addPrimaryKey('drill_pk', 'DrillPk', 'INTEGER', true, null, null);
        $this->addColumn('guid', 'Guid', 'VARCHAR', false, null, null);
        $this->addColumn('id', 'Id', 'VARCHAR', false, null, null);
        $this->addForeignKey('category_fk', 'CategoryFk', 'INTEGER', 'category', 'category_pk', true, null, null);
        $this->addColumn('drill_title', 'DrillTitle', 'VARCHAR', false, null, null);
        $this->addColumn('drill_description', 'DrillDescription', 'VARCHAR', false, null, null);
        $this->addColumn('drill_description_html', 'DrillDescriptionHtml', 'VARCHAR', false, null, null);
        $this->addColumn('drill_intervals', 'DrillIntervals', 'VARCHAR', false, null, null);
        $this->addColumn('drill_image', 'DrillImage', 'VARCHAR', false, null, null);
        $this->addColumn('drill_video', 'DrillVideo', 'VARCHAR', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Category', '\\Category', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':category_fk',
    1 => ':category_pk',
  ),
), null, null, null, false);
        $this->addRelation('SessionDrill', '\\SessionDrill', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':drill_fk',
    1 => ':drill_pk',
  ),
), 'CASCADE', null, 'SessionDrills', false);
        $this->addRelation('DrillTag', '\\DrillTag', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':drill_fk',
    1 => ':drill_pk',
  ),
), 'CASCADE', null, 'DrillTags', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to drill     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SessionDrillTableMap::clearInstancePool();
        DrillTagTableMap::clearInstancePool();
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DrillPk', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DrillPk', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DrillPk', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DrillPk', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DrillPk', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DrillPk', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('DrillPk', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DrillTableMap::CLASS_DEFAULT : DrillTableMap::OM_CLASS;
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
     * @return array           (Drill object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DrillTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DrillTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DrillTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DrillTableMap::OM_CLASS;
            /** @var Drill $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DrillTableMap::addInstanceToPool($obj, $key);
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
            $key = DrillTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DrillTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Drill $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DrillTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DrillTableMap::COL_DRILL_PK);
            $criteria->addSelectColumn(DrillTableMap::COL_GUID);
            $criteria->addSelectColumn(DrillTableMap::COL_ID);
            $criteria->addSelectColumn(DrillTableMap::COL_CATEGORY_FK);
            $criteria->addSelectColumn(DrillTableMap::COL_DRILL_TITLE);
            $criteria->addSelectColumn(DrillTableMap::COL_DRILL_DESCRIPTION);
            $criteria->addSelectColumn(DrillTableMap::COL_DRILL_DESCRIPTION_HTML);
            $criteria->addSelectColumn(DrillTableMap::COL_DRILL_INTERVALS);
            $criteria->addSelectColumn(DrillTableMap::COL_DRILL_IMAGE);
            $criteria->addSelectColumn(DrillTableMap::COL_DRILL_VIDEO);
        } else {
            $criteria->addSelectColumn($alias . '.drill_pk');
            $criteria->addSelectColumn($alias . '.guid');
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.category_fk');
            $criteria->addSelectColumn($alias . '.drill_title');
            $criteria->addSelectColumn($alias . '.drill_description');
            $criteria->addSelectColumn($alias . '.drill_description_html');
            $criteria->addSelectColumn($alias . '.drill_intervals');
            $criteria->addSelectColumn($alias . '.drill_image');
            $criteria->addSelectColumn($alias . '.drill_video');
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
        return Propel::getServiceContainer()->getDatabaseMap(DrillTableMap::DATABASE_NAME)->getTable(DrillTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(DrillTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(DrillTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new DrillTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Drill or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Drill object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DrillTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Drill) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DrillTableMap::DATABASE_NAME);
            $criteria->add(DrillTableMap::COL_DRILL_PK, (array) $values, Criteria::IN);
        }

        $query = DrillQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DrillTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DrillTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the drill table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DrillQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Drill or Criteria object.
     *
     * @param mixed               $criteria Criteria or Drill object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DrillTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Drill object
        }

        if ($criteria->containsKey(DrillTableMap::COL_DRILL_PK) && $criteria->keyContainsValue(DrillTableMap::COL_DRILL_PK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DrillTableMap::COL_DRILL_PK.')');
        }


        // Set the correct dbName
        $query = DrillQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // DrillTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DrillTableMap::buildTableMap();
