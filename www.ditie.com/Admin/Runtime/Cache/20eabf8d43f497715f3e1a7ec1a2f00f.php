<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($_SESSION['system']['name']); ?>-管理系统</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Access-Control-Allow-Origin" content="*">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link rel="icon" href="/favicon.ico">
<link rel="stylesheet" href="__PUBLIC__/Admin/layui/css/layui.css" media="all" />
<link rel="stylesheet" href="__PUBLIC__/Admin/css/index.css" media="all" />
<link rel="stylesheet" href="__PUBLIC__/Admin/css/public.css" media="all" />
</head>
<body class="main_body">
	<div class="layui-layout layui-layout-admin">
		<!-- 顶部 -->
		<section>
			<div class="layui-header header">
				<div class="layui-main mag0">
					<a href="#" class="logo">管理系统</a>
					<!-- 显示/隐藏菜单 -->
					<a href="javascript:;" class="seraph hideMenu icon-caidan"></a>
				    <!-- 顶部右侧菜单 -->
				    <ul class="layui-nav top_menu">
						<li class="layui-nav-item" pc>
							<a href="javascript:;" class="clearCache"><i class="layui-icon" data-icon="&#xe640;">&#xe640;</i><cite>清除缓存</cite><span class="layui-badge-dot"></span></a>
						</li>
						<li class="layui-nav-item" id="userInfo">
							<a href="javascript:;">
								<img src="__PUBLIC__/Admin/images/logo.png" class="layui-nav-img userAvatar" width="35" height="35">
								<cite class="adminName"><?php echo ($_SESSION['user']['name']); ?></cite
									></a>
							<dl class="layui-nav-child">
								<dd><a href="<?php echo U('Login/logout');?>" class="signOut"><i class="seraph icon-tuichu"></i><cite>退出</cite></a></dd>
							</dl>
						</li>
					</ul>
				</div>
			</div>
		</section>
		<!-- 左侧导航 -->
		<section>
			<div class="layui-side layui-bg-black">
				<div class="user-photo">
					<a class="img" title="LOGO" ><img src="__PUBLIC__/Admin/images/logo.png" class="userAvatar"></a>
					<p>你好！<span class="userName"><?php echo ($_SESSION['user']['name']); ?>
				</span>, 欢迎登录</p>
				</div>
				<div class="navBar layui-side-scroll" id="navBar">
					<ul class="layui-nav layui-nav-tree">
						
					</ul>
				</div>
			</div>
		</section>
		<!-- 右侧内容 -->
		<section>
			<div class="layui-body layui-form">
				<div class="layui-tab mag0" lay-filter="bodyTab" id="top_tabs_box">
					<ul class="layui-tab-title top_tab" id="top_tabs">
						<li class="layui-this" lay-id=""><i class="layui-icon">&#xe68e;</i> <cite>首页</cite></li>
					</ul>
					<ul class="layui-nav closeBox">
					  <li class="layui-nav-item">
					    <a href="javascript:;"><i class="layui-icon caozuo">&#xe643;</i> 页面操作</a>
					    <dl class="layui-nav-child">
						  <dd><a href="javascript:;" class="refresh refreshThis"><i class="layui-icon">&#x1002;</i> 刷新当前</a></dd>
					      <dd><a href="javascript:;" class="closePageOther"><i class="seraph icon-prohibit"></i> 关闭其他</a></dd>
					      <dd><a href="javascript:;" class="closePageAll"><i class="seraph icon-guanbi"></i> 关闭全部</a></dd>
					    </dl>
					  </li>
					</ul>
					<div class="layui-tab-content clildFrame">
						<div class="layui-tab-item layui-show">
							<div>
								<iframe src="<?php echo U('/Index/main');?>"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section>
			<div class="layui-footer footer">
					<p><span><?php echo ($_SESSION['system']['footer']); ?></span></p>
			</div>
		</section>
	</div>

	<!-- 移动导航 -->
	<div class="site-tree-mobile"><i class="layui-icon">&#xe602;</i></div>
	<div class="site-mobile-shade"></div>
	
<script type="text/javascript" src="__PUBLIC__/Admin/layui/layui.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/jquery.form.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/js/cache.js"></script>
<script type="text/javascript">
var $,tab,dataStr,layer;
layui.config({
	base : "/Public/Admin/js/"
}).extend({
	"bodyTab" : "bodyTab"
})
layui.use(['bodyTab','form','element','layer','jquery'],function(){
	var form = layui.form,
		element = layui.element;
		$ = layui.$;
    	layer = parent.layer === undefined ? layui.layer : top.layer;
		tab = layui.bodyTab({
			openTabNum : "50",  //最大可打开窗口数量
			url : "/admin.php/Index/getmenu" //获取菜单json地址
		});

	//通过顶部菜单获取左侧二三级菜单   注：此处只做演示之用，实际开发中通过接口传参的方式获取导航数据
	function getData(){
		$.getJSON(tab.tabConfig.url,function(data){
			var menu = [];
			for (var i = data.length - 1; i >= 0; i--) {
				if(data[i].pid==0){
					menu.push(data[i]);
				}
			}
			for (var i = 0; i < menu.length; i++){
				for (var j = 0; j < menu.length; j++){
					if (menu[i].sort < menu[j].sort){
					  	var t = menu[i];
					  	menu[i] = menu[j];
					  	menu[j] = t;
					}
				}
			}
			for (var i = 0; i < menu.length; i++) {
				menu[i].children = [];
				for (var j = 0; j < data.length; j++) {
					if (menu[i].id==data[j].pid) {
						menu[i].children.push(data[j]);
					}
				}
			}
			dataStr=menu;
			tab.render();
		},"json")
	}

	//页面加载时判断左侧菜单是否显示
	//通过顶部菜单获取左侧菜单
	$(".topLevelMenus li,.mobileTopLevelMenus dd").click(function(){
		if($(this).parents(".mobileTopLevelMenus").length != "0"){
			$(".topLevelMenus li").eq($(this).index()).addClass("layui-this").siblings().removeClass("layui-this");
		}else{
			$(".mobileTopLevelMenus dd").eq($(this).index()).addClass("layui-this").siblings().removeClass("layui-this");
		}
		$(".layui-layout-admin").removeClass("showMenu");
		$("body").addClass("site-mobile");
		getData($(this).data("menu"));
		//渲染顶部窗口
		tab.tabMove();
	})

	//隐藏左侧导航
	$(".hideMenu").click(function(){
		if($(".topLevelMenus li.layui-this a").data("url")){
			layer.msg("此栏目状态下左侧菜单不可展开");  //主要为了避免左侧显示的内容与顶部菜单不匹配
			return false;
		}
		$(".layui-layout-admin").toggleClass("showMenu");
		//渲染顶部窗口
		tab.tabMove();
	})

	//通过顶部菜单获取左侧二三级菜单   注：此处只做演示之用，实际开发中通过接口传参的方式获取导航数据
	// getData("1");
	getData();
	//手机设备的简单适配
    $('.site-tree-mobile').on('click', function(){
		$('body').addClass('site-mobile');
	});
    $('.site-mobile-shade').on('click', function(){
		$('body').removeClass('site-mobile');
	});

	// 添加新窗口
	$("body").on("click",".layui-nav .layui-nav-item a:not('.mobileTopLevelMenus .layui-nav-item a')",function(){
		//如果不存在子级
		if($(this).siblings().length == 0){
			addTab($(this));
			$('body').removeClass('site-mobile');  //移动端点击菜单关闭菜单层
		}
		$(this).parent("li").siblings().removeClass("layui-nav-itemed");
	})

	//清除缓存
	$(".clearCache").click(function(){
		window.sessionStorage.clear();
        window.localStorage.clear();
        var index = layer.msg('清除缓存中，请稍候',{icon: 16,time:false,shade:0.8});
        setTimeout(function(){
            layer.close(index);
            layer.msg("缓存清除成功！");
        },1000);
    })

	//刷新后还原打开的窗口
    if(cacheStr == "true") {
        if (window.sessionStorage.getItem("menu") != null) {
            menu = JSON.parse(window.sessionStorage.getItem("menu"));
            curmenu = window.sessionStorage.getItem("curmenu");
            var openTitle = '';
            for (var i = 0; i < menu.length; i++) {
                openTitle = '';
                if (menu[i].icon) {
                    if (menu[i].icon.split("-")[0] == 'icon') {
                        openTitle += '<i class="seraph ' + menu[i].icon + '"></i>';
                    } else {
                        openTitle += '<i class="layui-icon">' + menu[i].icon + '</i>';
                    }
                }
                openTitle += '<cite>' + menu[i].title + '</cite>';
                openTitle += '<i class="layui-icon layui-unselect layui-tab-close" data-id="' + menu[i].layId + '">&#x1006;</i>';
                element.tabAdd("bodyTab", {
                    title: openTitle,
                    content: "<iframe src='" + menu[i].href + "' data-id='" + menu[i].layId + "'></frame>",
                    id: menu[i].layId
                })
                //定位到刷新前的窗口
                if (curmenu != "undefined") {
                    if (curmenu == '' || curmenu == "null") {  //定位到后台首页
                        element.tabChange("bodyTab", '');
                    } else if (JSON.parse(curmenu).title == menu[i].title) {  //定位到刷新前的页面
                        element.tabChange("bodyTab", menu[i].layId);
                    }
                } else {
                    element.tabChange("bodyTab", menu[menu.length - 1].layId);
                }
            }
            //渲染顶部窗口
            tab.tabMove();
        }
    }else{
		window.sessionStorage.removeItem("menu");
		window.sessionStorage.removeItem("curmenu");
	}
})

//打开新窗口
function addTab(_this){
	$.getJSON("/admin.php/Login/checkSession",function(data){
			if(data){
				tab.tabAdd(_this);
			}else{
				window.parent.location="/admin.php/Login/index";
			}
	},"json");
}
</script>

</body>
</html>