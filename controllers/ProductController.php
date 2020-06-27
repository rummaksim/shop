<?php

class ProductController
{
    /**
     * Получение категорий товара и их показ в catalog.php
     */
    public function actionCatalog(){
        $categories = Product::getCategories();
        require_once(ROOT . '/views/catalog.php');
        return true;
    }

    /**
     * Получение списка товаров заданной категории и их отображение в product-list.php
     * @param $category
     * @return bool
     */
    public function actionProducts($category, $page=1){
        $products = Product::getProductsByCategory($category, $page);
        $totalProducts = Product::getCountProductsByCategory($category);
        $pagination = new Pagination($totalProducts, $page, Product::LIMIT_PRODUCTS_ON_PAGE, 'p-');
        $category_name = Product::getCategoryNameById($category);
        require_once('views/products-list.php');
        return true;
    }

    /**
     * Получение конкретного товара заданной категории и его отображение в product.php
     * @param $category
     * @param $id
     * @return bool
     */
    public function actionProduct($product_id){
       if ($product_id){
           $product = Product::getProductById($product_id);
           require_once('views/product.php');
       }
        return true;
    }




}