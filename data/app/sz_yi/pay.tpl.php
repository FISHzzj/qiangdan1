<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>我的收款二维码</title>

<style type="text/css">
    body {margin:0px; background:#e45050; font-family:'微软雅黑'; -moz-appearance:none;overflow-x: hidden; }
    a {text-decoration:none;}
    .nav {height:30px;border-bottom:2px solid #fff;  width:33.3%;  background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
    .navon { border-bottom:2px solid #ff6801;  }
    .no {height:100px; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    #coupon_loading { padding:10px;color:#666;text-align: center;}
   .coupon_no {height:100px;  margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
   .coupon_menu {height:60px; width:100%; }
   .coupon_no_nav {height:38px; background:#eee; margin:0px 3%; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}
   .coupon_more { height:40px; line-height:40px; font-size:14px;color:#232323; margin:10px; border-radius: 5px; background-repeat:no-repeat; border:1px solid #232323; text-align: center; }

  .pay .wrap {padding: 20px;border-radius: 5px;height: auto;margin: 60px 60px;}
  .bg_white { background: white;}
  @media screen and (max-width: 320px){
    .pay .wrap {width: 80%;margin: 50px auto;}
</style>
<div class="page_topbar">
	<a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
	<div class="title">我的收款二维码</div>
</div>

<div class="tab pay">
    <div class="bg_white wrap">
        <p class="f-fsize16 f-tac">我的收款二维码</p>
        <div class="code f-tac qrcodeTable">
          <p id="qrcode"></p>
        </div>       
    </div>
   
</div>
<script src="../web/resource/js/require.js"></script>
<script src="../web/resource/js/lib/jquery.qrcode.min.js"></script>
<script type="text/javascript">
$(function() {
    require(['jquery.qrcode'], function(){
        $('#qrcode').qrcode({
            render: 'canvas',
            width: 150,
            height: 150,
            text: "<?php  echo $this->createPluginMobileUrl('suppliermenu/pay',array('uid'=>$uid))?>"
        });
    })
})

</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
