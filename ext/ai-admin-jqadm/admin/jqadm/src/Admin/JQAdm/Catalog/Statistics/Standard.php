<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2019-2021
 * @package Admin
 * @subpackage JQAdm
 */


namespace Aimeos\Admin\JQAdm\Catalog\Statistics;

use Illuminate\Support\Facades\DB;

/**
 * Default implementation of dashboard settings JQAdm client.
 *
 * @package Admin
 * @subpackage JQAdm
 */
class Standard
    extends \Aimeos\Admin\JQAdm\Common\Admin\Factory\Base
    implements \Aimeos\Admin\JQAdm\Common\Admin\Factory\Iface
{

    /**
     * Returns a list of resource according to the conditions
     *
     * @return string Output to display
     */
    public function search() : ?string
    {

        $view = $this->getView();

        $manager = \Aimeos\MShop::create( $this->getContext(), 'product' );
        $groupByEditor = [];

        $editors = DB::table('mshop_product')->pluck('editor')->unique();
        foreach ($editors as $editor) {
            $filter = $manager->filter();
            $groupByEditor [$editor] = $manager->search( $filter->add( 'product.editor', '==', $editor), ['price']);
        }
        $view->productsByEditor = $groupByEditor;

        $tplconf = 'admin/jqadm/common/page-standard';
        $default = 'catalog/list-statistics-standard';

        return $view->render( $view->config( $tplconf, $default ) );
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
        return $this->createSubClient( 'dashboard/statistics/' . $type, $name );
    }


    /**
     * Returns the list of sub-client names configured for the client.
     *
     * @return array List of JQAdm client names
     */
    protected function getSubClientNames() : array
    {
        return $this->getContext()->getConfig()->get( 'admin/jqadm/catalog/statistics/subparts', [] );
    }
}
