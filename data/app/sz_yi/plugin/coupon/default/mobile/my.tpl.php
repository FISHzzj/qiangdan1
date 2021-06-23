<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>我的优惠券</title>
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/plugin/coupon/template/mobile/default/images/style.css">
<style type="text/css">
    body {margin:0px; background:#f2f2f2; font-family:'微软雅黑'; -moz-appearance:none;overflow-x: hidden; }
    a {text-decoration:none;}

    .tab {height:40px; font-size:13px;background:#fff;padding-right: -2px;}
    .nav {color: #656565;font-size: 15px;height:40px;line-height: 40px; border-bottom:2px solid #fff;  width:33.3%;  background:#fff; color:#666; text-align:center;float:left;}
    .navon { border-bottom:2px solid #e45050;color:#e45050;   }
    .no {height:100px; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    #coupon_loading { padding:10px;color:#666;text-align: center;}
   .coupon_no {height:100px;  margin:100px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
   .coupon_menu {height:60px; width:100%; }
   .coupon_no_nav {height:38px; background:#eee; margin:0px 3%; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}
   .coupon_more { height:40px; line-height:40px; font-size:14px;color:#232323; margin:10px; border-radius: 5px; background-repeat:no-repeat; border:1px solid #232323; text-align: center; }
   .emptyDiv{border-radius: 2px;padding: 15px;margin: 0 auto;width: 75%;position: relative;border-radius: 2px;}
   .emptyLine1{position: absolute;height: 1px;background: #a2a2a2;top:40px;left: 30px;width: 70px;}
   .emptyLine2{position: absolute;height: 1px;background: #a2a2a2;top:40px;right:30px;width: 70px;}
   .emptyText{font-size: 14px;color: #e45050;margin-top: 10px}
   .cright{float: left;}
   .coupon_item .cright{width: 40%;}
   .coupon_item .cinfo{float: right;width: 63%;height: 100px; margin-left: 0px;}
   .coupon_item .cinfo .inner{height: 103px;margin-left: 0px;border-bottom: 0px;padding: 0px 10px;}
   .deduct{background:#e45050; }
   .side-deduct{background-position: 2px 0;}
   .coupon_item .cright .sideleft{background: url(../addons/sz_yi/plugin/coupon/template/mobile/default/images/conbg.png) repeat;height: 100px;}


  .coupon_footer {padding:5px 10px; font-size:13px; color:#656565; line-height:20px; text-align:center;background:#efefef;}

.colo656565{color: #656565;} 
.coupon_item .cright{width: 35%;}
.coupon_item .cinfo{float: right;margin-left: 0px;width: 65%;}
.coupon_item .cinfo .inner{margin-left: 0px;height: 115px;padding: 3px 10px;}
.coupon_item .cinfo .inner .name { font-size:14px;color: #656565;overflow:hidden; text-indent: 53px;overflow: hidden;text-overflow: ellipsis;-webkit-line-clamp: 2;-webkit-box-orient: vertical;white-space: normal;line-height: 21px;height: 40px;margin-top: 4px;padding-right: 35px;}
.coupon_item .cinfo .inner .time {margin-top: 5px; font-size:12px; color:#989898; height:18px; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;padding-bottom: 27px;border-bottom: 1px dashed #eaeaea;}
.coupon_item .cinfo .inner .pay { font-size:11px; color:#666; height:20px; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;}
.coupon_item .cright .rinfo .rinner .type{text-align: center;padding-right:0px;}
.coupon_item .cinfo .inner span { padding: 3px 0; }
.coupon_item .cright .rinfo .rinner .price span{font-size: 30px;}
.coupon_item .cright .rinfo .rinner .price{font-size: 18px;text-align: center;padding-right: 0px;padding-top: 25px;}
.coupon_item,.coupon_item .cinfo,.coupon_item .cright,.coupon_item .cright .rinfo{height: auto;}
.deduct{background:#e45050; }
.bg {background: url('../addons/sz_yi/plugin/coupon/template/mobile/default/images/conbg.png') repeat;}
.coupon_item .cright .rinfo .rinner,.coupon_item .cright .sideleft{height: 113px;}
.coupon_item .cright{float: left;margin-left:0px;}
.coupon_item .cright .rinfo .rinner{margin-left: 3px;margin-right: 0px;}
.nameSpan{position: absolute;left: 0px;top: 2px;background: #e45050;text-indent: 0px;width: 45px;height: 17px;border-radius: 2px;font-size: 11px;line-height: 17px;}
.timeSpan{width: 70px;height: 27px;color: #5d99d7;position: absolute;line-height: 25px;right: 10px;margin: 0px;top: 47px;font-size: 13px; border-radius: 3px;background: white;border: 1px solid #5d99d7;line-height: 24px;}
.coupon_item .cinfo .inner{position: relative;}
.newImg{position: absolute;right: 0px;top: 0px}
.newImg img{width: 55px;}
.texttip{background: white;padding:10px;}
.downArrow {
            transition: All 0.4s ease-in-out;
            -webkit-transition: All 0.4s ease-in-out;
            -moz-transition: All 0.4s ease-in-out;
            -o-transition: All 0.4s ease-in-out;
        }
.money,.discount {background:#e45050;}
.redpack,.credit{background: #f98d0f;}


/* 已过期 */
.deduct.guoqi,.nameSpan.guoqi{background: #c2c2c2;}
.newImg.guoqi img{width: 75px;} 
.coupon_item .cright .sideleft.guoqi{background: url(../addons/sz_yi/plugin/coupon/template/mobile/default/images/conbgguoqi.png) repeat;}
.past{background: #c0c0c0 !important;}
@media screen and (max-width: 320px) {
    .emptyLine1{left: 15px;}
    .emptyLine2{right:15px;}
}
@media screen and (min-width: 400px) {
    .emptyLine1{left: 45px;}
    .emptyLine2{right:45px;}
}

</style>
<div class="page_topbar">
	<a href="javascript:;" class="back" onclick="history.back()">
    <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
  </a>
	<div class="title" style=" color: #282828;">我的优惠券</div>
   <a href="#">
      <i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i>
  </a>
</div>


<div class="tab">
    <div class="nav <?php  if($used==0 && $past!=1) { ?>navon<?php  } ?>" onclick="location.href='<?php  echo $this->createPluginMobileUrl('coupon/my')?>'">未使用</div>
    <div class="nav <?php  if($used==1 && $past!=1) { ?>navon<?php  } ?>"  onclick="location.href='<?php  echo $this->createPluginMobileUrl('coupon/my',array('used'=>1))?>'">已使用</div>
    <div class="nav <?php  if($past==1) { ?>navon<?php  } ?>"  onclick="location.href='<?php  echo $this->createPluginMobileUrl('coupon/my',array('past'=>1))?>'" data-past="<?php  echo $past;?>">已过期</div>
</div>
<?php  if(empty($set['closecenter'])) { ?>
<div class="" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon')?>'"></div>
<?php  } ?>
<div id='container'></div>


<script id='tpl_empty' type='text/html'>
	<div class="coupon_no">
    <div>
      <div class="emptyDiv">
          <div class="emptyLine1"></div>
          <img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/tip.png" style="width: 50px;">
        <div class="emptyLine2"></div>
          <div class="f-fsize14" style="color: #656565;" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon')?>'">赶紧去领券中心看看<br>更多优惠券</div>
      </div>
      <div class="emptyText" >你还没有优惠券~</div> 
    </div>
  </div>
</script>

<!-- 未使用 -->
<script id='tpl_list' type='text/html'>
<%each list as coupon%>
<div class="coupon_item">  
  
  <div class="cinfo" >
    <div class="inner f-relative" >
      <div class="newImg ">
        <img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/new.png">
      </div>
      <div class="name f-relative" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon/usecoupon')?>&id=<%coupon.id%>'">
        <div class="u-btn nameSpan  <%coupon.css%>">标注</div>
        <%coupon.couponname%>
      </div>
      <div class="time"><%if coupon.timestr=='0'%>
      永久有效 
      <%else%>
     <%if coupon.timestr=='1'%>
              即<%coupon.gettypestr%>日内 <%coupon.timedays%> 天有效
          <%else%>
      有效期 <%coupon.timestr%>
      <%/if%>
      <%/if%>

      </div>
      <div class="f-marginT5 xiangxi" data-num="0" >
        <span class="" style="color: #989898;">详细信息</span>
        <span class="fr downArrow" style="padding: 0px;">
          <img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/downArrow.png">
        </span>
      </div>

      <!-- <div class='pay'>
        
         
        <%if coupon.getstatus=='0'%><span class="ccreditmoney"><%coupon.money%> 元 +  <%coupon.credit%> 积分</span><%/if%>
        
        <%if coupon.getstatus=='1'%><span class="cmoney"><%coupon.money%></span> 元<%/if%>
        <%if coupon.getstatus=='2'%><span class="ccredit"><%coupon.credit%></span> 积分<%/if%>
        <%if coupon.getstatus=='3'%><span class="cfree">免费领取</span><%/if%>
          <%if coupon.getmax!=-1 && coupon.getmax!=0%>
                   每人限 <%coupon.getmax%> 张 
          <%/if%>
         
      </div> -->
    </div>
  </div>
   <div class="cright" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon/usecoupon')?>&id=<%coupon.id%>'">
       <div class="bg sideleft side side-<%coupon.css%>"></div>
       <div class="rinfo" >
         <div class='rinner <%coupon.css%>'>
         <div class="price"><%if coupon.backpre%>￥<%/if%><span><%coupon._backmoney%></span></div>
         <div class="type"><%coupon.backstr%></div>
         </div>
     </div>
    
  </div>
  <div class="f-cb"></div>
  <div class="texttip" style="margin-top: 1px;display: none;">限品类:仅可购买厨具商品</div>

</div>
<%/each%>
</script>



<!-- ==================================== -->

<!-- 已使用 -->
<!--
<script id='tpl_list' type='text/html'>
<%each list as coupon%>
<div class="coupon_item">
          <%if coupon.past%><div class="coupon_past"><img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/past.png"></div><%/if%>
  <div class="cinfo" >
    <div class="inner f-relative" >
      <div class="newImg guoqi">
        <img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/used.png">
      </div>
      <div class="name f-relative" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon/detail')?>&id=<%coupon.id%>'">
        <div class="u-btn nameSpan guoqi">标注</div>
        <%coupon.couponname%>
      </div>
      <div class="time"><%if coupon.timestr=='0'%>
      永久有效 
      <%else%>
     <%if coupon.timestr=='1'%>
              即<%coupon.gettypestr%>日内 <%coupon.timedays%> 天有效
          <%else%>
      有效期 <%coupon.timestr%>
      <%/if%>
      <%/if%>
 
      </div>
    </div>
  </div>
   <div class="cright" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon/detail')?>&id=<%coupon.id%>'">
       <div class="bg sideleft side guoqi side-<%coupon.css%>"></div>
       <div class="rinfo" >
         <div class='rinner guoqi <%coupon.css%>'>
         <div class="price"><%if coupon.backpre%>￥<%/if%><span><%coupon._backmoney%></span></div>
         <div class="type"><%coupon.backstr%></div>
         </div>
     </div>
    
  </div>
 <div class="f-cb"></div>
</div>
<%/each%>
</script>
-->


<!-- 已过期 -->
<!--
<script id='tpl_list' type='text/html'>
<%each list as coupon%>
<div class="coupon_item">
          <%if coupon.past%><div class="coupon_past"><img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/past.png"></div><%/if%>
  <div class="cinfo" >
    <div class="inner f-relative" >
      <div class="name f-relative" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon/detail')?>&id=<%coupon.id%>'">
        <div class="u-btn nameSpan guoqi">标注</div>
        <%coupon.couponname%>
      </div>
      <div class="time"><%if coupon.timestr=='0'%>
      永久有效 
      <%else%>
     <%if coupon.timestr=='1'%>
              即<%coupon.gettypestr%>日内 <%coupon.timedays%> 天有效
          <%else%>
      有效期 <%coupon.timestr%>
      <%/if%>
      <%/if%>     
      </div>
      <div class="f-marginT5 xiangxi" data-num="0" >
        <span class="" style="color: #989898;">详细信息</span>
        <span class="fr downArrow" style="padding: 0px;">
          <img src="../addons/sz_yi/plugin/coupon/template/mobile/default/images/downArrow.png">
        </span>
      </div>
    </div>
  </div>
   <div class="cright" onclick="location.href = '<?php  echo $this->createPluginMobileUrl('coupon/detail')?>&id=<%coupon.id%>'">
       <div class="bg sideleft side guoqi side-<%coupon.css%>"></div>
       <div class="rinfo" >
         <div class='rinner guoqi <%coupon.css%>'>
         <div class="price"><%if coupon.backpre%>￥<%/if%><span><%coupon._backmoney%></span></div>
         <div class="type"><%coupon.backstr%></div>
         </div>
     </div>
    
  </div>
  <div class="f-cb"></div>
  <div class="texttip" style="margin-top: 1px;display: none;">限品类:仅可购买厨具商品</div>

</div>
<%/each%>
</script>

-->


<script language='javascript'>

function changeBg(){

  $(".coupon_item").each(function(){
      var a =$(this).find(".rinner");

      if(a.hasClass('redpack') || a.hasClass('credit')){
        

      }else if(a.hasClass('past')){
        $(this).find(".newImg img").remove();
        $(".coupon_item .cright .sideleft").css("background","url(../addons/sz_yi/plugin/coupon/template/mobile/default/images/conbgguoqi.png) repeat");
      }else{
        $(this).find(".newImg img").attr("src","../addons/sz_yi/plugin/coupon/template/mobile/default/images/new1.png")
      }

  })
}



  function down(){  
    $(".xiangxi").on("click",function(){
      var num = $(this).attr("data-num");
      var a=$(this).parents(".coupon_item").find(".texttip");
      if(num==0){   
        a.fadeIn();
        $(this).attr("data-num",1);
        $(this).find(".downArrow").css({
           "transform": "rotate(180deg)"
        })
      }else{
        a.fadeOut();
        $(this).attr("data-num",0);
        $(this).find(".downArrow").css({
           "transform": "rotate(0deg)"
        })
      }
    })
  }
var page = 1;
  require(['core','tpl'],function(core,tpl){
	  
	 core.pjson('coupon/my', {page:page, used:'<?php  echo $_GPC['used'];?>',past:'<?php  echo $_GPC['past'];?>'}, function(json) {
                
                    if (json.result.list.length <= 0) {
                        $("#container").html(tpl('tpl_empty'));                      
                        return;
                    }
                    $("#container").html(tpl('tpl_list', json.result));
                     changeBg();
                     down();
                     var loaded = false;
                      var stop=true; 
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
                                    core.pjson('coupon/my', {page:page, used: '<?php  echo $_GPC['used'];?>',past:'<?php  echo $_GPC['past'];?>'}, function(morejson) {  
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
 
</script>

<?php  $show_footer = true?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
