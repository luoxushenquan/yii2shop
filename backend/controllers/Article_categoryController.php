<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/9/8
 * Time: 0:23
 */
namespace backend\controllers;
use backend\models\Article_category;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Request;


class Article_categoryController extends Controller
{
    public function actionAdd()
    {
        $model = new Article_category();
        $request = new Request();
        if ($request->isPost) {
//            var_dump($_POST);exit;
            $model->load($request->post());
            if ($model->validate()) {
                $model->save();
                \Yii::$app->session->setFlash('success', '执行成功快来吃鸡吧');
                return $this->redirect(['article_category/index']);
            }
//            var_dump($request->post());exit;
//            var_dump($model->load($request->post()));exit;
//            return $this->redirect('index');
        }
        return $this->render('add', ['model' => $model]);
    }


    public function actionIndex()
    {
//分页
        //分页
        $query = Article_category::find();
        //总条数
        $total =$query->count();
        //实例化分页工具类
        $perPage = new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>3
        ]);




        $rows =$query->limit($perPage->limit)->offset($perPage->offset)->all();
        //分配视图
        return $this->render('index',['rows'=>$rows,'perPage'=>$perPage]);
    }

//
//
//        $rows = Article_category::find()->all();
//        //分配视图
//        return $this->render('index', ['rows' => $rows]);
//    }

    public function actionDelete($id)
    {
        //查询商品列表数据
        $goods = Article_category::find()->where(['id' => $id])->one();
        $goods->delete();
        //返回列表
        return $this->redirect(['article_category/index']);
    }
    public function actionEdit($id){
        $model = Article_category::findOne(['id'=>$id]);
        $request = \Yii::$app->request;
        if ($request->isPost) {
//            var_dump($_POST);exit;
            $model->load($request->post());
            if ($model->validate()) {
                $model->save();
                \Yii::$app->session->setFlash('success', '执行成功快来吃鸡吧');
                return $this->redirect(['article_category/index']);
            }
//            var_dump($request->post());exit;
//            var_dump($model->load($request->post()));exit;
//            return $this->redirect('index');
        }
        return $this->render('add', ['model' => $model]);
}
}
