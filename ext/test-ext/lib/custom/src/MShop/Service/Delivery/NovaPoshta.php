<?php

namespace Aimeos\MShop\Service\Provider\Delivery;

use Illuminate\Support\Facades\Cache;

class NovaPoshta
    extends \Aimeos\MShop\Service\Provider\Decorator\Base
    implements \Aimeos\MShop\Service\Provider\Decorator\Iface
{
    public function process(\Aimeos\MShop\Order\Item\Iface $order, array $params = []): ?\Aimeos\MShop\Common\Helper\Form\Iface
    {
        $np = new \LisDev\Delivery\NovaPoshtaApi2('ea3a3b549806b0aa6cbb4f72a92910a9');
        $recipient = Cache::get('novaposhta');

        $result = $np->newInternetDocument(
            array(
                'FirstName' => 'Мій',
                'MiddleName' => 'Тестовий',
                'LastName' => 'Магазин',
                'CitySender' => 'Львів',
                'SenderAddress' => '',
            ),

            array(
                'FirstName' => $recipient['fname'],
                'LastName' => $recipient['lname'],
                'Phone' => $recipient['phone'],
                'City' => $recipient['city'],
                'Warehouse' => $recipient['warehouse'],
            ),
            array(
            )
        );

        Cache::put('ttn', $result);

    }
}
