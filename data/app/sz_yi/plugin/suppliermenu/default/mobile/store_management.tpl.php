<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
	<title>门店管理</title>
	<meta charset="utf-8">
	<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,initial-scale=1.0,width=device-width"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
	<link rel="stylesheet" type="text/css" href="/addons/sz_yi/static/fontMain/iconfont.css">

	<style type="text/css">
		*{margin:0;padding:0;font-family: '微软雅黑'}
		body{background: #f2f2f2;}
		a{text-decoration: none;}
		.page_topbar{position: relative;height: 45px;background: #fff;border-bottom: 1px solid #eaeaea;font-size: 16px;line-height: 45px;text-align: center;}
		.page_topbar .back{position: absolute;left: 15px;height: 45px;line-height: 45px;display: block;color: #282828;font-size: 24px;}
		.page_topbar .title {
			 height: 45px;
			 line-height: 45px;
			 color: #000;
			 text-align: center;
		}
		.headerRightIcon{width: 50px;height: 45px;position: absolute;right: 10px;top: 0px;}
		.header_title_select{color:#e45050;border-bottom: 2px solid #e45050;}
		.header_title{height: 40px;line-height:40px;background: #fff;display: flex;display: -webkit-flex;color:#656565;}
		.header_title_left{flex: 1;text-align: center;font-size: 16px;}
		.header_title_right{flex: 1;text-align: center;}
		.content_title{color:#e45050;height:40px;line-height:40px;padding:10px 0 0 10px;font-size: 15px;}
		.content_line{height: 170px;background: #fff;padding:0 10px 0 10px;margin-bottom: 10px;}
		.content_line_btn{width: 10%;height:170px;line-height: 170px;float: left;display: none;}
		.content_line_txt{width: 100%;height:170px;line-height: 170px;float: left;}
		.text_top{width: 100%;height:30px;padding:0 0 0 10px; border-left: 3px solid #e45050;margin-top: 10px;box-sizing: border-box;margin-bottom: 10px;}
		 .clearfix:after{content: ''; display: block;clear: both;}
		 .text_mid{height: 50px;line-height:50px;padding:10px 0 10px 0;border-top:1px solid #eaeaea;border-bottom:1px solid #eaeaea;color: #282828;text-align: left;}
		 .text_bottom{height: 30px;line-height: 30px;padding:10px 0 10px 0;color:#656565;}
		 .tab{width:100%;position: fixed;bottom: 0px;height: 40px;line-height: 40px;display: none;}
		 .tab_left{width:50%;float:left;background: #fff;padding: 0 0 0 20px;color:#656565;box-sizing: border-box;}
		 .tab_right{width:50%;float:left;background: #e45050;text-align: center;color:#fff;}
		 .hs_xuanzhong{color:#e45050;}

		 .content1{margin:10px 0 0 0;}
		 .content_line1{height: 130px;width:100%;background: #fff;padding:10px 0px 10px 10px;box-sizing: border-box;}
		 .content_line_btn1{width: 15%;height:120px;line-height:120px;float: left;display: none;}
		 .content_line_txt1{float: left;width: 100%;border-bottom: 1px solid #eaeaea;}
		 .content_line_img{width: 60px;height: 60px;float:left;line-height: 150px;}
		  .content_line_img>img{width: 60px;height: 60px;border-radius: 50%;border:1px solid #f2f2f2;-webkit-box-shadow: 0px 5px 5px #999; -moz-box-shadow: 0px 5px 5px  #999;  box-shadow: 0px 5px 5px  #999;}
		  .img_content{float:left;margin:0 0 0 10px;height: 100%;height: 120px;width:70%;position: relative;}
		  .content_line1_btn{position: absolute;right:0px;top:10px;padding:1px 10px 1px 10px;border:1px solid #e45050;color: #e45050;border-radius: 5px;}
		  .content_line1_btnJY{
		  	position: absolute;right:0px;top:10px;padding:1px 10px 1px 10px;border:1px solid #989898;color: #989898;border-radius: 5px;
		  }
		  .jinyong{float: right;padding:0px 10px 0px 10px;color:#989898!important;border:1px solid #989898!important;border-radius: 5px;margin:0 10px 0 0;}
		  .qudong{float: right;padding:0px 10px 0px 10px;border:1px solid #e45050;border-radius: 5px;color:#e45050;margin:0 10px 0 0;}
	</style>
	<script type="text/javascript" src="/addons/sz_yi/static/js/jquery-2.1.1.min.js"></script>
</head>
<body>
	<div class="page_topbar">
		<a href="#" class="back" onclick="history.back()">
		    <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
		</a>
		<div class="title" style=" color: #282828;">门店管理</div>
		  <a href="#">
		      <div class="headerRightIcon" style="color: #282828;" data-index="2">选择</div> 
		  </a>
	</div>
	<div class="header_title">
		<div class="header_title_left header_title_select">门店管理</div>
		<div class="header_title_right">核销员管理</div>
	</div>

	<!--门店管理-->
	<div class="content" >
		<div class="content_title">核心关键词:<?php  echo $set[verify]['verifykeyword'];?></div>

		<?php  if(is_array($list)) { foreach($list as $row) { ?>
		<div class="content_line" data-id="<?php  echo $row['id'];?>">
			<div class="content_line_btn"  >
				 <i class="iconfont arrow hs_xuanzhong" onclick="Select($(this))">&#xe613;</i>
			</div>
			<div class="content_line_txt">
				<div class="text_top">
					<div class="clearfix" style="float: left;height: 30px;line-height: 30px;color:#282828"><?php  echo $row['storename'];?></div>
					<div class="clearfix" style="float: right;height: 30px;line-height: 30px;color: #656565;"> <i class="iconfont arrow" >&#xe61c;</i><?php  echo $row['tel'];?></div>
					
				</div>
				<div class="text_mid">
					 <i class="iconfont arrow clearfix" style="float: left;">&#xe601;</i>
					 <?php  echo $row['address'];?>
					  <i class="iconfont arrow clearfix" style="float: right;color: #e45050">&#xe621;</i>
				</div>
				<div class="text_bottom">
					核销员数量：<?php  echo $row['salercount'];?>
					<span class="btn_hide ajax <?php  if($row['status'] == 1) { ?>qudong<?php  } else { ?>jinyong<?php  } ?>"  data-id= "<?php  echo $row['id'];?>" data-num="<?php  echo $row['status'];?>"><?php  if($row['status'] == 1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
					<span class="btn_hide" style="float: right;padding:0px 10px 0px 10px;border:1px solid #e45050;border-radius: 5px;color:#e45050;margin:0 10px 0 0"  onclick="window.location.href='<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'store_set', 'id' => $row['id']));?>'">编辑</span>
				</div>

			</div>
		</div>
		<?php  } } ?>
	</div>

	<!--核销员管理-->
	<div class="content1" style="display: none;">
		<?php  if(is_array($saler)) { foreach($saler as $row) { ?>
		<div class="content_line1" data-id="<?php  echo $row['id'];?>">
			<div class="content_line_btn1">
				 <i class="iconfont arrow hs_xuanzhong" onclick="Select($(this))">&#xe613;</i>
			</div>
			<div class="content_line_txt1">
				<div class="content_line_img">
					<img src="<?php  echo $row['avatar'];?>">
				</div>
				<div class="img_content">
					
					<div style="color:#282828;font-size: 18px;"><?php  echo $row['nickname'];?></div>
					<div style="margin:10px 0 10px 0;font-size: 16px;color:#282828;">ID:<?php  echo $row['id'];?>|<?php  echo $row['salername'];?></div>
					<div style="font-size: 16px;color:#282828;"><?php  echo $row['storename'];?></div>
					<div class="btn_on <?php  if($row['status'] == 1) { ?>content_line1_btn<?php  } else { ?>content_line1_btnJY<?php  } ?>" data-id= "<?php  echo $row['id'];?>" data-num="<?php  echo $row['status'];?>"><?php  if($row['status'] == 1) { ?>启用<?php  } else { ?>禁用<?php  } ?></div>
				</div>
				
			</div>
		</div>
		<?php  } } ?>
	</div>

	<div class="tab">
		<div class="tab_left"><i class="iconfont arrow hs_xuanzhong" data-select="1">&#xe613;</i>全选</div>
		<div class="tab_right">删除</div>
	</div>


	<script type="text/javascript">
		$(function(){
			
			//切换栏
			$('.header_title>div').click(function(){
				$(this).addClass('header_title_select').siblings().removeClass('header_title_select');
				var number = $(this).index();
				if(number=='0'){
					$('.content').show();
					$('.content1').hide();
				}else{
					$('.content').hide();
					$('.content1').show();
				}
			});

			//点击选择
			$('.headerRightIcon').click(function(){

				if($('.headerRightIcon').attr('data-index')==2){
					$('.headerRightIcon').html('完成');	
					$('.content_line_txt').css({"width":"85%"});
					$('.content_line_txt1').css({"width":"85%"});
					$('.tab').show();
					$('.content_line_btn').show();
					$('.content_line_btn1').show();
					$('.btn_hide').hide();

					$('.headerRightIcon').attr('data-index','3');
				}else{
					$('.headerRightIcon').html('选择');
					$('.tab').hide();
					$('.content_line_txt').css({"width":"100%"});
					$('.content_line_txt1').css({"width":"100%"})
					$('.content_line_btn').hide();
					$('.content_line_btn1').hide();
					$('.btn_hide').show();

					$('.headerRightIcon').attr('data-index','2');
				}

			
			});

			//选择所有
			$('.tab_left').click(function(){
				if($('.tab_left>i').attr('data-select')=='1'){
					$('.content_line_btn>i').removeClass('hs_xuanzhong').html('&#xe609;');
					$('.content_line_btn1>i').removeClass('hs_xuanzhong').html('&#xe609;');
					$('.tab_left>i').removeClass('hs_xuanzhong').html('&#xe609;');
					$('.tab_left>i').attr('data-select','0');
				}else{
					$('.content_line_btn>i').addClass('hs_xuanzhong').html('&#xe613;');
					$('.content_line_btn1>i').addClass('hs_xuanzhong').html('&#xe613;');
					$('.tab_left>i').addClass('hs_xuanzhong').html('&#xe613;');
					$('.tab_left>i').attr('data-select','1');
				}
			});

			//删除
			$('.tab_right').click(function(){
				var ids = [];
				var ids1 = [];
				if($('.header_title>div').eq(0).hasClass('header_title_select')){
					$('.content_line').each(function(){
						if($(this).find("i").hasClass("hs_xuanzhong")){
							ids.push($(this).attr('data-id'));
							
							$(this).remove();
						}
							
							 
					});
					remove('<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'delete'));?>',ids)
				}else{
					$('.content_line1').each(function(){
						if($(this).find("i").hasClass("hs_xuanzhong")){
							ids1.push($(this).attr('data-id'));
							
							$(this).remove();
						}
						
							 
					})
					remove('<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'delete_saler'));?>',ids1)	
				}
				
				
				
			});

			//点击变成禁用
			$('.btn_on').click(function(){
				if ($('.btn_on').attr('data-num')=='1') {
					$(this).html('禁用');
					$(this).addClass('content_line1_btnJY');
					$('.btn_on').attr('data-num','0');
					start('<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'saler_status'));?>',$(this).attr('data-id'),0);
				}else{
					$(this).html('启用')
					$(this).removeClass('content_line1_btnJY');
					$(this).addClass('content_line1_btn');
					$('.btn_on').attr('data-num','1')
					start('<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'saler_status'));?>',$(this).attr('data-id'),1)
				}
			});

			//启用
			$('.ajax').click(function(){
				if ($('.ajax').attr('data-num')=='1') {
					$(this).html('禁用');
					$(this).addClass('jinyong');
					$('.ajax').attr('data-num','0');
					start('<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'store_status'));?>',$(this).attr('data-id'),0);
				}else{
					$(this).html('启用')
					$(this).removeClass('jinyong');
					$(this).addClass('qudong');
					$('.ajax').attr('data-num','1')
					start('<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'store_status'));?>',$(this).attr('data-id'),1)
				}
				
				// console.log(<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'store_status'))?>);
			});

		})


		function Select(obj){
			
			if(obj.hasClass('hs_xuanzhong')){
				$(obj).removeClass('hs_xuanzhong').html('&#xe609;');
			}else{
				$(obj).addClass('hs_xuanzhong').html('&#xe613;');

			}
		}	

		//启动接口
		function start(url,id,staus){
			 $.ajax({  
		         type:'post',      
		         // url:"<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'store_status'));?>"
		         url:url,
		         data:{
		         	  'status':staus,
		         	  'id':id
		     		},  
		         dataType:'json',  
		         success:function(data){  

		         		console.log(data);
		         },
		          error: function() {  
			         
			          console.log(11)
			     }  
		   });  
		}
		//删除
		function remove(url,ids){
			 $.ajax({  
		         type:'post',      
		         url:url,
		         data:{
		         	  'ids':ids
		     		},  
		         dataType:'json',  
		         success:function(data){  

		         		console.log(data);
		         },
		          error: function() {  
			         
			          console.log(11)
			     }  
		   });  
		}
	</script>
</body>
</html>