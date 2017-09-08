<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m170907_083735_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),

            'name'=>$this->string(50)->comment('����'),
            'intro'=>$this->text()->comment('���'),
            'logo'=>$this->string()->comment('logo'),
            'sort'=>$this->string()->comment('����'),
            'status'=>$this->smallInteger(2)->comment('״̬'),

        ]);
    }

    /**
     * @inheritdoc
     *
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}
