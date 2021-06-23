<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type='text/css'>
    .trhead td {  background:#efefef;text-align: center}
    .trbody td {  text-align: center; vertical-align:top;border-left:1px solid #f2f2f2;overflow: hidden; font-size:12px;}
    .trorder { background:#f8f8f8;border:1px solid #f2f2f2;text-align:left;}
    .ops { border-right:1px solid #f2f2f2; text-align: center;}
    .ops a,.ops span{
        margin: 3px 0;
    }
    .table-top .op:hover{
        color: #000;
    }
    .tables{
        border:1px solid #e5e5e5;
        font-size: 12px;
        line-height: 18px;
    }
    .tables:hover{
        border:1px solid #b1d8f5;
    }
    .table-row,.table-header,.table-footer,.table-top{
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        -webkit-justify-content: center;
        -webkit-align-content: space-around;
        align-content: space-around;
    }
    .tables  .table-row>div{
        padding: 14px 0 !important;
    }
    .tables  .table-row.table-top>div{
        padding: 11px 0;
    }
    .tables    .table-row .ops.list-inner{
        border-right:none;
    }
    .tables .list-inner{
       border-right: 1px solid #efefef;
        vertical-align: middle;
    }
    .table-row .goods-des .title{
        width:180px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .table-row .goods-des{
        width:300px;
        border-right: 1px solid #efefef;
        vertical-align: middle;
    }
    .table-row .list-inner{
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        -ms-flex: 1;
        flex: 1;
        text-align: center;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-flex-direction: column;
        flex-direction: column;
    }
    .saler>div{
        width:130px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .table-row .list-inner.ops,  .table-row .list-inner.paystyle{
        -webkit-flex-direction: column;
        flex-direction: column;
       -webkit-justify-content: center;
       justify-content: center;
    }
    .table-header .others{
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        -ms-flex: 1;
        flex: 1;
        text-align: center;
    }
    .table-footer{
        border-top: 1px solid #efefef;
    }
    .table-footer>div, .table-top>div{
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        -ms-flex: 1;
        flex: 1;
        height:100%;
    }
    .fixed-header div{
        padding:0;
    }
    .fixed-header.table-header{
        display: none;
    }
    .fixed-header.table-header.active{
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
    }
    .shop{
        display: inline-block;
        width:48px;
        height:18px;
        text-align: center;
        border:1px solid #1b86ff;
        color: #1b86ff;
        margin-right: 10px;
    }
    .min_program{
        display: inline-block;
        width:48px;
        height:18px;
        text-align: center;
        border:1px solid #ff5555;
        color: #ff5555;
        margin-right: 10px;
    }
</style>

<div class="page-header">
    当前位置：<span class="text-primary">订单管理</span>
    <span>订单数:  <span class='text-danger'><?php  echo $total['count'];?></span> 订单金额:  <span class='text-danger'><?php  echo $total['sum'];?></span> </span>
</div>
<div class="page-content">
    <form action="./index.php" method="get" class="form-horizontal table-search" role="form"  id="search">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="wx_shop" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r" value="order.sd_list" />
        <div class="page-toolbar">
            <div class="input-group">
                <span class="input-group-select">
                    <select name="status" class="form-control" style="width:100px;padding:0 5px;">
                        <option value="" <?php  if($_GPC['status']=='') { ?>selected<?php  } ?>>是否提交</option>
                        <option value="2" <?php  if($_GPC['status']== 2) { ?>selected<?php  } ?>>已提交</option>
                        <option value="1" <?php  if($_GPC['status']== 1) { ?>selected<?php  } ?>>未提交</option>
                    </select>
                </span>
                <span class="input-group-select">
                    <select name='searchtime'  class='form-control'   style="width:100px;padding:0 5px;"  id="searchtime">
                        <option value=''>不按时间</option>
                        <option value='create' <?php  if($_GPC['searchtime']=='create') { ?>selected<?php  } ?>>下单时间</option>
                        <option value='finish' <?php  if($_GPC['searchtime']=='finish') { ?>selected<?php  } ?>>完成时间</option>
                    </select>
                </span>
                <span class="input-group-select">
                    <select name='freeze'  class='form-control'   style="width:100px;padding:0 5px;">
                        <option value=''>冻结订单</option>
                        <option value='2' <?php  if($_GPC['freeze']=='2') { ?>selected<?php  } ?>>已解冻</option>
                        <option value='1' <?php  if($_GPC['freeze']=='1') { ?>selected<?php  } ?>>已冻结</option>
                        <option value='3' <?php  if($_GPC['freeze']=='3') { ?>selected<?php  } ?>>未冻结</option>
                    </select>
                </span>

                <span class="input-group-select">
                    <select name='searchtime'  class='form-control'   style="width:100px;padding:0 5px;"  id="searchtime">
                        <option value=''>不按时间</option>
                        <option value='create' <?php  if($_GPC['searchtime']=='create') { ?>selected<?php  } ?>>下单时间</option>
                        <option value='finish' <?php  if($_GPC['searchtime']=='finish') { ?>selected<?php  } ?>>完成时间</option>
                    </select>
                </span>
                <span class="input-group-btn">
                    <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>
                </span>
                <input type="text" class="form-control input-sm"  name="keyword" id="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"/>
                <input type="hidden" name="export" id="export" value="0">
                <span class="input-group-btn">
                    <button type="button" data-export="0" class="btn btn-primary btn-submit"> 搜索</button>
                </span>
            </div>
        </div>
    </form>
    <?php  if(count($list)>0) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="table-header" style='background:#f8f8f8;height: 35px;line-height: 35px;padding: 0 20px'>
                        <div style='border-left:1px solid #f2f2f2;width: 400px;text-align: left;'>商品</div>
                        <div class="others">买家</div>
                        <div class="others">收货</div>
                        <div class="others">佣金</div>
                        <div class="others">状态</div>
                    </div>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                        <div class="table-row"><div style='height:20px;padding:0;border-top:none;'>&nbsp;</div></div>
                        <div class="tables">
                            <div class='table-row table-top' style="padding:0  20px;background: #f7f7f7">
                                <div style="text-align: left;color: #8f8e8e;">
                                    <span style="font-weight: bold;margin-right: 10px;color: #2d2d31">
                                        <?php  echo date('Y-m-d',$item['createtime'])?>&nbsp <?php  echo date('H:i:s',$item['createtime'])?>
                                    </span>
                                    订单编号:  <?php  echo $item['ordersn'];?>
                                </div>
                            </div>

                            <div class='table-row' style="margin:0  20px">
                                <div class="goods-des" style='width:400px;text-align: left'>
                                    <div style="display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;margin: 10px 0">
                                        <img src="<?php  echo $item['thumb'];?>" style='width:70px;height:70px;border:1px solid #efefef; padding:1px;'onerror="this.src='../addons/wx_shop/static/images/nopic.png'">
                                        <div style="-webkit-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;margin-left: 10px;text-align: left;display: flex;align-items: center">
                                            <div >
                                               <div class="title">
                                                   <?php  echo $item['title'];?><br/>
                                               </div>
                                            </div>
                                            <span style="float: right;text-align: right;display: inline-block;width:130px;">
                                                ￥<?php  echo $item['price'];?><br/>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-inner saler"   style='text-align: center;' >
                                    <div>
                                        <?php if(cv('member.list.edit')) { ?>
                                            <a href="<?php  echo webUrl('member/list/detail',array('id'=>$item['mid']))?>"> <?php  echo $item['nickname'];?></a>
                                        <?php  } else { ?>
                                            <?php  echo $item['nickname'];?>
                                        <?php  } ?>
                                        <br/>
                                        <?php  echo $item['realname'];?><br/><?php  echo $item['mobile'];?>
                                    </div>
                                </div>
                                <div class="list-inner paystyle"  style='text-align:center;' >
                                    <?php  echo $item['address']['realname'];?><br/>
                                    <?php  echo $item['address']['mobile'];?><br/>
                                    <?php  echo $item['address']['province'];?>
                                    <?php  echo $item['address']['city'];?>
                                    <?php  echo $item['address']['area'];?><br/>
                                    <?php  echo $item['address']['address'];?>
                                </div>
                                
                                <a  class="list-inner" data-toggle='popover' data-html='true' data-placement='right' data-trigger="hover"> 
                                    <div  style='text-align:center' >
                                        ￥<?php  echo $item['commission'];?>
                                    </div>
                                </a>
                                
                                <div  class='ops list-inner' style='line-height:20px;text-align:center' >
                                    <span class="text-<?php  echo $item['statuscss'];?>">
                                        <?php  if($item['freeze'] == 1) { ?>
                                            <span style="color: red;">
                                                订单已冻结
                                            </span>
                                        <?php  } else if($item['freeze'] == 2) { ?>
                                            <span style="color: red;">
                                                订单解冻退款
                                            </span>
                                        <?php  } else { ?>
                                            <?php  if($item['status'] == 1) { ?>
                                                <span style="color:silver;">订单未提交</span>
                                            <?php  } else { ?>
                                                <span style="color:orangered;">佣金已发放</span>
                                            <?php  } ?>
                                        <?php  } ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php  } } ?>
                    <div style="padding: 20px;text-align: right" >
                        <?php  echo $pager;?>
                    </div>
                </div>
            </div>
        </div>
    <?php  } else { ?>
        <div class="panel panel-default">
            <div class="panel-body empty-data">暂时没有任何订单!</div>
        </div>
    <?php  } ?>
</div>

<script>
    //没有选中时间段不能导出
    $(function () {
        $('.btn-submit').click(function () {
            var e = $(this).data('export');
            if(e==1 ){
                if($('#keyword').val() !='' ){
                    $('#export').val(1);
                    $('#search').submit();
                }else if($('#searchtime').val()!=''){
                    $('#export').val(1);
                    $('#search').submit();
                }else{
                    tip.msgbox.err('请先选择时间段!');
                    return;
                }
            }else{
                $('#export').val(0);
                $('#search').submit();
            }
        })
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

