<?php

namespace common\models;

use common\models\base\BaseModel;
use Yii;

/**
 * This is the model class for table "posts".
 *  文章模型
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $label_img
 * @property integer $cat_id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $is_valid
 * @property integer $created_at
 * @property integer $updated_at
 */
class PostsModel extends BaseModel
{
    const IS_VALID = 1; //已经发布
    const NO_VALID = 0; //未发布
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['cat_id', 'user_id', 'is_valid', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_img', 'user_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', '自增ID'),
            'title' => Yii::t('common', '标题'),
            'summary' => Yii::t('common', '摘要'),
            'content' => Yii::t('common', '内容'),
            'label_img' => Yii::t('common', '标签图'),
            'cat_id' => Yii::t('common', '分类id'),
            'user_id' => Yii::t('common', '用户id'),
            'user_name' => Yii::t('common', '用户名'),
            'is_valid' => Yii::t('common', '是否有效：0-未发布 1-已发布'),
            'created_at' => Yii::t('common', '创建时间'),
            'updated_at' => Yii::t('common', '更新时间'),
        ];
    }
}
