<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>返利记录</title>

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/plugin/return/template/mobile/default/rebate/css/aui.2.0.css">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/plugin/return/template/mobile/default/rebate/css/center.css">
<style type="text/css">
    body {margin:0px; background:#f2f2f2; font-family:'微软雅黑'; -moz-appearance:none;}
    .credit_list {background: white; height:60px; width:100%; padding:10px 3%;margin-top:5px;}
    
    .credit_list .info {height:40px; width:50%; float:left;  font-size:16px; color:#666; line-height:20px; text-align:left;}
    .credit_list .info span {font-size:14px; color:#999;}
    .credit_list .num2 { padding-left: 10px;height:40px; border-left:1px solid #eaeaea; width:40%;line-height:20px; float:left; text-align:left; font-size:16px; color:#666;}
    .credit_list .num2 span {font-size:14px; color:#999;}
    .credit_tab {height:30px; margin:5px; border:1px solid #e45050; border-radius:5px; overflow:hidden;font-size:13px;background:#fff;padding-right: -2px;}
    .credit_nav {height:30px; width:50%;  background:#fff; color:#e45050; text-align:center; line-height:30px; float:left;}
    .credit_navon {color:#fff; background:#e45050;}
    .credit_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    #credit_loading { padding:10px;color:#666;text-align: center;}
    .detail{font-size: 14px;color: #999;width: 10%;float: right;}
    @media screen  and (max-width: 320px){
        .credit_list .info span{font-size: 13px;}
        .credit_list .num2 span{font-size: 13px;}
        .credit_list .info{width: 55%;}
        .credit_list .num2{width: 35%;padding-left: 0px;}
    }



</style>

<div class="page_topbar">
    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
    <div class="title">返利记录</div>
    <a href="#">
      <i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i>
    </a>
</div>

<div style="    position: relative;
    height: 29px;
    background: #f9f9f9;
    border-bottom: 1px solid #e8e8e8;
    font-size: 14px;
    line-height: 29px;
    text-align: center;">
	<div style=" height:25px;">以下返利自动进余额，在余额中提现！</div>
</div>
<div class="credit_tab">
    <div class="credit_nav <?php  if($_GPC['type']==0) { ?>credit_navon<?php  } ?>" data-type='0' >免单明细</div>
    <div class="credit_nav <?php  if($_GPC['type']==1) { ?>credit_navon<?php  } ?>"  data-type='1'>排列记录</div>
</div>

<div id='container'></div>

<script id='tpl_log' type='text/html'>
    <%if type==0%>
        <%each list as log%>
            <div class="credit_list" style="background: white;">
                <div class="info">
                    <span>应返金额<%log.money%> 元</span><br/>
                    <span>返利时间<%log.createtime%></span>
                </div>
                <div class="num2">
                    <span>已返金额<%log.return_money%> 元</span><br/>
                    <span>
					<%if log.status==1%>
                        已完成
                    <%else%>
                        剩余金额<%log.mon%> 元
                    <%/if%>
                    </span>
                </div>
                <div class="detail" data-type='3' data-goodsid='<%log.id%>'>
                    查看详情
                </div>
                   
                </div>
            </div>
        <%/each%>
    <%/if%>
    <%if type==1%>
        <%each list as log%>
            <div class="credit_list"  style="background: white;">
                <div class="info" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                    <span><%log.title%> </span><br/>
                    <span>排列时间<%log.createtime%></span>
                </div>

                <div class="num2" style="width: 40%;padding-left: 10px;">
                    <span>队列数量:<%log.total%> </span><br/>
                    <span class="queueinfo"  data-type='2' data-goodsid='<%log.goodsid%>'>查看详情</span> 
                </div>
            </div>
        <%/each%>
    <%/if%>
    <%if type==2%>
        <%each list as log%>
            <div class="credit_list">
                <div class="info" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                    <span><%log.title%> </span><br/>
                    <span>排列时间<%log.createtime%></span>
                </div>

                <div class="num2" style="width: 40%;padding-left: 10px;">
                    <span>队列编号:<%log.id%> </span><br/>
                    <span>队列状态:<%if log.status == 0%>等待返现<%else%>已返现<%/if%> </span><br/>
 
                </div>
            </div>
        <%/each%>
    <%/if%>
    <%if type==3%>
        <%each list as log%>
            <div class="credit_list">
                <div class="info" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                    <!-- <span><%log.title%> </span><br/> -->
                    <span>返现时间<br/><%log.createtime%></span>
                </div>

                <div class="num2">
                    <span>返现金额:<%log.price%> </span><br/>
                    <span>返现类型:<%if log.type == 0%>余额<%else%>微信<%/if%> </span><br/>
 
                </div>
            </div>
        <%/each%>       
    <%/if%>
</script>
<!--<div class="credit_no"><i class="fa fa-file-text-o" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">暂时没有任何记录~</span></div>-->
<script id='tpl_empty' type='text/html'>
    <div style="width: 190px; margin: 0 auto;width: 80%;height: 180px;margin: 120px auto 0 auto;">
    	<img style="width:60px;display:block;margin:0 auto;" src="../addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/Full-return-details.png" alt="">
    	<span style="display:block;margin-top: 18px; text-align:center;">暂时没有任何记录~</span></br>   	
	</div>
</script>

<script language="javascript">
    var page = 1;
    var scrolled = false;
    var current_type = "<?php  echo intval($_GPC['type'])?>";
    var goodsid = "<?php  echo intval($_GPC['goodsid'])?>";
    require(['tpl', 'core'], function (tpl, core) {
var a ="<?php  echo $this->createPluginMobileUrl('return/return_log',array('op'=>'dispaly','id'=>$id))?>";
console.log(a)
function bindScroller(type){
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
                    var dataType =$(".credit_tab").attr("data-type");

                    if(dataType==3){
                        arg= {
                                type:current_type,
                                id:goodsid,
                                page:page,
                            }
                    }else{
                        arg= {
                                type:current_type,
                                goodsid:goodsid,
                                page:page,
                            }
                    }
   
                    core.pjson('return/return_log', arg, function (json) {
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
            if(type==0){
                $('.credit_nav').removeClass('credit_navon');
                $('.credit_nav[data-type=' + type + ']').addClass('credit_navon'); 
            }else{
                $('.credit_nav').removeClass('credit_navon');
                $('.credit_nav[data-type=' + type + ']').addClass('credit_navon'); 
            }

            if(type==3){
                 arg= {
                        type:current_type,
                        id:goodsid,
                        page:page,
                    }
            }else{
                arg= {
                        type:current_type,
                        goodsid:goodsid,
                        page:page,
                    }
            }
            core.pjson('return/return_log', arg, function (json) {
                if (json.result.list.length <= 0) {
                    $('#container').html(tpl('tpl_empty'));
                    return;
                }
                $('#container').html(tpl('tpl_log', json.result));
                bindScroller(type);
            }, true);
        }

        $(document).on('click','.queueinfo',function(){
            page = 1;
            current_type = $(this).data('type');
            $(".credit_tab").attr("data-type",current_type);
            goodsid = $(this).data('goodsid');
            getLog(current_type);
            $('.credit_nav[data-type=1]').addClass('credit_navon'); 

        })

        $(document).on('click','.detail',function(){
            page = 1;
            current_type = $(this).data('type');
            $(".credit_tab").attr("data-type",current_type);
            goodsid = $(this).data('goodsid');
            getLog(current_type);
            $('.credit_nav[data-type=0]').addClass('credit_navon'); 

        })

        $('.credit_nav').unbind('click').click(function () {
            page = 1;
            current_type = $(this).data('type');
            $(".credit_tab").attr("data-type",current_type);
            getLog(current_type);

        });
        getLog(current_type);
    })
</script>
<?php  $show_footer=true?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
