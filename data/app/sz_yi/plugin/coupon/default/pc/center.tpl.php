<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?>

<title>优惠券领取中心</title>

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/plugin/coupon/template/mobile/default/images/style.css">

<style type="text/css">

    body {margin:0px; background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;overflow-x: hidden;}

    a {text-decoration:none;}





	#coupon_loading { width:94%;padding:10px;color:#666;text-align: center;}

	.category_group {background:#fff; border-bottom:1px solid #efefef;border-top:1px solid #efefef; height:37px;list-style-type:none; ;white-space:nowrap; -webkit-overflow-scrolling: touch;}

	.category_group .container{z-index: -1; ;  height:40px;overflow: auto; list-style-type:none;white-space:nowrap; }

	.category_group  .item { color:#f90;height:40px; width:auto; overflow: hidden; line-height:35px; text-decoration: none; color:#333; text-align: center; padding: 5px 10px;; }

	.category_group  .item.on  { color:#e31939; border-bottom:2px solid #e31939;font-weight: bold;  }





	.coupon_no {height:100px;  margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}

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



.coupon_footer {padding:20px 10px; font-size:13px; color:#666; line-height:20px; text-align:center;background:#efefef;}

.coupon_item .cinfo .inner{border-top: 1px solid #d6d6d6;}

.coupon_item .cinfo .inner .name { font-size:14px; color:#222; height:24px; text-overflow:ellipsis; white-space:nowrap; overflow:hidden; line-height: 30px}

.coupon_item .cinfo .inner .time { font-size:12px; color:#666; height:18px; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;}

.coupon_item .cinfo .inner .pay { font-size:11px; color:#666; height:20px; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;}

.coupon_item .cinfo .inner span { padding: 3px 0; }

.coupon_item .cthumb{border-top:1px solid #d6d6d6;;}

.code-pos{padding: 0 !important}

.ccreditmoney{color: #e31939;}

</style>

<div style="width: 960px;float: left;margin-left: 10px;">

<div class="page_topbar">



	<!-- <a href="<?php  echo $this->createPluginMobileUrl('coupon/my')?>" class="btn code-pos"><i class="fa fa-user"></i></a> -->

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

 </div>



<div id='container' class="rightlist" style="width: 960px;float: left;margin-left: 10px;"></div>

<script id='tpl_category' type='text/html'>



<div class="category_group">

   <div class='container'>

     <span class='item on' data-catid="" onclick="getCoupons('')">全部优惠券</span>



 	<%each category as c%>

	<span class='item' data-catid="<%c.id%>" onclick="getCoupons('<%c.id%>')"><%c.name%></span>

	<%/each%>

   </div>

</div>



</script>

<script id='tpl_empty' type='text/html'>

	<div class="coupon_no"><i class="fa fa-credit-card" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">还没有发布优惠券~</span></div>

</script>

<script id='tpl_list' type='text/html'>

<%each list as coupon%>



<div class="coupon_item" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon/detail')?>&id=<%coupon.id%>'">

          <%if coupon.past%><div class="coupon_past"><img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/past.png"></div><%/if%>

          <div class='bg cside side side-left'></div>



	<div class="cthumb" <%if coupon.thumb==''%>style="width:8px;"<%/if%>> <%if coupon.thumb!=''%><img src='<%coupon.thumb%>' /><%/if%></div>



	<div class="cinfo" >

		<div class="inner" >

			<div class="name"><%coupon.couponname%></div>

			<div class="time"><%if coupon.timestr=='0'%>

			永久有效

			<%else%>

		 <%if coupon.timestr=='1'%>

		          即<%coupon.gettypestr%>日内 <%coupon.timedays%> 天有效

				  <%else%>

			有效期 <%coupon.timestr%>

			<%/if%>

			<%/if%></div>

			<div class='pay'>





				<%if coupon.getstatus=='0'%><span class="ccreditmoney"><%coupon.money%> 元 +  <%coupon.credit%> 积分</span><%/if%>



				<%if coupon.getstatus=='1'%><span class="cmoney"><%coupon.money%></span> 元<%/if%>

				<%if coupon.getstatus=='2'%><span class="ccredit"><%coupon.credit%></span> 积分<%/if%>

				<%if coupon.getstatus=='3'%><span class="cfree">免费领取</span><%/if%>

					<%if coupon.getmax!=-1 && coupon.getmax!=0%>

				           每人限 <%coupon.getmax%> 张

					<%/if%>



			</div>

		</div>

	</div>

	 <div class="cright">

		   <div class="bg png png-<%coupon.css%>"></div>

		   <div class="bg sideleft side side-<%coupon.css%>"></div>

		   <div class="rinfo" >

			   <div class='rinner <%coupon.css%>'>

				 <div class="price"><%if coupon.backpre%>￥<%/if%><span><%coupon._backmoney%></span></div>

				 <div class="type"><%coupon.backstr%></div>

			   </div>

		 </div>

		   <div class="bg sideright side side-<%coupon.css%>"></div>



	</div>



</div>



<%/each%>

</script>

</div>

<script language='javascript'>



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



                    if (json.result.list.length <= 0) {

                       $("#container").html(tpl('tpl_empty'));

					   $(window).unbind('scroll');loaded = false;

          stop=true;

                       return;

                    }

                       $("#container").html(tpl('tpl_list', json.result));

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

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>

