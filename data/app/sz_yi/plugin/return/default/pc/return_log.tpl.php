<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?>
<title>返利记录</title>
<style type="text/css">
    body {margin:0px; background:#eee; font-family:'微软雅黑'; -moz-appearance:none;}
    .credit_list {height:60px; width:100%; background:#fff; padding:10px 0 10px 10px;border-bottom: 1px solid #e8e8e8;}

    .credit_list .info {height:40px; width:50%; float:left;  font-size:16px; color:#666; line-height:20px; text-align:left;}
    .credit_list .info span {font-size:14px; color:#999;}
    .credit_list .num {height:40px; border-left:1px solid #eaeaea; width:20%;line-height:20px; float:right; text-align:center; font-size:16px; color:#666;}
    .credit_list .num span {font-size:14px; color:#999;}
    .credit_tab {height:32px;border:1px solid #e31939; border-radius:5px; /* overflow:hidden; */font-size:13px;background:#fff;margin-left: -1px;}
    .credit_nav {height:30px; width:50%; border-radius:5px; background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
    .credit_navon {color:#fff; background:#e31939;}
    .credit_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    #credit_loading { padding:10px;color:#666;text-align: center;}
.history_top {height:44px;  background:#e8e8e8; padding:0px 1%; border-bottom:1px solid #e3e3e3;}
.history_top .title {height:44px; width:auto; float:left; font-size:16px; line-height:44px; color:#666;}
.history_top .nav {height:30px; width:auto; background:#fff; padding:0px 10px; border:1px solid #e3e3e3; border-radius:5px; float:right; line-height:30px; margin:6px 0px 0px 16px; color:#666; font-size:14px;}

</style>
<!-- <div class="page_topbar">
    <div class="title">返利记录</div>
</div> -->


<div style="width: 960px;float: left;margin-left: 15px;">
    <div class="page_topbar">
        <div class="title">全返明细</div>
    </div>
    <div class="credit_tab">
        <div class="credit_nav <?php  if($_GPC['type']==0) { ?>credit_navon<?php  } ?>" data-type='0' >返利记录</div>
        <div class="credit_nav <?php  if($_GPC['type']==1) { ?>credit_navon<?php  } ?>"  data-type='1'>排列记录</div>
    </div>
</div>

<div id='container' class="rightlist" style="width: 960px;float: left;margin-left: 15px;"></div></div>
<script id='tpl_log' type='text/html'>


    <%if type==0%>
        <%each list as log%>
            <div class="credit_list">
                <div class="info">
                    <span>应返金额<%log.money%> 元</span><br/>
                    <span>返利时间<%log.createtime%></span>
                </div>
                <div class="num">
                    <span>已返金额<%log.return_money%> 元</span><br/>
                    <span>
                    <%if log.money-log.return_money==0%>
                        已完成
                    <%else%>
                        剩余金额<%log.money-log.return_money%> 元
                    <%/if%>
                    </span></div>

                </div>
            </div>
        <%/each%>
    <%/if%>
    <%if type==1%>
        <%each list as log%>
            <div class="credit_list">
                <div class="info">
                    <span><%log.title%> </span><br/>
                    <span>排列时间<%log.createtime%></span>
                </div>

                <div class="num">
                    <span>队列数量:<%log.total%> </span><br/>
                    <span class="queueinfo"  data-type='2' data-goodsid='<%log.goodsid%>'>查看详情</span>
                </div>
            </div>
        <%/each%>
    <%/if%>
    <%if type==2%>
        <%each list as log%>
            <div class="credit_list">
                <div class="info">
                    <span><%log.title%> </span><br/>
                    <span>排列时间<%log.createtime%></span>
                </div>

                <div class="num">
                    <span>队列编号:<%log.id%> </span><br/>
                    <span>队列状态:<%if log.status == 0%>等待返现<%else%>已返现<%/if%> </span><br/>

                </div>
            </div>
        <%/each%>
    <%/if%>
</script>
<script id='tpl_empty' type='text/html'>
    <div class="credit_no"><i class="fa fa-file-text-o" style="font-size:100px;"></i><br><br><span style="line-height:18px; font-size:16px;">暂时没有任何记录~</span></div>
</script>

<script language="javascript">
    var page = 1;
    var scrolled = false;
    var current_type = "<?php  echo intval($_GPC['type'])?>";
    var goodsid = "<?php  echo intval($_GPC['goodsid'])?>";
    require(['tpl', 'core'], function (tpl, core) {

function bindScroller(){
        var loaded = false;
        var stop = true;


        $(window).scroll(function () {
            //console.log(loaded);
            if (loaded) {
                return;
            }
            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
            if ($(document).height() <= totalheight) {
                if (stop == true) {
                    stop = false; scrolled = true;
                    $('#container').append('<div id="credit_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                    page++;

                    core.pjson('return/return_log', {type: current_type,goodsid:goodsid,page: page}, function (json) {
                        stop = true;
                        $('#credit_loading').remove();
                        $("#container").append(tpl('tpl_log', json.result));
                        if (json.result.list.length < json.result.pagesize) {
                            $('#credit_loading').remove();
                            //$('#credit_loading').html('已经加载完全部记录');
                            $("#container").append('<div id="credit_loading">已经加载完全部记录</div>');
                            loaded = true;
                            //console.log('loaded:'+loaded);
                            $(window).scroll = null;
                            return;
                        }
                    }, true);
                }
            }
        });
}
        function getLog(type) {
            if(goodsid==0)
            {
                $('.credit_nav').removeClass('credit_navon');
                $('.credit_nav[data-type=' + type + ']').addClass('credit_navon');
            }

            core.pjson('return/return_log', {type:type,goodsid:goodsid,page: page}, function (json) {
                if (json.result.list.length <= 0) {
                    $('#container').html(tpl('tpl_empty'));
                    return;
                }
                $('#container').html(tpl('tpl_log', json.result));
                bindScroller();
            }, true);
        }

        $(document).on('click','.queueinfo',function(){
            page = 1;
            current_type = $(this).data('type');
            goodsid = $(this).data('goodsid');
            getLog(current_type);
        })

        $(document).on('click','.credit_nav',function(){
            page = 1;
            current_type = $(this).data('type');
            getLog(current_type);
        });
        getLog(current_type);
    })
</script>
<?php  $show_footer=true?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>