<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m170907_160851_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */

    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),

        'name'=>$this->string(50)->comment('Ãû³Æ'),
        'intro'=>$this->text()->comment('¼ò½é'),
         'sort'=>$this->integer(11)->comment('ÅÅÐò'),
         'status'=>$this->integer(2)->comment('-1É¾³ý 0Òþ²Ø 1Õý³£')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
