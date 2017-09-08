<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\web\Controller;
use yii\web\Request;
use yii\web\UploadedFile;
use flyok666\uploadifive\UploadAction;
class BrandController extends Controller
{

        public function actionAdd(){
            $model = new Brand();
            $request = new Request();
            if($request->isPost){
                $model->load($request->post());
                $model->file = UploadedFile::getInstance($model, 'logo');
                if($model->validate()){
//                //移动文件
//                    $file = '/upload/' . uniqid() . '.' . $model->file->getExtension();//文件名(包含路径)
//                    $model->file->saveAs(\Yii::getAlias('@webroot') . $file, false);
//                    $model->logo = $file;//上传文件的地址复制个头像制度按
//                    $model->save(false);//save方法会默认执行验证
//                    \Yii::$app->session->setFlash('success', '添加成功');
//                    return $this->redirect(['brand/index']);
                    $model->load($request->post());
                    if ($model->validate()) {
                        $model->save();
                        \Yii::$app->session->setFlash('success', '执行成功快来吃鸡吧');
                        return $this->redirect(['brand/index']);
                    }
                } else {
                    var_dump($model->getErrors());
                    exit;
                }
            }
            return $this->render('add',['model'=>$model]);
        }
    public function actionIndex(){
        $brand =Brand::find()->all();
        //分配视图
        return $this->render('index',['brands'=>$brand]);
    }
    public function actionDelete($id){
        //查询商品列表数据
        $goods = Brand::find()->where(['id'=>$id])->one();
        $goods->delete();
        //返回列表
        return $this->redirect(['brand/index']);
    }
    public function actionEdit($id){
        $model = Brand::findOne(['id'=>$id]);
        $request = \Yii::$app->request;
        if($request->isPost){
            $model->load($request->post());
            $model->file = UploadedFile::getInstance($model, 'logo');
            if($model->validate()){
                //移动文件
                $file = '/upload/' . uniqid() . '.' . $model->file->getExtension();//文件名(包含路径)
                $model->file->saveAs(\Yii::getAlias('@webroot') . $file, false);
                $model->logo = $file;//上传文件的地址复制个头像制度按
                $model->save(false);//save方法会默认执行验证
                \Yii::$app->session->setFlash('success', '执行成功');
                return $this->redirect(['brand/index']);
            } else {
                var_dump($model->getErrors());
                exit;
            }
        }
        return $this->render('add',['model'=>$model]);
}

    /////////


    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/uploads',
                'baseUrl' => '@web/upload',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
               // 'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
//                'format' => function (UploadAction $action) {
//                    $fileext = $action->uploadfile->getExtension();
//                    $filename = sha1_file($action->uploadfile->tempName);
//                    return "{$filename}.{$fileext}";
//                },
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $action->output['fileUrl'] = $action->getWebUrl();//输出文件路劲
                    //$action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    //$action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    //$action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                },
            ],
        ];
    }
}
