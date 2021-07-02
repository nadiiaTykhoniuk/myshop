<?php

namespace Aimeos\Admin\JQAdm\Dashboard\Decorator;

class ProductDecorator
    extends \Aimeos\Admin\JQAdm\Common\Decorator\Base
    implements \Aimeos\Admin\JQAdm\Common\Decorator\Iface
{
    public function addData( \Aimeos\MW\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\MW\View\Iface
    {
        $view = parent::addData( $view, $tags, $expire );

        $manager = \Aimeos\MShop::create( $this->getContext(), 'product' );

        $filter = $manager->filter();

        $view->productsByEditor = $manager->search( $filter, ['editor' => ['matsonka02@gmail.com']] );

        $view->testvariable = 'syka';

        return $view;
    }
}
