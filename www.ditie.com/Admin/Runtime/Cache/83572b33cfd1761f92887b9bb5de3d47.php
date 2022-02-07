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
        <form class="layui-form">
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <select id="mid" name="mid">
                        <option value="">销售员默认全部</option>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <a class="layui-btn search_btn" data-type="reload">搜索</a>
            </div>
        </form>
    </blockquote>

     <div id="main" style="width: 1700px;height:750px;"></div>


<script type="text/javascript" src="__PUBLIC__/Admin/layui-v2/layui.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/echarts.min.js"></script>
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



        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
 
        getlist();

        





    $(".search_btn").click(function(){
        getlist();
    })

    function getlist(){
        $.get("/admin.php/Yingye/getList3",{mid : $("#mid").val()},function(data){
            data = JSON.parse(data);
            console.log(data);
            // 指定图表的配置项和数据
            var option = {
                title: {
                    text: '全年销售额'
                },
                tooltip: {},
                legend: {
                    data:[data.title]
                },
                xAxis: {
                    data: data.date
                },
                yAxis: {},
                series: [{
                    name: data.title,
                    type: 'line',
                    data: data.money
                }]
            };
     
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        })
    }


})
</script>        
</body>
</html>