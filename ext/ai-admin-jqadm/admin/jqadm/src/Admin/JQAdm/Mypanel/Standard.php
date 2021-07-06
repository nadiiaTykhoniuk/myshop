<?php
namespace Aimeos\Admin\JQAdm\Mypanel;

use Illuminate\Support\Facades\DB;

sprintf( 'mypanel' ); // for translation

class Standard
    extends \Aimeos\Admin\JQAdm\Common\Admin\Factory\Base
    implements \Aimeos\Admin\JQAdm\Common\Admin\Factory\Iface
{
    public function get() : ?string
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

        $tplconf = 'admin/jqadm/dashboard/statistics/template-list';
        $default = 'dashboard/list-statistics-standard';

        return $view->render( $view->config( $tplconf, $default ) );
    }

    public function getSubClient( string $type, string $name = null ) : \Aimeos\Admin\JQAdm\Iface
    {
        return $this->createSubClient( 'mypanel/' . $type, $name );
    }

    protected function getSubClientNames() : array
    {
        return $this->getContext()->getConfig()->get( 'admin/jqadm/mypanel/subparts', [] );
    }
}
