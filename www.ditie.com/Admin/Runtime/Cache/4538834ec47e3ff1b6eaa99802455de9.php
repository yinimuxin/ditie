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

  <input type="hidden" name="mid" value="<?php echo ($mid); ?>">
  <div class="layui-form-item layui-row layui-col-xs12">
    <label class="layui-form-label">站点名称：</label>
    <div class="layui-input-block">
      <input type="text" name="name" class="layui-input width400 name" value="" lay-verify="required" placeholder="请输入站点名称">
    </div>
  </div>

  <div class="layui-form-item layui-row layui-col-xs12">
    <label class="layui-form-label">顺序：</label>
    <div class="layui-input-block">
      <input type="number" name="sort" class="layui-input width400 sort" value="0" lay-verify="required" placeholder="请输入顺序">
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
                      url:'/admin.php/Station/add',
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