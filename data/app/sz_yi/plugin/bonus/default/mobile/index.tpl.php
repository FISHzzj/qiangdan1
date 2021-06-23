<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<title><?php  echo $this->set['texts']['center']?></title>

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/plugin/return/template/mobile/default/rebate/css/aui.2.0.css">

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/plugin/return/template/mobile/default/rebate/css/center.css">

<style type="text/css">

    @font-face {font-family: "iconfont";

      src: url('../addons/sz_yi/plugin/commission/template/mobile/style1/static/fonts/iconfont.eot?t=1474171079'); /* IE9*/

      src: url('../addons/sz_yi/plugin/commission/template/mobile/style1/static/fonts/iconfont.eot?t=1474171079#iefix') format('embedded-opentype'), /* IE6-IE8 */

      url('../addons/sz_yi/plugin/commission/template/mobile/style1/static/fonts/iconfont.woff?t=1474171079') format('woff'), /* chrome, firefox */

      url('../addons/sz_yi/plugin/commission/template/mobile/style1/static/fonts/iconfont.ttf?t=1474171079') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/

      url('../addons/sz_yi/plugin/commission/template/mobile/style1/static/fonts/iconfont.svg?t=1474171079#iconfont') format('svg'); /* iOS 4.1- */

    }



    .hs {

      font-family:"iconfont" !important;

      font-style:normal;

      -webkit-font-smoothing: antialiased;

      -webkit-text-stroke-width: 0.2px;

      -moz-osx-font-smoothing: grayscale;

    }

    .icon-zijinmingxi:before { content: "\d600"; }

    .icon-wodeyongjin:before { content: "\d601"; }

    .icon-fenxiaoshang:before { content: "\d602"; }

    .icon-mingxi:before { content: "\d604"; }

    .icon-shenqing:before { content: "\d605"; }



    .header {width: 100%;background: #00c1ff;color: #fff;position: relative;}

    .user-title{position: relative;z-index: 8;padding: 8% 5%;overflow: hidden;}

    .user-head { height: 60px; width: 60px; background: #fff; border-radius: 50%; border: 2px solid #fff;overflow: hidden;float: left;margin-top: 5px;}

    .user-head img { height: 100%; width: 100%; border-radius: 50%; }

    .user-info{float: left;margin-left: 10px}

    .user-other { width: auto;height: 24px;line-height: 24px;}

    .user-member { background: #fff; color: #00c1ff; border-radius: 12px; height: 20px; line-height: 20px;padding:2px 5px}



    .take { width: auto; padding: 2px 5px;border-radius: 5px; color: #fff;background: #f3691e;color: #eee}

    a.take:hover{color: #fff;text-decoration: none}

    .hs-other{margin-bottom: 20px;font-size: 16px}

    .hs-commission{background: #fff}

    .hs-commission li{float: left;text-align: center; width: 50%;padding-top: 15px;padding-bottom: 15px;border-bottom: 1px solid #f1f1f1; border-right: 1px solid #f1f1f1;max-height: 71px;position: relative;}

    .hs-commission li a{color: #666;font-size: 16px;text-decoration: none;display: block;}

    .hs-item{height: 40px;width:40px;background: #00c1ff;color: #fff;font-size: 25px;margin: 0 auto;border-radius: 10px;line-height: 40px;float: left;margin-left:10%;}

    .hs-item-list{float: left;margin-left:10%;font-size: 12px;text-align: left;height: 50px;width: 70px;white-space: nowrap;}

    .hs-list{float: left;margin-left: 5%;font-size: 14px;text-align: left;}

    .hs-money{float: right;}

    .hs-commission li .hs-money a{color: #fff;font-size: 12px}

    #vector { position: absolute; top: 0; border: 0; width: 100%; height: 100%; z-index: 1;left: 0}

    .t_num i{ font-style:normal}

    .t_num { position: absolute; overflow: hidden; line-height: 30px; width: 100%; height: 30px; bottom: 0; left: 10% }

    .t_num span {font-size: 20px; position: absolute; }

    .hs-min{top: 20px;left: 100px}

    .hs-min span{font-size: 16px;height: 25px;line-height: 25px}

    .hs-user { background: rgba(0, 0, 0, .1); margin-top: 5px; position: relative; z-index: 2; }

    .hs-user li { width: 33.3333%; text-align: center; float: left; position: relative; padding-bottom: 10px; padding-top: 10px; }

    .hs-user li a { color: #eee; display: block;border-right: 1px solid #eee;}

    .hs-user li:last-child a {border-right:0}

    .content_head_img img{

    width: 60px;

    height: 60px;

    border-radius: 50%;

    background: #fff;

    float: left;

}

.content_type{margin-bottom: 10px;}

</style>

<div class="page_topbar">

    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>

    <div class="title">分红中心</div>

    <a href="#">

      <i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i>

    </a>

</div>



<div id='container' style="overflow: hidden;">

    <div class="content_head">

        <div class="content_head_img">

            <img src="<?php  echo $member['avatar'];?>"/>

        </div>

        <div class="content_head_font">

            <div class="content_head_fontT"><?php  echo $member['nickname'];?></div>

            <div class="content_head_fontM">加入时间：<?php  echo date("Y-m-d", $member['agenttime'])?></div>

        </div>

        <div class="content_head_right">

                    <?php  if($level) { ?>

                        <?php  echo $level['levelname'];?>

                    <?php  } else { ?>

                        <?php  if($set['levelname']!='') { ?><?php  echo $set['levelname'];?><?php  } else { ?>普通等级<?php  } ?>

                    <?php  } ?>

                    <?php  if($member['bonus_area']==1) { ?>

                        [<?php  echo $this->set['texts']['agent_province']?>]

                    <?php  } ?>

                    <?php  if($member['bonus_area']==2) { ?>

                        [<?php  echo $this->set['texts']['agent_city']?>]

                    <?php  } ?>

                    <?php  if($member['bonus_area']==3) { ?>

                        [<?php  echo $this->set['texts']['agent_district']?>]

                    <?php  } ?></div>

    </div>



    <div class="header clearfloat">

        <ul class="content_type">

            <li>

                <div class="content_type_title f-fsize14">累计</div>

                <div class="content_type_content timer" data-to="<?php  echo $member['commission_total'];?>" data-speed="1500"></div>

            </li>

            <li>

                <div class="content_type_title f-fsize14">待分红</div>

                <div class="content_type_content timer" data-to="<?php  echo $member['commission_ok'];?>" data-speed="1500"></div>

            </li>

            <li style="border-right: 0px;">

                <div class="content_type_title f-fsize14">已分红</div>

                <div class="content_type_content timer" data-to="<?php  echo $member['commission_pay'];?>" data-speed="1500"></div>

            </li>

        </ul>

    </div>

    <ul class="content_list_head">

           <!-- 分红订单 -->

                <li>

                    <a href="<?php  echo $this->createPluginMobileUrl('bonus/order')?>">

                        <img src="../addons/sz_yi/plugin/return/template/mobile/default/rebate/images/1.png">

                        <div class="content_list_headR ">

                            <div class="content_list_headR1 f-tal "><?php  echo $this->set['texts']['order']?></div>

                             <div class="content_list_headR2 f-tal "><?php  echo $member['ordercount0'];?>个</div>

                        </div>

                    </a>

                </li>



             <!-- 分红明细 -->

                <li>

                     <a href="<?php  echo $this->createPluginMobileUrl('bonus/log')?>">

                       <img src="../addons/sz_yi/plugin/return/template/mobile/default/rebate/images/2.png">

                        <div class="content_list_headR">

                            <div class="content_list_headR1 f-tal"><?php  echo $this->set['texts']['commission_detail']?></div>

                             <div class="content_list_headR2 f-tal"><?php  echo $this->set['texts']['commission']?></div>

                        </div>

                       </a>

                </li>



        </ul>



        <ul class="content_list_head">



             <!-- 我的下线 -->

                <li>

                    <a href="<?php  echo $this->createPluginMobileUrl('bonus/customer')?>">

                        <img src="../addons/sz_yi/plugin/return/template/mobile/default/rebate/images/3.png">

                        <div class="content_list_headR">

                            <div class="content_list_headR1 f-tal"><?php  echo $this->set['texts']['mycustomer']?></div>

                             <div class="content_list_headR2 f-tal"><?php  echo $member['customercount'];?>人</div>

                        </div>

                    </a>

                </li>





                <li>

                     <a href="<?php  echo $this->createPluginMobileUrl('bonus/order_area')?>">

                       <img src="../addons/sz_yi/plugin/return/template/mobile/default/rebate/images/4.png">

                        <div class="content_list_headR">

                            <div class="content_list_headR1"><?php  echo $this->set['texts']['order_area']?></div>

                             <div class="content_list_headR2"><?php  echo $member['ordercount_area'];?></div>

                        </div>

                      </a>

                </li>



          <!--       <?php  if($member['bonus_area']) { ?>

             <li>

                  <a href="<?php  echo 'http://' . $this->set['levelurl']?>">

                    <img src="../addons/sz_yi/plugin/return/template/mobile/default/rebate/images/4.png">

                     <div class="content_list_headR">

                         <div class="content_list_headR1"></div>

                          <div class="content_list_headR2">分红等级说明</div>

                     </div>

                   </a>

             </li></a>

          <?php  } ?>

                       -->

        </ul>





    <!-- <ul class="clearfloat hs-commission">

        佣金

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('bonus/withdraw')?>">

                <span class="hs-item" style="background:#e84675"><i class="hs icon-wodeyongjin"></i></span>

                <span class="hs-list"><?php  echo $this->set['texts']['commission']?><br><span><?php  echo $member['commission_total'];?></span>元</span>

            </a>

        </li>

        分红订单

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('bonus/order')?>">

                <span class="hs-item" style="background:#ff7000"><i class="hs icon-mingxi"></i></span>

                <span class="hs-list"><?php  echo $this->set['texts']['order']?><br><span><?php  echo $member['ordercount0'];?></span>个</span>

            </a>

        </li>

        分红明细

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('bonus/log')?>">

                <span class="hs-item" style="background:#17ba94"><i class="hs icon-zijinmingxi"></i></span>

                <span class="hs-list"><?php  echo $this->set['texts']['commission_detail']?><br><span><?php  echo $this->set['texts']['commission']?></span></span>

            </a>

        </li>

        我的下线

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('bonus/customer')?>">

                <span class="hs-item" style="background:#f3bfc3"><i class="hs hs-fenxiao"></i></span>

                <span class="hs-list"><?php  echo $this->set['texts']['mycustomer']?><br><span><?php  echo $member['customercount'];?></span>人</span>

            </a>

        </li>

        <li>

            <a href="<?php  echo 'http://' . $this->set['levelurl']?>">

                <span class="hs-item" style="background:#f3bfc3"><i class="hs hs-fenxiao"></i></span>

                <span class="hs-list">分红等级说明</span>

            </a>

        </li>

        <?php  if($member['bonus_area']) { ?>

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('bonus/order_area')?>">

                <span class="hs-item" style="background:#dd7188"><i class="fa fa-gift"></i></span>

                <span class="hs-list"><?php  echo $this->set['texts']['order_area']?><br><span><?php  echo $member['ordercount_area'];?></span>个</span>

            </a>

        </li>

        <?php  } ?>

    </ul> -->

    <div class="copyright">版权所有 ©<?php  if(empty($set1['copyright'])) { ?><?php  echo $_W['account']['name'];?><?php  } else { ?><?php  echo $set1['copyright'];?><?php  } ?></div>

</div>

<!-- js -->

<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/roll.js"></script>

<!-- footer -->

<?php  $show_footer=true; $footer_current ='bonus'?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>