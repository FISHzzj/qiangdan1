<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php  if(empty($article_sys['article_title'])) { ?>全部文章<?php  } else { ?><?php  echo $article_sys['article_title'];?><?php  } ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
<meta name="format-detection" content="telephone=no" />
<link href="../addons/sz_yi/plugin/article/template/imgsrc/pc.css" rel="stylesheet">
<style type="text/css">
.t1{padding: 0}
.t1 .main .list .line-main .line .info{padding-left: 0px;}
.info-article{text-indent: 25px;}
.all-divbox{width: 100%;}
.t1 .main .list a{ display: block; height: 100px; }
.t1 .main .list .line-main .line .info .ico-main{color: #333;}
.t1 .main .list .line-main .line .info .ico-main .ico{background: white;}
.rich_biaoqian{padding: 15px 0;line-height: 35px;border-bottom: 1px solid #ddd;padding:0 15px;}
.rich_biaoqian>a{font-size: 16px;color: #282828;font-weight: bold;}
.rich_biaoqian>span{font-size: 16px;color: #282828;margin:0 5px;font-weight: bold;}
.t3 .list .line{height: 95px}
.t3 .list{margin-top: 0px;}
</style>
<script type="text/javascript" src="../addons/sz_yi/static/js/dist/jquery-1.11.1.min.js"></script>
<script>
    $(function(){
        var page = 2;
        var temp ="<?php  echo $article_sys['article_temp'];?>";
        var lock = 0;
        $("#add-more").click(function(){
            // alert(1);
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
        add(0,_height);
        $("nav").click(function(){
            var thiscid = $(this).attr("cid");
            if(temp==2){
                $(".add-more").attr("cid",thiscid);
                page = 2;
                $("#add-more").text('加载更多');
            }
            add(thiscid,_height);
        });
 <?php  } ?>

    });
<?php  if($article_sys['article_temp']==2) { ?>
    function add(thiscid,_height){
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
    }
 <?php  } ?>
</script>

</head>

<body class="<?php  if($article_sys['article_temp']==0) { ?>t1<?php  } else if($article_sys['article_temp']==1) { ?>t2<?php  } else if($article_sys['article_temp']==2) { ?>t3<?php  } ?>">
<div id="container" class="rightlist">
<!--  <div class="rich_biaoqian"><a href="#">文章中心</a><span>></span><a href="#">文章内容</a></div> -->
<div class="page_topbar">
        <div class="title">文章中心</div>
</div>
<?php  if($article_sys['article_temp']==0) { ?>
    <div class="all-divbox">
    <div class="main">
        <div class="list" >
            <?php  if(is_array($articles)) { foreach($articles as $article) { ?>
                <a href="<?php  echo $this->createPluginMobileUrl('article',array('aid'=>$article['id']))?>">
                    <div class="line-main" style=" height: 80px;">
                        <div class="line">
                            <div class="info" >
                                <div class="title" style="position: relative;"><?php  echo $article['article_title'];?>
                                    <!-- <div class="ico-main">
                                        <div class="ico">
                                            <?php  if($article['article_rule_money']>0) { ?>
                                                <?php  echo $article['article_rule_money'];?>元余额
                                            <?php  } ?>
                                            <?php  if(!empty($article['article_rule_credit'])) { ?>
                                                <?php  echo $article['article_rule_credit'];?>个积分
                                            <?php  } ?>
                                        </div>
                                    </div> -->

                                    <div class="ico" style="float: right;margin-right: 10px;color:#b3b2b2">
                                        时间：<?php  echo $article['article_date']?>
                                    </div>
                                    <div class="ico" style="float: right;margin-right: 20px;color:#b3b2b2">
                                        作者：
                                        <?php  if($article['article_author'] == '') { ?>
                                            佚名
                                        <?php  } else { ?>
                                            <?php  echo $article['article_author'];?>
                                        <?php  } ?>
                                    </div>
                                </div>
                                <div class="info-article">

                                </div>
                                <?php  if($article['article_rule_money']>0 || !empty($article['article_rule_credit'])) { ?>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php  } } ?>
        </div>
    </div>
    <div id="add-more" class="add-more"  <?php  if($article_sys['article_temp']==2) { ?> style="height: 140px;"<?php  } ?>>
        加载更多</div>
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
    <!-- <div class="topbar">
        <div class="block"></div>
        <div class="menu-main">
            <nav cid="0" class="on">全部分类</nav>
            <?php  if(is_array($categorys)) { foreach($categorys as $i => $category) { ?>
                <nav cid="<?php  echo $category['id'];?>"><?php  echo $category['category_name'];?></nav>
            <?php  } } ?>
        </div>
    </div> -->
    <div class="list"></div>
</div>
<?php  } ?>
  </div>
</body>
</html>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>