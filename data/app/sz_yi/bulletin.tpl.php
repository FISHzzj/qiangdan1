<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>消息留言</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	<meta name="format-detection" content="telephone=no" />

	<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/base.css">
	<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/jquery-weui.min.css">
	<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/weui.min.css">
	<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/style.css">
	<!--new add start for style1 2016.09.09-->
	<link rel="stylesheet"  type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/font-awesome.min.css">

	<link rel="stylesheet"  type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/style1.css">
	<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/main.css">
	<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/fontMain/iconfont.css">
	<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery-1.11.1.min.js"></script>
	<style type="text/css">
		a,a:hover,a:active{color: #282828;text-decoration: none;}
		.invitWrap{height: 63px;}
		.f-colorRed{color: #b7434d;}
		.line{height: auto;line-height: 25px;color: gray;font-size: 14px;}
		.f-shengnuehao{width: 100%;-webkit-line-clamp: 1;color: #989898 ;}
		#tab1 .infoWrap ul li{position: relative;}
		#tab1 .infoWrap ul li .ico{position: absolute;left: -4px;top: 30px;font-size: 24px;}

		#tab2 .infoList ul li{ border-bottom: 1px solid #eee;padding-bottom: 5px;background: white;padding: 10px 10px 15px 10px;position: relative; }
		#tab2 .infoList ul li .ico{position: absolute;left: 3px;top: 5px;font-size: 24px;}

		#tab3 .infoWrap ul li{position: relative;}
		#tab3 .infoWrap ul li .ico{position: absolute;left: -2px;top: 19px;font-size: 24px;}
		.weui-navbar__item{background: white;height: 40px;line-height: 13px;font-size: 14px;}
		.weui-navbar__item.weui-bar__item--on{background: white;color:#e45050;border-bottom: 2px solid  #e45050;}
		.titface{width: 55px;height: 53px;border-radius: 5px;}
		.tit{color: #282828;font-size: 16px;width: 50%;float: left;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;}
		@media screen and (max-width: 320px){
			.tit{width: 45%;}
		}
		.weui-navbar+.weui-tab__bd {padding-top: 40px;}
		.weui-navbar__item:after{border-right: 0px;}
		.chakan{font-size: 14px;color: #989898;padding: 10px 15px;}
		.f-marginB5{margin-bottom: 5px;}
		.num{right: -5px;top: -4px;width: 10px;height: 10px;background: #e45050;}
		.ziying{position: absolute;right: 0px;top:0px;width: 35px;}
		.infoList ul li{position: relative;}
		.weui-tab__bd .weui-tab__bd-item{display: block;}	
		a{display: block; }
		.new{width: 79%;;margin-left: 7px;}
		.disabled{background: #9a9a9a !important;}
		.imgDiv{width: 55px;height: 55px;float: left;}


		@font-face {font-family: "iconfont";
		  src: url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.eot?t=1474179952'); /* IE9*/
		  src: url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.eot?t=1474179952#iefix') format('embedded-opentype'), /* IE6-IE8 */
		  url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.woff?t=1474179952') format('woff'), /* chrome, firefox */
		  url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.ttf?t=1474179952') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
		  url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.svg?t=1474179952#iconfont') format('svg'); /* iOS 4.1- */
		}
		@font-face {font-family: "iconfont";
		  src: url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.eot?t=1474179952'); /* IE9*/
		  src: url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.eot?t=1474179952#iefix') format('embedded-opentype'), /* IE6-IE8 */
		  url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.woff?t=1474179952') format('woff'), /* chrome, firefox */
		  url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.ttf?t=1474179952') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
		  url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.svg?t=1474179952#iconfont') format('svg'); /* iOS 4.1- */
		}
		@font-face {font-family: "iconfont";
		  src: url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfont.eot?t=1474945964'); /* IE9*/
		  src: url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfont.eot?t=1474945964#iefix') format('embedded-opentype'), /* IE6-IE8 */
		  url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfont.woff?t=1474945964') format('woff'), /* chrome, firefox */
		  url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfont.ttf?t=1474945964') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
		  url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfont.svg?t=1474945964#iconfont') format('svg'); /* iOS 4.1- */
		}
		.hs {
		  font-family:"iconfont" !important;
		  font-style:normal;
		  -webkit-font-smoothing: antialiased;
		  -webkit-text-stroke-width: 0.2px;
		  -moz-osx-font-smoothing: grayscale;
		}
		.hs-xuan:before { content: "\e739"; }
		.hs-wei:before { content: "\e651"; }
		.hs-xuanzhong:before { content: "\d622"; }
		.removeD {position: fixed;bottom: 0px;left: 0;z-index: 1111;display: none;width: 100%;height: 45px;line-height: 45px;background: #d6d6d6;}
		.removeD .all {margin-left: 10px;height: 45px;line-height: 45px;float: left;}
	</style>
</head>
<body>
	<header>		
		<div class="header_top">
			<div class="header_top">
				<a href="javascript:history.go(-1)">
					<i class="iconfont arrow f-col333">&#xe618;</i>
				</a>
				消息留言
				<a href="#">
					<i class="headerRightIcon" style="width:35px;color: #282828;" onclick="complete($(this))">
						编辑
					</i>
				 </a>
			</div>
		</div>
	</header>
	<div class="content">
		<!-- 容器 -->
		<div class="weui-tab">
		  <div class="weui-tab__bd">
		  	       <div id="tab2" class="weui-tab__bd-item weui-tab__bd-item--active">		     
		  	        	<div class="infoList">
		  	         		<ul>
		  	         			<?php  if(is_array($supplier)) { foreach($supplier as $row) { ?>
		  	         			<li class="messageOne" data-messageId="<?php  echo $row['member_id'];?>">
		  	         				<div class="ico" style="display:none;"><i class="hs hs-wei"></i></div>
		  	         				<a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/talking',array('id'=>$row['uid'],'member_id'=>$row['member_id']))?>">
		  	   	      					<div class="f-relative imgDiv">
		  	   	      						<?php  if($row['read_uid'] > 0) { ?>
											<span class="num"></span>
											<?php  } ?>
							      			<img src="<?php  echo $row['logo'];?>" class="titface fl">
							      		</div>
			  	   	      				<div class="line f-colorgray new fl">
			  	   			      			<div class="f-relative">
			  	   			      				<span class="tit"><?php  echo $row['name'];?></span>
			  	   			      				<span class="fr" style="color: #989898"><?php  echo date('Y-m-d H:i:s',$row['createtime'])?></span>				
			  	   			      			</div>
			  	   			      			<div class="f-shengnuehao f-relative">
			  	   			      				<span><?php  echo $row['content'];?></span>
			  	   			      			</div>
			  	   			      		</div>		      				
			  	   						<div style="clear:both;"></div>
		  	   						</a>
		  	         			</li>
		  	         			<?php  } } ?>
		  	         		</ul>
		  	         	</div>
		  	       </div> 
		  	       <div class="removeD clearfloat">
		  	         <div class="all ico" sel='0' style="float: left;width:50%;margin:0;padding:0 0 0 10px;">
		  	             <i class="hs hs-wei" style="font-size: 20px;color: rgb(153, 153, 153);float:left"></i>
		  	             <span style="float:left;margin-left:5px">全选</span>
		  	         </div>
		  	         <div style="float:left;color:#fff;background: #e45050;width:50%;text-align: center;" id="removehistory" class="disabled">删除</div>
		  	     </div>
		  </div>
		</div>
	</div>
<script language="javascript" src="../addons/sz_yi/static/js/require.js"></script>
<script language="javascript" src="../addons/sz_yi/static/js/app/config.js?v=2"></script>
<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery.gcjs.js"></script>
<script type="text/javascript">
		//编辑
		function complete(obj){
		  var _this = obj;
		  if($(".messageOne .ico").css('display')=="none"){
		      $(".messageOne .ico").show();
		      _this.text("完成");
		      $(".removeD").show();
		      $(".messageOne").css("padding","10px 10px 15px 30px")
		  }else{
		      $(".messageOne .ico").hide();
		      _this.text("编辑");
		      $(".removeD").hide();
		      $(".messageOne").css("padding","10px 10px 15px 10px")
		  }
		}

		function setSelect(obj, sel){
		    if(sel=='1'){
		         obj.find('i').addClass('hs-wei').removeClass('hs-xuanzhong').css('color', '#656565');
		    }
		    else{
		         obj.find('i').removeClass('hs-wei').addClass('hs-xuanzhong').css('color', '#e45050');
		    }
		    sel =sel==1?0:1;
		    obj.parent().attr('sel',sel);
		
		    calctotal();
		}

		


		 function calctotal(){
	           var total = 0;
	        $(".messageOne").each(function(){
	            var $this = $(this);
	            var sel = $this.attr('sel')=='1';
	            if(sel){
	                total++;
	            }
	        });
	           if(total<=0){
	                $("#removehistory").addClass('disabled');
	            }
	            else{
	                $("#removehistory").removeClass('disabled');
	            }

	        return total;
	    }

require(['tpl', 'core'], function(tpl, core) {
	bindEvents();
	function bindEvents(){             
	    $(".ico").unbind('click').click(function(){
	        setSelect($(this),$(this).parent().attr('sel'))
	    });
	    $(".all").click(function(){
	        var $icon = $(this).find('i');
	        var sel = $(this).attr('sel');
	        $(".ico").each(function(){
	            setSelect($(this),sel)
	        });
	        setSelect($icon,sel,true);
	    });
	    $('#removehistory').click(function(){
	           var ids = [];
	           $('.messageOne[sel=1]').each(function(){
	               ids.push($(this).attr('data-messageId')) ;
	           });
	           removeHistory(ids);
	    });
	}
       function removeHistory(ids){
          		if(ids.length<=0){
                     core.tip.show('未选择商品');
                     return;
                 }
               

                 core.tip.confirm('确认从消息中心删除这些消息吗?',function(){
                             $('.messageOne').attr('del',0);                     
	                          var url ="<?php  echo $this->createPluginMobileUrl('suppliermenu/bulletin',array('uid'=>$row['uid']))?>";
	                          
                             var data = {
                             	'ids':ids,
                             	'op':'delete_supplier'
                             }
                             $.ajax({
                             	type: "post",
                             	url:url,
                             	data:data,
                             	dataType: "json",
                             	success:function(data){
                             		console.log(data)
                             		if(data.status==1)  {
                             		    for(var i in ids){
                             		        $('.messageOne[data-messageId=' + ids[i]+ ']').attr('del',1).fadeOut(500,function(){
                             		            $('.messageOne[data-messageId=' + ids[i]+ ']').remove();
                             		        })
                             		    }
                             		   if($('.messageOne[del=0]').length<=0){
                             		        
                             		   }
                             		   else{
                             		       calctotal();    
                             		   }
                             		}
                             		else{
                             		    core.tip.show('删除失败');
                             		}
                             	},
                             	error:function(data){
                             		console.log(data)
                             	}
                             })

              });
    }
});
</script>
</body>
</html>