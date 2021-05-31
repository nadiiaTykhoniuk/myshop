<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2021
 */


namespace Aimeos\Client\Html\Cms\Page;


class StandardTest extends \PHPUnit\Framework\TestCase
{
	private $object;
	private $context;


	protected function setUp() : void
	{
		$this->context = \TestHelperHtml::getContext();
		$this->context->getLocale()->setLanguageId( 'en' );

		$this->object = new \Aimeos\Client\Html\Cms\Page\Standard( $this->context );
		$this->object->setView( \TestHelperHtml::getView() );
	}


	protected function tearDown() : void
	{
		unset( $this->object );
	}


	public function testGetHeader()
	{
		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, array( 'path' => '/contact' ) );
		$view->addHelper( 'param', $helper );

		$tags = [];
		$expire = null;

		$this->object->setView( $this->object->addData( $this->object->getView(), $tags, $expire ) );
		$output = $this->object->getHeader();

		$this->assertStringContainsString( '<title>Contact page | Aimeos</title>', $output );
		$this->assertEquals( null, $expire );
		$this->assertEquals( 3, count( $tags ) );
	}


	public function testGetHeaderException()
	{
		$mock = $this->getMockBuilder( \Aimeos\Client\Html\Cms\Page\Standard::class )
			->setConstructorArgs( [$this->context] )
			->setMethods( array( 'addData' ) )
			->getMock();

		$view = $this->object->getView();
		$view->addHelper( 'param', new \Aimeos\MW\View\Helper\Param\Standard( $view, ['path' => 'invalid'] ) );
		$mock->setView( $view );

		$mock->expects( $this->once() )->method( 'addData' )
			->will( $this->throwException( new \RuntimeException() ) );

		$mock->getHeader();
	}


	public function testGetBody()
	{
		$view = $this->object->getView();
		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $view, array( 'path' => '/contact' ) );
		$view->addHelper( 'param', $helper );

		$tags = [];
		$expire = null;

		$this->object->setView( $this->object->addData( $view, $tags, $expire ) );
		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<section class="aimeos cms-page"', $output );
		$this->assertStringContainsString( '<h1>Hello!</h1>', $output );

		$this->assertEquals( null, $expire );
		$this->assertEquals( 3, count( $tags ) );
	}


	public function testGetBodyClientHtmlException()
	{
		$mock = $this->getMockBuilder( \Aimeos\Client\Html\Cms\Page\Standard::class )
			->setConstructorArgs( [$this->context] )
			->setMethods( array( 'addData' ) )
			->getMock();

		$view = $this->object->getView();
		$view->addHelper( 'param', new \Aimeos\MW\View\Helper\Param\Standard( $view, ['path' => 'invalid'] ) );
		$mock->setView( $view );

		$mock->expects( $this->once() )->method( 'addData' )
			->will( $this->throwException( new \Aimeos\Client\Html\Exception() ) );

		$mock->getBody();
	}


	public function testGetBodyControllerFrontendException()
	{
		$mock = $this->getMockBuilder( \Aimeos\Client\Html\Cms\Page\Standard::class )
			->setConstructorArgs( [$this->context] )
			->setMethods( array( 'addData' ) )
			->getMock();

		$view = $this->object->getView();
		$view->addHelper( 'param', new \Aimeos\MW\View\Helper\Param\Standard( $view, ['path' => 'invalid'] ) );
		$mock->setView( $view );

		$mock->expects( $this->once() )->method( 'addData' )
			->will( $this->throwException( new \Aimeos\Controller\Frontend\Exception() ) );

		$mock->getBody();
	}


	public function testGetBodyMShopException()
	{
		$mock = $this->getMockBuilder( \Aimeos\Client\Html\Cms\Page\Standard::class )
			->setConstructorArgs( [$this->context] )
			->setMethods( array( 'addData' ) )
			->getMock();

		$view = $this->object->getView();
		$view->addHelper( 'param', new \Aimeos\MW\View\Helper\Param\Standard( $view, ['path' => 'invalid'] ) );
		$mock->setView( $view );

		$mock->expects( $this->once() )->method( 'addData' )
			->will( $this->throwException( new \Aimeos\MShop\Exception() ) );

		$mock->getBody();
	}


	public function testGetBodyException()
	{
		$mock = $this->getMockBuilder( \Aimeos\Client\Html\Cms\Page\Standard::class )
			->setConstructorArgs( [$this->context] )
			->setMethods( array( 'addData' ) )
			->getMock();

		$view = $this->object->getView();
		$view->addHelper( 'param', new \Aimeos\MW\View\Helper\Param\Standard( $view, ['path' => 'invalid'] ) );
		$mock->setView( $view );

		$mock->expects( $this->once() )->method( 'addData' )
			->will( $this->throwException( new \RuntimeException() ) );

		$mock->getBody();
	}


	public function testGetSubClientInvalid()
	{
		$this->expectException( '\\Aimeos\\Client\\Html\\Exception' );
		$this->object->getSubClient( 'invalid', 'invalid' );
	}


	public function testGetSubClientInvalidName()
	{
		$this->expectException( '\\Aimeos\\Client\\Html\\Exception' );
		$this->object->getSubClient( '$$$', '$$$' );
	}


	public function testProcess()
	{
		$this->object->process();

		$this->assertEmpty( $this->object->getView()->get( 'pageErrorList' ) );
	}
}
