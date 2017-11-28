<?php
/**
 * Created by PhpStorm.
 * User: WW
 * Date: 2017/11/28
 * Time: 23:02
 */

namespace frontend\controllers;


use frontend\controllers\base\BaseController;

/**
 * Class PostController
 * 文章控制器
 * @package frontend\controllers
 */
class PostController extends BaseController
{
    /**
     * 文章列表
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}