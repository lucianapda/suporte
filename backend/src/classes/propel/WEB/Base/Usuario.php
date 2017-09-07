<?php

namespace WEB\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use WEB\Mensagens as ChildMensagens;
use WEB\MensagensQuery as ChildMensagensQuery;
use WEB\PedidoSuporte as ChildPedidoSuporte;
use WEB\PedidoSuporteQuery as ChildPedidoSuporteQuery;
use WEB\Usuario as ChildUsuario;
use WEB\UsuarioQuery as ChildUsuarioQuery;
use WEB\Map\MensagensTableMap;
use WEB\Map\PedidoSuporteTableMap;
use WEB\Map\UsuarioTableMap;

/**
 * Base class that represents a row from the 'USUARIO' table.
 *
 *
 *
 * @package    propel.generator.WEB.Base
 */
abstract class Usuario implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\WEB\\Map\\UsuarioTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the nome field.
     *
     * @var        string
     */
    protected $nome;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the telefone field.
     *
     * @var        string
     */
    protected $telefone;

    /**
     * The value for the usario field.
     *
     * @var        string
     */
    protected $usario;

    /**
     * The value for the senha field.
     *
     * @var        string
     */
    protected $senha;

    /**
     * The value for the isadmin field.
     *
     * @var        boolean
     */
    protected $isadmin;

    /**
     * @var        ObjectCollection|ChildPedidoSuporte[] Collection to store aggregation of ChildPedidoSuporte objects.
     */
    protected $collPedidoSuportesRelatedByIdusuarioCriador;
    protected $collPedidoSuportesRelatedByIdusuarioCriadorPartial;

    /**
     * @var        ObjectCollection|ChildPedidoSuporte[] Collection to store aggregation of ChildPedidoSuporte objects.
     */
    protected $collPedidoSuportesRelatedByIdusuarioExecutor;
    protected $collPedidoSuportesRelatedByIdusuarioExecutorPartial;

    /**
     * @var        ObjectCollection|ChildMensagens[] Collection to store aggregation of ChildMensagens objects.
     */
    protected $collMensagenss;
    protected $collMensagenssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPedidoSuporte[]
     */
    protected $pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPedidoSuporte[]
     */
    protected $pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMensagens[]
     */
    protected $mensagenssScheduledForDeletion = null;

    /**
     * Initializes internal state of WEB\Base\Usuario object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Usuario</code> instance.  If
     * <code>obj</code> is an instance of <code>Usuario</code>, delegates to
     * <code>equals(Usuario)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Usuario The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [nome] column value.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [telefone] column value.
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Get the [usario] column value.
     *
     * @return string
     */
    public function getUsario()
    {
        return $this->usario;
    }

    /**
     * Get the [senha] column value.
     *
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Get the [isadmin] column value.
     *
     * @return boolean
     */
    public function getIsadmin()
    {
        return $this->isadmin;
    }

    /**
     * Get the [isadmin] column value.
     *
     * @return boolean
     */
    public function isIsadmin()
    {
        return $this->getIsadmin();
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\WEB\Usuario The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [nome] column.
     *
     * @param string $v new value
     * @return $this|\WEB\Usuario The current object (for fluent API support)
     */
    public function setNome($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nome !== $v) {
            $this->nome = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_NOME] = true;
        }

        return $this;
    } // setNome()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\WEB\Usuario The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [telefone] column.
     *
     * @param string $v new value
     * @return $this|\WEB\Usuario The current object (for fluent API support)
     */
    public function setTelefone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telefone !== $v) {
            $this->telefone = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_TELEFONE] = true;
        }

        return $this;
    } // setTelefone()

    /**
     * Set the value of [usario] column.
     *
     * @param string $v new value
     * @return $this|\WEB\Usuario The current object (for fluent API support)
     */
    public function setUsario($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usario !== $v) {
            $this->usario = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_USARIO] = true;
        }

        return $this;
    } // setUsario()

    /**
     * Set the value of [senha] column.
     *
     * @param string $v new value
     * @return $this|\WEB\Usuario The current object (for fluent API support)
     */
    public function setSenha($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->senha !== $v) {
            $this->senha = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_SENHA] = true;
        }

        return $this;
    } // setSenha()

    /**
     * Sets the value of the [isadmin] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\WEB\Usuario The current object (for fluent API support)
     */
    public function setIsadmin($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->isadmin !== $v) {
            $this->isadmin = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_ISADMIN] = true;
        }

        return $this;
    } // setIsadmin()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsuarioTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsuarioTableMap::translateFieldName('Nome', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nome = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsuarioTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsuarioTableMap::translateFieldName('Telefone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsuarioTableMap::translateFieldName('Usario', TableMap::TYPE_PHPNAME, $indexType)];
            $this->usario = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsuarioTableMap::translateFieldName('Senha', TableMap::TYPE_PHPNAME, $indexType)];
            $this->senha = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsuarioTableMap::translateFieldName('Isadmin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isadmin = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = UsuarioTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\WEB\\Usuario'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsuarioTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsuarioQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPedidoSuportesRelatedByIdusuarioCriador = null;

            $this->collPedidoSuportesRelatedByIdusuarioExecutor = null;

            $this->collMensagenss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Usuario::setDeleted()
     * @see Usuario::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsuarioQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UsuarioTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion !== null) {
                if (!$this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion->isEmpty()) {
                    \WEB\PedidoSuporteQuery::create()
                        ->filterByPrimaryKeys($this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion = null;
                }
            }

            if ($this->collPedidoSuportesRelatedByIdusuarioCriador !== null) {
                foreach ($this->collPedidoSuportesRelatedByIdusuarioCriador as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion !== null) {
                if (!$this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion->isEmpty()) {
                    foreach ($this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion as $pedidoSuporteRelatedByIdusuarioExecutor) {
                        // need to save related object because we set the relation to null
                        $pedidoSuporteRelatedByIdusuarioExecutor->save($con);
                    }
                    $this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion = null;
                }
            }

            if ($this->collPedidoSuportesRelatedByIdusuarioExecutor !== null) {
                foreach ($this->collPedidoSuportesRelatedByIdusuarioExecutor as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->mensagenssScheduledForDeletion !== null) {
                if (!$this->mensagenssScheduledForDeletion->isEmpty()) {
                    \WEB\MensagensQuery::create()
                        ->filterByPrimaryKeys($this->mensagenssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->mensagenssScheduledForDeletion = null;
                }
            }

            if ($this->collMensagenss !== null) {
                foreach ($this->collMensagenss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[UsuarioTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsuarioTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsuarioTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_NOME)) {
            $modifiedColumns[':p' . $index++]  = 'nome';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_TELEFONE)) {
            $modifiedColumns[':p' . $index++]  = 'telefone';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_USARIO)) {
            $modifiedColumns[':p' . $index++]  = 'usario';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_SENHA)) {
            $modifiedColumns[':p' . $index++]  = 'senha';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_ISADMIN)) {
            $modifiedColumns[':p' . $index++]  = 'isAdmin';
        }

        $sql = sprintf(
            'INSERT INTO USUARIO (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'nome':
                        $stmt->bindValue($identifier, $this->nome, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'telefone':
                        $stmt->bindValue($identifier, $this->telefone, PDO::PARAM_STR);
                        break;
                    case 'usario':
                        $stmt->bindValue($identifier, $this->usario, PDO::PARAM_STR);
                        break;
                    case 'senha':
                        $stmt->bindValue($identifier, $this->senha, PDO::PARAM_STR);
                        break;
                    case 'isAdmin':
                        $stmt->bindValue($identifier, (int) $this->isadmin, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsuarioTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getNome();
                break;
            case 2:
                return $this->getEmail();
                break;
            case 3:
                return $this->getTelefone();
                break;
            case 4:
                return $this->getUsario();
                break;
            case 5:
                return $this->getSenha();
                break;
            case 6:
                return $this->getIsadmin();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Usuario'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Usuario'][$this->hashCode()] = true;
        $keys = UsuarioTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNome(),
            $keys[2] => $this->getEmail(),
            $keys[3] => $this->getTelefone(),
            $keys[4] => $this->getUsario(),
            $keys[5] => $this->getSenha(),
            $keys[6] => $this->getIsadmin(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collPedidoSuportesRelatedByIdusuarioCriador) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pedidoSuportes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'PEDIDO_SUPORTEs';
                        break;
                    default:
                        $key = 'PedidoSuportes';
                }

                $result[$key] = $this->collPedidoSuportesRelatedByIdusuarioCriador->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPedidoSuportesRelatedByIdusuarioExecutor) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pedidoSuportes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'PEDIDO_SUPORTEs';
                        break;
                    default:
                        $key = 'PedidoSuportes';
                }

                $result[$key] = $this->collPedidoSuportesRelatedByIdusuarioExecutor->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMensagenss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mensagenss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'MENSAGENSs';
                        break;
                    default:
                        $key = 'Mensagenss';
                }

                $result[$key] = $this->collMensagenss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\WEB\Usuario
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsuarioTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\WEB\Usuario
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setNome($value);
                break;
            case 2:
                $this->setEmail($value);
                break;
            case 3:
                $this->setTelefone($value);
                break;
            case 4:
                $this->setUsario($value);
                break;
            case 5:
                $this->setSenha($value);
                break;
            case 6:
                $this->setIsadmin($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = UsuarioTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNome($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmail($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTelefone($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUsario($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSenha($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIsadmin($arr[$keys[6]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\WEB\Usuario The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UsuarioTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsuarioTableMap::COL_ID)) {
            $criteria->add(UsuarioTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_NOME)) {
            $criteria->add(UsuarioTableMap::COL_NOME, $this->nome);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_EMAIL)) {
            $criteria->add(UsuarioTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_TELEFONE)) {
            $criteria->add(UsuarioTableMap::COL_TELEFONE, $this->telefone);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_USARIO)) {
            $criteria->add(UsuarioTableMap::COL_USARIO, $this->usario);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_SENHA)) {
            $criteria->add(UsuarioTableMap::COL_SENHA, $this->senha);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_ISADMIN)) {
            $criteria->add(UsuarioTableMap::COL_ISADMIN, $this->isadmin);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildUsuarioQuery::create();
        $criteria->add(UsuarioTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \WEB\Usuario (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNome($this->getNome());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setTelefone($this->getTelefone());
        $copyObj->setUsario($this->getUsario());
        $copyObj->setSenha($this->getSenha());
        $copyObj->setIsadmin($this->getIsadmin());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPedidoSuportesRelatedByIdusuarioCriador() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPedidoSuporteRelatedByIdusuarioCriador($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPedidoSuportesRelatedByIdusuarioExecutor() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPedidoSuporteRelatedByIdusuarioExecutor($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMensagenss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMensagens($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \WEB\Usuario Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('PedidoSuporteRelatedByIdusuarioCriador' == $relationName) {
            $this->initPedidoSuportesRelatedByIdusuarioCriador();
            return;
        }
        if ('PedidoSuporteRelatedByIdusuarioExecutor' == $relationName) {
            $this->initPedidoSuportesRelatedByIdusuarioExecutor();
            return;
        }
        if ('Mensagens' == $relationName) {
            $this->initMensagenss();
            return;
        }
    }

    /**
     * Clears out the collPedidoSuportesRelatedByIdusuarioCriador collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPedidoSuportesRelatedByIdusuarioCriador()
     */
    public function clearPedidoSuportesRelatedByIdusuarioCriador()
    {
        $this->collPedidoSuportesRelatedByIdusuarioCriador = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPedidoSuportesRelatedByIdusuarioCriador collection loaded partially.
     */
    public function resetPartialPedidoSuportesRelatedByIdusuarioCriador($v = true)
    {
        $this->collPedidoSuportesRelatedByIdusuarioCriadorPartial = $v;
    }

    /**
     * Initializes the collPedidoSuportesRelatedByIdusuarioCriador collection.
     *
     * By default this just sets the collPedidoSuportesRelatedByIdusuarioCriador collection to an empty array (like clearcollPedidoSuportesRelatedByIdusuarioCriador());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPedidoSuportesRelatedByIdusuarioCriador($overrideExisting = true)
    {
        if (null !== $this->collPedidoSuportesRelatedByIdusuarioCriador && !$overrideExisting) {
            return;
        }

        $collectionClassName = PedidoSuporteTableMap::getTableMap()->getCollectionClassName();

        $this->collPedidoSuportesRelatedByIdusuarioCriador = new $collectionClassName;
        $this->collPedidoSuportesRelatedByIdusuarioCriador->setModel('\WEB\PedidoSuporte');
    }

    /**
     * Gets an array of ChildPedidoSuporte objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPedidoSuporte[] List of ChildPedidoSuporte objects
     * @throws PropelException
     */
    public function getPedidoSuportesRelatedByIdusuarioCriador(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPedidoSuportesRelatedByIdusuarioCriadorPartial && !$this->isNew();
        if (null === $this->collPedidoSuportesRelatedByIdusuarioCriador || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPedidoSuportesRelatedByIdusuarioCriador) {
                // return empty collection
                $this->initPedidoSuportesRelatedByIdusuarioCriador();
            } else {
                $collPedidoSuportesRelatedByIdusuarioCriador = ChildPedidoSuporteQuery::create(null, $criteria)
                    ->filterByUsuarioRelatedByIdusuarioCriador($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPedidoSuportesRelatedByIdusuarioCriadorPartial && count($collPedidoSuportesRelatedByIdusuarioCriador)) {
                        $this->initPedidoSuportesRelatedByIdusuarioCriador(false);

                        foreach ($collPedidoSuportesRelatedByIdusuarioCriador as $obj) {
                            if (false == $this->collPedidoSuportesRelatedByIdusuarioCriador->contains($obj)) {
                                $this->collPedidoSuportesRelatedByIdusuarioCriador->append($obj);
                            }
                        }

                        $this->collPedidoSuportesRelatedByIdusuarioCriadorPartial = true;
                    }

                    return $collPedidoSuportesRelatedByIdusuarioCriador;
                }

                if ($partial && $this->collPedidoSuportesRelatedByIdusuarioCriador) {
                    foreach ($this->collPedidoSuportesRelatedByIdusuarioCriador as $obj) {
                        if ($obj->isNew()) {
                            $collPedidoSuportesRelatedByIdusuarioCriador[] = $obj;
                        }
                    }
                }

                $this->collPedidoSuportesRelatedByIdusuarioCriador = $collPedidoSuportesRelatedByIdusuarioCriador;
                $this->collPedidoSuportesRelatedByIdusuarioCriadorPartial = false;
            }
        }

        return $this->collPedidoSuportesRelatedByIdusuarioCriador;
    }

    /**
     * Sets a collection of ChildPedidoSuporte objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pedidoSuportesRelatedByIdusuarioCriador A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setPedidoSuportesRelatedByIdusuarioCriador(Collection $pedidoSuportesRelatedByIdusuarioCriador, ConnectionInterface $con = null)
    {
        /** @var ChildPedidoSuporte[] $pedidoSuportesRelatedByIdusuarioCriadorToDelete */
        $pedidoSuportesRelatedByIdusuarioCriadorToDelete = $this->getPedidoSuportesRelatedByIdusuarioCriador(new Criteria(), $con)->diff($pedidoSuportesRelatedByIdusuarioCriador);


        $this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion = $pedidoSuportesRelatedByIdusuarioCriadorToDelete;

        foreach ($pedidoSuportesRelatedByIdusuarioCriadorToDelete as $pedidoSuporteRelatedByIdusuarioCriadorRemoved) {
            $pedidoSuporteRelatedByIdusuarioCriadorRemoved->setUsuarioRelatedByIdusuarioCriador(null);
        }

        $this->collPedidoSuportesRelatedByIdusuarioCriador = null;
        foreach ($pedidoSuportesRelatedByIdusuarioCriador as $pedidoSuporteRelatedByIdusuarioCriador) {
            $this->addPedidoSuporteRelatedByIdusuarioCriador($pedidoSuporteRelatedByIdusuarioCriador);
        }

        $this->collPedidoSuportesRelatedByIdusuarioCriador = $pedidoSuportesRelatedByIdusuarioCriador;
        $this->collPedidoSuportesRelatedByIdusuarioCriadorPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PedidoSuporte objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PedidoSuporte objects.
     * @throws PropelException
     */
    public function countPedidoSuportesRelatedByIdusuarioCriador(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPedidoSuportesRelatedByIdusuarioCriadorPartial && !$this->isNew();
        if (null === $this->collPedidoSuportesRelatedByIdusuarioCriador || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPedidoSuportesRelatedByIdusuarioCriador) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPedidoSuportesRelatedByIdusuarioCriador());
            }

            $query = ChildPedidoSuporteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuarioRelatedByIdusuarioCriador($this)
                ->count($con);
        }

        return count($this->collPedidoSuportesRelatedByIdusuarioCriador);
    }

    /**
     * Method called to associate a ChildPedidoSuporte object to this object
     * through the ChildPedidoSuporte foreign key attribute.
     *
     * @param  ChildPedidoSuporte $l ChildPedidoSuporte
     * @return $this|\WEB\Usuario The current object (for fluent API support)
     */
    public function addPedidoSuporteRelatedByIdusuarioCriador(ChildPedidoSuporte $l)
    {
        if ($this->collPedidoSuportesRelatedByIdusuarioCriador === null) {
            $this->initPedidoSuportesRelatedByIdusuarioCriador();
            $this->collPedidoSuportesRelatedByIdusuarioCriadorPartial = true;
        }

        if (!$this->collPedidoSuportesRelatedByIdusuarioCriador->contains($l)) {
            $this->doAddPedidoSuporteRelatedByIdusuarioCriador($l);

            if ($this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion and $this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion->contains($l)) {
                $this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion->remove($this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPedidoSuporte $pedidoSuporteRelatedByIdusuarioCriador The ChildPedidoSuporte object to add.
     */
    protected function doAddPedidoSuporteRelatedByIdusuarioCriador(ChildPedidoSuporte $pedidoSuporteRelatedByIdusuarioCriador)
    {
        $this->collPedidoSuportesRelatedByIdusuarioCriador[]= $pedidoSuporteRelatedByIdusuarioCriador;
        $pedidoSuporteRelatedByIdusuarioCriador->setUsuarioRelatedByIdusuarioCriador($this);
    }

    /**
     * @param  ChildPedidoSuporte $pedidoSuporteRelatedByIdusuarioCriador The ChildPedidoSuporte object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function removePedidoSuporteRelatedByIdusuarioCriador(ChildPedidoSuporte $pedidoSuporteRelatedByIdusuarioCriador)
    {
        if ($this->getPedidoSuportesRelatedByIdusuarioCriador()->contains($pedidoSuporteRelatedByIdusuarioCriador)) {
            $pos = $this->collPedidoSuportesRelatedByIdusuarioCriador->search($pedidoSuporteRelatedByIdusuarioCriador);
            $this->collPedidoSuportesRelatedByIdusuarioCriador->remove($pos);
            if (null === $this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion) {
                $this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion = clone $this->collPedidoSuportesRelatedByIdusuarioCriador;
                $this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion->clear();
            }
            $this->pedidoSuportesRelatedByIdusuarioCriadorScheduledForDeletion[]= clone $pedidoSuporteRelatedByIdusuarioCriador;
            $pedidoSuporteRelatedByIdusuarioCriador->setUsuarioRelatedByIdusuarioCriador(null);
        }

        return $this;
    }

    /**
     * Clears out the collPedidoSuportesRelatedByIdusuarioExecutor collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPedidoSuportesRelatedByIdusuarioExecutor()
     */
    public function clearPedidoSuportesRelatedByIdusuarioExecutor()
    {
        $this->collPedidoSuportesRelatedByIdusuarioExecutor = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPedidoSuportesRelatedByIdusuarioExecutor collection loaded partially.
     */
    public function resetPartialPedidoSuportesRelatedByIdusuarioExecutor($v = true)
    {
        $this->collPedidoSuportesRelatedByIdusuarioExecutorPartial = $v;
    }

    /**
     * Initializes the collPedidoSuportesRelatedByIdusuarioExecutor collection.
     *
     * By default this just sets the collPedidoSuportesRelatedByIdusuarioExecutor collection to an empty array (like clearcollPedidoSuportesRelatedByIdusuarioExecutor());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPedidoSuportesRelatedByIdusuarioExecutor($overrideExisting = true)
    {
        if (null !== $this->collPedidoSuportesRelatedByIdusuarioExecutor && !$overrideExisting) {
            return;
        }

        $collectionClassName = PedidoSuporteTableMap::getTableMap()->getCollectionClassName();

        $this->collPedidoSuportesRelatedByIdusuarioExecutor = new $collectionClassName;
        $this->collPedidoSuportesRelatedByIdusuarioExecutor->setModel('\WEB\PedidoSuporte');
    }

    /**
     * Gets an array of ChildPedidoSuporte objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPedidoSuporte[] List of ChildPedidoSuporte objects
     * @throws PropelException
     */
    public function getPedidoSuportesRelatedByIdusuarioExecutor(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPedidoSuportesRelatedByIdusuarioExecutorPartial && !$this->isNew();
        if (null === $this->collPedidoSuportesRelatedByIdusuarioExecutor || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPedidoSuportesRelatedByIdusuarioExecutor) {
                // return empty collection
                $this->initPedidoSuportesRelatedByIdusuarioExecutor();
            } else {
                $collPedidoSuportesRelatedByIdusuarioExecutor = ChildPedidoSuporteQuery::create(null, $criteria)
                    ->filterByUsuarioRelatedByIdusuarioExecutor($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPedidoSuportesRelatedByIdusuarioExecutorPartial && count($collPedidoSuportesRelatedByIdusuarioExecutor)) {
                        $this->initPedidoSuportesRelatedByIdusuarioExecutor(false);

                        foreach ($collPedidoSuportesRelatedByIdusuarioExecutor as $obj) {
                            if (false == $this->collPedidoSuportesRelatedByIdusuarioExecutor->contains($obj)) {
                                $this->collPedidoSuportesRelatedByIdusuarioExecutor->append($obj);
                            }
                        }

                        $this->collPedidoSuportesRelatedByIdusuarioExecutorPartial = true;
                    }

                    return $collPedidoSuportesRelatedByIdusuarioExecutor;
                }

                if ($partial && $this->collPedidoSuportesRelatedByIdusuarioExecutor) {
                    foreach ($this->collPedidoSuportesRelatedByIdusuarioExecutor as $obj) {
                        if ($obj->isNew()) {
                            $collPedidoSuportesRelatedByIdusuarioExecutor[] = $obj;
                        }
                    }
                }

                $this->collPedidoSuportesRelatedByIdusuarioExecutor = $collPedidoSuportesRelatedByIdusuarioExecutor;
                $this->collPedidoSuportesRelatedByIdusuarioExecutorPartial = false;
            }
        }

        return $this->collPedidoSuportesRelatedByIdusuarioExecutor;
    }

    /**
     * Sets a collection of ChildPedidoSuporte objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pedidoSuportesRelatedByIdusuarioExecutor A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setPedidoSuportesRelatedByIdusuarioExecutor(Collection $pedidoSuportesRelatedByIdusuarioExecutor, ConnectionInterface $con = null)
    {
        /** @var ChildPedidoSuporte[] $pedidoSuportesRelatedByIdusuarioExecutorToDelete */
        $pedidoSuportesRelatedByIdusuarioExecutorToDelete = $this->getPedidoSuportesRelatedByIdusuarioExecutor(new Criteria(), $con)->diff($pedidoSuportesRelatedByIdusuarioExecutor);


        $this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion = $pedidoSuportesRelatedByIdusuarioExecutorToDelete;

        foreach ($pedidoSuportesRelatedByIdusuarioExecutorToDelete as $pedidoSuporteRelatedByIdusuarioExecutorRemoved) {
            $pedidoSuporteRelatedByIdusuarioExecutorRemoved->setUsuarioRelatedByIdusuarioExecutor(null);
        }

        $this->collPedidoSuportesRelatedByIdusuarioExecutor = null;
        foreach ($pedidoSuportesRelatedByIdusuarioExecutor as $pedidoSuporteRelatedByIdusuarioExecutor) {
            $this->addPedidoSuporteRelatedByIdusuarioExecutor($pedidoSuporteRelatedByIdusuarioExecutor);
        }

        $this->collPedidoSuportesRelatedByIdusuarioExecutor = $pedidoSuportesRelatedByIdusuarioExecutor;
        $this->collPedidoSuportesRelatedByIdusuarioExecutorPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PedidoSuporte objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PedidoSuporte objects.
     * @throws PropelException
     */
    public function countPedidoSuportesRelatedByIdusuarioExecutor(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPedidoSuportesRelatedByIdusuarioExecutorPartial && !$this->isNew();
        if (null === $this->collPedidoSuportesRelatedByIdusuarioExecutor || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPedidoSuportesRelatedByIdusuarioExecutor) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPedidoSuportesRelatedByIdusuarioExecutor());
            }

            $query = ChildPedidoSuporteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuarioRelatedByIdusuarioExecutor($this)
                ->count($con);
        }

        return count($this->collPedidoSuportesRelatedByIdusuarioExecutor);
    }

    /**
     * Method called to associate a ChildPedidoSuporte object to this object
     * through the ChildPedidoSuporte foreign key attribute.
     *
     * @param  ChildPedidoSuporte $l ChildPedidoSuporte
     * @return $this|\WEB\Usuario The current object (for fluent API support)
     */
    public function addPedidoSuporteRelatedByIdusuarioExecutor(ChildPedidoSuporte $l)
    {
        if ($this->collPedidoSuportesRelatedByIdusuarioExecutor === null) {
            $this->initPedidoSuportesRelatedByIdusuarioExecutor();
            $this->collPedidoSuportesRelatedByIdusuarioExecutorPartial = true;
        }

        if (!$this->collPedidoSuportesRelatedByIdusuarioExecutor->contains($l)) {
            $this->doAddPedidoSuporteRelatedByIdusuarioExecutor($l);

            if ($this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion and $this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion->contains($l)) {
                $this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion->remove($this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPedidoSuporte $pedidoSuporteRelatedByIdusuarioExecutor The ChildPedidoSuporte object to add.
     */
    protected function doAddPedidoSuporteRelatedByIdusuarioExecutor(ChildPedidoSuporte $pedidoSuporteRelatedByIdusuarioExecutor)
    {
        $this->collPedidoSuportesRelatedByIdusuarioExecutor[]= $pedidoSuporteRelatedByIdusuarioExecutor;
        $pedidoSuporteRelatedByIdusuarioExecutor->setUsuarioRelatedByIdusuarioExecutor($this);
    }

    /**
     * @param  ChildPedidoSuporte $pedidoSuporteRelatedByIdusuarioExecutor The ChildPedidoSuporte object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function removePedidoSuporteRelatedByIdusuarioExecutor(ChildPedidoSuporte $pedidoSuporteRelatedByIdusuarioExecutor)
    {
        if ($this->getPedidoSuportesRelatedByIdusuarioExecutor()->contains($pedidoSuporteRelatedByIdusuarioExecutor)) {
            $pos = $this->collPedidoSuportesRelatedByIdusuarioExecutor->search($pedidoSuporteRelatedByIdusuarioExecutor);
            $this->collPedidoSuportesRelatedByIdusuarioExecutor->remove($pos);
            if (null === $this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion) {
                $this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion = clone $this->collPedidoSuportesRelatedByIdusuarioExecutor;
                $this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion->clear();
            }
            $this->pedidoSuportesRelatedByIdusuarioExecutorScheduledForDeletion[]= $pedidoSuporteRelatedByIdusuarioExecutor;
            $pedidoSuporteRelatedByIdusuarioExecutor->setUsuarioRelatedByIdusuarioExecutor(null);
        }

        return $this;
    }

    /**
     * Clears out the collMensagenss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMensagenss()
     */
    public function clearMensagenss()
    {
        $this->collMensagenss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMensagenss collection loaded partially.
     */
    public function resetPartialMensagenss($v = true)
    {
        $this->collMensagenssPartial = $v;
    }

    /**
     * Initializes the collMensagenss collection.
     *
     * By default this just sets the collMensagenss collection to an empty array (like clearcollMensagenss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMensagenss($overrideExisting = true)
    {
        if (null !== $this->collMensagenss && !$overrideExisting) {
            return;
        }

        $collectionClassName = MensagensTableMap::getTableMap()->getCollectionClassName();

        $this->collMensagenss = new $collectionClassName;
        $this->collMensagenss->setModel('\WEB\Mensagens');
    }

    /**
     * Gets an array of ChildMensagens objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMensagens[] List of ChildMensagens objects
     * @throws PropelException
     */
    public function getMensagenss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMensagenssPartial && !$this->isNew();
        if (null === $this->collMensagenss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMensagenss) {
                // return empty collection
                $this->initMensagenss();
            } else {
                $collMensagenss = ChildMensagensQuery::create(null, $criteria)
                    ->filterByUsuario($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMensagenssPartial && count($collMensagenss)) {
                        $this->initMensagenss(false);

                        foreach ($collMensagenss as $obj) {
                            if (false == $this->collMensagenss->contains($obj)) {
                                $this->collMensagenss->append($obj);
                            }
                        }

                        $this->collMensagenssPartial = true;
                    }

                    return $collMensagenss;
                }

                if ($partial && $this->collMensagenss) {
                    foreach ($this->collMensagenss as $obj) {
                        if ($obj->isNew()) {
                            $collMensagenss[] = $obj;
                        }
                    }
                }

                $this->collMensagenss = $collMensagenss;
                $this->collMensagenssPartial = false;
            }
        }

        return $this->collMensagenss;
    }

    /**
     * Sets a collection of ChildMensagens objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $mensagenss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setMensagenss(Collection $mensagenss, ConnectionInterface $con = null)
    {
        /** @var ChildMensagens[] $mensagenssToDelete */
        $mensagenssToDelete = $this->getMensagenss(new Criteria(), $con)->diff($mensagenss);


        $this->mensagenssScheduledForDeletion = $mensagenssToDelete;

        foreach ($mensagenssToDelete as $mensagensRemoved) {
            $mensagensRemoved->setUsuario(null);
        }

        $this->collMensagenss = null;
        foreach ($mensagenss as $mensagens) {
            $this->addMensagens($mensagens);
        }

        $this->collMensagenss = $mensagenss;
        $this->collMensagenssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Mensagens objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Mensagens objects.
     * @throws PropelException
     */
    public function countMensagenss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMensagenssPartial && !$this->isNew();
        if (null === $this->collMensagenss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMensagenss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMensagenss());
            }

            $query = ChildMensagensQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collMensagenss);
    }

    /**
     * Method called to associate a ChildMensagens object to this object
     * through the ChildMensagens foreign key attribute.
     *
     * @param  ChildMensagens $l ChildMensagens
     * @return $this|\WEB\Usuario The current object (for fluent API support)
     */
    public function addMensagens(ChildMensagens $l)
    {
        if ($this->collMensagenss === null) {
            $this->initMensagenss();
            $this->collMensagenssPartial = true;
        }

        if (!$this->collMensagenss->contains($l)) {
            $this->doAddMensagens($l);

            if ($this->mensagenssScheduledForDeletion and $this->mensagenssScheduledForDeletion->contains($l)) {
                $this->mensagenssScheduledForDeletion->remove($this->mensagenssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMensagens $mensagens The ChildMensagens object to add.
     */
    protected function doAddMensagens(ChildMensagens $mensagens)
    {
        $this->collMensagenss[]= $mensagens;
        $mensagens->setUsuario($this);
    }

    /**
     * @param  ChildMensagens $mensagens The ChildMensagens object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function removeMensagens(ChildMensagens $mensagens)
    {
        if ($this->getMensagenss()->contains($mensagens)) {
            $pos = $this->collMensagenss->search($mensagens);
            $this->collMensagenss->remove($pos);
            if (null === $this->mensagenssScheduledForDeletion) {
                $this->mensagenssScheduledForDeletion = clone $this->collMensagenss;
                $this->mensagenssScheduledForDeletion->clear();
            }
            $this->mensagenssScheduledForDeletion[]= clone $mensagens;
            $mensagens->setUsuario(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related Mensagenss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMensagens[] List of ChildMensagens objects
     */
    public function getMensagenssJoinPedidoSuporte(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMensagensQuery::create(null, $criteria);
        $query->joinWith('PedidoSuporte', $joinBehavior);

        return $this->getMensagenss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->nome = null;
        $this->email = null;
        $this->telefone = null;
        $this->usario = null;
        $this->senha = null;
        $this->isadmin = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collPedidoSuportesRelatedByIdusuarioCriador) {
                foreach ($this->collPedidoSuportesRelatedByIdusuarioCriador as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPedidoSuportesRelatedByIdusuarioExecutor) {
                foreach ($this->collPedidoSuportesRelatedByIdusuarioExecutor as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMensagenss) {
                foreach ($this->collMensagenss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPedidoSuportesRelatedByIdusuarioCriador = null;
        $this->collPedidoSuportesRelatedByIdusuarioExecutor = null;
        $this->collMensagenss = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsuarioTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
