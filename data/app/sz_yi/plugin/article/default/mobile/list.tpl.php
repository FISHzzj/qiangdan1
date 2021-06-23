<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php  if(empty($article_sys['article_title'])) { ?>全部文章<?php  } else { ?><?php  echo $article_sys['article_title'];?><?php  } ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
<meta name="format-detection" content="telephone=no" />
<link href="../addons/sz_yi/plugin/article/template/imgsrc/mobile.css" rel="stylesheet">
<script type="text/javascript" src="../addons/sz_yi/static/js/dist/jquery-1.11.1.min.js"></script>
<script>
    $(function(){
        var page = 2;
        var temp ="<?php  echo $article_sys['article_temp'];?>";
        var lock = 0;
        $("#add-more").click(function(){
            if(lock==0){
                if(temp==2){
                    cate = $(".add-more").attr("cid");
                }
                $(this).text("加载中...");
                lock = 1;
                $.post("<?php  echo $this->createPluginMobileUrl('article',array('method'=>'api','apido'=>'addmore'))?>", {page:page<?php  if($article_sys['article_temp']==2) { ?>,cate:cate<?php  } ?>} ,function(result){
                    if(result){
                        page++;
                        if(temp==0 || temp==2){
                            $(".list").append(result);
                        }
                        else if (temp==1){
                            $(".append").append(result);
                        }
                        $("#add-more").text('加载更多');
                    }else{
                        $("#add-more").text('没有更多了...');
                    }
                    lock = 0;
                });
            }
        });
        
<?php  if($article_sys['article_temp']==2) { ?>
        var _height = $(window).height();
        var _height = parseInt(_height)-100;
        add(0,_height,this);
        $("nav").click(function(){
            var thiscid = $(this).attr("cid");
            if(temp==2){
                $(".add-more").attr("cid",thiscid);
                page = 2;
                $("#add-more").text('加载更多');
            }
            add(thiscid,_height,this);
        });
 <?php  } ?>
        
    });
<?php  if($article_sys['article_temp']==2) { ?>
    function add(thiscid,_height,obj){
            $(".add-more").attr("cid",thiscid)
            $("nav[cid="+thiscid+"]").addClass("on").siblings().removeClass("on");
            $(".list").html("<p style='line-height:"+_height+"px; text-align:center;'>正在载入...</p>");
            $(".add-more").hide();
            $.post("<?php  echo $this->createPluginMobileUrl('article',array('method'=>'api','apido'=>'selectarticle'))?>", {cid:thiscid} ,function(result){
                if(result){
                    $(".list").html(result);
                    $(".add-more").show();
                }else{
                     $(".list").html("<p style='line-height:"+_height+"px; text-align:center;'>该分类还没有添加文章...</p>");
                }
            });
            <?php  if($article_sys['article_category']==2) { ?>
            if(thiscid != 0){
            	var s_len = $(".second_cate"+thiscid).length;
            	console.log(s_len);
            	if(s_len != 0){
            		$('.secondcategory').show();
                	$('.scate').hide();
                    $(".second_cate"+thiscid).show();
            	}else{
            		if($('.secondcategory').is(":visible")){
            			$('.secondcategory').hide();
            		}
            		$(obj).parents('.topbar').show();
            	}
            }
            <?php  } ?>
           	<?php  if($article_sys['article_category']==3) { ?>
           	if(thiscid != 0){
           		var t_len = $(".third_cate"+thiscid).length;
           		if(t_len != 0){
           			$('.thirdcategory').show();
    	           	$('.tcate').hide();
    	            $(".third_cate"+thiscid).show();
           		}else{
           			if($('.thirdcategory').is(":visible")){
            			$('.thirdcategory').hide();
            		}
           			$(obj).parents('.topbar').show();
           		}
           	}
            <?php  } ?>
    }
 <?php  } ?>
</script>

</head>

<body class="<?php  if($article_sys['article_temp']==0) { ?>t1<?php  } else if($article_sys['article_temp']==1) { ?>t2<?php  } else if($article_sys['article_temp']==2) { ?>t3<?php  } ?>">
<?php  if($article_sys['article_temp']==0) { ?>
    <div class="main">
        <?php  if(!empty($article_sys['article_image'])) { ?>
            <div class="banner">
                <img src="<?php  echo $article_sys['article_image'];?>"/>
            </div>
        <?php  } ?>
        <div class="list">
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
                                <div class="ico-main" style="top: 0;">
                                     <div class="ico">
                                         作者:<?php  if(!empty($article['article_author'])) { ?><?php  echo $article['article_author'];?><?php  } else { ?>佚名<?php  } ?> 时间:<?php  echo $article['article_date'];?>
                                     </div>
                                 </div>
                                <?php  if($article['article_rule_money']>0 || !empty($article['article_rule_credit'])) { ?>
                                    <div class="ico-main">
                                        <div class="ico">
                                            <?php  if($article['article_rule_money']>0) { ?>
                                                <?php  echo $article['article_rule_money'];?>元余额
                                            <?php  } ?>
                                            <?php  if(!empty($article['article_rule_credit'])) { ?>
                                                <?php  echo $article['article_rule_credit'];?>个积分
                                            <?php  } ?>
                                        </div>
                                    </div>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php  } } ?>
        </div>
    </div>
<?php  } else if($article_sys['article_temp']==1) { ?> 
        <?php  if(is_array($articles)) { foreach($articles as $k => $v) { ?>
            <div class="list">
                <div class="date"><?php  echo $k;?></div>
                    <?php  if(count($v['articles'])==1) { ?>
                        <a href="<?php  echo $this->createPluginMobileUrl('article',array('aid'=>$v['articles'][0]['id']))?>">
                            <div class="title"><?php  echo $v['articles'][0]['article_title'];?></div>
                            <div class="img"><img src="<?php  echo $v['articles'][0]['resp_img'];?>" /></div>
                            <div class="desc"><?php  echo $v['articles'][0]['resp_desc'];?></div>
                            <div class="read">
                                <span class="left">阅读原文</span>
                                <span class="right"><span class="ico"></span></span>
                            </div>
                        </a>
                    <?php  } else { ?>
                        <?php  if(is_array($v['articles'])) { foreach($v['articles'] as $index => $vv) { ?>
                            <?php  if($index==0) { ?>
                                <a href="<?php  echo $this->createPluginMobileUrl('article',array('aid'=>$vv['id']))?>">
                                    <div class="img">
                                        <img src="<?php  echo $vv['resp_img'];?>" />
                                        <div class="img-title"><p><?php  echo $vv['article_title'];?></p></div>
                                    </div>
                                </a>
                            <?php  } else { ?>
                                <a href="<?php  echo $this->createPluginMobileUrl('article',array('aid'=>$vv['id']))?>">
                                    <div class="line">
                                        <div class="icon"><img src="<?php  echo $vv['resp_img'];?>" /></div>
                                        <div class="title"><?php  echo $vv['article_title'];?></div>
                                    </div>
                                </a>
                            <?php  } ?>
                        <?php  } } ?>
                    <?php  } ?>
            </div>
        <?php  } } ?>	 
        <div class="append"></div>
<?php  } else if($article_sys['article_temp']==2) { ?> 
    <div class="topbar" style="position: inherit;">
        <div class="block"></div>
        <div class="menu-main">
            <nav cid="0" class="on">全部分类</nav>
            <?php  if(is_array($categorys)) { foreach($categorys as $i => $category) { ?>
                <nav cid="<?php  echo $category['id'];?>"><?php  echo $category['category_name'];?></nav>
            <?php  } } ?>
        </div>
    </div>
    <div class="topbar secondcategory" style="position: inherit;display:none;">
        <div class="block"></div>
        <div class="menu-main">
            <?php  if(is_array($second_cates)) { foreach($second_cates as $s) { ?>
                <nav cid="<?php  echo $s['id'];?>" class="scate second_cate<?php  echo $s['pid'];?>" style="display:none;"><?php  echo $s['category_name'];?></nav>
            <?php  } } ?>
        </div>
    </div>
    <div class="topbar thirdcategory" style="position: inherit;display:none;">
        <div class="block"></div>
        <div class="menu-main">
            <?php  if(is_array($third_cates)) { foreach($third_cates as $s) { ?>
                <nav cid="<?php  echo $s['id'];?>" class="tcate third_cate<?php  echo $s['gid'];?>" style="display:none;"><?php  echo $s['category_name'];?></nav>
            <?php  } } ?>
        </div>
    </div>
    <div class="list" style="margin-top: 0px;"></div>
<?php  } ?>
    <div class="add-more" <?php  if($article_sys['article_temp']==2) { ?> style="height: 40px"<?php  } ?>><a id="add-more" href="javascript:;">加载更多</a></div>
</body>
</html>
