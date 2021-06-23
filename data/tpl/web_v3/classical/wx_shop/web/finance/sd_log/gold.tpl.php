<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">当前位置：<span class="text-primary">余额明细</span></div>
<div class="page-content">
    <form action="./index.php" method="get" class="form-horizontal table-search" role="form" id="form1">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="wx_shop" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r" value="finance.sd_log.gold" />
        <div class="page-toolbar">
            <span class="pull-left">
                <?php  echo tpl_daterange('createtime', array('sm'=>true,'placeholder'=>'创建时间'),true);?>
            </span>
            <div class="input-group">
                <span class="input-group-select">
                    <select name="type" class="form-control"   style="width:80px;"  >
                        <option value="" <?php  if($_GPC['type']=='') { ?>selected<?php  } ?>>类型</option>
                        <option value="1" <?php  if($_GPC['type']=='1') { ?>selected<?php  } ?>>抢单</option>
                        <option value="11" <?php  if($_GPC['type']=='11') { ?>selected<?php  } ?>>抢单返还</option>
                        <option value="2" <?php  if($_GPC['type']=='2') { ?>selected<?php  } ?>>买入</option>
                        <option value="21" <?php  if($_GPC['type']=='21') { ?>selected<?php  } ?>>后台买入</option>
                        <option value="22" <?php  if($_GPC['type']=='22') { ?>selected<?php  } ?>>后台扣除</option>
                        <option value="3" <?php  if($_GPC['type']=='3') { ?>selected<?php  } ?>>卖出</option>
                        <option value="31" <?php  if($_GPC['type']=='31') { ?>selected<?php  } ?>>提现退还</option>
                        <option value="32" <?php  if($_GPC['type']=='32') { ?>selected<?php  } ?>>提现冻结</option>
                        <option value="4" <?php  if($_GPC['type']=='4') { ?>selected<?php  } ?>>返佣</option>
                        <option value="5" <?php  if($_GPC['type']=='5') { ?>selected<?php  } ?>>分润</option>
                        <option value="6" <?php  if($_GPC['type']=='6') { ?>selected<?php  } ?>>抢单冻结</option>
                        <option value="61" <?php  if($_GPC['type']=='61') { ?>selected<?php  } ?>>抢单解冻</option>
                        <option value="7" <?php  if($_GPC['type']=='7') { ?>selected<?php  } ?>>定期理财转入</option>
                        <option value="71" <?php  if($_GPC['type']=='71') { ?>selected<?php  } ?>>定期理财结息</option>
                        <option value="8" <?php  if($_GPC['type']=='8') { ?>selected<?php  } ?>>彩金</option>
                    </select>
                </span>
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
                            <th>订单编号</th>
                            <th>类型</th>
                            <th>金额</th>
                            <th>时间</th>
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
                                <td>
                                    <?php  if($row['ordersn'] != '--') { ?>
                                        <a href="<?php  echo webUrl('order/detail',array('id' => $row['rid']));?>" target='_blank'>
                                            <?php  echo $row['ordersn'];?>
                                        </a>
                                    <?php  } else { ?>
                                        <?php  echo $row['ordersn'];?>
                                    <?php  } ?>
                                </td>
                                <td><?php  echo $row['title'];?></td>
                                <td><?php  echo $row['gold'];?></td>
                                <td><?php  echo date('Y-m-d',$row['createtime'])?> <br/> <?php  echo date('H:i:s',$row['createtime'])?></td>
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
