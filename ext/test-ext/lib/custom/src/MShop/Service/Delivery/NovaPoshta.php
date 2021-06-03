<?php

namespace \Aimeos\MShop\Service\Provider\Delivery;

class NovaPoshta
    extends \Aimeos\MShop\Service\Provider\Decorator\Base
    implements \Aimeos\MShop\Service\Provider\Decorator\Iface
{
    public function process(\Aimeos\MShop\Order\Item\Iface $order, array $params = []): ?\Aimeos\MShop\Common\Helper\Form\Iface
    {
        dd("here");
        return parent::process($order, $params);
    }
}
