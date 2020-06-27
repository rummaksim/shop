<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Онлайн магазин Xiaomi</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<!-- header -->
<div class="page-header">
    <div class="container">
        <div class="header-top clearfix">
            <div class="header-logo">
                <img src="/assets/img/logo.png" alt="Xiaomi" width="100" height="100">
            </div>
            <ul class="main-nav clearfix">
                <li><a href="/">Магазин</a></li>
                <li><a href="/catalog">Каталог</a></li>
                <li><a href="/cart">Корзина <span id="count-products-in-cart">
                        <?php
                            $countProductsInCart = Cart::countProductsInCart();
                            if ($countProductsInCart!=0)
                            echo '('.$countProductsInCart.')';
                        ?></span></a></li>
            </ul>
            <?php if (User::isGuest()): ?>
                <a class="btn btn-enter-exit" href="/login">Войти</a>
            <?php else: ?>
                <a class="btn btn-enter-exit" href="/logout">Выйти</a>
            <?php endif; ?>
        </div>
        <div class="promo">
            <a href="/product/61">Флагман Xiaomi Mi 10<br>Уже в продаже</a>
        </div>
    </div>
</div>