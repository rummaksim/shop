<?php


class Product
{
    const LIMIT_PRODUCTS_ON_PAGE = 9;
    /**
     * Получение списка категорий товаров
     */
    public static function getCategories()
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name FROM category'
            .' ORDER BY sort_order ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }

    /**
     * Получение имени категории по её id
     * @param bool $category_id
     * @return mixed
     */
    public static function getCategoryNameById($category_id = false){
        if ($category_id) {
            $db = Db::getConnection();
            $sql = 'SELECT name FROM category WHERE id = ?';
            $stmt = $db->prepare($sql);
            $stmt->execute(array($category_id));
            $category_name= $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $category_name[0]['name'];
        }
    }

    /**
     * Получение списка товаров заданной категории
     * @param bool $category
     * @param int $countProducts
     * @return array
     */
    public static function getProductsByCategory($category = false, $page=1){
        if ($category) {
            $db = Db::getConnection();
            $offset = self::LIMIT_PRODUCTS_ON_PAGE * ($page-1);
            $sql = 'SELECT * FROM products WHERE category = :category ORDER BY id LIMIT :limit OFFSET :offset';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':limit', (int) self::LIMIT_PRODUCTS_ON_PAGE, PDO::PARAM_INT);
            $stmt->bindValue(':category', (int) $category, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stmt->execute();
            //$stmt->execute(array($category));
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        }
    }

    /**
     * Получение общего кол-ва товаров заданной категории (для Pagination)
     * @param bool $category
     * @return mixed
     */
    public static function getCountProductsByCategory($category = false){
        if ($category) {
            $db = Db::getConnection();
            $sql = 'SELECT count(id) AS cnt FROM products WHERE category = ?';
            $stmt = $db->prepare($sql);
            $stmt->execute(array($category));
            $stmt->execute();
            //$stmt->execute(array($category));
            $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $count[0]['cnt'];
        }
    }

    /**
     * Получение продукта по его id
     * @param bool $product_id
     * @return array
     */
    public static function getProductById($product_id=false){
        if ($product_id){
            $db = Db::getConnection();
            $sql = 'SELECT * FROM products WHERE id = ?';
            $stmt = $db->prepare($sql);
            $stmt->execute(array($product_id));
            $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $product[0];
        }
    }

    /**
     * Получение списка продуктов по их идентификаторам
     * @param bool $productsIds
     * @return mixed
     */
    public static function getProductsByIds($productsIds=false){
        if ($productsIds){
            $in  = str_repeat('?,', count($productsIds) - 1) . '?';
            $db = Db::getConnection();
            $sql = "SELECT * FROM products WHERE id IN ($in)";
            $stmt = $db->prepare($sql);
            $stmt->execute($productsIds);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        }
    }

    /**
     * Получение числа существующих категорий
     */
    public static function getCategoriesCount(){
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(*) AS cnt FROM db_xiaomi_shop.category';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $categoriesCount = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return intval($categoriesCount[0]['cnt']);
    }

    /**
     * Добавление товара в БД
     * @param $params
     */
    public static function addProduct($params){
        $db = Db::getConnection();
        $sql = 'INSERT INTO products (name, description, cost, category, image_path) VALUES (?,?,?,?,?)';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($params['name'],$params['description'],$params['cost'],$params['category'],$params['image_path']));
    }

}