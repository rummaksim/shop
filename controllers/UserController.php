<?php


class UserController
{
    /**
     * Проверка полей, регистрация пользователя, сохранение в БД
     * @return bool
     */
    public function actionRegister(){

        if (!User::isGuest()){
            header("Location: /");
        }

        #var_dump($_POST);
        //если submit существует - форма была отправлена
        $email='';
        $name='';
        $registration = false;
        if (isset($_POST['submit'])){
            $email = $_POST['email'];
            $name = $_POST['name'];
            $password = $_POST['password'];

            $error_list = false;
            if (!User::checkEmail($email)){
                $error_list[] = 'Некорректный email';;
            }
            if (!User::checkName($name)){
                $error_list[] = 'Имя должно содержать хотя бы 4 символа';
            }
            if (!User::checkPassword($password)){
                $error_list[] = 'Пароль должен содержать хотя бы 6 символов';
            }
            if (User::checkEmailExists($email)){
                $error_list[]='Такой email уже используется';
            }
            if ($error_list == false){
                $registration = User::register($email, $name, $password);
            }
        }
        require_once ROOT . '/views/registration.php';
        return true;
    }

    /**
     * Проверка полей, вход пользователя
     */
    public static function actionLogin(){

        if (!User::isGuest()){
            header("Location: /");
        }
        $email = '';
        $password = '';
        if (isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $error_list = false;

            $userId = User::checkUserLoginInput($email, $password);
            if (!$userId){
                $error_list[] = "Неверный логин или пароль";
            }else{
                User::auth($userId);
                Cart::saveSessionCartToDb();
                Cart::setUserCartFromDb();
                header("Location: /");
            }
        }
        require_once ROOT . '/views/login.php';
        return true;
    }

    /**
     * Выход пользователя из аккаунта
     */
    public static function actionLogout(){
        unset($_SESSION['user']);
        unset ($_SESSION['cartProducts']);
        header("Location: /");
        return true;
    }

    public static function actionAdmin($category){
        if (!User::isAdmin()){
            header("Location: /");
            return true;
        }
        $params['name'] = '';
        $params['description']='';
        $params['category']='';
        $params['cost'] = '';
        if (isset($_POST['submit'])){
            $error_list = false;
            $params['name'] = $_POST['tovarname'];
            $params['description']=$_POST['message'];
            $params['category']=$_POST['tovarcategory'];
            $params['cost'] = $_POST['tovarcost'];

            if (!User::checkProductName($params['name'])){
                $error_list[] = 'Неверное имя товара';
            }

            if (!User::checkProductDescription($params['description'])){
                $error_list[] = 'Неверное описание товара';
            }

            if (!User::checkProductCategory($params['category'])){
                $error_list[] = 'Неверная категория товара';
            }

            if (!User::checkProductCost($params['cost'])){
                $error_list[] = 'Неверная стоимость товара';
            }

            if ($error_list===false) {
                if (isset($_FILES['tovarpic']['name'])) {
                    if ((0 == $_FILES['tovarpic']['error']) &&
                        (($_FILES['tovarpic']['type'] === 'image/png') || ($_FILES['tovarpic']['type'] === 'image/jpeg')) &&
                        is_uploaded_file($_FILES['tovarpic']['tmp_name'])) {
                        move_uploaded_file($_FILES['tovarpic']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/assets/img/' . $_FILES['tovarpic']['name']);
                        $params['image_path'] = 'assets/img/' . $_FILES['tovarpic']['name'];
                    }
                    else{
                        $error_list[] = 'Неверное изображение товара';
                    }
                }else{
                    $error_list[] = 'Ошибка при загрузке товара';
                }
            }
            if ($error_list===false){
                Product::addProduct($params);
                $params['name'] = '';
                $params['description']='';
                $params['category']='';
                $params['cost'] = '';
            }
        }
        require_once ROOT . '/views/admin-panel.php';
        return true;
    }
}