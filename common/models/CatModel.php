<?php

namespace common\models;

use common\models\base\BaseModel;
use Yii;

/**
 * This is the model class for table "cats".
 *  分类模型
 * @property integer $id
 * @property string $cat_name
 */
class CatModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', '自增ID'),
            'cat_name' => Yii::t('common', '分类名称'),
        ];
    }

    /**
     * 获得所有分类
     * @return array
     */
    public static function getAllCats()
    {
        $cat = ['0'=>'暂无分类'];
        $res = self::find()->asArray()->all();
        if ($res){
            foreach ($res as $k => $v){
                $cat[$v['id']] = $v['cat_name'];
        }
        }
        return $cat;
    }
}
