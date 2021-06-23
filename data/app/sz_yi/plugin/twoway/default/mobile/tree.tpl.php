<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>见点中心</title>
<style type="text/css">
    body {margin:0px; background:#eee; font-family:'微软雅黑'; }
    a {text-decoration:none;}
    .topbar {height:40px; padding:10px; background:#fff;}
    .topbar .user_face {height:40px; width:40px; background:#ccc; float:left;}
    .topbar .user_face img {height:100%; width:100%;}
    .topbar .user_info {height:40px; width:auto; float:left; margin-left:12px;}
    .topbar .user_info .user_name {height:24px; width:100%; font-size:16px; line-height:24px; color:#666;}
       .topbar .user_info .user_name span { font-size:14px; color:#ff6600}
    .topbar .user_info .user_date {height:14px; width:100%; font-size:14px; line-height:14px; color:#999;}

    .top {height:180px;padding:5px; background:#cc3431;}
    .top .top_1 {height:114px; width:100%;}
    .top .top_1 .text {height:114px; width:auto; float:left; color:#fff; line-height:50px; font-size:14px; color:#fff;}
    .top .top_1 .ico {height:40px; width:30px; background:url(../addons/sz_yi/plugin/commission/template/mobile/default/static/images/gold_ico2.png) 0px 10px no-repeat; margin-bottom:74px; float:right;}
    .topbonus {height:40px;padding:5px; background:#cc3431;}
    .topbonus .top_1 {height:40px; width:100%;}
    .topbonus .top_1 .text {height:40px; width:auto; float:left; color:#fff; line-height:20px; font-size:14px; color:#fff;}
    .topbonus .top_1 .ico {height:40px; width:30px; background:url(../addons/sz_yi/plugin/commission/template/mobile/default/static/images/gold_ico2.png) 0px 10px no-repeat; margin-bottom:74px; float:right;}
    .top .top_2 {height:66px; width:100%; font-size:40px; line-height:66px; color:#fff;}
    .top .top_2 span {height:32px; color:#fff; width:auto; border:1px solid #fff; font-size:14px; line-height:32px; margin-top:17px; padding:0px 15px;  float:right; border-radius:5px;}
    .top .top_2 .disabled { color:#999;border:1px solid #999;}

    ul,li,a {-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;margin: 0;padding: 0;}
    .tree ul { padding-top: 20px; position: relative; webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all .3s; }
    .tree li { float: left; list-style: none; text-align: center; position: relative; padding: 20px 5px 0 5px; webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all .3s; width: 50%}
    .tree>ul>li:first-child{width: 100%}
    /*利用::before,::after作分支线*/
    .tree li::before, .tree li::after { content: ""; position: absolute; top: 0; right: 50%; width: 50%; height: 20px; border-top: 1px solid #ccc; }
    .tree li:after { right: auto; left: 50%; border-left: 1px solid #ccc; }
    .tree li:first-child::before, .tree li:last-child::after { border: 0 none; }
    .tree li:last-child::before { border-right: 1px solid #ccc; -webkit-border-radius: 0 10px 0 0; -moz-border-radius: 0 10px 0 0; border-radius: 0 10px 0 0; }
    .tree li:first-child::after { -webkit-border-radius: 10px 0 0 0; -moz-border-radius: 10px 0 0 0; border-radius: 10px 0 0 0; }
    /*删除仅只有一个分支的分支线*/
    .tree li:only-child::before, .tree li:only-child::after { border: none; }
    .tree li:only-child { padding-top: 0; }
    /*添加仅只有一个分支的下分支线*/
    .tree ul ul::before { content: ""; position: absolute; top: 0; left: 50%; border-left: 1px solid #ccc; width: 0; height: 20px; }
    .tree a { display: inline-block; border: 1px solid #ccc; color: #666; text-decoration: none; webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all .3s; background: #cfe4f9; color: #194189; }
    /*添加选中状态*/
    .tree li a:hover, .tree li a:hover+ul li a { background-color: #c8e4f8; color: #000; border: 1px solid #94a0b4; }
    .tree li a:hover+ul li:after, .tree li a:hover+ul li:before, .tree li a:hover+ul::before, .tree li a:hover+ul ul::before { border-color: #94a0b4; }
    /*清除浮动代码*/
    .clearfloat:after{display:block;clear:both;content:"";visibility:hidden;height:0}
    .clearfloat{zoom:1}
    .header { height: auto;  width:100%; padding:0px; background: #c12526; }
    .header .user { height:80px; padding:10px; }
    .header .user .user-head { height:48px; width:48px;margin: 16px 0px 0px 20px; background:#fff; border-radius:50%; float:left; border:2px solid #fff; }
    .header .user .user-head img { height:48px;  width:48px; border-radius:24px; }
    .header .user .user-info { height:48px;  width:auto; float:left;  margin-left:14px;  color:#fff; margin-top: 16px; }
    .header .user .user-info .user-name { height:20px; width:auto; font-size:16px;  line-height:20px; }
    .header .user .user-info .user-name i{ display: inline-flex; max-width: 64px;max-height: 20px;overflow: hidden; font-style: normal; }
    .header .user .user-info .user-name span { font-size:14px; color:#fff;}
    .header .user .user-info .user-other { height:24px;  width:auto;  font-size:12px; }
    .header .user-gold { height:35px; width:94%; padding:5px 3%; border-bottom:1px solid #ddd; background:#fff; font-size:16px; line-height:35px; }
    .header .user-gold .title { height:35px;  width:auto; float:left;  color:#666; }
    .header .user-gold .num { height:35px; width:auto;  float:left; color:#f90; }
    .header .user-gold .draw { width:80px; height:30px; background:#6c9; float:right; }
    .header .user .set { height:26px; width:26px; float:right; margin-top:10px; }
    .header .user-op {  height:35px; width:94%; padding:5px 3%; border-bottom:1px solid #ddd;
                        background:#fff; font-size:16px; line-height:35px;  }
    .panel-heading { background: #9a1e1e; }
    .panel-heading .span_width{ display: block; height: 50px; width: 100%;}
    
    .span_width_left,.span_width_right{ height: 50px;display: inline-block;    float: left; }
    .panel-heading .span_width .span_width_left{ width: 49%; border-right: 1px #F96D6D solid;}
    .panel-heading .span_width .span_width_right{ width: 50%;}
    .panel-heading .span_width a{display: block; width: 100%; color: #fff; font-size: 12px; height: 50px; line-height: 50px; text-align: center; }
    .span_width_left a{ border-bottom: 2px #ffdd2f solid; }
</style>
<div id='container'></div>
<script id='tpl_main' type='text/html'>
    <div class="header">
        <div class="user">
            <div class="user-head"><img src="<?php  echo $member['avatar'];?>"></div>
            <div class="user-info">
                <div class="user-name">
                    <i><?php  echo $member['nickname'];?></i><span>（会员ID:<?php  echo $member['id'];?>]）</span>
                </div>
                <div class="user-other">会员等级：<?php  echo $namelevel;?></div>
            </div>
        </div>
    </div>

    <div class='panel-heading'>
        <?php  if($no == 1) { ?>
            <span class="span_width <?php  if($_GPC['method']=='twoway' && !$_GPC['area']) { ?>active<?php  } ?>">
                <div class="span_width_left">
                    <a href="<?php  echo $this->createPluginMobileUrl('twoway/tree',array('area'=>1))?>">排位情况</a>
                </div>
                <div class="span_width_right">
                    <a href="<?php  echo $this->createPluginMobileUrl('twoway/log',array('area'=>1))?>"><?php  echo $list1['name'];?>奖金明细</a>
                </div>
            </span>
        <?php  } ?>
       <?php  if($no == 2) { ?>
            <span class="span_width <?php  if($_GPC['area']=='2') { ?>active<?php  } ?>">
                <div class="span_width_left">
                    <a href="<?php  echo $this->createPluginMobileUrl('twoway/tree')?>">排位情况</a>
                </div>
                <div class="span_width_right">
                    <a href="<?php  echo $this->createPluginMobileUrl('twoway/log',array('area'=>2))?>"><?php  echo $list2['name'];?>奖金明细</a>
                </div>
            </span>
      <?php  } ?>
        <?php  if($no == 3) { ?>
            <span class="span_width <?php  if($_GPC['area']=='3') { ?>active<?php  } ?>">
                <div class="span_width_left">
                    <a href="<?php  echo $this->createPluginMobileUrl('twoway/tree',array('area'=>3))?>">排位情况</a>
                </div>
                <div class="span_width_right">
                    <a href="<?php  echo $this->createPluginMobileUrl('twoway/log',array('area'=>3))?>"><?php  echo $list3['name'];?>奖金明细</a>
                </div>
            </span>
        <?php  } ?>
        <?php  if($no == 4) { ?>
            <span class="span_width <?php  if($_GPC['area']=='4') { ?>active<?php  } ?>">
                <div class="span_width_left">
                    <a href="<?php  echo $this->createPluginMobileUrl('twoway/tree',array('area'=>4))?>">排位情况</a>
                </div>
                <div class="span_width_right">
                    <a href="<?php  echo $this->createPluginMobileUrl('twoway/log',array('area'=>4))?>"><?php  echo $list4['name'];?>奖金明细</a>
                </div>
            </span>
        <?php  } ?>
    </div>
    <!--  -->

    <?php  if($set['way']==1) { ?>
    <style type="text/css">
        * { margin: 0; padding: 0; list-style: none;}
        ul,li,a {-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;margin: 0;padding: 0;}
        .tree ul { padding-top: 20px; position: relative; webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all .3s; }
        .tree li { float: left; list-style: none; text-align: center; position: relative; padding: 20px 5px 0 5px; webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all .3s; width: 100%}
        .tree>ul>li:first-child{width: 100%}
        /*利用::before,::after作分支线*/
        .tree li::before, .tree li::after { content: ""; position: absolute; top: 0; right: 50%; width: 50%; height: 20px; border-top: 1px solid #999; }
        .tree li:after { right: auto; left: 50%; border-left: 1px solid #999; }
        .tree li:first-child::before, .tree li:last-child::after { border: 0 none; }
        .tree li:last-child::before { border-right: 1px solid #999; -webkit-border-radius: 0 10px 0 0; -moz-border-radius: 0 10px 0 0; border-radius: 0 10px 0 0; }
        .tree li:first-child::after { -webkit-border-radius: 10px 0 0 0; -moz-border-radius: 10px 0 0 0; border-radius: 10px 0 0 0; }
        /*删除仅只有一个分支的分支线*/
        .tree li:only-child::before, .tree li:only-child::after { border: none; }
        .tree li:only-child { padding-top: 0; }
        /*添加仅只有一个分支的下分支线*/
        .tree ul ul::before { content: ""; position: absolute; top: 0; left: 50%; border-left: 1px solid #999; width: 0; height: 20px; }
        .tree a { display: inline-block; border: 1px solid #999; color: #666; text-decoration: none; webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all .3s; background: #cfe4f9; color: #194189;padding: 6px;}
        /*添加选中状态*/
        .tree li a:hover, .tree li a:hover+ul li a { background-color: #c8e4f8; color: #000; border: 1px solid #94a0b4; }
        .tree li a:hover+ul li:after, .tree li a:hover+ul li:before, .tree li a:hover+ul::before, .tree li a:hover+ul ul::before { border-color: #94a0b4; }
        /*清除浮动代码*/
        .clearfloat:after{display:block;clear:both;content:"";visibility:hidden;height:0}
        .clearfloat{zoom:1}
        .panel-heading .active{background: #DDD;}
    </style>
    <div class='panel panel-default'>
    
        <div class='panel-body'>
            <!-- 树形图 -->
            <div class="" style="clear:both;"></div>
            <div class="tree">
                <ul>
                    <li id="myli" style="">
                        <a href="javascrit:;"><div style="background:#194189;color:#fff">ID：<?php  echo $topTree[0]['id'];?><br><?php  echo $topTree[0]['name'];?></div>
                        </a>
                        <ul>
                            <li>
                                <a href="<?php  echo $twoTree[0]['url'];?>">
                                <div class="clearfloat">
                                    <div style="color:black;"></div>
                                </div>
                                ID：<?php  echo $twoTree[0]['id'];?><br><?php  echo $twoTree[0]['name'];?>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?php  echo $threeTree[0]['url'];?>">ID:<?php  echo $threeTree[0]['id'];?><br><?php  echo $threeTree[0]['name'];?></a>
                                        <ul>
                                            <li><a href="<?php  echo $fourTree1[0]['url'];?>">ID:<?php  echo $fourTree1[0]['id'];?><br><?php  echo $fourTree1[0]['name'];?></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <br>
    </div>
    <?php  } ?>
    <?php  if($set['way']==2) { ?>
    <style type="text/css">
        * { margin: 0; padding: 0; list-style: none;}
        ul,li,a {-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;margin: 0;padding: 0;}
        .tree ul { padding-top: 20px; position: relative; webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all .3s; }
        .tree li { float: left; list-style: none; text-align: center; position: relative; padding: 20px 5px 0 5px; webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all .3s; width: 50%}
        .tree>ul>li:first-child{width: 100%}
        /*利用::before,::after作分支线*/
        .tree li::before, .tree li::after { content: ""; position: absolute; top: 0; right: 50%; width: 50%; height: 20px; border-top: 1px solid #999; }
        .tree li:after { right: auto; left: 50%; border-left: 1px solid #999; }
        .tree li:first-child::before, .tree li:last-child::after { border: 0 none; }
        .tree li:last-child::before { border-right: 1px solid #999; -webkit-border-radius: 0 10px 0 0; -moz-border-radius: 0 10px 0 0; border-radius: 0 10px 0 0; }
        .tree li:first-child::after { -webkit-border-radius: 10px 0 0 0; -moz-border-radius: 10px 0 0 0; border-radius: 10px 0 0 0; }
        /*删除仅只有一个分支的分支线*/   
        .tree li:only-child::before, .tree li:only-child::after { border: none; }
        .tree li:only-child { padding-top: 0; }
        /*添加仅只有一个分支的下分支线*/
        .tree ul ul::before { content: ""; position: absolute; top: 0; left: 50%; border-left: 1px solid #999; width: 0; height: 20px; }
        .tree a { display: inline-block; border: 1px solid #999; color: #666; text-decoration: none; webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all .3s; background: #cfe4f9; color: #194189;padding: 6px;}
        /*添加选中状态*/
        .tree li a:hover, .tree li a:hover+ul li a { background-color: #c8e4f8; color: #000; border: 1px solid #94a0b4; }
        .tree li a:hover+ul li:after, .tree li a:hover+ul li:before, .tree li a:hover+ul::before, .tree li a:hover+ul ul::before { border-color: #94a0b4; }
        /*清除浮动代码*/
        .clearfloat:after{display:block;clear:both;content:"";visibility:hidden;height:0}
        .clearfloat{zoom:1}
        .panel-heading .active{background: #DDD;}

    </style>
    
    <div class='panel panel-default'>

        <div class='panel-body'>
            <!-- 树形图 -->
            <div class="" style="clear:both;"></div>
            
            <div class="tree">
                <ul>
                    <li id="myli" style="">
                        <a href="javascrit:;"><div style="background:#194189;color:#fff">ID：<?php  echo $topTree[0]['id'];?><br><?php  echo $topTree[0]['name'];?></div>
                        </a>
                        <ul>
                            <li>
                                <a href="<?php  echo $twoTree[0]['url'];?>">
                                <div class="clearfloat">
                                    <div style="color:black;"></div>
                                </div>
                                ID：<?php  echo $twoTree[0]['id'];?><br><?php  echo $twoTree[0]['name'];?>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?php  echo $threeTree[0]['url'];?>">ID:<?php  echo $threeTree[0]['id'];?><br><?php  echo $threeTree[0]['name'];?></a>
                                        <ul>
                                            <li><a href="<?php  echo $fourTree1[0]['url'];?>">ID:<?php  echo $fourTree1[0]['id'];?><br><?php  echo $fourTree1[0]['name'];?></a></li>
                                            <li><a href="<?php  echo $fourTree1[1]['url'];?>">ID:<?php  echo $fourTree1[1]['id'];?><br><?php  echo $fourTree1[1]['name'];?></a></li>
                                        </ul>
                                    </li>
                                    <li><!-- <?php  echo $this->createPluginWebUrl('twoway/twoway',array('treeid'=>$threeTree[1]['id']))?> -->
                                        <a href="<?php  echo $threeTree[1]['url'];?>">ID:<?php  echo $threeTree[1]['id'];?><br><?php  echo $threeTree[1]['name'];?></a>
                                        <ul>
                                            <li><a href="<?php  echo $fourTree1[2]['url'];?>">ID:<?php  echo $fourTree1[2]['id'];?><br><?php  echo $fourTree1[2]['name'];?></a></li>
                                            <li><a href="<?php  echo $fourTree1[3]['url'];?>">ID:<?php  echo $fourTree1[3]['id'];?><br><?php  echo $fourTree1[3]['name'];?></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php  echo $twoTree[1]['url'];?>">
                                <div class="clearfloat">
                                    <div style="color:black;"></div>
                                </div>
                                ID:<?php  echo $twoTree[1]['id'];?><br><?php  echo $twoTree[1]['name'];?>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?php  echo $threeTree[2]['url'];?>">ID:<?php  echo $threeTree[2]['id'];?><br><?php  echo $threeTree[2]['name'];?></a>
                                        <ul>
                                            <li><a href="<?php  echo $fourTree1[4]['url'];?>">ID:<?php  echo $fourTree1[4]['id'];?><br><?php  echo $fourTree1[4]['name'];?></a></li>
                                            <li><a href="<?php  echo $fourTree1[5]['url'];?>">ID:<?php  echo $fourTree1[5]['id'];?><br><?php  echo $fourTree1[5]['name'];?></a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="<?php  echo $threeTree[3]['url'];?>">ID:<?php  echo $threeTree[3]['id'];?><br><?php  echo $threeTree[3]['name'];?></a>
                                        <ul>
                                            <li><a href="<?php  echo $fourTree1[6]['url'];?>">ID:<?php  echo $fourTree1[6]['id'];?><br><?php  echo $fourTree1[6]['name'];?></a></li>
                                            <li><a href="<?php  echo $fourTree1[7]['url'];?>">ID:<?php  echo $fourTree1[7]['id'];?><br><?php  echo $fourTree1[7]['name'];?></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <br>
    </div>
    <?php  } ?>
    <?php  if($set['way']==3) { ?>

    <!-- 三轨 -->
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/base.min.css">
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/team.css">
     <?php  if(is_array($n_user)) { foreach($n_user as $val) { ?> 
      <div class="m-shopCoupon" id="m-shopCoupon" data-numder ="1" style="background:#fff;position: relative; padding-left: 12px;font-size: 13px;">
    <span class="oshowBtn"  style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:30px;margin-left: 2px; line-height: 30px;font-size:25px; text-align: left;border: none;">+</span>
     &nbsp;&nbsp;1.<?php  if($val['realname']) { ?> <?php  echo $val['name'];?><?php  } else { ?> <?php  echo $val['name'];?><?php  } ?>[ ID:<span style="display: none;"><?php  echo $val['id'];?></span><span id="id"><?php  echo $val['mid'];?></span> <?php  echo $val['level'];?>  微信：<?php  echo $val['weixin'];?>]
      </div>
      <?php  } } ?>
     
    <script type="text/javascript">
    //  $('.showBtn').toggle(
    //      function(){
    //          $('.showBtn').text('-') ;
    //          $('.oshow').css('display','block')
    //      },
    //      function(){
    //          $('.showBtn').text('+') ;
    //          $('.oshow').css('display','none')
    //      }
    //      
    //      )

    var ohtml='<div class="oshow" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:30px;margin-left: 2px; line-height: 30px;font-size:25px; text-align: left;border: none;">+</span>&nbsp;&nbsp;fsfagtghdfgdfgh</div>';
    require(['tpl', 'core'], function(tpl, core) {
        $('.m-shopCoupon').on('click','.oshowBtn',
            function(){
                if($(this).html()=='+'){
                   $(this).text('-');
             var val = $(this).next().html();
             var obj = $(this);
             var huangboli= $(this).parent()[0].dataset.numder;
             huangboli++;
             core.pjson('twoway/tree', {op: 'zhang', id: val}, function(rjson) {
                      if(rjson.status==1){
                        var aa='<div class="oshow" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:28px;margin-left: 2px; line-height: 10px;font-size:25px; text-align: left;border: none;">+</span> <?php  echo $val['level'];?>   微信：<?php  echo $val['weixin'];?>]</div>';
                        // console.log(rjson.result);
                        var list = rjson.result;
                        /*$.each(rjson.result,function(){
                        })*/
                        for (var i = list.length - 1; i >= 0; i--) {
                            var html = '<div class="oshow" id="m-shopCoupon" data-numder = "'+huangboli+'" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:28px;margin-left: 2px; line-height: 35px;font-size:25px; text-align: left;border: none;">+</span>&nbsp;&nbsp;'+huangboli+'.'+list[i].name+'[ ID:<span style="display: none;">'+list[i].id+'</span><c id="id">'+list[i].id+'</c>  '+list[i].level +' 微信：'+list[i].weixin+']</div>';
                            // list[i]
                            obj.parent().append(html);
                            // console.log('aa');
                        }
                      }else{
                       
                        var ohtml = rjson.result;
                        core.tip.show(ohtml);
                      }
                  }, false, true);
                
                  
                
                }else{
                    $(this).text('+');
                   $(this).siblings('.oshow').css('display','none');
                
                }
            }
            
            );
    });
    </script>
    <?php  } ?>
    <?php  if($set['way']==4) { ?>
    <!--四轨-->
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/base.min.css">
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/team.css">
     <?php  if(is_array($n_user)) { foreach($n_user as $val) { ?> 
      <div class="m-shopCoupon" id="m-shopCoupon" data-numder ="1" style="background:#fff;position: relative; padding-left: 12px;font-size: 13px;">
    <span class="oshowBtn"  style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:30px;margin-left: 2px; line-height: 30px;font-size:25px; text-align: left;border: none;">+</span>
     &nbsp;&nbsp;1.<?php  if($val['realname']) { ?> <?php  echo $val['name'];?><?php  } else { ?> <?php  echo $val['name'];?><?php  } ?>[ ID:<span style="display: none;"><?php  echo $val['id'];?></span><span id="id"><?php  echo $val['mid'];?></span> <?php  echo $val['level'];?>  微信：<?php  echo $val['weixin'];?>]
      </div>
      <?php  } } ?>
     
    <script type="text/javascript">
    //  $('.showBtn').toggle(
    //      function(){
    //          $('.showBtn').text('-') ;
    //          $('.oshow').css('display','block')
    //      },
    //      function(){
    //          $('.showBtn').text('+') ;
    //          $('.oshow').css('display','none')
    //      }
    //      
    //      )

    var ohtml='<div class="oshow" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:30px;margin-left: 2px; line-height: 30px;font-size:25px; text-align: left;border: none;">+</span>&nbsp;&nbsp;fsfagtghdfgdfgh</div>';
    require(['tpl', 'core'], function(tpl, core) {
        $('.m-shopCoupon').on('click','.oshowBtn',
            function(){
                if($(this).html()=='+'){
                   $(this).text('-');
             var val = $(this).next().html();
             var obj = $(this);
             var huangboli= $(this).parent()[0].dataset.numder;
             huangboli++;
             core.pjson('twoway/tree', {op: 'zhang', id: val}, function(rjson) {
                      if(rjson.status==1){
                        var aa='<div class="oshow" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:28px;margin-left: 2px; line-height: 10px;font-size:25px; text-align: left;border: none;">+</span> <?php  echo $val['level'];?>   微信：<?php  echo $val['weixin'];?>]</div>';
                        // console.log(rjson.result);
                        var list = rjson.result;
                        /*$.each(rjson.result,function(){
                        })*/
                        for (var i = list.length - 1; i >= 0; i--) {
                            var html = '<div class="oshow" id="m-shopCoupon" data-numder = "'+huangboli+'" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:28px;margin-left: 2px; line-height: 35px;font-size:25px; text-align: left;border: none;">+</span>&nbsp;&nbsp;'+huangboli+'.'+list[i].name+'[ ID:<span style="display: none;">'+list[i].id+'</span><c id="id">'+list[i].id+'</c>  '+list[i].level +' 微信：'+list[i].weixin+']</div>';
                            // list[i]
                            obj.parent().append(html);
                            // console.log('aa');
                        }
                      }else{
                       
                        var ohtml = rjson.result;
                        core.tip.show(ohtml);
                      }
                  }, false, true);
                
                  
                
                }else{
                    $(this).text('+');
                   $(this).siblings('.oshow').css('display','none');
                
                }
            }
            
            );
    });
    </script>
    <?php  } ?>
    <?php  if($set['way']==5) { ?>
    <!--五轨-->
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/base.min.css">
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/team.css">
     <?php  if(is_array($n_user)) { foreach($n_user as $val) { ?> 
      <div class="m-shopCoupon" id="m-shopCoupon" data-numder ="1" style="background:#fff;position: relative; padding-left: 12px;font-size: 13px;">
    <span class="oshowBtn"  style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:30px;margin-left: 2px; line-height: 30px;font-size:25px; text-align: left;border: none;">+</span>
     &nbsp;&nbsp;1.<?php  if($val['realname']) { ?> <?php  echo $val['name'];?><?php  } else { ?> <?php  echo $val['name'];?><?php  } ?>[ ID:<span style="display: none;"><?php  echo $val['id'];?></span><span id="id"><?php  echo $val['mid'];?></span> <?php  echo $val['level'];?>  微信：<?php  echo $val['weixin'];?>]
      </div>
      <?php  } } ?>
     
    <script type="text/javascript">
    //  $('.showBtn').toggle(
    //      function(){
    //          $('.showBtn').text('-') ;
    //          $('.oshow').css('display','block')
    //      },
    //      function(){
    //          $('.showBtn').text('+') ;
    //          $('.oshow').css('display','none')
    //      }
    //      
    //      )

    var ohtml='<div class="oshow" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:30px;margin-left: 2px; line-height: 30px;font-size:25px; text-align: left;border: none;">+</span>&nbsp;&nbsp;fsfagtghdfgdfgh</div>';
    require(['tpl', 'core'], function(tpl, core) {
        $('.m-shopCoupon').on('click','.oshowBtn',
            function(){
                if($(this).html()=='+'){
                   $(this).text('-');
             var val = $(this).next().html();
             var obj = $(this);
             var huangboli= $(this).parent()[0].dataset.numder;
             huangboli++;
             core.pjson('twoway/tree', {op: 'zhang', id: val}, function(rjson) {
                      if(rjson.status==1){
                        var aa='<div class="oshow" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:28px;margin-left: 2px; line-height: 10px;font-size:25px; text-align: left;border: none;">+</span> <?php  echo $val['level'];?>   微信：<?php  echo $val['weixin'];?>]</div>';
                        // console.log(rjson.result);
                        var list = rjson.result;
                        /*$.each(rjson.result,function(){
                        })*/
                        for (var i = list.length - 1; i >= 0; i--) {
                            var html = '<div class="oshow" id="m-shopCoupon" data-numder = "'+huangboli+'" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:28px;margin-left: 2px; line-height: 35px;font-size:25px; text-align: left;border: none;">+</span>&nbsp;&nbsp;'+huangboli+'.'+list[i].name+'[ ID:<span style="display: none;">'+list[i].id+'</span><c id="id">'+list[i].id+'</c>  '+list[i].level +' 微信：'+list[i].weixin+']</div>';
                            // list[i]
                            obj.parent().append(html);
                            // console.log('aa');
                        }
                      }else{
                       
                        var ohtml = rjson.result;
                        core.tip.show(ohtml);
                      }
                  }, false, true);
                
                  
                
                }else{
                    $(this).text('+');
                   $(this).siblings('.oshow').css('display','none');
                
                }
            }
            
            );
    });
    </script>
    <?php  } ?>
    <?php  if($set['way']==6) { ?>
    <!--六轨-->
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/base.min.css">
                <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/team.css">
                 <?php  if(is_array($n_user)) { foreach($n_user as $val) { ?> 
                  <div class="m-shopCoupon" id="m-shopCoupon" data-numder ="1" style="background:#fff;position: relative; padding-left: 12px;font-size: 13px;">
                <span class="oshowBtn"  style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:30px;margin-left: 2px; line-height: 30px;font-size:25px; text-align: left;border: none;">+</span>
                 &nbsp;&nbsp;1.<?php  if($val['realname']) { ?> <?php  echo $val['name'];?><?php  } else { ?> <?php  echo $val['name'];?><?php  } ?>[ ID:<span style="display: none;"><?php  echo $val['id'];?></span><span id="id"><?php  echo $val['mid'];?></span> <?php  echo $val['level'];?>  微信：<?php  echo $val['weixin'];?>]
                  </div>
                  <?php  } } ?>
                 
                <script type="text/javascript">
                //  $('.showBtn').toggle(
                //      function(){
                //          $('.showBtn').text('-') ;
                //          $('.oshow').css('display','block')
                //      },
                //      function(){
                //          $('.showBtn').text('+') ;
                //          $('.oshow').css('display','none')
                //      }
                //      
                //      )

                var ohtml='<div class="oshow" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:30px;margin-left: 2px; line-height: 30px;font-size:25px; text-align: left;border: none;">+</span>&nbsp;&nbsp;fsfagtghdfgdfgh</div>';
                require(['tpl', 'core'], function(tpl, core) {
                    $('.m-shopCoupon').on('click','.oshowBtn',
                        function(){
                            if($(this).html()=='+'){
                               $(this).text('-');
                         var val = $(this).next().html();
                         var obj = $(this);
                         var huangboli= $(this).parent()[0].dataset.numder;
                         huangboli++;
                         core.pjson('twoway/tree', {op: 'zhang', id: val}, function(rjson) {
                                  if(rjson.status==1){
                                    var aa='<div class="oshow" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:28px;margin-left: 2px; line-height: 10px;font-size:25px; text-align: left;border: none;">+</span> <?php  echo $val['level'];?>   微信：<?php  echo $val['weixin'];?>]</div>';
                                    // console.log(rjson.result);
                                    var list = rjson.result;
                                    /*$.each(rjson.result,function(){
                                    })*/
                                    for (var i = list.length - 1; i >= 0; i--) {
                                        var html = '<div class="oshow" id="m-shopCoupon" data-numder = "'+huangboli+'" style="position: relative; padding-left: 12px;font-size: 13px;"><span class="oshowBtn" style="position: absolute;top:0;left: 0;  display: inline-block;width:100%;height:28px;margin-left: 2px; line-height: 35px;font-size:25px; text-align: left;border: none;">+</span>&nbsp;&nbsp;'+huangboli+'.'+list[i].name+'[ ID:<span style="display: none;">'+list[i].id+'</span><c id="id">'+list[i].id+'</c>  '+list[i].level +' 微信：'+list[i].weixin+']</div>';
                                        // list[i]
                                        obj.parent().append(html);
                                        // console.log('aa');
                                    }
                                  }else{
                                   
                                    var ohtml = rjson.result;
                                    core.tip.show(ohtml);
                                  }
                              }, false, true);
                            
                              
                            
                            }else{
                                $(this).text('+');
                               $(this).siblings('.oshow').css('display','none');
                            
                            }
                        }
                        
                        );
                });
                </script>
    <?php  } ?>
    
</script>

<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
    core.pjson('commission',{},function(json){
        var result = json.result;
        $('#container').html(  tpl('tpl_main',result) );
        $('#withdraw').click(function(){
            if(!json.result.mycansettle){
                 if(json.result.mysettlemoney>0){
                    core.tip.show('您需要自己购买订单完成，共计'+json.result.mysettlemoney+'元才能申请<?php  echo $this->set['texts']['withdraw']?>!');
                    return;
                 }
            }           if(!json.result.mytotal){                if(json.result.total_money > 0){                   core.tip.show('您需要自己购买订单完成，共计'+json.result.total_money+'元才能申请<?php  echo $this->set['texts']['withdraw']?>!');                    return;                    }            }            if(!json.result.mymonth){                if(json.result.month_money>0){                    core.tip.show('您本月需要自己购买订单完成，共计'+json.result.month_money+'元才能申请<?php  echo $this->set['texts']['withdraw']?>!');                    return;                    }            }
            if(!json.result.cansettle){
                 if(json.result.settlemoney>0){
                 core.tip.show('需到'+json.result.settlemoney+'元才能申请<?php  echo $this->set['texts']['withdraw']?>!');
                 }else{
                    core.tip.show('无可提<?php  echo $this->set['texts']['commission']?>!');
                 }
            }
        });
    },true);

})
</script>
<?php  $show_footer=true;$footer_current ='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>