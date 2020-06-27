<?php


class User
{
    /**
     * Проверка email на корректность
     * @param $email
     * @return bool
     */
    public static function checkEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    /**
     * Проверка логина на корректнотсь
     * @param $name
     * @return bool
     */
    public static function checkName($name){
        if (strlen($name)>=4){
            return true;
        }
        return false;
    }

    /**
     * Проверка пароля на корректность
     * @param $password
     * @return bool
     */
    public static function checkPassword($password){
        if (strlen($password)>=6){
            return true;
        }
        return false;
    }

    /**
     * Проверка на то, что пользователя с заданным email нет
     * @param $email
     * @return bool
     */
    public static function checkEmailExists($email){
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(*) as cnt FROM users WHERE email = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $queryRes = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['cnt'];
        if ($queryRes){
            return true;
        }
        return false;
    }

    /**
     * Регистрация пользователя - внесение рег. данных в БД.
     * @param $email
     * @param $name
     * @param $password
     * @return bool
     */
    public static function register($email, $name, $password){
        $db = Db::getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        //обычный пользователь
        $privilege = 2;
        $sql = 'INSERT INTO users (login, pwd, privilege, email) VALUES (?,?,?,?)';
        $stmt = $db->prepare($sql);
        return $stmt->execute(array($name, $hashedPassword, $privilege, $email));
    }

    /**
     * Проверка правильности введенных данных
     * @param $login
     * @param $password
     */
    public static function checkUserLoginInput($email, $password){
        $db = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE email=?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user[0]['pwd'])){
            return $user[0]['id'];
        }
        return false;
    }

    /**Сохранение пользователя в сессию
     * @param $userId
     */
    public static function auth($userId){
        $_SESSION['user']=$userId;
    }

    /**
     * Проверка, авторизован ли пользователь, или он гость
     * @return bool
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Проверка, является ли пользователь администратором
     * @return bool
     */
    public static function isAdmin(){
        if (isset($_SESSION['user'])){
            $db = Db::getConnection();
            $sql = 'SELECT privilege FROM users WHERE id=?';
            $stmt = $db->prepare($sql);
            $stmt->execute(array($_SESSION['user'][0]));
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($user) {
                if ($user[0]['privilege'] == 1) {
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }


    public static function checkProductName($productName = false){
        if ($productName){
            if ((gettype($productName)==='string') && (strlen($productName)>=1)){
                return true;
            }
            return false;
        }
        return false;
    }

    public static function checkProductCost($productCost = false){
        if ($productCost){
            $productCost = intval($productCost);
            if ($productCost>0){
                return true;
            }
            return false;
        }
        return false;
    }

    public static function checkProductDescription($productDescription = false){
        if ($productDescription){
            if ((gettype($productDescription)==='string') && (strlen($productDescription)>=1)){
                return true;
            }
            return false;
        }
        return false;
    }

    public static function checkProductCategory($productCategory = false){
        if ($productCategory){
            $productCategory = intval($productCategory);
            if (($productCategory>0) && ($productCategory<=Product::getCategoriesCount())){
                return true;
            }
            return false;
        }
        return false;
    }


}