<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?> 
<title>奖金提现</title>
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

	.headermes .list1 img{
		border: 2px #fff solid; 
		display: block;
		width:100px; 
		height:100px; 
		border-radius:50%;
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
		animation: myanim 14s linear infinite;
		-webkit-animation:myanim 14s linear infinite ;
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
		width: 100%;       
		height: 35px;
		border: 1px solid #e6e6e6;
	}
	.withdraw_type_list div{       display: flex;       display:-webkit-flex;       align-items: center;       -webkit-align-items: center;
	   width: 94%;
	   height: 58px;
	   line-height: 58px;
	   padding-left: 5px;
	   margin: auto;
	}
	#withdraw_btn{
		/*width: 135px;*/
		/*height: 35px;*/
		/*margin:30px auto;*/
		text-align: center;
		/*line-height: 35px;*/
		/*border-radius:16px ;*/
		/*background: #FF3300;*/
		/*color:#fff; */
		/*font-size: 20px;*/
	}
	#withdraw_btn input{
		width: 135px;
		height: 35px;
		margin:30px auto;
		text-align: center;
		line-height: 35px;
		border-radius:16px ;
		background: #e31939;
		color:#fff; 
		font-size: 20px;
		border:0px;
	}
	.#withdraw_btn input:hover{
		background: #fd5771;
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
	
	.iconfont.check:before {
		font-family: "iconfont" !important;
		 font-size: 30px; */
		font-style: normal;
		-webkit-font-smoothing: antialiased;
		-webkit-text-stroke-width: 0.2px;
		-moz-osx-font-smoothing: grayscale;
		z-index: 55;
		/* color: green; */
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
		margin-left: 54.5%!important;
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
<div id='container' class="rightlist"></div>
<script id='tpl_main' type='text/html'>
	<div class="page_topbar">
	        <div class="title">奖金提现</div>
	</div>
    <div class="pc-cen">
        <div class="topbar">
            <div class="user_face"><img src="<%member.avatar%>"></div>
            <div class="user_info">
                <div class="user_name" <%if set.levelurl!=''%>onclick='location.href="<%set.levelurl%>"'<%/if%>><%member.nickname%> </div>
                <div class="user-dj">
                    用户名：<?php  echo $member['realname'];?>
                </div>
            </div>
        </div> 
        <div class="top-fx">
            <div class="top_1">
                <div class="text">累积奖金：<?php echo empty($total)?'0.00':$total?>元</br>
                可提现奖金：<?php echo empty($able_money)?'0.00':$able_money?>元</br>
                已申请奖金：<?php echo empty($keep_apply)?'0.00':$keep_apply?>元
                </div>
            </div>
        </div>
    </div>
    <form action="" method="post">
    <div class="notice">
		<div class="slider_notice">
			<span style="margin-right:50px;">1、提现额度：<?php  echo $set['withdrawal']['lines'];?>元</span>
			<span style="margin-right:50px;">2、最高提现金额：<?php  echo $set['withdrawal']['max'];?>元</span>
			<span style="margin-right:50px;">3、提现手续费：<?php  echo $set['withdrawal']['rate'];?>%</span>
		</div>			
	</div>
        <div class="withdraw_cash" style="margin-top:45px;margin-left:30px;">
            <div class='title'>请输入提现金额：</div>
            <div class="text"><span style="font-size: 20px;font-weight: 500;">提现金额：</span><span style="font-size: 20px;margin-left: 15px;"><input type="text" name="apply_money" value="" style="height:30px;"></span></div>
        </div>
    <div class="withdraw_type">
    <div class='title' style="margin-left:30px;">请输入提现方式：</div>
        <div class="withdraw_type_list">
			<div class="weixin" style=" border-bottom: 1px solid #ccc;box-shadow: 0px 1.5px 0px #EEEEEE;">	
				<span class='iconspan' ><i class='iconfont' style="color: #08D618;">&#x3434;</i></span><span style="font-size: 18px;font-weight: 600;">微信</span>
				<input class='inputbtn iconfont check' type="radio" name="applytype" id="aaa" value="2" checked="checked" style="margin-left:56.2%!important;border: 0;color: #FF3300;"/>
			</div>
			<div class="card">
				<span class='iconspan' ><i class='iconfont' style="color:#FF8C08 ;">&#xe609;</i></span><span style="font-size: 18px;font-weight: 600;">银行卡</span>               
				<input   class='inputbtn  iconfont' type="radio" name="applytype" id="aaa" value="3" style="color: #FF3300;" />
			</div>
		</div>
    </div>
    
    <div id="withdraw_btn"><input type="submit" name="submit" value="确定提现"></div>
    </form>
</script>
 
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        
        
        core.pjson('commission',{},function(json){
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
<script type="text/javascript">
		$('.inputbtn').click(function(){
			$('.inputbtn').removeClass('check').css('border','1px solid #ccc');
		 	$('.inputbtn:checked').addClass('check').css('border','0px');		 	
		})
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>
