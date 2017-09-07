<?php

namespace WEB\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use WEB\Mensagens;
use WEB\MensagensQuery;


/**
 * This class defines the structure of the 'MENSAGENS' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class MensagensTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'WEB.Map.MensagensTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'MENSAGENS';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\WEB\\Mensagens';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'WEB.Mensagens';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    const COL_ID = 'MENSAGENS.id';

    /**
     * the column name for the mensagem field
     */
    const COL_MENSAGEM = 'MENSAGENS.mensagem';

    /**
     * the column name for the img field
     */
    const COL_IMG = 'MENSAGENS.img';

    /**
     * the column name for the idUsuario_Criador field
     */
    const COL_IDUSUARIO_CRIADOR = 'MENSAGENS.idUsuario_Criador';

    /**
     * the column name for the idPedidoSuporte field
     */
    const COL_IDPEDIDOSUPORTE = 'MENSAGENS.idPedidoSuporte';

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
        self::TYPE_PHPNAME       => array('Id', 'Mensagem', 'Img', 'IdusuarioCriador', 'Idpedidosuporte', ),
        self::TYPE_CAMELNAME     => array('id', 'mensagem', 'img', 'idusuarioCriador', 'idpedidosuporte', ),
        self::TYPE_COLNAME       => array(MensagensTableMap::COL_ID, MensagensTableMap::COL_MENSAGEM, MensagensTableMap::COL_IMG, MensagensTableMap::COL_IDUSUARIO_CRIADOR, MensagensTableMap::COL_IDPEDIDOSUPORTE, ),
        self::TYPE_FIELDNAME     => array('id', 'mensagem', 'img', 'idUsuario_Criador', 'idPedidoSuporte', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Mensagem' => 1, 'Img' => 2, 'IdusuarioCriador' => 3, 'Idpedidosuporte' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'mensagem' => 1, 'img' => 2, 'idusuarioCriador' => 3, 'idpedidosuporte' => 4, ),
        self::TYPE_COLNAME       => array(MensagensTableMap::COL_ID => 0, MensagensTableMap::COL_MENSAGEM => 1, MensagensTableMap::COL_IMG => 2, MensagensTableMap::COL_IDUSUARIO_CRIADOR => 3, MensagensTableMap::COL_IDPEDIDOSUPORTE => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'mensagem' => 1, 'img' => 2, 'idUsuario_Criador' => 3, 'idPedidoSuporte' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('MENSAGENS');
        $this->setPhpName('Mensagens');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\WEB\\Mensagens');
        $this->setPackage('WEB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('mensagem', 'Mensagem', 'LONGVARCHAR', true, null, null);
        $this->addColumn('img', 'Img', 'VARCHAR', false, 255, null);
        $this->addForeignKey('idUsuario_Criador', 'IdusuarioCriador', 'INTEGER', 'USUARIO', 'id', true, null, null);
        $this->addForeignKey('idPedidoSuporte', 'Idpedidosuporte', 'INTEGER', 'PEDIDO_SUPORTE', 'id', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Usuario', '\\WEB\\Usuario', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idUsuario_Criador',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('PedidoSuporte', '\\WEB\\PedidoSuporte', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idPedidoSuporte',
    1 => ':id',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? MensagensTableMap::CLASS_DEFAULT : MensagensTableMap::OM_CLASS;
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
     * @return array           (Mensagens object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MensagensTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MensagensTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MensagensTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MensagensTableMap::OM_CLASS;
            /** @var Mensagens $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MensagensTableMap::addInstanceToPool($obj, $key);
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
            $key = MensagensTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MensagensTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Mensagens $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MensagensTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MensagensTableMap::COL_ID);
            $criteria->addSelectColumn(MensagensTableMap::COL_MENSAGEM);
            $criteria->addSelectColumn(MensagensTableMap::COL_IMG);
            $criteria->addSelectColumn(MensagensTableMap::COL_IDUSUARIO_CRIADOR);
            $criteria->addSelectColumn(MensagensTableMap::COL_IDPEDIDOSUPORTE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.mensagem');
            $criteria->addSelectColumn($alias . '.img');
            $criteria->addSelectColumn($alias . '.idUsuario_Criador');
            $criteria->addSelectColumn($alias . '.idPedidoSuporte');
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
        return Propel::getServiceContainer()->getDatabaseMap(MensagensTableMap::DATABASE_NAME)->getTable(MensagensTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(MensagensTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(MensagensTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new MensagensTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Mensagens or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Mensagens object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MensagensTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \WEB\Mensagens) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MensagensTableMap::DATABASE_NAME);
            $criteria->add(MensagensTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = MensagensQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MensagensTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MensagensTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the MENSAGENS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MensagensQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Mensagens or Criteria object.
     *
     * @param mixed               $criteria Criteria or Mensagens object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MensagensTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Mensagens object
        }

        if ($criteria->containsKey(MensagensTableMap::COL_ID) && $criteria->keyContainsValue(MensagensTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MensagensTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = MensagensQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MensagensTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
MensagensTableMap::buildTableMap();
