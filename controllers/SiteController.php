<?php


class SiteController
{
    /**
     * Отображение главной страницы
     */
    public function actionMain(){
        require_once('views/main.php');
        return true;
    }
}