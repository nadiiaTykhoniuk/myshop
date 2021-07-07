<?php
//
//
///**
// * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
// * @copyright Aimeos (aimeos.org), 2017-2021
// * @package Admin
// * @subpackage JQAdm
// */
//
//
//namespace Aimeos\Admin\JsonAdm\Store;
//
//
///**
// * Factory for catalog JQAdm client
// *
// * @package Admin
// * @subpackage JQAdm
// */
//class Factory
//    extends \Aimeos\Admin\JsonAdm\Common\Factory\Base
//    implements \Aimeos\Admin\JsonAdm\Common\Factory\Iface
//{
//    /**
//     * Creates a catalog client object
//     *
//     * @param \Aimeos\MShop\Context\Item\Iface $context Shop context instance with necessary objects
//     * @param string|null $name Admin name (default: "Standard")
//     * @return \Aimeos\Admin\JQAdm\Iface Filter part implementing \Aimeos\Admin\JQAdm\Iface
//     * @throws \Aimeos\Admin\JQAdm\Exception If requested client implementation couldn't be found or initialisation fails
//     */
//
//    public static function create(\Aimeos\MShop\Context\Item\Iface $context, \Aimeos\Bootstrap $aimeos, string $path, string $name = null): \Aimeos\Admin\JsonAdm\Iface
//    {
//        if ($name === null) {
//            $name = $context->getConfig()->get('admin/jqadm/store/name', 'Standard');
//        }
//
//        $iface = '\\Aimeos\\Admin\\JsonAdm\\Iface';
//        $classname = '\\Aimeos\\Admin\\JsonAdm\\Store\\' . $name;
//
//        if (ctype_alnum($name) === false) {
//            throw new \Aimeos\Admin\JQAdm\Exception(sprintf('Invalid characters in class name "%1$s"', $classname));
//        }
//
//        $client = self::createAdmin($context, $classname, $iface);
//
//        return self::addClientDecorators($context, $client, 'store');
//    }
//
//}
