<?php
namespace Aimeos\Client\Html\Basket\Customized;

use Aimeos\Client\Html\Common\Client\Factory\Iface;

class Standard
    extends \Aimeos\Client\Html\Common\Client\Factory\Base
    implements Iface
{
    private $subPartPath = 'client/html/catalog/detail/subparts';
    private $subPartNames = [];
    private $tags = [];
    private $expire;
    private $view;


    public function getBody( string $uid = '' ) : string
    {
        $context = $this->getContext();
        $view = $this->getView();

        try
        {
            if( !isset( $this->view ) ) {
                $view = $this->view = $this->getObject()->addData( $view, $this->tags, $this->expire );
            }

            $html = '';
            foreach( $this->getSubClients() as $subclient ) {
                $html .= $subclient->setView( $view )->getBody( $uid );
            }
            $view->detailBody = $html;
        }
        catch( \Aimeos\Client\Html\Exception $e )
        {
            $error = [$context->getI18n()->dt( 'client', $e->getMessage() )];
            $view->detailErrorList = array_merge( $view->get( 'customizedErrorList', [] ), $error );
        }
        catch( \Aimeos\Controller\Frontend\Exception $e )
        {
            $error = [$context->getI18n()->dt( 'controller/frontend', $e->getMessage() )];
            $view->detailErrorList = array_merge( $view->get( 'customizedErrorList', [] ), $error );
        }
        catch( \Aimeos\MShop\Exception $e )
        {
            $error = [$context->getI18n()->dt( 'mshop', $e->getMessage() )];
            $view->detailErrorList = array_merge( $view->get( 'customizedErrorList', [] ), $error );
        }
        catch( \Exception $e )
        {
            $error = [$context->getI18n()->dt( 'client', 'A non-recoverable error occured' )];
            $view->detailErrorList = array_merge( $view->get( 'customizedErrorList', [] ), $error );
            $this->logException( $e );
        }

        $tplconf = 'client/html/basket/customized/template-body';
        $default = 'basket/customized/body-standard';

        return $view->render( $view->config( $tplconf, $default ) );
    }


    public function getHeader( $uid = '' ) : ?string
    {
      return  '';
    }

    public function getSubClient( string $type, string $name = null ) : \Aimeos\Client\Html\Iface
    {
    }

    public function process()
    {
        $context = $this->getContext();
        $view = $this->getView();

        try
        {
            // your required code
            parent::process();
        }
        catch( \Aimeos\Client\Html\Exception $e )
        {
            $error = [$context->getI18n()->dt( 'client', $e->getMessage() )];
            $view->detailErrorList = array_merge( $view->get( 'customizedErrorList', [] ), $error );
        }
        catch( \Aimeos\Controller\Frontend\Exception $e )
        {
            $error = [$context->getI18n()->dt( 'controller/frontend', $e->getMessage() )];
            $view->detailErrorList = array_merge( $view->get( 'customizedErrorList', [] ), $error );
        }
        catch( \Aimeos\MShop\Exception $e )
        {
            $error = [$context->getI18n()->dt( 'mshop', $e->getMessage() )];
            $view->detailErrorList = array_merge( $view->get( 'customizedErrorList', [] ), $error );
        }
        catch( \Exception $e )
        {
            $error = [$context->getI18n()->dt( 'client', 'A non-recoverable error occured' )];
            $view->detailErrorList = array_merge( $view->get( 'customizedErrorList', [] ), $error );
            $this->logException( $e );
        }
    }


    protected function getSubClientNames() : array
    {
        return  [];
    }
}
