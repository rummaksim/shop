<?php


class CartController
{
    /**
     * Асинхронное добавление товара в корзину
     * @param $productId
     */
    public static function actionAddProduct($productId){
        echo '('.Cart::addProduct($productId).')';
        return true;
    }

    /**
     * Отображение корзины
     */
    public static function actionCart(){
        $cartProductsInSession = false;
        $cartProducts = array();
        $cartProductsInSession = Cart::getCartProducts();
        if ($cartProductsInSession){
            $cartProductsIdsKeys = array_keys($cartProductsInSession);
            $cartProducts = Product::getProductsByIds($cartProductsIdsKeys);
        }
        require_once(ROOT . '/views/cart.php');
        return true;
    }

    /**
     * Покупка товара
     */
    public static function actionBuy($productId){
        Cart::buyProduct($productId);
        $cartProducts = array();
        $cartProductsInSession = Cart::getCartProducts();
        if ($cartProductsInSession){
            $cartProductsIdsKeys = array_keys($cartProductsInSession);
            $cartProducts = Product::getProductsByIds($cartProductsIdsKeys);
        }
        for ($i=0; $i<count($cartProducts); $i++){
            $cartProducts[$i]['count']=Cart::countProductsInCartById($cartProducts[$i]['id']);
        }
        echo json_encode($cartProducts, JSON_UNESCAPED_UNICODE);
        return true;
    }

    public static function actionRemove($productId){
        Cart::cartRemoveProduct($productId);
        $cartProducts = array();
        $cartProductsInSession = Cart::getCartProducts();
        if ($cartProductsInSession){
            $cartProductsIdsKeys = array_keys($cartProductsInSession);
            $cartProducts = Product::getProductsByIds($cartProductsIdsKeys);
        }
        for ($i=0; $i<count($cartProducts); $i++){
            $cartProducts[$i]['count']=Cart::countProductsInCartById($cartProducts[$i]['id']);
        }
        echo json_encode($cartProducts, JSON_UNESCAPED_UNICODE);
        return true;
    }

}