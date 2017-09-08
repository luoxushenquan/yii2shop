<?php
/* @var $this yii\web\View */
?>
<h1>品牌</h1>

<a href="<?=\yii\helpers\Url::to(['brand/add'])?>"class="btn btn-danger">添加商品</a>
<table class="table table-bordered" aria-multiselectable="false">
    <table class="table table-bordered" aria-multiselectable="false">
    <tr>
        <td>id</td>
        <td>名称</td>
        <td>简介</td>
        <td>LOGO</td>
        <td>排序</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    <?php foreach ($brands as $brand):?>
        <tr>
            <td><?=$brand->id?></td>
            <td><?=$brand->name?></td>
            <td><?=$brand->intro?></td>
            <td><img src="<?=$brand->logo?> "style="width: 80px"></td>
            <td><?=$brand->sort?></td>
            <td><?=$brand->status?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['brand/delete','id'=>$brand->id])?>"class="btn btn-danger">删除</a>
                <a href="<?=\yii\helpers\Url::to(['brand/edit','id'=>$brand->id])?>"class="btn btn-danger">修改</a>
            </td>


        </tr>
    <?php endforeach;?>
</table>