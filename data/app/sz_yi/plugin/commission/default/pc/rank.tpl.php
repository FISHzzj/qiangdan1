<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?>

<title><?php  echo $this->set['texts']['rank']?></title>

<style type="text/css">

    body {margin:0px; background:#eee; font-family:'微软雅黑'; -moz-appearance:none;}

    a {text-decoration:none;}

    .customer_top {height:44px; width:100%;  background:#f8f8f8;  border-bottom:1px solid #e3e3e3;}

    .customer_top .title {height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#666;}



    .customer_list_head {height:100px; width:94%; background:#fff; padding:10px 3%;border-bottom:1px solid #eaeaea;box-sizing: content-box;}

    .customer_list_head .info {height:100px; width:60%; float:left;  font-size:16px; color:#666; line-height:20px; text-align:left;padding-left: 10px;line-height: 30px;}

    .customer_list_head .info span {font-size:14px; color:#999;}

    .customer_list_head .num {height:100px; float:right; text-align:right; font-size:16px; color:#666; line-height:20px; font-size:14px; color:#999;}





    .customer_list {width:94%;height: 40px; background:#fff; padding:10px 3%;box-sizing: content-box;}

    .customer_list .img { width:16%; height:40px;  float:left; text-align:left; vertical-align: middle;padding-left: 10px;}

    .customer_list .img img {height:40px; width:40px; }

    .customer_list .left { float:left;width:60%; }

    .customer_list .info {height:20px; width:100%; float:left; border-right:1px solid #eaeaea; font-size:16px; color:#666; line-height:20px; text-align:left;}

    .customer_list .info span {font-size:14px; color:#999;}

    .customer_list .num {height:40px; width:6%; float:right; text-align:right; font-size:16px; color:#666; line-height:20px;}

    .customer_list .num span {font-size:14px; color:#999;}

    .customer_tab {height:30px; margin:5px; border:1px solid #ff6801; border-radius:5px; overflow:hidden;font-size:13px;background:#fff;padding-right: -2px;}

    .customer_nav {height:30px;  background:#fff; color:#666; text-align:center; line-height:30px; float:left;}

    .customer_navon {color:#fff; background:#ff6801;}

    .customer_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}

    #customer_loading { padding:10px;color:#666;text-align: center;}



</style>

<div style="width: 960px;float: left;margin-left: 15px;">

<div class="customer_top">

    <div class="title" onclick='history.back()'><!--<i class='fa fa-chevron-left'></i>--> <?php  echo $this->set['texts']['rank']?></div>

</div>

<div class="customer_list_head" style="height: 25px;">

    <div class="info">您当前等级：<?php  if($list['agentlevel']==0) { ?>普通等级<?php  } else { ?><?php  echo $list['levelname'];?><?php  } ?></div>

</div>

<div class="customer_list_head" style="height: 120px;">

        <div class="info" style="height: 60px;margin-top:-40px;">

        <?php echo empty($set['levelname'])?'普通等级':$set['levelname']?><br/>

        <?php  if($set['become']==0) { ?>无条件

        <?php  } else if($set['become']==1) { ?>申请

        <?php  } else if($set['become']==2) { ?>消费达到<?php  echo $set['become_ordercount'];?>次

        <?php  } else if($set['become']==3) { ?>消费达到<?php  echo $set['become_moneycount'];?>元

        <?php  } else if($set['become']==4) { ?>购买商品：<br />

        <?php  if(!empty($goods)) { ?>[<?php  echo $goods['id'];?>]<?php  echo $goods['title'];?><?php  } ?>

        <?php  } ?><br/>

        <?php  if($set['extract_commission'] == 1) { ?>佣金提现,<?php  } ?>              <?php  if($set['spread_qrcode'] == 1) { ?>推广二维码,<?php  } ?>              <?php  if($set['select_goods'] == 1) { ?>自选商品,<?php  } ?>              <?php  if($set['closemyshop'] != 1) { ?>我的小店,<?php  } ?>              <?php  if($set['openorderdetail'] == 1) { ?>订单商品详情,<?php  } ?>              <?php  if($set['openorderbuyer'] == 1) { ?>订单购买者详情,<?php  } ?>              <?php  if($set['remind_message'] == 1) { ?>消息提醒,<?php  } ?>              <?php  if($set['liuyan'] == 1) { ?>开启留言<?php  } ?><?php  if($set['rank'] == 1) { ?>,分销等级<?php  } ?>

        </div>

</div>

<?php  if(is_array($list1)) { foreach($list1 as $row) { ?>

<div class="customer_list_head" style="height: 120px;">

    <div class="info" style="width: 940px;">

        <?php  echo $row['levelname'];?><br />

        <?php  if($row['tiaojian']==1) { ?>(满足任意一个条件)<?php  } else { ?>(满足所有条件)<?php  } ?><br/>

        <?php  if($set['extract_commission'] == 1) { ?>佣金提现,<?php  } ?>              <?php  if($set['spread_qrcode'] == 1) { ?>推广二维码,<?php  } ?>              <?php  if($set['select_goods'] == 1) { ?>自选商品,<?php  } ?>              <?php  if($set['closemyshop'] != 1) { ?>我的小店,<?php  } ?>              <?php  if($set['openorderdetail'] == 1) { ?>订单商品详情,<?php  } ?>              <?php  if($set['openorderbuyer'] == 1) { ?>订单购买者详情,<?php  } ?>              <?php  if($set['remind_message'] == 1) { ?>消息提醒,<?php  } ?>              <?php  if($set['liuyan'] == 1) { ?>开启留言<?php  } ?><?php  if($set['rank'] == 1) { ?>,分销等级<?php  } ?><br/>

        <?php  $updatelevel =  json_decode($row['updatelevel'],true); ?>

        <?php  if(!empty($updatelevel['0'])) { ?>分销订单金额满<?php  echo $updatelevel['0'];?>元<?php  } ?>

        <?php  if(!empty($updatelevel['1'])) { ?>、一级分销订单金额满<?php  echo $updatelevel['1'];?>元<?php  } ?>

        <?php  if(!empty($updatelevel['2'])) { ?>、分销订单数量满<?php  echo $updatelevel['2'];?>个<?php  } ?>

        <?php  if(!empty($updatelevel['3'])) { ?>、一级分销订单数量满<?php  echo $updatelevel['3'];?>个<?php  } ?>

        <?php  if(!empty($updatelevel['4'])) { ?>、自购订单金额满<?php  echo $updatelevel['4'];?>元<?php  } ?>

        <?php  if(!empty($updatelevel['5'])) { ?>、下级总人数满<?php  echo $updatelevel['5'];?>个 （分销商+非分销商)<?php  } ?>

        <?php  if(!empty($updatelevel['6'])) { ?>、一级下级人数满<?php  echo $updatelevel['6'];?>个（分销商+非分销商）<?php  } ?>

        <?php  if(!empty($updatelevel['7'])) { ?>、团队总人数满<?php  echo $updatelevel['7'];?>个（分销商）<?php  } ?>

        <?php  if(!empty($updatelevel['8'])) { ?>、一级团队人数满<?php  echo $updatelevel['8'];?>个（分销商 ）<?php  } ?>

        <?php  if(!empty($updatelevel['9'])) { ?>、已提现佣金总金额满<?php  echo $updatelevel['9'];?>元<?php  } ?>

        <?php  if(!empty($updatelevel['10'])) { ?>、积分金额满<?php  echo $updatelevel['10'];?>个<?php  } ?>

        <?php  if(!empty($updatelevel['11'])) { ?>、指定等级:

        <?php  if(is_array($show)) { foreach($show as $r) { ?>

            <?php  if($updatelevel['11']==$r['id'] ) { ?>

                <?php  echo $r['levelname'];?>

            <?php  } ?>

        <?php  } } ?>

        ,一级下级人数满<?php  echo $updatelevel['12'];?>人



                        </span>

                        <?php  } ?>

    </div>

</div>



<?php  } } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>

