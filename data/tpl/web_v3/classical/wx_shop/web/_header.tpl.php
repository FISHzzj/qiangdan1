<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header_base', TEMPLATE_INCLUDEPATH)) : (include template('_header_base', TEMPLATE_INCLUDEPATH));?>

<?php  $system=m('system')->init()?>
<?php  $sysmenus = m('system')->getMenu(true)?>
<div class="wb-header" style="position: fixed;">
    <div class="logo <?php  if(!empty($system['foldnav'])) { ?>small<?php  } ?>">
        <?php  if(!empty($copyright) && !empty($copyright['logo'])) { ?>
            <img class='logo-img' src="<?php  echo tomedia($copyright['logo'])?>" onerror="this.src='../addons/wx_shop/static/images/nologo.png'"/>
        <?php  } ?>
    </div>
    <ul>
        
        <li class="wb-shortcut"><a id="showmenu"><i class="icow icow-list"></i></a></li>
        <li>
            <a href="<?php  echo webUrl()?>" data-toggle="tooltip" data-placement="bottom" title="管理首页"><i class="icow icow-homeL"></i></a>
        </li>
    </ul>
    <div class="wb-topbar-search expand-search">
        <form action="" id="topbar-search">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="wx_shop" />
            <input type="hidden" name="do" value="web" />
            <input type="hidden" name="r" value="search" />
           <!--  <div class="input-group">
                <input type="text" placeholder="请输入关键词进行功能搜索..." class="form-control wb-search-box" maxlength="15" name="keyword" <?php  if($system['merch']) { ?> data-merch="1"<?php  } ?> />
                <span class="input-group-btn">
                    <a class="btn wb-header-btn"><i class="icow icow-sousuo-sousuo"></i></a>
                </span>
            </div> -->
        </form>
        <div class="wb-search-result">
            <ul></ul>
        </div>
    </div>
    


    <?php  if(!$no_right) { ?>
        <div class="wb-panel <?php  if(empty($system['foldpanel'])) { ?>in<?php  } ?>">
            <div class="panel-group" id="panel-accordion">
                <?php if(cv('order.list.status1|order.list.status4')) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                           <!-- <a href="<?php  echo webUrl('finance.log.withdraw')?>"><i class="icow icow-dingdan"></i><div class="kongbai"></div><strong class="xiaoxi withdrawal">0</strong></a><span class="wb-panel-tip">提现审核</span> -->
                           <a href="<?php  echo webUrl('finance.sd_log.withdrawal')?>"><i class="icow icow-dingdan"></i><div class="kongbai"></div><strong class="xiaoxi withdrawal">0</strong></a><span class="wb-panel-tip">提现审核</span>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse <?php  if($_W['action']!='shop.comment' && $_W['routes']!='shop.index.notice' && ($_W['action']!='apply' && $_W['plugin']!='commission')) { ?>in<?php  } ?>" aria-labelledby="headingOne">
                        
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                           <!-- <a href="<?php  echo webUrl('finance.log.check')?>"><i class="icow icow-dingdan"></i><div class="kongbai"></div><strong class="xiaoxi recharge">0</strong></a><span class="wb-panel-tip">充值审核</span> -->
                           <a href="<?php  echo webUrl('finance.sd_log.recharge')?>"><i class="icow icow-dingdan"></i><div class="kongbai"></div><strong class="xiaoxi recharge">0</strong></a><span class="wb-panel-tip">充值审核</span>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse <?php  if($_W['action']!='shop.comment' && $_W['routes']!='shop.index.notice' && ($_W['action']!='apply' && $_W['plugin']!='commission')) { ?>in<?php  } ?>" aria-labelledby="headingOne">
                        
                    </div>
                </div>

            <!--     <div class="panel panel-default">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                           <a href="<?php  echo webUrl('abonus.agentsh')?>"><i class="icow icow-dingdan"></i><div class="kongbai"></div><strong class="xiaoxi dlxiaoxi">0</strong></a><span class="wb-panel-tip">代理审核</span>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse <?php  if($_W['action']!='shop.comment' && $_W['routes']!='shop.index.notice' && ($_W['action']!='apply' && $_W['plugin']!='commission')) { ?>in<?php  } ?>" aria-labelledby="headingOne">
                        
                    </div>
                </div> -->
       <!--           <div class="panel panel-default">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                           <a href="<?php  echo webUrl('finance.log.bzjjd')?>"><i class="icow icow-dingdan"></i><div class="kongbai"></div><strong class="xiaoxi yjxiaoxi">0</strong></a><span class="wb-panel-tip">押金解冻</span>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse <?php  if($_W['action']!='shop.comment' && $_W['routes']!='shop.index.notice' && ($_W['action']!='apply' && $_W['plugin']!='commission')) { ?>in<?php  } ?>" aria-labelledby="headingOne">
                        
                    </div>
                </div> -->
                <?php  } ?>
                <?php  if($system['notice']!='none' && !$system['merch']) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" >
                      <!--       <h4 class="panel-title">
                               <a href="<?php  echo webUrl('shop/notice')?>"><i class="icow icow-gonggao"></i><?php  if(!empty($system['notice'])) { ?><div class="kongbai"></div><strong class="xiaoxi"><?php  echo count($system['notice']) ?></strong><?php  } ?></a> <span class="wb-panel-tip">内部公告</span> 
                            </h4> -->
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in <?php  if($_W['routes']=='shop.index.notice') { ?>in<?php  } ?>" role="tabpanel" aria-labelledby="headingTwo">
                            <ul class="panel-body">
                                <?php  if(empty($system['notice'])) { ?>
                             <!--    <li class="panel-list small">
                                    <div class="panel-list-text text-center">暂无消息提醒</div>
                                </li> -->
                                <?php  } else { ?>
                                <?php  if(is_array($system['notice'])) { foreach($system['notice'] as $notice_item) { ?>
                                <li class="panel-list small">
                                    <a class="panel-list-text" href="javascript:;" data-toggle="ajaxModal" data-href="<?php  echo webUrl('shop/index/view', array('id'=>$notice_item['id']))?>" title="<?php  echo $notice_item['title'];?>"><?php  echo $notice_item['title'];?></a>
                                </li>
                                <?php  } } ?>
                                <li class="panel-list small" style="padding: 10px;">
                                    <a class="panel-list-text text-center" href="<?php  echo webUrl('shop/index/notice')?>"><span class="text-primary">查看更多</span></a>
                                </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </div>
                <?php  } ?>
                <?php  if(!$system['merch']) { ?>
                    <?php if(cv('commission.apply.view1|commission.apply.view2')) { ?>
                    <div class="panel panel-default">
                 <!--        <div class="panel-heading">
                            <h4 class="panel-title">
                               <a href="<?php  echo webUrl('finance/log/withdraw')?>"><i class="icow icow-yongjinmingxi"></i><?php  if(!empty($system['commission1']) || !empty($system['commission2'])) { ?><div class="kongbai"></div><strong class="xiaoxi"><?php  echo $system['commission1']+$system['commission2'] ?></strong><?php  } ?></a> <span class="wb-panel-tip">佣金提现</span> 
                            </h4>
                        </div> -->
                        <div id="collapseThree" class="panel-collapse collapse in <?php  if($_W['action']=='apply' && $_W['plugin']=='commission') { ?>in<?php  } ?>" role="tabpanel" aria-labelledby="headingFour">
                            <ul class="panel-body">
                                <?php  if(!empty($system['commission1'])) { ?>
                                <li class="panel-list">
                                    <a class="panel-list-text" href="<?php  echo webUrl('commission/apply', array('status'=>1))?>">待审核申请<span class="pull-right text-warning">(<?php  echo $system['commission1'];?>)</span></a>
                                </li>
                                <?php  } ?>
                                <?php  if(!empty($system['commission2'])) { ?>
                                <li class="panel-list">
                                    <a class="panel-list-text" href="<?php  echo webUrl('commission/apply', array('status'=>2))?>">待打款申请<span class="pull-right text-danger">(<?php  echo $system['commission2'];?>)</span></a>
                                </li>
                                <?php  } ?>
                                <?php  if(empty($system['commission1'])&&empty($system['commission2'])) { ?>
                               <!--  <li class="panel-list">
                                    <div class="panel-list-text text-center">暂无消息提醒</div>
                                </li> -->
                                <?php  } ?>
                            </ul>
                        </div>
                    </div>
                    <?php  } ?>
                <?php  } ?>
                <?php if(cv('shop.comment.edit')) { ?>
                <div class="panel panel-default">
            		<!-- <div class="panel-heading">
            			<h4 class="panel-title">
                            <a href="<?php  echo webUrl('shop/comment')?>"><i class="icow icow-pingjia"></i><?php  if(!empty($system['comment'])) { ?><div class="kongbai"></div><strong class="xiaoxi"><?php  echo $system['comment'] ?></strong><?php  } ?></a> 
                             <span class="wb-panel-tip">评价</span>
            		</div> -->
                    <div id="collapseFour" class="panel-collapse collapse in <?php  if($_W['action']=='shop.comment') { ?>in<?php  } ?>" role="tabpanel" aria-labelledby="headingFour">
                        <ul class="panel-body">
                            <?php  if(empty($system['comment'])) { ?>
                            <!-- <li class="panel-list">
                                <div class="panel-list-text text-center">暂无消息提醒</div>
                            </li> -->
                            <?php  } else { ?>
                            <li class="panel-list">
                                <a class="panel-list-text" href="<?php  echo webUrl('shop/comment')?>">待审核评价<span class="pull-right text-warning">(<?php  echo $system['comment'];?>)</span></a>
                            </li>
                            <?php  } ?>
                        </ul>
                    </div>
                </div>
                <?php  } ?>
                <!--系统更新-->
                <?php  if($_W['isfounder'] && $_W['routes']!='system.auth.upgrade') { ?>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFive" data-toggle="collapse" data-parent="#panel-accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                      <!--   <h4 class="panel-title">
                        	<a href="javascript:;"> <i class="icow icow-lingdang1"></i></a>
                        	<span class="wb-panel-tip">系统提示</span>
                           
                        </h4> -->
                    </div>
                   <!--  <div id="collapseFive" class="panel-collapse collapse <?php  if($_W['action']=='shop.comment') { ?>in<?php  } ?>" role="tabpanel" aria-labelledby="headingFour">
                        <ul class="panel-body">
                            <li class="panel-list">
                                <div class="panel-list-text nomsg">暂无消息提醒</div>
                                <div class="panel-list-text upmsg" style="display: none; max-height: none;">
                                    <div>检测到更新</div>
                                    <div>新版本 <span id="sysversion">------</span></div>
                                    <div>新版本 <span id="sysrelease">------</span></div>
                                    <div>
                                        <a class="text-primary" href="<?php  echo webUrl('system/auth/upgrade')?>">立即更新</a>
                                        <a class="text-warning" href="javascript:check_wx_shop_upgrade_hide();" style="margin-left: 15px;">暂不提醒</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> -->
                </div>
                <?php  } ?>
            </div>
        </div>
        <!-- <div class="wb-panel-fold <?php  if(empty($system['foldpanel'])) { ?>in<?php  } ?>"><?php  if(!empty($system['foldpanel'])) { ?><i class="icow icow-info"></i> 消息提醒<?php  } else { ?><i class="fa fa-angle-double-right"></i> 收起面板<?php  } ?></div> -->
    <?php  } ?>


   <!--  <div class="switch-version-box">
        <a class="switch-version" title="返回旧版"  href="javascript:;" onClick="javascript:history.back(-1);">返回上一页</a>

    </div> -->

    <ul>
        <?php  if($system['right_menu']['system']) { ?>
           <!--  <li data-toggle="tooltip" data-placement="bottom" title="系统管理">
                <a href="<?php  echo webUrl('system')?>"><i class="icow icow-syssetL"></i></a>
            </li> -->
        <?php  } ?>
        <li class="dropdown <?php  if($system['merch']) { ?>auto<?php  } ?>">
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php  echo $system['right_menu']['menu_title'];?></a>
            <ul class="dropdown-menu">
                <?php  if(is_array($system['right_menu']['menu_items'])) { foreach($system['right_menu']['menu_items'] as $right_menu_item) { ?>
                    <?php  if(!is_array($right_menu_item)) { ?>
                        <li class="divider"></li>
                    <?php  } else { ?>
                        <li><a href="<?php  echo $right_menu_item['href'];?>" <?php  if($right_menu_item['blank']) { ?>target="_blank"<?php  } ?>> <?php  echo $right_menu_item['text'];?></a></li>
                    <?php  } ?>
                <?php  } } ?>
            </ul>
        </li>
        <li data-toggle="tooltip" data-placement="bottom" title="退出登录" data-href="<?php  echo $system['right_menu']['logout'];?>">
            <a class="wb-header-logout"><i class="icow icow-exit"></i></a>
        </li>
    </ul>

    <div class="fast-nav <?php  if(!empty($system['foldnav'])) { ?>indent<?php  } ?>">
        <?php  if(!empty($system['history'])) { ?>
            <div class="fast-list history">
                <span class="title">最近访问</span>
                <?php  if(is_array($system['history'])) { foreach($system['history'] as $history_item) { ?>
                    <a href="<?php  echo $history_item['url'];?>"><?php  echo $history_item['title'];?></a>
                <?php  } } ?>
                <a href="javascript:;" id="btn-clear-history" <?php  if($system['merch']) { ?> data-merch="1"<?php  } ?>>清除最近访问</a>
            </div>
        <?php  } ?>
        <div class="fast-list menu">
            <span class="title">全部导航</span>
            <?php  if(is_array($sysmenus['shopmenu'])) { foreach($sysmenus['shopmenu'] as $index => $shopmenu) { ?>
                <a href="javascript:;" class="menu-active" <?php  if($index==0) { ?>class="active"<?php  } ?> data-tab="tab-<?php  echo $index;?>"><?php  echo $shopmenu['title'];?></a>
            <?php  } } ?>
            <?php  if(!empty($system['funbar']['open']) && empty($system['merch'])) { ?>
                <a href="javascript:;" class="bold" data-tab="funbar">自定义快捷导航</a>
            <?php  } ?>
        </div>
        <div class="fast-list list">
            <?php  if(is_array($sysmenus['shopmenu'])) { foreach($sysmenus['shopmenu'] as $index => $shopmenu) { ?>
                <div class="list-inner <?php  if($index==0) { ?>in<?php  } ?>" data-tab="tab-<?php  echo $index;?>">
                    <?php  if(is_array($shopmenu['items'])) { foreach($shopmenu['items'] as $shopmenu_item) { ?>
                        <a href="<?php  echo $shopmenu_item['url'];?>"><?php  echo $shopmenu_item['title'];?></a>
                    <?php  } } ?>
                </div>
            <?php  } } ?>
            <?php  if(!empty($system['funbar']['open']) && empty($system['merch'])) { ?>
                <div class="list-inner" data-tab="funbar" id="funbar-list">
                    <?php  if(is_array($system['funbar']['data'])) { foreach($system['funbar']['data'] as $funbar_item) { ?>
                        <a href="<?php  echo $funbar_item['href'];?>" style="<?php  if($funbar_item['bold']) { ?>font-weight: bold;<?php  } ?> color: <?php  echo $funbar_item['color'];?>;"><?php  echo $funbar_item['text'];?></a>
                    <?php  } } ?>
                    <a href="javascript:;" class="text-center funbar-add-btn"><i class="fa fa-plus"></i> 添加快捷导航</a>
                    <?php  if(!empty($system['funbar']['data'])) { ?>
                        <a href="<?php  echo webUrl('sysset/funbar')?>" class="text-center funbar-add-btn"><i class="fa fa-edit"></i> 编辑快捷导航</a>
                    <?php  } ?>
                    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('funbar', TEMPLATE_INCLUDEPATH)) : (include template('funbar', TEMPLATE_INCLUDEPATH));?>
                </div>
            <?php  } ?>
        </div>
    </div>
</div>


    <!-- 一级导航 -->
    <div class="wb-nav <?php  if(!empty($system['foldnav'])) { ?>fold<?php  } ?>">
        <p class="wb-nav-fold"><i class="icow icow-zhedie"></i></p>
        <ul>
            <?php  if(is_array($sysmenus['menu'])) { foreach($sysmenus['menu'] as $sysmenu) { ?>
                <li <?php  if($sysmenu['active']) { ?>class="active"<?php  } ?>>
                    <a href="<?php echo empty($sysmenu['index'])? webUrl($sysmenu['route']): webUrl($sysmenu['route']. '.'. $sysmenu['index'])?>">
                        <?php  if($sysmenu['route']=='plugins') { ?>
                        <svg class="iconplug" aria-hidden="true">
                            <use xlink:href="#icow-yingyong3"></use>
                        </svg>
                        <?php  } else { ?>
                            <?php  if(!empty($sysmenu['icon'])) { ?>
                                <i class="icow icow-<?php  echo $sysmenu['icon'];?>"></i>
                            <?php  } ?>
                        <?php  } ?>
                        <span class="wb-nav-title"><?php  echo $sysmenu['text'];?></span>
                    </a>
                    <span class="wb-nav-tip"><?php  echo $sysmenu['text'];?></span>
                </li>
            <?php  } } ?>
            <!-- <li><a href="<?php  echo url('account/display')?>">公众号</a></li> -->
        </ul>
    </div>

    <!-- 二级导航 -->
    <?php  if(!$no_left && !empty($sysmenus['submenu']['items'])) { ?>
        <div class="wb-subnav">
          <div style="width: 100%;height: 100%;overflow-y: auto">
              <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_tabs', TEMPLATE_INCLUDEPATH)) : (include template('_tabs', TEMPLATE_INCLUDEPATH));?>
              <div class="wb-subnav-fold icow"></div>
          </div>
        </div>
        <div class="wb-container <?php  if(!empty($system['foldpanel'])) { ?>right-panel<?php  } ?>">
    <?php  } ?>
        
<script type="text/javascript">
    var csurl = "<?php  echo webUrl('finance/sd_log/newsPush')?>";
    $.ajax({
        type: "POST",
        url:csurl,
        data:{},
        dataType:'json',
      success: function(json) {
        let result = json.result
        if(result.withdrawal == 0){
            $('.withdrawal').html(parseInt(0));
        }else if(result.withdrawal > 0){
            $('.withdrawal').html(parseInt(result.withdrawal));   
        }        
        if(result.recharge == 0){
            $('.recharge').html(parseInt(0));   
        }else if(result.recharge > 0){
            $('.recharge').html(parseInt(result.recharge));
        }
        /*if(result.dlcount==''){
            $('.dlxiaoxi').html(parseInt(0));
            
        }else if(result.dlcount>0){
            $('.dlxiaoxi').html(parseInt(result.dlcount));
        }
        if(result.yjcount==0){
            $('.yjxiaoxi').html(parseInt(0));
        }else if(result.yjcount>0){
            $('.yjxiaoxi').html(parseInt(result.yjcount));
        }*/

    
      }
    });
        // 连接服务端
    var url="<?php  echo $_W['config']['socketio'];?>";
    // console.log(url);
    var socket = io(url);
    // 连接后登录
    socket.on('connect', function(){
        socket.emit('login',"123456");
    });


    var wurl = "<?php  echo webUrl('finance/sd_log/newsPush')?>";
    // console.log(aa);
    // 后端推送通来消息时
    socket.on('new_msg', function(msg){
          if(msg=="tixian"){//提现\
            $.ajax({
                type: "POST",
                url:wurl,
                data:{},
                dataType:'json',
              success: function(json) {
                let result = json.result

                console.log(result);
                // console.log()
                $('.withdrawal').html(parseInt(result.withdrawal));

                $('.recharge').html(parseInt(result.recharge));

                // $('.dlxiaoxi').html(parseInt(result.dlcount));

                // $('.yjxiaoxi').html(parseInt(result.yjcount));
                // if(parseInt(result.notice-total2) > 0){
                //     // $('.tixian').show();
                // }else {
                //     // $('.tixian').hide();
                // }
            
              }
            });
          }else{//充值
            // rk.play();
            // var deposit_music=document.getElementById("deposit");
            // deposit_music.play();
          }
      

    });

</script>
