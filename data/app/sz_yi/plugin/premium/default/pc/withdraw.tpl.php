<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $this->set['texts']['center']?></title>
<style type="text/css">
    body {margin:0px; background:#eee; font-family:'微软雅黑'; }
    a {text-decoration:none;} 
.gold_top {height:168px; width:100%; background:#fcfbf7; padding:30px 3% 0px;border-top: 3px solid #ff7700;border-bottom: 1px #eee solid;}
.gold_top .title {    line-height: 12px;font-size: 12px;color: #a9a9a9;}
.gold_top .num {width: 100%;overflow: hidden;}
.gold_top .num em{font-size: 40px;line-height: 66px;color: #ff8208;float: left;font-style: normal;}
.gold_top .num a { width:auto; /*height:40px;background:url(../addons/sz_yi/plugin/commission/template/mobile/default/static/images/gold_ico1.png) right 16px no-repeat;padding-right:26px;line-height:50px;  */padding: 30px 10px 0 10px;
    display: block;float:left;  color:#0ae; font-size:14px;}
.gold_top .num2 {    border-top: 1px #eeeeee solid;height:40px; width:100%; color:#666; line-height:40px; font-size:14px;}
.gold_num {height:auto; padding:10px; background:#fff; border-top:1px solid #eaeaea; font-size:14px; color:#a9a9a9;}
.gold_num .nav {height:70px; width:33.3333%;    box-sizing: border-box;padding-left:5%; float:left; border-right:1px solid #eaeaea;}
.gold_num .navbor {border-right: none}
.gold_num .nav .title {height:30px; width:100%; color:#333; font-size:14px; line-height:30px;}
.gold_num .nav .num {height:20px; width:100%; color:#ff8208; font-size:20px; line-height:16px;}
.gold_num .nav .tip {height:20px; width:90%; color:#666; font-size:12px; line-height:20px; color:#999;}
.gold_sub {height: 28px;color: #fff;width: auto;background-color: #0ae;cursor: pointer;
font-size: 14px;line-height: 28px;margin: 20px 0 0 20px;padding: 0px 15px;float: left;border-radius: 5px;}
</style>
<div id='container' class="rightlist"></div>
 
<script id='tpl_main' type='text/html'>
    <div class="gold_top">
        <div class="title"><?php  echo $this->set['texts']['commission_ok']?>（元）</div>
        <div class="num">
            <em><%member.commission_ok%></em>
            <!-- <div class="gold_sub" <%if !cansettle %>style='background:#ccc'<%/if%>>我要提现</div>
            <a href="<?php  echo $this->createPluginMobileUrl('commission/log')?>" >查看明细</a> -->
        </div>
        <div class="num2"><?php  echo $this->set['texts']['commission_pay']?>：<%member.commission_pay%></div>
    </div>
    <div class="gold_num" style="border:0px;height:90px">
        <div class="nav"><div class="title"><?php  echo $this->set['texts']['commission_total']?></div><div class="num"><%member.commission_total%></div><div class='tip'>所有<?php  echo $this->set['texts']['commission']?></div></div>
        <div class="nav" ><div class="title">已获得<?php  echo $this->set['texts']['commission']?></div><div class="num"><%member.commission_pay%></div><div class='tip'>已获得佣金</div></div>
        <div class="nav navbor"><div class="title"><?php  echo $this->set['texts']['commission_check']?></div><div class="num"><%member.commission_ok%></div><div class='tip'>还没发到余额的奖金</div></div>
        <!--<%if set.settledays>0%><div class="nav navbor"><div class="title"><?php  echo $this->set['texts']['commission_lock']?></div><div class="num"><%member.commission_lock%></div><div class='tip'>结算期内的<?php  echo $this->set['texts']['commission']?></div></div><%/if%>-->
    </div>
    <!--<div class="gold_num" style="border:0px;height:90px"></div>-->
    <div class="gold_num">买家确认收货后，立即获得<?php  echo $this->set['texts']['commission1']?>。<%if set.settledays>0%>结算期（<%set.settledays%>天）后，<?php  echo $this->set['texts']['commission']?>可<?php  echo $this->set['texts']['withdraw']?>。结算期内，买家退货，<?php  echo $this->set['texts']['commission']?>将自动扣除。<%/if%>
        <%if set.withdraw>0%><br/><br/>注意： 可用<?php  echo $this->set['texts']['commission']?>满 <span style='color:red'><%set.withdraw%></span> 元后才能申请<?php  echo $this->set['texts']['withdraw']?><br/><%/if%>
        <%if set.consume_withdraw>0%><br/><br/>注意： 自己购买的完成订单，共计 <span style='color:red'><%set.consume_withdraw%></span> 元后才能申请<?php  echo $this->set['texts']['withdraw']?><br/><%/if%>
    </div>
         
</div>

</script>
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        
        core.pjson('premium/withdraw',{},function(json){
           $('#container').html(  tpl('tpl_main',json.result) );
             
           if(json.result.cansettle){
               $('.gold_sub').click(function(){
                   location.href="<?php  echo $this->createPluginMobileUrl('commission/apply')?>";
               })
           }
        },true);
        
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>
  
