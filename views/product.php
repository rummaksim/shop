<?php include ROOT.'/views/layouts/header.php';?>


<div class="phone-description">
    <div class="container">
        <h2 class="section-title"><?php echo $product['name'] ?></h2>
        <div class="phone-description-section clearfix">
            <div class="phone-image phone-description-item">
                <img src="<?php echo $product['image_path']?>" alt="Телефон Xiaomi">
            </div>
            <div class="phone-description-item phone-description-description">
                <ul>
                    <li> <span class="phone-cost">Цена: <?php echo $product['cost']?> ₽</span></li>
                    <li> <span class="phone-specification"><b>Описание:</b> <?php echo $product['description']?></span></li>
                </ul>
            </div>
            <a class="btn-buy" data-id="<?php echo $product['id']?>" href="/cart/add/<?php echo $product['id']?>">В корзину</a>
    </div>

    </div>
</div>



<?php include ROOT.'/views/layouts/footer.php';?>