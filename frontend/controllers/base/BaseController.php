<?php
namespace frontend\controllers\base;

use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: WW
 * Date: 2017/11/28
 * Time: 22:57
 */

/**
 * Class BaseController
 * 基础控制器
 * @package frontend\controllers\base
 */
class BaseController extends Controller
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
        {
           return false;
        }
        return true;
    }
}