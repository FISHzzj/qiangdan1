<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
	<title>线下支付记录</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" type="text/css" href="../addons/sz_yi/static/css/aui.2.0.css">
	<style type="text/css">
		.aui-list .aui-list-header{line-height: 1rem;background: #f2f2f2;font-size: 0.8rem;padding:0;}
		.list_header_title{width:20%;text-align: center;min-height:2.2rem;line-height: 2.2rem;}
		.list_header_titleR{width:40%;text-align: center;min-height:2.2rem;line-height: 2.2rem;}
		.color_red{color:#FF3838;}
		.color_9E9{color:#9E9E9E;}
		.font_left{text-align: left;}
		.dropload-noData img{width: 60px;}
        .aui-list .aui-list-item-inner{padding-right: 0.2rem}
	</style>

<div class="page_topbar">
        <a href="#" class="back" onclick="history.back()">
            <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
         </a>
        <div class="title" style=" color: #282828;">线下支付记录</div>
</div>
<!-- 无 -->
<?php  if(empty($list)) { ?>
<div class="aui-content aui-margin-b-15">
    <ul class="aui-list aui-list-in">
        <li class="aui-list-header">
            <div class="list_header_title aui-pull-left color_9E9 f-fsize12">用户</div>
            <div class="list_header_title aui-pull-left color_9E9 f-tac f-fsize12">金额（元）</div>
            <div class="list_header_title aui-pull-left color_9E9 f-fsize12">支付方式</div>
            <div class="list_header_titleR aui-pull-left color_9E9 f-fsize12">支付时间</div>
        </li>
    </ul>

</div>

<div class="dropload-noData" style="width:100%;margin:120px auto 0 auto;">
      
  <div style="display:block;margin-top: 18px;padding:0px 0 0 0; text-align:center;">
    	<img src="../addons/sz_yi/static/images/07.png">
    	<br>暂无记录</div>

</div>
<?php  } else { ?>
<!-- 有列表 -->
 <div class="aui-content aui-margin-b-15">
    <ul class="aui-list aui-list-in">

        <li class="aui-list-header f-fsize16">
            <div class="list_header_title aui-pull-left color_9E9 f-fsize12">用户</div>
            <div class="list_header_title aui-pull-left color_9E9 f-fsize12">金额（元）</div>
            <div class="list_header_title aui-pull-left color_9E9 f-fsize12">支付方式</div>
            <div class="list_header_titleR aui-pull-left color_9E9 f-fsize12">支付时间</div>
        </li>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="list_header_title aui-pull-left font_left"><?php  echo $row['member_name'];?></div>
                <div class="list_header_title color_red aui-pull-left f-tac"><?php  echo $row['price'];?></div>
	            <div class="list_header_title aui-pull-left"><?php  if($row['pay_type'] == 1) { ?>微信<?php  } else { ?>支付宝<?php  } ?></div>
	            <div class="list_header_titleR aui-pull-left color_9E9 f-fsize14"><?php  echo date('Y-m-d H:i',$row['createtime'])?></div>
            </div>
        </li>
        <?php  } } ?>
    </ul>
</div>
<?php  } ?> 
<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>