<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script language="javascript" src="../addons/sz_yi/static/js/dist/jquery-1.11.1.min.js"></script>
    <title>站内聊天</title>
    <style>
body {
	margin: 0;
	padding: 0;
	background: #eee;
}
* {
	margin: 0;
	padding: 0;
	list-style: none;
	font-family: '微软雅黑'
}
#container {
	overflow-x: hidden;
	width: 100%;
}
.header {
	background: #000;
	height: 40px;
	width: 100%;
	color: #fff;
	line-height: 34px;
	font-size: 20px;
	padding: 0 10px;
}
.footer {
	width: 100%;
	height: 50px;
	background: #666;
	position: fixed;
	bottom: 0;
	padding: 10px;
}
.footer input {
	width: 60%;
	height: 45px;
	outline: none;
	font-size: 20px;
	text-indent: 10px;
	position: absolute;
	border-radius: 6px;
	right: 23%;
}
.footer span {
	display: inline-block;
	width: 15%;
	height: 48px;
	background: #ccc;
	font-weight: 900;
	line-height: 45px;
	cursor: pointer;
	text-align: center;
	position: absolute;
	right: 6%;
	border-radius: 6px;
}
.footer span:hover {
	color: #fff;
	background: #999;
}
#user_face_icon {
	display: inline-block;
	background: red;
	width: 13%;
	border-radius: 30px;
	position: absolute;
	bottom: 6px;
	left: 6px;
	cursor: pointer;
	overflow: hidden;
}
#user_face_icon img {
	width: 100%;
	height: 100%;
}
.content {
	display: block;
	font-size: 20px;
	width: 100%;
	padding: 5px;
	overflow: auto;
	bottom: 50px;
}
.content li {
	margin-top: 10px;
	padding-left: 10px;
	width: 95%;
	display: block;
	clear: both;
	overflow: hidden;
}
.content li img {
	float: left;
	width: 60px;
	height: 60px;
}
.content li span {
	background: #7cfc00;
	padding: 10px;
	border-radius: 10px;
	float: left;
	margin: 6px 10px 0 10px;
	max-width: 70%;
	border: 1px solid #ccc;
	box-shadow: 0 0 3px #ccc;
}
.content li img.imgleft {
	float: left;
}
.content li img.imgright {
	float: right;
}
.content li span.spanleft {
	float: left;
	background: #fff;
}
.content li span.spanright {
	float: right;
	background: #7cfc00;
}
</style>
    <script>   
        window.onload = function(){  	  
            var iNow    = "<?php  echo $iNow;?>";    //用来累加改变左右浮动    
            var icon    = document.getElementById('user_face_icon'); 
            var text    = document.getElementById('text');    
            var content = document.getElementsByTagName('ul')[0];    
            var img     = content.getElementsByTagName('img');    
			var span    = content.getElementsByTagName('span');    
			var content = document.getElementById('content');//获得元素
			content.style.height = window.screen.height-150+'px';
			
			icon.style.height = icon.offsetWidth+'px';
			content.scrollTop=content.scrollHeight;
            btn.onclick = function(){    
                if(text.value ==''){    
                    alert('不能发送空消息');    
               }else {
					$.ajax({ 
						url:"<?php  echo $this->createPluginMobileUrl('commission/team',array('op'=>'liuyan','id'=>$_GET['id'],'sender'=>$sender))?>",  
					    data:{msg : text.value,lower_id : "<?php  echo $lower_id?>"},  
					    type:'POST',  
					    cache:false,  
					    dataType:'json',  
					    success:function(data) {					    	console.log(data);					    	
					        if(data.msg =="ok" ){  
								content.innerHTML += '<li><img src="'+"<?php  echo $user['avatar'];?>"+'"><span>'+text.value+'</span></li>';    
								iNow++;    
								img[iNow].className += 'imgright';    
								span[iNow].className += 'spanright';    
								text.value = '';    
								// 内容过多时,将滚动条放置到最底端    
								content.scrollTop=content.scrollHeight;      
							}else{
								alert(data.msg);
							}
						},  
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							alert(XMLHttpRequest.status);
							alert(XMLHttpRequest.readyState);
							alert(textStatus);
						},
						complete: function(XMLHttpRequest, textStatus) {
							this; // 调用本次AJAX请求时传递的options参数
						}
					}); 
                }    
            }    
        }    
    </script>
    </head>
    <body>
<?php  if($this->set['liuyan'] == 1) { ?>
<div id="container">
	<ul id="content" class="content">
    <?php  if(is_array($liuyan)) { foreach($liuyan as $v) { ?>
    <?php  if($v['sender'] == 'superior') { ?>
    <li><img src="<?php  echo $superior_img;?>" class="imgright"><span class="spanright"><?php  echo $v['content'];?></span></li>
    <?php  } else if($v['sender'] == 'lower') { ?>
    <li><img src="<?php  echo $lower_img;?>" class="imgleft"><span class="spanleft"><?php  echo $v['content'];?></span></li>
    <?php  } ?>
    <?php  } } ?>
	</ul>
</div>
<div class="footer">
	<div id="user_face_icon"> <img src="<?php  echo $user['avatar'];?>" alt=""> </div>
      <input id="text" type="text" placeholder="说点什么吧...">
	<span id="btn">发送</span> 
</div>
<?php  } ?>
</body>
</html>
