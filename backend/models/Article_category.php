<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/9/8
 * Time: 0:24
 */
namespace backend\models;
class Article_category extends \yii\db\ActiveRecord{
//    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intro'], 'string'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 50],
//            [['sort'],'require'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'sort' => '排序',
            'status' => '状态',
        ];
    }
}