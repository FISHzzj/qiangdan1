<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>商家订单管理</title>
<style type="text/css">
    th{font-weight: 200;}
    body {margin:0px; background:#f2f2f2; padding:0px; -moz-appearance:none; font-family:'微软雅黑';}
	button{border:none;background:transparent;outline:none;}
	p{margin:0px;}

    #big_body{width:100%;margin:0px; float: left;}


    #header{ width:100%; padding-top:10px; padding-bottom: 10px; background:#10BDFF;  text-align: center; color:#fff;  }
    #header table{margin: auto; width:95%; font-size: 16px;  }

    #list{width:100%;   background: #fff;}
    #list table{width:100%;}
    #list table th{color: #787878 ;width:25%;text-decoration:none; padding-top:10px; padding-bottom:10px;}

    #list table th#action{color:#FF3737; border-bottom: 1px solid #FF3E3E ; }
    #list  ul{float: left; width: 100%; background: #fff;border-bottom: 1px solid #ccc; }
    #list ul li{float: left; width: 20%; text-align: center; padding-top: 10px; padding-bottom: 10px; color: #787878 ;}
    #list  ul li#action{  color:#e45050; border-bottom: 2px solid #e45050 ;  }

    #list-body{width:100%; float: left; margin-bottom: 10px; text-align: center;background: #fff}
    #list-body>ul{width: 95%; padding-top: 10px; padding-bottom: 10px; margin: auto; background: #fff; font-size:11px; }
     #list-body>ul>li{width:100%;float: left; border-bottom:1px solid #CFCFCF; padding-bottom:8px;padding-top:8px; line-height: 100%; word-break:break-all;   }
    #list-body #center{}
    #list-body #center>li{float:left;}

    #big_body #box{width:100%;margin:0px; float: left;padding-bottom: 45px;}
	#header table th>span{font-size:16px;font-family: serif,"PingFang SC", Helvetica, "Helvetica Neue", "微软雅黑", Tahoma, Arial, sans-serif;font-weight: bold; padding-right: 4px; }
	.orderDet{width:100%;background:#fff;}
	.orderDet>tbody>tr{margin:10px;}
	.orderDet  .lineb{background: #F2F2F2;}
	.orderDet>tbody>tr>td{padding:8px;}
	.orderDet  .lineh>span{color:#aaa;float: left;font-size: 13px;}
	.orderDet  .lineh>time,.orderDet  .lineh>p{float:right;}
	.orderDet  .lineh>time>i,.orderDet  .lineh>p>i{font-size:1.3em;margin-right:5px;vertical-align: middle;color: #949495;}
	.orderDet  .linep{border-top:1px solid #F2F1F1;}
	.orderDet  .linef>p{float:right;font-size:0.95em;color:#989898;}
	.orderDet  .linef>p>b{color:#FF3E3E;font-size:1.49em;font-weight:normal;line-height: 1.0em;}
	.orderDet  .linef>p>span{padding: 0 5px;}

	.lineb>p{padding-bottom:8px;text-align: left;}
	/*.orderDet  li.prod{border-top:1px solid #ccc;padding:8px 0px;}*/
	.orderDet  li.prod:after{content:"";display:block;clear:both;}
	.orderDet  .prod>div{float:left;}
	.orderDet  .prod  .img{width:20%;}
	.orderDet  .prod  .img>img{width:90%;height: 5.3em;}
	.orderDet  .prod  .info{width:54%;text-align: left;padding: 0px 7px;}
	.orderDet  .prod  .info>span{color:#989898;}
	.orderDet  .prod  .price{width:26%;text-align:right;}
	.orderDet  .linep>button{border: 1px solid #FF3E3E;color: #FF3E3E;border-radius:7px;padding:5px 23px;float:right;margin-left:10px;}
    body{background: #f2f2f2;}
    .f-marginTB10{margin:5px 0;}
    .peiDiv{width: 70%;margin: 0 auto;background: white;padding: 5%;border-radius: 3px;position:relative;}
    .red{color: #F44336;}
    .close2{position: absolute;right: 10px;top:-5px;font-size: 28px;color:#969292;}
/*     .dropload-noData {
background: #fff url(../addons/sz_yi/static/images/finish.png) no-repeat;
background-size: 100%;
height: 180px;
} */

</style>
<script type="text/javascript" src="<?php echo MODULE_URL.'plugin/suppliermenu/res/dropload.min.js?'.time();?>"></script>

<div id="big_body">
      <div class="page_topbar">
        <a href="#" class="back" onclick="history.back()">
          <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
        </a>
        <div class="title" style=" color: #282828;">商家订单管理</div>
        <a href="#">
            <i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i>
        </a>
      </div>

     <div id="list">
        <ul>
            <li <?php  if($type==0) { ?>id="action"<?php  } ?> onclick="window.location.href = '<?php  echo $this->createPluginMobileUrl('suppliermenu/order',array('type'=>0)); ?>' "    >全部</li>
            <li <?php  if($type==1) { ?>id="action"<?php  } ?> onclick="window.location.href = '<?php  echo $this->createPluginMobileUrl('suppliermenu/order',array('type'=>1)); ?>' "    >待付款</li>
            <li <?php  if($type==2) { ?>id="action"<?php  } ?> onclick="window.location.href = '<?php  echo $this->createPluginMobileUrl('suppliermenu/order',array('type'=>2)); ?>' "    >待发货</li>
            <li <?php  if($type==3) { ?>id="action"<?php  } ?> onclick="window.location.href = '<?php  echo $this->createPluginMobileUrl('suppliermenu/order',array('type'=>3)); ?>' "    >待收货</li>
            <li <?php  if($type==4) { ?>id="action"<?php  } ?> onclick="window.location.href = '<?php  echo $this->createPluginMobileUrl('suppliermenu/order',array('type'=>4)); ?>' "    >已完成</li>
        </ul>
     </div>

    <div id="box">
	</div>
	<!--
		没商品时显示的图片和提示【您还没有相关订单】来自
		目录下的/public_html/addons/sz_yi/plugin/suppliermenu/res/
		dropload.min.js
	-->
</div>

<script id="tpl_list" type="text/html">
      <div id="list">
        <ul>
            <%each data as  d%>
            <li><%d.name%></li>
            <%/each%>
        </ul>
     </div>
</script>

<script id="tpl-list-body" type="text/html">
<%each order as d%>
    <div id="list-body" data-orderid="<%d.id%>" class="order_list">
		<table class="orderDet">
			<tbody>
				<tr>
					<td class="lineh">
						<span id="status-<%d.id%>">订单号：<%d.ordersn%></span>
						<%if d.status==0%>
							<time><i class="fa fa-clock-o"></i>等待付款</time>
						<%/if%>

                        <%if d.status==1%>
                            <p><i class="fa fa-file-text-o"></i>买家已付款</p>
                        <%/if%>

                        <%if d.status==2%>
                            <p><i class="fa fa-truck"></i>已发货</p>
                        <%/if%>
                        <%if d.status==3%>
                            <p><i class="fa fa-check" style="color:#4caf50;"></i>已完成</p>
                        <%/if%>
					</td>
				</tr>
                <%each d.goods as g%>
				<tr>
					<td class="lineb">
						<!-- <p>布尔根兰旗舰店</p> <button>查看物流</button>-->
						<ul>
							<li class="prod">
								<!-- ../addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/7.png -->
								<div class="img"><img src="<%g.thumb%>"></div>
								<div class="info"><p><%g.title%></p><span><!-- 净重：500g --></span></div>
								<div class="price"><p>￥<%g.realprice%></p><span>×<%g.total%></span></div>
							</li>
						</ul>
					</td>
				</tr>
                <%/each%>
                <%if d.refundid == 0%>
    				<%if d.status==0%>
        				<tr>
                            <td class="linef">
                                <p>总计：￥<b><%d.price%></b></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="linep">
                                <button onclick="acorder('confirmPay', this);">确认付款</button>
                            </td>
                        </tr>

                    <%else if d.status==1%>
                        <tr>
                            <td class="linef">
                                <p>共<span><%d.total%></span>件商品，实付：￥<b><%d.price%></b></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="linep">
                                <button onclick="acorder('send', this);">去发货</button>
                            </td>
                        </tr>

    				<%else if d.status==2%>
        				<tr>
                            <td class="linef">
                                <p>共<span><%d.total%></span>件商品，实付：￥<b><%d.price%></b></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="linep">
                                <button onclick="acorder('cancel', this);">取消发货</button>
                                <button onclick="acorder('orderFinish', this);">确认收货</button>
                                <button class="order_express">查看物流</button>
                                <!-- <button class="peiTime" data-type="0">配送时间</button> -->
                            </td>
                        </tr>
                        <!-- <tr style="background: #e7e7e7;display: none;" class="peiTimeTr">
                            <td>
                                <div class="f-fsize15 peiDiv">
                                    <p>开始配送时间</p>
                                    <div class="close2">×</div>
                                    <p class="time f-fsize18 f-marginTB5 red">2018-12-25&nbsp;19:52:48</p>
                                    <p>配送时间为<span class="red">30</span>分钟</p>
                                </div>
                            </td>
                        </tr> -->

    				<%else if d.status==3%>
                        <tr>
                            <td class="linef">
                                <p>共<span><%d.total%></span>件商品</p>
                            </td>
                        </tr>
                    <%/if%>
                <%else if d.refundid != 0%>
                    <tr>
                        <td class="linef">
                            <p><label class="label label-danger">退款申请中</label><span>请到PC端操作</span></p>
                        </td>
                    </tr>
                <%/if%>
			</tbody>
		</table>
    </div>
<%/each%>
</script>


<script type="text/javascript">

function acorder(action = '', dthis){
	require(['core'], function( core) {
	    core.tip.confirm('您确定要做此操作吗？', function(){
	        var orderid = $(dthis). parents('.order_list').data('orderid');
	        if (orderid != '') {
                // 支付或完成订单
                if (action == 'confirmPay' || action == 'orderFinish') {
                    core.pjson('suppliermenu/order', {op:'deal', oid:orderid, to:action}, function(json) {
                        console.log(json);
                        if (json.status == 1) {
                            core.tip.alert(json.result, function(){
                                window.location.reload();
                            });
                        } else {
                            core.tip.alert(json.result);
                        }
                    }, true);
                } else if (action == 'send') {
                    // 发货到这个区间
                    var url = "<?php  echo $this->createPluginMobileUrl('suppliermenu/order', array('op' => 'send', 'action' => 'send'))?>";
                    url += '&oid=' + orderid;
                    window.location.href = url;
                } else if (action == 'cancel') {
                    // 取消发货到这个区间
                    var url = "<?php  echo $this->createPluginMobileUrl('suppliermenu/order', array('op' => 'send', 'action' => 'cancel'))?>";
                    url += '&oid=' + orderid;
                    window.location.href = url;
                }
	        }
	    });
	});
}

// 调用的地方在: public_html/addons/sz_yi/plugin/suppliermenu/res/dropload.min.js
function goindex(){
    window.location.href = "<?php  echo $this->createMobileUrl('shop/list')?>";
}

function delete_sure(id){
   if(window.confirm('你确定要取消订单吗？')) {
      require(['core'], function( core) {
            core.pjson('suppliermenu/order', {op:'delete',id:id}, function(json) {
                     if(json.result.status){
                        $("#status-"+id).text('已取消');
                        $("#delete-"+id).hide();
                        alert('取消成功');
                     }else{
                        alert('取消失败');
                     }
            }, true);
      });
   }
}
require(['tpl', 'core'], function(tpl, core) {

    var page = 0;
    $('#big_body').dropload({
        scrollArea : window,
        loadDownFn : function(me){
            if(page<0) { alert();me.noData();return ;}
            core.pjson('suppliermenu/order', {op:'order',page:page,type:<?php  echo $type;?>}, function(json) {
				console.log(json.result);
				if(json.result.order.length>0){

					$(".dropload-down").css("display","none");
				}
                $("#box").append(  tpl('tpl-list-body',json.result) );

                // $(".peiTime").on("click",function(){
                //     var type = $(this).attr("data-type");
                //     if(type==0){
                //         $(this).parents(".orderDet").find(".peiTimeTr").show();
                //         $(this).attr("data-type",1);
                //     }else{
                //         $(this).parents(".orderDet").find(".peiTimeTr").hide();
                //         $(this).attr("data-type",0);
                //     }

                // })

                // $(".close2").on("click",function(){
                //     $(this).parents(".orderDet").find(".peiTimeTr").hide();
                //     $(this).parents(".orderDet").find(".peiTime").attr("data-type",0);
                // })




				$('.order_express').unbind('click').click(function() {
                    var orderid = $(this). parents('.order_list').data('orderid');
                    location.href = core.getUrl('order/express', {id: orderid});
				});
                if(json.result.status==true){
                  page++;
                  me.resetload();
                }else{
                 page=-1;
                 me.lock();
                 me.noData();
                 me.resetload();
                }

            }, true);
        }
    });

});


</script>
<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>