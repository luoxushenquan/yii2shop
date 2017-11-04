<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/9/10
 * Time: 0:59
 */

class Article extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'Article';
    }
    public function rules()
    {
        return [
            [['intro'], 'string'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 50],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '简介',
            'intro' => '简介',
            'article_category_id'=>'文章分类id',
            'sort' => '排序',
            'status' => '状态',
            'create_time'=>'创建时间'
        ];
    }
}