<?php
/**
 * Created by PhpStorm.
 * User: WW
 * Date: 2017/11/29
 * Time: 18:11
 */

namespace frontend\models;

use yii;
use yii\base\Model;

/**
 * Class PostForm
 * 文章表单模型
 * @package frontend\models
 */
class PostForm extends Model
{
    public $id;
    public $title;
    public $content;
    public $label_img;
    public $cat_id;
    public $tags;

    public $_lastError = '';

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'title', 'content', 'cat_id'], 'required'],
            [['id', 'cat_id'], 'integer'],
            ['title', 'string', 'min' => 4, 'max' => 50]
        ];

    }

    /**
     * 语言包
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','ID'),
            'title' => Yii::t('common','Title'),
            'content' => Yii::t('common','Content'),
            'label_img' => Yii::t('common','Label_img'),
            'tags' => Yii::t('common','Tags'),
        ];
    }

}