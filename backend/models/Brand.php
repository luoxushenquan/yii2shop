<?php

namespace backend\models;
//namespace frontend\models;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property string $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
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
        [['logo', 'sort'], 'string', 'max' => 255],
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
            'logo' => 'logo',
            'sort' => '排序',
            'status' => '状态',
        ];
    }

}
