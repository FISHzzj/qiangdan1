<?php defined('IN_IA') or exit('Access Denied');?>﻿<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<!-- center -->
<title>奖金提现</title>

<style type="text/css">
    body {margin:0px; background:#f2f2f2; padding:0px; -moz-appearance:none; font-family:微软雅黑;}
.content{margin-top: 0;}
.content_head{background: url(../addons/sz_yi/plugin/return/template/mobile/default/rebate/images/bg2.png) !important;}
.content_head_img>img{
    width: 60px;
    height: 60px;
    border-radius: 50%;
   border: 1px solid #fff;
}
.content_list_head>li>a>img{width: 45px;height: 45px;line-height: 40px;float: left;display: block;margin: 10px 0 0 0;border-radius: 50%;}
</style>
 <link rel="stylesheet" type="text/css" href="../addons/sz_yi/plugin/withdrawals/template/mobile/default/static/css/aui.2.0.css">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/plugin/withdrawals/template/mobile/default/static/css/deposit.css">
<body>
    <div class="page_topbar">
        <a href=" " class="back" onclick="history.back()">
        <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
      </a>
        <div class="title" style=" color: #282828;">奖金提现</div>
      <a href="#">
          <i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i>
      </a>
    </div>
<!--     <div id="header" >
        <div id="user-info">
           
        	<div class="left">
              
         	 	<img src="<?php  echo $member['avatar'];?>" />
         	</div>
         	<div class="title">
         	 	<div ><?php  echo $member['nickname'];?></div>
         	 	<div style="line-height:150%; color: #fff; font-size: 14px;">用户名：<?php  echo $member['realname'];?></div>
         	</div>
        </div>
        <div id="data">
        	<table>
	        	<tr>
	        		<th style="width:30%">
	        		    <div id="bottom"><?php echo empty($total)?'0.00':$total?></div>
	        		    <div id="top">累积奖金</div>
	        		</th>
	                <th style="width:40%">
	        		    <div id="bottom"><?php echo empty($already)?'0.00':$already?></div>	  
	        		    <div id="top">已提现</div>               
	                </th>
	                <th style="width:30%;border:0px;">
	        		    <div id="bottom"><?php echo empty($keep_apply)?'0.00':$keep_apply?></div>	
	        		    <div id="top">已申请提现</div>	                 
	                </th>
	            <tr>
           	</table>
        </div>
    </div>
    <div class="content">
    	<ul>
    		<li><a href="<?php  echo $this->createPluginMobileUrl('withdrawals/income_detail')?>">
    			<div class="icoImg">
    				<img src="/addons/sz_yi/template/mobile/style1/static/images/1.0.png"/>
    			</div>
    			<div class="text">
    				<p>奖金明细</p>
    				<p>￥<?php echo empty($total)?'0.00':$total?></p>
    			</div>
    		</a></li>

    		<span style="width: 1px;height: 30px;background: #ccc;"></span>
    		
    	
    		<li><a href="<?php  echo $this->createPluginMobileUrl('withdrawals/already_present')?>">
    			<div class="icoImg" style="background:#F78C18 ;">
    				<img src="/addons/sz_yi/template/mobile/style1/static/images/2.0.png"/>
    			</div>
    			<div class="text">
    				<p>已提现</p>
    				<p>￥<?php echo empty($already)?'0.00':$already?></p>
    			</div>
    		</a></li>

    		<li><a href="<?php  echo $this->createPluginMobileUrl('withdrawals/already_applied')?>">
    			<div class="icoImg" style="background:#10BDFF ;">
    				<img src="/addons/sz_yi/template/mobile/style1/static/images/3.0.png"/>
    			</div>
    			<div class="text">
    				<p>已申请</p>
    				<p>￥<?php echo empty($keep_apply)?'0.00':$keep_apply?></p>
    			</div>
    		</a></li>

    		<li><a href="<?php  echo $this->createPluginMobileUrl('withdrawals/bonus')?>">
    			<div class="icoImg" style="background:#10E7E7 ;">
    				<img src="/addons/sz_yi/template/mobile/style1/static/images/4.0.png"/>
    			</div>
    			<div class="text">
    				<p style="margin-top:15px;">奖金提现</p>
    				 <p>10000</p> -->
<!--     			</div>
    		</a></li>

            <?php  if($hascom) { ?>
			<li><a>
				<div class="icoImg" style="background:#EF3389 ;">
    				<img src="/addons/sz_yi/template/mobile/style1/static/images/5.0.png"/>
    			</div>
    			<div class="text">
    				<p>分销奖金</p>
    				<p>￥<?php echo empty($gettotal)?'0.00':$gettotal?></p>
    			</div>
			</a></li>
            <?php  } ?>

			<li><a>
				<div class="icoImg" style="background:#EF7BAD ;">
    				<img src="/addons/sz_yi/template/mobile/style1/static/images/6.0.png"/>
    			</div>
    			<div class="text">
    				<p>代理奖金</p>
    				<p>￥<?php echo empty($bonus)?'0.00':$bonus?></p>
    			</div>
			</a></li>

			<li><a>
				<div class="icoImg" style="background:#21CE21 ;">
    				<img src="/addons/sz_yi/template/mobile/style1/static/images/7.0.png"/>
    			</div>
    			<div class="text">
    				<p>区域奖金</p>
    				
    			</div>
			</a></li>

			<li><a>
				<div class="icoImg" style="background:#63C6EF ;">
    				<img src="/addons/sz_yi/template/mobile/style1/static/images/8.0.png"/>
    			</div>
    			<div class="text">
    				<p>全球奖金</p>
    				<p>￥<?php echo empty($all_bonus)?'0.00':$all_bonus?></p>
    			</div>
			</a></li>

            <?php  if($return['isqueue']==1) { ?>
			<li><a>
				<div class="icoImg" style="background:#EF2194 ;">
    				<img src="/addons/sz_yi/template/mobile/style1/static/images/10.0.png"/>
    			</div>
    			<div class="text">
    				<p>排位返奖金</p>
    				<p>￥<?php echo empty($r_each)?'0.00':$r_each?></p>
    			</div>
			</a></li>
            <?php  } ?>
            <?php  if($bonusplus1['start']==1) { ?>
			<li><a>
    			<div class="icoImg" style="background:#FF7B7B ;">
    				 <img src="/addons/sz_yi/template/mobile/style1/static/images/paiweiJJ.png"/>
    			</div>
    			<div class="text">
    				<p>静态返奖金</p>
    				<p>￥<?php echo empty($bonusplus)?'0.00':$bonusplus?></p>
    			</div>
    		 </a></li>
             <?php  } ?>
             <?php  if($premium1['level']==3) { ?>
             <li><a>
                <div class="icoImg" style="background:#FF7B7B ;">
                    <img src="/addons/sz_yi/template/mobile/style1/static/images/11.0.png"/>
                </div>
                <div class="text">
                    <p>新三级分销奖金</p>
                    <p>￥<?php echo empty($premium)?'0.00':$premium?></p>
                </div>
             </a></li>
             <?php  } ?>
             <?php  if($twoway['no']==1) { ?>
             <li><a>
                <div class="icoImg" style="background:#FF7B7B ;">
                    <img src="/addons/sz_yi/template/mobile/style1/static/images/11.0.png"/>
                </div>
                <div class="text">
                    <p>多轨奖金</p>
                    <p>￥<?php echo empty($prize)?'0.00':$prize?></p>
                </div>
             </a></li>
             <?php  } ?> -->
      <!--       <span style="width: 1px;height: 30px;background: #ccc;"></span>
    	</ul>
    </div> --> 
    <div class="content">

     <div class="content_head">
        <div class="content_head_img">
            <img src="<?php  echo $member['avatar'];?>" />
        </div>   
        <div class="content_head_font">
            <div class="content_head_fontT">小涛</div>
            <div class="content_head_fontM">加入时间：2017-2-2</div>
        </div> 
        <div class="content_head_right">普通等级</div>
    </div>


    <ul class="content_type" id="data">
        <li >
            <a href="<?php  echo $this->createPluginMobileUrl('withdrawals/already_present')?>">
                <div class="content_type_content"><?php echo empty($total)?'0.00':$total?></div>
                <div class="content_type_title">已提现</div>
            </a>
        </li> 
        <li >
         <a href="<?php  echo $this->createPluginMobileUrl('withdrawals/already_applied')?>">
            <div class="content_type_content"><?php echo empty($already)?'0.00':$already?></div>
             <div class="content_type_title">已申请</div>
         </a>
        </li> 
        <li >
           <a href="<?php  echo $this->createPluginMobileUrl('withdrawals/income_detail')?>">
                <div class="content_type_content"><?php echo empty($keep_apply)?'0.00':$keep_apply?></div>
                 <div class="content_type_title" >奖金明细</div>
         </a>
        </li> 
         <li style="border-right: 0px;">
           <div class="makemoney" onclick="javascript:window.location.href='<?php  echo $this->createPluginMobileUrl('withdrawals/bonus')?>'">提现</div>
            
        </li> 
    </ul>
    
    <div class="content_list">
        <ul class="content_list_head">
            <?php  if($hascom) { ?>
            <li>
                <a href="<?php  echo $this->createPluginMobileUrl('withdrawals/income_detail')?>" style="display: block;width:100%;height: 100%;">
                    <img src="/addons/sz_yi/template/mobile/style1/static/images/fenxiaoJJ.png"/>
                    <div class="content_list_headR">
                        <div class="content_list_headR1">分销奖金</div>
                         <div class="content_list_headR2">￥<?php echo empty($gettotal)?'0.00':$gettotal?></div>
                    </div>
                </a>
            </li>
            <?php  } ?>


            <li>
                <a href="#">
                     <img src="/addons/sz_yi/template/mobile/style1/static/images/quyuJJ.png"/>
                        <div class="content_list_headR">
                            <div class="content_list_headR1">区域奖金</div>
                             <!-- <div class="content_list_headR2">￥222</div> -->
                </a>     </div>
            </li>
        </ul>
        <ul class="content_list_head">
            <?php  if($return['isqueue']==1) { ?>
            <li>
                 <a href="#">
                    <img src="/addons/sz_yi/template/mobile/style1/static/images/paiweiJJ.png"/>
                    <div class="content_list_headR">
                        <div class="content_list_headR1">排位返奖金</div>
                         <div class="content_list_headR2">￥<?php echo empty($r_each)?'0.00':$r_each?></div>
                    </div>
                </a>
            </li>
             <?php  } ?>
            <?php  if($bonusplus1['start']==1) { ?>
             <li>
                <a href="#">
                   <img src="/addons/sz_yi/template/mobile/style1/static/images/paiweiJJ.png"/>
                    <div class="content_list_headR">
                        <div class="content_list_headR1">静态返奖金</div>
                         <div class="content_list_headR2">￥<?php echo empty($bonusplus)?'0.00':$bonusplus?></div>
                    </div>
                </a>
            </li>
             <?php  } ?>
             <?php  if($premium1['level']==3) { ?>
             <li>
                <a href="#">
                     <img src="/addons/sz_yi/template/mobile/style1/static/images/paiweiJJ.png"/>
                    <div class="content_list_headR">
                        <div class="content_list_headR1">新三级分销奖金</div>
                         <div class="content_list_headR2">￥<?php echo empty($premium)?'0.00':$premium?></div>
                    </div>
                </a>
            </li>
             <?php  } ?>
             <?php  if($twoway['no']==1) { ?>
            <li>
                <a href="#">
                      <img src="/addons/sz_yi/template/mobile/style1/static/images/paiweiJJ.png"/>
                    <div class="content_list_headR">
                        <div class="content_list_headR1">多轨奖金</div>
                         <div class="content_list_headR2">￥<?php echo empty($prize)?'0.00':$prize?></div>
                    </div>
                </a>
            </li>
             <?php  } ?>

            <li>
                <a href="#">
                   <img src="/addons/sz_yi/template/mobile/style1/static/images/gouwuJJ.png"/>
                    <div class="content_list_headR">
                        <div class="content_list_headR1">购特全返奖金</div>
                         <div class="content_list_headR2">￥222</div>
                    </div>
                </a>
            </li>


        </ul>

        <!-- <ul class="content_list_head">
            
            <li><a>
                
                    <img src="/addons/sz_yi/template/mobile/style1/static/images/6.0.png"/>
                
                <div class="text">
                    <p>代理奖金</p>
                    <p>￥<?php echo empty($bonus)?'0.00':$bonus?></p>
                </div>
            </a></li>

            <li><a>
               
                    <img src="/addons/sz_yi/template/mobile/style1/static/images/7.0.png"/>
                 
                <div class="text">
                    <p>区域奖金</p>
                    
                </div>
            </a></li>

            <li><a>
               
                    <img src="/addons/sz_yi/template/mobile/style1/static/images/8.0.png"/>
              
                <div class="text">
                    <p>全球奖金</p>
                    <p>￥<?php echo empty($all_bonus)?'0.00':$all_bonus?></p>
                </div>
            </a></li>
        </ul> -->

        
       
    </div>
    <div class="content_foot">版权所有@KT</div>
</div>
</body>
<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>