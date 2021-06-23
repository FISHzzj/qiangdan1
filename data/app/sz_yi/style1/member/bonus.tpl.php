<?php defined('IN_IA') or exit('Access Denied');?>﻿<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<!-- center -->
<title>奖金明细</title>

<style type="text/css">
	html,body{
		width:100%;
		height: 100%;
		margin: 0;
		padding: 0;
	}
	.headermes{
		width: 100%;
		height: 260px;
		background: -webkit-linear-gradient(top,#10BDFF,#15ADE8);
		padding-top: 25px;
		color: #fff;
	}
	
	.headermes .list1{
		width: 100px;
		height: 100px;
		border-radius:50%;
		background: #ccc;
		margin: auto;
	}
	.headermes .list2 div{
		padding-top:10px ;
		width: 100%;
		text-align: center;
	}
	.headermes .list3{
		display: flex;
		display: -webkit-flex;
		justify-content: center;
		margin-top: 18px;
	}
	.headermes .list3 li{
		list-style: none;
		width: 32%;
		border-right:1px solid #fff ;
	}
	.headermes .list3 li:nth-child(3){
		border-right:0 ;
	}
	.headermes .list3 li span{
		display: block;
		text-align: center;
	}
	.notice{
		width: 100%;
		height: 35px;
		overflow: hidden;
		line-height: 35px;
		background: #fff;

	}
	.notice .slider_notice{
		width: 200%;
		height: 16px;
		font-size: 16px;
		text-align: right;
		animation: myanim 4s linear infinite;
		-webkit-animation:myanim 4s linear infinite ;
		color: red;
		
	}
	.withdraw_type .title , .withdraw_cash .title{
		line-height: 30px;
		color: #999;
		padding-left: 10px;
		
	}
	.withdraw_cash .text{        height: 55px;
		display: -webkit-flex;        display: flex;
		padding-left: 10px;        align-items: center;
		background: #fff;		-webkit-align-items: center;
	}
	.withdraw_cash .text input{
		width: 60%;       
		height: 35px;
	}
	.withdraw_type_list div{       display: flex;       display:-webkit-flex;       align-items: center;       -webkit-align-items: center;
	   width: 94%;
	   height: 58px;
	   line-height: 58px;
	   padding-left: 5px;
	   margin: auto;
	}
	#withdraw_btn{
		width: 135px;
		height: 35px;
		margin:30px auto;
		text-align: center;
		line-height: 35px;
		border-radius:16px ;
		background: #FF3300;
		color:#fff; 
		font-size: 20px;
	}
	@-webkit-keyframes myanim{
		0%{
			transform:translateX(0) ;
			-webkit-transform:translateX(0) ;
		}
		100%{
			transform:translateX(-100%) ;
			-webkit-transform:translateX(-100%) ;
		}
	}
	@keyframes myanim{
		0%{
			transform:translateX(0) ;
		}
		100%{
			transform:translateX(-100%) ;
		}
	}
	.withdraw_type_list {
		background: #fff;
	}
	
	@font-face {
		font-family: 'iconfont';
		src: url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfontboli.eot');
		src: url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfontboli.eot?#iefix') format('embedded-opentype'), url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfontboli.woff') format('woff'), url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfontboli.ttf') format('truetype'), url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfontboli.svg#iconfont') format('svg');
	}
	
	.iconfont {
		font-family: "iconfont" !important;
		font-size: 30px;
		font-style: normal;
		-webkit-font-smoothing: antialiased;
		-webkit-text-stroke-width: 0.2px;
		-moz-osx-font-smoothing: grayscale;
		z-index: 55;
		color: green;
	}
	
	.iconspan {
		display: inline-block;
		width: 30px;
		height: 30px;
		overflow: hidden;
		line-height: 30px;
		text-align: center;
		margin-right: 25px;
	}
	
	.inputbtn {
		width: 27px;
		height: 27px;
		display: flex;
		display: -webkit-flex;
		justify-content: center;
		-webkit-justify-content: center;
		align-items: center;
		-webkit-align-items: center;
		margin-left: 51%!important;
		border: 1px solid #ccc;
		border-radius: 50%;
		outline:none;
		text-align: center;
		line-height: 30px;
		padding: 0;
		overflow: visible;
		background: #fff;
	}
	
	.check:before {
		content: '\e600';
	}

</style>
<body>
    <div class="headermes">
		<div class="list1"><img src=""/></div>
		<div class="list2">
			<div class="list2_anme">我就笑笑</div>
			<div class="list2_numder"><span>用户名：</span><span>1882562244</span></div>
		</div>
		<div class="list3">
			<li>
				 <span>10000</span>
				 <span>累积奖金</span>
			</li>
			<li>
				 <span>20000</span>
				 <span>可提现奖金</span>
			</li>
			<li>
				 <span>8000</span>
				 <span>已申请奖金</span>
			</li>
		</div>
	</div>
	<div class="notice">
		<div class="slider_notice">
			公告  公告  公告  公告 公告  公告 公告 公告 公告 公告 公告 公告 公告 公告 公告 公告
		</div>			
	</div>
	<div class="withdraw_cash">
		<div class='title'>请输入提现金额</div>
		<div class="text"><span style="font-size: 20px;font-weight: 500;">提现金额：</span><span style="font-size: 20px;margin-left: 15px;">1000</span></div>
	</div>
	<div class="withdraw_type">
		<div class='title'>请输入提现方式</div>
		<div class="withdraw_type_list">
			<div class="weixin" style=" border-bottom: 1px solid #ccc;box-shadow: 0px 1.5px 0px #EEEEEE;">	
				<span class='iconspan' ><i class='iconfont' style="color: #08D618;">&#x3434;</i></span><span style="font-size: 18px;font-weight: 600;">微信</span>                 
				<input class='inputbtn iconfont  check' type="radio" name="aaa" id="aaa" value="" style="margin-left:56.2%!important;border: 0;color: #FF3300;"/>
			</div>
			<div class="card">               
				<span class='iconspan' ><i class='iconfont' style="color:#FF8C08 ;">&#xe609;</i></span><span style="font-size: 18px;font-weight: 600;">银行卡</span>               
				<input   class='inputbtn  iconfont' type="radio" name="aaa" id="aaa" value="" style="color: #FF3300;" />
			</div>
		</div>
	</div>
	
    <div id="withdraw_btn">确定提现</div>		 		 
		 
		 
<script type="text/javascript">
		$('.inputbtn').click(function(){
			$('.inputbtn').removeClass('check').css('border','1px solid #ccc');
		 	$('.inputbtn:checked').addClass('check').css('border','0px');		 	
		})
</script>
  
</body>
<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>