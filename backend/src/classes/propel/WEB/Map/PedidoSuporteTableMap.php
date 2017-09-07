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
use WEB\PedidoSuporte;
use WEB\PedidoSuporteQuery;


/**
 * This class defines the structure of the 'PEDIDO_SUPORTE' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PedidoSuporteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'WEB.Map.PedidoSuporteTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'PEDIDO_SUPORTE';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\WEB\\PedidoSuporte';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'WEB.PedidoSuporte';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'PEDIDO_SUPORTE.id';

    /**
     * the column name for the tipo field
     */
    const COL_TIPO = 'PEDIDO_SUPORTE.tipo';

    /**
     * the column name for the area field
     */
    const COL_AREA = 'PEDIDO_SUPORTE.area';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'PEDIDO_SUPORTE.status';

    /**
     * the column name for the titulo field
     */
    const COL_TITULO = 'PEDIDO_SUPORTE.titulo';

    /**
     * the column name for the descricao field
     */
    const COL_DESCRICAO = 'PEDIDO_SUPORTE.descricao';

    /**
     * the column name for the idUsuario_Criador field
     */
    const COL_IDUSUARIO_CRIADOR = 'PEDIDO_SUPORTE.idUsuario_Criador';

    /**
     * the column name for the idUsuario_Executor field
     */
    const COL_IDUSUARIO_EXECUTOR = 'PEDIDO_SUPORTE.idUsuario_Executor';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the tipo field */
    const COL_TIPO_PROBLEMA = 'Problema';
    const COL_TIPO_TAREFA = 'Tarefa';
    const COL_TIPO_NOVO = 'Novo';

    /** The enumerated values for the area field */
    const COL_AREA_VENDAS = 'Vendas';
    const COL_AREA_DESENVOLVIMENTO = 'Desenvolvimento';
    const COL_AREA_MARKETING = 'Marketing';
    const COL_AREA_INFRAESTRUTURA = 'Infraestrutura';

    /** The enumerated values for the status field */
    const COL_STATUS_ENVIADA = 'Enviada';
    const COL_STATUS_ANDAMENTO = 'Andamento';
    const COL_STATUS_FINALIZADA = 'Finalizada';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Tipo', 'Area', 'Status', 'Titulo', 'Descricao', 'IdusuarioCriador', 'IdusuarioExecutor', ),
        self::TYPE_CAMELNAME     => array('id', 'tipo', 'area', 'status', 'titulo', 'descricao', 'idusuarioCriador', 'idusuarioExecutor', ),
        self::TYPE_COLNAME       => array(PedidoSuporteTableMap::COL_ID, PedidoSuporteTableMap::COL_TIPO, PedidoSuporteTableMap::COL_AREA, PedidoSuporteTableMap::COL_STATUS, PedidoSuporteTableMap::COL_TITULO, PedidoSuporteTableMap::COL_DESCRICAO, PedidoSuporteTableMap::COL_IDUSUARIO_CRIADOR, PedidoSuporteTableMap::COL_IDUSUARIO_EXECUTOR, ),
        self::TYPE_FIELDNAME     => array('id', 'tipo', 'area', 'status', 'titulo', 'descricao', 'idUsuario_Criador', 'idUsuario_Executor', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Tipo' => 1, 'Area' => 2, 'Status' => 3, 'Titulo' => 4, 'Descricao' => 5, 'IdusuarioCriador' => 6, 'IdusuarioExecutor' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'tipo' => 1, 'area' => 2, 'status' => 3, 'titulo' => 4, 'descricao' => 5, 'idusuarioCriador' => 6, 'idusuarioExecutor' => 7, ),
        self::TYPE_COLNAME       => array(PedidoSuporteTableMap::COL_ID => 0, PedidoSuporteTableMap::COL_TIPO => 1, PedidoSuporteTableMap::COL_AREA => 2, PedidoSuporteTableMap::COL_STATUS => 3, PedidoSuporteTableMap::COL_TITULO => 4, PedidoSuporteTableMap::COL_DESCRICAO => 5, PedidoSuporteTableMap::COL_IDUSUARIO_CRIADOR => 6, PedidoSuporteTableMap::COL_IDUSUARIO_EXECUTOR => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'tipo' => 1, 'area' => 2, 'status' => 3, 'titulo' => 4, 'descricao' => 5, 'idUsuario_Criador' => 6, 'idUsuario_Executor' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
                PedidoSuporteTableMap::COL_TIPO => array(
                            self::COL_TIPO_PROBLEMA,
            self::COL_TIPO_TAREFA,
            self::COL_TIPO_NOVO,
        ),
                PedidoSuporteTableMap::COL_AREA => array(
                            self::COL_AREA_VENDAS,
            self::COL_AREA_DESENVOLVIMENTO,
            self::COL_AREA_MARKETING,
            self::COL_AREA_INFRAESTRUTURA,
        ),
                PedidoSuporteTableMap::COL_STATUS => array(
                            self::COL_STATUS_ENVIADA,
            self::COL_STATUS_ANDAMENTO,
            self::COL_STATUS_FINALIZADA,
        ),
    );

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets()
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet($colname)
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

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
        $this->setName('PEDIDO_SUPORTE');
        $this->setPhpName('PedidoSuporte');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\WEB\\PedidoSuporte');
        $this->setPackage('WEB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('tipo', 'Tipo', 'ENUM', true, null, null);
        $this->getColumn('tipo')->setValueSet(array (
  0 => 'Problema',
  1 => 'Tarefa',
  2 => 'Novo',
));
        $this->addColumn('area', 'Area', 'ENUM', true, null, null);
        $this->getColumn('area')->setValueSet(array (
  0 => 'Vendas',
  1 => 'Desenvolvimento',
  2 => 'Marketing',
  3 => 'Infraestrutura',
));
        $this->addColumn('status', 'Status', 'ENUM', true, null, null);
        $this->getColumn('status')->setValueSet(array (
  0 => 'Enviada',
  1 => 'Andamento',
  2 => 'Finalizada',
));
        $this->addColumn('titulo', 'Titulo', 'VARCHAR', true, 255, null);
        $this->addColumn('descricao', 'Descricao', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('idUsuario_Criador', 'IdusuarioCriador', 'INTEGER', 'USUARIO', 'id', true, null, null);
        $this->addForeignKey('idUsuario_Executor', 'IdusuarioExecutor', 'INTEGER', 'USUARIO', 'id', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('UsuarioRelatedByIdusuarioCriador', '\\WEB\\Usuario', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idUsuario_Criador',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('UsuarioRelatedByIdusuarioExecutor', '\\WEB\\Usuario', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idUsuario_Executor',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Mensagens', '\\WEB\\Mensagens', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idPedidoSuporte',
    1 => ':id',
  ),
), null, null, 'Mensagenss', false);
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
        return $withPrefix ? PedidoSuporteTableMap::CLASS_DEFAULT : PedidoSuporteTableMap::OM_CLASS;
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
     * @return array           (PedidoSuporte object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PedidoSuporteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PedidoSuporteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PedidoSuporteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PedidoSuporteTableMap::OM_CLASS;
            /** @var PedidoSuporte $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PedidoSuporteTableMap::addInstanceToPool($obj, $key);
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
            $key = PedidoSuporteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PedidoSuporteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PedidoSuporte $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PedidoSuporteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PedidoSuporteTableMap::COL_ID);
            $criteria->addSelectColumn(PedidoSuporteTableMap::COL_TIPO);
            $criteria->addSelectColumn(PedidoSuporteTableMap::COL_AREA);
            $criteria->addSelectColumn(PedidoSuporteTableMap::COL_STATUS);
            $criteria->addSelectColumn(PedidoSuporteTableMap::COL_TITULO);
            $criteria->addSelectColumn(PedidoSuporteTableMap::COL_DESCRICAO);
            $criteria->addSelectColumn(PedidoSuporteTableMap::COL_IDUSUARIO_CRIADOR);
            $criteria->addSelectColumn(PedidoSuporteTableMap::COL_IDUSUARIO_EXECUTOR);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.tipo');
            $criteria->addSelectColumn($alias . '.area');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.titulo');
            $criteria->addSelectColumn($alias . '.descricao');
            $criteria->addSelectColumn($alias . '.idUsuario_Criador');
            $criteria->addSelectColumn($alias . '.idUsuario_Executor');
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
        return Propel::getServiceContainer()->getDatabaseMap(PedidoSuporteTableMap::DATABASE_NAME)->getTable(PedidoSuporteTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PedidoSuporteTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PedidoSuporteTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PedidoSuporteTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a PedidoSuporte or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or PedidoSuporte object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoSuporteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \WEB\PedidoSuporte) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PedidoSuporteTableMap::DATABASE_NAME);
            $criteria->add(PedidoSuporteTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PedidoSuporteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PedidoSuporteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PedidoSuporteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the PEDIDO_SUPORTE table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PedidoSuporteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PedidoSuporte or Criteria object.
     *
     * @param mixed               $criteria Criteria or PedidoSuporte object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoSuporteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PedidoSuporte object
        }

        if ($criteria->containsKey(PedidoSuporteTableMap::COL_ID) && $criteria->keyContainsValue(PedidoSuporteTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PedidoSuporteTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PedidoSuporteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PedidoSuporteTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PedidoSuporteTableMap::buildTableMap();
