<?php

namespace Map;

use \Person;
use \PersonQuery;
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
 * This class defines the structure of the 'person' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PersonTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PersonTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'runningdrills';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'person';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Person';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Person';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the person_pk field
     */
    const COL_PERSON_PK = 'person.person_pk';

    /**
     * the column name for the guid field
     */
    const COL_GUID = 'person.guid';

    /**
     * the column name for the person_name field
     */
    const COL_PERSON_NAME = 'person.person_name';

    /**
     * the column name for the person_email field
     */
    const COL_PERSON_EMAIL = 'person.person_email';

    /**
     * the column name for the person_password field
     */
    const COL_PERSON_PASSWORD = 'person.person_password';

    /**
     * the column name for the is_removed field
     */
    const COL_IS_REMOVED = 'person.is_removed';

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
        self::TYPE_PHPNAME       => array('PersonPk', 'Guid', 'PersonName', 'PersonEmail', 'PersonPassword', 'IsRemoved', ),
        self::TYPE_CAMELNAME     => array('personPk', 'guid', 'personName', 'personEmail', 'personPassword', 'isRemoved', ),
        self::TYPE_COLNAME       => array(PersonTableMap::COL_PERSON_PK, PersonTableMap::COL_GUID, PersonTableMap::COL_PERSON_NAME, PersonTableMap::COL_PERSON_EMAIL, PersonTableMap::COL_PERSON_PASSWORD, PersonTableMap::COL_IS_REMOVED, ),
        self::TYPE_FIELDNAME     => array('person_pk', 'guid', 'person_name', 'person_email', 'person_password', 'is_removed', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('PersonPk' => 0, 'Guid' => 1, 'PersonName' => 2, 'PersonEmail' => 3, 'PersonPassword' => 4, 'IsRemoved' => 5, ),
        self::TYPE_CAMELNAME     => array('personPk' => 0, 'guid' => 1, 'personName' => 2, 'personEmail' => 3, 'personPassword' => 4, 'isRemoved' => 5, ),
        self::TYPE_COLNAME       => array(PersonTableMap::COL_PERSON_PK => 0, PersonTableMap::COL_GUID => 1, PersonTableMap::COL_PERSON_NAME => 2, PersonTableMap::COL_PERSON_EMAIL => 3, PersonTableMap::COL_PERSON_PASSWORD => 4, PersonTableMap::COL_IS_REMOVED => 5, ),
        self::TYPE_FIELDNAME     => array('person_pk' => 0, 'guid' => 1, 'person_name' => 2, 'person_email' => 3, 'person_password' => 4, 'is_removed' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('person');
        $this->setPhpName('Person');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Person');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('person_person_pk_seq');
        // columns
        $this->addPrimaryKey('person_pk', 'PersonPk', 'INTEGER', true, null, null);
        $this->addColumn('guid', 'Guid', 'VARCHAR', false, null, null);
        $this->addColumn('person_name', 'PersonName', 'VARCHAR', false, null, null);
        $this->addColumn('person_email', 'PersonEmail', 'VARCHAR', false, null, null);
        $this->addColumn('person_password', 'PersonPassword', 'VARCHAR', false, null, null);
        $this->addColumn('is_removed', 'IsRemoved', 'BOOLEAN', true, null, false);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PersonGroupMapping', '\\PersonGroupMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':person_fk',
    1 => ':person_pk',
  ),
), null, null, 'PersonGroupMappings', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonPk', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonPk', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonPk', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonPk', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonPk', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonPk', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PersonPk', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PersonTableMap::CLASS_DEFAULT : PersonTableMap::OM_CLASS;
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
     * @return array           (Person object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PersonTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PersonTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PersonTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PersonTableMap::OM_CLASS;
            /** @var Person $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PersonTableMap::addInstanceToPool($obj, $key);
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
            $key = PersonTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PersonTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Person $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PersonTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PersonTableMap::COL_PERSON_PK);
            $criteria->addSelectColumn(PersonTableMap::COL_GUID);
            $criteria->addSelectColumn(PersonTableMap::COL_PERSON_NAME);
            $criteria->addSelectColumn(PersonTableMap::COL_PERSON_EMAIL);
            $criteria->addSelectColumn(PersonTableMap::COL_PERSON_PASSWORD);
            $criteria->addSelectColumn(PersonTableMap::COL_IS_REMOVED);
        } else {
            $criteria->addSelectColumn($alias . '.person_pk');
            $criteria->addSelectColumn($alias . '.guid');
            $criteria->addSelectColumn($alias . '.person_name');
            $criteria->addSelectColumn($alias . '.person_email');
            $criteria->addSelectColumn($alias . '.person_password');
            $criteria->addSelectColumn($alias . '.is_removed');
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
        return Propel::getServiceContainer()->getDatabaseMap(PersonTableMap::DATABASE_NAME)->getTable(PersonTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PersonTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PersonTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PersonTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Person or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Person object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PersonTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Person) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PersonTableMap::DATABASE_NAME);
            $criteria->add(PersonTableMap::COL_PERSON_PK, (array) $values, Criteria::IN);
        }

        $query = PersonQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PersonTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PersonTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the person table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PersonQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Person or Criteria object.
     *
     * @param mixed               $criteria Criteria or Person object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Person object
        }

        if ($criteria->containsKey(PersonTableMap::COL_PERSON_PK) && $criteria->keyContainsValue(PersonTableMap::COL_PERSON_PK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PersonTableMap::COL_PERSON_PK.')');
        }


        // Set the correct dbName
        $query = PersonQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PersonTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PersonTableMap::buildTableMap();
