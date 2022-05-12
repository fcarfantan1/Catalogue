<?php

namespace Catalogue\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use Catalogue\Model\CataloguePdfConfig as ChildCataloguePdfConfig;
use Catalogue\Model\CataloguePdfConfigI18n as ChildCataloguePdfConfigI18n;
use Catalogue\Model\CataloguePdfConfigI18nQuery as ChildCataloguePdfConfigI18nQuery;
use Catalogue\Model\CataloguePdfConfigQuery as ChildCataloguePdfConfigQuery;
use Catalogue\Model\Map\CataloguePdfConfigTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

abstract class CataloguePdfConfig implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Catalogue\\Model\\Map\\CataloguePdfConfigTableMap';


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
     * @var        int
     */
    protected $id;

    /**
     * The value for the file field.
     * @var        string
     */
    protected $file;

    /**
     * The value for the url field.
     * @var        string
     */
    protected $url;

    /**
     * The value for the responsable_nom field.
     * @var        string
     */
    protected $responsable_nom;

    /**
     * The value for the responsable_prenom field.
     * @var        string
     */
    protected $responsable_prenom;

    /**
     * The value for the tel_fixe field.
     * @var        string
     */
    protected $tel_fixe;

    /**
     * The value for the tel_mobile field.
     * @var        string
     */
    protected $tel_mobile;

    /**
     * The value for the adresse_voie_numero field.
     * @var        string
     */
    protected $adresse_voie_numero;

    /**
     * The value for the adresse_codepostal field.
     * @var        string
     */
    protected $adresse_codepostal;

    /**
     * The value for the adresse_commune field.
     * @var        string
     */
    protected $adresse_commune;

    /**
     * The value for the siret field.
     * @var        string
     */
    protected $siret;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        ObjectCollection|ChildCataloguePdfConfigI18n[] Collection to store aggregation of ChildCataloguePdfConfigI18n objects.
     */
    protected $collCataloguePdfConfigI18ns;
    protected $collCataloguePdfConfigI18nsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'en_US';

    /**
     * Current translation objects
     * @var        array[ChildCataloguePdfConfigI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $cataloguePdfConfigI18nsScheduledForDeletion = null;

    /**
     * Initializes internal state of Catalogue\Model\Base\CataloguePdfConfig object.
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
        $this->new = (Boolean) $b;
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
        $this->deleted = (Boolean) $b;
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
     * Compares this with another <code>CataloguePdfConfig</code> instance.  If
     * <code>obj</code> is an instance of <code>CataloguePdfConfig</code>, delegates to
     * <code>equals(CataloguePdfConfig)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        $thisclazz = get_class($this);
        if (!is_object($obj) || !($obj instanceof $thisclazz)) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey()
            || null === $obj->getPrimaryKey())  {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        if (null !== $this->getPrimaryKey()) {
            return crc32(serialize($this->getPrimaryKey()));
        }

        return crc32(serialize(clone $this));
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
     * @return CataloguePdfConfig The current object, for fluid interface
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
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     *
     * @return CataloguePdfConfig The current object, for fluid interface
     */
    public function importFrom($parser, $data)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), TableMap::TYPE_PHPNAME);

        return $this;
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

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     *
     * @return   int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [file] column value.
     *
     * @return   string
     */
    public function getFile()
    {

        return $this->file;
    }

    /**
     * Get the [url] column value.
     *
     * @return   string
     */
    public function getUrl()
    {

        return $this->url;
    }

    /**
     * Get the [responsable_nom] column value.
     *
     * @return   string
     */
    public function getResponsableNom()
    {

        return $this->responsable_nom;
    }

    /**
     * Get the [responsable_prenom] column value.
     *
     * @return   string
     */
    public function getResponsablePrenom()
    {

        return $this->responsable_prenom;
    }

    /**
     * Get the [tel_fixe] column value.
     *
     * @return   string
     */
    public function getTelFixe()
    {

        return $this->tel_fixe;
    }

    /**
     * Get the [tel_mobile] column value.
     *
     * @return   string
     */
    public function getTelMobile()
    {

        return $this->tel_mobile;
    }

    /**
     * Get the [adresse_voie_numero] column value.
     *
     * @return   string
     */
    public function getAdresseVoieNumero()
    {

        return $this->adresse_voie_numero;
    }

    /**
     * Get the [adresse_codepostal] column value.
     *
     * @return   string
     */
    public function getAdresseCodepostal()
    {

        return $this->adresse_codepostal;
    }

    /**
     * Get the [adresse_commune] column value.
     *
     * @return   string
     */
    public function getAdresseCommune()
    {

        return $this->adresse_commune;
    }

    /**
     * Get the [siret] column value.
     *
     * @return   string
     */
    public function getSiret()
    {

        return $this->siret;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTime ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTime ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param      int $v new value
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[CataloguePdfConfigTableMap::ID] = true;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [file] column.
     *
     * @param      string $v new value
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setFile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file !== $v) {
            $this->file = $v;
            $this->modifiedColumns[CataloguePdfConfigTableMap::FILE] = true;
        }


        return $this;
    } // setFile()

    /**
     * Set the value of [url] column.
     *
     * @param      string $v new value
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->url !== $v) {
            $this->url = $v;
            $this->modifiedColumns[CataloguePdfConfigTableMap::URL] = true;
        }


        return $this;
    } // setUrl()

    /**
     * Set the value of [responsable_nom] column.
     *
     * @param      string $v new value
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setResponsableNom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->responsable_nom !== $v) {
            $this->responsable_nom = $v;
            $this->modifiedColumns[CataloguePdfConfigTableMap::RESPONSABLE_NOM] = true;
        }


        return $this;
    } // setResponsableNom()

    /**
     * Set the value of [responsable_prenom] column.
     *
     * @param      string $v new value
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setResponsablePrenom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->responsable_prenom !== $v) {
            $this->responsable_prenom = $v;
            $this->modifiedColumns[CataloguePdfConfigTableMap::RESPONSABLE_PRENOM] = true;
        }


        return $this;
    } // setResponsablePrenom()

    /**
     * Set the value of [tel_fixe] column.
     *
     * @param      string $v new value
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setTelFixe($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tel_fixe !== $v) {
            $this->tel_fixe = $v;
            $this->modifiedColumns[CataloguePdfConfigTableMap::TEL_FIXE] = true;
        }


        return $this;
    } // setTelFixe()

    /**
     * Set the value of [tel_mobile] column.
     *
     * @param      string $v new value
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setTelMobile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tel_mobile !== $v) {
            $this->tel_mobile = $v;
            $this->modifiedColumns[CataloguePdfConfigTableMap::TEL_MOBILE] = true;
        }


        return $this;
    } // setTelMobile()

    /**
     * Set the value of [adresse_voie_numero] column.
     *
     * @param      string $v new value
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setAdresseVoieNumero($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->adresse_voie_numero !== $v) {
            $this->adresse_voie_numero = $v;
            $this->modifiedColumns[CataloguePdfConfigTableMap::ADRESSE_VOIE_NUMERO] = true;
        }


        return $this;
    } // setAdresseVoieNumero()

    /**
     * Set the value of [adresse_codepostal] column.
     *
     * @param      string $v new value
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setAdresseCodepostal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->adresse_codepostal !== $v) {
            $this->adresse_codepostal = $v;
            $this->modifiedColumns[CataloguePdfConfigTableMap::ADRESSE_CODEPOSTAL] = true;
        }


        return $this;
    } // setAdresseCodepostal()

    /**
     * Set the value of [adresse_commune] column.
     *
     * @param      string $v new value
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setAdresseCommune($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->adresse_commune !== $v) {
            $this->adresse_commune = $v;
            $this->modifiedColumns[CataloguePdfConfigTableMap::ADRESSE_COMMUNE] = true;
        }


        return $this;
    } // setAdresseCommune()

    /**
     * Set the value of [siret] column.
     *
     * @param      string $v new value
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setSiret($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->siret !== $v) {
            $this->siret = $v;
            $this->modifiedColumns[CataloguePdfConfigTableMap::SIRET] = true;
        }


        return $this;
    } // setSiret()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($dt !== $this->created_at) {
                $this->created_at = $dt;
                $this->modifiedColumns[CataloguePdfConfigTableMap::CREATED_AT] = true;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($dt !== $this->updated_at) {
                $this->updated_at = $dt;
                $this->modifiedColumns[CataloguePdfConfigTableMap::UPDATED_AT] = true;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

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
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {


            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CataloguePdfConfigTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CataloguePdfConfigTableMap::translateFieldName('File', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CataloguePdfConfigTableMap::translateFieldName('Url', TableMap::TYPE_PHPNAME, $indexType)];
            $this->url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CataloguePdfConfigTableMap::translateFieldName('ResponsableNom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->responsable_nom = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CataloguePdfConfigTableMap::translateFieldName('ResponsablePrenom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->responsable_prenom = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CataloguePdfConfigTableMap::translateFieldName('TelFixe', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tel_fixe = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CataloguePdfConfigTableMap::translateFieldName('TelMobile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tel_mobile = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CataloguePdfConfigTableMap::translateFieldName('AdresseVoieNumero', TableMap::TYPE_PHPNAME, $indexType)];
            $this->adresse_voie_numero = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CataloguePdfConfigTableMap::translateFieldName('AdresseCodepostal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->adresse_codepostal = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CataloguePdfConfigTableMap::translateFieldName('AdresseCommune', TableMap::TYPE_PHPNAME, $indexType)];
            $this->adresse_commune = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CataloguePdfConfigTableMap::translateFieldName('Siret', TableMap::TYPE_PHPNAME, $indexType)];
            $this->siret = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CataloguePdfConfigTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CataloguePdfConfigTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = CataloguePdfConfigTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating \Catalogue\Model\CataloguePdfConfig object", 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(CataloguePdfConfigTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCataloguePdfConfigQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collCataloguePdfConfigI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see CataloguePdfConfig::setDeleted()
     * @see CataloguePdfConfig::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CataloguePdfConfigTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ChildCataloguePdfConfigQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
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

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CataloguePdfConfigTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(CataloguePdfConfigTableMap::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(CataloguePdfConfigTableMap::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(CataloguePdfConfigTableMap::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                CataloguePdfConfigTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
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
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->cataloguePdfConfigI18nsScheduledForDeletion !== null) {
                if (!$this->cataloguePdfConfigI18nsScheduledForDeletion->isEmpty()) {
                    \Catalogue\Model\CataloguePdfConfigI18nQuery::create()
                        ->filterByPrimaryKeys($this->cataloguePdfConfigI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->cataloguePdfConfigI18nsScheduledForDeletion = null;
                }
            }

                if ($this->collCataloguePdfConfigI18ns !== null) {
            foreach ($this->collCataloguePdfConfigI18ns as $referrerFK) {
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

        $this->modifiedColumns[CataloguePdfConfigTableMap::ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CataloguePdfConfigTableMap::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CataloguePdfConfigTableMap::ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::FILE)) {
            $modifiedColumns[':p' . $index++]  = 'FILE';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::URL)) {
            $modifiedColumns[':p' . $index++]  = 'URL';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::RESPONSABLE_NOM)) {
            $modifiedColumns[':p' . $index++]  = 'RESPONSABLE_NOM';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::RESPONSABLE_PRENOM)) {
            $modifiedColumns[':p' . $index++]  = 'RESPONSABLE_PRENOM';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::TEL_FIXE)) {
            $modifiedColumns[':p' . $index++]  = 'TEL_FIXE';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::TEL_MOBILE)) {
            $modifiedColumns[':p' . $index++]  = 'TEL_MOBILE';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::ADRESSE_VOIE_NUMERO)) {
            $modifiedColumns[':p' . $index++]  = 'ADRESSE_VOIE_NUMERO';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::ADRESSE_CODEPOSTAL)) {
            $modifiedColumns[':p' . $index++]  = 'ADRESSE_CODEPOSTAL';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::ADRESSE_COMMUNE)) {
            $modifiedColumns[':p' . $index++]  = 'ADRESSE_COMMUNE';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::SIRET)) {
            $modifiedColumns[':p' . $index++]  = 'SIRET';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'CREATED_AT';
        }
        if ($this->isColumnModified(CataloguePdfConfigTableMap::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'UPDATED_AT';
        }

        $sql = sprintf(
            'INSERT INTO catalogue_pdf_config (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ID':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'FILE':
                        $stmt->bindValue($identifier, $this->file, PDO::PARAM_STR);
                        break;
                    case 'URL':
                        $stmt->bindValue($identifier, $this->url, PDO::PARAM_STR);
                        break;
                    case 'RESPONSABLE_NOM':
                        $stmt->bindValue($identifier, $this->responsable_nom, PDO::PARAM_STR);
                        break;
                    case 'RESPONSABLE_PRENOM':
                        $stmt->bindValue($identifier, $this->responsable_prenom, PDO::PARAM_STR);
                        break;
                    case 'TEL_FIXE':
                        $stmt->bindValue($identifier, $this->tel_fixe, PDO::PARAM_STR);
                        break;
                    case 'TEL_MOBILE':
                        $stmt->bindValue($identifier, $this->tel_mobile, PDO::PARAM_STR);
                        break;
                    case 'ADRESSE_VOIE_NUMERO':
                        $stmt->bindValue($identifier, $this->adresse_voie_numero, PDO::PARAM_STR);
                        break;
                    case 'ADRESSE_CODEPOSTAL':
                        $stmt->bindValue($identifier, $this->adresse_codepostal, PDO::PARAM_STR);
                        break;
                    case 'ADRESSE_COMMUNE':
                        $stmt->bindValue($identifier, $this->adresse_commune, PDO::PARAM_STR);
                        break;
                    case 'SIRET':
                        $stmt->bindValue($identifier, $this->siret, PDO::PARAM_STR);
                        break;
                    case 'CREATED_AT':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'UPDATED_AT':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
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
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CataloguePdfConfigTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getFile();
                break;
            case 2:
                return $this->getUrl();
                break;
            case 3:
                return $this->getResponsableNom();
                break;
            case 4:
                return $this->getResponsablePrenom();
                break;
            case 5:
                return $this->getTelFixe();
                break;
            case 6:
                return $this->getTelMobile();
                break;
            case 7:
                return $this->getAdresseVoieNumero();
                break;
            case 8:
                return $this->getAdresseCodepostal();
                break;
            case 9:
                return $this->getAdresseCommune();
                break;
            case 10:
                return $this->getSiret();
                break;
            case 11:
                return $this->getCreatedAt();
                break;
            case 12:
                return $this->getUpdatedAt();
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
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
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
        if (isset($alreadyDumpedObjects['CataloguePdfConfig'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['CataloguePdfConfig'][$this->getPrimaryKey()] = true;
        $keys = CataloguePdfConfigTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFile(),
            $keys[2] => $this->getUrl(),
            $keys[3] => $this->getResponsableNom(),
            $keys[4] => $this->getResponsablePrenom(),
            $keys[5] => $this->getTelFixe(),
            $keys[6] => $this->getTelMobile(),
            $keys[7] => $this->getAdresseVoieNumero(),
            $keys[8] => $this->getAdresseCodepostal(),
            $keys[9] => $this->getAdresseCommune(),
            $keys[10] => $this->getSiret(),
            $keys[11] => $this->getCreatedAt(),
            $keys[12] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collCataloguePdfConfigI18ns) {
                $result['CataloguePdfConfigI18ns'] = $this->collCataloguePdfConfigI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name
     * @param      mixed  $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return void
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CataloguePdfConfigTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setFile($value);
                break;
            case 2:
                $this->setUrl($value);
                break;
            case 3:
                $this->setResponsableNom($value);
                break;
            case 4:
                $this->setResponsablePrenom($value);
                break;
            case 5:
                $this->setTelFixe($value);
                break;
            case 6:
                $this->setTelMobile($value);
                break;
            case 7:
                $this->setAdresseVoieNumero($value);
                break;
            case 8:
                $this->setAdresseCodepostal($value);
                break;
            case 9:
                $this->setAdresseCommune($value);
                break;
            case 10:
                $this->setSiret($value);
                break;
            case 11:
                $this->setCreatedAt($value);
                break;
            case 12:
                $this->setUpdatedAt($value);
                break;
        } // switch()
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
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CataloguePdfConfigTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFile($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUrl($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setResponsableNom($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setResponsablePrenom($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setTelFixe($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setTelMobile($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setAdresseVoieNumero($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setAdresseCodepostal($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setAdresseCommune($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setSiret($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CataloguePdfConfigTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CataloguePdfConfigTableMap::ID)) $criteria->add(CataloguePdfConfigTableMap::ID, $this->id);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::FILE)) $criteria->add(CataloguePdfConfigTableMap::FILE, $this->file);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::URL)) $criteria->add(CataloguePdfConfigTableMap::URL, $this->url);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::RESPONSABLE_NOM)) $criteria->add(CataloguePdfConfigTableMap::RESPONSABLE_NOM, $this->responsable_nom);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::RESPONSABLE_PRENOM)) $criteria->add(CataloguePdfConfigTableMap::RESPONSABLE_PRENOM, $this->responsable_prenom);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::TEL_FIXE)) $criteria->add(CataloguePdfConfigTableMap::TEL_FIXE, $this->tel_fixe);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::TEL_MOBILE)) $criteria->add(CataloguePdfConfigTableMap::TEL_MOBILE, $this->tel_mobile);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::ADRESSE_VOIE_NUMERO)) $criteria->add(CataloguePdfConfigTableMap::ADRESSE_VOIE_NUMERO, $this->adresse_voie_numero);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::ADRESSE_CODEPOSTAL)) $criteria->add(CataloguePdfConfigTableMap::ADRESSE_CODEPOSTAL, $this->adresse_codepostal);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::ADRESSE_COMMUNE)) $criteria->add(CataloguePdfConfigTableMap::ADRESSE_COMMUNE, $this->adresse_commune);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::SIRET)) $criteria->add(CataloguePdfConfigTableMap::SIRET, $this->siret);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::CREATED_AT)) $criteria->add(CataloguePdfConfigTableMap::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(CataloguePdfConfigTableMap::UPDATED_AT)) $criteria->add(CataloguePdfConfigTableMap::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(CataloguePdfConfigTableMap::DATABASE_NAME);
        $criteria->add(CataloguePdfConfigTableMap::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return   int
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
     * @param      object $copyObj An object of \Catalogue\Model\CataloguePdfConfig (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFile($this->getFile());
        $copyObj->setUrl($this->getUrl());
        $copyObj->setResponsableNom($this->getResponsableNom());
        $copyObj->setResponsablePrenom($this->getResponsablePrenom());
        $copyObj->setTelFixe($this->getTelFixe());
        $copyObj->setTelMobile($this->getTelMobile());
        $copyObj->setAdresseVoieNumero($this->getAdresseVoieNumero());
        $copyObj->setAdresseCodepostal($this->getAdresseCodepostal());
        $copyObj->setAdresseCommune($this->getAdresseCommune());
        $copyObj->setSiret($this->getSiret());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCataloguePdfConfigI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCataloguePdfConfigI18n($relObj->copy($deepCopy));
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
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return                 \Catalogue\Model\CataloguePdfConfig Clone of current object.
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
        if ('CataloguePdfConfigI18n' == $relationName) {
            return $this->initCataloguePdfConfigI18ns();
        }
    }

    /**
     * Clears out the collCataloguePdfConfigI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCataloguePdfConfigI18ns()
     */
    public function clearCataloguePdfConfigI18ns()
    {
        $this->collCataloguePdfConfigI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCataloguePdfConfigI18ns collection loaded partially.
     */
    public function resetPartialCataloguePdfConfigI18ns($v = true)
    {
        $this->collCataloguePdfConfigI18nsPartial = $v;
    }

    /**
     * Initializes the collCataloguePdfConfigI18ns collection.
     *
     * By default this just sets the collCataloguePdfConfigI18ns collection to an empty array (like clearcollCataloguePdfConfigI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCataloguePdfConfigI18ns($overrideExisting = true)
    {
        if (null !== $this->collCataloguePdfConfigI18ns && !$overrideExisting) {
            return;
        }
        $this->collCataloguePdfConfigI18ns = new ObjectCollection();
        $this->collCataloguePdfConfigI18ns->setModel('\Catalogue\Model\CataloguePdfConfigI18n');
    }

    /**
     * Gets an array of ChildCataloguePdfConfigI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCataloguePdfConfig is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildCataloguePdfConfigI18n[] List of ChildCataloguePdfConfigI18n objects
     * @throws PropelException
     */
    public function getCataloguePdfConfigI18ns($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCataloguePdfConfigI18nsPartial && !$this->isNew();
        if (null === $this->collCataloguePdfConfigI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCataloguePdfConfigI18ns) {
                // return empty collection
                $this->initCataloguePdfConfigI18ns();
            } else {
                $collCataloguePdfConfigI18ns = ChildCataloguePdfConfigI18nQuery::create(null, $criteria)
                    ->filterByCataloguePdfConfig($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCataloguePdfConfigI18nsPartial && count($collCataloguePdfConfigI18ns)) {
                        $this->initCataloguePdfConfigI18ns(false);

                        foreach ($collCataloguePdfConfigI18ns as $obj) {
                            if (false == $this->collCataloguePdfConfigI18ns->contains($obj)) {
                                $this->collCataloguePdfConfigI18ns->append($obj);
                            }
                        }

                        $this->collCataloguePdfConfigI18nsPartial = true;
                    }

                    reset($collCataloguePdfConfigI18ns);

                    return $collCataloguePdfConfigI18ns;
                }

                if ($partial && $this->collCataloguePdfConfigI18ns) {
                    foreach ($this->collCataloguePdfConfigI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collCataloguePdfConfigI18ns[] = $obj;
                        }
                    }
                }

                $this->collCataloguePdfConfigI18ns = $collCataloguePdfConfigI18ns;
                $this->collCataloguePdfConfigI18nsPartial = false;
            }
        }

        return $this->collCataloguePdfConfigI18ns;
    }

    /**
     * Sets a collection of CataloguePdfConfigI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $cataloguePdfConfigI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildCataloguePdfConfig The current object (for fluent API support)
     */
    public function setCataloguePdfConfigI18ns(Collection $cataloguePdfConfigI18ns, ConnectionInterface $con = null)
    {
        $cataloguePdfConfigI18nsToDelete = $this->getCataloguePdfConfigI18ns(new Criteria(), $con)->diff($cataloguePdfConfigI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->cataloguePdfConfigI18nsScheduledForDeletion = clone $cataloguePdfConfigI18nsToDelete;

        foreach ($cataloguePdfConfigI18nsToDelete as $cataloguePdfConfigI18nRemoved) {
            $cataloguePdfConfigI18nRemoved->setCataloguePdfConfig(null);
        }

        $this->collCataloguePdfConfigI18ns = null;
        foreach ($cataloguePdfConfigI18ns as $cataloguePdfConfigI18n) {
            $this->addCataloguePdfConfigI18n($cataloguePdfConfigI18n);
        }

        $this->collCataloguePdfConfigI18ns = $cataloguePdfConfigI18ns;
        $this->collCataloguePdfConfigI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CataloguePdfConfigI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CataloguePdfConfigI18n objects.
     * @throws PropelException
     */
    public function countCataloguePdfConfigI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCataloguePdfConfigI18nsPartial && !$this->isNew();
        if (null === $this->collCataloguePdfConfigI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCataloguePdfConfigI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCataloguePdfConfigI18ns());
            }

            $query = ChildCataloguePdfConfigI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCataloguePdfConfig($this)
                ->count($con);
        }

        return count($this->collCataloguePdfConfigI18ns);
    }

    /**
     * Method called to associate a ChildCataloguePdfConfigI18n object to this object
     * through the ChildCataloguePdfConfigI18n foreign key attribute.
     *
     * @param    ChildCataloguePdfConfigI18n $l ChildCataloguePdfConfigI18n
     * @return   \Catalogue\Model\CataloguePdfConfig The current object (for fluent API support)
     */
    public function addCataloguePdfConfigI18n(ChildCataloguePdfConfigI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collCataloguePdfConfigI18ns === null) {
            $this->initCataloguePdfConfigI18ns();
            $this->collCataloguePdfConfigI18nsPartial = true;
        }

        if (!in_array($l, $this->collCataloguePdfConfigI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCataloguePdfConfigI18n($l);
        }

        return $this;
    }

    /**
     * @param CataloguePdfConfigI18n $cataloguePdfConfigI18n The cataloguePdfConfigI18n object to add.
     */
    protected function doAddCataloguePdfConfigI18n($cataloguePdfConfigI18n)
    {
        $this->collCataloguePdfConfigI18ns[]= $cataloguePdfConfigI18n;
        $cataloguePdfConfigI18n->setCataloguePdfConfig($this);
    }

    /**
     * @param  CataloguePdfConfigI18n $cataloguePdfConfigI18n The cataloguePdfConfigI18n object to remove.
     * @return ChildCataloguePdfConfig The current object (for fluent API support)
     */
    public function removeCataloguePdfConfigI18n($cataloguePdfConfigI18n)
    {
        if ($this->getCataloguePdfConfigI18ns()->contains($cataloguePdfConfigI18n)) {
            $this->collCataloguePdfConfigI18ns->remove($this->collCataloguePdfConfigI18ns->search($cataloguePdfConfigI18n));
            if (null === $this->cataloguePdfConfigI18nsScheduledForDeletion) {
                $this->cataloguePdfConfigI18nsScheduledForDeletion = clone $this->collCataloguePdfConfigI18ns;
                $this->cataloguePdfConfigI18nsScheduledForDeletion->clear();
            }
            $this->cataloguePdfConfigI18nsScheduledForDeletion[]= clone $cataloguePdfConfigI18n;
            $cataloguePdfConfigI18n->setCataloguePdfConfig(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->file = null;
        $this->url = null;
        $this->responsable_nom = null;
        $this->responsable_prenom = null;
        $this->tel_fixe = null;
        $this->tel_mobile = null;
        $this->adresse_voie_numero = null;
        $this->adresse_codepostal = null;
        $this->adresse_commune = null;
        $this->siret = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collCataloguePdfConfigI18ns) {
                foreach ($this->collCataloguePdfConfigI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collCataloguePdfConfigI18ns = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CataloguePdfConfigTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     ChildCataloguePdfConfig The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[CataloguePdfConfigTableMap::UPDATED_AT] = true;

        return $this;
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    ChildCataloguePdfConfig The current object (for fluent API support)
     */
    public function setLocale($locale = 'en_US')
    {
        $this->currentLocale = $locale;

        return $this;
    }

    /**
     * Gets the locale for translations
     *
     * @return    string $locale Locale to use for the translation, e.g. 'fr_FR'
     */
    public function getLocale()
    {
        return $this->currentLocale;
    }

    /**
     * Returns the current translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildCataloguePdfConfigI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collCataloguePdfConfigI18ns) {
                foreach ($this->collCataloguePdfConfigI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildCataloguePdfConfigI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildCataloguePdfConfigI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addCataloguePdfConfigI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    ChildCataloguePdfConfig The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildCataloguePdfConfigI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collCataloguePdfConfigI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collCataloguePdfConfigI18ns[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * Returns the current translation
     *
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildCataloguePdfConfigI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [title] column value.
         *
         * @return   string
         */
        public function getTitle()
        {
        return $this->getCurrentTranslation()->getTitle();
    }


        /**
         * Set the value of [title] column.
         *
         * @param      string $v new value
         * @return   \Catalogue\Model\CataloguePdfConfigI18n The current object (for fluent API support)
         */
        public function setTitle($v)
        {    $this->getCurrentTranslation()->setTitle($v);

        return $this;
    }


        /**
         * Get the [subtitle] column value.
         *
         * @return   string
         */
        public function getSubtitle()
        {
        return $this->getCurrentTranslation()->getSubtitle();
    }


        /**
         * Set the value of [subtitle] column.
         *
         * @param      string $v new value
         * @return   \Catalogue\Model\CataloguePdfConfigI18n The current object (for fluent API support)
         */
        public function setSubtitle($v)
        {    $this->getCurrentTranslation()->setSubtitle($v);

        return $this;
    }


        /**
         * Get the [titre_date_debut] column value.
         *
         * @return   string
         */
        public function getTitreDateDebut()
        {
        return $this->getCurrentTranslation()->getTitreDateDebut();
    }


        /**
         * Set the value of [titre_date_debut] column.
         *
         * @param      string $v new value
         * @return   \Catalogue\Model\CataloguePdfConfigI18n The current object (for fluent API support)
         */
        public function setTitreDateDebut($v)
        {    $this->getCurrentTranslation()->setTitreDateDebut($v);

        return $this;
    }


        /**
         * Get the [alt] column value.
         *
         * @return   string
         */
        public function getAlt()
        {
        return $this->getCurrentTranslation()->getAlt();
    }


        /**
         * Set the value of [alt] column.
         *
         * @param      string $v new value
         * @return   \Catalogue\Model\CataloguePdfConfigI18n The current object (for fluent API support)
         */
        public function setAlt($v)
        {    $this->getCurrentTranslation()->setAlt($v);

        return $this;
    }


        /**
         * Get the [adresse_voie] column value.
         *
         * @return   string
         */
        public function getAdresseVoie()
        {
        return $this->getCurrentTranslation()->getAdresseVoie();
    }


        /**
         * Set the value of [adresse_voie] column.
         *
         * @param      string $v new value
         * @return   \Catalogue\Model\CataloguePdfConfigI18n The current object (for fluent API support)
         */
        public function setAdresseVoie($v)
        {    $this->getCurrentTranslation()->setAdresseVoie($v);

        return $this;
    }


        /**
         * Get the [texte_site] column value.
         *
         * @return   string
         */
        public function getTexteSite()
        {
        return $this->getCurrentTranslation()->getTexteSite();
    }


        /**
         * Set the value of [texte_site] column.
         *
         * @param      string $v new value
         * @return   \Catalogue\Model\CataloguePdfConfigI18n The current object (for fluent API support)
         */
        public function setTexteSite($v)
        {    $this->getCurrentTranslation()->setTexteSite($v);

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

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
