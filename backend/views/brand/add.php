<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/9/7
 * Time: 16:56
 */
use yii\web\JsExpression;
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->textInput();
echo $form->field($model,'intro')->textarea();

echo $form->field($model,'logo')->hiddenInput();



//外部TAG
echo \yii\bootstrap\Html::fileInput('test', NULL, ['id' => 'test']);
echo \flyok666\uploadifive\Uploadifive::widget([
    'url' => yii\helpers\Url::to(['s-upload']),
    'id' => 'test',
    'csrf' => true,
    'renderTag' => false,
    'jsOptions' => [
        'formData'=>['someKey' => 'someValue'],
        'width' => 120,
        'height' => 40,
        'onError' => new JsExpression(<<<EOF
function(file, errorCode, errorMsg, errorString) {
    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
}
EOF
        ),
        'onUploadComplete' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        console.log(data.msg);
    } else {
        console.log(data.fileUrl);
        //将上传文件的路劲写入logo隐藏域
        $("#brand-logo").val(data.fileUrl);
        //图片回显
        $("#img").attr("src",data.fileUrl);
    }
}
EOF
        ),
    ]
]);




//====================
//输出img标签
//echo \yii\bootstrap\Html::img($model->logo,['id'=>'img']);
echo \yii\bootstrap\Html::img($model->logo,['id'=>'img']);
echo $form->field($model,'sort')->textInput();
echo $form->field($model,'status')->radioList(['影藏','正常']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn_info']);
\yii\bootstrap\ActiveForm::end();