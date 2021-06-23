<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?>

<title>奖金明细</title>

<style type="text/css">

body {margin:0px; background:#eee; font-family:'微软雅黑'; -moz-appearance:none;}

a {text-decoration:none;}

.order_top {height:44px; width:100%;  background:#f8f8f8;  border-bottom:1px solid #e3e3e3;}

.order_top .title {height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#666;}

.order_top .num { color:#666;height:44px;line-height:44px;padding-right:5px;text-align:center;}



.order_menu {height:44px; background:#fff;}

.order_menu .nav {height:44px; width:16%; border-bottom:1px solid #f1f1f1;background:#fff; border-left:1px solid #f1f1f1; float:left; line-height:44px; font-size:14px; color:#666; text-align:center;}

.order_menu .navon {height:42px; color:#ff771b; border-bottom:2px solid #ff771b;}



.order_title {height:40px; padding:5px; line-height:50px; font-size:16px; color:#666;}



.order_list {height:105px; padding:10px; background:#fff;margin-top:5px;}

.order_list .left {height:40px; width:100%; float:left; color:#999; margin-right:-20%;font-size:14px;}

.order_list .left .inner { width:100%;margin-right:-20%;padding-left: 10px;}

.order_list .left span {color:#666; font-size:14px; line-height:28px;}

.order_list .right {height:40px; width:20%; float:right; font-size:14px; text-align:right; line-height:18px; margin-left:-20%;}

.order_list .right span {color:#f90;}

.order_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}

#order_loading { padding:10px;color:#666;text-align: center;}





.order_detail {overflow:hidden; padding:10px; background:#fff; border-top:1px solid #eaeaea;}

   .team_list {height:40px; background:#fff; }

    .team_list .img { width:16%; height:40px; float:left; text-align:left; }

    .team_list .img img {height:40px; width:40px; }



    .team_list .info {height:40px; width:80%; float:left; font-size:16px; color:#666; line-height:20px; text-align:left;}

    .team_list .info span {font-size:14px; color:#999;}



     .detail_good {height:auto;background:#fff; padding-top:5px;  }

    .detail_good .ico {height:6px; width:10%; line-height:36px; float:left; text-align:center;}

    .detail_good .shop {height:36px; width:90%; padding-left:10%;  line-height:36px; font-size:18px; color:#333;}

    .detail_good .good {height:50px; width:100%; padding:10px 0px; }

    .detail_good .img {height:50px; width:50px; float:left;}

    .detail_good .img img {height:100%; width:100%;}

    .detail_good .info {width:80%;float:left; margin-left:-50px;margin-right:-60px;}

    .detail_good .info .inner { margin-left:60px;margin-right:60px; }

    .detail_good .info .inner .name {height:32px; width:100%; float:left; font-size:12px; color:#555;overflow:hidden;}

    .detail_good .info .inner .option {height:16px; width:100%; float:left; font-size:12px; color:#888;overflow:hidden;word-break: break-all}

    .detail_good span { color:#666;}

    .detail_good .price { float:right;width:110px;;height:30px;margin-left:-60px;}

    .detail_good .price .pnum { height:20px;width:100%;text-align:right;font-size:13px;color:#666; }

    .detail_good .leiji .pnum { font-size:13px;color:#666; }

    .detail_good .fanxian .pnum { font-size:13px;color:#666; }

</style>


<div class="rightlist">
    <div class="order_top">

        <div class="title" onclick='history.back()'><返回</div>

        <div class='num'>奖金明细</div>

    </div>

        <?php  if(is_array($list)) { foreach($list as $vo) { ?>

      <div class="order_list">

     <div class="left"><div class='inner'><span><?php  echo $vo['title'];?></br>流水号：<?php  echo $vo['logno'];?></br><?php  echo $vo['createtime'];?></span></div></div>

       <div class="right"><span style="color:#999;"><span style="color:red;">￥<?php  echo $vo['money'];?></span></br></br><?php  if($vo['status'] == 1) { ?>已转入<?php  } ?></div>

     </div>

        <?php  } } ?>

        <?php  echo $pager;?>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>

