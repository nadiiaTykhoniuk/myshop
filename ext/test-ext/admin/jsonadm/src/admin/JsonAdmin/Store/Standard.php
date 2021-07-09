<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2021
 * @package Admin
 * @subpackage JsonAdm
 */

namespace Aimeos\Admin\JsonAdm\Store;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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
    public function get( ServerRequestInterface $request, ResponseInterface $response ) : \Psr\Http\Message\ResponseInterface
    {
        $this->getView()->assign( array( 'partial-data' => 'admin/jsonadm/partials/store/template-data' ) );

        return parent::get( $request, $response );
    }
}
