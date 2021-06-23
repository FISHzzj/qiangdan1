<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $this->set['texts']['commission_detail']?></title>
<style type="text/css">
body {margin:0px; background:#f2f2f2; font-family:'微软雅黑'; -moz-appearance:none;}
a {text-decoration:none;}
.order_top {height:44px; width:100%;  background:#f8f8f8;  border-bottom:1px solid #e3e3e3;}
.order_top .title {height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#666;}
.order_top .num2 { float:right;color:#666;height:44px;line-height:44px;padding-right:5px;}
    
.order_menu {height:44px; background:#fff;}
.order_menu .nav {height:44px; width:25%; border-bottom:1px solid #f1f1f1;background:#fff; border-left:1px solid #f1f1f1; float:left; line-height:44px; font-size:14px; color:#666; text-align:center;}
.order_menu .navon {height:42px; color:#ff771b; border-bottom:2px solid #ff771b;}

.order_title {height:40px; padding:5px; line-height:50px; font-size:16px; color:#666;}

.order_list {height:60px; padding:10px; background:#fff;margin-top:5px;}
.order_list .left {height:40px; width:100%; float:left; color:#999; margin-right:-20%;font-size:14px;}
.order_list .left .inner { width:100%;margin-right:-20%}
.order_list .left span {color:#666; font-size:14px; line-height:28px;}
.order_list .right {height:40px; width:20%; float:right; font-size:14px; text-align:right; line-height:18px; margin-left:-20%;}
.order_list .right span {color:#f90;}
.order_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
#order_loading { padding:10px;color:#666;text-align: center;}


.order_detail {overflow:hidden; padding:10px; background:#fff; border-top:1px solid #eaeaea;width:100%;}
   .team_list {height:40px; background:#fff; }
    .team_list .img { width:16%; height:40px; float:left; text-align:left; }
    .team_list .img img {height:40px; width:40px; }
    
    .team_list .info {height:40px; width:80%; float:left; font-size:16px; color:#666; line-height:20px; text-align:left;}
    .team_list .info span {font-size:14px; color:#999;}
    
     .detail_good {height:auto;background:#fff; padding-top:5px;  overflow: hidden;}
    .detail_good .ico {height:6px; width:10%; line-height:36px; float:left; text-align:center;}
    .detail_good .shop {height:36px; width:90%; padding-left:10%;  line-height:36px; font-size:18px; color:#333;}
    .detail_good .good {height:80px; width:100%; padding:10px 0px; overflow: hidden;}
    .detail_good .img {height:50px; width:50px; float:left;}
    .detail_good .img img {height:100%; width:100%;}
    .detail_good .info {width:100%;float:left; margin-left:-50px;margin-right:-60px;}
    .detail_good .info .inner { margin-left:60px;margin-right:60px; overflow: hidden;}
    .detail_good .info .inner .name {height:32px; width:100%; float:left; font-size:12px; color:#555;overflow:hidden;}
    .detail_good .info .inner .option {height:16px; width:100%; float:left; font-size:12px; color:#888;overflow:hidden;word-break: break-all}
    .detail_good span { color:#666;}
    .detail_good .price { float:right;width:60px;;height:40px;overflow: hidden;}
    .detail_good  .pnum { height:20px;width:auto;text-align:right;font-size:13px;color:#666; float: left;}	
    .detail_good  .num { height:20px;width:auto;text-align:right;color:#ff6600;float: left;}

    .detail_good .fanxian { float:right;width:106px;;height:20px;}

    .detail_good .leiji { float:right;width:90px;;height:20px;margin-right:-20px;}
</style>
<div class="order_top">
    <div class="title" onclick='history.back()'><i class='fa fa-chevron-left'></i> <?php  echo $this->set['texts']['commission_detail']?></div>
    <div class='num2'>总分红金额: <span style="color:#e45050;">￥<?php  echo $commissioncount;?></span></div>
</div>
<div id='container'></div>
<script id='tpl_order' type='text/html'>
    <%each list as order%>
  <a href="<%order.url%>">
  <div class="order_list" style="display: <%if order.aa==''%>none;<%/if%>">
    <div class="left"><div class='inner'>订单：<%order.ordersn%>(<%order.paymethod%>)<br><span><%order.sendpaytime%></span></div></div>
   <div class="right"><span style="color:#999;"><span style="color:red;">+<%order.aa%>元</span><br>期数(<span style="color:red;"><%order.cc%></span>/<%order.dd%>)</span></div>
 </div>
 </a>
    <%/each%>
</script>
<!--<div class="order_no"><i class="fa fa-file-text-o" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">您还没有相关<?php  echo $this->set['texts']['order']?>~</span></div>-->
<script id='tpl_empty' type='text/html'>
    <div style="padding-top: 45px; width: 190px; margin: 0 auto;width: 80%;height: 180px;margin: 120px auto 0 auto;background: #fff">
    	<img style="width:60px;display:block;margin:0 auto;" src="../addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/Detailed.png" alt="">
    	<span style="display:block;margin-top: 18px; text-align:center;">您还没有相关<?php  echo $this->set['texts']['order']?>~</span></br>   	
	</div>
</script>

<script language="javascript">
    var page = 1;
   var current_status = '';
    require(['tpl', 'core'], function (tpl, core) {
function bindEvents(){
	<?php  if(!empty($this->set['openorderdetail']) ||!empty($this->set['openorderbuyer'])) { ?>
	$('.order_list').unbind('click').click(function(){
		$('.order_detail').slideUp();
		$(this).next('.order_detail').slideDown();
	})
	<?php  } ?>
}
function bindScroller(){
    
      
    
        //加载更多
        var loaded = false;
        var stop = true;
        $(window).scroll(function () {
            if (loaded) {
                return;
            }
            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
            if ($(document).height() <= totalheight) {

                if (stop == true) {
                    stop = false;
                    $('#container').append('<div id="order_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                    page++; 
                    core.pjson('bonusplus/log', {status:current_status,page: page}, function (morejson) {
                        stop = true;
                        $('#order_loading').remove();
                        $("#container").append(tpl('tpl_order', morejson.result));
			bindEvents();			
                        if (morejson.result.list.length < morejson.result.pagesize) {
                            $("#container").append('<div id="order_loading">已经加载完全部订单</div>');
                            loaded = true;
                            $(window).scroll = null;
                            return;
                        }
                    }, true);
                }
            }
        });
}
        function getOrder(status) {
            $('.order_menu .nav').removeClass('navon');
            $('.order_menu .nav[data-status=\'' + status + '\']').addClass('navon');
            core.pjson('bonusplus/log', {status:status, page: page}, function (json) {
                if (json.result.list.length <= 0) {
                    $('#container').html(tpl('tpl_empty'));
                    return;
                }
                $('#container').html(tpl('tpl_order', json.result));
                bindScroller();
                bindEvents();
            }, true);
        }
        $('.order_menu .nav').unbind('click').click(function () {
            page = 1; current_status = $(this).data('status')
            getOrder(current_status);

        });

        getOrder('');

    })
</script>
<?php  $show_footer=true?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
