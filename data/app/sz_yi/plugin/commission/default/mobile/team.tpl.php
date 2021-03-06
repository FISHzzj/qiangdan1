<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $this->set['texts']['myteam']?></title>
<script src="//cdn.bootcss.com/iScroll/5.1.3/iscroll.js"></script>
<style type="text/css">
    body { margin: 0px; background: #f2f2f2; font-family: '微软雅黑'; -moz-appearance: none; }
    a { text-decoration: none; }
    .team_top { height: 44px; width: 100%; background: #f2f2f2; border-bottom: 1px solid #eaeaea; }
    .team_top .title { height: 44px; width: auto; margin-left: 10px; float: left; font-size: 16px; line-height: 44px; color: #666; }
    .team_list_head { height: 46px; width: 100%; background: #fff; padding: 10px 3%; border-bottom: 1px solid #eaeaea; }
    .team_list_head .info { height: 20px; float: left; font-size: 16px; color: #666; line-height: 20px; text-align: left; }
    .team_list_head .info span { font-size: 14px; color: #999; }
    .team_list_head .num { height: 20px; float: right; text-align: right; font-size: 16px; color: #666; line-height: 20px; font-size: 14px; color: #999; }
    .team_list { height: 60px; width: 100%;padding: 10px 3%; }
    .team_list .img { width: 16%; height: 40px; float: left; text-align: left; }
    .team_list .img img { height: 40px; width: 40px; }
    .team_list .info { height: 40px; width: 40%; float: left; border-right: 1px solid #eaeaea; font-size: 16px; color: #666; line-height: 20px; text-align: left; }
    .liuyan { height: 40px; width: 40px; float: left; border: 1px solid #ff0000; text-align: center; line-height: 20px; font-size: 15px; color: #666; }
    .team_list .info span { font-size: 14px; color: #999; }
    .team_list .num { height: 40px; width: 23%; float: right; text-align: right; font-size: 16px; color: #666; line-height: 20px; }
    .team_list .num span { font-size: 14px; color: #999; }
    .team_tab { height: 30px; margin: 5px; border: 1px solid #ff6801; border-radius: 5px; overflow: hidden; font-size: 13px; background: #fff; padding-right: -2px; }
    .team_nav { height: 30px; background: #fff; color: #666; text-align: center; line-height: 30px; float: left; }
    .team_navon { color: #fff; background: #66B3FF; }
    .team_no { height: 100px; width: 100%; margin: 50px 0px 60px; color: #ccc; font-size: 12px; text-align: center; }
    #team_loading { padding: 10px; color: #666; text-align: center; }
    .headerRightIcon{position: absolute;right: 10px;top:0px;}	
</style>
<script src="//cdn.bootcss.com/jquery.touchswipe/1.5.1/jquery.touchswipe.min.js"></script>
<style type="text/css">
.diseaseMenu {width:100%;height:80px;line-height:80px;background-color:#FFF;-moz-box-shadow:0 0 8px rgba(34,23,20,.5);-webkit-box-shadow:0 0 8px rgba(34,23,20,.5);box-shadow:0 0 8px rgba(34,23,20,.5);overflow:hidden;}
.menuScroll1_lists {width:100%;height:80px;overflow:hidden;}
.menuScroll1_lists li {float:left;height:80px;line-height:80px;}
.menuScroll1_lists li a {display:block;width:100%;height:100%;font-size:30px;color:#2e3642;}
.menuScroll1_lists li a span {display:block;padding:0 10px;height:100%;border-bottom:6px solid #fff}
.menuScroll1_lists li.active a span {border-bottom:6px solid #d70a50;}
@media screen and (min-width:320px) and (max-width:900px) {
.diseaseMenu {height:56px;line-height:40px;width: 100%;}
.menuScroll1_lists {height:40px;width:720px;}
.menuScroll1_lists li {height:40px;line-height:40px;width: 80px}
.menuScroll1_lists li a {font-size:16px;}
.menuScroll1_lists li a span {padding:0 5px;border-bottom:3px solid #fff}
.menuScroll1_lists li.active a span {border-bottom:3px solid #d70a50}
	}

</style>
<!-- <div class="team_top">
    <div class="title" onclick='history.back()'><i class='fa fa-chevron-left'></i> <?php  echo $this->set['texts']['myteam']?>(<?php  echo $total;?>)</div>
</div> -->
<div class="page_topbar">
    <a href=" " class="back" onclick="history.back()">
        <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
     </a>
    <div class="title" style=" color: #282828;"><?php  echo $this->set['texts']['myteam']?>(<?php  echo $total;?>)
    </div>
  <a href="#">
      <i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i>
  </a>
</div>
<?php  if($total>0) { ?>
	<div class="diseaseMenu menus relative" id="diseaseMenu">
		<div class="menuScroll1 menuScroll absolute" id="menuScroll">
			<ul class="menuScroll1_lists clearfix">
				<li class="team_nav team_navon" data-level='1' ><?php  echo $this->set['texts']['c1']?>(<?php  echo $level1;?>)</li>
				<?php  if($this->set['level']>=2) { ?><li class="team_nav" data-level='2'><?php  echo $this->set['texts']['c2']?>(<?php  echo $level2;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=3) { ?><li class="team_nav" data-level='3'><?php  echo $this->set['texts']['c3']?>(<?php  echo $level3;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=4) { ?><li class="team_nav" data-level='4'><?php  echo $this->set['texts']['c4']?>(<?php  echo $level4;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=5) { ?><li class="team_nav" data-level='5'><?php  echo $this->set['texts']['c5']?>(<?php  echo $level5;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=6) { ?><li class="team_nav" data-level='6'><?php  echo $this->set['texts']['c6']?>(<?php  echo $level6;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=7) { ?><li class="team_nav" data-level='7'><?php  echo $this->set['texts']['c7']?>(<?php  echo $level7;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=8) { ?><li class="team_nav" data-level='8'><?php  echo $this->set['texts']['c8']?>(<?php  echo $level8;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=9) { ?><li class="team_nav" data-level='9'><?php  echo $this->set['texts']['c9']?>(<?php  echo $level9;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=10) { ?><li class="team_nav" data-level='10' ><?php  echo $this->set['texts']['c10']?>(<?php  echo $level10;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=11) { ?><li class="team_nav" data-level='11'><?php  echo $this->set['texts']['c11']?>(<?php  echo $level11;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=12) { ?><li class="team_nav" data-level='12'><?php  echo $this->set['texts']['c12']?>(<?php  echo $level12;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=13) { ?><li class="team_nav" data-level='13'><?php  echo $this->set['texts']['c13']?>(<?php  echo $level13;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=14) { ?><li class="team_nav" data-level='14'><?php  echo $this->set['texts']['c14']?>(<?php  echo $level14;?>)</li><?php  } ?>
				<?php  if($this->set['level']>=15) { ?><li class="team_nav" data-level='15'><?php  echo $this->set['texts']['c15']?>(<?php  echo $level15;?>)</li><?php  } ?>
			</ul>
		</div>
	</div>
<?php  } ?>
<?php  if($total==10000) { ?>
	<div class="team_tab" >
		<div class="team_nav team_navon" data-level='1'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c1']?>(<?php  echo $level1;?>)</div>
		<?php  if($this->set['level']>=2) { ?><div class="team_nav" data-level='2'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c2']?>(<?php  echo $level2;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=3) { ?><div class="team_nav" data-level='3'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c3']?>(<?php  echo $level3;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=4) { ?><div class="team_nav" data-level='4'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c4']?>(<?php  echo $level4;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=5) { ?><div class="team_nav" data-level='5'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c5']?>(<?php  echo $level5;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=6) { ?><div class="team_nav" data-level='6'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c6']?>(<?php  echo $level6;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=7) { ?><div class="team_nav" data-level='7'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c7']?>(<?php  echo $level7;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=8) { ?><div class="team_nav" data-level='8'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c8']?>(<?php  echo $level8;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=9) { ?><div class="team_nav" data-level='9'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c9']?>(<?php  echo $level9;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=10) { ?><div class="team_nav" data-level='10'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c10']?>(<?php  echo $level10;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=11) { ?><div class="team_nav" data-level='11'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c11']?>(<?php  echo $level11;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=12) { ?><div class="team_nav" data-level='12'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c12']?>(<?php  echo $level12;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=13) { ?><div class="team_nav" data-level='13'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c13']?>(<?php  echo $level13;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=14) { ?><div class="team_nav" data-level='14'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c14']?>(<?php  echo $level14;?>)</div><?php  } ?>
		<?php  if($this->set['level']>=15) { ?><div class="team_nav" data-level='15'  style='width:<?php  echo $tabwidth;?>%'><?php  echo $this->set['texts']['c15']?>(<?php  echo $level15;?>)</div><?php  } ?>
	</div>
<?php  } ?>
<div class="team_list_head">
        <div class="info">成员信息</div>
        <div class="num">TA的<?php  echo $this->set['texts']['commission']?>/成员</div>
</div>
<div id='container' style="width: 100%;background: #fff;height: auto;"></div>

<script id='tpl_team' type='text/html'>
    
    <%each list as user%>
    <div class="team_list">
        <div class="img">
			<img src="<%if user.nickname%><%user.avatar%><%else%>../addons/sz_yi/plugin/commission/images/head.jpg<%/if%>">
		</div>
        <div class="info">
			<%if user.nickname%><%user.nickname%><%else%>未获取<%/if%>
			<br>
			<span><%user.agenttime%></span>
		</div>
		<?php  if($this->set['liuyan'] == 1) { ?>
		<a href="<?php  echo $this->createPluginMobileUrl('commission/team',array('op'=>'liuyan','sender'=>'superior'))?>&id=<%user.id%>">
			<div class="liuyan">给Ta</br>留言</div>
		</a>
		<?php  } ?>
        <div class="num">+<%user.commission_total%><br><span><%user.agentcount%> 个成员</span></div>
    </div>
    <%/each%>
</script>
<!--<div class="team_no"><i class="fa fa-users" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">您还没有相关成员~</span></div>-->
<script id='tpl_empty' type='text/html'>
    <div style="padding-top:120px;width:190px;margin:0 auto;">
    	<img style="width:60px;display:block;margin:0 auto;" src="../addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/Customer.png" alt="">
    	<span style="display:block;margin-top: 18px; text-align:center;">暂时还没有团队~</span></br>   	
	</div
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
							core.pjson('commission/team', {level:current_level,page: page}, function (morejson) {
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
            core.pjson('commission/team', {level: level, page: page}, function (json) {
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
