<?php defined('IN_IA') or exit('Access Denied');?>﻿<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<!-- center -->
<title>奖金明细</title>

<style type="text/css">
	.customer_top {height:44px; width:100%;  background:#10BDFF;  border-bottom:1px solid #ccc;}
    .customer_top .title {height:44px; width:auto; float:left; font-size:16px; line-height:44px; color:#fff;}
	.back{width: 30px;height: 30px;font-size: 24px;border-radius: 50%;float: left;line-height: 33px;text-align: center;margin: 5px; font-family: arial, helvetica, sans-serif;}
	.content{width: 100%;height: auto;background: #fff;margin-top: 10px;}
	.content-list{width: 94%;margin: 0 auto;display: flex;display:-webkit-flex;padding-bottom: 10px;border-bottom:1px solid #ccc ;}
	.content .content-list:last-child{border-bottom:0 ;}
	.content-list .leftlist{width: 70%;float: left;}
	.content-list .leftlist span{display: block;font-size: 16px;margin-top: 10px;}
	.content-list .rightlist{width:30%;text-align: right;}
	.content-list .rightlist span{display: block;font-size: 16px;margin-top: 6px;}
    
</style>
<body>
    <div class="customer_top">
		<div class="title" onclick='history.back()'><span class="back"><</span>返回<p style="display: inline-block;margin-left: 76px;">奖金明细</p></div>
	</div>
	<div class="content">
		<div class="content-list">
			<div class="leftlist">
				<span>订单号:sh2222222222</span>
				<span style="color: #ccc;">2017-04-07 18:06</span>
			</div>
			<div class="rightlist">
				<span style="color: red;font-size: 20px;">￥500</span>
				<span>已提现</span>
				
			</div>
			
			
			
		</div>
		<div class="content-list">
			<div class="leftlist">
				<span>订单号:sh2222222222</span>
				<span style="color: #ccc;">2017-04-07 18:06</span>
			</div>
			<div class="rightlist">
				<span style="color: red;font-size: 20px;">￥500</span>
				<span>已提现</span>
				
			</div>
			
			
			
		</div>
		<div class="content-list">
			<div class="leftlist">
				<span>订单号:sh2222222222</span>
				<span style="color: #ccc;">2017-04-07 18:06</span>
			</div>
			<div class="rightlist">
				<span style="color: red;font-size: 20px;">￥500</span>
				<span>已提现</span>
				
			</div>
			
			
			
		</div>
		<div class="content-list">
			<div class="leftlist">
				<span>订单号:sh2222222222</span>
				<span style="color: #ccc;">2017-04-07 18:06</span>
			</div>
			<div class="rightlist">
				<span style="color: red;font-size:20px;">￥500</span>
				<span>已转入</span>
				
			</div>
			
			
			
		</div>
		<div class="content-list">
			<div class="leftlist">
				<span>订单号:sh2222222222</span>
				<span style="color: #ccc;">2017-04-07 18:06</span>
			</div>
			<div class="rightlist">
				<span style="color: red;font-size: 20px;">￥500</span>
				<span>已提现</span>
				
			</div>
			
			
			
		</div>
	</div>
  
</body>
<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>