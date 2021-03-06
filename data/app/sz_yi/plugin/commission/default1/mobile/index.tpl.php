<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $this->set['texts']['center']?></title>
<style type="text/css">
    body {margin:0px; background:#eee; font-family:'微软雅黑'; }
    a {text-decoration:none;}
    .topbar {height:40px; padding:10px; background:#fff;}
    .topbar .user_face {height:40px; width:40px; background:#ccc; float:left;}
    .topbar .user_face img {height:100%; width:100%;}
    .topbar .user_info {height:40px; width:auto; float:left; margin-left:12px;}
    .topbar .user_info .user_name {height:24px; width:100%; font-size:16px; line-height:24px; color:#666;}
       .topbar .user_info .user_name span { font-size:14px; color:#ff6600}
    .topbar .user_info .user_date {height:14px; width:100%; font-size:14px; line-height:14px; color:#999;}

    .top {height:180px;padding:5px; background:#cc3431;}
    .top .top_1 {height:114px; width:100%;}
    .top .top_1 .text {height:114px; width:auto; float:left; color:#fff; line-height:50px; font-size:14px; color:#fff;}
    .top .top_1 .ico {height:40px; width:30px; background:url(../addons/sz_yi/plugin/commission/template/mobile/default/static/images/gold_ico2.png) 0px 10px no-repeat; margin-bottom:74px; float:right;}
    .topbonus {height:40px;padding:5px; background:#cc3431;}
    .topbonus .top_1 {height:40px; width:100%;}
    .topbonus .top_1 .text {height:40px; width:auto; float:left; color:#fff; line-height:20px; font-size:14px; color:#fff;}
    .topbonus .top_1 .ico {height:40px; width:30px; background:url(../addons/sz_yi/plugin/commission/template/mobile/default/static/images/gold_ico2.png) 0px 10px no-repeat; margin-bottom:74px; float:right;}
    .top .top_2 {height:66px; width:100%; font-size:40px; line-height:66px; color:#fff;}
    .top .top_2 span {height:32px; color:#fff; width:auto; border:1px solid #fff; font-size:14px; line-height:32px; margin-top:17px; padding:0px 15px;  float:right; border-radius:5px;}
    .top .top_2 .disabled { color:#999;border:1px solid #999;}
    .menu {overflow:hidden; background:#fff;}
    .menu .nav { width:33%; float:left;padding-top:10px;padding-bottom:10px; text-align: center;}
    
    .menu .nav .title {height:24px; width:100%; text-align:center; font-size:14px; color:#666;}
    .menu .nav .con {height:20px; width:100%; text-align:center; font-size:12px; color:#999;}
    .menu .nav .con span {color:#f90;}
    .menu .nav1 {border-bottom:1px solid #f1f1f1; border-right:1px solid #f1f1f1;   }
    .menu .nav2 {border-bottom:1px solid #f1f1f1; }
 
</style>
<div id='container'></div>
<script id='tpl_main' type='text/html'>
    <div class="topbar">
        <div class="user_face"><img src="<%member.avatar%>"></div>
        <div class="user_info">
            <div class="user_name" <%if set.levelurl!=''%>onclick='location.href="<%set.levelurl%>"'<%/if%>><%member.nickname%> <span>[<%if level%><%level.levelname%><%else%>
                    <%if set.levelname!=''%><%set.levelname%><%else%>普通等级<%/if%>
                    <%/if%>] 
                   <%if set.levelurl!=''%><i class='fa fa-question-circle' ></i></span><%/if%></div>
            <div class="user_date">加入时间：<%member.agenttime%></div>
        </div>
    </div> 
    <div class="top">
        <div class="top_1">
            <div class="text">
            <?php  echo $this->set['texts']['commission_total']?>：<%member.commission_total%>元
		<br><?php  echo $this->set['texts']['commission_ok']?>（元）</div>
            <a href="<?php  echo $this->createPluginMobileUrl('commission/withdraw')?>"><div class="ico"></div></a>
        </div>
        <div class="top_2"><%member.commission_ok%><a <%if commission_ok<=0 || commission_ok< set.withdraw || commission_ok< set.consume_withdraw %>href="javascript:;"<%else%>href="<?php  echo $this->createPluginMobileUrl('commission/apply')?>"<%/if%> id='withdraw' ><span <%if commission_ok<=0 || commission_ok< set.withdraw%>class='disabled'<%/if%> ><?php  echo $this->set['texts']['withdraw']?></span></a></div>
		
	</div>

    <!--<div class="topbonus">
        <div class="top_1">
            <div class="text">
            <?php  echo $bonus_set['texts']['commission_total']?>：<?php  echo $member_bonus['commission_total'];?> 元<br><?php  echo $bonus_set['texts']['commission_ok']?>：<?php  echo $member_bonus['commission_ok'];?>
            </div>
            <a href="<?php  echo $this->createPluginMobileUrl('commission/withdraw')?>"><div class="ico"></div></a>
        </div>
    </div>-->
    
    <div class="menu">  
        <a href="<?php  echo $this->createPluginMobileUrl('commission/withdraw')?>"><div class="nav nav1"><i class="fa fa-cny fa-3x" style="color:#ff9901;"></i><div class="title"><?php  echo $this->set['texts']['commission1']?></div><div class="con"><span><%member.commission_total%></span> 元</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('commission/order')?>"><div class="nav nav1"><i class="fa fa-list fa-3x" style="color:#ffcb05;"></i><div class="title"><?php  echo $this->set['texts']['commission']?>明细</div><div class="con"><span><%member.ordercount0%></span> 个</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('commission/log')?>"><div class="nav nav2"><i class="fa fa-random  fa-3x" style="color:#ca81d1;"></i><div class="title"><?php  echo $this->set['texts']['commission_detail']?></div><div class="con">提现明细</div></div></a>        
		
        <a href="<?php  echo $this->createPluginMobileUrl('commission/team')?>"><div class="nav nav1"><i class="fa fa-user  fa-3x" style="color:#98cd37;"></i><div class="title"><?php  echo $this->set['texts']['myteam']?></div><div class="con"><span><%member.agentcount%></span> 人</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('commission/customer')?>"><div class="nav nav1"><i class="fa fa-users  fa-3x" style="color:#3c7bce "></i><div class="title"><?php  echo $this->set['texts']['mycustomer']?></div><div class="con"><span><%member.customercount%></span> 人</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('commission/shares')?>"><div class="nav nav2"><i class="fa fa-qrcode  fa-3x" style="color:#53bdec;"></i><div class="title">二维码</div><div class="con">推广二维码</div></div></a>

        <!--分红-->
        <?php  if($bonus==1) { ?>
        <a href="<?php  echo $this->createPluginMobileUrl('bonus/withdraw')?>"><div class="nav nav1"><i class="fa fa-cny fa-3x" style="color:#B22222;"></i><div class="title"><?php  echo $bonus_set['texts']['commission']?></div><div class="con"><span><?php  echo $member_bonus['commission_total'];?></span> 元</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('bonus/order')?>"><div class="nav nav1"><i class="fa fa-list fa-3x" style="color:#B22222;"></i><div class="title"><?php  echo $bonus_set['texts']['order']?></div><div class="con"><span><?php  echo $member_bonus['ordercount0'];?></span> 个</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('bonus/log')?>"><div class="nav nav2"><i class="fa fa-random  fa-3x" style="color:#B22222;"></i><div class="title"><?php  echo $bonus_set['texts']['commission_detail']?></div><div class="con"><?php  echo $bonus_set['texts']['commission']?>明细</div></div></a>        
        <a href="<?php  echo $this->createPluginMobileUrl('bonus/customer')?>"><div class="nav nav1"><i class="fa fa-users  fa-3x" style="color:#B22222;"></i><div class="title"><?php  echo $bonus_set['texts']['mycustomer']?></div><div class="con"><span><?php  echo $member_bonus['customercount'];?></span> 人</div></div></a> 
        <!--/分红-->
        <?php  } ?> 
        <%if set.closemyshop!='1'%>   
        <a href="<?php  echo $this->createPluginMobileUrl('commission/myshop/set')?>"><div class="nav nav1"><i class="fa fa-cog  fa-3x" style="color:#aadaf6;"></i><div class="title">小店设置</div><div class="con">设置我的小店</div></div></a>
        <%if set.openselect%>   
                <a href="<?php  echo $this->createPluginMobileUrl('commission/myshop/select')?>"><div class="nav nav1"><i class="fa fa-star  fa-3x" style="color:#f3d110"></i><div class="title">自选商品</div><div class="con">选择我喜欢的商品</div></div></a>
        <%/if%>

    
    <?php  if(p('article')) { ?>
       <!-- <a href="<?php  echo $this->createPluginMobileUrl('article/article')?>"><div class="nav nav1"><i class="fa fa-article  fa-3x" style="color:#68DCC1"></i><div class="title"><?php  echo $article_text;?></div><div class="con"><?php  echo $article_title;?></div></div></a>-->    
 
    <?php  } ?> 
   
        <a href="#"><div class="nav nav1"><i class="fa fa-cny fa-3x " style="color:#FF8282;"></i><div class="title">订单总计</div><div class="con"><span><%member.ordermoney0%></span> 元</div></div></a>

<%/if%>
        
        
    </div>
</script>
 
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        
        
        core.pjson('commission',{},function(json){
			console.log(json);
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
<?php  $show_footer=true;$footer_current ='commission'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
