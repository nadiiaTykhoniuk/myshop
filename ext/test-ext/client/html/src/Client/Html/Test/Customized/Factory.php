<?php

namespace Aimeos\Client\Html\Test\Customized;

class Factory
    extends \Aimeos\Client\Html\Common\Factory\Base
    implements \Aimeos\Client\Html\Common\Factory\Iface
{
    public static function create( \Aimeos\MShop\Context\Item\Iface $context, string $name = null ) : \Aimeos\Client\Html\Iface
    {
        if( $name == null ) {
            $name = $context->getConfig()->get( 'client/html/test/customized/name', 'Standard' );
        }

        $iface = '\\Aimeos\\Client\\Html\\Iface';
        $classname = '\\Aimeos\\Client\\Html\\Test\\Customized\\' . $name;

        if( ctype_alnum( $name ) === false ) {
            throw new \Aimeos\Client\Html\Exception( sprintf( 'Invalid characters in class name "%1$s"', $classname ) );
        }

        $client = self::createClient( $context, $classname, $iface );
        $client = self::addClientDecorators( $context, $client, 'test/customized' );

        return $client->setObject( $client );
    }
}

