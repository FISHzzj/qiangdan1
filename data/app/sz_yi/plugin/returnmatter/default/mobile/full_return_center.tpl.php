<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>

<html>

	<head>

		<meta charset="UTF-8">

		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" href="../addons/sz_yi/static/css/font-awesome.min.css">

		<title>购物全返</title>

		<style type="text/css">

			body{

				padding: 0;

				margin: 0;

				background:#F2F2F2 ;

				overflow-x: hidden;

			}

			.content{

				width: 100%;

				overflow-x: hidden;



			}

			.content .top{

				width: 100%;

				height: 200px;

				background:#FF5959 ;

				text-align: center;

				color: #fff;

			}

			.top_title{

				transform: translateY(30px);

				-webkit-transform:translateY(30px) ;

			}



			.center{

				width: 100%;

				height: 80px;

				line-height: 60px;

				background: #fff;

			}

			.center_top{

				width: 100%;

				color: #f00;

				margin: 0 auto;

				text-align: center;



			}

			.center_top div{

				display: inline-block;

				width: 30%;

				position: relative;

			}

			.center_top div:not(:last-of-type):before{

				content: " ";

				position: absolute;

				right: 1px;

				top: 0%;

				height: 133%;

				border-right: 1px solid #f6f6f6 ;

			}

			.center_bottom{

				width: 100%;

				color: #b0b0b0;

				font-size: 14px;

				margin: 0 auto;

				text-align: center;

				transform: translateY(-38px);

				-webkit-transform: translateY(-38px);

			}

			.center_bottom div{

				display: inline-block;

				width: 30%;

			}



			#container{width: 100%;height: 350px;}

			.title_chart{width: 100%;padding-left: 10px;display: flex;display: -webkit-flex;  line-height: 65px;align-items: center;-webkit-align-items: center;background: #fff;border-bottom:1px solid #eee ;position: relative;}

			.title_chart img{width: 25px;height: 25px;margin-right: 8px;}

			.list_zhou{position: absolute;right: 35px;top:54px;z-index: 88888;width: 55px;color: #999;}

			.btnclass{

				display: inline-block;

				margin-left: 3px;

				width:10px ;

				height: 10px;

				border-bottom:3px solid #555;

				border-right:3px solid #555;

				transform: translateY(-4px)  rotate(45deg);

				-webkit-transform: translateY(-4px)  rotate(45deg);

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



		</style>

	</head>

	<body>
	<div class="page_topbar">
	    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
	    <div class="title">购物全返</div>
	</div>

		<div class="content">

			<div class="top">

				<div class="top_title">

					<div style="font-size: 44px;"><?php  echo $last_money;?></div>

					<div style="font-size: 14px;transform: translateY(20px);-webkit-transform:translateY(20px) ;">今日可返总额</div>

					<a href="<?php  echo $this->createPluginMobileUrl('returnmatter/history')?>" style="text-decoration:none;"><div style="font-size: 16px;transform: translateY(60px);-webkit-transform:translateY(60px) ;background: #fff;color:#FF5959 ;width:140px;height:26px;line-height:26px;text-align:center;border-radius: 18px;margin: 0 auto;">历史总额记录</div></a>

				</div>



			</div>

			<div class="center">

				<a href="<?php  echo $this->createPluginMobileUrl('returnmatter/back_now')?>" style="text-decoration:none;">

				<div class="center_top">

					<div><?php  if($rutrun_mn['money']) { ?><?php  echo $rutrun_mn['money'];?><?php  } else { ?>0<?php  } ?></div>

					<div><?php  if($rutrun_mn['return_money']) { ?><?php  echo $rutrun_mn['return_money'];?><?php  } else { ?>0<?php  } ?></div>

					<div><?php  echo $now_m;?></div>

				</div>

				<div class="center_bottom">

					<div>预计总返(元)</div>

					<div>已返总额(元)</div>

					<div>今日转化率(%)</div>

				</div>

				</a>

			</div>

			<div style="width: 100%;height: 15px;background: #f4f4f4;"></div>

			<div class="title_chart">

				<img src="../addons/sz_yi/static/js/dist/img/2sdasdfd.png"/>  一周转化图

			</div>

			<div id="container" style=" margin: 0 auto">





			</div>



		</div>

		<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery-1.11.1.min.js"></script>

		<script language="javascript" src="../addons/sz_yi/static/js/dist/hightcharts1.js"></script>

	<!-- 	<script src="js/jquery-1.8.3.js" type="text/javascript" charset="utf-8"></script>

		<script src="js/hightcharts1.js" type="text/javascript" charset="utf-8"></script> -->

		<script type="text/javascript">



$(function () {

	var speed=document.documentElement.clientWidth*0.37;

    Highcharts.chart('container', {

        chart: {

            type: 'spline'

        },

        title: {

            text: '转化率',

            x: -speed-10 ,

            y:20,

            style:{

            	color:'#999',

            	 fontSize: '15px'

            }



        },



        xAxis: {

            categories: [<?php  echo $ww;?>],

             title: {//x轴的标题

                text: '日期',

                x: speed ,

                style: {

                    fontSize: '15px',

                    fontWeight: 'bold',

                    color:'#999'

                }

            },

        },

        yAxis: {

            title:{

            	text: null,



            },

            labels: {

                formatter: function () {

                    return this.value + '%';

                }

            }

        },

        tooltip: {

        	valueSuffix: '%',

            crosshairs: true,

            shared: true

        },

        plotOptions: {

            spline: {

                marker: {

                    radius: 4,

                    lineColor: '#666666',

                    lineWidth: 1

                }

            }

        },

         legend: {

            layout: 'vertical',

            align: 'center',

            verticalAlign: 'top',

            borderWidth: 1,





        },

        series: [{



            name:'一周转化率',

            style:{

            	fontSize: '0px'

            },



            data: [<?php  echo $ss;?>]





        }]

    });

});

!function(){

	var open=true;

	 $('.list_zhou').click(function(){

	 	if (open) {

	 		$(this).find('.btnclass').css({'transform': 'translateY(0px) rotate(-135deg)','-webkit-transform':'translateY(0px) rotate(-135deg)'});

	 		open=!open;

	 	} else{

	 		$(this).find('.btnclass').css({'transform': 'translateY(-4px) rotate(45deg)','-webkit-transform':'translateY(-4px) rotate(45deg)'});

	 		open=!open;

	 	}

	 })



}()





		</script>

	</body>

</html>

