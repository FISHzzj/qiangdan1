<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>申请成功</title>
	<style type="text/css">
		.alert {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background-color: rgba(0, 0, 0, .5);
			z-index: 99;

		}

		.alert-bg {
			position: absolute;
			top: 20%;
			left: 18%;
			width: 60%;
			height: 52%;
			background-color: #fff;
			border-radius: 10px;
			text-align: center;

		}
		.close-alert {
			display: inline-block;
			width: 20px;
			height: 20px;
			border-radius: 50%;
			background-color: #ccc;
			line-height: 20px;
			position: absolute;
			top: -10px;
			right: -10px;

		}
		.alert-bg p {
			font-size: 20px;
			letter-spacing: 3px;
		}
		.alert-bg img {
			width: 120px;
			height: 120px;
			border-radius: 50%;
		}
		.alert-bg .reapply {
			display: block;
			margin: 20px auto;
			width: 150px;
			height: 30px;
			font-size: 18px;
			text-align: center;
			line-height: 30px;
			border-radius: 15px;
			background-color: #0ff;
		}
	</style>
	
</head>
<body>
	<div class="alert">
		<div class="alert-bg">
			<span class="close-alert" onclick="window.location.href='<?php  echo $this->createMobileUrl('member')?>'">X</span>
			<h2>申请成功</h2>
			<!-- <p>恭喜你!</p> -->
			<p>入口未开放</p>
			<p style="font-size: 14px;">你的用户名为:<?php  echo $username;?></p>
			<img src="/addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/success.png">
			<span class="reapply" onclick="window.location.href='<?php  echo $this->createMobileUrl('member')?>'">确定</span>
		</div>
	</div>
	
</body>
</html>