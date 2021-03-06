<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">当前位置：<span class="text-primary">基本设置</span></div>
<div class="page-content">
    <form action="" method="post" class="form-horizontal form-validate">
        <div class="form-group">
            <label class="col-lg control-label">抢单开始时间</label>
            <div class="col-sm-4 col-xs-6">
                <?php echo tpl_form_field_clock('data[start_time]', !empty($data['start_time']) ? $data['start_time'] : date('H:i'))?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">抢单结束时间</label>
            <div class="col-sm-4 col-xs-6">
                <?php echo tpl_form_field_clock('data[end_time]', !empty($data['end_time']) ? $data['end_time'] : date('H:i'))?>
            </div>
        </div>

        <!-- <div class="form-group">
            <label class="col-lg control-label">每天提现开始时间</label>
            <div class="col-sm-4 col-xs-6">
                <?php echo tpl_form_field_clock('data[txstart_time]', !empty($data['txstart_time']) ? $data['txstart_time'] : date('H:i'))?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label">每天提现结束时间</label>
            <div class="col-sm-4 col-xs-6">
                <?php echo tpl_form_field_clock('data[txend_time]', !empty($data['txend_time']) ? $data['txend_time'] : date('H:i'))?>
            </div>
        </div>
         <div class="form-group">
            <label class="col-lg control-label">提现手续费</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="tx[withdrawcharge]" class="form-control" value="<?php  echo $tx['withdrawcharge'];?>" />
                    <div class="input-group-addon">%</div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label">每天提现次数</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="tx[everydaywithdrawmoney]" class="form-control" value="<?php  echo $tx['everydaywithdrawmoney'];?>" />
                    <div class="input-group-addon">次</div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label">每次提现最少金额</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="tx[withdrawmoney]" class="form-control" value="<?php  echo $tx['withdrawmoney'];?>" />
                    <div class="input-group-addon">元</div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-lg control-label">每次提现最大金额</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="tx[maxwithdrawmoney]" class="form-control" value="<?php  echo $tx['maxwithdrawmoney'];?>" />
                    <div class="input-group-addon">元</div>
                </div>
            </div>
        </div> -->

       <!--   <div class="form-group">
            <label class="col-lg control-label">订单额度倍数</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[ordercredit]" class="form-control" value="<?php  echo $data['ordercredit'];?>" />
                    <div class="input-group-addon">倍,每天订单数量</div>
                    <input type="text" name="data[ordersum]" class="form-control" value="<?php  echo $data['ordersum'];?>" />
                    <div class="input-group-addon">单</div>
                </div>
            </div>
        </div>
 -->
       <!--  <div class="form-group">
            <label class="col-lg control-label">开户保证金</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[account]" class="form-control" value="<?php  echo $data['account'];?>" />
                    <div class="input-group-addon">元</div>
                </div>
            </div>
        </div> -->

       <!--  <div class="form-group">
            <label class="col-lg control-label">开户保证金直推奖励</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[ztbzj]" class="form-control" value="<?php  echo $data['ztbzj'];?>" />
                    <div class="input-group-addon">元</div>
                </div>
            </div>
        </div>
 -->
        <div class="form-group">
            <label class="col-lg control-label">每个用户每天限制单数</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[limit]" class="form-control" value="<?php  echo $data['limit'];?>" />
                    <div class="input-group-addon">单</div>
                </div>
            </div>
        </div>
       <!--  <div class="form-group">
            <label class="col-lg control-label">每个用户最低抢单余额</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[credit2]" class="form-control" value="<?php  echo $data['credit2'];?>" />
                    <div class="input-group-addon">元</div>
                </div>
            </div>
        </div> -->

        <!-- <div class="form-group">
            <label class="col-lg control-label">每个用户抢单满足</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[sumorder]" class="form-control" value="<?php  echo $data['sumorder'];?>" />
                    <div class="input-group-addon">元,后奖励</div>
                    <input type="text" name="data[jlmoney]" class="form-control" value="<?php  echo $data['jlmoney'];?>" />
                    <div class="input-group-addon">元</div>
                </div>
            </div>
        </div> -->

        <div class="form-group">
            <label class="col-lg control-label">用户最少不重复抢单次数</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[chongfu]" class="form-control" value="<?php  echo $data['chongfu'];?>" />
                    <div class="input-group-addon">次</div>
                </div>
            </div>
        </div>

       <!--  <div class="form-group">
            <label class="col-lg control-label">商品统一返佣比例</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[fanyong]" class="form-control" value="<?php  echo $data['fanyong'];?>" />
                    <div class="input-group-addon">%</div>
                </div>
            </div>
        </div> -->

       <!--   <div class="form-group">
            <label class="col-lg control-label">开通市代押金</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[sdyj1]" class="form-control" value="<?php  echo $data['sdyj1'];?>" />
                    <div class="input-group-addon">元</div>
                </div>
            </div>
        </div>

         <div class="form-group">
            <label class="col-lg control-label">开通省代代押金</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[sdyj2]" class="form-control" value="<?php  echo $data['sdyj2'];?>" />
                    <div class="input-group-addon">元</div>
                </div>
            </div>
        </div> -->
       <!--  <div class="form-group">
            <label class="col-lg control-label">推广有效用户增加次数</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[add_limit]" class="form-control" value="<?php  echo $data['add_limit'];?>" />
                    <div class="input-group-addon">单</div>
                </div>
            </div>
        </div> -->
      <!--   <div class="form-group">
            <label class="col-lg control-label">推广有效用户最大增加次数</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[max_number]" class="form-control" value="<?php  echo $data['max_number'];?>" />
                    <div class="input-group-addon">单</div>
                </div>
            </div>
        </div> -->
       <!--  <div class="form-group">
            <label class="col-lg control-label">新用户注册体检金</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[bbin]" class="form-control" value="<?php  echo $data['bbin'];?>" />
                    <div class="input-group-addon">元</div>
                </div>
            </div>
        </div> -->
        <div class="form-group">
            <label class="col-lg control-label">抢单金额随机范围</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[random_start]" class="form-control" value="<?php  echo $data['random_start'];?>" />
                    <input type="text" name="data[random_end]" class="form-control" value="<?php  echo $data['random_end'];?>" />
                    <div class="input-group-addon">%</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">抢单等待时间</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[await_time]" class="form-control" value="<?php  echo $data['await_time'];?>" />
                    <div class="input-group-addon">~</div>
                    <input type="text" name="data[await_time2]" class="form-control" value="<?php  echo $data['await_time2'];?>" />
                    <div class="input-group-addon">秒</div>
                </div>
            </div>
        </div>

           <div class="form-group">
            <label class="col-lg control-label">抢单账户余额</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[qd_money]" class="form-control" value="<?php  echo $data['qd_money'];?>" />
                    <div class="input-group-addon">元</div>
                </div>
            </div>
        </div>

       <!--  <div class="form-group">
            <label class="col-lg control-label">抢单失败提示</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[qdsbts]" class="form-control" value="<?php  echo $data['qdsbts'];?>" />
                    <div class="input-group-addon">~</div>
                    <input type="text" name="data[await_times2]" class="form-control" value="<?php  echo $data['await_times2'];?>" />
                    <div class="input-group-addon">秒</div>
                </div>
            </div>
        </div> -->
          <!-- <div class="form-group">
            <label class="col-lg control-label">抢单等待时间</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[await_time1]" class="form-control" value="<?php  echo $data['await_time1'];?>" />
                    <div class="input-group-addon">~</div>
                    <input type="text" name="data[await_time2]" class="form-control" value="<?php  echo $data['await_time2'];?>" />
                    <div class="input-group-addon">秒</div>
                </div>
            </div>
        </div> -->
        <div class="form-group">
                <label class="col-lg control-label">抢单后提交时间</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="input-group fixsingle-input-group">
                        <input type="text" name="data[freeze_time1]" class="form-control" value="<?php  echo $data['freeze_time1'];?>" />
                        <div class="input-group-addon">秒</div>
                    </div>
                </div>
            </div>
        <div class="form-group">
            <label class="col-lg control-label">冻结后多久退款</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[freeze_time]" class="form-control" value="<?php  echo $data['freeze_time'];?>" />
                    <div class="input-group-addon">分钟</div>
                </div>
            </div>
        </div>
        <!-- <div class="form-group">
            <label class="col-lg control-label">注册后多少天没有抢单就封号</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[titles_time]" class="form-control" value="<?php  echo $data['titles_time'];?>" />
                    <div class="input-group-addon">天</div>
                </div>
            </div>
        </div> -->
        <!-- <div class="form-group">
            <label class="col-lg control-label">支付宝付款码</label>
            <div class="col-sm-9 col-xs-12">
                <div class="">
          
                    <?php  echo tpl_form_field_image2('data[alipay]',$data['alipay'])?>
             
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">微信付款码</label>
            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_image2('data[wechat]',$data['wechat'])?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">银行卡信息</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="data[realname]" class="form-control" value="<?php  echo $data['realname'];?>" placeholder="账户姓名"/>
                    <input type="text" name="data[bankname]" class="form-control" value="<?php  echo $data['bankname'];?>" placeholder="银行名称"/>
                    <input type="text" name="data[branch]" class="form-control" value="<?php  echo $data['branch'];?>" placeholder="支行名称"/>
                    <input type="text" name="data[bankcard]" class="form-control" value="<?php  echo $data['bankcard'];?>" placeholder="银行卡号"/>
                </div>
            </div>
        </div> -->
        <div class="form-group">
            <label class="col-lg control-label">抢单备注说明</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <textarea style="width: 400px;height: 400px;" size="10"  type="text" name="data[qdbzsm]" class="form-control" > <?php  echo $data['qdbzsm'];?></textarea>
                   
                </div>
            </div>
        </div>
		<!-- <div class="form-group">
			   <label class="col-lg control-label">首页内容</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="">
                    
                        <?php  echo tpl_ueditor('data[content]',$data['content'],array('height'=>'300'))?>
                
                    </div>
                </div>
        </div> -->

        <!-- <div class="form-group">
               <label class="col-lg control-label">关于内容</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="">
                    
                        <?php  echo tpl_ueditor('data[about]',$data['about'],array('height'=>'300'))?>
                
                    </div>
                </div>
        </div> -->
       <!--  <div class="form-group">
               <label class="col-lg control-label">简介</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="">
                    
                        <?php  echo tpl_ueditor('data[content1]',$data['content1'],array('height'=>'300'))?>
                
                    </div>
                </div>
        </div>
        <div class="form-group">
               <label class="col-lg control-label">规则</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="">
                    
                        <?php  echo tpl_ueditor('data[content2]',$data['content2'],array('height'=>'300'))?>
                
                    </div>
                </div>
        </div>
         <div class="form-group">
               <label class="col-lg control-label">合作</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="">
                    
                        <?php  echo tpl_ueditor('data[content3]',$data['content3'],array('height'=>'300'))?>
                
                    </div>
                </div>
        </div>
        <div class="form-group">
               <label class="col-lg control-label">问题</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="">
                    
                        <?php  echo tpl_ueditor('data[content4]',$data['content4'],array('height'=>'300'))?>
                
                    </div>
                </div>
        </div> -->
        <div class="form-group">
                <label class="col-lg control-label">弹框公告</label>
                 <div class="col-sm-9 col-xs-12">
                     <div class="">
                     
                         <?php  echo tpl_ueditor('data[notice]',$data['notice'],array('height'=>'300'))?>
                 
                     </div>
                 </div>
        </div>
        
        <div class="form-group">
                <label class="col-lg control-label">理财介绍</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="">
                         <?php  echo tpl_ueditor('data[transactions]',$data['transactions'],array('height'=>'300'))?>
                    </div>
                </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <input type="submit" value="提交" class="btn btn-primary"  />
            </div>
        </div>
		
    </form>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>


