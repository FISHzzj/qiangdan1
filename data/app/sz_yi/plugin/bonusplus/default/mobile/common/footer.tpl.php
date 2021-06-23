<?php defined('IN_IA') or exit('Access Denied');?><?php  if($show_footer) { ?>
<style type="text/css">
    .num1{right: 10px;top:3px;width: 7px;height: 7px;}
    footer#footer-nav{bottom: -1px;}
    footer#footer-nav .menu-list li.active a > span{color: #e45050;}
    footer#footer-nav .menu-list li.active a > i{color: #e45050;}
    footer#footer-nav{    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #fff), color-stop(1, #fff));}
    footer#footer-nav{height: 57px!important}
</style>
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/fontMain/iconfont.css">
<div style='height:80px;width:100%'></div>
<footer id="footer-nav">
                <ul class="menu-list">
                    <li <?php  if($footer_current=='first') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createPluginMobileUrl('commission/myshop')?>"><i class="iconfont ">&#xe607;</i><span>小店</span></a></li>
                    <li <?php  if($footer_current=='second') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createMobileUrl('shop/category')?>"><i class="iconfont ">&#xe86e;</i><span>分类</span></a></li>
                    <li <?php  if($footer_current=='commission') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createPluginMobileUrl('commission')?>" class="f-relative"> <i class="iconfont" style="font-size: 30px;">&#xe600;</i><span>分销中心</span><span class="num num1" style=""></span></a></li>
                    <li <?php  if($footer_current=='cart') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createMobileUrl('shop/cart')?>"><i class="iconfont ">&#xe602;</i><span>购物车</span></a></li>
                    <li <?php  if($footer_current=='member') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createMobileUrl('member')?>"><i class="iconfont ">&#xe60b;</i><span>会员中心</span></a></li>
                </ul>
</footer>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer_base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer_base', TEMPLATE_INCLUDEPATH));?>