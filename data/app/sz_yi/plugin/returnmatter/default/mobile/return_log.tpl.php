<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>购物返</title>
<style type="text/css">
    body {margin:0px; background:#f2f2f2 ; font-family:'微软雅黑'; -moz-appearance:none;}
    .credit_list {height:60px; width:98%; background:#fff; padding:10px 3%;margin-top:5px;}
    
    .credit_list .info {height:50px; width:60%; float:left;  font-size:16px; color:#666; line-height:20px; text-align:left;}
    .credit_list .info span {font-size:12px; color:#999;}
    .credit_list .num {height:50px; border-left:1px solid #eaeaea; width:40%;line-height:20px; float:right; text-align:left; font-size:16px; color:#666;}
    .credit_list .num span {font-size:14px; color:#999;}
    .credit_tab {height:70px; margin:5px; border:2px solid #00c1ff; border-radius:5px; overflow:hidden;font-size:14px;background:#f9f9f9;}
    .credit_nav {height:80px; width:50%;  background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
    .credit_navon {color:#fff; background:#00c1ff;}
    .credit_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    #credit_loading { padding:10px;color:#666;text-align: center;}

</style>
<div class="page_topbar">
    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
    <div class="title">购物返</div>
</div>


<div id='container'></div>

<script id='tpl_log' type='text/html'>
   
        <%each list as log%>
			<%if log.money!=0%>
            <div class="credit_list">
                <div class="info">
                    <span>返利时间<%log.createtime%></span>
                </div>
                <div class="num">
                    <span>已返金额 <%log.money%> 元</span><br/>
                    <span>
                   
                    </span></div>
                   
                </div>
            </div>
			<%/if%>
        <%/each%>
    
   
</script>
<script id='tpl_empty' type='text/html'>
   <!--  <div class="credit_no" style="padding-top: 30px; width: 190px; margin: 0 auto;width: 80%;height: 180px;margin: 120px auto 0 auto;background: #fff"><i class="fa fa-file-text-o" style="font-size:100px;"></i><br><br><span style="line-height:18px; font-size:16px;">暂时没有任何记录~</span></div> -->
   <div style="width:80%;height:180px;margin:120px auto 0 auto;padding:50px 0 0 0;">
        <img style="width:60px;display:block;margin:0 auto;" src="../addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/return_log.png" alt="">
        <span style="display:block;margin-top: 6px; text-align:center;">暂时没有任何记录~</span></br>
        <span style="width: 100px;background:#e45050;padding:5px 21px;color:#fff;border-radius:4px;margin: 0 auto;display: block;"  onclick="location.href='<?php  echo $this->getUrl()?>'">随便逛逛</span>
    </div>
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
   
                    core.pjson('returnmatter/return_log', {type: current_type,goodsid:goodsid,page: page}, function (json) {
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

            core.pjson('returnmatter/return_log', {type:type,goodsid:goodsid,page: page}, function (json) {
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

        $('.credit_nav').unbind('click').click(function () {
            page = 1;
            current_type = $(this).data('type');
            getLog(current_type);

        });
        getLog(current_type);
    })
</script>
<?php  $show_footer=true?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
