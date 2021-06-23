<?php defined('IN_IA') or exit('Access Denied');?><?php  if($show_footer) { ?>

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/fontMain/iconfont.css">

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/weui.min.css">

<style type="text/css">

    .num1{right: 10px;top:3px;width: 7px;height: 7px;}

    footer#footer-nav{bottom: -1px;}

    footer#footer-nav .menu-list li.active a > span{color: #e45050;}

    footer#footer-nav .menu-list li.active a > i{color: #e45050;}

    footer#footer-nav{    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #fff), color-stop(1, #fff));}

    footer#footer-nav{height: 57px!important}

    .f-relative{position: relative;}

    .num {position: absolute;top: 0px;right: 25px;background: red; width: 15px;height: 15px;line-height: 15px;text-align: center;border-radius: 50%;color: white;font-size: 12px;}

    .num1 {right: 10px;top: 3px;width: 7px;height: 7px;}



    .f-tac{text-align: center;}

    .weui-flex .weui-flex__item i,.weui-flex .weui-flex__item .ftext{color: #747474;line-height: 17px;}

    .weui-flex .weui-flex__item a.active i,.weui-flex .weui-flex__item a.active .ftext{color: #e45050;}

    .weui-flex .weui-flex__item a .iconfont{font-size: 25px;line-height: 25px;}

    .weui-flex .weui-flex__item a {padding: 6px 0;display: block;}

    .weui-flex .weui-flex__item a:hover,.weui-flex .weui-flex__item a:active{text-decoration: none;}

</style>

<div style='height:50px; width:100%;margin:0;padding:0;float:left;display:block;'></div>

      <?php  if($this->footer['diymenu']) { ?>

        <style type="text/css">

            .designer-menu{bottom: -1px !important;height: 57px !important;}

            .designer-menu ul li .designer-menu-item{height: 57px !important;}

            .designer-menu i{font-size: 25px !important;;line-height: 25px;}

        </style>

        <link rel="stylesheet" type="text/css" href="../web/resource/fontNew/iconfont.css">

      <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('designer/menu', TEMPLATE_INCLUDEPATH)) : (include template('designer/menu', TEMPLATE_INCLUDEPATH));?>

    <?php  } else { ?>

<style type="text/css">

    <?php  if($this->footer['commission']) { ?>

    footer#footer-nav .menu-list li { width:20%}

    <?php  } ?>

</style>



<footer id="footer-nav">

        <div class="weui-flex">

          <div class="weui-flex__item f-tac active">

            <a href="<?php  echo $this->footer['first']['url']?>" <?php  if($footer_current=='first') { ?>class='active'<?php  } ?>>

                <i class="iconfont">&#xe607;</i>

                <div class="ftext"><?php  echo $this->footer['first']['text']?></div>

            </a>

          </div>

          <div class="weui-flex__item f-tac">

            <a href="<?php  echo $this->footer['second']['url']?>" <?php  if($footer_current=='second') { ?>class='active'<?php  } ?>>

                <i class="iconfont ">&#xe86e;</i>

                <div class="ftext"><?php  echo $this->footer['second']['text']?></div>

            </a>

          </div>

          <?php  if($this->footer['commission']) { ?>

          <div class="weui-flex__item f-tac">

            <a href="<?php  echo $this->footer['commission']['url']?>" <?php  if($footer_current=='commission') { ?>class='active'<?php  } ?>>

                <i class="iconfont ">&#xe600;</i>

                <div class="ftext"><?php  echo $this->footer['commission']['text']?></div>

            </a>

          </div>

          <?php  } ?>

          <div class="weui-flex__item f-tac">

            <a href="<?php  echo $this->createMobileUrl('shop/cart')?>" <?php  if($footer_current=='cart') { ?>class='active'<?php  } ?>>

                <i class="iconfont ">&#xe602;</i>

                <div class="ftext">购物车</div>

            </a>

          </div>

          <div class="weui-flex__item f-tac">

            <a href="<?php  echo $this->createMobileUrl('member')?>" <?php  if($footer_current=='member') { ?>class='active'<?php  } ?>>

                <i class="iconfont ">&#xe60b;</i>

                <div class="ftext">会员中心</div>

            </a>

          </div>



        </div>



    </footer>

<?php  } ?>

<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer_base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer_base', TEMPLATE_INCLUDEPATH));?>

