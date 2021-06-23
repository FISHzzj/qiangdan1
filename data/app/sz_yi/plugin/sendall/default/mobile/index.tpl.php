<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<title>全球分红</title>

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/style1.css">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/aui.css">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/fontMain/iconfont.css">
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



    .content_header{height: 226px;}
    .content_headerT{height: 120px;width: 100%;background: #fb5e59;color: #fff;position: relative;}
    .returnfn{position: relative;left: 15px;top:-4px;}
    .returnfont{text-align: center;font-size: 16px;position: relative;color:#ffada1;}
    .money{font-size:30px;text-align: center; }
    .content_headerList{display: flex;display: -webkit-flex;height: 70px;padding:10px 0;background: #fb5e59;border-top: 1px solid #ff736c;}
    .content_headerList_li{flex: 1;text-align: center;-webkit-flex:1;}
    .content_headerList_li>p{color:#ffada1;}
    .aui-list .aui-list-item{border-bottom: 1px solid #ddd;}
    .aui-list .aui-list-item-title{font-size: 14px;}
    .f-fsize25{font-size: 19px;}

</style>

<div id='container' style="overflow: hidden;">

        <div class="content_header">
            <div class="content_headerT">
                <div class="returnfn">
                    <i class="fa fa-angle-left" style="font-size: 30px;margin-top: 10px;"></i>
                </div>
                <div class="returnfont">待分红（元）</div>
                <div class="money"><?php  echo $member['commission_ok'];?></div>
                <div class="content_headerList">
                    <div  class="content_headerList_li">
                        <p>已分红</p>
                        <div class="f-fsize25">
                            <?php  if(empty($member['commission_pay'])) { ?>0.00<?php  } else { ?><?php  echo $member['commission_pay'];?><?php  } ?>
                        </div>
                    </div>
                    <div  class="content_headerList_li">
                        <p>分红比例</p>
                        <div class="f-fsize25"><?php  echo $bonus_ratio;?></div>
                    </div>
                    <div  class="content_headerList_li">
                        <p>当前分红等级</p>
                        <div class="f-fsize25"><?php  echo $bonus_level;?></div>
                    </div>
                </div>

                <ul class="aui-list aui-list-in">
                    <li class="aui-list-item">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-title">订单总金额（元） <span style="color:red;font-weight: bold;"><?php  echo $global_total;?></span></div>
                            <div class="aui-list-item-right" style="font-size: 14px;"><?php  if($type == 0) { ?>自营订单<?php  } else { ?>全部订单<?php  } ?></div>

                    </li>
                </ul>

            </div>
            </div>
            <div class="aui-content aui-margin-b-15">
                <ul class="aui-list aui-media-list">
                    <li class="aui-list-header">
                       <div class="aui-list-item-title"><i class="iconfont" style="margin-right: 5px;">&#xe671;</i>分红记录</div>

                    </li>
                    <li class="aui-list-item ">
                        <div class="aui-media-list-item-inner">
                            <div class="aui-list-item-inner">
                                <div class="aui-list-item-text">
                                    <div class="aui-list-item-title">金额/时间</div>
                                    <div class="aui-list-item-right" style="font-size: 14px;color:#313131;">打款方式</div>
                                </div>

                            </div>
                        </div>
                    </li>

                     <?php  if(empty($list)) { ?>
                        <div class="f-tac" style="padding: 30px 0px 10px 0;">
                            <img src="../addons/sz_yi/template/mobile/style1/static/images/norecord.png" alt="" style="width: 125px;">
                            <p class="f-fsize17" style="padding-top: 5px;">暂无记录</p>
                        </div>

                     <?php  } else { ?>
                        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                            <li class="aui-list-item">
                                <div class="aui-media-list-item-inner">
                                    <div class="aui-list-item-inner">
                                        <div class="aui-list-item-text">
                                            <div class="aui-list-item-title" style="font-size: 18px;color:#ff403f;font-weight: bold;"><?php  echo $row['money'];?></div>
                                            <div class="aui-list-item-right" style="font-size: 14px;top: 10px;"><?php  if($row['paymethod'] == 0) { ?>账号余额<?php  } else { ?>微信<?php  } ?></div>
                                        </div>
                                        <div class="aui-list-item-text aui-ellipsis-2">
                                            <?php  echo date('Y-m-d H:i',$row['ctime']);?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php  } } ?>

                     <?php  } ?>


                </ul>
            </div>


            <div class="content_headerB"></div>
        </div>


    <div class="copyright">版权所有 ©<?php  if(empty($set1['copyright'])) { ?><?php  echo $_W['account']['name'];?><?php  } else { ?><?php  echo $set1['copyright'];?><?php  } ?></div>

</div>

<!-- js -->

<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/roll.js"></script>

<!-- footer -->

<?php  $show_footer=true; $footer_current ='bonus'?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>