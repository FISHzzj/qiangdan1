<?php defined('IN_IA') or exit('Access Denied');?><?php  $no_left =true;?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<script type="text/javascript" src="../addons/wx_shop/static/js/dist/area/cascade.js"></script>
<script type="text/javascript" src="/web/resource/js/lib/moment.js"></script>
<link rel="stylesheet" href="/web/resource/components/datetimepicker/jquery.datetimepicker.css">
<link rel="stylesheet" href="/web/resource/components/daterangepicker/daterangepicker.css">
<style type='text/css'>
    .tabs-container .form-group {overflow: hidden;}
    .tabs-container .tabs-left > .nav-tabs {}
    .tab-goods .nav li {float:left;}
    .spec_item_thumb {position: relative; width: 30px; height: 20px; padding: 0; border-left: none;}
    .spec_item_thumb i {position: absolute; top: -5px; right: -5px;}
    .multi-img-details, .multi-audio-details {margin-top:.5em;max-width: 700px; padding:0; }
    .multi-audio-details .multi-audio-item {width:155px; height: 40px; position:relative; float: left; margin-right: 5px;}
	.region-goods-details {
		background: #f8f8f8;
		margin-bottom: 10px;
		padding: 0 10px;
	}
	.region-goods-left{
		text-align: center;
		font-weight: bold;
		color: #333;
		font-size: 14px;
		padding: 20px 0;
	}
	.region-goods-right{
		border-left: 3px solid #fff;
		padding: 10px 10px;
	}
</style>
<div class="page-header">
    当前位置：
    <span class="text-primary">
    <?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>商品 <small><?php  if(!empty($item['id'])) { ?>修改【<span class="text-info"><?php  echo $item['title'];?></span>】<?php  } ?><?php  if(!empty($merch_user['merchname'])) { ?>商户名称:【<span class="text-info"><?php  echo $merch_user['merchname'];?></span>】<?php  } ?></small>
    </span>
</div>
<div class="page-content">
<div class="page-sub-toolbar">
	<span class=''>
		<?php if(cv('goods.add')) { ?>
        	<a class="btn btn-primary btn-sm" href="<?php  echo webUrl('goods/add')?>" >添加商品</a>
		<?php  } ?>
    </span>
</div>
<form <?php if( ce('goods' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
    <input type="hidden" id="tab" name="tab" value="#tab_basic" />
    <div class="tabs-container tab-goods">
        <div class="tabs-left">
            <ul class="nav nav-tabs" id="myTab">
                <li  <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>class="active"<?php  } ?>><a href="#tab_basic">基本</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane   <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>active<?php  } ?>" id="tab_basic"><div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/tab/basic', TEMPLATE_INCLUDEPATH)) : (include template('goods/tab/basic', TEMPLATE_INCLUDEPATH));?></div></div>
            </div>
        </div>
    </div>
    <?php if( ce('goods' ,$item) ) { ?>
	    <div class="form-group">
	        <label class="col-sm-2 control-label"></label>
	        <div class="col-sm-9 subtitle">
	            <input type="submit" value="保存商品" class="btn btn-primary"/>
				<a class="btn btn-default" href="<?php  echo webUrl('goods',array('goodsfrom'=>$_GPC['goodsfrom'], 'page'=>$_GPC['page']))?>">返回列表</a>
	        </div>
	    </div>
    <?php  } ?>
</form>
</div>

<script type="text/javascript">
	window.type = "<?php  echo $item['type'];?>";
	window.virtual = "<?php  echo $item['virtual'];?>";
	require(['bootstrap'], function () {
		$('#myTab a').click(function (e) {
			$('#tab').val( $(this).attr('href'));
			e.preventDefault();
			$(this).tab('show');
		})
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

