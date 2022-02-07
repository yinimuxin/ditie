<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>管理</title>
<link rel="stylesheet" href="__PUBLIC__/Admin/layui-v2/css/layui.css" media="all" />
<link rel="stylesheet" href="__PUBLIC__/Admin/css/all.css" media="all" />
</head>
<body>
    <blockquote class="layui-elem-quote quoteBox">
        <form class="layui-form">
            <div class="layui-inline">
                <div class="layui-input-inline">
                  <select id="nian" name="nian">
                    <option value="2019">2019年</option>
                    <option value="2020">2020年</option>
                    <option value="2021">2021年</option>
                    <option value="2022">2022年</option>
                    <option value="2023">2023年</option>
                  </select>
                </div>
                <div class="layui-input-inline">
                  <select id="yue" name="yue">
                    <option value="01">1月</option>
                    <option value="02">2月</option>
                    <option value="03">3月</option>
                    <option value="04">4月</option>
                    <option value="05">5月</option>
                    <option value="06">6月</option>
                    <option value="07">7月</option>
                    <option value="08">8月</option>
                    <option value="09">9月</option>
                    <option value="10">10月</option>
                    <option value="11">11月</option>
                    <option value="12">12月</option>
                  </select>
                </div>
                <a class="layui-btn search_btn" data-type="reload">核算</a>
            </div>
        </form>
    </blockquote>

    <table id="List" lay-filter="List"></table>



<script type="text/javascript" src="__PUBLIC__/Admin/layui-v2/layui.js"></script>
<script type="text/javascript">
layui.use(['form','layer','table','laytpl','util','upload'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        upload = layui.upload,
        laytpl = layui.laytpl,
        table = layui.table,
        savetag = null,
        util = layui.util;

    var tableIns = null;
    
    search();


    $(".search_btn").click(function(){
    	search();
    })

    function search(){
		tableIns = table.render({
	        elem: '#List',
	        url : '/admin.php/Yingye/getList4?nian='+$("#nian").val()+"&yue="+$("#yue").val(),
	        cellMinWidth : 95,
	        page : true,
	        height : "full-125",
	        limit : 20,
	        limits : [10,15,20,25],
	        id : "ListTable",
	        cols : [[
	            {field: 'id', title: 'ID', width:100, align:"center"},
	            {field: 'name', title: '销售员', minWidth:100, align:'center'},
	            {field: 'date', title: '时间', minWidth:100, align:'center'},
	            {field: 'money', title: '销售额', minWidth:100, align:'center'},
	            {field: 'jiangjin', title: '奖金', minWidth:100, align:'center'}
	        ]]
	    });
    }

})
</script>        
</body>
</html>