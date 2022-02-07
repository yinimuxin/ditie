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
                  <select id="nian" name="nian">
                    <option value="">年份默认全部</option>
                    <option value="2019">2019年</option>
                    <option value="2020">2020年</option>
                    <option value="2021">2021年</option>
                    <option value="2022">2022年</option>
                    <option value="2023">2023年</option>
                  </select>
                </div>
                <div class="layui-input-inline">
                  <select id="yue" name="yue">
                    <option value="">月份默认全部</option>
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
                <div class="layui-input-inline">
                    <select id="mid" name="mid">
                        <option value="">销售员默认全部</option>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <a class="layui-btn search_btn" data-type="reload">搜索</a>
            </div>
                <a href="<?php echo U('Yingye/xiazai');?>" class="layui-btn layui-btn-warm">下载模板</a>
                <a class="layui-btn layui-btn-normal" id="xuanze">选择文件</a>
                <a class="layui-btn" id="shangchuan">开始上传</a>
        </form>
    </blockquote>

    <table id="List" lay-filter="List"></table>

    <script type="text/html" id="ListBar">
        <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
    </script>


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

    //列表
    var tableIns = table.render({
        elem: '#List',
        url : '/admin.php/Yingye/getList',
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limit : 20,
        limits : [10,15,20,25],
        id : "ListTable",
        cols : [[
            {field: 'id', title: 'ID', width:100, align:"center"},
            {field: 'mname', title: '销售员', minWidth:100, align:'center'},
            {field: 'date', title: '时间', minWidth:100, align:'center'},
            {field: 'money', title: '销售额', minWidth:100, align:'center'},
            {title: '操作', maxWidth:200, templet:'#ListBar',fixed:"right",align:"center"}
        ]]
    });

    $(".add").on("click",function(){
        add();
    });


    $(".search_btn").click(function(){
        tableIns.reload({
            where:{
                nian:$("#nian").val(),
                yue:$("#yue").val(),
                mid:$("#mid").val()
            }
        });
    })

    function add(){
        var index = layui.layer.open({
            title : "添加页面",
            type : 2,
            content : "add.html",
            success : function(layero, index){
                form.render();
                setTimeout(function(){
                    layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)

                layui.layer.full(index);
                window.sessionStorage.setItem("index",index);
                //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
                $(window).on("resize",function(){
                    layui.layer.full(window.sessionStorage.getItem("index"));
                })

            },
        })
    }

    function edit(data){
        var index = layui.layer.open({
            title : "修改页面",
            type : 2,
            content : "edit.html?id="+data.id,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                form.render();
                setTimeout(function(){
                    layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)

                layui.layer.full(index);
                window.sessionStorage.setItem("index",index);
                //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
                $(window).on("resize",function(){
                    layui.layer.full(window.sessionStorage.getItem("index"));
                })

            },
        })
    }

    //批量上传
    upload.render({
        elem: '#xuanze',
        url: '/admin.php/Yingye/daoru',
        auto: false,
        accept: 'file',
        multiple: true,
        bindAction: '#shangchuan',
        done: function(res){
            layer.msg(res.title);
            tableIns.reload();
        }
    });

    //列表操作
    table.on('tool(List)', function(obj){
        var Event = obj.event,
        Data = obj.data;
        if (Event === 'edit') {
            edit(Data);
        }
        if (Event === 'del') {
            layer.confirm('您确定要删除这条信息？',{icon:3,title:'提示信息'},function(index){
                $.get("/admin.php/Yingye/del",{
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