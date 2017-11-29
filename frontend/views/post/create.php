<?php
/**
 * Created by PhpStorm.
 * User: WW
 * Date: 2017/11/29
 * Time: 18:43
 */
use yii\bootstrap\activeForm;
use yii\bootstrap\html;

$this->title = '创建';
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['/post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="panel-title box-title">
            <span>创建文章</span>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin()?>

            <?=$form->field($model,'title')->textInput(['maxlenghth' => true])?>

            <?=$form->field($model,'cat_id')->dropDownList($cat)?>

            <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload',[
                'config'=>[
                    //图片上传的一些配置，不写调用默认配置
                    'domain_url' => 'http://web.blog.com',
                ]
            ]) ?>


            <?=$form->field($model,'content')->textInput(['maxlenghth' => true])?>

            <?=$form->field($model,'tags')->textInput(['maxlenghth' => true])?>

           <div class="form-group">
                <?=Html::submitButton(Yii::t('common','Publish'), ['class'=>'btn btn-success'])?>
           </div>

            <?php ActiveForm::end()?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel-title box-title">
            <span>注意事项</span>
        </div>
        <div class="panel-body">
            <p>1,sanjkkjkjkj</p>
            <p>2,sanjkkjkjkj</p>
            <p>3,sanjkkjkjkj</p>
            <p>4,sanjkkjkjkj</p>
        </div>
    </div>

</div>
