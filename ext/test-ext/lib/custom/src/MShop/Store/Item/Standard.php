<?php

/**
 * @license LGPLv3, https://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2011
 * @copyright Aimeos (aimeos.org), 2015-2021
 * @package MShop
 * @subpackage Product
 */


namespace Aimeos\MShop\Store\Item;

use \Aimeos\MShop\Common\Item\Config;
use \Aimeos\MShop\Common\Item\ListsRef;
use \Aimeos\MShop\Common\Item\PropertyRef;


/**
 * Default impelementation of a product item.
 *
 * @package MShop
 * @subpackage Product
 */
class Standard
    extends \Aimeos\MShop\Common\Item\Base
    implements \Aimeos\MShop\Store\Item\Iface
{
    use Config\Traits, ListsRef\Traits, PropertyRef\Traits {
        PropertyRef\Traits::__clone as __cloneProperty;
        ListsRef\Traits::__clone insteadof PropertyRef\Traits;
        ListsRef\Traits::__clone as __cloneList;
        ListsRef\Traits::getName as getNameList;
    }


    private $date;


    /**
     * Initializes the item object.
     *
     * @param array $values Parameter for initializing the basic properties
     * @param \Aimeos\MShop\Common\Item\Lists\Iface[] $listItems List of list items
     * @param \Aimeos\MShop\Common\Item\Iface[] $refItems List of referenced items
     * @param \Aimeos\MShop\Common\Item\Property\Iface[] $propItems List of property items
     */
    public function __construct( array $values = [], array $listItems = [],
                                 array $refItems = [], array $propItems = [] )
    {
        parent::__construct( 'store.', $values );

        $this->date = isset( $values['.date'] ) ? $values['.date'] : date( 'Y-m-d H:i:s' );
        $this->initListItems( $listItems, $refItems );
        $this->initPropertyItems( $propItems );
    }


    /**
     * Creates a deep clone of all objects
     */
    public function __clone()
    {
        parent::__clone();
        $this->__cloneList();
        $this->__cloneProperty();
    }

    /**
     * Returns the configuration values of the item
     *
     * @return array Configuration values
     */
    public function getConfig() : array
    {
        return $this->get( 'store.config', [] );
    }


    /**
     * Sets the configuration values of the item.
     *
     * @param array $config Configuration values
     * @return \Aimeos\MShop\Store\Item\Iface Product item for chaining method calls
     */
    public function setConfig( array $config ) : \Aimeos\MShop\Common\Item\Iface
    {
        return $this->set( 'store.config', $config );
    }

    /**
     * Returns the URL target specific for that product
     *
     * @return string URL target specific for that product
     */
    public function getCountry() : string
    {
        return $this->get( 'store.country', '' );
    }


    /**
     * Sets a new URL target specific for that product
     *
     * @param string $value New URL target specific for that product
     * @return \Aimeos\MShop\Store\Item\Iface Product item for chaining method calls
     */
    public function setCountry( ?string $value ) : \Aimeos\MShop\Store\Item\Iface
    {
        return $this->set( 'store.country', (string) $value );
    }

    /**
     * Returns the URL target specific for that product
     *
     * @return string URL target specific for that product
     */
    public function getAddress() : string
    {
        return $this->get( 'store.address', '' );
    }


    /**
     * Sets a new URL target specific for that product
     *
     * @param string $value New URL target specific for that product
     * @return \Aimeos\MShop\Store\Item\Iface Product item for chaining method calls
     */
    public function setAddress( ?string $value ) : \Aimeos\MShop\Store\Item\Iface
    {
        return $this->set( 'store.address', (string) $value );
    }

    /**
     * Returns the URL target specific for that product
     *
     * @return string URL target specific for that product
     */
    public function getTurnover() : string
    {
        return $this->get( 'store.turnover', '' );
    }


    /**
     * Sets a new URL target specific for that product
     *
     * @param string $value New URL target specific for that product
     * @return \Aimeos\MShop\Store\Item\Iface Product item for chaining method calls
     */
    public function setTurnover( ?string $value ) : \Aimeos\MShop\Store\Item\Iface
    {
        return $this->set( 'store.turnover', (string) $value );
    }



    /**
     * Returns the create date of the item
     *
     * @return string ISO date in YYYY-MM-DD hh:mm:ss format
     */
    public function getTimeCreated() : string
    {
        return $this->get( 'store.ctime', date( 'Y-m-d H:i:s' ) );
    }


    /**
     * Sets the create date of the item
     *
     * @param string|null $value ISO date in YYYY-MM-DD hh:mm:ss format
     * @return \Aimeos\MShop\Product\Item\Iface Product item for chaining method calls
     */
    public function setTimeCreated( ?string $value ) : \Aimeos\MShop\Product\Item\Iface
    {
        return $this->set( 'store.ctime', $this->checkDateFormat( $value ) );
    }

    /**
     * Returns the item type
     *
     * @return string Item type, subtypes are separated by slashes
     */
    public function getResourceType() : string
    {
        return 'store';
    }


    /**
     * Tests if the item is available based on status, time, language and currency
     *
     * @return bool True if available, false if not
     */
    public function isAvailable() : bool
    {
        return parent::isAvailable() && $this->getStatus() > 0
            && ( $this->getDateEnd() === null || $this->getDateEnd() > $this->date )
            && ( $this->getDateStart() === null || $this->getDateStart() < $this->date || $this->getType() === 'event' );
    }


    /*
	 * Sets the item values from the given array and removes that entries from the list
	 *
	 * @param array &$list Associative list of item keys and their values
	 * @param bool True to set private properties too, false for public only
	 * @return \Aimeos\MShop\store\Item\Iface store item for chaining method calls
	 */
    public function fromArray( array &$list, bool $private = false ) : \Aimeos\MShop\Common\Item\Iface
    {
        $item = parent::fromArray( $list, $private );

        foreach( $list as $key => $value )
        {
            switch( $key )
            {
                case 'store.country': $item = $item->setCountry( $value ); break;
                case 'store.address': $item = $item->setAddress( $value ); break;
                case 'store.turnover': $item = $item->setTurnover( $value ); break;
                default: continue 2;
            }

            unset( $list[$key] );
        }

        return $item;
    }


    /**
     * Returns the item values as array.
     *
     * @param bool True to return private properties, false for public only
     * @return array Associative list of item properties and their values
     */
    public function toArray( bool $private = false ) : array
    {
        $list = parent::toArray( $private );

        $list['store.country'] = $this->getCountry();
        $list['store.address'] = $this->getAddress();
        $list['store.turnover'] = $this->getTurnover();


        return $list;
    }
}
