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
use WEB\Mensagens as ChildMensagens;
use WEB\MensagensQuery as ChildMensagensQuery;
use WEB\Map\MensagensTableMap;

/**
 * Base class that represents a query for the 'MENSAGENS' table.
 *
 *
 *
 * @method     ChildMensagensQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMensagensQuery orderByMensagem($order = Criteria::ASC) Order by the mensagem column
 * @method     ChildMensagensQuery orderByImg($order = Criteria::ASC) Order by the img column
 * @method     ChildMensagensQuery orderByIdusuarioCriador($order = Criteria::ASC) Order by the idUsuario_Criador column
 * @method     ChildMensagensQuery orderByIdpedidosuporte($order = Criteria::ASC) Order by the idPedidoSuporte column
 *
 * @method     ChildMensagensQuery groupById() Group by the id column
 * @method     ChildMensagensQuery groupByMensagem() Group by the mensagem column
 * @method     ChildMensagensQuery groupByImg() Group by the img column
 * @method     ChildMensagensQuery groupByIdusuarioCriador() Group by the idUsuario_Criador column
 * @method     ChildMensagensQuery groupByIdpedidosuporte() Group by the idPedidoSuporte column
 *
 * @method     ChildMensagensQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMensagensQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMensagensQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMensagensQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMensagensQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMensagensQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMensagensQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildMensagensQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildMensagensQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildMensagensQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildMensagensQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildMensagensQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildMensagensQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildMensagensQuery leftJoinPedidoSuporte($relationAlias = null) Adds a LEFT JOIN clause to the query using the PedidoSuporte relation
 * @method     ChildMensagensQuery rightJoinPedidoSuporte($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PedidoSuporte relation
 * @method     ChildMensagensQuery innerJoinPedidoSuporte($relationAlias = null) Adds a INNER JOIN clause to the query using the PedidoSuporte relation
 *
 * @method     ChildMensagensQuery joinWithPedidoSuporte($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PedidoSuporte relation
 *
 * @method     ChildMensagensQuery leftJoinWithPedidoSuporte() Adds a LEFT JOIN clause and with to the query using the PedidoSuporte relation
 * @method     ChildMensagensQuery rightJoinWithPedidoSuporte() Adds a RIGHT JOIN clause and with to the query using the PedidoSuporte relation
 * @method     ChildMensagensQuery innerJoinWithPedidoSuporte() Adds a INNER JOIN clause and with to the query using the PedidoSuporte relation
 *
 * @method     \WEB\UsuarioQuery|\WEB\PedidoSuporteQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMensagens findOne(ConnectionInterface $con = null) Return the first ChildMensagens matching the query
 * @method     ChildMensagens findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMensagens matching the query, or a new ChildMensagens object populated from the query conditions when no match is found
 *
 * @method     ChildMensagens findOneById(int $id) Return the first ChildMensagens filtered by the id column
 * @method     ChildMensagens findOneByMensagem(string $mensagem) Return the first ChildMensagens filtered by the mensagem column
 * @method     ChildMensagens findOneByImg(string $img) Return the first ChildMensagens filtered by the img column
 * @method     ChildMensagens findOneByIdusuarioCriador(int $idUsuario_Criador) Return the first ChildMensagens filtered by the idUsuario_Criador column
 * @method     ChildMensagens findOneByIdpedidosuporte(int $idPedidoSuporte) Return the first ChildMensagens filtered by the idPedidoSuporte column *

 * @method     ChildMensagens requirePk($key, ConnectionInterface $con = null) Return the ChildMensagens by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMensagens requireOne(ConnectionInterface $con = null) Return the first ChildMensagens matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMensagens requireOneById(int $id) Return the first ChildMensagens filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMensagens requireOneByMensagem(string $mensagem) Return the first ChildMensagens filtered by the mensagem column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMensagens requireOneByImg(string $img) Return the first ChildMensagens filtered by the img column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMensagens requireOneByIdusuarioCriador(int $idUsuario_Criador) Return the first ChildMensagens filtered by the idUsuario_Criador column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMensagens requireOneByIdpedidosuporte(int $idPedidoSuporte) Return the first ChildMensagens filtered by the idPedidoSuporte column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMensagens[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMensagens objects based on current ModelCriteria
 * @method     ChildMensagens[]|ObjectCollection findById(int $id) Return ChildMensagens objects filtered by the id column
 * @method     ChildMensagens[]|ObjectCollection findByMensagem(string $mensagem) Return ChildMensagens objects filtered by the mensagem column
 * @method     ChildMensagens[]|ObjectCollection findByImg(string $img) Return ChildMensagens objects filtered by the img column
 * @method     ChildMensagens[]|ObjectCollection findByIdusuarioCriador(int $idUsuario_Criador) Return ChildMensagens objects filtered by the idUsuario_Criador column
 * @method     ChildMensagens[]|ObjectCollection findByIdpedidosuporte(int $idPedidoSuporte) Return ChildMensagens objects filtered by the idPedidoSuporte column
 * @method     ChildMensagens[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MensagensQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \WEB\Base\MensagensQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\WEB\\Mensagens', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMensagensQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMensagensQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMensagensQuery) {
            return $criteria;
        }
        $query = new ChildMensagensQuery();
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
     * @return ChildMensagens|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MensagensTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MensagensTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMensagens A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, mensagem, img, idUsuario_Criador, idPedidoSuporte FROM MENSAGENS WHERE id = :p0';
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
            /** @var ChildMensagens $obj */
            $obj = new ChildMensagens();
            $obj->hydrate($row);
            MensagensTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMensagens|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMensagensQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MensagensTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMensagensQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MensagensTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildMensagensQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MensagensTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MensagensTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MensagensTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the mensagem column
     *
     * Example usage:
     * <code>
     * $query->filterByMensagem('fooValue');   // WHERE mensagem = 'fooValue'
     * $query->filterByMensagem('%fooValue%', Criteria::LIKE); // WHERE mensagem LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mensagem The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMensagensQuery The current query, for fluid interface
     */
    public function filterByMensagem($mensagem = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mensagem)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MensagensTableMap::COL_MENSAGEM, $mensagem, $comparison);
    }

    /**
     * Filter the query on the img column
     *
     * Example usage:
     * <code>
     * $query->filterByImg('fooValue');   // WHERE img = 'fooValue'
     * $query->filterByImg('%fooValue%', Criteria::LIKE); // WHERE img LIKE '%fooValue%'
     * </code>
     *
     * @param     string $img The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMensagensQuery The current query, for fluid interface
     */
    public function filterByImg($img = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($img)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MensagensTableMap::COL_IMG, $img, $comparison);
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
     * @see       filterByUsuario()
     *
     * @param     mixed $idusuarioCriador The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMensagensQuery The current query, for fluid interface
     */
    public function filterByIdusuarioCriador($idusuarioCriador = null, $comparison = null)
    {
        if (is_array($idusuarioCriador)) {
            $useMinMax = false;
            if (isset($idusuarioCriador['min'])) {
                $this->addUsingAlias(MensagensTableMap::COL_IDUSUARIO_CRIADOR, $idusuarioCriador['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idusuarioCriador['max'])) {
                $this->addUsingAlias(MensagensTableMap::COL_IDUSUARIO_CRIADOR, $idusuarioCriador['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MensagensTableMap::COL_IDUSUARIO_CRIADOR, $idusuarioCriador, $comparison);
    }

    /**
     * Filter the query on the idPedidoSuporte column
     *
     * Example usage:
     * <code>
     * $query->filterByIdpedidosuporte(1234); // WHERE idPedidoSuporte = 1234
     * $query->filterByIdpedidosuporte(array(12, 34)); // WHERE idPedidoSuporte IN (12, 34)
     * $query->filterByIdpedidosuporte(array('min' => 12)); // WHERE idPedidoSuporte > 12
     * </code>
     *
     * @see       filterByPedidoSuporte()
     *
     * @param     mixed $idpedidosuporte The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMensagensQuery The current query, for fluid interface
     */
    public function filterByIdpedidosuporte($idpedidosuporte = null, $comparison = null)
    {
        if (is_array($idpedidosuporte)) {
            $useMinMax = false;
            if (isset($idpedidosuporte['min'])) {
                $this->addUsingAlias(MensagensTableMap::COL_IDPEDIDOSUPORTE, $idpedidosuporte['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idpedidosuporte['max'])) {
                $this->addUsingAlias(MensagensTableMap::COL_IDPEDIDOSUPORTE, $idpedidosuporte['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MensagensTableMap::COL_IDPEDIDOSUPORTE, $idpedidosuporte, $comparison);
    }

    /**
     * Filter the query by a related \WEB\Usuario object
     *
     * @param \WEB\Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMensagensQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \WEB\Usuario) {
            return $this
                ->addUsingAlias(MensagensTableMap::COL_IDUSUARIO_CRIADOR, $usuario->getId(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MensagensTableMap::COL_IDUSUARIO_CRIADOR, $usuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsuario() only accepts arguments of type \WEB\Usuario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMensagensQuery The current query, for fluid interface
     */
    public function joinUsuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuario');

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
            $this->addJoinObject($join, 'Usuario');
        }

        return $this;
    }

    /**
     * Use the Usuario relation Usuario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \WEB\UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuario', '\WEB\UsuarioQuery');
    }

    /**
     * Filter the query by a related \WEB\PedidoSuporte object
     *
     * @param \WEB\PedidoSuporte|ObjectCollection $pedidoSuporte The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMensagensQuery The current query, for fluid interface
     */
    public function filterByPedidoSuporte($pedidoSuporte, $comparison = null)
    {
        if ($pedidoSuporte instanceof \WEB\PedidoSuporte) {
            return $this
                ->addUsingAlias(MensagensTableMap::COL_IDPEDIDOSUPORTE, $pedidoSuporte->getId(), $comparison);
        } elseif ($pedidoSuporte instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MensagensTableMap::COL_IDPEDIDOSUPORTE, $pedidoSuporte->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPedidoSuporte() only accepts arguments of type \WEB\PedidoSuporte or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PedidoSuporte relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMensagensQuery The current query, for fluid interface
     */
    public function joinPedidoSuporte($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PedidoSuporte');

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
            $this->addJoinObject($join, 'PedidoSuporte');
        }

        return $this;
    }

    /**
     * Use the PedidoSuporte relation PedidoSuporte object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \WEB\PedidoSuporteQuery A secondary query class using the current class as primary query
     */
    public function usePedidoSuporteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPedidoSuporte($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PedidoSuporte', '\WEB\PedidoSuporteQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMensagens $mensagens Object to remove from the list of results
     *
     * @return $this|ChildMensagensQuery The current query, for fluid interface
     */
    public function prune($mensagens = null)
    {
        if ($mensagens) {
            $this->addUsingAlias(MensagensTableMap::COL_ID, $mensagens->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the MENSAGENS table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MensagensTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MensagensTableMap::clearInstancePool();
            MensagensTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MensagensTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MensagensTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MensagensTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MensagensTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MensagensQuery
