<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?> 

<title>奖金提现</title>

<style type="text/css">

body {margin:0px; background:#eee; font-family:'微软雅黑'; }

a {text-decoration:none;}

.pc-cen{ width: 100%;position: relative;padding-left: 312px;border-top:3px solid #e31939;border-bottom: 1px #eee solid;}

.topbar {height:100%;padding: 30px 6px;position: absolute;left: 0;top: 0;background:#fcfbf7;width: 312px;border-right: 1px solid #eeeeee;}

.topbar .user_face {height:100px; width:100px; background:#ccc; float:left;border-radius:50px; }

.topbar .user_face img {height:100%; width:100%;border-radius:50px;}

.topbar .user_info {height:40px; width:187px; float:left; margin-left:12px;}

.topbar .user_info .user_name {cursor: pointer;padding: 14px 0 0;width:100%; font-size:18px; line-height:24px; color:#222;}

.topbar .user_info .user_date {height:14px; width:100%; font-size:12px; line-height:14px; color:#999;}

.topbar .user_info .user-dj{font-size:14px; color:#e31939;display: block;padding: 0 0 4px;}

.top-fx {height:158px;padding:50px 30px;}

.top-fx .top_1 {height:40px; width:100%;}

.top-fx .top_1 .text {height:14px; width:auto; float:left;line-height:25px; font-size:14px; color:#666666;}

.top-fx .top_1 .ico {height:40px; width:30px; background:url(../addons/sz_yi/plugin/commission/template/mobile/default/static/images/gold_ico2.png) 0px 10px no-repeat; margin-bottom:74px; float:right;}

.topbonus {height:40px;padding:5px; background:#cc3431;}

.topbonus .top_1 {height:40px; width:100%;}

.topbonus .top_1 .text {height:40px; width:auto; float:left; color:#fff; line-height:20px; font-size:14px; color:#fff;}

.topbonus .top_1 .ico {height:40px; width:30px; background:url(../addons/sz_yi/plugin/commission/template/mobile/default/static/images/gold_ico2.png) 0px 10px no-repeat; margin-bottom:74px; float:right;}

.top-fx .top_2 {width:100%; border-bottom: 1px #eeeeee solid;overflow: hidden;}

.top-fx .top_2 .pr-jine em{font-size:40px; line-height:66px; color:#ff8208;float: left;font-style: normal;}

.top-fx .top_2 .tx-name{line-height: 12px;font-size: 12px;color: #a9a9a9;}

.top-fx .top_2 span {height:28px; color:#fff; width:auto; background-color: #0ae;font-size:14px; line-height:28px; margin:20px 0 0 20px; padding:0px 15px;  float:left; border-radius:5px;}

.top-fx .top_2 .disabled { background: #ccc}

.menu2 {overflow:hidden; background:#fff;width: 100%;padding: 12px;}

.menu2 .nav { width:23%; float:left;margin: 1%;background-color: #F3F3F3;padding: 20px;border-radius: 4px; text-align: center;}

.menu2 .nav i{color: #fff !important;border-radius: 50px;width: 40px;height: 40px;line-height: 40px;float: left;font-size: 20px;}

.menu2 .nav .fa-cny{background-color: #ff9901;}

.menu2 .nav .fa-list{background-color: #FF6C9C;}

.menu2 .nav .fa-random{background-color: #ca81d1;}

.menu2 .nav .fa-user{background-color: #FF6441;}

.menu2 .nav .fa-users{background-color: #3c7bce;}

.menu2 .nav .fa-qrcode{background-color: #ffcb05;}

.menu2 .nav .fa-cog{background-color: #aadaf6;}

.menu2 .nav .fa-star{background-color: #7ED484;}

.menu2 .nav .fa-times {background-color: #5ED1FF;}

.menu2 .nav .title {padding-left: 50px;height:24px; width:100%; text-align:left; font-size:14px; color:#222;}

.menu2 .nav .con {padding-left: 50px;height:20px; width:100%; text-align:left; font-size:12px; color:#999;}

.menu2 .nav .con span {color:#f90;}



/*.menu .nav1 {border-bottom:1px solid #f1f1f1; border-right:1px solid #f1f1f1;   }

.menu .nav2 {border-bottom:1px solid #f1f1f1; }*/

</style>

<div id='container' class="rightlist"></div></div>

<script id='tpl_main' type='text/html'>

    <div class="page_topbar">

        <div class="title">奖金提现</div>

    </div>

    <div class="pc-cen">

        <div class="topbar">

            <div class="user_face"><img src="<%member.avatar%>"></div>

            <!-- <div style="float:right;" onclick="window.location.href=' <?php  echo $this->createPluginMobileUrl('withdrawals/info',array('op'=>'edit'));?> '"><img src="../addons/sz_yi/plugin/suppliermenu/res/edit1.png" style="width:30px;"></div> -->

            <div class="user_info">

                <div class="user_name" <%if set.levelurl!=''%>onclick='location.href="<%set.levelurl%>"'<%/if%>><%member.nickname%> </div>

                <div class="user-dj">

                    用户名：<?php  echo $member['realname'];?>

                </div>

            </div>



        </div> 

        <div class="top-fx">

            <div class="top_1">

                <div class="text">累计奖金：<?php echo empty($total)?'0.00':$total?>元</br>

                已提现：<?php echo empty($already)?'0.00':$already?>元</br>

                已申请提现：<?php echo empty($keep_apply)?'0.00':$keep_apply?>元

                </div>

            </div>

        </div>

    </div>

    <div class="menu2">  

        <a href="<?php  echo $this->createPluginMobileUrl('withdrawals/income_detail')?>"><div class="nav nav1"><i class="fa fa-list fa-3x" style="color:#ffcb05;"></i><div class="title">奖金明细</div><!-- <div class="con">￥<?php echo empty($total)?'0.00':$total?></div> --></div></a>

        

       <!--  <a href="<?php  echo $this->createPluginMobileUrl('withdrawals/already_present')?>"><div class="nav nav2"><i class="fa fa-random  fa-3x" style="color:#ca81d1;"></i><div class="title">已提现</div><div class="con">￥<?php echo empty($already)?'0.00':$already?></div></div></a>

       <a href="<?php  echo $this->createPluginMobileUrl('withdrawals/already_applied')?>"><div class="nav nav1"><i class="fa fa-user  fa-3x" style="color:#98cd37;"></i><div class="title">已申请</div><div class="con">￥<?php echo empty($keep_apply)?'0.00':$keep_apply?></div></div></a> -->

        <a href="<?php  echo $this->createPluginMobileUrl('withdrawals/bonus')?>"><div class="nav nav1"><i class="fa fa-list fa-3x" style="color:#ffcb05;"></i><div class="title">奖金提现</div><div class="con"></div></div></a>

        <?php  if($hascom) { ?>

        <div class="nav nav1"><i class="fa fa-list fa-3x" style="color:#ffcb05;"></i><div class="title">分销奖金</div><div class="con">￥<?php echo empty($gettotal)?'0.00':$gettotal?></div></div>

        <?php  } ?>

        <div class="nav nav2"><i class="fa fa-random  fa-3x" style="color:#ca81d1;"></i><div class="title">代理奖金</div><div class="con">￥<?php echo empty($bonus)?'0.00':$bonus?></div></div>

        <div class="nav nav1"><i class="fa fa-user  fa-3x" style="color:#98cd37;"></i><div class="title">区域奖金</div><div class="con">￥<?php echo empty($all_bonus)?'0.00':$all_bonus?></div></div></a>

        <div class="nav nav1"><i class="fa fa-list fa-3x" style="color:#ffcb05;"></i><div class="title">全球奖金</div><div class="con">￥<?php echo empty($all_bonus)?'0.00':$all_bonus?></div></div>

        <?php  if($return['isqueue']==1) { ?>

        <div class="nav nav1"><i class="fa fa-list fa-3x" style="color:#ffcb05;"></i><div class="title">排位返奖金</div><div class="con">￥<?php echo empty($r_each)?'0.00':$r_each?></div></div>

        <?php  } ?>

        <?php  if($bonusplus1['start']==1) { ?>

        <div class="nav nav2"><i class="fa fa-random  fa-3x" style="color:#ca81d1;"></i><div class="title">静态返奖金</div><div class="con">￥<?php echo empty($bonusplus)?'0.00':$bonusplus?></div></div>

        <?php  } ?>

        <?php  if($premium1['level']==3) { ?>

        <div class="nav nav1"><i class="fa fa-user  fa-3x" style="color:#98cd37;"></i><div class="title">新三级分销奖金</div><div class="con">￥<?php echo empty($premium)?'0.00':$premium?></div></div>

        <?php  } ?>

        <?php  if($twoway['no']==1) { ?>

        <div class="nav nav1"><i class="fa fa-list fa-3x" style="color:#ffcb05;"></i><div class="title">多轨奖金</div><div class="con">￥<?php echo empty($prize)?'0.00':$prize?></div></div>

        <?php  } ?>

    </div>

</script>

 

<script language="javascript">

    require(['tpl', 'core'], function(tpl, core) {

        

        

        core.pjson('commission/withdraw',{},function(json){

            var result = json.result;   

            $('#container').html(  tpl('tpl_main',result) );

            $('#withdraw').click(function(){

                if(!json.result.mycansettle){

                     if(json.result.mysettlemoney>0){

                        core.tip.show('您需要自己购买订单完成，共计'+json.result.mysettlemoney+'元才能申请<?php  echo $this->set['texts']['withdraw']?>!');

                        return;    

                     }

                }

                if(!json.result.cansettle){

                     if(json.result.settlemoney>0){

                     core.tip.show('需到'+json.result.settlemoney+'元才能申请<?php  echo $this->set['texts']['withdraw']?>!');    

                     }else{

                        core.tip.show('无可提<?php  echo $this->set['texts']['commission']?>!');        

                     }

                }

            });

        },true);

    })

</script>



<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>

