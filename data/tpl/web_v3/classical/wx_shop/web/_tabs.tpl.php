<?php defined('IN_IA') or exit('Access Denied');?><div class="subnav-scene">
	<?php  if(empty($sysmenus['submenu']['route']) && !$sysmenus['submenu']['main']) { ?>
		<?php  echo $sysmenus['submenu']['subtitle'];?>
	<?php  } else { ?>
		<a href="<?php  echo webUrl($sysmenus['submenu']['route'])?>"><?php  echo $sysmenus['submenu']['subtitle'];?></a>
	<?php  } ?>
</div>

<?php  if(!empty($sysmenus['submenu']['items'])) { ?>
	<?php  if(is_array($sysmenus['submenu']['items'])) { foreach($sysmenus['submenu']['items'] as $submenu) { ?>
		<?php  if(!empty($submenu['items'])) { ?>
			<div class='menu-header <?php  if($submenu['active']) { ?>active data-active<?php  } ?>'><div class="menu-icon fa fa-caret-<?php  if($submenu['active']) { ?>down<?php  } else { ?>right<?php  } ?>"></div><?php  echo $submenu['title'];?></div>
			<ul <?php  if($submenu['active']) { ?>style="display: block"<?php  } ?>>
				<?php  if(is_array($submenu['items'])) { foreach($submenu['items'] as $index => $threemenu) { ?>
					<li <?php  if($threemenu['active']) { ?>class="active"<?php  } ?>><a href="<?php  echo $threemenu['url'];?>" style="cursor: pointer;" data-route="<?php  echo $threemenu['route'];?>"><?php  echo $threemenu['title'];?>  <?php  if($threemenu['title'] =='满额立减' || $threemenu['title'] =='满额包邮' || $submenu['title'] == '优惠券'|| $threemenu['title'] == '抵扣设置'||$threemenu['title'] == '充值优惠') { ?><i class="icow icow-xiaochengxu" style="color: #7586db;vertical-align: middle;"></i><?php  } ?></a>
				<?php  } } ?>
			</ul>
		<?php  } else { ?>
			<ul class="single">
				<li <?php  if($submenu['active']) { ?>class="active"<?php  } ?> style=" position: relative"><a href="<?php  echo $submenu['url'];?>" style="cursor: pointer;" data-route="<?php  echo $submenu['route'];?>"><?php  echo $submenu['title'];?></a></li>
			</ul>
		<?php  } ?>
	<?php  } } ?>
<?php  } ?>
 