<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php  echo $time;?></title>
    <meta name="format-detection" content="telephone=no, address=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<link href="../addons/themes/shopping/mobile/css/bootstrap.min.css" rel="stylesheet">

	<style type="text/css">
	*{ margin: 0;padding: 0;}
	body{  color: #411c20; font-size: 14px;}
	#content{ width: 100%; margin: 0 auto; max-width: 640px;}
	a, a:link,a:visited ,a:hover ,a:active,a:focus{ color: #411c20;}
	.ypym{ padding:0 15px;}
	.ypym a,.ypym a:link,.ypym a:visited,.ypym a:hover,.ypym a:active{ color: #380108;}
	.ypym .p2{ text-indent: 2em;}
	.colf63e3e{ color: #f63e3e;}
	.ypymList{ margin:8px 0 25px; border-right: 1px solid #380007; border-bottom: 1px solid #380007;}
	.ypymList li{ display: table;border-top: 1px solid #380007;  width:100%; }
	.ypymList li>span{ display: table-cell; vertical-align: middle;  text-align: center; border-left: 1px solid #380007; padding:3px;}
	.ypymList{ width:100%;}
	.ypymList .span1{ width: 22%; font-size: .857em;}
	.ypymList .span2{ width:28%;}
	.ypymList .span3{ width:50%;}
	.ypymList_title{ font-weight: 700;}
	.footer-ypym{ padding-top: 50px;  line-height: 32px; }

	.animateDiv{ position: relative; width: 100%;height: 100%;margin-bottom: 50px;}
	.aImgText{ position: absolute; color: #fff100; font-size: 12px !important;  font-weight: 600; width: 100%; text-align: center;font-family:'microsoft yahei',"微软雅黑";-webkit-text-shadow: 0 11px 11px #770013;
-moz-text-shadow: 0 11px 11px #770013;
text-shadow: 0 11px 11px #770013;}
	.aImgText b{ color: #fff; font-size: 3.125em;}
	@media screen and (min-width:320px){.aImgText{font-size:16px !important;}}
	@media screen and (min-width:400px){.aImgText{font-size:22px !important;}}
	@media screen and (min-width:480px){.aImgText{font-size:26px !important;}}
	@media screen and (min-width:640px){.aImgText{font-size:32px !important;}}

	.detailLink{ position: absolute; width: 26.72%;height: 34%; left: 67%; top: 61.22%; z-index: 6;}
	</style>
</head>
<!--背景颜色-->
<body style="background:<?php  echo $item['bgColor'];?>">
<div id="content">
	<div class="animateDiv">
		<!--背景图-->
		<?php  if(empty($item['headthumb'])) { ?>
		<img src=<?php  echo  $_W['siteroot']?>addons/sz_yi/plugin/yipinyima/img/mos.jpg width="100%">
		<?php  } else { ?>
		<img src=<?php  echo  $_W['siteroot']?>attachment/<?php  echo $item['headthumb'];?> width="100%">
		<?php  } ?>
		
     <?php  if($erweimas) { ?>
        <div class="aImgText" style="top:8%"><?php  echo $item['second_desc'];?></div>
      <?php  } else { ?>
		<?php  if($xjz>0) { ?>
		<div class="aImgText" style="top:25%"><b style="font-size: 16px;"><?php  echo $xjz;?>现金</b><br>已经转入您的现金账户</div>
		<?php  } ?>
		<?php  if($jcs>0) { ?>
		<div class="aImgText" style="top:42%"><b style="font-size: 16px;"><?php  echo $jcs;?>积分</b><br>已经转入您的积分账户</div>
		<?php  } ?>
		<?php  if($yhjms>0) { ?>
		<div class="aImgText" style="top:58%"><b style="font-size: 16px;"><?php  echo $yhjms;?>张优惠券</b><br>已经转入您的优惠券账户</div>
		<?php  } ?>
	   <?php  } ?>
	</div>
	<div class="ypym">
	
        <?php  if($erweimas) { ?>
        <p class="p1"><strong><?php  echo $item['oldtime_desc'];?></strong></p>
        <?php  } else { ?>
		<p class="p1"><strong><?php  echo $item['first_desc'];?></strong></p>
		<br>
		<?php  if($xjz>0) { ?>
		<?php  $ensm=$item['score_xianjin'];?>
		<?php  $ensm=str_replace(array('点击详情','%s'),array("<a href=".$item['linkurl'].">点击详情</a>","<strong class='colf63e3e'>".$xjz."</strong>"),$ensm);?>
		<p class="p2"><?php  echo $ensm;?></p>
		<?php  } ?>
		<?php  if($jcs>0) { ?>
		<?php  $jifen=$item['score_desc'];?>
		<?php  $jifen=str_replace(array('点击详情','%s'),array("<a href=".$item['linkurl'].">点击详情</a>","<strong class='colf63e3e'>".$jcs."</strong>"),$jifen);?>
		<p class="p2"><?php  echo $jifen;?></p>
		<?php  } ?>
		<?php  if($yhjms>0) { ?>
		<?php  $yhjssee=$item['score_youhuijuan'];?>
		<?php  $yhjssee=str_replace(array('点击详情','%s'),array("<a href=".$item['linkurl'].">点击详情</a>","<strong class='colf63e3e'>".$yhjms."</strong>"),$yhjssee);?>
		<p class="p2"><?php  echo $yhjssee;?></p>
		<?php  } ?>
       <?php  } ?>
		<br>
		<ul class="ypymList">
	        <li class="ypymList_title">
	          <span class="span1">累计已被扫描</span>
              <span class="span2">首次扫描者</span>
              <span class="span3">首次扫描时间</span>
	        </li>        
	        <li id="shuaxin">
              <span class="span1">
			  <?php  if($list['yipin_status']>0) { ?>
			  <?php  echo $list['yipin_status'];?>次
			  <?php  } else { ?>
			  <?php  echo $lise['zt_status'];?>次
			  <?php  } ?>
			  </span>
              <span class="span2">
			  <?php  if(empty($list['yipin_name'])) { ?>
			  <?php  echo $lise['zt_name'];?>
			  <?php  } else { ?>
			  <?php  echo $list['yipin_name'];?>
			  <?php  } ?>
			  </span>
              <span class="span3">
			  <?php  if($list['yipin_shijian']>0) { ?>
			  <?php  echo date('Y-m-d H:i:s',$list['yipin_shijian'])?>
			  <?php  } else { ?>
			   <?php  echo date('Y-m-d H:i:s',$lise['zt_shijian'])?>
			  <?php  } ?>
			  </span>
	        </li>  
	    </ul>
	    <!--广告和链接-->
		<?php  if(empty($item['adthumb'])) { ?>
		<a href="<?php  echo $item['linkurl'];?>"><img src=<?php  echo  $_W['siteroot']?>addons/sz_yi/plugin/yipinyima/img/dibu.jpg width="100%"></a>
		<?php  } else { ?>
	    <a href="<?php  echo $item['linkurl'];?>"><img src="<?php  echo $_W['siteroot']?>attachment/<?php  echo $item['adthumb'];?>" width="100%"></a>
		<?php  } ?>
		<div class="footer-ypym text-right">如有疑问请致电：<a  href="tel:<?php  echo $seten;?>"><?php  echo $seten;?></a></div>
	</div>
	
</div>
</body>

</html>