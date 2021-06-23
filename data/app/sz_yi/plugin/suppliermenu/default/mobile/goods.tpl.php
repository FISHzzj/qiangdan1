<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<?php  if($op == 'display') { ?>
<title>宝贝管理</title>
<style type="text/css">
    th{font-weight: 200;}
    body {margin:0px; background:#f2f2f2; padding:0px; -moz-appearance:none; font-family:微软雅黑;}
    #big_body{width:100%;margin:0px; float: left;margin-bottom: 53px;}

	.customer_top {height:44px; width:100%;  background:#009BF8;  border-bottom:1px solid #ccc;}
	.customer_top .title {height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#fff;}
	.customer_top .title1{height: 44px;line-height: 44px;display: inline-block;width: 70%;text-align: center;color:#fff;font-size:16px;}
	.back{width: 18px;height: 19px;font-size: 22px;border-radius: 50%;float: left;line-height: 44px; font-family:serif,"PingFang SC", Helvetica, "Helvetica Neue", "微软雅黑", Tahoma, Arial, sans-serif;font-weight: bold;}

    #list{width:100%;   background: #fff;}
    #list table{width:100%;}
    #list table th{color: #787878 ;width:25%;text-decoration:none; padding-top:10px; padding-bottom:10px;}

    #list table th#action{color:#FF3737; border-bottom: 1px solid #FF3E3E ; }
    #list  ul{float: left; width: 100%; background: #fff;border-bottom:1px solid #ECEDED;}
    #list ul li{float: left; width: 50%; text-align: center; padding-bottom: 10px; color: #787878;height: 40px;}
    #list  ul li>span{display: block;width: 100%;text-align:center;height: 40px;line-height: 40px;}
    #list  ul li#action>span{color: #e45050;border-bottom: 2px solid #e45050;}

    #list-body{width:100%; float: left; margin-top: 10px; text-align: center;background: #fff}
    #list-body>ul{width: 95%; padding-top: 10px; padding-bottom: 10px; margin: auto; background: #fff; font-size:11px; }
     #list-body>ul>li{width:100%;float: left; border-bottom:1px solid #CFCFCF; padding-bottom:8px;padding-top:8px; line-height: 100%; word-break:break-all;   }
    #list-body #center{}
    #list-body #center>li{float:left;}

    #big_body #box{width:100%;margin:0px; float: left;}
    #big_body #box>table{width:100%;margin:0px; float: left; text-align: center; }
    #big_body #box>table td{padding-top:10px;padding-bottom:10px;}


    #big_body #box>ul{width: 100%; float: left; text-align: center;}
    #big_body #box>ul>li{float: left;width: 45%;margin-top:15px;font-size: 12px;border:1px solid #eaeaea;padding-bottom:2px;background: #fff;}
	#big_body #box>ul>li>img{width:100%;height:14em;}
	#big_body #box>ul>li>.Tit{text-align:left;padding-top:5px;padding-left:6px;height: 50px;color:#656565;font-size: 14px;padding-right: 6px;overflow:hidden; text-overflow:ellipsis;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2; }
	#big_body #box>ul>li>.money{color:#e45050;margin-bottom:0px;padding-left:4px;font-size: 12px;text-align: left;position: relative;}
  #big_body #box>ul>li>.money>span{font-size:16px;}
    #big_body #box>ul>li:nth-child(2n+1){margin-left:3%;margin-right:4%;}
 .dropload-noData {
    background: #fff url(../addons/sz_yi/static/images/finish.png) no-repeat;
    background-size: 100%;
    height: 180px;
}

 
</style>
<script type="text/javascript" src="<?php echo MODULE_URL.'plugin/suppliermenu/res/dropload.min.js?'.time();?>"></script>

<div id="big_body">
    <!-- <div class="customer_top">
		<div class="title" onclick='history.back()'><span class="back">&lt;</span>返回</div>
		<div class="title1">
			宝贝管理
		</div>
	</div> -->
  <div class="page_topbar" style="background: #fff;border-bottom: 1px solid #eaeaea">
    <a href="#" class="back" onclick="history.back()">
      <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
    </a>
    <div class="title" style=" color: #282828;">宝贝管理</div>
    
  </div>
    <div id="list" style="margin-top: 1px;">
        <ul>
            <li <?php  if($type==1) { ?>id="action"<?php  } ?> onclick="window.location.href = '<?php  echo $this->createPluginMobileUrl('suppliermenu/goods',array('type'=>1)); ?>' "    >
				<span>出售中</span>
			</li>
            <li <?php  if($type==0) { ?>id="action"<?php  } ?> onclick="window.location.href = '<?php  echo $this->createPluginMobileUrl('suppliermenu/goods',array('type'=>0)); ?>' "   >
				<span>仓库中</span>
			</li>
        </ul>
     </div>
     <div id="box"><ul></ul></div>
     <!--
		没商品时显示的图片和提示【您还没有相关订单】来自
		目录下的/public_html/addons/sz_yi/plugin/suppliermenu/res/
		dropload.min.js
	-->
</div>

<script id="tpl_li" type="text/html">
   <%each goods as g%>
    <li onclick=" window.location.href='<?php  echo $this->createPluginMobileUrl('suppliermenu/goods',array('op'=>'post'));?>&id=<%g.id%>'">
      <img  src="<%g.thumb%>"/>
      <div class="Tit"><%g.title%></div>
      <div class="money">￥<span><%g.marketprice%></span>
          <div style="position: absolute;right: 10px;color: #989898;top:3px;">库存:<%g.total%></div>

      </div>
    </li>
   <%/each%>
</script>

<script type="text/javascript">
// 调用的地方在: public_html/addons/sz_yi/plugin/suppliermenu/res/dropload.min.js
function addgoods(){
    window.location.href = "<?php  echo $this->createPluginMobileUrl('suppliermenu/goods', array('op' => 'post'))?>";
}
require(['tpl', 'core'], function(tpl, core) {

    var page = 0;
    $('#big_body').dropload({
        scrollArea : window,
        loadDownFn : function(me){
            if(page<0) { alert();me.noData();return ;}
            core.pjson('suppliermenu/goods', {op:'get',page:page,type:<?php  echo $type;?>}, function(json) {
				console.log(json.result);
                 $("#box>ul").append(  tpl('tpl_li',json.result) );

                 if(json.result.status==true){
                    page++;
                    me.resetCp();

                 }else{
                    page=-1;
                    me.lock();
                    me.noData();
					me.resetCp();
                 }
				 if(json.result.goods.length>0){
					 console.log(json.result.goods.length);
					$(".dropload-down").css("display","none");
				 }

            }, true);
        }
    });
});
</script>
<?php  } ?>
<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>