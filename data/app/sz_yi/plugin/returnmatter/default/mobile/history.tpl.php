<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" href="../addons/sz_yi/static/css/font-awesome.min.css">

		<title>历史记录</title>

		<style type="text/css">

		.content{

			width: 100%;

			background: #fff;

		}

		.title{

			width: 100%;

			text-align: center;

		}

		.list{

			width: 94%;

			margin: 0 auto;

			height: 80px;

			position: relative;

		}

		.list:not(:last-of-type):after {

			content: " ";

			border-bottom: 1px solid #f4f4f4;

			position: absolute;

			right: 0px;

			bottom: 0%;

			width: 100%;

		}

		.conversion p{

			display: inline-block;

			font-size: 14px;color: #b2b1b1;

		}

		.page_topbar {
		    position: relative;
		    height: 45px;
		    background: #f9f9f9;
		    border-bottom: 1px solid #e8e8e8;
		    font-size: 16px;
		    line-height: 45px;
		    text-align: center;
		}
		.page_topbar a.back {
		    position: absolute;
		    left: 15px;
		    height: 45px;
		    line-height: 45px;
		    display: block;
		    color: #282828;
		    font-size: 24px;
		}
		.page_topbar .title {
		    border-bottom: 1px solid #efefef;
		    background: white;
		    height: 45px;
		    line-height: 45px;
		    color: #000;
		    text-align: center;
		}

		body{margin:0px;}


		</style>

	</head>

	<body>
		<div class="page_topbar">
		    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
		    <div class="title">历史总额记录&nbsp;(<?php  if($sql_sum) { ?><?php  echo $sql_sum;?><?php  } else { ?>0<?php  } ?>元)</div>
		</div>

		<div class="content">

			<!-- <div class="title">

				<p>历史总额记录&nbsp;(<?php  if($sql_sum) { ?><?php  echo $sql_sum;?><?php  } else { ?>0<?php  } ?>元)</p>

			</div> -->

			<?php  if(is_array($sql_count)) { foreach($sql_count as $row) { ?>

				<div class="list">

					<div style="color: #f00;font-size: 22px;transform: translateY(5px);"><?php  echo $row['money'];?></div>

					<div class="conversion">

						<p style="float: left;">转化率：<span style="color:#03a9f4 ;"><?php  echo $row['countss'];?>%</span></p>

						<p style="float: right;"><?php  echo $row['createtime'];?></p>

					</div>

				</div>

			<?php  } } ?>



		</div>





	</body>

</html>

