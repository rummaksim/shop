<?php

return array(
    // actionItem в ProductController - отображение конкретного товара
    'product/([0-9]+)' =>'ProductController/actionProduct/$1',

    //actionProducts в ProductController - отображение списка товаров заданной категории (заданная страница)
    'catalog/([0-9]+)/[p-]+([0-9]+)' => 'ProductController/actionProducts/$1/$2',

    //actionProducts в ProductController - отображение списка товаров заданной категории (первая страница)
    'catalog/([0-9]+)$' => 'ProductController/actionProducts/$1',

    //actionCatalog в ProductController - отображение категорий товаров
    'catalog' => 'ProductController/actionCatalog',

    //actionRegister в UserController - регистрация пользователя
    'register' => 'UserController/actionRegister',

    //actionLogin в UserController - авторизация пользователя
    'login' => 'UserController/actionLogin',

    //actionLogout в UserController - выход из аккаунта пользователя
    'logout' => 'UserController/actionLogout',

    //actionAddProduct в CartController - добавление товара в корзину (асинхронно)
    'cart/add/([0-9]+)$' => 'CartController/actionAddProduct/$1',

    //actionCart в CartController - отображение корзины
    'cart' => 'CartController/actionCart',

    //actionBuy в CartController - покупка товара
    'buy/([0-9]+)$' => 'CartController/actionBuy/$1',

    //actionRemove в CartController - удаление товара из корзины
    'remove/([0-9]+)$' => 'CartController/actionRemove/$1',

    //actionAdmin в UserController - переход на страницу админки, добавление товара
    'admin/([0-9]+)$' => 'UserController/actionAdmin/$1',


    //actionMain в SiteController - отображение главной страницы
    '' =>'SiteController/actionMain',
);
