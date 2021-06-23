<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>优惠券领取中心</title>
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/plugin/coupon/template/mobile/default/images/style.css">
<style type="text/css">
    body {margin:0px; background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;overflow-x: hidden;}
    a {text-decoration:none;}

	
	#coupon_loading { width:94%;padding:10px;color:#666;text-align: center;}
	.category_group {background:#fff; border-bottom:1px solid #efefef;border-top:1px solid #efefef; height:45px;overflow: auto;  overflow-y: hidden;   list-style-type:none; ;white-space:nowrap; -webkit-overflow-scrolling: touch;}
	.category_group .container{font-size: 15px;z-index: -1; ;  height:45px;overflow: auto; list-style-type:none;white-space:nowrap; }
	.category_group  .item {height:45px; width:auto; overflow: hidden; line-height:45px; text-decoration: none; color:#656565 ; text-align: center; padding: 9px 25px;; }
	.category_group  .item.on  { border-bottom:2px solid #e45050;}
 	.page_topbar .title{color: #282828;}
	.container{padding: 0px;}
	.coupon_no {height:100px;  margin:100px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
	.coupon_menu {height:60px; width:100%; }
	.coupon_no_nav {height:38px; background:#eee; margin:0px 3%; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}

       .banner {overflow:hidden;position:relative;height:auto;}
     .banner  .main_image{width:100%;position:relative;top:0;left:0;}
  .banner .main_image ul{}
  .banner .main_image li{float:left;}
  .banner .main_image li img{display:block;width:100%; }
  .banner .main_image li a{display:block;width:100%;}

    div.flicking_con{position:absolute;bottom:10px;z-index:1;width:100%;height:12px;}
    div.flicking_con .inner { width:100%;height:9px;text-align:center;}
    div.flicking_con a{position:relative; width:10px;height:9px;background:url('../addons/sz_yi/template/mobile/default/static/images/dot.png') 0 0 no-repeat;display:inline-block;text-indent:-15165px; text-indent:-1000px}
    div.flicking_con a.on{background-position:0 -9px}
	.u-btn{margin:10px auto;width: 100px;height: 33px;line-height: 33px;font-size: 15px;border-radius: 10px;background: #e45050;}
.coupon_footer {padding:5px 10px; font-size:13px; color:#656565; line-height:20px; text-align:center;background:#efefef;}

.colo656565{color: #656565;} 
.coupon_item .cright{width: 35%;}
.coupon_item .cinfo{float: right;margin-left: 0px;width: 65%;}
.coupon_item .cinfo .inner{margin-left: 0px;height: 115px;padding: 3px 10px;}
.coupon_item .cinfo .inner .name { font-size:14px;color: #656565;overflow:hidden; text-indent: 53px;overflow: hidden;text-overflow: ellipsis;-webkit-line-clamp: 2;-webkit-box-orient: vertical;white-space: normal;line-height: 21px;height: 40px;margin-top: 4px;padding-right: 35px;}
.coupon_item .cinfo .inner .time {margin-top: 5px; font-size:12px; color:#989898; height:18px; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;padding-bottom: 27px;border-bottom: 1px dashed #eaeaea;}
.coupon_item .cinfo .inner .pay { font-size:11px; color:#666; height:20px; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;}
.coupon_item .cright .rinfo .rinner .type{text-align: center;padding-right:0px;}
.coupon_item .cinfo .inner span { padding: 3px 0; }
.coupon_item .cright .rinfo .rinner .price span{font-size: 30px;}
.coupon_item .cright .rinfo .rinner .price{font-size: 18px;text-align: center;padding-right: 0px;padding-top: 25px;}
.coupon_item,.coupon_item .cinfo,.coupon_item .cright,.coupon_item .cright .rinfo{height: auto;}
.deduct{background:#e45050; }
.bg {background: url('../addons/sz_yi/plugin/coupon/template/mobile/default/images/conbg.png') repeat;}
.coupon_item .cright .rinfo .rinner,.coupon_item .cright .sideleft{height: 113px;}
.coupon_item .cright{float: left;margin-left:0px;}
.coupon_item .cright .rinfo .rinner{margin-left: 3px;margin-right: 0px;}
.nameSpan{position: absolute;left: 0px;top: -8px;text-indent: 0px;width: 45px;height: 17px;border-radius: 2px;font-size: 11px;line-height: 17px;}
.timeSpan{width: 70px;height: 27px;color: #5d99d7;position: absolute;line-height: 25px;right: 10px;margin: 0px;top: 47px;font-size: 13px; border-radius: 3px;background: white;border: 1px solid #5d99d7;line-height: 24px;}
.coupon_item .cinfo .inner{position: relative;}
.newImg{position: absolute;right: 0px;top: 0px}
.newImg img{width: 55px;}
.texttip{background: white;padding:10px;}
.downArrow {
            transition: All 0.4s ease-in-out;
            -webkit-transition: All 0.4s ease-in-out;
            -moz-transition: All 0.4s ease-in-out;
            -o-transition: All 0.4s ease-in-out;
        }
.money,.discount {background:#e45050;}
.redpack,.credit{background: #f98d0f;}
</style>
<div class="page_topbar">
	<a href="javascript:;" class="back" onclick='history.go(-1)'><i class="fa fa-angle-left"></i></a>
	<a href="<?php  echo $this->createPluginMobileUrl('coupon/my')?>" class="btn"><i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i></a>
	<div class="title">优惠券领取中心</div>
</div>

    <?php  if(!empty($advs)) { ?>
    <div class="banner">

        <?php  if(count($advs)>1) { ?>
        <div class="flicking_con"><div class="inner">
	   <?php  if(is_array($advs)) { foreach($advs as $key => $adv) { ?>
            <a class="<?php  if($key==0) { ?>on<?php  } ?>" href="#@"><?php  echo $key;?></a>
            <?php  } } ?>
            </div>
        </div>
        <?php  } ?>
        <div class="main_image" id='banner'>
            <ul>

  	   <?php  if(is_array($advs)) { foreach($advs as $key => $adv) { ?>
                <li <?php  if($adv['url']) { ?>onclick="location.href='<?php  echo $adv['url'];?>'"<?php  } ?>> <img src="<?php  echo tomedia($adv['img'])?>"></li>
                 <?php  } } ?>
            </ul>
        </div>
    </div>
    <?php  } ?>
 
    
	<div id='cates'></div>
<div id='container'></div>
<div class="coupon_footer">版权所有 ©<?php  if(empty($set1['copyright'])) { ?><?php  echo $_W['account']['name'];?><?php  } else { ?><?php  echo $set1['copyright'];?><?php  } ?></div>
<script id='tpl_category' type='text/html'>

<div class="category_group">
   <div class='container'>
     <span class='item on' data-catid="" onclick="getCoupons('')">全部</span>
	 
 	<%each category as c%>
	<span class='item' data-catid="<%c.id%>" onclick="getCoupons('<%c.id%>')"><%c.name%></span>
	<%/each%>
   </div>
</div>

</script>
<script id='tpl_empty' type='text/html'>
	<div class="coupon_no">
		<img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/tip.png" style="width: 90px;">
		<p class="colo656565 f-fsize15">目前还没有发布任何优惠券</p>
		<div class="f-tac">
			<div class="u-btn">随便逛逛</div>
		</div>
	</div>
		
	<!-- <i class="fa fa-credit-card" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">还没有发布优惠券~</span>
	</div> -->
</script>
<script id='tpl_list' type='text/html'>
<%each list as coupon%>

<div class="coupon_item">
          <%if coupon.past%><div class="coupon_past"><img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/past.png"></div><%/if%>
		 
	<!-- <div class="cthumb" <%if coupon.thumb==''%>style="width:8px;"<%/if%>> <%if coupon.thumb!=''%><img src='<%coupon.thumb%>' /><%/if%></div> -->
	
	<div class="cinfo" >
		<div class="inner f-relative" >
			<div class="newImg ">
				<img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/new.png">
			</div>
			<div class="name f-relative" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon/detail')?>&id=<%coupon.id%>'">
				<div class="u-btn nameSpan <%coupon.css%>">标注</div>
				<%coupon.couponname%>
			</div>
			<div class="time"><%if coupon.timestr=='0'%>
			永久有效 
			<%else%>
		 <%if coupon.timestr=='1'%>
		          即<%coupon.gettypestr%>日内 <%coupon.timedays%> 天有效
				  <%else%>
			有效期 <%coupon.timestr%>
			<%/if%>
			<%/if%>
			<a href="javascript:void(0);" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon/detail')?>&id=<%coupon.id%>'">
				<div class="u-btn timeSpan">立即领取</div>
			</a>
			</div>
			<div class="f-marginT5 xiangxi" data-num="0" >
				<span class="" style="color: #989898;">详细信息</span>
				<span class="fr downArrow" style="padding: 0px;">
					<img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/downArrow.png">
				</span>
			</div>

			<!-- <div class='pay'>
				
				 
				<%if coupon.getstatus=='0'%><span class="ccreditmoney"><%coupon.money%> 元 +  <%coupon.credit%> 积分</span><%/if%>
				
				<%if coupon.getstatus=='1'%><span class="cmoney"><%coupon.money%></span> 元<%/if%>
				<%if coupon.getstatus=='2'%><span class="ccredit"><%coupon.credit%></span> 积分<%/if%>
				<%if coupon.getstatus=='3'%><span class="cfree">免费领取</span><%/if%>
					<%if coupon.getmax!=-1 && coupon.getmax!=0%>
				           每人限 <%coupon.getmax%> 张 
					<%/if%>
				 
			</div> -->
		</div>
	</div>
	 <div class="cright" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon/detail')?>&id=<%coupon.id%>'">
		   <div class="bg sideleft side side-<%coupon.css%>"></div>
		   <div class="rinfo" >
			   <div class='rinner  <%coupon.css%>'>
				 <div class="price"><%if coupon.backpre%>￥<%/if%><span><%coupon._backmoney%></span></div>
				 <div class="type"><%coupon.backstr%></div>
			   </div>
		 </div>
		
	</div>
	<div class="f-cb"></div>
	<div class="texttip" style="margin-top: 1px;display: none;">限品类:仅可购买厨具商品</div>

</div>

<%/each%>
</script>

<script language='javascript'>
	function down(){	
		$(".xiangxi").on("click",function(){
			var num = $(this).attr("data-num");
			var a=$(this).parents(".coupon_item").find(".texttip");
			if(num==0){		
				a.fadeIn();
				$(this).attr("data-num",1);
				$(this).find(".downArrow").css({
					 "transform": "rotate(180deg)"
				})
			}else{
				a.fadeOut();
				$(this).attr("data-num",0);
				$(this).find(".downArrow").css({
					 "transform": "rotate(0deg)"
				})
			}
		})
	}

function changeBg(){

	$(".coupon_item").each(function(){
			var a =$(this).find(".rinner");

			if(a.hasClass('redpack') || a.hasClass('credit')){
				

			}else{
				$(this).find(".newImg img").attr("src","../addons/sz_yi/plugin/coupon/template/mobile/default/images/new1.png")
			}

	})
}

	

	$(function(){

		
	 <?php  if(!empty($advs)) { ?>
          
                require(['jquery','jquery.touchslider','swipe'], function ($) {
              
                    
                    new Swipe($('#banner')[0], {
			speed:300,
			auto:4000,
			callback: function(){
			 $(".flicking_con  .inner  a").removeClass("on").eq(this.index).addClass("on");
		}
	  }); 
		
	})

	<?php  } ?>
		
		getCoupons('',true);
	});
var page = 1;
var loaded = false;
var stop=true; 
var init = false;
function getCoupons(catid,init){


	loaded = false;
          stop=true; 
          page=1;
  require(['core','tpl'],function(core,tpl){

		var left =0; 
		if( $("#cates .container").length>0){
		      left = $("#cates .container").scrollLeft();	
		}
		 if(init){
          $("#cates").html(tpl('tpl_category', {category: <?php  echo json_encode($category)?>}));

	  }else{
		  $("#cates").html($("#cates").html());
	  }
	  
	$('#cates .item').removeClass('on');
	$('#cates .item[data-catid="' + catid + '"]').addClass('on');
	$("#cates .container").scrollLeft(left);	
		
	 core.pjson('coupon/index', {page:page, catid: catid}, function(json) {
	 	console.log(json)
                
                    if (json.result.list.length <= 0) {
                       $("#container").html(tpl('tpl_empty'));
					   $(window).unbind('scroll');loaded = false;
          stop=true; 
                       return;
                    }
		                       $("#container").html(tpl('tpl_list', json.result));
		                       down();
								var i=0;

		                       changeBg();
		                       
                                 if(catid ==1){
                                 	$(".rinner").css("background",'#e45050');
                                 	$(".nameSpan").css("background",'#e45050');
                                 	$(".newImg img").attr("src","../addons/sz_yi/plugin/coupon/template/mobile/default/images/new1.png")


                                 	changeBg();

                                 	
                                 }else if(catid==2){
	                       			$(".rinner").css("background",'#f98d0f');
	                       			$(".nameSpan").css("background",'#f98d0f');

	                       			$(".coupon_item").each(function(){
		                       		var a =$(this).find(".rinner");

		                       		if(a.hasClass('redpack') || a.hasClass('credit')|| a.hasClass('money')){
		                       			
										$(this).find(".newImg img").attr("src","../addons/sz_yi/plugin/coupon/template/mobile/default/images/new.png")

		                       		}else{
		                       			$(this).find(".newImg img").attr("src","../addons/sz_yi/plugin/coupon/template/mobile/default/images/new1.png")
		                       		}

		                       })


                                 }else{
                        
                                 }
                      $(window).scroll(function(){ 
                          if(loaded){
                              return;
                          }
                            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop()); 
                            if($(document).height() <= totalheight){ 
                                
                                if(stop==true){ 
                                    stop=false; 
                                    $('#container').append('<div id="coupon_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                                    page++;
                                    core.pjson('coupon/index', {page:page, catid: catid}, function(morejson) {  
                                        stop = true;
                                        $('#coupon_loading').remove();
                                        $("#container").append(tpl('tpl_list', morejson.result));
                                        if (morejson.result.list.length <morejson.result.pagesize) {
                                            $('#container').append('<div id="coupon_loading">已经加载全部优惠券</div>');
                                            loaded = true;
                                            return;
                                        }
                                    },true); 
                                } 
                            } 
                        });
                }, true);
    });			
}
</script>


