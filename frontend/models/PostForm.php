<?php
/**
 * Created by PhpStorm.
 * User: WW
 * Date: 2017/11/29
 * Time: 18:11
 */

namespace frontend\models;

use common\models\PostsModel;
use Yii;
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
     * 定义场景
     * SCENARIOS_CREATE 创建
     * SCENARIOS_UPDATE 更新
     */
    const SCENARIOS_CREATE = 'create';
    const SCENARIOS_UPDATE = 'update';

    /**
     * 场景设置
     * @return array
     */
    public function scenarios()
    {
        $scenarios = [
            self::SCENARIOS_CREATE => ['title', 'content', 'label_img', 'cat_id', 'tags'],
            self::SCENARIOS_UPDATE => ['title', 'content', 'label_img', 'cat_id', 'tags'],
        ];
        return array_merge(parent::scenarios(),$scenarios) ;
    }

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
            'label_img' => Yii::t('common','LabelImg'),
            'tags' => Yii::t('common','Tags'),
            'cat_id' => Yii::t('common','Cat'),
        ];
    }

    /**
     * 文章创建
     * @return bool
     */
    public function create()
    {
        //食物
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $model = new PostsModel();
            $model->setAttributes($this->attributes);
            $model->summary = $this->_getSummary();
            $model->user_id = Yii::$app->user->identity->id;
            $model->user_name = Yii::$app->user->identity->username;
            $model->is_valid = PostsModel::IS_VALID;
            $model->created_at = time();
            $model->updated_at = time();
            if (!$model->save())
                throw new \Exception('文章保存失败');

            $this->id = $model->id;

            //调用事件
            $this->_eventAfterCreate();


            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();//回滚
            $this->_lastError =$e->getMessage();//记录异常
            return false;
        }
    }

    /**
     * 获取文章摘要
     * @param int $s
     * @param int $e
     * @param string $char
     * @return null|string
     */
    private function _getSummary($s=0, $e=100, $char='utf-8')
    {
        if (empty($this->content))
            return null;
        return mb_substr(str_replace('&nbsp;','',strip_tags($this->content)),$s,$e);

    }

    private function _eventAfterCreate()
    {

    }
}