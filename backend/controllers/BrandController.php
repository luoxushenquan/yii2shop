<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Request;
use yii\web\UploadedFile;
use flyok666\uploadifive\UploadAction;
use flyok666\qiniu\Qiniu;
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
        //分页
  $query = Brand::find()->where(['!=','status',-1]);
        //总条数
        $total =$query->count();
        //实例化分页工具类
        $perPage = new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>3
        ]);




        $brand =$query->limit($perPage->limit)->offset($perPage->offset)->all();
        //分配视图
        return $this->render('index',['brands'=>$brand,'perPage'=>$perPage]);
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
    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                //更改过
                'basePath' => '@webroot/upload',
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
                    'extensions' => ['jpg', 'png','gif'],
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
                    //$action->getWebUrl(); //  "baseUrl + filename, /upload/im 、=]
                        //wsrl'  8
                        //';lkjhgfdsazxcvbnm,./ge/yyyymmddtimerand.jpg"
                    //$action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"


//                    $config = [
//                        'accessKey'=>'41InI-3JIW8QeoyP8dGu6XYv9QUNYq9ehDk7DT4m',
//                        'secretKey'=>'xEMR1dU2oyTkt6vouPLuZwOBtdaFm_cGJVHWDWvN',
//                        'domain'=>'http://demo.domain.com/',
//                        'bucket'=>'yiishop',
//                        'area'=>Qiniu::AREA_HUADONG
//                    ];
//
////七牛云上传
//                    $qiniu = new Qiniu($config);
//                    $key = $action->getWebUrl();
////                    var_dump($key);exit;
//                    $file=$action->getSavePath($key);
//                    //上传文件到七牛云  同时制定一个key
//                    $qiniu->uploadFile($file,$key);
//                    //获取七牛云上文件的地址
//                    $url = $qiniu->getLink($key);
////                    var_dump($url);exit;
//                    $action->output['fileUrl'] = $url;


                },
            ],
        ];
    }

    //删除品牌
    public function actionDel(){
        $id=\Yii::$app->request->post('id');
        $model = Brand::findOne(['id'=>$id]);
        if($model){
            $model->status= -1;
            $model->save(false);
            return  'success';
        }
        return 'fail';

    }



    //骑牛晕
    public function actionqiniu(){

        $config = [
            'accessKey'=>'41InI-3JIW8QeoyP8dGu6XYv9QUNYq9ehDk7DT4m',
            'secretKey'=>'xEMR1dU2oyTkt6vouPLuZwOBtdaFm_cGJVHWDWvN',
            'domain'=>'http://demo.domain.com/',
            'bucket'=>'yiishop',
            'area'=>Qiniu::AREA_HUADONG
        ];

//七牛云上传
        $qiniu = new Qiniu($config);
        $key = '1.jpg';
        $file=\yii::getAlias('@webroot/upload/q.jpg');

        //上传文件到七牛云  同时制定一个key
        $qiniu->uploadFile($_FILES['tmp_name'],$key);
        //获取七牛云上文件的地址
        $url = $qiniu->getLink($key);

    }

}
