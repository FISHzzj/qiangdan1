<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<title><?php  echo $this->set['texts']['center']?></title>

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/style1.css">

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/plugin/return/template/mobile/default/rebate/css/center.css">

<style type="text/css">

    /* 新 */

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

            <div class="content_head_fontM">加入时间：<?php  echo date("Y-m-d", $times)?></div>

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

                    <?php  } ?>

        </div>

        <div class="hs-money">

            <a href="javascript:;" class="content_head_right" style="bottom: 85px;">申请提现</a>

        </div>

    </div>





    <div class="header clearfloat">

        <ul class="content_type">

            <li>

                <div class="content_type_title f-fsize14"> <?php  echo $this->set['texts']['commission_total']?></div>

                <div class="content_type_content timer" data-to="<?php  echo $member['commission_total'];?>" data-speed="1500"></div>

            </li> 

            <li>

                <div class="content_type_title f-fsize14">已返现金额</div>

                <div class="content_type_content timer" data-to="<?php  echo $member['commission_pay'];?>" data-speed="1500"></div>

            </li> 

            <li style="border-right: 0px;">

                <div class="content_type_title f-fsize14">待返现金额</div>

                <div class="content_type_content timer" data-to="<?php  echo $member['commission_ok'];?>" data-speed="1500"></div>

            </li>                      

        </ul>

    </div> 



  <!--   <div class="header clearfloat">

      <div class="user-title">

          <div class="user-head">

             <img src="<?php  echo $member['avatar'];?>"/>

          </div> 

          <div class="user-info">

              <div class="user-other"><?php  echo $member['nickname'];?></div>

              <div class="user-other"><span class="user-member"><?php  if($level) { ?>

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

                  <?php  } ?></span>

              </div>

              <div class="user-other">加入时间：<?php  echo date("Y-m-d", $member['agenttime'])?></div>

              <div class="user-other">加入时间：<?php  echo date("Y-m-d", $times)?></div>

          </div>

          <div class="hs-money">

              <a href="javascript:;" class="take">申请提现</a>

          </div>

      </div>

      <ul class="hs-user clearfloat">

          <li>

              <a href="javascript:;">

                  <?php  echo $this->set['texts']['commission_total']?>

                  <div class="timer" style="font-size:20px" data-to="<?php  echo $member['commission_total'];?>" data-speed="1500"></div>

              </a>

          </li>

          <li>

              <a href="javascript:;">

                  已返现金额

                  <div class="timer" style="font-size:20px" data-to="<?php  echo $member['commission_pay'];?>" data-speed="1500"></div>

              </a>

          </li>

          <li>

              <a href="javascript:;">

                  待返现金额

                  <div class="timer" style="font-size:20px" data-to="<?php  echo $member['commission_ok'];?>" data-speed="1500"></div>

              </a>

          </li>

      </ul>

      <iframe id="vector" src="<?php  echo $this->createMobileUrl('member/vector',array('openid'=>$openid))?>"></iframe>

  </div>  -->

    <ul class="content_list_head">

           <!-- 分红订单 -->

                <li>

                    <a href="<?php  echo $this->createPluginMobileUrl('bonusplus/order')?>">

                        <img src="../addons/sz_yi/plugin/return/template/mobile/default/rebate/images/1.png">

                        <div class="content_list_headR ">

                            <div class="content_list_headR1 f-tal "><?php  echo $this->set['texts']['order']?></div>

                             <div class="content_list_headR2 f-tal "><?php  echo $member['ordercount0'];?>个</div>

                        </div>

                    </a>

                </li>

           

             <!-- 分红明细 -->

                <li>

                     <a href="<?php  echo $this->createPluginMobileUrl('bonusplus/log')?>">

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

                    <a href="<?php  echo $this->createPluginMobileUrl('bonusplus/customer')?>">

                        <img src="../addons/sz_yi/plugin/return/template/mobile/default/rebate/images/3.png">

                        <div class="content_list_headR">

                            <div class="content_list_headR1 f-tal"><?php  echo $this->set['texts']['mycustomer']?></div>

                             <div class="content_list_headR2 f-tal"><?php  echo $member['customercount1'];?>人</div>

                        </div>

                    </a>

                </li>



                <!-- 佣金 -->

                 <!-- <li>

                    <a href="<?php  echo $this->createPluginMobileUrl('bonus/withdraw')?>">

                        <img src="../addons/sz_yi/plugin/return/template/mobile/default/rebate/images/3.png">

                        <div class="content_list_headR">

                            <div class="content_list_headR1 f-tal"><?php  echo $this->set['texts']['commission']?></div>

                             <div class="content_list_headR2 f-tal"><?php  echo $member['commission_total'];?>元</div>

                        </div>

                    </a>

                 </li> -->

                  

        </ul>

   

    <div class="copyright">版权所有 © <?php  if(empty($set['shop']['name'])) { ?><?php  echo $_W['account']['name'];?><?php  } else { ?><?php  echo $set['shop']['name'];?><?php  } ?> </div>

</div>

<!-- js -->

<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/roll.js"></script>

<!-- footer -->

<?php  $show_footer=true; $footer_current ='bonusplus'?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 