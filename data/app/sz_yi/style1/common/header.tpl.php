<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="../addons/sz_yi/static/css/font-awesome.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<script language="javascript" src="../addons/sz_yi/static/js/require.js"></script>
<script language="javascript" src="../addons/sz_yi/static/js/app/config.js?v=2"></script>
<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery-1.11.1.min.js"></script>
<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery.gcjs.js"></script>
<!--<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/style_red.css">-->



<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/base.css">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/jquery-weui.min.css">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/weui.min.css">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/style.css">
<!--new add start for style1 2016.09.09-->
<link rel="stylesheet"  type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/font-awesome.min.css">

<link rel="stylesheet"  type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/style1.css">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/main.css">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/fontMain/iconfont.css">
<!--new add end for style1-->
</head><script>window.PointerEvent = undefined</script>
<body>
<script language="javascript">
    require(['core','tpl'],function(core,tpl){
        core.init({
            siteUrl: "<?php  echo $_W['siteroot'];?>",
            baseUrl: "<?php  echo $this->createMobileUrl('ROUTES')?>"
        });
    })
</script>
<!-- <?php  if(is_array($this->header)) { ?>
<div class="follow_topbar"><div class="headimg"><img src="<?php  echo $this->header['icon']?>"></div><div class="info"><div class="i"><?php  echo $this->header['text']?></div><div class="i">?????????????????????????????????</div></div><div class="sub" onclick="location.href='<?php  echo $this->header['url']?>'">????????????</div></div>
<div style='height:44px;'>&nbsp;</div>
<?php  } ?> -->