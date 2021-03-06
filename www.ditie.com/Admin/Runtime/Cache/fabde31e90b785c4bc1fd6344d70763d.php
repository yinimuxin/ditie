<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>管理</title>
<link rel="stylesheet" href="__PUBLIC__/Admin/layui-v2/css/layui.css" media="all" />
<link rel="stylesheet" href="__PUBLIC__/Admin/css/all.css" media="all" />
</head>
<body>
    <blockquote class="layui-elem-quote quoteBox">
            <H2>购票记录</H2>
    </blockquote>

    <table id="List" lay-filter="List"></table>

    <script type="text/html" id="ListBar">
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

    //列表
    var tableIns = table.render({
        elem: '#List',
        url : '/admin.php/UserOrder/getList',
        cellMinWidth : 95,
        height : "full-125",
        limit : 20,
        limits : [10,15,20,25],
        id : "ListTable",
        cols : [[
                {field: 'mname', title: '线路', minWidth:100, align:'center'},
                {field: 'startname', title: '起始站', width:150, align:'center'},
                {field: 'endname', title: '终点站', width:150, align:'center'},
                {field: 'num', title: '经历站数', width:150, align:'center'},
                {field: 'money', title: '价格/元', width:100, align:'center',templet:function(d){
                    return d.money+"元";
                }},
                {field: 'date', title: '预计时间/分', width:150, align:'center',templet:function(d){
                    return d.date+"分钟";
                }},
                {field: 'uname', title: '用户', width:200, align:'center'},
                {field: 'state', title: '状态', width:100, align:'center',templet:function(d){
                    if (d.state==1) {
                        return "已使用";
                    }
                    return "未使用";
                }},
                {title: '操作', width:200, templet:'#ListBar',fixed:"right",align:"center",templet:function(d){
                    if (d.state==1) {
                        return "已完成";
                    }else{
                        return "<a class='layui-btn layui-btn-xs' lay-event='shiyong'>使用</a>";
                    }
                }}
        ]]
    });

    //列表操作
    table.on('tool(List)', function(obj){
        var Event = obj.event,
        Data = obj.data;
        if (Event === 'shiyong') {
            layer.confirm('您确定要使用？',{icon:3,title:'提示信息'},function(index){
                $.get("/admin.php/Order/shiyong",{
                    id : Data.id,
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