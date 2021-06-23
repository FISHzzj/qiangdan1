<?php defined('IN_IA') or exit('Access Denied');?><!-- 04124120 -->
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $info['storename'];?></title>
<style type="text/css">
body {margin:0px; width:100%;background:#f4f4f4; font-family:'微软雅黑';}
.top {overflow:hidden; background:#fff; border-bottom:1px solid #ddd;height:auto;}
.top .bgimg {height:auto; position:relative;}
.top .bgimg img {width:100%; position: relative; }
.top .bgimg .shopimg {height:45px; width:45px; background:#ccc; position:absolute; left:10px; bottom:7px;  box-shadow:0px 0px 2px rgba(0,0,0,0.1);}
.top .bgimg .shopimg img {height:45px; width:45px;}
.top .bgimg .shopname {height:40px; width:auto; position:absolute; left:65px; bottom:20px;  line-height:40px; font-size:14px; color:#fff; text-shadow:2px 2px 2px rgba(0,0,0,0.2);}
.top .bgimg .set {height:24px; width:24px; position:absolute; top:10px; right:10px; font-size:24px; color:#fff; text-align:center; line-height:24px;}
.top .nav {height:100px; padding:0px 0px 5px 5px; text-align:center;line-height: 28px;border-top: 1px solid #fff;}
.top .nav .sub {height:50px; <?php  if($shop['selectcategory']==1) { ?>width:23%;<?php  } else { ?>width:33%;<?php  } ?>float:left;position: relative;line-height: 50px;text-align: center;}
.top .nav .sub span {font-size:18px; color:#000; line-height:22px;}
.top .nav .sub nav {font-size:14px; color:#000;}
#num{font-size: 12px;color: #000;}
.goods {height:auto; min-height:100px; width:100%; background:#fff; overflow:hidden;float:left;padding-bottom:40px;} 
.goods .good {overflow:hidden; width:50%; padding:0px 2% 10px; float:left;margin-top: 8px;}
.goods .good .img {width:100%;overflow:hidden;}
.goods .good .img img {width:100%;}
.goods .good .name {height:20px; width:100%; font-size:15px; line-height:20px; color:#666; overflow:hidden;}
.goods .good .price {height:20px; width:100%; color:#f03; font-size:14px;}
.goods .good .price span {color:#aaa; font-size:12px; text-decoration:line-through;}
.title1 {height:40px;width: 100%;background:#fff;  font-size:16px; color:#666; line-height:40px;    border-bottom: 1px solid #ddd;}
ul#navlist{font-size:14px; padding-bottom: 13px;}
ul#navlist li{ float: left; height: 40px; line-height: 40px; width: 20%; text-align: center;}
ul#navlist li a{ text-decoration: none; display: block;width: 100%; height: 40px;color: #000000; }
.activex a{ color: #ff1c1d!important; border-bottom: 1px #ff1c1d solid; }
.banner {overflow:hidden;position:relative;height:auto;}
.banner  .main_image{width:100%;position:relative;top:0;left:0;}
.banner .main_image ul{}
.banner .main_image li{float:left;}
.banner .main_image li img{display:block;width:100%;}
.banner .main_image li a{display:block;width:100%;}

    div.flicking_con{position:absolute;bottom:10px;z-index:1;width:100%;height:12px;}
    div.flicking_con .inner { width:100%;height:9px;text-align:center;}
    div.flicking_con a{position:relative; width:10px;height:9px;background:url('../addons/sz_yi/template/mobile/default/static/images/dot.png') 0 0 no-repeat;display:inline-block;text-indent:-1000px}
    div.flicking_con a.on{background-position:0 -9px}
    #index_loading { width:94%;padding:10px;color:#666;text-align: center;float:left;}
    .search {height:40px; width:100%;    text-align: center; margin:5px 0; background:transparent; color:#ccc; line-height:40px; font-size:14px; position: fixed;top:0px;z-index: 999;}
       .title {height:40px; width:94%; background:#fff; padding:0px 3%; font-size:16px; color:#666; line-height:40px;}
        .copyright {height:40px; width:100%; text-align:center; line-height:40px; font-size:12px; color:#999; margin:10px 0 54px;}
        .alert {
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background-color: rgba(0, 0, 0, .5);
			z-index: 55555;
			display:none;
			height: 100%;

		}

		.alert-bg {
			position: relative;
			width: 280px;
			height: 310px;
			background-color: #fff;
			border-radius: 10px;
			text-align: center;
            margin: 120px auto 0 auto;
			

		}
		.close-alert {
			display: inline-block;
			width: 20px;
			height: 20px;
			border-radius: 50%;
			background-color: #ccc;
			line-height: 20px;
			position: absolute;
			top: -10px;
			right: -10px;

		}
        .alert-bg-title{height: 50px;width: 100%;line-height: 78px;text-align: center;font-size: 16px;font-weight: 650;}
		.alert-bg .img {
			width: 100%;
			height: 100%;
			
		}
        .alert-bg-titleL{border-bottom: 1px dotted #999;margin-top: 10px;padding-top: 17px;}
        .alert-bg-img{ width: 150px;
            height: 150px;margin:21px auto 0 auto;
            background: red;padding: 6px 6px;}
        .alert-bg-img>p{background: #fff;padding:10px;border-radius: 5px;}
		canvas{
		
           width: 100%;
           height: 100%;
		}
        .alert_bg_p{text-align: center;margin-top: 10px;}
	.topbar {
    position: fixed;
    top: 0px;
    width: 100%;
    z-index: 100;
    height: 40px;
    font-size: 16px;
    line-height: 40px;
    text-align: center;
    color: #666;
}
.topbar a {
    height: 40px;
    width: 30px;
    display: block;
    float: left;
    margin-left: 10px;
    outline: 0px;
    color: #999;
    font-size: 24px;
    text-align: left;
}
.search {
    height: 30px;
    width: 75%;
    left: 11%;
    margin: 5px 0 0 0;
    background: rgba(0,0,0,0.3);
    color: #fff;
    line-height: 30px;
    font-size: 16px;
    text-align: center;
    position: fixed;
    top: 3px;
    z-index: 100;
    border-radius: 20px;
}
.fa-angle-left {
    color: #fff;
}
/* 新 */
.wrap{height: 60px;background: rgba(0, 0, 0, 0.50);position: relative;}
.erweima{position: absolute;right: 15px;top:5px;font-size: 12px;color: white;}
.f-colorwhite{color: white;}
.notice{width: 75px;height: 28px;border-radius: 15px;color: white;line-height: 18px;text-align: center;font-size: 12px;position: absolute;right: 10px;bottom: 18px;}
.lianxi{right: 80px;}
</style>
<!-- <div class='search'>
    <div style="width:10%;height:34px;display: inline-block;text-align: center;"  onclick='history.back()'><img style="width:80%;height: 80%;"  src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/Left_Arrow5.png"/></div>
    
    <div style="width: 78%;display: inline-block;" id='search'>
        <div id='input' style="display: inline-block;width: 80%;border-bottom: 1px solid #fff;height: 33px;"><i class="fa fa-search"></i><text style="display: inline-block;margin-left:10px ;">在店铺内搜索</text>            
        </div>
        <div style="display: inline-block;width: 14%;font-size: 16px;transform:translateY(4px) ;-webkit-transform:translateY(4px);">搜索</div>
    </div>
</div> -->
<div class="topbar"><a href="javascript:history.back()"><i class="fa fa-angle-left"></i></a>
    <div class='search'>
        <i class="fa fa-search"></i> 在店铺内搜索
    </div>
    <span style="display: block; margin-right: 17px;margin-top: 1px;float: right;" id="QR">
        <img src="../addons/sz_yi/plugin/supplier/template/mobile/default/img/timg.png" style="width:20px;height:20px;"/>
    </span>  
</div>
<div id="container"></div>
<div class="alert">
	<div class="alert-bg">
        <div class="alert-bg-title">某某官方旗舰店</div>
        <div class="alert-bg-titleL"></div>
		<span class="close-alert">X</span>
        <div class="alert-bg-img">
            <p id="qrcode" class='img'></p>
        </div>
        <div class="alert_bg_p">扫一扫,关注我们吧</div>
	</div>
</div>
<script id="tpl_main" type="text/html">
<div class="top" >
    <div style="width: 100%;height: 100%;background:#fff">
    	<div class="bgimg" style="background:url(<%if signboard%>
            ../attachment/<%signboard%>
            <%else%>
            ../addons/sz_yi/template/mobile/style1/static/images/bg7.png
            <%/if%>)no-repeat top;background-size: 100%;">
	       	<div style="height:123px ;"></div>
            <div class="f-cb wrap">
    	        <div class="shopimg"><img src="<%if logo%> ../attachment/<%logo%> <%else%> ../addons/sz_yi/icon.jpg <%/if%>"></div>
    	        <div class="shopname"><%storename%></div>
    	        <div style="height:40px; width:auto; position:absolute; left:65px; bottom:0px; font-size:14px; line-height:49px; font-size:14px; color:#fff; ">
                     销量：<%to ? to : 0%>
                </div>
                <!-- <div class="erweima" id="QR">
                    <span class="f-colorwhite">二维码</span>
                    <span style="width: 15px;height: 15px;">
                        <img src="../addons/sz_yi/plugin/supplier/template/mobile/default/img/timg.png" style="width:15px;height:15px;"/>
                    </span>                   
                </div> -->

                <div class="notice lianxi" onclick="location.href='<?php  echo $this->createMobileUrl('shop/talking',array('id'=>$uid))?>'">
                    <i class="iconfont" style="font-size: 26px;">&#xe63f;</i><br>
                    <span>联系商家</span>
                </div>
                <div class="notice" id='fav' style="line-height: 19px;"> 
                    <i class="iconfont" style="font-size: 23px;">&#xe614;</i><br>
                    <span id='favspan'>关注店铺</span>
                </div>
               <!--  <div class="notice lianxi" onclick="location.href='<?php  echo $this->createMobileUrl('shop/talking',array('id'=>$uid))?>'">联系商家</div>
               <div class="notice" id='fav'>关注</div> -->
            </div>
	        <!--<div class="set"><i class="fa fa-cog fa-spin"></i></div>-->
	    </div>   	
    </div>
   
</div>

<div class="title1">
    <ul id="navlist">
        <li id="activexall" onclick="tab('all')" class="activex"><a href="javascript:void(0);">全部商品</a></li>
        <li id="activex1"onclick="tab(1)"><a href="javascript:void(0);">新品</a></li>
        <li id="activex2" onclick="tab(2)"><a href="javascript:void(0);">热卖</a></li>
        <li id="activex3" onclick="tab(3)"><a href="javascript:void(0);">推荐</a></li>
        <li id="activex4" onclick="tab(4)"><a href="javascript:void(0);">促销</a></li>
        <!-- <li id="activex5" onclick="tab('5')"><a href="javascript:void(0);">包邮</a></li> -->
    </ul>
</div>
<div class="goods">
    <div id='goods_container'></div>
</div>  
</script>
 <script type="text/javascript">
 	$(window).scroll(function(e){
 		//console.log(e)
 		var top = $(document).scrollTop() ;
 		if(top>100&&top<240){
 			$('.search').css({'background':'#fff','color':'#000','top':'-5px','opacity':0.4});
 			$('.search').find('img').attr('src','/addons/sz_yi/plugin/supplier/template/mobile/default/img/Left_Arrow1.png')
 			$('#input').css('border-bottom','1px solid #000');
 			
 		
 		}else if(top>=240){
 			$('.search').css('opacity',1);
 			$('.title1').css({'position':'fixed','top':'40px'})
 			
 		}else{
 			$('.search').css({'background':'transparent','color':'#fff','top':'0px'});
 			$('#input').css('border-bottom','1px solid #fff');
 			$('.search').find('img').attr('src','/addons/sz_yi/plugin/supplier/template/mobile/default/img/Left_Arrow.png');
 			$('.title1').css('position',''); 
 			$('.search').css('opacity',1);
 		}
 	});
 	//点击二维码
 	$('#QR').click(function(){
// 		$('body').css('overflow','hidden');

		var scrollTop = $('body').scrollTop();
		$('body').css({
		    'overflow':'hidden',
		    'position': 'fixed',
		    'top': scrollTop*-1
		});
 		
 		$('.alert').css('display','block');
 		$('.close-alert').click(function(){
 			$('.alert').css('display','none');			
// 			$('body').css('overflow','auto');
			$('body').css({
			    'overflow':'auto',
			    'position': 'static',
			    'top': 'auto'
			});
 			
 		});
 		
 	});
 </script>
<script id='tpl_goods_list' type='text/html'>

    <%each goods as g%>
    <div class="good" data-goodsid='<%g.id%>'>
        <div class='img'><img src="<%g.thumb%>"></div>
        <div class="name"><%g.title%></div>
        <div class="price">￥<%g.marketprice%> <%if g.productprice>0 && g.marketprice!=g.productprice%><span>￥<%g.productprice%></span><%/if%></div>
    </div>
    <%/each%>

</script>

 <script id='tpl_search_list' type='text/html'>
     <ul>
     <%each list as value%>
        <li><i class="fa fa-angle-right"></i> <a href="<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%value.id%>"><%value.title%></a></li>
        <%/each%>
    </ul> 
</script>
<!--搜索-->
<div class="search1"> 
    <div class="topbar1">
        <div class='right'>
            <button class="sub1"><i class="fa fa-search"></i></button>
            <div class="home1">取消</div>
        </div>
        <div class='left_wrap'> 
            <div class='left'>
                <input type="text" id='keywords' class="input1" placeholder='请输入店铺名'/>
            </div>
        </div>
    </div>
    <div id='search_container' class='result1'>
    </div>
</div>
<script type="text/javascript">

require(['../addons/sz_yi/static/js/jquery.qrcode.min.js'], function(){
    $('#qrcode').qrcode({
        render: 'canvas',
        width: 180,
        height:220,
        
        text: '<?php  echo $qrurl;?>'
    });
})

var page = 1;
var loaded = false;
var stop = true;
var type = 1;

function tab(n) {
    $('#goods_container').empty();

    $('#activex' + n).addClass('activex');
    $('#activex' + n).siblings().removeClass('activex');
    type = n;
    page = 1;
    loaded = false;
    stop = true;
    window.getGoods(n);
}
require(['tpl', 'core'], function(tpl, core) {
    // 搜索店铺
    $('.search').click(function(){
        $(".search1").animate({bottom:"0px"},100);
        $('#keywords').focus();
        $('#keywords').unbind('keyup').keyup(function(){
            var keywords = $.trim( $(this).val());
            if(keywords==''){
                $('#search_container').html("");
                return;
            }
            core.pjson('supplier/store',{op:'searchgoods',keywords:keywords }, function (json) {
                console.log(json);
                var result = json.result;
                if(result.list.length > 0){
                    $('#search_container').html(tpl('tpl_search_list', result));
                } else {
                    $('#search_container').html("");
                }
             }, true);
        });
        $('.search1 .sub1').unbind('click').click(function(){
            return;
            var keywords = $.trim( $('#keywords').val());
            var url = core.getUrl('supplier/store',{keywords:keywords});
            location.href=  url;
        });
        $('.search1 .home1').unbind('click').click(function(){
            $(".search1").animate({bottom:"-100%"},100);
            // $('#keywords').val('');
            // $('#search_container').html("");
        });
    });
    // End 搜索店铺
    window.getGoods = function(type) {

        core.pjson('supplier/store', {
            'op': 'mystore',
            page: page,
            type: type
        }, function(gjson) {
            // console.log(gjson);
            var result = gjson.result;
            if (result.status == 0) {
                core.message('服务器内部错误', core.getUrl('supplier/store'), 'error');
                return;
            }

            $('#fav').click(function() {
                core.pjson('supplier/store', {op : 'favorite'}, function(json) {
                    console.log(json);
                    if (json.status == 1) {
                        $('#favspan').text("已关注");
                        
                        // $('.fa-star').css({'color':'#ff9800'});
                        core.tip.show("关注成功");
                        $("#fav i").css('color','#ffb403');
                    } else {
                      /*  $('.fa-star').css({'color':'#9e9e9e'});*/
                        $('#favspan').text("关注店铺");
                        core.tip.show("已取消关注");
                        $("#fav i").css('color','white');
                    }
                }, true);
            });

            stop = true;
            $('#index_loading').remove();
            $('#goods_container').append(tpl('tpl_goods_list', result));


            $('.good img').each(function() {
                $(this).height($(this).width());
            })

            $('.good').unbind('click').click(function() {
                location.href = core.getUrl('shop/detail', {
                    id: $(this).data('goodsid')
                });
            })
            if (result.goods.length < result.pagesize) {

                $('#goods_container').append('<div id="index_loading">已经加载全部商品</div>');
                loaded = true;
                $(window).scroll = null;
                return;
            }

            //自动加载
            $(window).scroll(function() {

                if (loaded) {
                    return;
                }
                totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
                if ($(document).height() <= totalheight) {
                    if (stop == true) {
                        stop = false;
                        $('#goods_container').append('<div id="index_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载更多商品</div>');
                        page++;
                        getGoods(type);
                    }
                }
            });
        });
    }
    core.pjson('supplier/store', {
        'op' : 'mystore'
    }, function(json) {
        console.log(json);
        var info = json.result.info;
        console.log(info.isfavorite);
        $('#container').html(tpl('tpl_main', info));
        if (info.isfavorite == 0) { // 已收藏
           /* $(".fa-star").css('color','#ff9800');*/
            $('#favspan').text("已关注");
            $("#fav i").css('color','#ffb403');
        } else { // 未收藏
           /* $('.fa-star').css({'color':'#9e9e9e'});*/
            $('#favspan').text("关注店铺");
            $("#fav i").css('color','white');
        }
       
        //获取首页商品
        getGoods();
    }, true);
});

</script>
<?php  if(1) { ?>
<?php  $show_footer=true;$footer_current ='first'?> 
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<script type="text/javascript">
    // alert("<?php  echo $info['description']?>");
    // 微信分享
    require(['http://res.wx.qq.com/open/js/jweixin-1.0.0.js'], function(wx){
        /*微信JSSDK接口*/
        wx.config({
            debug: false,
            appId: '<?php  echo $signPackage["appId"];?>',
            timestamp: '<?php  echo $signPackage["timestamp"];?>',
            nonceStr: '<?php  echo $signPackage["nonceStr"];?>',
            signature: '<?php  echo $signPackage["signature"];?>',
            jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo']
        });
        wx.ready(function(){
            var data = {
                title: "<?php  echo $info['storename']?>", // 分享标题
                link: "<?php  echo $this->createPluginMobileUrl('supplier/store', array('op' => 'skip','storeid' => $info['storeid']))?>", // 分享链接
                desc: "<?php  echo $info['description']?>",
                imgUrl: "<?php  echo tomedia($info['logo'])?>", // 分享图标
                success: function () { 
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            };
            wx.onMenuShareTimeline(data);
            wx.onMenuShareAppMessage(data);
            wx.onMenuShareQQ(data);
            wx.onMenuShareWeibo(data);
        });
    });
</script>