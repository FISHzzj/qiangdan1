<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>商家对话</title>
<meta charset="utf-8">
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/base.min.css "/>
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/amount.css"> -->
<style type="text/css">
    canvas {position: absolute;height: 100%;width: 100%; display: block;}	
    body{background: #f2f2f2;font-family: "PingFang SC", Helvetica, "Helvetica Neue", "微软雅黑", Tahoma, Arial, sans-serif;}
    header,section,h3,p{margin: 0;padding: 0;}
    input,button{background: transparent;border: none;outline: none;}
    a,a:hover{text-decoration: none;}	
	.vessel{height:100%;}
	.artc-box{padding:5px;}
	.a-title{text-align:center;}
	.a-title h3{font-size:1.4em;line-height:2.0em;}
	.a-origin{font-size:12px;color:#ccc;text-align:center;}
	.a-origin span{padding-left:5px;}
	.a-aricle{padding-top:10px;}

	footer {position: fixed;width: 100%;height: 50px;min-height: 50px;border-top: solid 1px #bbb;left: 0px;bottom: 0px;overflow: hidden;padding: 0px 50px;background-color: #fafafa;}
	.footer-left {position: absolute; width: 50px;height: 50px;left: 0px;bottom: -7px;text-align: center;vertical-align: middle; line-height: 100%;padding: 12px 4px;}
	.footer-center {height: 100%;padding: 5px 0px;}
	.footer-right {position: absolute;width: 50px;height: 50px;right: 5px;bottom: 0px;text-align: center;vertical-align: middle;line-height: 100%; padding: 12px 5px;display: inline-block;}
	.footer-center .input-text { background: #fff;border: solid 1px #ddd; padding: 10px;font-size: 16px !important;line-height: 18px !important;font-family: verdana !important;overflow: hidden;width: 71%;height: 100%;border-radius: 5px;margin-left: 50px;}
	.footer-right input {color: #0062CC;line-height: 30px;}
	.footer-left input[type="file"] {position: absolute;left: -15px;top: 0px;width: 90%; height: 100%; opacity: 0;cursor: pointer;z-index: 0;}
	#deleted{width: 70px;height: 32px;line-height: 32px;border-radius: 3px;padding-left: 0px;padding-right: 0px;font-size: 13px;color: #0062CC;border: 1px solid #0062CC;top: 6px;}
	.no_kaifa{display: flex; width:100%;height:100%;margin: 0 auto; display: -webkit-flex; /* Safari */flex-direction:column;justify-content:center;position: absolute;z-index: 111100}
	.no_kaifa>img{height: 180px;}
	.no_kaifa>p{text-align: center;color:#fff;font-size: 18px;}
	.face{width: 55px;height: 55px;border-radius: 50%;position: absolute;}
	.faceMy{right:5px;top: 0px; }
	.faceYour{left:5px;top: 0px; }
	.My{padding-right: 70px;margin-bottom: 20px;}
	.Your{padding-left: 70px;margin-bottom: 20px;}
	.f-tal{text-align: left;}
	.f-tar{text-align: right;}
	.neirong{border-radius: 5px;color: white;font-size: 15px;padding: 10px;}
	.My .neirong{background: green;}
	.Your .neirong{background: orange;}
	.name{font-size: 15px;}

	#triangle-left {
	    width: 0;
	    height: 0;
	    border-top: 5px solid transparent;
	    border-right: 10px solid orange;
	    border-bottom: 5px solid transparent;
	    position: absolute;
	    top: 0px;
	    left: -7px;
	}
	#triangle-right {
    width: 0;
    height: 0;
    border-top: 5px solid transparent;
    border-left: 10px solid green;
    border-bottom: 5px solid transparent;
    position: absolute;
    top: 0px;
	right: -7px;
}
.page_topbar{position: fixed;top: 0px; width: 100%;z-index: 999999;}
</style>

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/static/css/aui.2.0.css">
</head>

<body>

	<div class="page_topbar">
	    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
	    <div class="title">
	    	商家对话
	    </div>
	    <!-- <input id="deleted" class="headerRightIcon" type="button" value="消息清除"> -->
	    
	</div>

	<div class="artc-box" style="margin-top: 50px;"> 
			<!-- <div class="a-title"><h3>消息记录</h3></div>  -->
			<div class="a-aricle">
				<?php  if(is_array($liuyan)) { foreach($liuyan as $row) { ?>
					<?php  if($row['sender'] == "member") { ?>
					<div class="f-relative Your" > 
						<img src="<?php  echo $row['member_img'];?>" class="face faceYour">
						<p class="name f-tal"><?php  echo $row['member_name'];?></p>
						<div  class="neirong f-tal fl f-relative">
							<div id="triangle-left"></div>
							<?php  echo $row['content'];?>
						</div>
						<div class="f-cb"></div>
					</div>
					<?php  } else { ?>
					<div class="f-relative My" >					
						<img src="../attachment/<?php  echo $row['uid_img'];?>" class="face faceMy">
						<p style="margin-bottom:5px;" class="name f-tar"><?php  echo $row['uid_name'];?></p>
						<div style="margin-bottom:5px;" class="neirong f-tar fr f-relative">
							<div id="triangle-right"></div>
							<?php  echo $row['content'];?>
						</div>
						<div class="f-cb"></div>
					</div>
					<?php  } ?>
				<?php  } } ?>
			</div>
		</div>


	<div style="height:300px;"  class="panel-body">
	    <form action="" name="area1" method="post" class="form-horizontal" role="form">
				
	        <div class="form-group"> 
				 <footer>
					<div class="footer-left">
						<i class="iconfont" style="font-size: 22px;">&#xe634;</i>
						<input id="sendImgInput" type="file" accept="image/*">
					</div>
					<div class="footer-center">
						<textarea id="contentss" name="layer9" type="text" class="input-text"></textarea>
					</div>
					<div class="footer-right">
						<input id="arearecord" type="button" name="area1" value="发送">
					</div>
				</footer>
				
	            </div>
	        </div>
	    </form>
	</div>
</div> 
<!-- <div class="no_kaifa">
	<img src="../addons/sz_yi/static2/img/1.gif">
	<p>功能正在开发中</p>
</div> -->
</body>
<script type="text/javascript">
  $(function(){
    $('#deleted').click(function(){
        $.ajax({
          url : "<?php  echo $this->createMobileUrl('shop/talking')?>",
          type: 'post',
          data: {'openid':"<?php  echo $openid;?>",'talkopenid':"<?php  echo $talk['openid'];?>",'op':'deleted'},
          dataType : 'json',
          success : function(data){
          	console.log(data)
              alert('消息清除成功');
              location.reload();
          }, 
        })
    })
  });
</script>

<script type="text/javascript">
  $(function(){
	 window.onload = function(){
	  	
	   setInterval(function(){
	      $.ajax({
	        url : "<?php  echo $this->createPluginMobileUrl('suppliermenu/talking')?>",
	        type :'post',
	        data :{'op':'liuyan','id':'<?php  echo $superior_id;?>','member_id':'<?php  echo $mid;?>'},
	        dataType : 'json',
	        success : function(data){   
	        console.log(data)     	
	              if(data.status){
	              	$('.artc-box').html("");
	              	for(var i=0;i<data.result.length;i++){
	              		if (data.result[i].sender=="member") {
	              			var myHtml="<div class='f-relative  Your'>"
										+"<img src='"
										+data.result[i].member_img
										+"'"
										+"' class='face faceYour'>"
										+"<p class='name f-tal'>"
										+data.result[i].member_name
										+"</p>"
										+"<div  class='neirong f-tal fl f-relative'>"
										+"<div id='triangle-left'></div>"
										+data.result[i].content
										+"</div>"
										+"<div class='f-cb'></div>"
									+"</div>"   
									   		 	
	              		   
	              		}else{
	              			var myHtml="<div class='f-relative My'>"
										+"<img src='../attachment/"
										+data.result[i].uid_img
										+"'"
										+"' class='face faceMy'>"
										+"<p class='name f-tar'>"
										+data.result[i].uid_name
										+"</p>"
										+"<div  class='neirong f-tar fr f-relative'>"
										+"<div id='triangle-right'></div>"
										+data.result[i].content
										+"</div>"
										+"<div class='f-cb'></div>"
									+"</div>"	              		 	
	              		}
	              		$('.artc-box').append(myHtml);

	              	}
	              
	                
	              }
	        }
	      })
	    },850);
	}
})

    $('#arearecord').click(function(){
      var contentss = $('#contentss').val();

      $.ajax({
        url : "<?php  echo $this->createPluginMobileUrl('suppliermenu/talking')?>",
        type :'post',
        data : {'content':contentss,'op':'send','id':'<?php  echo $superior_id;?>','member_id':'<?php  echo $mid;?>'},
        dataType : 'json',
        success : function(data){
            $(".artc-box").load(location.href+" .artc-box");
            $("#contentss").val("");
            var a=$(".artc-box").height();
            $(window).scrollTop(a);
        }
      })
    })


</script>
