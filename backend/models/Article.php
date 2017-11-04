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
            'name' => '���',
            'intro' => '���',
            'article_category_id'=>'���·���id',
            'sort' => '����',
            'status' => '״̬',
            'create_time'=>'����ʱ��'
        ];
    }
}