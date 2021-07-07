<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2021
 * @package Admin
 * @subpackage JsonAdm
 */

namespace Aimeos\Admin\JsonAdm\Store;


/**
 * JSON API store client
 *
 * @package Admin
 * @subpackage JsonAdm
 */
class Standard
    extends \Aimeos\Admin\JsonAdm\Standard
    implements \Aimeos\Admin\JsonAdm\Common\Iface
{
	/**
	 * Returns the list items for association relationships
	 *
	 * @param \Aimeos\Map $items List of items implementing \Aimeos\MShop\Common\Item\Iface
	 * @param array $include List of resource types that should be fetched
	 * @return \Aimeos\Map List of items implementing \Aimeos\MShop\Common\Item\Lists\Iface
	 */
	protected function getListItems( \Aimeos\Map $items, array $include ) : \Aimeos\Map
	{
	    $view = $this->getView();
        $manager = \Aimeos\MShop::create( $this->getContext(), 'store' );
        $search = $manager->createSearch();
        $total = 0;
        $view->items = $manager->searchItems( $search, [], $total );
        $view->total = $total;
	}
}
