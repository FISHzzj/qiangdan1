<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>奖金明细</title>
<style type="text/css">
body {margin:0px; background:#eee; font-family:'微软雅黑'; -moz-appearance:none;}
a {text-decoration:none;}
.log_top {height:44px; width:100%;  background:#f8f8f8;  border-bottom:1px solid #e3e3e3;}
.log_top .title {height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#666;}
.log_top .num { float:right;color:#666;height:44px;line-height:44px;padding-right:5px;}

.log_menu {height:44px; background:#fff;}
.log_menu .nav {height:44px; width:20%; border-bottom:1px solid #f1f1f1;background:#fff; border-left:1px solid #f1f1f1; float:left; line-height:44px; font-size:14px; color:#666; text-align:center;}
.log_menu .navon {height:42px; color:#ff771b; border-bottom:2px solid #ff771b;}

.log_title {height:40px; padding:5px; line-height:50px; font-size:16px; color:#666;}

.log_list {height:56px; padding:10px; background:#fff;margin-top:5px;}
.log_list .left {height:40px; width:100%; float:left; color:#999; margin-right:-20%;font-size:14px;}
.log_list .left .inner { width:100%;margin-right:-20%}
.log_list .left span {color:#666; font-size:13px; line-height:28px;}
.log_list .right {height:40px;line-height: 40px; width:20%; float:right; font-size:12px; text-align:right; line-height:18px; margin-left:-20%;}
.log_list .right span {color:#f90; font-size:14px; line-height:28px;}
.log_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
#log_loading { padding:10px;color:#666;text-align: center;}

</style>

<div class="log_top">
    <div class="title" onclick='history.back()'><i class='fa fa-chevron-left'></i></div>
    <div class="title">奖金明细</div>
    
</div>
<div id='container'>
    <?php  if(is_array($list)) { foreach($list as $item) { ?>
    <div class="log_list" data-applyid=' '>
        <div class="left">
            <div class='inner'>
                编号: <?php  echo $item['logno'];?> <br>
                <span>发奖时间 : <?php  echo date('Y-m-d H:i:s',$item['createtime'])?></span>
            </div>
        </div>
    <div class="right"><?php  echo $item['title'];?><br><span>+<?php  echo $item['money'];?></span></div>
    </div>
    <?php  } } ?>
</div>

<!-- <script id='tpl_log' type='text/html'>
    <%each list as log%>
    <div class="log_list"
       data-applyid='<%log.id%>'>
    <div class="left"><div class='inner'>编号: <%log.send_bonus_sn%>（<%if log.paymethod>0%>微信钱包<%else%>余额<%/if%>）<%if log.isglobal==1%>全球分红<%/if%><br><span>
                分红<?php  echo $this->set['texts']['commission']?>: <%log.commission%>
                分红时间:
                <%log.dealtime%></span></div></div>
    <div class="right">+<%log.money%><br><span><%log.statusstr%></span></div>
    </div>
    <%/each%>
</script> -->
<script id='tpl_empty' type='text/html'>
    <div class="log_no"><i class="fa fa-file-text-o" style="font-size:100px;"></i><br><br>c<span style="line-height:18px; font-size:16px;">您还没有相关明细~</span></div>
</script>

<script language="javascript">
    var page = 1;
    var current_status = '';
    require(['tpl', 'core'], function (tpl, core) {

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
                $('#container').append('<div id="log_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                page++;
                core.pjson('twoway/log', {status:current_status,page: page}, function (morejson) {
                    stop = true;
                    $('#log_loading').remove();
                    $("#container").append(tpl('tpl_log', morejson.result));
                    if (morejson.result.list.length < morejson.result.pagesize) {
                        $("#container").append('<div id="log_loading">已经加载完全部订单</div>');
                        loaded = true;
                        $(window).scroll = null;
                        return;
                    }
                }, true);
            }
        }
    });
}
function getLog(status) {
    $('.log_menu .nav').removeClass('navon');
    $('.log_menu .nav[data-status=\'' + status + '\']').addClass('navon');
    core.pjson('twoway/log', {status:status, page: page}, function (json) {
        $('#total').html( json.result.total);
       $('#commissioncount').html( json.result.commissioncount);
        if (!json.result.list.length) {
            $('#container').html(tpl('tpl_empty'));
            return;
        }


        $('#container').html(tpl('tpl_log', json.result));
         $('.log_list').unbind('click').click(function(){
            var applyid = $(this).data('applyid');
            var url = core.getUrl('plugin/twoway/log',{'op':'detail','id':applyid});
            //location.href = url;
            return;
         });


        bindScroller();
    }, true);
}

$('.log_menu .nav').unbind('click').click(function () {
                page = 1; current_status = $(this).data('status')
                getLog(current_status);
            });
    getLog('');

})
</script>
<?php  $show_footer=true;$footer_current ='twoway'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
