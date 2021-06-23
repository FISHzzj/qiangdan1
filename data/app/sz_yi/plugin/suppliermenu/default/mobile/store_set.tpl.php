<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
	<title>门店设置</title>
	<meta charset="utf-8">
	<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,initial-scale=1.0,width=device-width"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
	<link rel="stylesheet" type="text/css" href="/addons/sz_yi/static/fontMain/iconfont.css">
	<link rel="stylesheet" type="text/css" href="/addons/sz_yi/static/css/aui.2.0.css">

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
		.aui-list:before{background-color:none;height: 0;}
		.aui-list .aui-list-header{font-size: 0.8rem;background: none;color:#e45050;margin-bottom:6px;}
		.aui-list textarea{height: 2rem;}
		.jinyong{padding:2px 10px 2px 10px!important;color:#989898!important;border:1px solid #989898!important;border-radius: 5px!important;font-size: 15px!important;}
		 .qudong{padding:2px 10px 2px 10px!important;color:#e45050!important;border-radius:5px!important;border:1px solid #e45050!important;font-size: 15px!important;}
	</style>

	<script type="text/javascript" src="/addons/sz_yi/static/js/jquery-2.1.1.min.js"></script>
</head>
<body>
	<div class="page_topbar">
		<a href="#" class="back" onclick="history.back()">
		    <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
		</a>
		<div class="title" style=" color: #282828;">门店设置</div>
		  <a href="#">
		      <div class="headerRightIcon" style="color: #282828;" data-index="2">完成</div> 
		  </a>
	</div>

	<div class="aui-content aui-margin-b-15">
		    <ul class="aui-list aui-form-list">
		        
		        <li class="aui-list-item">
		            <div class="aui-list-item-inner">
		                <div class="aui-list-item-label">
		                    名称
		                </div>
		                <div class="aui-list-item-input">
		                    <input type="text" placeholder="<?php  echo $list['storename'];?>" value="<?php  echo $list['storename'];?>" name="storename" id="storename">
		                </div>
		            </div>
		        </li>
		        <li class="aui-list-item">
		            <div class="aui-list-item-inner">
		                <div class="aui-list-item-label">
		                    电话
		                </div>
		                <div class="aui-list-item-input">
		                    <input type="text" placeholder="<?php  echo $list['tel'];?>" value="<?php  echo $list['tel'];?>" name="tel" id="tel">
		                </div>
		            </div>
		        </li>
		        <li class="aui-list-item">
		            <div class="aui-list-item-inner">
		                <div class="aui-list-item-label">
		                    门店地址
		                </div>
		                <div class="aui-list-item-input">
		                    <textarea placeholder="<?php  echo $list['address'];?>" name="address" id="address"><?php  echo $list['address'];?></textarea>
		                </div>
		            </div>
		        </li>
		    </ul>
	</div>

	<div class="aui-content aui-margin-b-15">
    <ul class="aui-list aui-list-in">
        <li class="aui-list-header">
            核销员列表
        </li>
        <?php  if(is_array($sale)) { foreach($sale as $row) { ?>
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-title"><i class="iconfont arrow" style="margin-right: 10px;">&#xe63d;</i><?php  echo $row['salername'];?></div>
                <div class="aui-list-item-right">
                    <span class="btn_on <?php  if($row['status'] == 1) { ?>qudong<?php  } else { ?>jinyong<?php  } ?>" data-id= "<?php  echo $row['id'];?>" data-num="<?php  echo $row['status'];?>"><?php  if($row['status'] == 1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
                </div>
            </div>
        </li>
        <?php  } } ?>
    </ul>
	</div>
	<script type="text/javascript">
		$(function(){
			$('.headerRightIcon').click(function(){
				var storename = $('#storename').val();
				var tel = $('#tel').val();
				var address = $('#address').val();
				var id = getQueryString('id');


				if(address.length==0){
					alert('地址不能为空');
					return;
				}
				strat(id,storename,tel,address);
			});

			//点击启动禁用

		})

		function strat(id,storename,tel,address){
			 $.ajax({  
		         type:'post',      
		        
		         url:"<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'post'));?>",
		         data:{
		         	  'id':id,
		         	  'storename':storename,
		         	  'tel':tel,
		         	  'address':address
		     		},  
		         dataType:'json',  
		         success:function(data){  
		         		console.log(data.status);
		         		window.location.href ='<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'display', 'uid' => $list['mid']));?>'
		         },
		          error: function() {  
			         
			          console.log(11)
			     }  
		   });  
		}
		 function getQueryString(name) {
		  var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
		  var r = window.location.search.substr(1).match(reg);
		  if (r != null) return r[2]; return "";
		}

		$('.btn_on').click(function(){
				if ($('.btn_on').attr('data-num')=='1') {

					$(this).html('禁用');
					$(this).removeClass('qudong');
					$(this).addClass('jinyong');
					$('.btn_on').attr('data-num','0');
					start('<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'saler_status'));?>',$(this).attr('data-id'),0);
				}else{
					$(this).html('启用')
					$(this).removeClass('jinyong');
					$(this).addClass('qudong');
					$('.btn_on').attr('data-num','1')
					start('<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management', array('op' => 'saler_status'));?>',$(this).attr('data-id'),1)
				}
			});

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
	</script>


</body>
</html>