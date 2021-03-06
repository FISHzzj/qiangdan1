<?php defined('IN_IA') or exit('Access Denied');?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php  if(isset($title)) $_W['page']['title'] = $title?><?php  if(!empty($_W['page']['title'])) { ?><?php  echo $_W['page']['title'];?><?php  } ?><?php  if(empty($_W['page']['copyright']['sitename'])) { ?><?php  if(IMS_FAMILY != 'x') { ?><?php  if(!empty($_W['page']['title'])) { ?> - <?php  } ?>系统 - 公众平台自助引擎<?php  } ?><?php  } else { ?><?php  if(!empty($_W['page']['title'])) { ?> - <?php  } ?><?php  echo $_W['page']['copyright']['sitename'];?><?php  } ?></title>
	<meta name="keywords" content="<?php  if(empty($_W['page']['copyright']['keywords'])) { ?>系统,微信,微信公众平台<?php  } else { ?><?php  echo $_W['page']['copyright']['keywords'];?><?php  } ?>" />
	<meta name="description" content="<?php  if(empty($_W['page']['copyright']['description'])) { ?>公众平台自助引擎，是一款免费开源的微信公众平台管理系统，是国内最完善移动网站及移动互联网技术解决方案——KT出品<?php  } else { ?><?php  echo $_W['page']['copyright']['description'];?><?php  } ?>" />
	<link rel="shortcut icon" href="<?php  if(!empty($_W['setting']['copyright']['icon'])) { ?><?php  echo $_W['attachurl'];?><?php  echo $_W['setting']['copyright']['icon'];?><?php  } else { ?>./resource/images/favicon.ico<?php  } ?>" />
	<link href="./resource/css/bootstrap.min.css?v=20170915" rel="stylesheet">
	<link href="./resource/css/common.css?v=20170915" rel="stylesheet">

	<style type="text/css">
		/*找回密码*/
		.steps{
			display: block;
			width: 100%;
			height: 156px;
		}
		.steps-item{
			width: 33.3%;
			height: 100%;
			float: left;
		}
		.step-1-div-text{
			width: 100%;
			height: 30px;
			font-size: 18px;
			text-align: left;
			margin-top: 20px;
		}
		.form-inline{
			height: 48px;
			margin-top: 10px;
		}
		.form-inline input.form-control{
			height: 48px !important;
			width: 60%;
			float: left;
			margin: 0px;
			padding: 0px;
		}
		.form-inline .btn-primary{
			float: right !important;
			margin-top: 14px;
		}
		.form .form-inline input.form-input{
			width: 100%;
		}

		/*注册*/
		.form-group{
			width: 60%;
			margin: auto;
		}
		.we7-form .control-label, form .control-label .control-label{
			width: 15%;
			height: 100%;
			line-height: 60px;
			float: left;
			padding: 0px;
		}
		.col-sm-11{
			width: 85%;
			float: right;
		}
		.form-group .col-sm-11 input.form-control{
			float: left;
			width: 100%;
		}
		.login-submit .btn{
			width: 250px !important;
		}
		.form-group .col-sm-10 .ng-pristine{
			width: 100%;
		}
		/*侧边栏*/
		.skin-classical .first-sidebar{
			width: 110px;
			height: 100%;
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			background-color: #1c94c8;
			color: #fff;
			z-index: 10;
		}
		.skin-classical .first-sidebar div a.logo-wrap {
		    display: block;
		    padding: 10px;
		    height: 50px;
		    text-align: center;
		}
		.skin-classical .first-sidebar .nav .main-nav {
		    margin-top: 14px;
		}
		.skin-classical .first-sidebar .nav>ul>li {
		    line-height: 50px;
		    list-style: none;
	    	padding-left: 0;
		}
		.skin-classical .first-sidebar .nav>ul>li>a {
		    padding: 0 12px;
		    width: 100%;
		    overflow: hidden;
		}
		.skin-classical .first-sidebar .nav>ul>li.active{
			background-color: #1084b4;
		}
		.skin-classical .first-sidebar .nav>ul>li>a:hover{
			color:#fff;
		}
		.skin-classical .first-sidebar .nav>ul>li:hover{
			background-color: #1084b4;
		}
		.skin-classical .first-sidebar .logo-wrap .logo {
		    max-width: 90px;
		    max-height: 40px;
		}

		/*顶部*/
		.skin-classical .main-classical {
		    margin: 51px 0 0 110px;
		    height: 100%;
		    min-width: 1400px;
		}
		.skin-classical .main-classical .right-fixed-top {
		    width: 100%;
		    height: 51px;
		    background-color: #fff;
		    border-bottom: 1px solid #e7e7eb;
		    position: fixed;
		    top: 0;
		    left: 0;
		    right: 0;
		    z-index: 1;
		}
		.skin-classical .first-sidebar .nav .user-info {
		    margin: 0;
		    position: fixed;
		    top: 0;
		    right: 0;
		}
		.skin-classical .first-sidebar .nav .user-info li a {
		    color: #4c4c4c;
		}
		.skin-classical .first-sidebar .nav .user-info>li {
		    float: right;
		}
		.skin-classical .first-sidebar .nav>ul.user-info li.dropdown:hover{
			background-color: #eee;
		}
		.skin-classical .first-sidebar .nav>ul.user-info li.dropdown>a:hover{
			color: #4c4c4c;
		}
		.skin-classical .first-sidebar .nav .main-nav li:last-child {
		    padding-top: 14px;
		    border-top: 1px solid #1084b4;
		}
		.skin-classical .main-classical>.container {
		    width: 100%;
		    background-color: transparent;
		    position: relative;
		}
		.skin-classical .first-sidebar .nav .user-info .dropdown-menu li a {
		    background-color: #fff;
		    line-height: 46px;
		}
		.skin-classical .first-sidebar .nav .user-info .dropdown-menu li a:hover {
		    color: #1c94c8;
		}
		.skin-classical .icon-unfold {
		    width: 63px;
		    height: 50px;
		    text-align: center;
		    line-height: 50px;
		    position: fixed;
		    top: 0;
		    left: 110px;
		    z-index: 11;
		    cursor: pointer;
		}
		.skin-classical .left-menu .menu-title {
		    position: fixed;
		    left: 110px;
		    top: 0;
		    width: 210px;
		    line-height: 50px;
		    text-align: center;
		    border-right: 1px solid #e7e7eb;
		    background-color: #fff;
		    z-index: 10;
		    font-size: 16px;
		    color: #999;
		}
		.skin-classical .left-menu .account-info{
			cursor: pointer;
		    padding: 20px 10px 20px 76px;
		    min-height: 86px;
		    position: relative;
		    background-color: #fff;
		}
		.skin-classical .left-menu .account-info .head-logo{
			position: absolute;
		    width: 46px;
		    height: 46px;
		    top: 20px;
		    left: 15px;
		}
		.skin-classical .left-menu .account-info .account-type{
			    color: #999;
			    margin-top: 10px;
			    font-size: 12px;
			    margin-right: 10px;
		}
		.skin-classical .left-menu .account-operate{
			line-height: 36px;
		    color: #999;
		    font-size: 16px;
		    background-color: #fff;
		    border-bottom: 1px solid #f5f5f5;
		    text-align: center;
		}
		.skin-classical .left-menu .account-operate a+a{
		    margin-left: 50px
		}
		.panel-menu {
		    padding-left: 0;
		    margin-bottom: 0;
		    border: 0;
		    border-bottom: 1px solid #e7e7eb;
		    box-shadow: 0 0 0;
		    border-radius: 0;
		}
		.skin-classical .left-menu .panel-menu .panel-heading {
		    line-height: 40px;
		    padding: 0 15px;
		    color: #999;
		    background-color: #fff;
		}
		.skin-classical .left-menu .panel-menu .list-group-item {
		    padding: 0 30px;
		    background-color: #f6f8f8;
		}
		.left-menu .panel-heading span{
			display: inline;
		}
		.left-menu .panel-heading .collapsed .pull-right{
			float: right;
		}
		.panel-menu .list-group .list-group-item:hover{
			background-color: #428bca;
			color: #fff;
		}

		/*内容区域*/
		.panel .main-panel-body{
			width: 100%;
			min-height: 725px;
			padding: 0px;
			margin: 0px;
			display: block;
		}

		/*内容左侧*/
		.panel .main-panel-body .slimScrollDiv{
			float: left;
			width: 12%;
		}
		.skin-classical .left-menu-container{
		    height: calc(100vh - 51px)!important;
	        border-right: 1px solid #e7e7eb;
    		background-color: #f6f8f8;
		}
		.left-menu .setting {
		    line-height: 41px;
		}
		.skin-classical .left-menu .panel-menu .list-group-item.active{
		    background-color: #428bca;
		}
		/*内容右侧*/
		.skin-classical .main-classical .right-content {
			/*float: left;
			width: 88%;*/
			height: calc(100vh - 51px);
		    background-color: #f2f2f2;
		    overflow-y: auto;
		    padding: 10px;    
		}
		.skin-classical .main-classical .right-content .content {
		    border: 1px solid #e7e7eb;
		    background-color: #fff;
		    padding: 30px;
		}
		.welcome-container .account-stat .col-sm-4 {
		    color: #757575;
		    min-height: 104px;
		}
		.welcome-container .account-stat .title {
		    font-size: 16px;
		    color: #98999a;
		}
		.welcome-container .account-stat .num {
		    font-size: 30px;
		    margin: 20px 0;
		    color: #333;
		}
		.color-default {
		    color: #a9a9a9!important;
		}
		.welcome-container .apply-list .panel-body{
			padding: 15px;
		}
		.welcome-container .database .panel-body {
		    padding: 15px;
		}
		.welcome-container .database .panel-body .day {
		    font-size: 24px;
		    color: #428bca;
		}
		/*商城内容*/
		.store .modules{
		    margin-left: -30px;
		    margin-right: -30px;
		    padding: 15px;
		}
		.store .modules .item{
		    background-color: #fcfcfc;
		    margin: 15px;
		    padding: 20px 20px 20px 120px;
		    width: 448px;
		    float: left;
		    position: relative;
		    cursor: pointer;
		}
		.store .modules .item:hover{
			border: 1px solid #eee;
		}
		.store .modules .item .icon{
		    width: 60px;
		    height: 60px;
		    border-radius: 10px;
		    position: absolute;
		    left: 20px;
		    top: 10px;
		    text-align: center;
		    line-height: 80px;
		    background-color: #f8f8f8;
		}
		.store .modules .item .price{
		    color: #428bca;
		}
		.text-right {
		    text-align: right!important;
	        color: #999;
		}
		/*公众号内容*/
		.skin-classical .main-classical .panel-cut .panel-heading .pull-right {
		    display: block;
		    position: fixed;
		    top: 0;
		    left: 110px;
		    z-index: 15;
		}
		.skin-classical .main-classical>.container {
		    width: 100%;
		    background-color: transparent;
		    position: relative;
		}
		.skin-classical .main-classical .panel-cut {
		    margin: 10px;
		    border-color: #e7e7eb;
		    border: 1px solid #c7c7c7;
    		border-radius: 0;
    		background-color: #fff;
    		box-shadow: 0 1px 1px rgba(0,0,0,.05);
		}
		.panel-cut>.panel-body {
		    padding: 15px 30px;
		}
		.panel-cut .cut-header {
		    margin-top: 15px;
		    margin-bottom: 30px;
		    overflow: hidden;
		}
		.form-control {
			margin-top: 0px;
		}
		.cut-list .item {
		    width: 210px;
		    height: 220px;
		    border: 1px solid #e7e7eb;
		    background-color: #f4f4f4;
		    position: relative;
		    margin: 0 22px 22px 0;
		    float: left;
		    cursor: pointer;
		}
		.cut-list .mask{
			display:block;
		}
		.cut-list .content {
		    text-align: center;
		}
		.cut-list .content .icon-account {
		    width: 110px;
		    height: 110px;
		    margin: 25px 0 15px 0;
		}
		.cut-list .content .type {
		    font-size: 12px;
		    color: #98999a;
		    margin-top: 5px;
		}
		/*应用*/
		.cut-list .content .icon {
		    width: 90px;
		    height: 90px;
		    margin: 30px 0 10px 0;
		}
		.cut-list .version {
		    background-color: #fff;
		    position: absolute;
		    bottom: 0;
		    left: 0;
		    width: 100%;
		    text-align: center;
		    overflow: hidden;
		    color: #98999a;
		    padding: 5px 0;
		}
		.cut-list .version .name {
		    display: inline-block;
		    width: 34px;
		    height: 32px;
		    float: left;
		    padding: 0 10px;
		    border-right: 1px solid #e7e7eb;
		    line-height: 16px;
		}
		.cut-list .version .version-detail {
		    padding-left: 35px;
		    line-height: 32px;
		}
		.cut-select{
			display: none;
		}
	</style>

	<script type="text/javascript">
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	window.sysinfo = {
		<?php  if(!empty($_W['uniacid'])) { ?>'uniacid': '<?php  echo $_W['uniacid'];?>',<?php  } ?>
		<?php  if(!empty($_W['acid'])) { ?>'acid': '<?php  echo $_W['acid'];?>',<?php  } ?>
		<?php  if(!empty($_W['openid'])) { ?>'openid': '<?php  echo $_W['openid'];?>',<?php  } ?>
		<?php  if(!empty($_W['uid'])) { ?>'uid': '<?php  echo $_W['uid'];?>',<?php  } ?>
		'isfounder': <?php  if(!empty($_W['isfounder'])) { ?>1<?php  } else { ?>0<?php  } ?>,
		'family': '<?php echo IMS_FAMILY;?>',
		'siteroot': '<?php  echo $_W['siteroot'];?>',
		'siteurl': '<?php  echo $_W['siteurl'];?>',
		'attachurl': '<?php  echo $_W['attachurl'];?>',
		'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
		'attachurl_remote': '<?php  echo $_W['attachurl_remote'];?>',
		'module' : {'url' : '<?php  if(defined('MODULE_URL')) { ?><?php echo MODULE_URL;?><?php  } ?>', 'name' : '<?php  if(defined('IN_MODULE')) { ?><?php echo IN_MODULE;?><?php  } ?>'},
		'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'},
		'account' : <?php  echo json_encode($_W['account'])?>,
		'server' : {'php' : '<?php  echo phpversion()?>'},
	};
	</script>
	<script>var require = { urlArgs: 'v=20170915' };</script>
	<script type="text/javascript" src="./resource/js/lib/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="./resource/js/lib/bootstrap.min.js"></script>
	<script type="text/javascript" src="./resource/js/app/util.js?v=20170915"></script>
	<script type="text/javascript" src="./resource/js/app/common.min.js?v=20171122"></script>
	


	<script type="text/javascript" src="./resource/js/require.js?v=20170916"></script>
	
</head>
<body>
	<div class="loader" style="display:none">
		<div class="la-ball-clip-rotate">
			<div></div>
		</div>
	</div>