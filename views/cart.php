<?php include ROOT.'/views/layouts/header.php';?>


<div class="cart-items-container">
    <div class="container">
        <h2 class="section-title">Ваша корзина</h2>
        <div class="cart-items clearfix">
            <?php foreach ($cartProducts as $num => $product):?>
                <div class="cart-item" id="cart-item">
                    <img src="<?php echo $product['image_path']?>" alt="<?php echo $product['name']?>">
                    <h3><?php echo $product['name']?></h3>
                    <b class="catalog-item-price"><?php echo $product['cost'] ?> ₽</b>
                    <div class="cart-set-count-and-price clearfix">
                        <div class="set-count">
                            <span>Товаров: <b><?php echo Cart::countProductsInCartById($product['id'])?></b></span>
                        </div>
                        <div class="set-price">
                            <span>Итого: <b><?php echo Cart::countProductsInCartById($product['id'])*$product['cost']?> ₽</b> </span>
                        </div>
                    </div>
                    <a class="btn cart-btn-buy" data-id="<?php echo $product['id']?>" href="/buy/<?php echo $product['id']?>">Купить</a>
                    <a class="btn cart-btn-remove" data-id="<?php echo $product['id']?>" href="/remove/<?php echo $product['id']?>">Удалить</a>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div><!--

<?php include ROOT.'/views/layouts/footer.php';?>