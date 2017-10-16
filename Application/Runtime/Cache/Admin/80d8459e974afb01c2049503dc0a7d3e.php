<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/buyCar/Public/Admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/buyCar/Public/Admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/buyCar/Public/Admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/buyCar/Public/Admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/buyCar/Public/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/buyCar/Public/Admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/buyCar/Public/Admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/buyCar/Public/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>贷款管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 贷款管理 <span class="c-gray en">&gt;</span> 汽车贷款管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form>
		<div class="text-c"> 日期范围：
			<input type="text" name="start_time" id="countTimestart" onfocus="selecttime(1)" value="<?php echo ($start_time); ?>" size="17" class="date" readonly>
			-
			<input type="text" name="end_time" id="countTimeend" onfocus="selecttime(2)" value="<?php echo ($end_time); ?>" size="17"  class="date" readonly>
            <a id="exportBtn" class="btn btn-success radius">导出</a>
            <a id="exportBtnAll" class="btn btn-success radius">导出所有数据</a>
		</div>
	</form>


	<span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="9">汽车贷款管理</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">用户名</th>
				<th width="90">手机号</th>
				<th width="90">地址</th>
				<th width="130">加入时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
            <?php if(is_array($res)): foreach($res as $key=>$vo): ?><tr class="text-c">
    				<td><input type="checkbox" value="1" name=""></td>
    				<td><?php echo ($vo["id"]); ?></td>
    				<td><?php echo ($vo["username"]); ?></td>
    				<td><?php echo ($vo["mobile"]); ?></td>
    				<td><?php if($vo['product'] != null): echo ($vo["area"]); else: ?>未录入<?php endif; ?></td>
    				<td><?php echo ($vo["addtime"]); ?></td>
    				<td class="td-manage">
					<a title="删除" onclick="admin_del(this, '<?php echo ($vo["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
    			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
    <div id="exportUrl" data-url="<?php echo U('exportData');?>"></div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/buyCar/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/buyCar/Public/Admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/buyCar/Public/Admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/buyCar/Public/Admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/buyCar/Public/Admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/buyCar/Public/Admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

    function selecttime(flag){
        if(flag==1){
            var endTime = $("#countTimeend").val();
            if(endTime != ""){
                WdatePicker({dateFmt:'yyyy-MM-dd',maxDate:endTime})}else{
                WdatePicker({dateFmt:'yyyy-MM-dd'})}
        }else{
            var startTime = $("#countTimestart").val();
            if(startTime != ""){
                WdatePicker({dateFmt:'yyyy-MM-dd',minDate:startTime})}else{
                WdatePicker({dateFmt:'yyyy-MM-dd'})}
        }
    }

    $('#exportBtn').click(function () {
        var startTime = $('#countTimestart').val();
        var endTime = $('#countTimeend').val();
        var exportUrl = $('#exportUrl').attr('data-url');
        window.location.href = exportUrl + '?start_time=' + startTime + '&end_time=' + endTime;
    });

    $('#exportBtnAll').click(function () {
        var exportUrl = $('#exportUrl').attr('data-url');
        window.location.href = exportUrl;
    });

/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/

/*管理员-删除*/
function admin_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url: '<?php echo U("del");?>',
            dataType: 'json',
            data:{"id":id},
            success: function(data){
                if (data.status == 1) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                } else {
                    layer.msg(data.msg, {icon:2,time:1000});
                }
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}


</script>
</body>
</html>