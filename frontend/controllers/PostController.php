<?php
/**
 * Created by PhpStorm.
 * User: WW
 * Date: 2017/11/28
 * Time: 23:02
 */

namespace frontend\controllers;


use frontend\controllers\base\BaseController;
use frontend\models\PostForm;
use common\models\CatModel;

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

    public function actionCreate()
    {
        $model = new PostForm();
        //获得分类
//        $a = new CatModel();
//        $aa = $a->getAllCats();
        $cat = CatModel::getAllCats();
        return $this->render('create', ['model' => $model, 'cat' => $cat]);
    }
}