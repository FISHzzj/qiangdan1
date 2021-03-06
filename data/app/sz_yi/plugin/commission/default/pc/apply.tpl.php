<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?>
<title>申请<?php  echo $this->set['texts']['withdraw']?></title>
<style type="text/css">
body {margin:0px; background:#efefef; -moz-appearance:none;}
input {-webkit-appearance:none; outline:none;}
.balance_img {height:80px; width:80px; margin:70px auto 0px; background:#ffb400; border-radius:40px; color:#fff; font-size:70px; text-align:center; line-height:90px;}
.balance_text {line-height: 12px;font-size: 12px;color: #a9a9a9;}
.balance_num {font-weight: bold;height:40px; width:100%;text-align:left; line-height:40px; font-size:40px; color:#ff8208;margin: 20px 0 6px;}
.balance_sub3{display: inline-block;font-size:12px;line-height: 14px;border: 1px #ABABAB solid;color: #636363;padding: 6px 8px;border-radius: 4px;margin-top: -4px;}
.balance_sub3:hover{color: #636363}
.balance_sub1 {height:36px; width:140px; margin:14px 3% 0px 0; background:#ff6600; border-radius:4px; text-align:center; font-size:14px; line-height:36px; color:#fff;float: left;cursor:pointer;}
.balance_sub2 {height:36px; width:140px; margin:14px 3% 0px 0; background:#31cd00; border-radius:4px; text-align:center; font-size:14px; line-height:36px; color:#fff;float: left;cursor:pointer;}
/*.balance_sub3 {border-top: 1px dashed #CCC;height:44px; width:94%;text-align:center; font-size:14px; line-height:44px; color:#4d4d4d;font-weight: normal;}*/
.disabled { background:#ccc;}
.tx-number{padding: 30px;float: left;width: 300px;background: #fcfbf7;/*border-right: 1px #eee solid;*/}
.tx-but{ float: left;padding:20px 30px;width: 600px}
.tx-but p{line-height: 40px;line-height: 40px;font-size: 14px;color: #666666;}
</style>
<div id='container' class="rightlist"></div>

<script id='tpl_main' type='text/html'>
    <div class="tx-number">
      <!--<div class="balance_img"><i class="fa fa-cny"></i></div>-->
      <div class="balance_text">我的<?php  echo $this->set['texts']['commission_ok']?></div>
      <div class="balance_num"><%member.commission_ok%></div>
      <a class="balance_sub3" onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/log')?>'"><?php  echo $this->set['texts']['withdraw']?>记录</a>
    </div>
    <div class="tx-but">
      <p>请选择提现方式</p>
      <?php  if(empty($this->set['closetocredit'])) { ?>
      <div class="balance_sub balance_sub1 <%if !cansettle%>disabled<%/if%>" data-type="0"><?php  echo $this->set['texts']['widthdraw']?>到账户余额</div>
      <?php  } ?>
      
      <div class="balance_sub balance_sub2 <%if !cansettle%>disabled<%/if%>"  data-type="1"><?php  echo $this->set['texts']['withdraw']?>到微信钱包</div>
    </div>
    
</script>
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        
        core.pjson('commission/apply',{},function(json){
           var result = json.result;
           $('#container').html(  tpl('tpl_main',json.result) );
           if(result.noinfo){
                core.message('请补充您的资料后才能申请提现!',result.infourl,'warning');
                return;
            }
            
           if(json.result.cansettle){
               $('.balance_sub').click(function(){
                   if($('.balance_sub').attr('saving')=='1'){
                       return;
                   }
                   var type= $(this).data('type');
                       
                   core.tip.confirm('确认要申请<?php  echo $this->set['texts']['widthdraw']?>? <?php  echo $this->set['texts']['withdraw']?>申请通过之后给您打款后会通知您到的微信.',function(){
                       
                       $('.balance_sub').attr('saving',1).html('正在处理中...');
                        core.pjson('commission/apply',{type:type},function(pjson){
                              if(pjson.status=='1'){
                                   core.tip.show( pjson.result );
                                   location.href = core.getUrl('plugin/commission/withdraw');
                              }
                               
                       },true,true);
                   });
               })
           }
        },true);
        
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>
