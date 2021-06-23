<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">当前位置：<span class="text-primary">会员等级大厅管理</span></div>

<div class="page-content">

    <form action="./index.php" method="get" class="form-horizontal form-search" role="form">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="wx_shop" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r"  value="member.sd_level" />

        <div class="page-toolbar">
            <div class="pull-left">
                <?php if(cv('member.level.add')) { ?>
                    <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('member/sd_level/add')?>"><i class='fa fa-plus'></i> 添加会员等级大厅</a>
                <?php  } ?>
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
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('member/sd_level/delete')?>"><i class='icow icow-shanchu1'></i> 删除</button>
                    <?php  } ?>
                </div>
            </div>
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th style="width:25px;"></th>
                        <th style="width:60px;">等级</th>
                        <th>等级名称</th>
                        <th>大厅名称</th>
                        <th>大厅图片</th>
                        <th>佣金比例%</th>
                        <th>升级条件</th>
                        <th>抢单率%</th>
                        <th style="width: 95px">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                        <tr <?php  if($row['id']=='default') { ?>style='background:#eee;<?php  if(!empty($_GPC['keyword'])) { ?>display:none;<?php  } ?>'<?php  } ?>>
                            <td><?php  if($row['id']!='default') { ?><input type='checkbox'   value="<?php  echo $row['id'];?>"/><?php  } ?></td>
                            <td><?php  if($row['id']=='default') { ?>--<?php  } else { ?><?php  echo $row['level'];?><?php  } ?></td>
                            <td><?php  echo $row['levelname'];?></td>
                            <td><?php  echo $row['hallname'];?></td>
                            <td>
                                <img src="<?php  echo tomedia($row['picture'])?>" style="width:72px;height:72px;padding:1px;border:1px solid #efefef;margin: 7px 0" onerror="this.src='../addons/wx_shop/static/images/nopic.png'" />
                            </td>
                            <td><?php  echo $row['c_proportion'];?></td>
                            <td>
                                <?php  if($row['id']=='default') { ?>
                                    默认等级
                                <?php  } else { ?>
                                    <?php  if($row['invitations_num'] > 0) { ?>
                                        邀请人数： <?php  echo $row['invitations_num'];?>人
                                        <br/>
                                        单个累计充值：<?php  echo $row['recharge'];?>
                                    <?php  } else { ?>
                                        --
                                    <?php  } ?>
                                <?php  } ?>
                            </td>
                            <td>
                                <?php  if($row['gs_probability'] > 0) { ?>
                                    <?php  echo $row['gs_probability'];?>
                                <?php  } else { ?>
                                    --
                                <?php  } ?>
                            </td>
                            <td>
                                <?php if(cv('member.list')) { ?>
                                <a class='btn btn-default  btn-sm btn-op btn-operation' href="<?php  echo webUrl('member/list', array('level' => $row['id']))?>">
                                    <span data-toggle="tooltip" data-placement="top" data-original-title="等级会员">
                                                <i class='icow icow-member'></i>
                                            </span>
                                </a>
                                <?php  } ?>
                                <?php if(cv('member.level.view|member.level.edit')) { ?>
                                    <a href="<?php  echo webUrl('member/sd_level/edit', array('id' => $row['id']))?>" class="btn btn-op btn-operation">
                                        <span data-toggle="tooltip" data-placement="top" data-original-title="<?php if(cv('member.level.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>">
                                                <i class='icow icow-bianji2'></i>
                                            </span>
                                    </a>
                                <?php  } ?>
                                <?php  if($row['id']!='default') { ?>
                                    <?php if(cv('member.level.delete')) { ?>
                                        <a data-toggle='ajaxRemove' href="<?php  echo webUrl('member/sd_level/delete', array('id' => $row['id']))?>"class="btn btn-op btn-operation" data-confirm='确认要删除此会员等级吗?'>
                                            <span data-toggle="tooltip" data-placement="top" data-original-title="删除">
                                               <i class='icow icow-shanchu1'></i>
                                            </span>
                                        </a>
                                    <?php  } ?>
                                <?php  } ?>
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
                                    <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('member/sd_level/delete')?>"><i class='icow icow-shanchu1'></i> 删除</button>
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

