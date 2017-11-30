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
use Yii;
/**
 * Class PostController
 * 文章控制器
 * @package frontend\controllers
 */
class PostController extends BaseController
{
    /**
     * 引用图片上传组件
     * @return array
     */
    public function actions()
    {
        return [
            'uploads'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],
            'upload'=>[
                'class' => 'common\widgets\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  => "http://web.blog.com",//图片访问路径前缀
                    "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}", //上传保存路径
                    "imageRoot" => Yii::getAlias("@webroot"),
                ]
            ],
        ];
    }
    /**
     * 文章列表
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 添加文章页面
     * @return string
     */
    public function actionCreate()
    {
        $model = new PostForm();
        //定义场景
        $model->setScenario(PostForm::SCENARIOS_CREATE);
        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if (!$model->create()){
                Yii::$app->session->setFlash('warning',$model->_lastError);
            }else{
                return $this->redirect(['post/view','id'=>$model->id]);
            }
        }
        //获得分类
//        $a = new CatModel();
//        $aa = $a->getAllCats();
        $cat = CatModel::getAllCats();
        return $this->render('create', ['model' => $model, 'cat' => $cat]);
    }
}