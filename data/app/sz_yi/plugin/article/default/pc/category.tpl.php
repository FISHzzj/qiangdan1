<?php defined('IN_IA') or exit('Access Denied');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php  if(empty($article_sys['article_title'])) { ?>全部文章<?php  } else { ?><?php  echo $article_sys['article_title'];?><?php  } ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
<meta name="format-detection" content="telephone=no" />
<link href="../addons/sz_yi/plugin/article/template/imgsrc/mobile.css" rel="stylesheet">
<script type="text/javascript" src="../addons/sz_yi/static/js/dist/jquery-1.11.1.min.js"></script>


<body class="<?php  if($article_sys['article_temp']==0) { ?>t1<?php  } else if($article_sys['article_temp']==1) { ?>t2<?php  } else if($article_sys['article_temp']==2) { ?>t3<?php  } ?>">

    <div class="topbar" style="position: inherit;">
        <div class="block"></div>
        <div class="menu-main">
            <nav cid="0" class="f_cate ccate0 on" onclick="artcate(0,1)">全部分类</nav>
            <?php  if(is_array($first_category)) { foreach($first_category as $i => $category) { ?>
                <nav class="f_cate ccate<?php  echo $category['id'];?>" onclick="artcate(<?php  echo $category['id'];?>,1)"><?php  echo $category['category_name'];?></nav>
            <?php  } } ?>
        </div>
    </div>
    <?php  if($article_sys['article_category'] >= 2 && !empty($second_category)) { ?>
    <div class="topbar" style="position: inherit;">
        <div class="block"></div>
        <div class="menu-main">
            <?php  if(is_array($second_category)) { foreach($second_category as $i => $category) { ?>
                <nav class="ccate<?php  echo $category['id'];?>" cid="<?php  echo $category['id'];?>" onclick="artcate(<?php  echo $category['id'];?>,2)"><?php  echo $category['category_name'];?></nav>
            <?php  } } ?>
        </div>
    </div>
    <?php  } ?>
    <?php  if($article_sys['article_category'] >= 3 && !empty($third_category)) { ?>
    <div class="topbar" style="position: inherit;">
        <div class="block"></div>
        <div class="menu-main">
            <?php  if(is_array($third_category)) { foreach($third_category as $i => $category) { ?>
                <nav class="ccate<?php  echo $category['id'];?>" cid="<?php  echo $category['id'];?>" onclick="artcate(<?php  echo $category['id'];?>,3)"><?php  echo $category['category_name'];?></nav>
            <?php  } } ?>
        </div>
    </div>
    <?php  } ?>
    <div class="list" style="margin-top: 0px;">
            <?php  if(is_array($articles)) { foreach($articles as $article) { ?>
                <a href="<?php  echo $this->createPluginMobileUrl('article',array('aid'=>$article['id']))?>">
                    <div class="line-main">
                        <div class="line"> 
                            <div class="img">
                                <?php  if(!empty($article['resp_img'])) { ?>
                                    <img src="<?php  echo $article['resp_img'];?>"/>
                                <?php  } else { ?>
                                    <p style='line-height: 12px; font-size: 12px; padding: 6px; text-align: center; color: #999;'>no img</p>
                                <?php  } ?>
                            </div>
                            <div class="info" >
                                <div class="title"><?php  echo $article['article_title'];?></div>
                                <div class="ico-main">
                                       <div class="ico" style="font-size: 10px;height: 24px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                            <?php  echo $article['resp_desc'];?>
                                       </div>
                                   </div>
                                <div class="ico-main" style="top: 0;">
                                     <div class="ico" style="font-size: 8px;">
                                         作者:<?php  if(!empty($article['article_author'])) { ?><?php  echo $article['article_author'];?><?php  } else { ?>佚名<?php  } ?> 时间:<?php  echo $article['article_date'];?>
                                     </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php  } } ?>
    </div>

<script>
function artcate(cid,type){
	location.href = "<?php  echo $this->createPluginMobileUrl('article',array('method'=>'category'))?>&cid="+cid+"&type="+type;
	return false;
}
$(function(){
	var now_cid = "<?php  echo $_GPC['cid'];?>";
	if(now_cid){
		$(".f_cate").removeClass('on');
		$('.ccate'+now_cid).addClass('on');
	}else{
		$('.ccate0').addClass('on');
	}
	$(".f_cate").click(function(){
		$(".f_cate").removeClass('on');
		$(this).addClass('on');
	});
}); 
</script>
<script>
//下拉加载
var range = 50; //距下边界长度/单位px
var page = 1;
var totalheight = 0;
var loading = false;
$(window).scroll(function(){
	if(loading) return;
	var now_cid ="<?php  echo $_GPC['cid'];?>";
	var now_type ="<?php  echo $_GPC['type'];?>";
    var srollPos = $(window).scrollTop(); //滚动条距顶部距离(页面超出窗口的高度)
    totalheight = parseFloat($(window).height()) + parseFloat(srollPos);
    if(($(document).height()-range) <= totalheight) {
    	loading = true;
    	page++;
    	$.ajax({
    		url:"<?php  echo $this->createPluginMobileUrl('article',array('method'=>'category','cid'=>$_GPC['cid'],'type'=>$_GPC['type']))?>",
    		type:'post',
    		data:{page:page},
    		success:function(data){
    			data = JSON.parse(data);
    			var host = window.location.host;
				host ="http://"+host;
   				var str = "";
   				var weid = "<?php  echo $_W['uniacid'];?>";
   				
    			if (data.status == 1) {
    				for (var i = 0, t; t = data.scenes[i++];) {
    					var list_url = host+'/app/index.php?i='+weid+'&c=entry&p=article&m=sz_yi&do=plugin&cid='+now_cid+'&type='+now_type+'&aid='+t.id;
						
                    if(!t.article_author){
                    	t.article_author = "佚名";
                    }
                    
                    str += '<a href="'+list_url+'">';
                    str += '<div class="line-main">';	
                    str += '<div class="line">';	
                    str += '<div class="img">';	
                    str += '<img src="'+t.resp_img+'"/>';	
                    str += '</div>';	
                    str += '<div class="info" >';	
                    str += '<div class="title">'+t.article_title+'</div>';	
                    str += '<div class="ico-main">';	
                    str += '<div class="ico" style="font-size: 10px;height: 24px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">';	
                    str += t.resp_desc;	
                    str += '</div>';	
                    str += '<div class="ico-main" style="top: 0;">';	
                    str += '<div class="ico" style="font-size: 8px;">';	
                    str += '作者:'+t.article_author+' 时间:'+t.article_date;
                    str += '</div>';	
                    str += '</div>';	
                    str += '</div>';	
                    str += '</div>';	
                    str += '</div>';	
                    str += '</a>';		
    					
    				}
    				loading = false;
    			} else {
   					loading = true;
    			}
    			$('.list').append(str);
    		
    		}
    	});
    }            
});

</script>
</body>
</html>
