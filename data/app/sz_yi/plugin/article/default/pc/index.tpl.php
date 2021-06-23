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
.t1 .main .list .line-main .line .info .ico-main{color: #333;}
.rightlist{background:none;}
.t1 .main .list .line-main .line .info .ico-main .ico{background: white;}
.rich_biaoqian{margin:0px -15px;line-height: 35px;border-bottom: 1px solid #ddd;padding:0 15px;}
.rich_biaoqian>a{font-size: 16px;color: #282828;font-weight: bold;}
.rich_biaoqian>span{font-size: 16px;color: #282828;margin:0 5px;font-weight: bold;}
.container_left {width: 80%;float: left;overflow: hidden;}
.rich_primary{width: 102%;/* height: 1194px;overflow-y: scroll;overflow-x: hidden; */}
.container_right {height:auto;width: 19%; background: #fff;float: right;padding-bottom: 30px;}
.container_right>h4{font-weight:100;width: 100%;line-height:30px;padding:0 20px;font-size: 14px;padding-top: 10px;border-bottom: 1px solid #ddd;}
.container_right>ul li a{text-align: left;margin: 20px 0;font-size: 12px;overflow:hidden;text-overflow:ellipsis;display:-webkit-box; -webkit-box-orient:vertical;-webkit-line-clamp:1; }
.container_right>ul{padding:20px;}
.container_right>ul li a>span{color:#f80a0a;display: inline-block;height: 100%;}
</style>
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
   <div id="container" class="rightlist clearfix">
        <div class="container_left">
            <div class="rich_primary all-divbox">
            <!--  <div class="rich_biaoqian"><a href="#">文章中心</a><span>></span><a href="#">文章内容</a></div> -->
                <div class="rich_title"><?php  echo $article['article_title'];?></div>
                <div class="rich_mate">
                    <div class="rich_mate_text"><?php  echo $article['article_date_v'];?></div>
                    <div class="rich_mate_text"></div>
                    <a href="<?php  if(!empty($shop['share']['followurl'])) { ?><?php  echo $shop['share']['followurl'];?><?php  } else { ?>javascript:;<?php  } ?>">
                    <div class="rich_mate_text href"><?php  echo $article['article_mp'];?></div></a>
                </div>
                <div class="rich_content">
                   <?php  echo htmlspecialchars_decode($article['article_content'])?>
                    <div class="rich_tool"></div>
                <!--如果设定的任务总金额显示@phpdb.net-->
                </div>

            </div>
        </div>
        <div class="container_right">
            <h4>推荐文章</h4>
            <ul>
                <?php  if(is_array($articletui)) { foreach($articletui as $index => $va) { ?>
                  <li><a href="<?php  echo $this->createPluginMobileUrl('article',array('aid'=>$va['id']))?>"><span><?php  echo $index+1?>、</span><?php  echo $va['article_title'];?></a></li>
                <?php  } } ?>
            </ul>
        </div>

</body>
</html>
