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
    @import url('https://fonts.googleapis.com/css?family=Roboto:100,300,400,700');
    * {
        margin: 0;
        padding: 0;
    }
    .burger-menu_button {
        position: fixed;
        top: 10px;
        right: 10px;
        z-index: 30;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        -webkit-transition: 0.4s;
        -moz-transition: 0.4s;
        -o-transition: 0.4s;
        transition: 0.4s;
    }
    .burger-menu_button:hover .burger-menu_lines {
        filter: brightness(0.7);
    }

    .burger-menu_button:hover {
        background-color: rgba(255, 255, 255, 0.7);
    }

    .burger-menu_lines::before,
    .burger-menu_lines::after,
    .burger-menu_lines {
        position: absolute;
        width: 50px;
        height: 3px;
        background-color: #BB1E99;
        -webkit-transition: 0.4s;
        -moz-transition: 0.4s;
        -o-transition: 0.4s;
        transition: 0.4s;
    }
    .burger-menu_lines {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .burger-menu_lines::before {
        content: '';
        top: -12px;
    }
    .burger-menu_lines::after {
        content: '';
        top: 12px;
    }


    .burger-menu_active .burger-menu_lines {
        background-color: transparent;
    }
    .burger-menu_active .burger-menu_lines::before {
        top: 0;
        transform: rotate(45deg);
    }
    .burger-menu_active .burger-menu_lines::after{
        top: 0;
        transform: rotate(-45deg);
    }

    .burger-menu_nav {
        padding-top: 120px;
        position: fixed;
        top: 0;
        z-index: 20;
        display: flex;
        flex-flow: column;
        height: 100%;
        background-color: #F9AFE9;
        overflow-y: auto;
        right: -100%;
        -webkit-transition: 0.8s;
        -moz-transition: 0.8s;
        -o-transition: 0.8s;
        transition: 0.8s;
    }
    .burger-menu_active .burger-menu_nav {
        right: 0;
        -webkit-transition: 0.4s;
        -moz-transition: 0.4s;
        -o-transition: 0.4s;
        transition: 0.4s;
    }
    .burger-menu_link {
        padding: 18px 35px;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 5px;
        font-weight: 400;
        color: #BB1E99;
        border-bottom: 1px solid #fff;
    }
    .burger-menu_link:first-child {
        border-top: 1px solid #fff;
    }
    .burger-menu_link:hover {
        filter: brightness(0.9);
    }
    .burger-menu_overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 10;
    }
    .burger-menu_active .burger-menu_overlay {
        display: block;
        background-color: rgba(0, 0, 0, 0.5);
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

    <div class="burger-menu">
        <a href="" class="burger-menu_button">
            <spun class="burger-menu_lines"></spun>
        </a>
        <nav class="burger-menu_nav">
            <h1><?= $enc->html( $this->translate( 'client', 'Filter' ), $enc::TRUST ) ?></h1>
            <form class="row" method="GET" action="<?= $enc->attr( $this->url( $listTarget, $listController, $listAction, $this->get( 'filterParams', [] ), $listConfig ) ) ?>">
                <?= $this->block()->get( 'catalog/filter/tree' ) ?>
                <?= $this->block()->get( 'catalog/filter/search' ) ?>
                <?= $this->block()->get( 'catalog/filter/price' ) ?>
                <?= $this->block()->get( 'catalog/filter/supplier' ) ?>
                <?= $this->block()->get( 'catalog/filter/attribute' ) ?>
            </form>
        </nav>
        <div class="burger-menu_overlay"></div>
    </div>

</section>

<script>
    function burgerMenu(selector) {
        let menu = $(selector);
        let button = menu.find('.burger-menu_button', '.burger-menu_lines');
        let links = menu.find('.burger-menu_link');
        let overlay = menu.find('.burger-menu_overlay');

        button.on('click', (e) => {
            e.preventDefault();
            toggleMenu();
        });

        links.on('click', () => toggleMenu());
        overlay.on('click', () => toggleMenu());

        function toggleMenu(){
            menu.toggleClass('burger-menu_active');

            if (menu.hasClass('burger-menu_active')) {
                $('body').css('overlow', 'hidden');
            } else {
                $('body').css('overlow', 'visible');
            }
        }
    }

    burgerMenu('.burger-menu');
</script>
