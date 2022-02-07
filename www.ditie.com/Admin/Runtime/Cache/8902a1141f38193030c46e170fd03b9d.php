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
            <input type="hidden" id="rid" name="rid" value="<?php echo ($_SESSION['user']['rid']); ?>">
            <input type="hidden" id="bid" name="bid" value="<?php echo ($_SESSION['user']['bid']); ?>">
            <input type="hidden" id="uid" name="uid" value="<?php echo ($_SESSION['user']['id']); ?>">
    </blockquote>

    <table id="List" lay-filter="List"></table>



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
        url : '/admin.php/List/getList',
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limit : 20,
        limits : [10,15,20,25],
        id : "ListTable",
        cols : [[
            {field: 'week', title: '周', width:100, align:'center',templet:function(d){
                if (d.week==1) {
                	return "第一周";
                }
                if (d.week==2) {
                	return "第二周";
                }
                if (d.week==3) {
                	return "第三周";
                }
                if (d.week==4) {
                	return "第四周";
                }
                if (d.week==5) {
                	return "第五周";
                }
                if (d.week==6) {
                	return "第六周";
                }
                if (d.week==7) {
                	return "第七周";
                }
                if (d.week==8) {
                	return "第八周";
                }
                if (d.week==9) {
                	return "第九周";
                }
                if (d.week==10) {
                	return "第十周";
                }
            }},
            {field: 'sort', title: '星期', width:100, align:'center',templet:function(d){
                if (d.sort==1) {
                	return "星期一";
                }
                if (d.sort==2) {
                	return "星期二";
                }
                if (d.sort==3) {
                	return "星期三";
                }
                if (d.sort==4) {
                	return "星期四";
                }
                if (d.sort==5) {
                	return "星期五";
                }
            }},
            {field: 'kid1', title: '第一节', minWidth:100, align:'center',templet:function(d){
                return returnName(d.kecheng1,d.bid1,d.uid1);
            }},
            {field: 'kid2', title: '第二节', minWidth:100, align:'center',templet:function(d){
                return returnName(d.kecheng2,d.bid2,d.uid2);
            }},
            {field: 'kid3', title: '第三节', minWidth:100, align:'center',templet:function(d){
                return returnName(d.kecheng3,d.bid3,d.uid3);
            }},
            {field: 'kid4', title: '第四节', minWidth:100, align:'center',templet:function(d){
                return returnName(d.kecheng4,d.bid4,d.uid4);
            }},
            {field: 'kid5', title: '第五节', minWidth:100, align:'center',templet:function(d){
                return returnName(d.kecheng5,d.bid5,d.uid5);
            }},
            {field: 'kid6', title: '第六节', minWidth:100, align:'center',templet:function(d){
                return returnName(d.kecheng6,d.bid6,d.uid6);
            }},
            {field: 'kid7', title: '第七节', minWidth:100, align:'center',templet:function(d){
                return returnName(d.kecheng7,d.bid7,d.uid7);
            }},
            {field: 'kid8', title: '第八节', minWidth:100, align:'center',templet:function(d){
                return returnName(d.kecheng8,d.bid8,d.uid8);
            }},
            {field: 'kid9', title: '晚间课', minWidth:100, align:'center',templet:function(d){
                return returnName(d.kecheng9,d.bid9,d.uid9);
            }}
        ]]
    });

    function returnName(data,bid,uid){
    	if (data!=null) {
			if ($("#rid").val()==1) {
	           return data.name;
	        }
			if ($("#rid").val()==2) {
				if ($("#uid").val()==uid) {
	            	return "<span style='color:#00FF00'>"+data.name+"</span>";
				}
	            return data.name;
	        }
			if ($("#rid").val()==3) {
				if ($("#bid").val()==bid) {
	            	return "<span style='color:#00FF00'>"+data.name+"</span>";
				}
	            return data.name;
	        }
    	}
        return "未知";
    }



})
</script>        
</body>
</html>