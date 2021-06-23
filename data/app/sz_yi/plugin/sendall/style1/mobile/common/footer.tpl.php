<?php defined('IN_IA') or exit('Access Denied');?><?php  if($show_footer) { ?>
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
            <i class="hs hs-store"></i>
            <span><?php  echo $this->footer['first']['text']?></span></a>
        </li>
        <li <?php  if($footer_current=='second') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->footer['second']['url']?>">
            <!-- <i class="fa fa-<?php  echo $this->footer['second']['ico']?>"></i> -->
            <!-- <i class="icon iconfont">&#xe651;</i> -->
            <i class="hs hs-classify"></i>
            <span><?php  echo $this->footer['second']['text']?></span></a>
        </li>
    
        <li <?php  if($footer_current=='bonus') { ?>class='active'<?php  } ?>>
            <a href="<?php  echo $this->createPluginMobileUrl('bonus')?>">
                <i class="hs hs-fenxiao"></i>
                <span><?php  echo $this->set['texts']['center']?></span>
            </a>
        </li>
    
        <li <?php  if($footer_current=='cart') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createMobileUrl('shop/cart')?>">
            <!-- <i class="fa fa-shopping-cart"></i> -->
            <i class="hs hs-cart"></i>
            <span>购物车</span></a>
        </li>
    
        <li <?php  if($footer_current=='member') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createMobileUrl('member')?>">
            <!-- <i class="fa fa-user"></i> -->
            <i class="icon hs-wode"></i>
            <span>会员中心</span></a>
        </li>
    </ul>
    </footer>
    <?php  } ?>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer_base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer_base', TEMPLATE_INCLUDEPATH));?>
