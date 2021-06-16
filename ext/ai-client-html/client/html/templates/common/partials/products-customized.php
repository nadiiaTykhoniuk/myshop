<?php

$enc = $this->encoder();

$position = $this->get( 'position' );

$detailTarget = $this->config( 'client/html/catalog/detail/url/target' );

$detailController = $this->config( 'client/html/catalog/detail/url/controller', 'catalog' );

$detailAction = $this->config( 'client/html/catalog/detail/url/action', 'detail' );

$detailConfig = $this->config( 'client/html/catalog/detail/url/config', [] );

$detailFilter = array_flip( $this->config( 'client/html/catalog/detail/url/filter', ['d_prodid'] ) );

?>

<style>
    .product-container {
        text-align: center;
    }
    .product-customized .title {
        display: block;
        padding: 20px;
        background: rgba(107, 96, 80, 0.4);
        color: white;
        font-size: 32px;
        margin: 0 auto;
        max-width: 300px;
    }
</style>


<?php foreach( $this->get( 'products', [] ) as $id => $productItem ) : ?>
    <?php $params = array_diff_key( ['d_name' => $productItem->getName( 'url' ), 'd_prodid' => $productItem->getId(), 'd_pos' => $position !== null ? $position++ : ''], $detailFilter ) ?>

    <div class="product-container">
        <a href="<?= $enc->attr( $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig ) ) ?>">
            <div class="product-customized">
                <h2 class="title"><?= $enc->html( $productItem->getName(), $enc::TRUST ) ?></h2>
                <?php if( ( $mediaItem = $productItem->getRefItems( 'media', 'default', 'default' )->first() ) !== null ) : ?>
                    <img
                        alt="<?= $enc->attr( $mediaItem->getProperties( 'title' )->first() ) ?>"
                        src="<?= $enc->attr( $this->content( $mediaItem->getPreview() ) ) ?>"
                        width="500px"
                    >
                <?php endif;?>
            </div>
        </a>
    </div>

<?php endforeach ?>

<script>
    var slideIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("product-container");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > x.length) {slideIndex = 1}
        x[slideIndex-1].style.display = "block";
        setTimeout(carousel, 2000); // Change image every 2 seconds
    }
</script>

