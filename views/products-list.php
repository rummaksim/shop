<?php include ROOT.'/views/layouts/header.php';?>

<div class="popular-phones">
    <div class="container">
        <h2 class="section-title">Линейка смартфонов <?php echo $category_name ?></h2>
        <?php if (User::isAdmin()): ?>
            <a class="btn btn-redirect-to-admin-panel" href="/admin/<?php echo $category ?>">Добавить товар</a>
        <?php endif; ?>
        <div class="popular-items clearfix">

            <?php foreach ($products as $product): ?>
                <div class="catalog-item phones-list-item">
                    <img src="<?php echo $product['image_path'] ?>" alt="Телефон Xiaomi">
                    <h3><?php echo  $product['name']?></h3>
                    <b class="catalog-item-price"><?php echo $product['cost'] ?> ₽</b>
                    <a class="btn btn-info" href="/product/<?php echo $product['id']?>">Подробнее</a>
                </div>
            <?php endforeach; ?>
        </div>

        <!--
        <ul class="pagination clearfix">
            <li><a href="#">&lt;</a></li>
            <li><a class="active" href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&gt;</a></li>
        </ul>
        -->
        <?php echo $pagination->get() ?>
    </div>
</div>

<?php include ROOT.'/views/layouts/footer.php';?>