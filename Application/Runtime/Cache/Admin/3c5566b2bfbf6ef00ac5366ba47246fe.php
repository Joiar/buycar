<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/buyCar/Public/Admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/buyCar/Public/Admin/lib/respond.min.js"></script>
<![endif]-->
<link href="/buyCar/Public/Admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/buyCar/Public/Admin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/buyCar/Public/Admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/buyCar/Public/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="/buyCar/Public/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台登录 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
  <div class="loginBox">
    <form id="loginForm" class="form form-horizontal" method="post">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input id="vcode" name="vcode" class="input-text size-L" type="text" placeholder="验证码" style="width:150px;">
          <img id="kanbuq" src="<?php echo U('makeCode');?>">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input id="goLogin" type="button" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright 你的公司名称 by H-ui.admin v3.1</div>
<script type="text/javascript" src="/buyCar/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/buyCar/Public/Admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/buyCar/Public/Admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript">
    // 刷新验证码
    $('#kanbuq').click(function () {
        freshCode();
    });

    function freshCode() {
        $('#vcode').val('');
        $('#kanbuq').attr('src', "<?php echo U('makeCode', ['time' => " + Math.random() + "]);?>");
    }

    $('#goLogin').click(function () {
        var submitBtn = $(this);
        // submitBtn.attr('disabled', true);
        $.post(
            '<?php echo U("login");?>',
            $('#loginForm').serialize(),
            function (data) {
                if (data.status != 1) {
                    submitBtn.attr('disabled', false);
                    freshCode();
                    layer.msg(data.msg, {icon:2,time:1000});
                } else {
                    window.location.href = "<?php echo U('Index/index');?>";
                }
            },
            'json'
        );
    });
</script>
</body>
</html>