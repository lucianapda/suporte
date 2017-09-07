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
use WEB\Usuario as ChildUsuario;
use WEB\UsuarioQuery as ChildUsuarioQuery;
use WEB\Map\UsuarioTableMap;

/**
 * Base class that represents a query for the 'USUARIO' table.
 *
 *
 *
 * @method     ChildUsuarioQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsuarioQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildUsuarioQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsuarioQuery orderByTelefone($order = Criteria::ASC) Order by the telefone column
 * @method     ChildUsuarioQuery orderByUsario($order = Criteria::ASC) Order by the usario column
 * @method     ChildUsuarioQuery orderBySenha($order = Criteria::ASC) Order by the senha column
 * @method     ChildUsuarioQuery orderByIsadmin($order = Criteria::ASC) Order by the isAdmin column
 *
 * @method     ChildUsuarioQuery groupById() Group by the id column
 * @method     ChildUsuarioQuery groupByNome() Group by the nome column
 * @method     ChildUsuarioQuery groupByEmail() Group by the email column
 * @method     ChildUsuarioQuery groupByTelefone() Group by the telefone column
 * @method     ChildUsuarioQuery groupByUsario() Group by the usario column
 * @method     ChildUsuarioQuery groupBySenha() Group by the senha column
 * @method     ChildUsuarioQuery groupByIsadmin() Group by the isAdmin column
 *
 * @method     ChildUsuarioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsuarioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsuarioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsuarioQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsuarioQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsuarioQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsuarioQuery leftJoinPedidoSuporteRelatedByIdusuarioCriador($relationAlias = null) Adds a LEFT JOIN clause to the query using the PedidoSuporteRelatedByIdusuarioCriador relation
 * @method     ChildUsuarioQuery rightJoinPedidoSuporteRelatedByIdusuarioCriador($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PedidoSuporteRelatedByIdusuarioCriador relation
 * @method     ChildUsuarioQuery innerJoinPedidoSuporteRelatedByIdusuarioCriador($relationAlias = null) Adds a INNER JOIN clause to the query using the PedidoSuporteRelatedByIdusuarioCriador relation
 *
 * @method     ChildUsuarioQuery joinWithPedidoSuporteRelatedByIdusuarioCriador($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PedidoSuporteRelatedByIdusuarioCriador relation
 *
 * @method     ChildUsuarioQuery leftJoinWithPedidoSuporteRelatedByIdusuarioCriador() Adds a LEFT JOIN clause and with to the query using the PedidoSuporteRelatedByIdusuarioCriador relation
 * @method     ChildUsuarioQuery rightJoinWithPedidoSuporteRelatedByIdusuarioCriador() Adds a RIGHT JOIN clause and with to the query using the PedidoSuporteRelatedByIdusuarioCriador relation
 * @method     ChildUsuarioQuery innerJoinWithPedidoSuporteRelatedByIdusuarioCriador() Adds a INNER JOIN clause and with to the query using the PedidoSuporteRelatedByIdusuarioCriador relation
 *
 * @method     ChildUsuarioQuery leftJoinPedidoSuporteRelatedByIdusuarioExecutor($relationAlias = null) Adds a LEFT JOIN clause to the query using the PedidoSuporteRelatedByIdusuarioExecutor relation
 * @method     ChildUsuarioQuery rightJoinPedidoSuporteRelatedByIdusuarioExecutor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PedidoSuporteRelatedByIdusuarioExecutor relation
 * @method     ChildUsuarioQuery innerJoinPedidoSuporteRelatedByIdusuarioExecutor($relationAlias = null) Adds a INNER JOIN clause to the query using the PedidoSuporteRelatedByIdusuarioExecutor relation
 *
 * @method     ChildUsuarioQuery joinWithPedidoSuporteRelatedByIdusuarioExecutor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PedidoSuporteRelatedByIdusuarioExecutor relation
 *
 * @method     ChildUsuarioQuery leftJoinWithPedidoSuporteRelatedByIdusuarioExecutor() Adds a LEFT JOIN clause and with to the query using the PedidoSuporteRelatedByIdusuarioExecutor relation
 * @method     ChildUsuarioQuery rightJoinWithPedidoSuporteRelatedByIdusuarioExecutor() Adds a RIGHT JOIN clause and with to the query using the PedidoSuporteRelatedByIdusuarioExecutor relation
 * @method     ChildUsuarioQuery innerJoinWithPedidoSuporteRelatedByIdusuarioExecutor() Adds a INNER JOIN clause and with to the query using the PedidoSuporteRelatedByIdusuarioExecutor relation
 *
 * @method     ChildUsuarioQuery leftJoinMensagens($relationAlias = null) Adds a LEFT JOIN clause to the query using the Mensagens relation
 * @method     ChildUsuarioQuery rightJoinMensagens($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Mensagens relation
 * @method     ChildUsuarioQuery innerJoinMensagens($relationAlias = null) Adds a INNER JOIN clause to the query using the Mensagens relation
 *
 * @method     ChildUsuarioQuery joinWithMensagens($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Mensagens relation
 *
 * @method     ChildUsuarioQuery leftJoinWithMensagens() Adds a LEFT JOIN clause and with to the query using the Mensagens relation
 * @method     ChildUsuarioQuery rightJoinWithMensagens() Adds a RIGHT JOIN clause and with to the query using the Mensagens relation
 * @method     ChildUsuarioQuery innerJoinWithMensagens() Adds a INNER JOIN clause and with to the query using the Mensagens relation
 *
 * @method     \WEB\PedidoSuporteQuery|\WEB\MensagensQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsuario findOne(ConnectionInterface $con = null) Return the first ChildUsuario matching the query
 * @method     ChildUsuario findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsuario matching the query, or a new ChildUsuario object populated from the query conditions when no match is found
 *
 * @method     ChildUsuario findOneById(int $id) Return the first ChildUsuario filtered by the id column
 * @method     ChildUsuario findOneByNome(string $nome) Return the first ChildUsuario filtered by the nome column
 * @method     ChildUsuario findOneByEmail(string $email) Return the first ChildUsuario filtered by the email column
 * @method     ChildUsuario findOneByTelefone(string $telefone) Return the first ChildUsuario filtered by the telefone column
 * @method     ChildUsuario findOneByUsario(string $usario) Return the first ChildUsuario filtered by the usario column
 * @method     ChildUsuario findOneBySenha(string $senha) Return the first ChildUsuario filtered by the senha column
 * @method     ChildUsuario findOneByIsadmin(boolean $isAdmin) Return the first ChildUsuario filtered by the isAdmin column *

 * @method     ChildUsuario requirePk($key, ConnectionInterface $con = null) Return the ChildUsuario by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOne(ConnectionInterface $con = null) Return the first ChildUsuario matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuario requireOneById(int $id) Return the first ChildUsuario filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByNome(string $nome) Return the first ChildUsuario filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByEmail(string $email) Return the first ChildUsuario filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByTelefone(string $telefone) Return the first ChildUsuario filtered by the telefone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByUsario(string $usario) Return the first ChildUsuario filtered by the usario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneBySenha(string $senha) Return the first ChildUsuario filtered by the senha column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByIsadmin(boolean $isAdmin) Return the first ChildUsuario filtered by the isAdmin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuario[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsuario objects based on current ModelCriteria
 * @method     ChildUsuario[]|ObjectCollection findById(int $id) Return ChildUsuario objects filtered by the id column
 * @method     ChildUsuario[]|ObjectCollection findByNome(string $nome) Return ChildUsuario objects filtered by the nome column
 * @method     ChildUsuario[]|ObjectCollection findByEmail(string $email) Return ChildUsuario objects filtered by the email column
 * @method     ChildUsuario[]|ObjectCollection findByTelefone(string $telefone) Return ChildUsuario objects filtered by the telefone column
 * @method     ChildUsuario[]|ObjectCollection findByUsario(string $usario) Return ChildUsuario objects filtered by the usario column
 * @method     ChildUsuario[]|ObjectCollection findBySenha(string $senha) Return ChildUsuario objects filtered by the senha column
 * @method     ChildUsuario[]|ObjectCollection findByIsadmin(boolean $isAdmin) Return ChildUsuario objects filtered by the isAdmin column
 * @method     ChildUsuario[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsuarioQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \WEB\Base\UsuarioQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\WEB\\Usuario', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsuarioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsuarioQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsuarioQuery) {
            return $criteria;
        }
        $query = new ChildUsuarioQuery();
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
     * @return ChildUsuario|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsuarioTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsuario A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, email, telefone, usario, senha, isAdmin FROM USUARIO WHERE id = :p0';
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
            /** @var ChildUsuario $obj */
            $obj = new ChildUsuario();
            $obj->hydrate($row);
            UsuarioTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsuario|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsuarioTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsuarioTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsuarioTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsuarioTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the nome column
     *
     * Example usage:
     * <code>
     * $query->filterByNome('fooValue');   // WHERE nome = 'fooValue'
     * $query->filterByNome('%fooValue%', Criteria::LIKE); // WHERE nome LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nome The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByNome($nome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the telefone column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefone('fooValue');   // WHERE telefone = 'fooValue'
     * $query->filterByTelefone('%fooValue%', Criteria::LIKE); // WHERE telefone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByTelefone($telefone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_TELEFONE, $telefone, $comparison);
    }

    /**
     * Filter the query on the usario column
     *
     * Example usage:
     * <code>
     * $query->filterByUsario('fooValue');   // WHERE usario = 'fooValue'
     * $query->filterByUsario('%fooValue%', Criteria::LIKE); // WHERE usario LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usario The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByUsario($usario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usario)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_USARIO, $usario, $comparison);
    }

    /**
     * Filter the query on the senha column
     *
     * Example usage:
     * <code>
     * $query->filterBySenha('fooValue');   // WHERE senha = 'fooValue'
     * $query->filterBySenha('%fooValue%', Criteria::LIKE); // WHERE senha LIKE '%fooValue%'
     * </code>
     *
     * @param     string $senha The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterBySenha($senha = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($senha)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_SENHA, $senha, $comparison);
    }

    /**
     * Filter the query on the isAdmin column
     *
     * Example usage:
     * <code>
     * $query->filterByIsadmin(true); // WHERE isAdmin = true
     * $query->filterByIsadmin('yes'); // WHERE isAdmin = true
     * </code>
     *
     * @param     boolean|string $isadmin The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByIsadmin($isadmin = null, $comparison = null)
    {
        if (is_string($isadmin)) {
            $isadmin = in_array(strtolower($isadmin), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_ISADMIN, $isadmin, $comparison);
    }

    /**
     * Filter the query by a related \WEB\PedidoSuporte object
     *
     * @param \WEB\PedidoSuporte|ObjectCollection $pedidoSuporte the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPedidoSuporteRelatedByIdusuarioCriador($pedidoSuporte, $comparison = null)
    {
        if ($pedidoSuporte instanceof \WEB\PedidoSuporte) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_ID, $pedidoSuporte->getIdusuarioCriador(), $comparison);
        } elseif ($pedidoSuporte instanceof ObjectCollection) {
            return $this
                ->usePedidoSuporteRelatedByIdusuarioCriadorQuery()
                ->filterByPrimaryKeys($pedidoSuporte->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPedidoSuporteRelatedByIdusuarioCriador() only accepts arguments of type \WEB\PedidoSuporte or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PedidoSuporteRelatedByIdusuarioCriador relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinPedidoSuporteRelatedByIdusuarioCriador($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PedidoSuporteRelatedByIdusuarioCriador');

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
            $this->addJoinObject($join, 'PedidoSuporteRelatedByIdusuarioCriador');
        }

        return $this;
    }

    /**
     * Use the PedidoSuporteRelatedByIdusuarioCriador relation PedidoSuporte object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \WEB\PedidoSuporteQuery A secondary query class using the current class as primary query
     */
    public function usePedidoSuporteRelatedByIdusuarioCriadorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPedidoSuporteRelatedByIdusuarioCriador($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PedidoSuporteRelatedByIdusuarioCriador', '\WEB\PedidoSuporteQuery');
    }

    /**
     * Filter the query by a related \WEB\PedidoSuporte object
     *
     * @param \WEB\PedidoSuporte|ObjectCollection $pedidoSuporte the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPedidoSuporteRelatedByIdusuarioExecutor($pedidoSuporte, $comparison = null)
    {
        if ($pedidoSuporte instanceof \WEB\PedidoSuporte) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_ID, $pedidoSuporte->getIdusuarioExecutor(), $comparison);
        } elseif ($pedidoSuporte instanceof ObjectCollection) {
            return $this
                ->usePedidoSuporteRelatedByIdusuarioExecutorQuery()
                ->filterByPrimaryKeys($pedidoSuporte->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPedidoSuporteRelatedByIdusuarioExecutor() only accepts arguments of type \WEB\PedidoSuporte or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PedidoSuporteRelatedByIdusuarioExecutor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinPedidoSuporteRelatedByIdusuarioExecutor($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PedidoSuporteRelatedByIdusuarioExecutor');

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
            $this->addJoinObject($join, 'PedidoSuporteRelatedByIdusuarioExecutor');
        }

        return $this;
    }

    /**
     * Use the PedidoSuporteRelatedByIdusuarioExecutor relation PedidoSuporte object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \WEB\PedidoSuporteQuery A secondary query class using the current class as primary query
     */
    public function usePedidoSuporteRelatedByIdusuarioExecutorQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPedidoSuporteRelatedByIdusuarioExecutor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PedidoSuporteRelatedByIdusuarioExecutor', '\WEB\PedidoSuporteQuery');
    }

    /**
     * Filter the query by a related \WEB\Mensagens object
     *
     * @param \WEB\Mensagens|ObjectCollection $mensagens the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByMensagens($mensagens, $comparison = null)
    {
        if ($mensagens instanceof \WEB\Mensagens) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_ID, $mensagens->getIdusuarioCriador(), $comparison);
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
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
     * @param   ChildUsuario $usuario Object to remove from the list of results
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function prune($usuario = null)
    {
        if ($usuario) {
            $this->addUsingAlias(UsuarioTableMap::COL_ID, $usuario->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the USUARIO table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsuarioTableMap::clearInstancePool();
            UsuarioTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsuarioTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsuarioTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsuarioTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsuarioQuery
