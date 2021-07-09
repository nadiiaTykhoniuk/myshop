<?php

/**
 * @license LGPLv3, https://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2011
 * @copyright Aimeos (aimeos.org), 2015-2021
 * @package MShop
 * @subpackage Store
 */


namespace Aimeos\MShop\Store\Manager;


/**
 * Default store manager implementation.
 *
 * @package MShop
 * @subpackage Store
 */
class Standard
    extends \Aimeos\MShop\Common\Manager\Base
    implements \Aimeos\MShop\Common\Manager\Iface, \Aimeos\MShop\Catalog\Manager\Iface
{

    private $searchConfig = array(
        'store.id' => array(
            'label' => 'ID',
            'code' => 'store.id',
            'internalcode' => 'mmed."id"',
            'type' => 'integer',
            'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_INT,
        ),
        'store.siteid' => array(
            'label' => 'Site ID',
            'code' => 'store.siteid',
            'internalcode' => 'mmed."siteid"',
            'type' => 'string',
            'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
            'public' => false,
        ),
        'store.country' => array(
            'label' => 'Country',
            'code' => 'store.country',
            'internalcode' => 'mmed."country"',
            'type' => 'string',
            'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
        ),
        'store.address' => array(
            'label' => 'Address',
            'code' => 'store.address',
            'internalcode' => 'mmed."address"',
            'type' => 'string',
            'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
        ),
        'store.turnover' => array(
            'label' => 'Turnover',
            'code' => 'store.turnover',
            'internalcode' => 'mmed."turnover"',
            'type' => 'string',
            'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
        ),
        'store.ctime' => array(
            'code' => 'store.ctime',
            'internalcode' => 'mmed."ctime"',
            'label' => 'Create date/time',
            'type' => 'datetime',
            'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
            'public' => false,
        ),
        'store.mtime' => array(
            'code' => 'store.mtime',
            'internalcode' => 'mmed."mtime"',
            'label' => 'Modify date/time',
            'type' => 'datetime',
            'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
            'public' => false,
        ),
        'store.editor' => array(
            'code' => 'store.editor',
            'internalcode' => 'mmed."editor"',
            'label' => 'Editor',
            'type' => 'string',
            'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
            'public' => false,
        ),
        'store:has' => array(
            'code' => 'store:has()',
            'internalcode' => ':site AND :key AND mmedli."id"',
            'internaldeps' => ['LEFT JOIN "mshop_store_list" AS mmedli ON ( mmedli."parentid" = mmed."id" )'],
            'label' => 'store has list item, parameter(<domain>[,<list type>[,<reference ID>)]]',
            'type' => 'null',
            'internaltype' => 'null',
            'public' => false,
        )
    );

    private $languageId;


    public function createListItem(array $values = []): \Aimeos\MShop\Common\Item\Lists\Iface
    {
        // TODO: Implement createListItem() method.
    }

    /**
     * Initializes the object.
     *
     * @param \Aimeos\MShop\Context\Item\Iface $context Context object
     */
    public function __construct( \Aimeos\MShop\Context\Item\Iface $context )
    {
        parent::__construct( $context );

        $this->setResourceName( 'db-store' );
        $this->languageId = $context->getLocale()->getLanguageId();

        $level = \Aimeos\MShop\Locale\Manager\Base::SITE_ALL;
        $level = $context->getConfig()->get( 'mshop/store/manager/sitemode', $level );


        $this->searchConfig['store:has']['function'] = function( &$source, array $params ) use ( $level ) {

            $keys = [];

            foreach( (array) ( $params[1] ?? '' ) as $type ) {
                foreach( (array) ( $params[2] ?? '' ) as $id ) {
                    $keys[] = $params[0] . '|' . ( $type ? $type . '|' : '' ) . $id;
                }
            }

            $sitestr = $this->getSiteString( 'mmedli."siteid"', $level );
            $keystr = $this->toExpression( 'mmedli."key"', $keys, ( $params[2] ?? null ) ? '==' : '=~' );
            $source = str_replace( [':site', ':key'], [$sitestr, $keystr], $source );

            return $params;
        };
    }


    public function getPath(string $id, array $ref = []): \Aimeos\Map
    {
        // TODO: Implement getPath() method.
    }

    public function find(string $code, array $ref = [], string $domain = 'product', string $type = null, bool $default = false): \Aimeos\MShop\Common\Item\Iface
    {
        // TODO: Implement find() method.
    }

    public function insert(\Aimeos\MShop\Catalog\Item\Iface $item, string $parentId = null, string $refId = null): \Aimeos\MShop\Catalog\Item\Iface
    {
        // TODO: Implement insert() method.
    }

    public function getTree(string $id = null, array $ref = [], int $level = \Aimeos\MW\Tree\Manager\Base::LEVEL_TREE, \Aimeos\MW\Criteria\Iface $criteria = null)
    {
        // TODO: Implement getTree() method.
    }

    public function move(string $id, string $oldParentId = null, string $newParentId = null, string $refId = null): \Aimeos\MShop\Catalog\Manager\Iface
    {
        // TODO: Implement move() method.
    }

    /**
     * Removes old entries from the storage.
     *
     * @param iterable $siteids List of IDs for sites whose entries should be deleted
     * @return \Aimeos\MShop\Store\Manager\Iface Manager object for chaining method calls
     */
    public function clear( iterable $siteids ) : \Aimeos\MShop\Common\Manager\Iface
    {
        $path = 'mshop/store/manager/submanagers';
        $default = ['lists', 'property', 'type'];

        foreach( $this->getContext()->getConfig()->get( $path, $default ) as $domain ) {
            $this->getObject()->getSubManager( $domain )->clear( $siteids );
        }

        return $this->clearBase( $siteids, 'mshop/store/manager/delete' );
    }


    /**
     * Creates a new empty item instance
     *
     * @param array $values Values the item should be initialized with
     * @return \Aimeos\MShop\Store\Item\Iface New store item object
     */
    public function create( array $values = [] ) : \Aimeos\MShop\Common\Item\Iface
    {
        $values['store.siteid'] = $this->getContext()->getLocale()->getSiteId();
        return $this->createItemBase( $values );
    }


    /**
     * Returns the available manager types
     *
     * @param bool $withsub Return also the resource type of sub-managers if true
     * @return string[] Type of the manager and submanagers, subtypes are separated by slashes
     */
    public function getResourceType( bool $withsub = true ) : array
    {
        $path = 'mshop/store/manager/submanagers';
        $default = ['lists', 'property'];

        return $this->getResourceTypeBase( 'store', $path, $default, $withsub );
    }


    /**
     * Returns the attributes that can be used for searching.
     *
     * @param bool $withsub Return also attributes of sub-managers if true
     * @return \Aimeos\MW\Criteria\Attribute\Iface[] List of search attribute items
     */
    public function getSearchAttributes( bool $withsub = true ) : array
    {
        /** mshop/store/manager/submanagers
         * List of manager names that can be instantiated by the store manager
         *
         * Managers provide a generic interface to the underlying storage.
         * Each manager has or can have sub-managers caring about particular
         * aspects. Each of these sub-managers can be instantiated by its
         * parent manager using the getSubManager() method.
         *
         * The search keys from sub-managers can be normally used in the
         * manager as well. It allows you to search for items of the manager
         * using the search keys of the sub-managers to further limit the
         * retrieved list of items.
         *
         * @param array List of sub-manager names
         * @since 2014.03
         * @category Developer
         */
        $path = 'mshop/store/manager/submanagers';

        return $this->getSearchAttributesBase( $this->searchConfig, $path, [], $withsub );
    }


    /**
     * Removes multiple items.
     *
     * @param \Aimeos\MShop\Common\Item\Iface[]|string[] $itemIds List of item objects or IDs of the items
     * @return \Aimeos\MShop\Store\Manager\Iface Manager object for chaining method calls
     */
    public function delete( $itemIds ) : \Aimeos\MShop\Common\Manager\Iface
    {
        /** mshop/store/manager/delete/mysql
         * Deletes the items matched by the given IDs from the database
         *
         * @see mshop/store/manager/delete/ansi
         */

        /** mshop/store/manager/delete/ansi
         * Deletes the items matched by the given IDs from the database
         *
         * Removes the records specified by the given IDs from the store database.
         * The records must be from the site that is configured via the
         * context item.
         *
         * The ":cond" placeholder is replaced by the name of the ID column and
         * the given ID or list of IDs while the site ID is bound to the question
         * mark.
         *
         * The SQL statement should conform to the ANSI standard to be
         * compatible with most relational database systems. This also
         * includes using double quotes for table and column names.
         *
         * @param string SQL statement for deleting items
         * @since 2014.03
         * @category Developer
         * @see mshop/store/manager/insert/ansi
         * @see mshop/store/manager/update/ansi
         * @see mshop/store/manager/newid/ansi
         * @see mshop/store/manager/search/ansi
         * @see mshop/store/manager/count/ansi
         */
        $path = 'mshop/store/manager/delete';

        return $this->deleteItemsBase( $itemIds, $path )->deleteRefItems( $itemIds );
    }


    /**
     * Returns an item for the given ID.
     *
     * @param string $id ID of the item that should be retrieved
     * @param string[] $ref List of domains to fetch list items and referenced items for
     * @param bool $default Add default criteria
     * @return \Aimeos\MShop\Store\Item\Iface Returns the store item of the given id
     * @throws \Aimeos\MShop\Exception If item couldn't be found
     */
    public function get( string $id, array $ref = [], bool $default = false ) : \Aimeos\MShop\Common\Item\Iface
    {
        return $this->getItemBase( 'store.id', $id, $ref, $default );
    }


    /**
     * Adds a new item to the storage or updates an existing one.
     *
     * @param \Aimeos\MShop\Store\Item\Iface $item New item that should be saved to the storage
     * @param bool $fetch True if the new ID should be returned in the item
     * @return \Aimeos\MShop\Store\Item\Iface $item Updated item including the generated ID
     */
    public function saveItem( \Aimeos\MShop\Store\Item\Iface $item, bool $fetch = true ) : \Aimeos\MShop\Store\Item\Iface
    {
        if( !$item->isModified() )
        {
            $item = $this->savePropertyItems( $item, 'store', $fetch );
            return $this->saveListItems( $item, 'store', $fetch );
        }

        $context = $this->getContext();

        $dbm = $context->getDatabaseManager();
        $dbname = $this->getResourceName();
        $conn = $dbm->acquire( $dbname );

        try
        {
            $id = $item->getId();
            $date = date( 'Y-m-d H:i:s' );
            $columns = $this->getObject()->getSaveAttributes();

            if( $id === null )
            {
                /** mshop/store/manager/insert/mysql
                 * Inserts a new store record into the database table
                 *
                 * @see mshop/store/manager/insert/ansi
                 */

                /** mshop/store/manager/insert/ansi
                 * Inserts a new store record into the database table
                 *
                 * Items with no ID yet (i.e. the ID is NULL) will be created in
                 * the database and the newly created ID retrieved afterwards
                 * using the "newid" SQL statement.
                 *
                 * The SQL statement must be a string suitable for being used as
                 * prepared statement. It must include question marks for binding
                 * the values from the store item to the statement before they are
                 * sent to the database server. The number of question marks must
                 * be the same as the number of columns listed in the INSERT
                 * statement. The order of the columns must correspond to the
                 * order in the save() method, so the correct values are
                 * bound to the columns.
                 *
                 * The SQL statement should conform to the ANSI standard to be
                 * compatible with most relational database systems. This also
                 * includes using double quotes for table and column names.
                 *
                 * @param string SQL statement for inserting records
                 * @since 2014.03
                 * @category Developer
                 * @see mshop/store/manager/update/ansi
                 * @see mshop/store/manager/newid/ansi
                 * @see mshop/store/manager/delete/ansi
                 * @see mshop/store/manager/search/ansi
                 * @see mshop/store/manager/count/ansi
                 */
                $path = 'mshop/store/manager/insert';
                $sql = $this->addSqlColumns( array_keys( $columns ), $this->getSqlConfig( $path ) );
            }
            else
            {
                /** mshop/store/manager/update/mysql
                 * Updates an existing store record in the database
                 *
                 * @see mshop/store/manager/update/ansi
                 */

                /** mshop/store/manager/update/ansi
                 * Updates an existing store record in the database
                 *
                 * Items which already have an ID (i.e. the ID is not NULL) will
                 * be updated in the database.
                 *
                 * The SQL statement must be a string suitable for being used as
                 * prepared statement. It must include question marks for binding
                 * the values from the store item to the statement before they are
                 * sent to the database server. The order of the columns must
                 * correspond to the order in the save() method, so the
                 * correct values are bound to the columns.
                 *
                 * The SQL statement should conform to the ANSI standard to be
                 * compatible with most relational database systems. This also
                 * includes using double quotes for table and column names.
                 *
                 * @param string SQL statement for updating records
                 * @since 2014.03
                 * @category Developer
                 * @see mshop/store/manager/insert/ansi
                 * @see mshop/store/manager/newid/ansi
                 * @see mshop/store/manager/delete/ansi
                 * @see mshop/store/manager/search/ansi
                 * @see mshop/store/manager/count/ansi
                 */
                $path = 'mshop/store/manager/update';
                $sql = $this->addSqlColumns( array_keys( $columns ), $this->getSqlConfig( $path ), false );
            }

            $idx = 1;
            $stmt = $this->getCachedStatement( $conn, $path, $sql );

            foreach( $columns as $name => $entry ) {
                $stmt->bind( $idx++, $item->get( $name ), $entry->getInternalType() );
            }

            $stmt->bind( $idx++, $item->getLanguageId() );
            $stmt->bind( $idx++, $item->getType() );
            $stmt->bind( $idx++, $item->getLabel() );
            $stmt->bind( $idx++, $item->getMimeType() );
            $stmt->bind( $idx++, $item->getUrl() );
            $stmt->bind( $idx++, $item->getStatus(), \Aimeos\MW\DB\Statement\Base::PARAM_INT );
            $stmt->bind( $idx++, $item->getDomain() );
            $stmt->bind( $idx++, json_encode( $item->getPreviews(), JSON_FORCE_OBJECT ) );
            $stmt->bind( $idx++, $date ); // mtime
            $stmt->bind( $idx++, $context->getEditor() );
            $stmt->bind( $idx++, $context->getLocale()->getSiteId() );

            if( $id !== null ) {
                $stmt->bind( $idx++, $id, \Aimeos\MW\DB\Statement\Base::PARAM_INT );
            } else {
                $stmt->bind( $idx++, $date ); // ctime
            }

            $stmt->execute()->finish();

            if( $id === null )
            {
                /** mshop/store/manager/newid/mysql
                 * Retrieves the ID generated by the database when inserting a new record
                 *
                 * @see mshop/store/manager/newid/ansi
                 */

                /** mshop/store/manager/newid/ansi
                 * Retrieves the ID generated by the database when inserting a new record
                 *
                 * As soon as a new record is inserted into the database table,
                 * the database server generates a new and unique identifier for
                 * that record. This ID can be used for retrieving, updating and
                 * deleting that specific record from the table again.
                 *
                 * For MySQL:
                 *  SELECT LAST_INSERT_ID()
                 * For PostgreSQL:
                 *  SELECT currval('seq_mmed_id')
                 * For SQL Server:
                 *  SELECT SCOPE_IDENTITY()
                 * For Oracle:
                 *  SELECT "seq_mmed_id".CURRVAL FROM DUAL
                 *
                 * There's no way to retrive the new ID by a SQL statements that
                 * fits for most database servers as they implement their own
                 * specific way.
                 *
                 * @param string SQL statement for retrieving the last inserted record ID
                 * @since 2014.03
                 * @category Developer
                 * @see mshop/store/manager/insert/ansi
                 * @see mshop/store/manager/update/ansi
                 * @see mshop/store/manager/delete/ansi
                 * @see mshop/store/manager/search/ansi
                 * @see mshop/store/manager/count/ansi
                 */
                $path = 'mshop/store/manager/newid';
                $id = $this->newId( $conn, $path );
            }

            $item->setId( $id );

            $dbm->release( $conn, $dbname );
        }
        catch( \Exception $e )
        {
            $dbm->release( $conn, $dbname );
            throw $e;
        }

        $item = $this->savePropertyItems( $item, 'store', $fetch );
        return $this->saveListItems( $item, 'store', $fetch );
    }


    /**
     * Creates a filter object.
     *
     * @param bool $default Add default criteria
     * @param bool $site TRUE for adding site criteria to limit items by the site of related items
     * @return \Aimeos\MW\Criteria\Iface Returns the filter object
     */
    public function filter( bool $default = false, bool $site = false ) : \Aimeos\MW\Criteria\Iface
    {
        if( $default === true )
        {
            $object = $this->filterBase( 'store' );
            $langid = $this->getContext()->getLocale()->getLanguageId();

            if( $langid !== null )
            {
                $temp = array(
                    $object->compare( '==', 'store.languageid', $langid ),
                    $object->compare( '==', 'store.languageid', null ),
                );

                $expr = array(
                    $object->getConditions(),
                    $object->or( $temp ),
                );

                $object->setConditions( $object->and( $expr ) );
            }

            return $object;
        }

        return parent::filter();
    }


    /**
     * Returns a new manager for store extensions
     *
     * @param string $manager Name of the sub manager type in lower case
     * @param string|null $name Name of the implementation, will be from configuration (or Default) if null
     * @return \Aimeos\MShop\Common\Manager\Iface Manager for different extensions, e.g stock, tags, locations, etc.
     */
    public function getSubManager( string $manager, string $name = null ) : \Aimeos\MShop\Common\Manager\Iface
    {
        return $this->getSubManagerBase( 'store', $manager, $name );
    }


    /**
     * Creates a new store item instance.
     *
     * @param array $values Associative list of key/value pairs
     * @param \Aimeos\MShop\Common\Item\Lists\Iface[] $listItems List of list items
     * @param \Aimeos\MShop\Common\Item\Iface[] $refItems List of items referenced
     * @param \Aimeos\MShop\Common\Item\Property\Iface[] $propItems List of property items
     * @return \Aimeos\MShop\Store\Item\Iface New store item
     */
    protected function createItemBase( array $values = [], array $listItems = [], array $refItems = [],
                                       array $propItems = [] ) : \Aimeos\MShop\Common\Item\Iface
    {
        $values['.languageid'] = $this->languageId;

        return new \Aimeos\MShop\Store\Item\Standard( $values, $listItems, $refItems, $propItems );
    }
}
