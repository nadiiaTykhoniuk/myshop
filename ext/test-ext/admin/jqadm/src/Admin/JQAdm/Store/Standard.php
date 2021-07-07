<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017-2021
 * @package Admin
 * @subpackage JQAdm
 */


namespace Aimeos\Admin\JQAdm\Store;

sprintf( 'store' ); // for translation


/**
 * Default implementation of catalog JQAdm client.
 *
 * @package Admin
 * @subpackage JQAdm
 */
class Standard
    extends \Aimeos\Admin\JQAdm\Common\Admin\Factory\Base
    implements \Aimeos\Admin\JQAdm\Common\Admin\Factory\Iface
{
    /**
     * Returns a single resource
     *
     * @return string|null HTML output
     */
    public function get() : ?string
    {
        $view = $this->getView();
        $manager = \Aimeos\MShop::create($this->getContext(), 'store');
        $search = $manager->createSearch();
        $total = 0;
        $view->items = $manager->searchItems( $search, [], $total );
        $view->total = $total;

        return $this->render( $view );
    }

    /**
     * Returns the sub-client given by its name.
     *
     * @param string $type Name of the client type
     * @param string|null $name Name of the sub-client (Default if null)
     * @return \Aimeos\Admin\JQAdm\Iface Sub-client object
     */
    public function getSubClient( string $type, string $name = null ) : \Aimeos\Admin\JQAdm\Iface
    {
        return $this->createSubClient( 'catalog/' . $type, $name );
    }

    /**
     * Returns the list of sub-client names configured for the client.
     *
     * @return array List of JQAdm client names
     */
    protected function getSubClientNames() : array
    {
        return $this->getContext()->getConfig()->get( 'admin/jqadm/store/subparts', [] );
    }

    /**
     * Returns the rendered template including the view data
     *
     * @param \Aimeos\MW\View\Iface $view View object with data assigned
     * @return string HTML output
     */
    protected function render( \Aimeos\MW\View\Iface $view ) : string
    {
        $tplconf = ' ';
        $default = 'store/item-standard';

        return $view->render( $view->config( $tplconf, $default ) );
    }
}
