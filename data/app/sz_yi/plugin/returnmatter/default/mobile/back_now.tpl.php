<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>返现</title>
		<style type="text/css">
			body{
				padding: 0;
				margin: 0;
			}
			.content{
				width: 100%;
			}
			.content .title{
				width: 100%;
				height: 60px;
				line-height: 28px;
			}
			.content .title div{
				width: 50%;
			    float: left;
    			text-align: center;
    			font-size: 16px;
    			height:60;
    			line-height: 60px;
			}
			.btn{
				background: #eee;
			}
			.active{
				background: #fff;
			}
			.back_list{
				width:96%;
				display: flex;
				height: 80px;
				margin: 0 auto;
				justify-content: center;
				position: relative;
				
			}
			.back_list:not(:last-of-type):after{
				content: " ";
				border-bottom: 1px solid #f4f4f4;
				position: absolute;
				right: 7px;
				bottom: 0%;
				width: 96%;
			}
			.back_list .img{
				width: 36px;
				height: 36px;
				border-radius: 50%;
				background:#FDCA30 ;
				transform: translateX(-6px) translateY(20px);
				-webkit-transform: translateX(-6px) translateY(20px);
				
			}
			.back_list .img1{
				width: 36px;
				height: 36px;
				border-radius: 50%;
				background:#f00 ;
				transform: translateX(-6px) translateY(20px);
				-webkit-transform: translateX(-6px) translateY(20px);
				
				
			}
			.back_list .img1 img{
				width: 100%;
				height: 100%;
				border-radius: 50%;
			}
			.back_list .img img{
				width: 100%;
				height: 100%;
				border-radius: 50%;
			}
			
			.back_list .order{
				width: 82%;
				
			}
			.order p{
				display: inline-block;
			}
			.order-m p:nth-child(2){
				float: right;
			}
			.num p:nth-child(2){
				float: right;
			}
			.num p {
				color: #ccc;
				transform: translateY(-24px);
			}
			
		</style>
		<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery-1.11.1.min.js"></script>
	</head>
	
	<body>
		
		<div class="content">
			<div class="title">
				<div class="btn active">发款详情</div>
				<div class="btn">发款明细</div>
			</div>
			<div class="change">
				
			</div>
			<script type="text/template" id="list">
				<?php  if(is_array($list_group)) { foreach($list_group as $row) { ?>
					<div class="back_list">
						<div class="img">
							<img src="../addons/sz_yi/static/assets/2.png"/>					
						</div>
						<div class="order">
							<div class="order-m">
								<p style='width: 80%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;'>订单编号:<?php  echo $row['ordersn'];?></p>
								<p>+<?php  echo $row['money'];?></p>
							</div>
							<div class="num">
								
								<p><?php  echo $row['createtime'];?></p>
								<p><?php  echo $row['count_m'];?></p>
							</div>
						</div>								
					</div>
				<?php  } } ?>
			</script>
			<script type="text/template" id="list">
				<?php  if(is_array($list_group_c)) { foreach($list_group_c as $row) { ?>
					<div class="back_list">
						<div class="img1">
							<img src="../addons/sz_yi/static/assets/1.png"/>					
						</div>
						<div class="order">
							<div class="order-m">
								<p>反现金到:
									<?php  if($row['type'] == '0') { ?>余额<?php  } ?>
		                            <?php  if($row['type'] == '1') { ?>微信<?php  } ?>
		                            <?php  if($row['type'] == '2') { ?>奖金<?php  } ?>
	                            </p>
								<p>+<?php  echo $row['money'];?></p>
							</div>
							<div class="num">
								
								<p><?php  echo $row['createtime'];?></p>
						
							</div>
						</div>								
					</div>
				<?php  } } ?>
			</script>
		
		</div>
		<script type="text/javascript">
			var model1=document.querySelectorAll('#list');
			var contenter=document.querySelector('.content');						
			window.onload=function(){			
			$('.change').append(model1[0].innerHTML)
			$('.btn').click(function(){
				$(this).addClass('active').siblings().removeClass('active');
				var index=$(this).index();
				$('.change').get(0).innerHTML='';
				$('.change').append(model1[index].innerHTML)
			})
				
				
			}
			
		</script>
	</body>
</html>
