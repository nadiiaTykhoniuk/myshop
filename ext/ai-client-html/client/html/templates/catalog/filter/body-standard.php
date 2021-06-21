<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2021
 */


$enc = $this->encoder();


/** client/html/catalog/lists/url/target
 * Destination of the URL where the controller specified in the URL is known
 *
 * The destination can be a page ID like in a content management system or the
 * module of a software development framework. This "target" must contain or know
 * the controller that should be called by the generated URL.
 *
 * @param string Destination of the URL
 * @since 2014.03
 * @category Developer
 * @see client/html/catalog/lists/url/controller
 * @see client/html/catalog/lists/url/action
 * @see client/html/catalog/lists/url/config
 */
$listTarget = $this->config( 'client/html/catalog/lists/url/target' );

/** client/html/catalog/lists/url/controller
 * Name of the controller whose action should be called
 *
 * In Model-View-Controller (MVC) applications, the controller contains the methods
 * that create parts of the output displayed in the generated HTML page. Controller
 * names are usually alpha-numeric.
 *
 * @param string Name of the controller
 * @since 2014.03
 * @category Developer
 * @see client/html/catalog/lists/url/target
 * @see client/html/catalog/lists/url/action
 * @see client/html/catalog/lists/url/config
 */
$listController = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );

/** client/html/catalog/lists/url/action
 * Name of the action that should create the output
 *
 * In Model-View-Controller (MVC) applications, actions are the methods of a
 * controller that create parts of the output displayed in the generated HTML page.
 * Action names are usually alpha-numeric.
 *
 * @param string Name of the action
 * @since 2014.03
 * @category Developer
 * @see client/html/catalog/lists/url/target
 * @see client/html/catalog/lists/url/controller
 * @see client/html/catalog/lists/url/config
 */
$listAction = $this->config( 'client/html/catalog/lists/url/action', 'list' );

/** client/html/catalog/lists/url/config
 * Associative list of configuration options used for generating the URL
 *
 * You can specify additional options as key/value pairs used when generating
 * the URLs, like
 *
 *  client/html/<clientname>/url/config = array( 'absoluteUri' => true )
 *
 * The available key/value pairs depend on the application that embeds the e-commerce
 * framework. This is because the infrastructure of the application is used for
 * generating the URLs. The full list of available config options is referenced
 * in the "see also" section of this page.
 *
 * @param string Associative list of configuration options
 * @since 2014.03
 * @category Developer
 * @see client/html/catalog/lists/url/target
 * @see client/html/catalog/lists/url/controller
 * @see client/html/catalog/lists/url/action
 * @see client/html/url/config
 */
$listConfig = $this->config( 'client/html/catalog/lists/url/config', [] );

$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );


?>

<style>
    #sidebarMenu {
        height: 20%;
        position: fixed;
        left: 0;
        width: 100%;
        margin-top: 60px;
        transform: translate(-150%, -150%);
        transition: transform 250ms ease-in-out;
        background: rgba(234,238,0,0.38);
    }

    .sidebarMenuInner {
        margin: 0;
        padding: 0;
        border-top: 1px solid rgba(255, 255, 255, 0.10);
    }

    .sidebarMenuInner li {
        list-style: none;
        color: #D94B6D;
        text-transform: uppercase;
        font-weight: bold;
        padding: 20px;
        cursor: pointer;
        border-bottom: 1px solid rgba(255, 255, 255, 0.10);
    }

    .sidebarMenuInner li span {
        display: block;
        font-size: 14px;
        color: #D94B6D;
    }

    .sidebarMenuInner li a {
        color: #D94B6D;
        text-transform: uppercase;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
    }

    input[type="checkbox"]:checked ~ #sidebarMenu { transform: translateX(0); }

    input[type=checkbox] {
        transition: all 0.3s;
        box-sizing: border-box;
        display: none;
    }

    .sidebarIconToggle {
        transition: all 0.3s;
        box-sizing: border-box;
        cursor: pointer;
        position: absolute;
        z-index: 99;
        height: 100%;
        width: 100%;
        top: 22px;
        left: 15px;
        height: 22px;
        width: 22px;
    }

    .spinner {
        transition: all 0.3s;
        box-sizing: border-box;
        position: absolute;
        height: 3px;
        width: 100%;
        background-color: #D94B6D;
    }

    .horizontal {
        transition: all 0.3s;
        box-sizing: border-box;
        position: relative;
        float: left;
        margin-top: 3px;
    }

    .diagonal.part-1 {
        position: relative;
        transition: all 0.3s;
        box-sizing: border-box;
        float: left;
    }

    .diagonal.part-2 {
        transition: all 0.3s;
        box-sizing: border-box;
        position: relative;
        float: left;
        margin-top: 3px;
    }

    input[type=checkbox]:checked ~ .sidebarIconToggle > .horizontal {
        transition: all 0.3s;
        box-sizing: border-box;
        opacity: 0;
    }

    input[type=checkbox]:checked ~ .sidebarIconToggle > .diagonal.part-1 {
        transition: all 0.3s;
        box-sizing: border-box;
        transform: rotate(135deg);
        margin-top: 8px;
    }

    input[type=checkbox]:checked ~ .sidebarIconToggle > .diagonal.part-2 {
        transition: all 0.3s;
        box-sizing: border-box;
        transform: rotate(-135deg);
        margin-top: -9px;
    }
</style>

<section class="aimeos catalog-filter" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, [], [], $optConfig ) ) ?>">

	<?php if( isset( $this->filterErrorList ) ) : ?>
		<ul class="error-list">
			<?php foreach( (array) $this->filterErrorList as $errmsg ) : ?>
				<li class="error-item"><?= $enc->html( $errmsg ) ?></li>
			<?php endforeach ?>
		</ul>
	<?php endif ?>

    <div class="header"></div>
    <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
    <label for="openSidebarMenu" class="sidebarIconToggle">
        <div class="spinner diagonal part-1"></div>
        <div class="spinner horizontal"></div>
        <div class="spinner diagonal part-2"></div>
    </label>

    <div id="sidebarMenu">
        <ul class="sidebarMenuInner">
            <li><h1><?= $enc->html( $this->translate( 'client', 'Filter' ), $enc::TRUST ) ?></h1></li>
            <li>
                <form class="row" method="GET" action="<?= $enc->attr( $this->url( $listTarget, $listController, $listAction, $this->get( 'filterParams', [] ), $listConfig ) ) ?>">
                    <?= $this->block()->get( 'catalog/filter/tree' ) ?>
                    <?= $this->block()->get( 'catalog/filter/search' ) ?>
                    <?= $this->block()->get( 'catalog/filter/price' ) ?>
                    <?= $this->block()->get( 'catalog/filter/supplier' ) ?>
                    <?= $this->block()->get( 'catalog/filter/attribute' ) ?>
                </form>
            </li>
        </ul>
    </div>


</section>


