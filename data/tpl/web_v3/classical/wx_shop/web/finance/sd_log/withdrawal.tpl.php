<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">当前位置：<span class="text-primary">充值审核</span></div>
<div class="page-content">
    <form action="./index.php" method="get" class="form-horizontal table-search" role="form" id="form1">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="wx_shop" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r" value="finance.sd_log.withdrawal" />
        <div class="page-toolbar">
            <span class="pull-left">
                <?php  echo tpl_daterange('createtime', array('sm'=>true,'placeholder'=>'申请时间'),true);?>
            </span>
            <div class="input-group">
                <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入会员昵称/手机号码/姓名" />
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"> 搜索</button>
                </span>
            </div>
        </div>
    </form>
    <style type="text/css">
        .pull-left{padding-right: 10px;}
    </style>

    <div class="page-toolbar">
        <div class="input-group">
            <span class="pull-left">
                    统计：<?php  if(!empty($receivables)) { ?><?php  echo $receivables;?><?php  } ?> <?php  if(!empty($deduction)) { ?>,&nbsp;&nbsp;&nbsp;<?php  echo $deduction;?><?php  } ?>
            </span>
        </div>
    </div>

    <?php  if(empty($list)) { ?>
        <div class="panel panel-default">
            <div class="panel-body empty-data">未查询到相关数据</div>
        </div>
    <?php  } else { ?>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="navbar-inner">
                        <tr>
                            <th>粉丝</th>
                            <th>会员信息</th>
                            <th>提现金额</th>
                            <th>银行卡信息</th>
                            <th>提交时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                            <tr>
                                <td style="overflow: visible">
                                    <a  href="<?php  echo webUrl('member/list/detail',array('id' => $row['mid']));?>" target='_blank'>
                                        <img class="radius50" src="<?php  echo $row['avatar']?>" style='width:30px;height:30px;padding1px;border:1px solid #ccc'  onerror="this.src='../addons/wx_shop/static/images/noface.png'"/> <?php  echo $row['nickname'];?>
                                    </a>
                                </td>
                                <td><?php  echo $row['realname'];?> <br/> <?php  echo $row['mobile'];?></td>
                                <td><?php  echo $row['gold'];?></td>
                                <td>
                                    <?php  echo $row['bankname'];?><br/>
                                    <?php  echo $row['banknum'];?><br/>
                                    <?php  echo $row['brealname'];?>
                                </td>
                                <td><?php  echo $row['createtime'];?></td>
                                <td>
                                    <?php  if($row['status']==0) { ?>
                                        <span class='text-default'>待审核</span>
                                    <?php  } else if($row['status']==1) { ?>
                                        <span class='text-success'>已通过</span>
                                    <?php  } else if($row['status']==2) { ?>
                                        <span class='text-default'>已驳回</span>
                                    <?php  } ?>
                                </td>

                                <td>
                                    <?php  if($row['status'] == 0) { ?>
                                        <a class='btn btn-sm btn-primary' data-toggle='ajaxPost' data-confirm="确认通过?" href="<?php  echo webUrl('finance/sd_log/withdrawalExamine',array('id' => $row['id'], 'status' => 1));?>">
                                            通过
                                        </a>
                                        <a class='btn btn-sm btn-danger' data-toggle='ajaxPost' data-confirm="确认驳回?" href="<?php  echo webUrl('finance/sd_log/withdrawalExamine',array('id' => $row['id'], 'status' => 2));?>">
                                            驳回
                                        </a>
                                    <?php  } ?>
                                </td>
                            </tr>
                        <?php  } } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <div class="btn-group"></div>
                            </td>
                            <td colspan="5" style="text-align: right">
                                <span class="pull-right" style="line-height: 28px;"></span>
                                <?php  echo $pager;?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <?php  } ?>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
