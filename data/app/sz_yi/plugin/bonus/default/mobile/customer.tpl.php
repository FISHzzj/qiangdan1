<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $this->set['texts']['mycustomer']?></title>
<style type="text/css">
    body {margin:0px; background:#eee; font-family:'微软雅黑'; -moz-appearance:none;}
    a {text-decoration:none;}
    .customer_top {height:44px; width:100%;  background:#f8f8f8;  border-bottom:1px solid #e3e3e3;}
    .customer_top .title {height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#666;}

    .customer_list_head {height:40px; background:#fff; padding:10px 3%;border-bottom:1px solid #eaeaea;}
    .customer_list_head .info {height:20px; float:left;  font-size:16px; color:#666; line-height:20px; text-align:left;}
    .customer_list_head .info span {font-size:14px; color:#999;}
    .customer_list_head .num {height:20px; float:right; text-align:right; font-size:16px; color:#666; line-height:20px; font-size:14px; color:#999;}


    .customer_list {overflow:hidden; background:#fff; padding:10px 3%;width:100%;}
    .customer_list .img { width:51px;margin-top:5px; height:40px;  float:left; text-align:left; vertical-align: middle;}
    .customer_list .img img {height:45px; width:45px; }
    .customer_list .left { float:left;width:60%; }
    .customer_list .info { width:100%; float:left; border-right:1px solid #eaeaea; font-size:14px; color:#666;  text-align:left;}
    .customer_list .info span {font-size:13px; color:#999;}
    .customer_list .num {height:40px; width:23%; float:right; text-align:right; font-size:16px; color:#666; line-height:20px;padding-top:4px;}
    .customer_list .num span {font-size:1.2rem; color:#999;line-height:35px;}
    .customer_tab {height:30px; margin:5px; border:1px solid #ff6801; border-radius:5px; overflow:hidden;font-size:13px;background:#fff;padding-right: -2px;}
    .customer_nav {height:30px;  background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
    .customer_navon {color:#fff; background:#ff6801;}
    .customer_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    #customer_loading { padding:10px;color:#666;text-align: center;}

</style>
<div class="customer_top">
    <div class="title" onclick='history.back()'><i class='fa fa-chevron-left'></i> <?php  echo $this->set['texts']['mycustomer']?>(<?php  echo $total;?>)</div>
</div>
<div class="customer_list_head">
        <div class="info">会员信息</div>
        <div class="num">TA的消费订单/金额</div>
</div>
<div id='container'></div>

<script id='tpl_customer' type='text/html'>
    <%each list as user%>
    <div class="customer_list">
        <div class="img"><img src="<%if user.nickname%><%user.avatar%><%else%>../addons/sz_yi/plugin/commission/images/head.jpg<%/if%>"></div>
        <div class="left">
        <div class="info"><%if user.nickname%><%user.nickname%><%else%>未获取<%/if%></div>
        <%if user.weixin%>
            <div class="info"><span>微信号: <%user.weixin%></span></div>
        <%/if%>
        <div class="info" style="margin-top: 9px;"><span>注册时间: <%user.createtime%></span></div>

        </div>

        <div class="num"><%user.ordercount%> 订单<br><span><%user.moneycount%> 元</span></div>
    </div>
    <%/each%>
</script>
<!--<div class="customer_no"><i class="fa fa-users" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">还没有人呢~</span></div>-->
<script id='tpl_empty' type='text/html'>
   <!--  <div style="padding-top:120px;width:190px;margin:0 auto;">
    	<img style="width:60px;display:block;margin:0 auto;" src="../addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/Customer.png" alt="">
    	<span style="display:block;margin-top: 18px; text-align:center;">暂时还没有下线呢~</span></br>
	</div -->

    <div style="padding:10px 0 10px 0;width:80%;margin:120px auto 0 auto;height: 180px;">
        <img style="width:60px;display:block;margin:10px auto 0 auto;" src="../addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/underline.png" alt="">
        <span style="display:block;margin-top: 10px; text-align:center;">您还没有相关<?php  echo $this->set['texts']['order']?>~</span></br>
        <span style="width: 100px;background:#e45050;padding:5px 21px;color:#fff;border-radius:4px;margin: 0 auto;display: block;"  onclick="location.href='<?php  echo $this->getUrl()?>'">随便逛逛</span>
    </div>
</script>

<script language="javascript">
var page = 1;

require(['tpl', 'core'], function (tpl, core) {

function bindScroller(){


        //加载更多
        var loaded = false;
        var stop = true;
        $(window).scroll(function () {
            if (loaded) {
                return;
            }
            $('#customer_loading').remove();
            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
            if ($(document).height() <= totalheight) {

                if (stop == true) {
                    stop = false;
                    $('#container').append('<div id="customer_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                    page++;
                    core.pjson('bonus/customer', {page: page}, function (morejson) {
                        stop = true;
                        $('#customer_loading').remove();
                        $("#container").append(tpl('tpl_customer', morejson.result));
                        if (morejson.result.list.length < morejson.result.pagesize) {
                            $("#container").append('<div id="customer_loading">已经加载完全部</div>');
                            loaded = true;
                            $(window).scroll = null;
                            return;
                        }
                    }, true);
                }
            }
        });
}
        function getcustomer() {

            core.pjson('bonus/customer', {page: page}, function (json) {
                if (json.result.list.length <= 0) {
                    $('#container').html(tpl('tpl_empty'));
                    return;
                }
                $('#container').html(tpl('tpl_customer', json.result));
                bindScroller();
            }, true);
        }

        getcustomer();

    })
</script>
<?php  $show_footer=true?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
