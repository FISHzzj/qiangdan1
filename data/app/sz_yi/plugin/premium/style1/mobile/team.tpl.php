<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $this->set['texts']['myteam']?></title>
<script src="//cdn.bootcss.com/iScroll/5.1.3/iscroll.js"></script>
<script type="text/javascript">

</script>

<style type="text/css">
    body {margin:0px; background:#eee; font-family:'微软雅黑'; -moz-appearance:none;}
    a {text-decoration:none;}
    .team_top {height:44px; width:100%;  background:#f8f8f8;  border-bottom:1px solid #e3e3e3;}
    .team_top .title {height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#666;}

    .team_list_head {height:40px; background:#fff; padding:10px 3%;border-bottom:1px solid #eaeaea;}
    .team_list_head .info {height:20px; width:60%; float:left;  font-size:16px; color:#666; line-height:20px; text-align:left;}
    .team_list_head .info span {font-size:14px; color:#999;}
    .team_list_head .num {height:20px; float:right; text-align:right; font-size:16px; color:#666; line-height:20px; font-size:14px; color:#999;}
    
    
    .team_list {height:60px; background:#fff; padding:10px 3%;}
    .team_list .img { width:16%; height:40px; float:left; text-align:left;}
    .team_list .img img {height:40px; width:40px; }
    
    .team_list .info {
		height:40px; 
		width:47%; 
		float:left; 
		border-right:1px solid #eaeaea; 
		font-size:16px; 
		color:#666; 
		line-height:20px; 
		text-align:left;
	}
	.liuyan{
		height:40px; 
		width:40px;
		float:left;
		border:1px solid #ff0000;
		text-align:center;
		line-height:20px;
		font-size:15px; 
		color:#666;
	}
    .team_list .info span {font-size:14px; color:#999;}
    .team_list .num {height:40px; width:23%; float:right; text-align:right; font-size:16px; color:#666; line-height:20px;}
    .team_list .num span {font-size:14px; color:#999;}
    .team_tab {height:30px; margin:5px; border:1px solid #00c1ff; border-radius:5px; overflow:hidden;font-size:13px;background:#fff;padding-right: -2px;}
    .team_nav {height:30px;  background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
    .team_navon {color:#fff; background:#00c1ff;}
    .team_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    #team_loading { padding:10px;color:#666;text-align: center;}

	
	
	

</style>
<script src="//cdn.bootcss.com/jquery.touchswipe/1.5.1/jquery.touchswipe.min.js"></script>
<style type="text/css">
.diseaseMenu {width:100%;height:80px;line-height:80px;background-color:#FFF;-moz-box-shadow:0 0 8px rgba(34,23,20,.5);-webkit-box-shadow:0 0 8px rgba(34,23,20,.5);box-shadow:0 0 8px rgba(34,23,20,.5);overflow:hidden;}
.menuScroll1_lists {width:100%;height:80px;overflow:hidden;}
.menuScroll1_lists li {float:left;height:80px;line-height:80px;padding:0 10px;}
.menuScroll1_lists li a {display:block;width:100%;height:100%;font-size:30px;color:#2e3642;}
.menuScroll1_lists li a span {display:block;padding:0 10px;height:100%;border-bottom:6px solid #fff}
.menuScroll1_lists li.active a span {border-bottom:6px solid #d70a50;}
@media screen and (min-width:320px) and (max-width:900px) {
.diseaseMenu {height:40px;line-height:40px;}
.menuScroll1_lists {height:40px;}
.menuScroll1_lists li {height:40px;line-height:40px;padding:0 20px;}
.menuScroll1_lists li a {font-size:16px;}
.menuScroll1_lists li a span {padding:0 5px;border-bottom:3px solid #fff}
.menuScroll1_lists li.active a span {border-bottom:3px solid #d70a50}
	}

</style>
<div class="team_top">
    <div class="title" onclick='history.back()'><i class='fa fa-chevron-left'></i> <?php  echo $this->set['texts']['myteam']?>(<?php  echo $total;?>)</div>
</div>
<?php  if($total>0) { ?>
	<div class="diseaseMenu menus relative" id="diseaseMenu">
		<div class="menuScroll1 menuScroll absolute" id="menuScroll">
			<ul class="menuScroll1_lists clearfix">

 

				<?php  for ($i=1; $i <= $set['level'] ; $i++) { ?>
                    <li class="team_nav <?php  if($i==1) { ?>team_navon<?php  } ?>" data-level='<?php  echo $i;?>'><?php  echo $this->set['texts']['c'.$i]?>(<?php  echo $level_arr[$i];?>)</li>
				<?php  }?>

			</ul>
		</div>
	</div>
<?php  } ?>
<?php  if($total==10000) { ?>
	<div class="team_tab" >
			<?php  for ($i=1; $i <= $set['level'] ; $i++) { ?>
                <div class="team_nav <?php  if($i==1) { ?>team_navon<?php  } ?>" data-level='$i'><?php  echo $this->set['texts']['c'.$i]?>(<?php  echo $level_arr[$i];?>)</div>
			<?php  }?>
	</div>
<?php  } ?>
<div class="team_list_head">
        <div class="info">成员信息</div>
        <div class="num">TA的<?php  echo $this->set['texts']['commission']?>/成员</div>
</div>
<div id='container'></div>

<script id='tpl_team' type='text/html'>
    
    <%each list as user%>
    <div class="team_list">
        <div class="img">
			<img src="<%if user.nickname%><%user.avatar%><%else%>../addons/sz_yi/plugin/premium/images/head.jpg<%/if%>">
		</div>
        <div class="info">
			<%if user.nickname%><%user.nickname%><%else%>未获取<%/if%>
			<br>
			<span><%user.agenttime%></span>
		</div>
		<?php  if($openmessage ) { ?>
		<a href="<?php  echo $this->createPluginMobileUrl('commission/team',array('op'=>'liuyan','sender'=>'superior'))?>&id=<%user.id%>">
			<div class="liuyan">给Ta</br>留言</div>
		</a>
		<?php  } ?>
        <div class="num">+<%user.commission_total%><br><span><%user.agentcount%> 个成员</span></div>
    </div>
    <%/each%>
</script>
<script id='tpl_empty' type='text/html'>
    <div class="team_no"><i class="fa fa-users" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">您还没有相关成员~</span></div>
</script>

<script language="javascript">
    var page = 1;
	var current_level = 1;
	//alert('123');
    require(['tpl', 'core'], function (tpl, core) {
		function bindScroller(){
				//加载更多
				var loaded = false;
				var stop = true;
				$(window).scroll(function () {
					if (loaded) {
						return;
					}
					$('#team_loading').remove();
					totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
					if ($(document).height() <= totalheight) {

						if (stop == true) {
							stop = false;
							$('#container').append('<div id="team_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
							page++;
							core.pjson('premium/team', {level:current_level,page: page}, function (morejson) {
								stop = true;
								$('#team_loading').remove();
								$("#container").append(tpl('tpl_team', morejson.result));
								if (morejson.result.list.length < morejson.result.pagesize) {
									$("#container").append('<div id="team_loading">已经加载完全部成员</div>');
									loaded = true;
									$(window).scroll = null;
									return;
								}
							}, true);
						}
					}
				});
		}
        function getTeam(level) {
            $('.team_nav').removeClass('team_navon');
            $('.team_nav[data-level=' + level + ']').addClass('team_navon');
            core.pjson('premium/team', {level: level, page: page}, function (json) {
                if (json.result.list.length <= 0) {
                    $('#container').html(tpl('tpl_empty'));
                    return;
                }
                $('#container').html(tpl('tpl_team', json.result));
                bindScroller();
            }, true);
        }
		$('.team_nav').unbind('click').click(function () {
			page = 1; current_level = $(this).data('level')
			getTeam(current_level);
		});
		$(function() {
			var myScroll2=null;
			
			function menuInit(){
				var _menuScroll = $(".menuScroll");
				var _menuScroll_size = _menuScroll.find("li").length;
				var liWidth = 0;					
				$(".menuScroll li").each(function(){
					liWidth =$(this).outerWidth()*_menuScroll_size;
				});
				_menuScroll.css({width:liWidth+1+'px'});

				myScroll2=new IScroll(".menus",{
					ventPassthrough: true, 
					scrollX: true, 
					scrollY: false, 
					preventDefault:false
				});
				
			}
			menuInit();
			$(window).resize(function(){
					menuInit();
			});			
		})
        getTeam(1);
    })
</script>
<?php  $show_footer=true?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
