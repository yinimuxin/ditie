<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>管理</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="__PUBLIC__/Admin/layui-v2/css/layui.css" media="all" />
<link rel="stylesheet" href="__PUBLIC__/Admin/css/public.css" media="all" />
<link rel="stylesheet" href="__PUBLIC__/Admin/css/all.css" media="all" />
</head>
<body class="childrenBody">
<form id="mainfrom" class="layui-form" style="width:80%;">

  <div class="layui-form-item layui-row layui-col-xs12">
    <label class="layui-form-label">姓名：</label>
    <div class="layui-input-block">
      <input type="text" name="name" class="layui-input width200 name" value="" lay-verify="required" placeholder="请输入姓名">
    </div>
  </div>

  <div class="layui-form-item layui-row layui-col-xs12">
    <label class="layui-form-label">年龄：</label>
    <div class="layui-input-block">
      <input type="number" name="age" class="layui-input width200 age" value="" lay-verify="required" placeholder="请输入年龄">
    </div>
  </div>

    <div class="layui-form-item layui-row layui-col-xs12">
      <label class="layui-form-label">性别：</label>
      <div class="layui-input-block" style="display: flex; align-items: center;">
        <select id="sex" name="sex">
              <option value="男">男</option>
              <option value="女">女</option>
        </select>
      </div>
    </div>

  <div class="layui-form-item layui-row layui-col-xs12">
    <label class="layui-form-label">职业：</label>
    <div class="layui-input-block">
      <input type="text" class="layui-input width400 zhiye" value="销售员" disabled="disabled">
      <input type="hidden" name="zhiye"value="销售员">
    </div>
  </div>

  <div class="layui-form-item layui-row layui-col-xs12">
    <label class="layui-form-label">备注：</label>
    <div class="layui-input-block">
      <input type="text" name="content" class="layui-input width600 content" value="" lay-verify="required" placeholder="请输入备注">
    </div>
  </div>


  <div class="layui-form-item layui-row layui-col-xs12">
    <div class="layui-input-block">
      <button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="add">立即保存</button>
      <button type="reset" id="reset" class="layui-btn layui-btn-sm layui-btn-primary">取消</button>
    </div>
  </div>

</form>

<script type="text/javascript" src="__PUBLIC__/Admin/layui-v2/layui.js"></script>
<script>
layui.use(['form','layer','layedit','laydate','upload'],function(){
    var form = layui.form
        layer = parent.layer === undefined ? layui.layer : top.layer,
        laypage = layui.laypage,
        upload = layui.upload,
        layedit = layui.layedit,
        laydate = layui.laydate,
        $ = layui.jquery;
        form.on("submit(add)",function(data){
            
            var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
            	$.ajax({
                      url:'/admin.php/Member/add',
                      type:'post',           //post提交
                      dataType:"json",        //json格式
                      data:$("#mainfrom").serialize(),    
                      success:function(data){
                            if(data.status!=1){

                              layer.msg(data.info);
                              
                            }else{
                                setTimeout(function(){
                                    top.layer.close(index);
                                    top.layer.msg(data.info);
                                    layer.closeAll("iframe");
                                    //刷新父页面
                                    parent.location.reload();
                                },2000);
                            }
                            
                        },
                        error:function(XmlHttpRequest,textStatus,errorThrown){
                            layer.msg('操作失败:服务器处理失败');
                        }
               	});
                
		        return false;
		});

        $("#reset").on("click",function(){
            layer.closeAll("iframe");
            parent.location.reload();
        });

    


})
</script>
</body>
</html>