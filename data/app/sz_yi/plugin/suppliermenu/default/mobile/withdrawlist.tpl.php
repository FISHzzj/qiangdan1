<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<?php  if($op == 'withdrawlist') { ?>

<title>提现记录</title>

<style type="text/css">

    body { margin: 0px; background: #f2f2f2; font-family: '微软雅黑'; -moz-appearance: none; }

    a { text-decoration: none; }

    .customer_top {height:44px; width:100%;  background:#10BDFF;  border-bottom:1px solid #ccc;}

    .customer_top .title {height:44px; width:auto; float:left; font-size:16px; line-height:44px; color:#fff;}

	.back{width: 30px;height: 30px;font-size: 24px;border-radius: 50%;float: left;line-height: 33px;text-align: center;margin: 5px; font-family: arial, helvetica, sans-serif;}

    .log_top { height: 44px; width: 100%; background: #f8f8f8; border-bottom: 1px solid #e3e3e3; }

    .log_top .title { height: 44px; width: auto; margin-left: 10px; float: left; font-size: 16px; line-height: 44px; color: #666; }

    .log_menu { height: 44px; background: #fff; }

    .log_menu .nav { height: 44px; width: 20%; border-bottom: 1px solid #f1f1f1; background: #fff; border-left: 1px solid #f1f1f1; float: left; line-height: 44px; font-size: 14px; color: #666; text-align: center; }

    .log_menu .navon { color: #00c1ff; border-bottom: 2px solid #00c1ff; }

    .log_title { height: 40px; padding: 5px; line-height: 50px; font-size: 16px; color: #666; }

    .log_list { height: 70px; padding: 10px; background: #fff;border-bottom: 1px solid #eaeaea; }

    .log_list .left { height: 40px; width: 100%; float: left; color: #999; margin-right: -20%; font-size: 14px; }

    .log_list .left .inner { width: 100%; margin-right: -20%;font-size: 14px;color:#282828;}

    .log_list .left span { color: #989898; font-size: 12px; line-height: 28px; }

    .log_list .right { height: 40px; width: 30%; float: right; font-size: 12px; text-align: right; line-height: 18px; margin-left: -20%; color:#989898;}

    .log_list .right span { color: #e45050;font-size: 16px; }

    .log_no {background: #f2f2f2; height: 100px; width: 100%; margin: 50px 0px 60px; color: #ccc; font-size: 12px; text-align: center; }

    #coupon_loading { padding:10px;color:#666;text-align: center;}

    #container{width: 100%;height: auto;background: #fff;margin-top: 12px;}

    .center{width: 96%;margin: 0 auto;}

    .center .title{font-size: 16px;border-bottom: 1px solid #ccc;padding: 10px;}

    .center .title input{border: 0;margin-left: 20px;}

	.center .portrait{font-size: 16px;height: 80px;line-height: 80px;padding: 10px;width: 100%;}

	.img{width:26px;height:30%;margin: 0 auto;height: 30%;}

	.img img{width: 100%;height: 100%;}

	.center .signs{font-size: 16px;height: 118px;line-height: 80px;padding: 10px;margin-top: 34px;width: 100%;    margin: 40px 0;}

	.upload-img1 {width: 100px;height: 100px;background: #E6E6E6;float:left;text-align: center;margin-left: 20px;}

	.upload-img {width: 228px;height: 100px;background: #E6E6E6;float:left;text-align: center;margin-left: 20px;}

	.share{font-size: 16px;color: #ccc;height: 60px;width: 96%;margin: 0 auto;height: 120px;padding-bottom: 20px;}

	textarea{width: 100%;height: 100%;border: 1px solid #ccc;}

	text{margin-bottom: 20px;}

	.confirm{width: 40%;height: 40px;background: #10BDFF;color: #fff;font-size: 16px;margin: 0 auto;text-align: center;border-radius: 14px;line-height: 40px;margin-top: 20px;}

	.head_nav{height: 40px;background: #fff;border-bottom: 1px solid #eaeaea}

    .head_select{color:#e45050;border-bottom: 2px solid #e45050;}

    .page_topbar .back{margin:0;}

</style>

<!--<div class="log_top">

    <div class="title" onclick='history.back()'><i class='fa fa-chevron-left'></i> 小店设计</div>

</div>-->

<!-- <div class="customer_top">

	<div class="title" onclick='history.back()'><span class="back"><</span>返回<p style="display: inline-block;margin-left: 76px;">提现记录</p></div>

</div> -->

 <div class="page_topbar" style="background: #fff;">

    <a href="#" class="back" onclick="history.back()">

      <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>

    </a>

    <div class="title" style=" color: #282828;">提现记录</div>

    

  </div>

  <div class="head_nav">

      <span class="head_select" data-type='0' style="float: left;width:50%;height:40px;line-height:40px;text-align: center;">申请中</span>

       <span data-type='1' style="float: left;width:50%;height:40px;line-height:40px;text-align: center;">已提现</span>

  </div>

<div id='container'>

</div>

<script id='tpl_list' type='text/html'>

    <%each list as log%>

    <div class="log_list" data-applyid='<%log.id%>'>

        <div class="left">

            <div class='inner'>

                编号: <%log.applysn%><br>

                <span>

                    <!-- 提现金额：<%log.apply_money%> -->

                    申请时间：<%log.apply_time%>

                </span>

            </div>

        </div>

       <div class="right">

                <!-- 1手动2微信3余额 -->

            <span style="padding-bottom: 5px;">

           <%log.apply_money%>

           </span>

           </br> 

         <div style="margin-top: 5px;">

             <%if log.type == 1%>银行卡<%/if%>

            <%if log.type == 2%>微信<%/if%>

            <%if log.type == 3%>余额<%/if%>

            <%if log.status == 0%>申请中<%/if%>

            <%if log.status == 1%>已完成<%/if%>

         </div>  

          

       </div>

    </div>

    <%/each%>

</script>



<script id='tpl_empty' type='text/html'>

    <div class="log_no">

        <i class="fa fa-file-text-o" style="font-size:100px;"></i><br><br>

        <span style="line-height:18px; font-size:16px;">您还没有相关 ~</span>

    </div>

</script>

<script language = 'javascript' >

var page = 1;

require(['core', 'tpl'], function(core, tpl) {

    core.pjson('suppliermenu/order', {

        page: page,

        op : 'withdrawlist'

    },

    function(json) {

        if (!json.result.list.length) {

            $('#container').html(tpl('tpl_empty'));

            return;

        } else if (json.result.list.length > 0) {

            var list = json.result;

            console.log(list);

            $('#container').html(tpl('tpl_list',list));

        }

        var loaded = false;

        var stop = true;

        $(window).scroll(function() {

            if (loaded) {

                return;

            }

            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());

            if ($(document).height() <= totalheight) {



                if (stop == true) {

                    stop = false;

                    $('#container').append('<div id="coupon_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');

                    page++;

                    core.pjson('suppliermenu/order', {

                        page: page,

                        op : 'withdrawlist'

                    },

                    function(morejson) {

                        stop = true;

                        $('#coupon_loading').remove();

                        $("#container").append(tpl('tpl_list', morejson.result));

                        if (morejson.result.list.length < morejson.result.pagesize) {

                            $('#container').append('<div id="coupon_loading">已经加载全部</div>');

                            loaded = true;

                            return;

                        }

                    },

                    true);

                }

            }

        });

    },

    true);

});

</script>

<script type="text/javascript">

    $('.head_nav span').click(function(){

        $(this).addClass('head_select').siblings().removeClass('head_select');
        var type = $(this).data('type'); //获取所选择的类型
        require(['core', 'tpl'], function(core, tpl) {
                    core.pjson('suppliermenu/order', {
                        page: page,
                        op : 'withdrawlist',
                        status: type,
                    },
                    function(morejson) {
                        $("#container").html('');
                        stop = true;
                        $('#coupon_loading').remove();
                        $("#container").append(tpl('tpl_list', morejson.result));
                        if (morejson.result.list.length < morejson.result.pagesize) {
                            $('#container').append('<div id="coupon_loading">已经加载全部</div>');
                            loaded = true;
                            return;
                        }
                    },
                    true);
        });    

    })

</script>

<?php  } ?>

<?php  $show_footer=true;?>

<?php  $footer_current='member'?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>