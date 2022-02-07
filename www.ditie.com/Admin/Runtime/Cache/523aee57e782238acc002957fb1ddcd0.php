<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>管理</title>
<link rel="stylesheet" href="__PUBLIC__/Admin/layui-v2/css/layui.css" media="all" />
<link rel="stylesheet" href="__PUBLIC__/Admin/css/all.css" media="all" />
</head>
<body>
    <blockquote class="layui-elem-quote quoteBox">
    	<div style="display: flex;justify-content: center;">
		    <div style="display: flex;align-items: center;">
		      <input type="text" id="startname" class="layui-input width200 startname" value="" placeholder="请输入起始站">&nbsp;&nbsp;-&nbsp;&nbsp;
		      <input type="text" id="endname" class="layui-input width200 endname" value="" placeholder="请输入终点站">&nbsp;&nbsp;&nbsp;&nbsp;
	          <a class="layui-btn layui-btn-normal search">查询票价</a>
		    </div>
    	</div>
    </blockquote>

    <table id="List" lay-filter="List"></table>

    <script type="text/html" id="ListBar">
        <a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="pay">支付下单</a>
    </script>


<script type="text/javascript" src="__PUBLIC__/Admin/layui-v2/layui.js"></script>
<script type="text/javascript">
layui.use(['form','layer','table','laytpl','util'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table,
        savetag = null,
        util = layui.util;

    var tableIns = null;


    $(".search").on("click",function(){
    	if ($("#startname").val()=='') {
            layer.msg('起始站不能空');
    		return false;
    	}
    	if ($("#endname").val()=='') {
            layer.msg('终点站不能空');
    		return false;
    	}
    	if ($("#startname").val()==$("#endname").val()) {
            layer.msg('起始站与终点站不能一样');
    		return false;
    	}
        load();
    });

    function load(){
    	tableIns = table.render({
	        elem: '#List',
	        url : '/admin.php/Piao/search?startname='+$("#startname").val()+'&endname='+$("#endname").val(),
	        cellMinWidth : 95,
	        height : "full-125",
	        id : "ListTable",
	        cols : [[
	            {field: 'mname', title: '线路', minWidth:100, align:'center'},
	            {field: 'startname', title: '起始站', width:200, align:'center'},
	            {field: 'endname', title: '终点站', width:200, align:'center'},
	            {field: 'num', title: '经历站数', width:200, align:'center'},
	            {field: 'money', title: '价格/元', width:200, align:'center',templet:function(d){
	                return d.money+"元";
	            }},
	            {field: 'date', title: '预计时间/分', width:200, align:'center',templet:function(d){
	                return d.date+"分钟";
	            }},
	            {title: '操作', maxWidth:200, templet:'#ListBar',fixed:"right",align:"center"}
	        ]]
	    });
    }


    //列表操作
    table.on('tool(List)', function(obj){
        var Event = obj.event,
        Data = obj.data;
        if (Event === 'pay') {
            layer.confirm('支付下单？',{icon:3,title:'提示信息'},function(index){
                $.post("/admin.php/Order/pay",{
                    mname : Data.mname,
                    startname : Data.startname,
                    endname : Data.endname,
                    num : Data.num,
                    money : Data.money,
                    date : Data.date
                },function(data){
                    data = JSON.parse(data);
                    if (data.status!=1) {
                        layer.msg(data.info);
                    }else{
                        layer.msg(data.info,{icon:1,time: 500,offset:'t'},function(){
                            tableIns.reload();
                            layer.close(index);
                        });
                    }
                })
            });
        }

    });

})
</script>        
</body>
</html>