<?php defined('IN_IA') or exit('Access Denied');?><?php  defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $this->set['texts']['rank']?></title>
<style type="text/css">
    body {margin:0px; background:#eee; font-family:'微软雅黑'; -moz-appearance:none;}
    .credit_list {height:60px; background:#fff; padding:7px 0;margin-top:5px;}
    
   /* .credit_list .info {height:40px; width:70%; float:left;  font-size:16px; color:#666; line-height:20px; text-align:left;}*/
    .credit_list .info span {font-size:14px; color:#999;}
    .credit_list .num {height:40px; border-left:1px solid #eaeaea; width:20%;line-height:40px; float:right; text-align:right; font-size:16px; color:#666;}
    .credit_list .num span {font-size:14px; color:#999;}
    .credit_tab {height:30px; margin:5px; border:1px solid #00c1ff; border-radius:5px; overflow:hidden;font-size:13px;background:#fff;padding-right: -2px;}
    .credit_nav {height:30px; width:50%;  background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
    .credit_navon {color:#fff; background:#00c1ff;}
    .credit_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    #credit_loading { padding:10px;color:#666;text-align: center;}

</style>
<div class="page_topbar">
    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
    <div class="title"><?php  echo $this->set['texts']['rank']?></div>
</div>
<div class="credit_list" style="background:#009BF8 ;color: #fff;display: inline-block;width: 100%;text-indent: 18px;height: 60px;line-height: 40px;">您当前等级：<span style="font-size: 20px;"><?php  if($list['agentlevel']==0) { ?>普通等级<?php  } else { ?><?php  echo $list['levelname'];?><?php  } ?></span></div>
<div id='container'></div>
<!-- <script id='tpl_rank' type='text/html'> -->
    <!-- <%each list1 as log%> -->
    <div class="credit_list" style="height: auto;width:96%;margin:16px auto;border-radius: 8px;">

        <div class="info">
            <span>
                <span style="text-indent: 18px;width: 100%;background: #009BF8;height: 50px;line-height:50px;border-top-left-radius:8px;border-top-right-radius:8px;display: inline-block;margin-top:-10px ;position: relative;">
                    <span class='spanId' style="position: absolute; left: -13px;top: -3.5px;width: 30px;height: 30px;">
                        
                    </span>
                    <span style="font-size: 20px;color:#fff;position: absolute;left:20px;"><?php echo empty($set['levelname'])?'普通等级':$set['levelname']?></span>       
                    <span style="position:absolute;right:10px;font-size: 14px;color:#fff;">
                            <?php  if($set['become']==0) { ?>无条件              <?php  } else if($set['become']==1) { ?>申请              <?php  } else if($set['become']==2) { ?>消费达到<?php  echo $set['become_ordercount'];?>次              <?php  } else if($set['become']==3) { ?>消费达到<?php  echo $set['become_moneycount'];?>元              <?php  } else if($set['become']==4) { ?>购买商品：<br />
              <?php  if(!empty($goods)) { ?>[<?php  echo $goods['id'];?>]<?php  echo $goods['title'];?><?php  } ?>              <?php  } ?>

                    </span>
                    <br/>
                
                </span>
                
                <span style="margin:5px 0 0 18px;display:inline-block; width: 90%;border-bottom: 1px solid #ddd;"><?php  if($set['extract_commission'] == 1) { ?>佣金提现,<?php  } ?>              <?php  if($set['spread_qrcode'] == 1) { ?>推广二维码,<?php  } ?>              <?php  if($set['select_goods'] == 1) { ?>自选商品,<?php  } ?>              <?php  if($set['closemyshop'] != 1) { ?>我的小店,<?php  } ?>              <?php  if($set['openorderdetail'] == 1) { ?>订单商品详情,<?php  } ?>              <?php  if($set['openorderbuyer'] == 1) { ?>订单购买者详情,<?php  } ?>              <?php  if($set['remind_message'] == 1) { ?>消息提醒,<?php  } ?>              <?php  if($set['liuyan'] == 1) { ?>开启留言<?php  } ?><?php  if($set['rank'] == 1) { ?>,分销等级<?php  } ?>
                        <div style="height:20px;"></div></span>
                <span style="width:90%;display: inline-block;margin: 10px 0 5px 18px;"><?php   echo $row['authority_item'];?></span>          
            </span>
        </div>
    </div>


    <?php  if(is_array($list1)) { foreach($list1 as $row) { ?>
    <div class="credit_list" style="height: auto;width:96%;margin:16px auto;border-radius: 8px;">

        <div class="info">
            <span>
            	<span style="text-indent: 18px;width: 100%;background: #009BF8;height: 50px;line-height:50px;border-top-left-radius:8px;border-top-right-radius:8px;display: inline-block;margin-top:-10px ;position: relative;">
            		<span class='spanId' style="position: absolute; left: -13px;top: -3.5px;width: 30px;height: 30px;">
            			
            		</span>
            		<span style="font-size: 20px;color:#fff;position: absolute;left:20px;"><?php  echo $row['levelname'];?></span>       
            		<span style="position:absolute;right:10px;font-size: 14px;color:#fff;">
                            <?php  if($row['tiaojian']==1) { ?>
                	(满足任意一个条件)
                            <?php  } else { ?>
                    (满足所有条件)
                            <?php  } ?>
                    </span>
                    <br/>
        		
            	</span>
                
                <span style="margin:5px 0 0 18px;display:inline-block; width: 90%;border-bottom: 1px solid #ddd;"><?php  $updatelevel =  json_decode($row['updatelevel'],true); ?>
                 
                     
                        <?php  if(!empty($updatelevel['0'])) { ?>
                        <span>
                            分销订单金额满<?php  echo $updatelevel['0'];?>元 &nbsp;&nbsp;
                        </span>
                        <br>
                        <?php  } ?>
                        <?php  if(!empty($updatelevel['1'])) { ?>
                        <span>
                            一级分销订单金额满<?php  echo $updatelevel['1'];?>元 &nbsp;&nbsp;
                        </span>
                        <br>
                        <?php  } ?>
                         
                        <?php  if(!empty($updatelevel['2'])) { ?>
                        <span>
                            分销订单数量满<?php  echo $updatelevel['2'];?>个 &nbsp;&nbsp;
                        </span>
                        <br>
                        <?php  } ?>
                        
                        <?php  if(!empty($updatelevel['3'])) { ?>
                        <span>
                            一级分销订单数量满<?php  echo $updatelevel['3'];?>个 &nbsp;&nbsp;
                        </span>
                        <br>
                        <?php  } ?>
                        
                        <?php  if(!empty($updatelevel['4'])) { ?>
                        <span>
                            自购订单金额满<?php  echo $updatelevel['4'];?>元 &nbsp;&nbsp;
                        </span>
                        <br>
                        <?php  } ?>
                  
                        <?php  if(!empty($updatelevel['5'])) { ?>
                        <span>
                            下级总人数满<?php  echo $updatelevel['5'];?>个 （分销商+非分销商)&nbsp;&nbsp;
                        </span>
                        <br>
                        <?php  } ?>

                      
                        <?php  if(!empty($updatelevel['6'])) { ?>
                        <span>
                            一级下级人数满<?php  echo $updatelevel['6'];?>个（分销商+非分销商）&nbsp;&nbsp;
                        </span>
                        <br>
                        <?php  } ?>
                  
                        <?php  if(!empty($updatelevel['7'])) { ?>
                        <span>
                            团队总人数满<?php  echo $updatelevel['7'];?>个（分销商）&nbsp;&nbsp;
                        </span>
                        <br>
                        <?php  } ?>
                      
                        <?php  if(!empty($updatelevel['8'])) { ?>
                        <span>
                           一级团队人数满<?php  echo $updatelevel['8'];?>个（分销商 ）&nbsp;&nbsp;
                        </span>
                        <br>
                        <?php  } ?>
                     
                        <?php  if(!empty($updatelevel['9'])) { ?>
                        <span>
                           已提现佣金总金额满<?php  echo $updatelevel['9'];?>元&nbsp;&nbsp;
                        </span>
                        <br>
                        <?php  } ?>
                   
                        <?php  if(!empty($updatelevel['10'])) { ?>
                        <span>
                            积分金额满<?php  echo $updatelevel['10'];?>个 &nbsp;&nbsp;
                        </span>
                        <br>
                        <?php  } ?>
                      
                        <?php  if(!empty($updatelevel['11'])) { ?>
                        <span>
                            指定等级:
                            <?php  if(is_array($show)) { foreach($show as $r) { ?>
                                 <?php  if($updatelevel['11']==$r['id'] ) { ?>
                                      <?php  echo $r['levelname'];?>
                                 <?php  } ?>
                            <?php  } } ?>
                            ,一级下级人数满<?php  echo $updatelevel['12'];?>人
                             
                        </span>
                        <?php  } ?>
                        <div style="height:20px;"></div>
                    </span>
                <span style="width:90%;display: inline-block;margin: 10px 0 5px 18px;"><?php   echo $row['authority_item'];?></span>          
            </span>
        </div>
    </div>
    <?php  } } ?>
    <!-- <%/each%> -->
<!-- </script> -->
<script id='tpl_empty' type='text/html'>
    <div class="credit_no"><i class="fa fa-file-text-o" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">暂时没有任何记录~</span></div>
</script>

<script language="javascript">
    var htmlimg='';
	var img='<img src="../addons/sz_yi/plugin/commission/template/mobile/style1/static/images/GradeIco.png" width="100%" height="100%" />';	 	
 		htmlimg+=img;
 		$('.spanId').eq(0).append(htmlimg)
 		$('.spanId').eq(1).append(htmlimg)
 		$('.spanId').eq(2).append(htmlimg)
	 		

	 		

		 	
		 
		
		
		 
		

	
	 
    require(['tpl', 'core'], function (tpl, core) {
        core.json('commission/rank', function(json){
            $('#container').html(  tpl('tpl_rank',json.result));
            var list1 = json.result.order;
            alert(list1);
        },true);
    })
</script>
<?php   $show_footer=true?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
