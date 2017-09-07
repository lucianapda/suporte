<?php

namespace WEB\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use WEB\PedidoSuporte as ChildPedidoSuporte;
use WEB\PedidoSuporteQuery as ChildPedidoSuporteQuery;
use WEB\Map\PedidoSuporteTableMap;

/**
 * Base class that represents a query for the 'PEDIDO_SUPORTE' table.
 *
 *
 *
 * @method     ChildPedidoSuporteQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPedidoSuporteQuery orderByTipo($order = Criteria::ASC) Order by the tipo column
 * @method     ChildPedidoSuporteQuery orderByArea($order = Criteria::ASC) Order by the area column
 * @method     ChildPedidoSuporteQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildPedidoSuporteQuery orderByTitulo($order = Criteria::ASC) Order by the titulo column
 * @method     ChildPedidoSuporteQuery orderByDescricao($order = Criteria::ASC) Order by the descricao column
 * @method     ChildPedidoSuporteQuery orderByIdusuarioCriador($order = Criteria::ASC) Order by the idUsuario_Criador column
 * @method     ChildPedidoSuporteQuery orderByIdusuarioExecutor($order = Criteria::ASC) Order by the idUsuario_Executor column
 *
 * @method     ChildPedidoSuporteQuery groupById() Group by the id column
 * @method     ChildPedidoSuporteQuery groupByTipo() Group by the tipo column
 * @method     ChildPedidoSuporteQuery groupByArea() Group by the area column
 * @method     ChildPedidoSuporteQuery groupByStatus() Group by the status column
 * @method     ChildPedidoSuporteQuery groupByTitulo() Group by the titulo column
 * @method     ChildPedidoSuporteQuery groupByDescricao() Group by the descricao column
 * @method     ChildPedidoSuporteQuery groupByIdusuarioCriador() Group by the idUsuario_Criador column
 * @method     ChildPedidoSuporteQuery groupByIdusuarioExecutor() Group by the idUsuario_Executor column
 *
 * @method     ChildPedidoSuporteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPedidoSuporteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPedidoSuporteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPedidoSuporteQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPedidoSuporteQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPedidoSuporteQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPedidoSuporteQuery leftJoinUsuarioRelatedByIdusuarioCriador($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioRelatedByIdusuarioCriador relation
 * @method     ChildPedidoSuporteQuery rightJoinUsuarioRelatedByIdusuarioCriador($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioRelatedByIdusuarioCriador relation
 * @method     ChildPedidoSuporteQuery innerJoinUsuarioRelatedByIdusuarioCriador($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioRelatedByIdusuarioCriador relation
 *
 * @method     ChildPedidoSuporteQuery joinWithUsuarioRelatedByIdusuarioCriador($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsuarioRelatedByIdusuarioCriador relation
 *
 * @method     ChildPedidoSuporteQuery leftJoinWithUsuarioRelatedByIdusuarioCriador() Adds a LEFT JOIN clause and with to the query using the UsuarioRelatedByIdusuarioCriador relation
 * @method     ChildPedidoSuporteQuery rightJoinWithUsuarioRelatedByIdusuarioCriador() Adds a RIGHT JOIN clause and with to the query using the UsuarioRelatedByIdusuarioCriador relation
 * @method     ChildPedidoSuporteQuery innerJoinWithUsuarioRelatedByIdusuarioCriador() Adds a INNER JOIN clause and with to the query using the UsuarioRelatedByIdusuarioCriador relation
 *
 * @method     ChildPedidoSuporteQuery leftJoinUsuarioRelatedByIdusuarioExecutor($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioRelatedByIdusuarioExecutor relation
 * @method     ChildPedidoSuporteQuery rightJoinUsuarioRelatedByIdusuarioExecutor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioRelatedByIdusuarioExecutor relation
 * @method     ChildPedidoSuporteQuery innerJoinUsuarioRelatedByIdusuarioExecutor($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioRelatedByIdusuarioExecutor relation
 *
 * @method     ChildPedidoSuporteQuery joinWithUsuarioRelatedByIdusuarioExecutor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsuarioRelatedByIdusuarioExecutor relation
 *
 * @method     ChildPedidoSuporteQuery leftJoinWithUsuarioRelatedByIdusuarioExecutor() Adds a LEFT JOIN clause and with to the query using the UsuarioRelatedByIdusuarioExecutor relation
 * @method     ChildPedidoSuporteQuery rightJoinWithUsuarioRelatedByIdusuarioExecutor() Adds a RIGHT JOIN clause and with to the query using the UsuarioRelatedByIdusuarioExecutor relation
 * @method     ChildPedidoSuporteQuery innerJoinWithUsuarioRelatedByIdusuarioExecutor() Adds a INNER JOIN clause and with to the query using the UsuarioRelatedByIdusuarioExecutor relation
 *
 * @method     ChildPedidoSuporteQuery leftJoinMensagens($relationAlias = null) Adds a LEFT JOIN clause to the query using the Mensagens relation
 * @method     ChildPedidoSuporteQuery rightJoinMensagens($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Mensagens relation
 * @method     ChildPedidoSuporteQuery innerJoinMensagens($relationAlias = null) Adds a INNER JOIN clause to the query using the Mensagens relation
 *
 * @method     ChildPedidoSuporteQuery joinWithMensagens($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Mensagens relation
 *
 * @method     ChildPedidoSuporteQuery leftJoinWithMensagens() Adds a LEFT JOIN clause and with to the query using the Mensagens relation
 * @method     ChildPedidoSuporteQuery rightJoinWithMensagens() Adds a RIGHT JOIN clause and with to the query using the Mensagens relation
 * @method     ChildPedidoSuporteQuery innerJoinWithMensagens() Adds a INNER JOIN clause and with to the query using the Mensagens relation
 *
 * @method     \WEB\UsuarioQuery|\WEB\MensagensQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPedidoSuporte findOne(ConnectionInterface $con = null) Return the first ChildPedidoSuporte matching the query
 * @method     ChildPedidoSuporte findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPedidoSuporte matching the query, or a new ChildPedidoSuporte object populated from the query conditions when no match is found
 *
 * @method     ChildPedidoSuporte findOneById(int $id) Return the first ChildPedidoSuporte filtered by the id column
 * @method     ChildPedidoSuporte findOneByTipo(int $tipo) Return the first ChildPedidoSuporte filtered by the tipo column
 * @method     ChildPedidoSuporte findOneByArea(int $area) Return the first ChildPedidoSuporte filtered by the area column
 * @method     ChildPedidoSuporte findOneByStatus(int $status) Return the first ChildPedidoSuporte filtered by the status column
 * @method     ChildPedidoSuporte findOneByTitulo(string $titulo) Return the first ChildPedidoSuporte filtered by the titulo column
 * @method     ChildPedidoSuporte findOneByDescricao(string $descricao) Return the first ChildPedidoSuporte filtered by the descricao column
 * @method     ChildPedidoSuporte findOneByIdusuarioCriador(int $idUsuario_Criador) Return the first ChildPedidoSuporte filtered by the idUsuario_Criador column
 * @method     ChildPedidoSuporte findOneByIdusuarioExecutor(int $idUsuario_Executor) Return the first ChildPedidoSuporte filtered by the idUsuario_Executor column *

 * @method     ChildPedidoSuporte requirePk($key, ConnectionInterface $con = null) Return the ChildPedidoSuporte by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedidoSuporte requireOne(ConnectionInterface $con = null) Return the first ChildPedidoSuporte matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPedidoSuporte requireOneById(int $id) Return the first ChildPedidoSuporte filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedidoSuporte requireOneByTipo(int $tipo) Return the first ChildPedidoSuporte filtered by the tipo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedidoSuporte requireOneByArea(int $area) Return the first ChildPedidoSuporte filtered by the area column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedidoSuporte requireOneByStatus(int $status) Return the first ChildPedidoSuporte filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedidoSuporte requireOneByTitulo(string $titulo) Return the first ChildPedidoSuporte filtered by the titulo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedidoSuporte requireOneByDescricao(string $descricao) Return the first ChildPedidoSuporte filtered by the descricao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedidoSuporte requireOneByIdusuarioCriador(int $idUsuario_Criador) Return the first ChildPedidoSuporte filtered by the idUsuario_Criador column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedidoSuporte requireOneByIdusuarioExecutor(int $idUsuario_Executor) Return the first ChildPedidoSuporte filtered by the idUsuario_Executor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPedidoSuporte[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPedidoSuporte objects based on current ModelCriteria
 * @method     ChildPedidoSuporte[]|ObjectCollection findById(int $id) Return ChildPedidoSuporte objects filtered by the id column
 * @method     ChildPedidoSuporte[]|ObjectCollection findByTipo(int $tipo) Return ChildPedidoSuporte objects filtered by the tipo column
 * @method     ChildPedidoSuporte[]|ObjectCollection findByArea(int $area) Return ChildPedidoSuporte objects filtered by the area column
 * @method     ChildPedidoSuporte[]|ObjectCollection findByStatus(int $status) Return ChildPedidoSuporte objects filtered by the status column
 * @method     ChildPedidoSuporte[]|ObjectCollection findByTitulo(string $titulo) Return ChildPedidoSuporte objects filtered by the titulo column
 * @method     ChildPedidoSuporte[]|ObjectCollection findByDescricao(string $descricao) Return ChildPedidoSuporte objects filtered by the descricao column
 * @method     ChildPedidoSuporte[]|ObjectCollection findByIdusuarioCriador(int $idUsuario_Criador) Return ChildPedidoSuporte objects filtered by the idUsuario_Criador column
 * @method     ChildPedidoSuporte[]|ObjectCollection findByIdusuarioExecutor(int $idUsuario_Executor) Return ChildPedidoSuporte objects filtered by the idUsuario_Executor column
 * @method     ChildPedidoSuporte[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PedidoSuporteQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \WEB\Base\PedidoSuporteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\WEB\\PedidoSuporte', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPedidoSuporteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPedidoSuporteQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPedidoSuporteQuery) {
            return $criteria;
        }
        $query = new ChildPedidoSuporteQuery();
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
     * @return ChildPedidoSuporte|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PedidoSuporteTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PedidoSuporteTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPedidoSuporte A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, tipo, area, status, titulo, descricao, idUsuario_Criador, idUsuario_Executor FROM PEDIDO_SUPORTE WHERE id = :p0';
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
            /** @var ChildPedidoSuporte $obj */
            $obj = new ChildPedidoSuporte();
            $obj->hydrate($row);
            PedidoSuporteTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPedidoSuporte|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PedidoSuporteTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PedidoSuporteTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PedidoSuporteTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PedidoSuporteTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoSuporteTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the tipo column
     *
     * @param     mixed $tipo The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByTipo($tipo = null, $comparison = null)
    {
        $valueSet = PedidoSuporteTableMap::getValueSet(PedidoSuporteTableMap::COL_TIPO);
        if (is_scalar($tipo)) {
            if (!in_array($tipo, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $tipo));
            }
            $tipo = array_search($tipo, $valueSet);
        } elseif (is_array($tipo)) {
            $convertedValues = array();
            foreach ($tipo as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $tipo = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoSuporteTableMap::COL_TIPO, $tipo, $comparison);
    }

    /**
     * Filter the query on the area column
     *
     * @param     mixed $area The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByArea($area = null, $comparison = null)
    {
        $valueSet = PedidoSuporteTableMap::getValueSet(PedidoSuporteTableMap::COL_AREA);
        if (is_scalar($area)) {
            if (!in_array($area, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $area));
            }
            $area = array_search($area, $valueSet);
        } elseif (is_array($area)) {
            $convertedValues = array();
            foreach ($area as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $area = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoSuporteTableMap::COL_AREA, $area, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * @param     mixed $status The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        $valueSet = PedidoSuporteTableMap::getValueSet(PedidoSuporteTableMap::COL_STATUS);
        if (is_scalar($status)) {
            if (!in_array($status, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $status));
            }
            $status = array_search($status, $valueSet);
        } elseif (is_array($status)) {
            $convertedValues = array();
            foreach ($status as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $status = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoSuporteTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the titulo column
     *
     * Example usage:
     * <code>
     * $query->filterByTitulo('fooValue');   // WHERE titulo = 'fooValue'
     * $query->filterByTitulo('%fooValue%', Criteria::LIKE); // WHERE titulo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titulo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByTitulo($titulo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titulo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoSuporteTableMap::COL_TITULO, $titulo, $comparison);
    }

    /**
     * Filter the query on the descricao column
     *
     * Example usage:
     * <code>
     * $query->filterByDescricao('fooValue');   // WHERE descricao = 'fooValue'
     * $query->filterByDescricao('%fooValue%', Criteria::LIKE); // WHERE descricao LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descricao The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByDescricao($descricao = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descricao)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoSuporteTableMap::COL_DESCRICAO, $descricao, $comparison);
    }

    /**
     * Filter the query on the idUsuario_Criador column
     *
     * Example usage:
     * <code>
     * $query->filterByIdusuarioCriador(1234); // WHERE idUsuario_Criador = 1234
     * $query->filterByIdusuarioCriador(array(12, 34)); // WHERE idUsuario_Criador IN (12, 34)
     * $query->filterByIdusuarioCriador(array('min' => 12)); // WHERE idUsuario_Criador > 12
     * </code>
     *
     * @see       filterByUsuarioRelatedByIdusuarioCriador()
     *
     * @param     mixed $idusuarioCriador The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByIdusuarioCriador($idusuarioCriador = null, $comparison = null)
    {
        if (is_array($idusuarioCriador)) {
            $useMinMax = false;
            if (isset($idusuarioCriador['min'])) {
                $this->addUsingAlias(PedidoSuporteTableMap::COL_IDUSUARIO_CRIADOR, $idusuarioCriador['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idusuarioCriador['max'])) {
                $this->addUsingAlias(PedidoSuporteTableMap::COL_IDUSUARIO_CRIADOR, $idusuarioCriador['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoSuporteTableMap::COL_IDUSUARIO_CRIADOR, $idusuarioCriador, $comparison);
    }

    /**
     * Filter the query on the idUsuario_Executor column
     *
     * Example usage:
     * <code>
     * $query->filterByIdusuarioExecutor(1234); // WHERE idUsuario_Executor = 1234
     * $query->filterByIdusuarioExecutor(array(12, 34)); // WHERE idUsuario_Executor IN (12, 34)
     * $query->filterByIdusuarioExecutor(array('min' => 12)); // WHERE idUsuario_Executor > 12
     * </code>
     *
     * @see       filterByUsuarioRelatedByIdusuarioExecutor()
     *
     * @param     mixed $idusuarioExecutor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByIdusuarioExecutor($idusuarioExecutor = null, $comparison = null)
    {
        if (is_array($idusuarioExecutor)) {
            $useMinMax = false;
            if (isset($idusuarioExecutor['min'])) {
                $this->addUsingAlias(PedidoSuporteTableMap::COL_IDUSUARIO_EXECUTOR, $idusuarioExecutor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idusuarioExecutor['max'])) {
                $this->addUsingAlias(PedidoSuporteTableMap::COL_IDUSUARIO_EXECUTOR, $idusuarioExecutor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoSuporteTableMap::COL_IDUSUARIO_EXECUTOR, $idusuarioExecutor, $comparison);
    }

    /**
     * Filter the query by a related \WEB\Usuario object
     *
     * @param \WEB\Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByUsuarioRelatedByIdusuarioCriador($usuario, $comparison = null)
    {
        if ($usuario instanceof \WEB\Usuario) {
            return $this
                ->addUsingAlias(PedidoSuporteTableMap::COL_IDUSUARIO_CRIADOR, $usuario->getId(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PedidoSuporteTableMap::COL_IDUSUARIO_CRIADOR, $usuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsuarioRelatedByIdusuarioCriador() only accepts arguments of type \WEB\Usuario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsuarioRelatedByIdusuarioCriador relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function joinUsuarioRelatedByIdusuarioCriador($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsuarioRelatedByIdusuarioCriador');

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
            $this->addJoinObject($join, 'UsuarioRelatedByIdusuarioCriador');
        }

        return $this;
    }

    /**
     * Use the UsuarioRelatedByIdusuarioCriador relation Usuario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \WEB\UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioRelatedByIdusuarioCriadorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuarioRelatedByIdusuarioCriador($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioRelatedByIdusuarioCriador', '\WEB\UsuarioQuery');
    }

    /**
     * Filter the query by a related \WEB\Usuario object
     *
     * @param \WEB\Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByUsuarioRelatedByIdusuarioExecutor($usuario, $comparison = null)
    {
        if ($usuario instanceof \WEB\Usuario) {
            return $this
                ->addUsingAlias(PedidoSuporteTableMap::COL_IDUSUARIO_EXECUTOR, $usuario->getId(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PedidoSuporteTableMap::COL_IDUSUARIO_EXECUTOR, $usuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsuarioRelatedByIdusuarioExecutor() only accepts arguments of type \WEB\Usuario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsuarioRelatedByIdusuarioExecutor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function joinUsuarioRelatedByIdusuarioExecutor($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsuarioRelatedByIdusuarioExecutor');

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
            $this->addJoinObject($join, 'UsuarioRelatedByIdusuarioExecutor');
        }

        return $this;
    }

    /**
     * Use the UsuarioRelatedByIdusuarioExecutor relation Usuario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \WEB\UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioRelatedByIdusuarioExecutorQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsuarioRelatedByIdusuarioExecutor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioRelatedByIdusuarioExecutor', '\WEB\UsuarioQuery');
    }

    /**
     * Filter the query by a related \WEB\Mensagens object
     *
     * @param \WEB\Mensagens|ObjectCollection $mensagens the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function filterByMensagens($mensagens, $comparison = null)
    {
        if ($mensagens instanceof \WEB\Mensagens) {
            return $this
                ->addUsingAlias(PedidoSuporteTableMap::COL_ID, $mensagens->getIdpedidosuporte(), $comparison);
        } elseif ($mensagens instanceof ObjectCollection) {
            return $this
                ->useMensagensQuery()
                ->filterByPrimaryKeys($mensagens->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMensagens() only accepts arguments of type \WEB\Mensagens or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Mensagens relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function joinMensagens($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Mensagens');

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
            $this->addJoinObject($join, 'Mensagens');
        }

        return $this;
    }

    /**
     * Use the Mensagens relation Mensagens object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \WEB\MensagensQuery A secondary query class using the current class as primary query
     */
    public function useMensagensQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMensagens($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Mensagens', '\WEB\MensagensQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPedidoSuporte $pedidoSuporte Object to remove from the list of results
     *
     * @return $this|ChildPedidoSuporteQuery The current query, for fluid interface
     */
    public function prune($pedidoSuporte = null)
    {
        if ($pedidoSuporte) {
            $this->addUsingAlias(PedidoSuporteTableMap::COL_ID, $pedidoSuporte->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the PEDIDO_SUPORTE table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoSuporteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PedidoSuporteTableMap::clearInstancePool();
            PedidoSuporteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoSuporteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PedidoSuporteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PedidoSuporteTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PedidoSuporteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PedidoSuporteQuery
