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
 * Factory for Catalog Manager.
 *
 * @package MShop
 * @subpackage Catalog
 */
class Factory
    extends \Aimeos\MShop\Common\Factory\Base
    implements \Aimeos\MShop\Common\Factory\Iface
{
    /**
     * Creates a catalog DAO object.
     *
     * @param \Aimeos\MShop\Context\Item\Iface $context Shop context instance with necessary objects
     * @param string|null $name Manager name
     * @return \Aimeos\MShop\Common\Manager\Iface Manager object
     * @throws \Aimeos\MShop\Catalog\Exception If requested manager implementation couldn't be found
     */
    public static function create(\Aimeos\MShop\Context\Item\Iface $context, string $name = null): \Aimeos\MShop\Common\Manager\Iface
    {
        if ($name === null) {
            $name = $context->getConfig()->get('mshop/store/manager/name', 'Standard');
        }

        $iface = \Aimeos\MShop\Catalog\Manager\Iface::class;
        $classname = '\Aimeos\MShop\Store\Manager\\' . $name;

        if (ctype_alnum($name) === false) {
            throw new \Aimeos\MShop\Catalog\Exception(sprintf('Invalid characters in class name "%1$s"', $classname));
        }

        $manager = self::createManager($context, $classname, $iface);

        return self::addManagerDecorators($context, $manager, 'store');
    }
}
