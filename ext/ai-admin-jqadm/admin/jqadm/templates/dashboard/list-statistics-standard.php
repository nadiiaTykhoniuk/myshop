<?php foreach ($this->productsByEditor as $editor => $productList) : ?>
    <h4><?= $editor ?></h4>
    <ul>
        <?php foreach ($productList as $product) : ?>
            <li><?= $product->getName() ?></li>
        <?php endforeach; ?>
    </ul>
<?php endforeach; ?>
