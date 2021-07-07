<?php

$enc = $this->encoder();

?>
<?php if(!empty($this->productsByEditor)) : ?>
    <div class="order-latest col-xl-12">
        <div class="box">
            <div class="header"
                 data-bs-toggle="collapse" data-bs-target="#order-latest-data"
                 aria-expanded="true" aria-controls="order-latest-data">
                <div class="card-tools-start">
                    <div class="btn act-show fa"></div>
                </div>
                <h2 class="header-label">
                    <?= $enc->html( $this->translate( 'admin', 'Statistics of created orders' ) ) ?>
                </h2>
            </div>
            <div id="order-latest-data" class="content collapse show">
                <div class="table-responsive">
                    <table class="list-items table table-hover">
                        <tbody>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Label</th>
                            <th>Prices</th>
                        </tr>
                        <?php foreach( $this->get( 'productsByEditor', [] ) as  $editor => $productList) : ?>
                            <tr>
                                <td colspan="4">
                                    <h3><?= $editor ?></h3>
                                </td>
                            </tr>
                            <?php foreach ($productList as $product) : ?>
                                <tr>
                                    <td><?= $product->getName() ?></td>
                                    <td><?= $product->getCode() ?></td>
                                    <td><?= $product->getLabel() ?></td>
                                    <td>
                                        <?= $this->partial( $this->config( 'client/html/common/partials/products', 'common/partials/price-standard' ), [
                                            'prices' => $product->getRefitems( 'price', 'default', 'default' )
                                        ]); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
