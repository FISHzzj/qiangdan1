<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header_center', TEMPLATE_INCLUDEPATH)) : (include template('common/header_center', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    body {margin:0px; background:#eee; -moz-appearance:none;}
    a {text-decoration:none;}
    .header {height: auto; width:100%; padding:0px; /*background: url(../addons/sz_yi/template/mobile/default/static/images/bg2.png) 0 0 no-repeat;background-size: 100% 100%;background: #192229*/}
    .header .user {height:90px; padding:10px;}
    .header .user .user-head {height:48px; width:48px; background:#fff; border-radius:50%; float:left;/*border:2px solid #fff;*/}
    .header .user .user-head img {height:48px; width:48px; border-radius:24px;}
    .header .user .user-info {height:48px; width:95px; float:left; margin-left:10px; color:#fff;}
    .header .user .user-info .user-name {height:20px; width:100%; font-size:16px; line-height:20px;background: none !important;
    border: 0;padding: 0;text-align: left;}
    .header .user .user-info .user-other {width:125px; font-size:12px;line-height: 20px;}
    .header .user-gold {height:35px; width:94%; padding:5px 3%; border-bottom:1px solid #ddd; background:#fff; font-size:16px; line-height:35px;}
    .header .user-gold .title {height:35px; width:auto; float:left; color:#666;}
    .header .user-gold .num {height:35px; width:auto; float:left; color:#f90;}

    .header .user-gold .draw {width:80px; height:30px; background:#6c9; float:right;}
    .header .user .set {height:26px; width:26px; float:right;}

    .header .user-op { height:35px; width:94%; padding:5px 3%; border-bottom:1px solid #ddd; background:#fff; font-size:16px; line-height:35px; }
    .take {height:26px; width:auto; padding:0 10px; line-height:26px; font-size:12px; float:right; background:#e31939; border-radius:5px; margin-top:9px; color:#fff;}
    .take1 {height:26px; width:auto; padding:0 10px; line-height:26px; font-size:12px; float:right; background:#00cc00; border-radius:5px; margin-top:5px; color:#fff;}

    .order {height:auto; width:100%; margin:2px 0;}
    .order_all {height:auto; width:100%; color:#666;}
.order_all a{ display: block;width: 100%;line-height: 25px;height: 31px;}
.order_all a div{display: block;width:75%;box-sizing: content-box;text-align: left;padding-left: 48px;color: #A8ACB1;font-size: 12px}
    .order_pub {height:18px; float:left; padding-top:5px; text-align:center; color:#666; position:relative;}
    .order_pub span {background:#f30; border-radius:8px; position:absolute; top:10px; right:25%; font-size:12px; color:#fff; line-height:16px;text-align: center;padding: 0 5px;margin-right: 0px;}
    .order_1 {width:24%;}
    .order_2 {width:25%;}
    .order_3 {width:25%;}
    .order_4 {width:25%;}

    .list1 {height:30px; background:#2D353C; padding:0px 3%;  line-height:36px; color: white;font-size: 12px;text-align: left;padding-left: 15px;}
    .list1 i {font-size:16px; margin-right:10px;color: white !important}
    .cart .fa-heart{color: #A8ACB1 !important}
    .allorder {float:right; color:#aaa; margin-right:45px; text-decoration:none;}

    .cart {height:auto; width:100%;  margin:2px 0;}
    .address {height:38px; width:100%; background:#fff; margin:2px 0; border-bottom:1px solid #ddd; border-top:1px solid #ddd; line-height:38px;}

    .copyright {height:40px; width:100%; text-align:center; line-height:40px; font-size:12px; color:#999; margin-top:10px;}

    span.count {float:right; background:#f30; border-radius:8px; font-size:12px; color:#fff; line-height:16px; text-align: center;padding: 0 5px}
    .leftlistnav{background-color: #2d353c;padding-bottom: 10px;margin-bottom: 20px;}
    .list1 img{margin-right: 10px;}
    .leftlistnav{width: 200px;}
    .list1 i.fa{line-height: 39px !important;font-size: 20px !important;margin-right: 25px !important;}
    .rightlist{width: 985px;}
    .m-categoryWrap .m-all {width: 209px;}
    .selectactive{color:#00ceff !important;}
</style>
<div style="width:1200px;margin:10px auto 0;overflow: hidden;">
<div id="container1"  class="leftlistnav"></div>
<!-- <div class="container2"></div> -->
<script id="member_center" type="text/html">
    <div class="header" style="background:#192229;">
        <div class="user">
            <div class="user-head"><img src="<%member.avatar%>" /></div>
            <div class="user-info">
                <div class="user-name"><%if member.realname%><%member.realname%><%else%>?????????<%/if%></div>
                <!-- <div class="user-other" <?php  if(!empty($this->yzShopSet['levelurl'])) { ?>onclick='location.href="<?php  echo $this->yzShopSet['levelurl']?>"'<?php  } ?>>[<%level.levelname%>] <?php  if(!empty($this->yzShopSet['levelurl'])) { ?><i class='fa fa-question-circle' ></i><?php  } ?>
                <?php  if(!empty($this->yzShopSet['isreferrer'])) { ?>
                    <br>[????????????<%referrer.realname%>]
                <?php  } ?>
                </div> -->
                <div class="user-other">[<%level.levelname%>]<i class='fa fa-question-circle' ></i>
                <?php  if(!empty($this->yzShopSet['isreferrer'])) { ?>
                    <br>[????????????<%referrer.realname%>]
                <?php  } ?>
                </div>
            </div>
            <div class="set" onclick='location.href="<?php  echo $this->createMobileUrl('member/info')?>"'><i class="fa fa-gear" style="font-size:26px; color:#fff;cursor:pointer"></i></div>
        </div>
</div>
<!--  <div class="cart" style='margin-top:-20px;'>
    <a href="javascript:;"><div class="list1" style=" border-bottom:0px;border-top:0px;">??????: <span style='color:#e31939'><%member.credit2%></span>
            <%if trade.closerecharge < 1%>
            <div class="take" onclick="location.href='<?php  echo $this->createMobileUrl('member/recharge',array('openid'=>$openid))?>'">??????</div>
            <%/if%>

        </div></a>
   <a href="javascript:;"><div class="list1" style="margin:-2px 0px 0; border-bottom:0px;">??????: <%member.credit1%>

           <div class="take1" onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop')?>'">????????????</div>

       </div></a>
</div> -->
    <a href="<?php  echo $this->createMobileUrl('member/indexCenter')?>">
        <div class="list1"><img src="../addons/sz_yi/template/pc/default/static/images/iconc1.png" alt="">?????????</div>
    </a>
    <div class="order">
        <a href="#">
            <div class="list1" style="margin-top:0px;">
                <img src="../addons/sz_yi/template/pc/default/static/images/iconc2.png" alt="">
                <span style="">????????????</span>
            </div>
        </a>
        <div class="order_all">
            <a href="<?php  echo $this->createMobileUrl('member/info')?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <a href="<?php  echo $this->createMobileUrl('shop/cart')?>">
                <div class="order_pub order_1" style="border:0px;">???????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <a href="<?php  echo $this->createMobileUrl('member/points_log')?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <a href="<?php  echo $this->createMobileUrl('shop/history')?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <a href="<?php  echo $this->createMobileUrl('shop/favorite')?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <%if !member.isbindmobile && shopset.is_weixin%>
                <a href="<?php  echo $this->createMobileUrl('member/bindmobile')?>">
                    <div class="order_pub order_1" style="border:0px;">????????????
                    <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                    </div>
                </a>
            <%/if%>
        </div>
    </div>
<div class="order">
    <a href="<?php  echo $this->createMobileUrl('order')?>">
        <div class="list1" style="margin-top:0px;">
            <img src="../addons/sz_yi/template/pc/default/static/images/iconc3.png" alt="">
            <span style="">????????????</span>
        </div>
    </a>
    <div class="order_all">
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>0))?>">
            <div class="order_pub order_1" style="border:0px;">?????????<%if order.status0>0%><span><%order.status0%></span><%/if%>
            <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
            </div>
        </a>
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>1))?>">
            <div class="order_pub order_2">?????????<%if order.status1>0%><span><%order.status1%></span><%/if%>
            <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
            </div>
        </a>
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>2))?>">
            <div class="order_pub order_3">?????????<%if order.status2>0%><span><%order.status2%></span><%/if%>
            <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
            </div>
        </a>
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>4))?>">
            <div class="order_pub order_4">?????????<%if order.status4>0%><span><%order.status4%></span><%/if%>
            <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
            </div>
        </a>
    </div>
</div>

<div class="order">
        <a href="#">
            <div class="list1" style="margin-top:0px;">
                <img src="../addons/sz_yi/template/pc/default/static/images/iconc4.png" alt="">
                <span style="">????????????</span>
            </div>
        </a>
        <div class="order_all">
            <a href="<?php  echo $this->createMobileUrl('member/shangapplice')?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <a href="<?php  echo $this->createMobileUrl('member/shangguan')?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <a target="_target" href="<?php  echo $this->createMobileUrl('shop/bandlist')?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <a target="_target" href="<?php  echo $this->createMobileUrl('shop/offbrand',array('op'=>'default'))?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
        </div>
    </div>


<div class="order">
        <a href="#">
            <div class="list1" style="margin-top:0px;">
                <img src="../addons/sz_yi/template/pc/default/static/images/iconc5.png" alt="">
                <span style="">????????????</span>
            </div>
        </a>
        <div class="order_all">
            <%if shopset.hascom%>
            <a href="<?php  echo $this->createPluginMobileUrl('commission')?>">
                <div class="order_pub order_1" style="border:0px;"><%shopset.commission_text%>
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <%/if%>
            <?php  if(('bonusplus')) { ?>
            <a href="<?php  echo $this->createPluginMobileUrl('bonusplus/index')?>">
                <div class="order_pub order_1" style="border:0px;"><?php echo empty($set['texts']['start']) ? "????????????" : $set['texts']['start'];?>
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <?php  } ?>
            <a href="<?php  echo $this->createMobileUrl('member/points_log')?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <?php  if(p('return')) { ?>
            <a href="<?php  echo $this->createPluginMobileUrl('return/return_log')?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <?php  } ?>
            <a href="<?php  echo $this->createPluginMobileUrl('withdrawals/cash_withdrawal')?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <%if trade.withdraw==1%>
            <a href="javascript:;" id="btnwithdraw">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
            <%/if%>
            <%if trade.withdraw==1 || trade.closerecharge<1%>
            <a href="<?php  echo $this->createMobileUrl('member/log')?>">
                <div class="order_pub order_1" style="border:0px;"><%if trade.withdraw==1%>????????????<%else%>????????????<%/if%>
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
             <%/if%>

            <%if shopset.hascoupon%>
                <a href="<?php  echo $this->createPluginMobileUrl('coupon/my')?>">
                    <div class="order_pub order_1" style="border:0px;">???????????????
                    <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                    </div>
                </a>
                <%if shopset.hascouponcenter%>
                <a href="<?php  echo $this->createPluginMobileUrl('coupon')?>">
                    <div class="order_pub order_1" style="border:0px;">???????????????
                    <span class="count" style="right: 47px;"><%counts.couponcount%></span>
                    <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                    </div>
                </a>
                <%/if%>
            <%/if%>
             <a href="<?php  echo $this->createPluginMobileUrl('bonus')?>">
                <div class="order_pub order_1" style="border:0px;">????????????
                <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                </div>
            </a>
        </div>
    </div>

    <div class="order">
            <a href="#">
                <div class="list1" style="margin-top:0px;">
                    <img src="../addons/sz_yi/template/pc/default/static/images/iconc6.png" alt="">
                    <span style="">????????????</span>
                </div>
            </a>
            <div class="order_all">
            <?php  if(p('article')) { ?>
                <a href="<?php  echo $this->createPluginMobileUrl('article/article')?>">
                    <div class="order_pub order_1" style="border:0px;"><%shopset.article_text%>
                    <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                    </div>
                </a>
            <?php  } ?>
                <a href="<?php  echo $this->createMobileUrl('member/notice')?>">
                    <div class="order_pub order_1" style="border:0px;">??????????????????
                    <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                    </div>
                </a>
                <a href="<?php  echo $this->createMobileUrl('member/referral')?>">
                    <div class="order_pub order_1" style="border:0px;">??????????????????
                    <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                    </div>
                </a>
                <!-- <a href="<?php  echo $this->createMobileUrl('member/referral')?>">
                    <div class="order_pub order_1" style="border:0px;">??????????????????
                    <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                    </div>
                </a> -->
                <a href="<?php  echo $this->createMobileUrl('shop/address')?>">
                    <div class="order_pub order_1" style="border:0px;">??????????????????
                    <i class="fa fa-angle-right" style="color:#999; font-size:20px; float:right; line-height:25px;margin-right: 25px;"></i>
                    </div>
                </a>


            </div>
        </div>
        <?php  if(!is_weixin()) { ?>
            <a href="<?php  echo $this->createMobileUrl('member/logout')?>">
                <div class="list1">
                <img src="../addons/sz_yi/template/pc/default/static/images/iconc7.png" alt="">
                    ????????????
                </div>
            </a>
        <?php  } ?>




<!-- <div class="cart">
    <%if shopset.hascom%>
        <a href="<?php  echo $this->createPluginMobileUrl('commission')?>"><div class="list1" ><i class="fa fa-home"></i><%shopset.commission_text%><i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <%/if%>

    <a href="<?php  echo $this->createPluginMobileUrl('premium')?>"><div class="list1" ><i class="fa fa-home"></i>???????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>

    <a href="<?php  echo $this->createMobileUrl('member/info')?>"><div class="list1" ><i class="fa fa-user"></i>????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>

   <?php  if(m('common')->getapplices()  == 0) { ?>
      <a href="<?php  echo $this->createMobileUrl('member/shangapplice')?>"><div class="list1" ><i class="fa fa-user"></i>????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
   <?php  } ?>

    <a href="<?php  echo $this->createMobileUrl('member/shangapplice')?>"><div class="list1" ><i class="fa fa-user"></i>????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>


    <a href="<?php  echo $this->createMobileUrl('member/shangguan')?>"><div class="list1" ><i class="fa fa-user"></i>????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>



    <%if !member.isbindmobile && shopset.is_weixin%>
    <a href="<?php  echo $this->createMobileUrl('member/bindmobile')?>"><div class="list1" ><i class="fa fa-mobile" ></i>????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <%/if%>
</div>
<div class="cart">
    <%if shopset.supplier_switch%>
        <a href="<?php  echo $this->createPluginMobileUrl('supplier/af_supplier')?>"><div class="list1" ><i class="fa fa-pencil" ></i>???????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <%/if%>
    <%if shopset.bonus_start%>
    <a href="<?php  echo $this->createPluginMobileUrl('bonus/index')?>"><div class="list1" ><i class="fa fa-money"></i><%shopset.bonus_text%><i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <%/if%>
    <?php  if(p('return')) { ?>
    <a href="<?php  echo $this->createPluginMobileUrl('return/return_log')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="fa fa-piechart" style="color:#f10;"></i>????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <?php  } ?>

    <?php  if(('bonusplus')) { ?>
        <a href="<?php  echo $this->createPluginMobileUrl('bonusplus/index')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="fa fa-piechart" style="color:#f10;"></i><?php echo empty($set['texts']['start']) ? "????????????" : $set['texts']['start'];?><i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <?php  } ?>

    <a href="<?php  echo $this->createPluginMobileUrl('withdrawals/cash_withdrawal')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="fa fa-piechart" style="color:#f10;"></i>????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
</div>
    <?php  if(p('article')) { ?>
    <a href="<?php  echo $this->createPluginMobileUrl('article/article')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="fa fa-article" style="color:#f10;"></i><%shopset.article_text%><i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <?php  } ?>

<%if shopset.hascoupon%>
<div class="cart">
     <%if shopset.hascouponcenter%>
    <a href="<?php  echo $this->createPluginMobileUrl('coupon')?>"><div class="list1" ><i class="fa fa-tags" ></i>??????????????? <i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i> </div></a>
    <%/if%>
    <a href="<?php  echo $this->createPluginMobileUrl('coupon/my')?>"><div class="list1" ><i class="fa fa-gift" ></i>??????????????? <i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i> <span class="count"><%counts.couponcount%></span></div></a>

</div>
<%/if%>
<div class="cart">
    <a href="<?php  echo $this->createMobileUrl('shop/cart')?>"><div class="list1"><i class="fa fa-shopping-cart" ></i>???????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i> <span class="count"><%counts.cartcount%></span></div></a>
    <a href="<?php  echo $this->createMobileUrl('shop/favorite')?>"><div class="list1"><i class="fa fa-heart"></i>????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i><span class="count"><%counts.favcount%></span></div></a>
    <a href="<?php  echo $this->createMobileUrl('shop/history')?>"><div class="list1"><i class="fa fa-list"></i>????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <a href="<?php  echo $this->createMobileUrl('member/referral')?>"><div class="list1" ><i class="fa fa-volume-up"></i>??????????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <a href="<?php  echo $this->createMobileUrl('member/notice')?>"><div class="list1" ><i class="fa fa-volume-up"></i>??????????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>


</div>
    <%if trade.withdraw==1%>
    <a href="javascript:;" id="btnwithdraw"><div class="list1" style="border-bottom: 0px;"><i class="fa fa-money" style="color:#0096ff;"></i>????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <%/if%>
    <%if trade.withdraw==1 || trade.closerecharge<1%>
    <a href="<?php  echo $this->createMobileUrl('member/log')?>"><div class="list1" style="<%if trade.withdraw==1%>margin:0px;<%/if%>"><i class="fa fa-file-text"></i><%if trade.withdraw==1%>????????????<%else%>????????????<%/if%>
            <i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <%/if%>
    <a href="<?php  echo $this->createMobileUrl('member/points_log')?>"><div class="list1"><i class="fa fa-street-view"></i>????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
<a href="<?php  echo $this->createMobileUrl('shop/address')?>"><div class="list1"><i class="fa fa-street-view"></i>??????????????????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>

<?php  if(!is_weixin()) { ?>
<a href="<?php  echo $this->createMobileUrl('member/logout')?>"><div class="list1"><i class="fa fa-sign-out"></i>??????<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
<?php  } ?> -->


</script>
<!--????????????????????? <div class="copyright">???????????? ??<?php  if(empty($set['shop']['name'])) { ?><?php  echo $_W['account']['name'];?><?php  } else { ?><?php  echo $set['shop']['name'];?><?php  } ?> </div> -->
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {

        core.json('member/center',{},function(json){

           $('#container1').html(  tpl('member_center',json.result) );


            $('.order_all a').each(function(){
                if($($(this))[0].href==String(window.location))
                    $(this).find("div").addClass('selectactive');
                
            });

            /*$('.list1').parent("a").each(function(){
                if($($(this))[0].href==String(window.location))
                    $(this).find("div").addClass('selectactive');
             });*/

           var withdrawmoney = <?php echo empty($set['trade']['withdrawmoney'])?0:floatval($set['trade']['withdrawmoney'])?>;
           $('#btnwithdraw').click(function(){

               if(json.result.member.credit2<=0){
                   core.tip.show('???????????????!');
                   return;
               }
               if(withdrawmoney>0 && json.result.member.credit2<withdrawmoney){
                   core.tip.show('???' +withdrawmoney + "???????????????!" );
                   return;
               }
               location.href = core.getUrl('member/withdraw');
           })

        },true);




    })
</script>
<?php  $show_footer=true?>
<?php  $footer_current='member'?>