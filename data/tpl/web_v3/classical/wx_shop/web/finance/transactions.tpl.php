<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">当前位置：<span class="text-primary">理财设置</span></div>

<div class="page-content">

    <form action="./index.php" method="get" class="form-horizontal form-search" role="form">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="wx_shop" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r"  value="finance.transactions" />

        <div class="page-toolbar">
            <div class="pull-left">
                <?php if(cv('member.level.add')) { ?>
                    <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('finance/transactions/add')?>"><i class='fa fa-plus'></i> 添加理财设置</a>
                <?php  } ?>
            </div>
            <div class="pull-right col-md-6">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name="enabled" class='form-control'>
                            <option value="" <?php  if($_GPC['enabled'] == '') { ?> selected<?php  } ?>>状态</option>
                            <option value="1" <?php  if($_GPC['enabled']== '1') { ?> selected<?php  } ?>>启用</option>
                            <option value="0" <?php  if($_GPC['enabled'] == '0') { ?> selected<?php  } ?>>禁用</option>
                        </select>
                    </div>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"> 搜索</button>
                    </span>
                </div>
            </div>
        </div>
    </form>

    <?php  if(empty($list)) { ?>
        <div class="panel panel-default">
            <div class="panel-body empty-data">未查询到相关数据</div>
        </div>
    <?php  } else { ?>
        <form action="" method="post" >
            <div class="page-table-header">
                <input type="checkbox">
                <div class="btn-group">
                    <?php if(cv('member.level.delete')) { ?>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('finance/transactions/delete')?>"><i class='icow icow-shanchu1'></i> 删除</button>
                    <?php  } ?>
                </div>
            </div>
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th style="width:25px;"></th>
                        <th style="width:80px;">理财天数</th>
                        <th style="width:80px;">年化率</th>
                        <th style="width:128px;">理财金额</th>
                        <th style="width:80px;">状态</th>
                        <th style="width: 95px">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                        <tr>
                            <td></td>
                            <td><?php  echo $row['day'];?></td>
                            <td><?php  echo $row['income_ratio'];?></td>
                            <td><?php  echo $row['min'];?>~<?php  echo $row['max'];?></td>
                            <td>
                                <?php  if($row['id']!='default') { ?>
                                <span class='label <?php  if($row['enabled']==1) { ?>label-primary<?php  } else { ?>label-default<?php  } ?>'
                                <?php if(cv('member.level.edit')) { ?>
                                data-toggle='ajaxSwitch'
                                data-switch-value='<?php  echo $row['enabled'];?>'
                                data-switch-value0='0|禁用|label label-default|<?php  echo webUrl('finance/transactions/enabled',array('enabled'=>1,'id'=>$row['id']))?>'
                                data-switch-value1='1|启用|label label-primary|<?php  echo webUrl('finance/transactions/enabled',array('enabled'=>0,'id'=>$row['id']))?>'
                                <?php  } ?>
                                >
                                <?php  if($row['enabled']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
                                <?php  } ?>
                            </td>
                            <td>
                                <a href="<?php  echo webUrl('finance/transactions/edit', array('id' => $row['id']))?>" class="btn btn-op btn-operation">
                                    <span data-toggle="tooltip" data-placement="top" data-original-title="<?php if(cv('member.level.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>">
                                            <i class='icow icow-bianji2'></i>
                                    </span>
                                </a>
                                 <a data-toggle='ajaxRemove' href="<?php  echo webUrl('finance/transactions/delete', array('id' => $row['id']))?>"class="btn btn-op btn-operation" data-confirm='确认要删除此会员等级吗?'>
                                    <span data-toggle="tooltip" data-placement="top" data-original-title="删除">
                                       <i class='icow icow-shanchu1'></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                    <?php  } } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td colspan="2">
                            <div class="btn-group">
                                <?php if(cv('member.level.delete')) { ?>
                                    <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('finance/lcset/delete')?>"><i class='icow icow-shanchu1'></i> 删除</button>
                                <?php  } ?>
                            </div>
                        </td>
                        <td colspan="4" style="text-align: right">
                            <span class="pull-right" style="line-height: 28px;">(共<?php  echo count($list)?>条记录)</span>
                            <?php  echo $pager;?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
        <?php  } ?>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

