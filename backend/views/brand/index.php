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
        <tr data-id="<?=$brand->id?>">
            <td><?=$brand->id?></td>
            <td><?=$brand->name?></td>
            <td><?=$brand->intro?></td>
            <td><img src="<?=$brand->logo?> "style="width: 80px"></td>
            <td><?=$brand->sort?></td>
            <td><?=$brand->status?></td>
            <td>
                <a href="javascript:;"class="del_btn btn btn-default"> <span class="glyphicon glyphicon-trash"></span></a>

                                <a href="<?=\yii\helpers\Url::to(['brand/delete','id'=>$brand->id])?>"class="btn btn-danger">删除</a>
                                <a href="<?=\yii\helpers\Url::to(['brand/edit','id'=>$brand->id])?>"class="btn btn-danger">修改</a>
            </td>


        </tr>
    <?php endforeach;?>
</table>
    <?php

$del_url=\yii\helpers\Url::to(['brand/del']);
//注册js代码
$this->registerJs(new \yii\web\JsExpression(
    <<<JS
$(".del_btn").click(function(){
if(confirm('确定要删除吗？')){
        var tr=$(this).closest('tr');
        var id=tr.attr("data-id");
    $.post("$del_url",{id},function(data){
    if(data == 'success'){
    alert('删除成功');
        tr.hide('show');
    }else{
        alert('删除失败')
    }
    })
}
});
JS


));



    //分页工具条
  echo \yii\widgets\LinkPager::widget([
      'pagination'=>$perPage
  ]);