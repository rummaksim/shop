<?php


class Cart
{
    /**
     * Добавление товара в коризину
     * @param $productId
     */
    public static function addProduct($productId)
    {
        $productId = intval($productId);
        $cartProducts = array();

        if (isset($_SESSION['cartProducts'])) {
            $cartProducts = $_SESSION['cartProducts'];
        }

        if (array_key_exists($productId, $cartProducts)) {
            $cartProducts[$productId] += 1;
        } else {
            $cartProducts[$productId] = 1;
        }
        $_SESSION['cartProducts'] = $cartProducts;
        //если пользователь не гость - добавляем товар и в БД
        if (!User::isGuest()) {
            $db = Db::getConnection();
            $sql = 'INSERT INTO cart (good, user) VALUES (?, ?)';
            $stmt = $db->prepare($sql);
            $stmt->execute(array($productId, $_SESSION['user']));
        }
        return self::countProductsInCart();
    }

    /**
     * Получение и заполнение корзины в сессию зарегистрированного пользователя из БД
     * @param $userId
     */
    public static function setUserCartFromDb()
    {
        $db = Db::getConnection();
        $sql = 'SELECT good, COUNT(*) AS cnt FROM cart WHERE user=? GROUP BY good ';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($_SESSION['user']));
        $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cartProducts = array();
        foreach ($cart as $num => $product) {
            $cartProducts[$product['good']] = intval($product['cnt']);
        }
        $_SESSION['cartProducts'] = $cartProducts;
    }

    /**
     * Покупка товара, удаление его из сессии + удаление их бд для авторизованного пользователя
     * @param bool $productId
     */
    public static function buyProduct($productId=false){
        if ($productId) {
            unset($_SESSION['cartProducts'][$productId]);
            if (!User::isGuest()){
                $db = Db::getConnection();
                $sql = 'DELETE FROM cart WHERE good=? AND user = ?';
                $stmt = $db->prepare($sql);
                $stmt->execute(array($productId, $_SESSION['user']));
            }
        }
    }

    public static function cartRemoveProduct($productId=false){
        if ($productId) {
            unset($_SESSION['cartProducts'][$productId]);
            if (!User::isGuest()){
                $db = Db::getConnection();
                $sql = 'DELETE FROM cart WHERE good=? AND user = ?';
                $stmt = $db->prepare($sql);
                $stmt->execute(array($productId, $_SESSION['user']));
            }
        }
    }

    /**
     * Сохранение корзины, заполненной неавторизованным пользователем, если он авторизовался
     */
    public static function saveSessionCartToDb(){
        if (isset($_SESSION['cartProducts'])) {
            $productsIds = array();
            $productsIds[] = 1;
            $userIds = array();
            $userIds[] = 9;
            $placeholders='';
            foreach ($_SESSION['cartProducts'] as $productId => $productCnt){
                for ($i=0; $i<$productCnt; $i++){
                    $insertValues[] = $productId;
                    $insertValues[] = $_SESSION['user'];
                    $placeholders = $placeholders.'(?,?),';
                }
            }
            $placeholders = substr($placeholders,0,-1);
            $insertValues = array_merge([], array_values($insertValues));
            $db = Db::getConnection();
            $sql = 'INSERT INTO cart (good, user) VALUES '.$placeholders;
            $stmt = $db->prepare($sql);
            $stmt->execute($insertValues);
        }

    }
    /**
     * Подсчет общего числа товаров в корзине
     * @return int
     */
    public static function countProductsInCart()
    {
        if (isset($_SESSION['cartProducts'])) {
            $totalCnt = 0;
            foreach ($_SESSION['cartProducts'] as $productId => $count) {
                $totalCnt += $count;
            }
            return $totalCnt;
        } else {
            return 0;
        }
    }

    /**
     * Возвращает количество заданного товара в корзине
     * @return int
     */
    public static function countProductsInCartById($productId)
    {
        if (isset($_SESSION['cartProducts'])) {
            return $_SESSION['cartProducts'][$productId];
        } else {
            return false;
        }
    }

    /**
     * Получение товаров в корзине
     */
    public static function getCartProducts()
    {
        if (isset($_SESSION['cartProducts'])) {
            return $_SESSION['cartProducts'];
        }
        return false;
    }

}