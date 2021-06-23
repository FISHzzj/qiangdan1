<?php defined('IN_IA') or exit('Access Denied');?><?php  if($show_footer) { ?>
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/fontMain/iconfont.css">
<style type="text/css">
    .num1{right: 10px;top:3px;width: 7px;height: 7px;}
    footer#footer-nav{bottom: -1px;}
    footer#footer-nav .menu-list li.active a > span{color: #e45050;}
    footer#footer-nav .menu-list li.active a > i{color: #e45050;}
    footer#footer-nav{    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #fff), color-stop(1, #fff));}
    footer#footer-nav{height: 57px!important}
</style>
<div style='height:50px; width:100%;margin:0;padding:0;float:left;display:block;'></div>
<?php  if($this->footer['diymenu']) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('designer/menu', TEMPLATE_INCLUDEPATH)) : (include template('designer/menu', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
<style type="text/css">
    <?php  if($this->footer['commission']) { ?>
    footer#footer-nav .menu-list li { width:20%}
    <?php  } ?>
</style>

<footer id="footer-nav">
<ul class="menu-list" style="margin:0">
    <li <?php  if($footer_current=='first') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->footer['first']['url']?>">
        <!-- <i class="fa fa-<?php  echo $this->footer['first']['ico']?>"></i> -->
        <!-- <i class="icon iconfont">&#xe604;</i> -->
        <i class="iconfont ">&#xe607;</i>
        <span><?php  echo $this->footer['first']['text']?></span></a>
    </li>

    <li <?php  if($footer_current=='second') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->footer['second']['url']?>">
        <!-- <i class="fa fa-<?php  echo $this->footer['second']['ico']?>"></i> -->
        <!-- <i class="icon iconfont">&#xe651;</i> -->
       <i class="iconfont ">&#xe86e;</i>
        <span><?php  echo $this->footer['second']['text']?></span></a>
    </li>

    <?php  if($this->footer['commission']) { ?>
    <li <?php  if($footer_current=='commission') { ?>class='active'<?php  } ?>>
        <a href="<?php  echo $this->footer['commission']['url']?>" class="f-relative">
            <!-- <i class="fa fa-<?php  echo $this->footer['commission']['ico']?>"></i> -->
            <!-- <i class="icon iconfont">&#xe635;</i> -->
            <i class="iconfont" style="font-size: 30px;">&#xe600;</i><span>分销中心</span>
            <span><?php  echo $this->footer['commission']['text']?></span>
        </a>
    </li>
    <?php  } ?>

    <li <?php  if($footer_current=='cart') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createMobileUrl('shop/cart')?>">
        <!-- <i class="fa fa-shopping-cart"></i> -->
        <!-- <i class="icon iconfont">&#xe653;</i> -->
        <i class="iconfont ">&#xe602;</i>
        <span>购物车</span></a>
    </li>

    <li <?php  if($footer_current=='member') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createMobileUrl('member')?>">
        <!-- <i class="fa fa-user"></i> -->
        <!-- <i class="icon iconfont">&#xe619;</i> -->
        <i class="iconfont ">&#xe60b;</i>
        <span>会员中心</span></a>
    </li>
</ul>
</footer>
<?php  } ?>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer_base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer_base', TEMPLATE_INCLUDEPATH));?>
