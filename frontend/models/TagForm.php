<?php
/**
 * Created by PhpStorm.
 * User: WW
 * Date: 2017/11/30
 * Time: 22:52
 */

namespace frontend\models;

use common\models\TagsModel;
use Yii;
use yii\base\Model;

class TagForm extends Model
{
    public $id;
    public $tags;

    public function rules()
    {
        return [
            ['tags', 'required'],
            ['tags', 'each', 'rule'=>['string']],
        ];
    }

    public function saveTag()
    {
        $ids = [];
        if (!empty($this->tags)){
            foreach ($this->tags as $tag){
                $ids[] = $this->_saveTag($tag);
            }
        }
        return $ids;
    }

    /**
     * 保存标签
     * @param $tag
     */
    private function _saveTag($tag)
    {
        $model = new TagsModel();
        $re = $model->find()->where(['tag_name'=>$tag])->one();
        if ($re){
            $re->updateCounters(['post_num'=>1]);
            return $re->id;
        }else{
            $model->tag_name = $tag;
            $model->post_num = 1;
            if (!$model->save()){
                throw new \Exception('标签保存失败');
            }
            return $model->id;
        }

    }
}