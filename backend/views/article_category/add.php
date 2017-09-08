<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/9/7
 * Time: 16:56
 */
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->textInput();
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'sort')->textInput();
echo $form->field($model,'status')->radioList([-1=>'删除',0=>'隐藏',1=>'显示']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn_info']);
\yii\bootstrap\ActiveForm::end();