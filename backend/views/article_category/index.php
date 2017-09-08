<?php
/* @var $this yii\web\View */
?>
<h1>品牌</h1>

<a href="<?=\yii\helpers\Url::to(['article_category/add'])?>"class="btn btn-danger">添加商品</a>
<table class="table table-bordered" aria-multiselectable="false">
    <table class="table table-bordered" aria-multiselectable="false">
    <tr>
        <td>id</td>
        <td>名称</td>
        <td>简介</td>
        <td>排序</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    <?php foreach ($rows as $row):?>
        <tr>
            <td><?=$row->id?></td>
            <td><?=$row->name?></td>
            <td><?=$row->intro?></td>
            <td><?=$row->sort?></td>
            <td><?=$row->status?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['article_category/delete','id'=>$row->id])?>"class="btn btn-danger">删除</a>
                <a href="<?=\yii\helpers\Url::to(['article_category/edit','id'=>$row->id])?>"class="btn btn-danger">修改</a>
            </td>


        </tr>
    <?php endforeach;?>
</table>