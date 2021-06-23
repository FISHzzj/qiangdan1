<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">
    当前位置：<span class="text-primary"><?php  if(!empty($level['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>会员等级大厅<?php  if(!empty($level['id'])) { ?>(<?php  echo $level['levelname'];?>)<?php  } ?></span>
</div>

<div class="page-content">
    <div class="page-sub-toolbar">
        <span class=''>
            <?php if(cv('member.level.add')) { ?>
                <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('member/sd_level/add')?>">等级大厅管理</a>
            <?php  } ?>
        </span>
    </div>
    <form <?php if( ce('member.level' ,$level) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $level['id'];?>" />
        <?php  if($id!='default') { ?>
            <div class="form-group">
                <label class="col-lg control-label">排序</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('member.level' ,$level) ) { ?>
                        <select  name="level" class="form-control tp_is_default" style="width:90px;">
                            <?php  if(is_array($level_array)) { foreach($level_array as $key => $value) { ?>
                                <option value="<?php  echo $value;?>" <?php  if($level['level']==$value) { ?>selected<?php  } ?>><?php  echo $value;?></option>
                            <?php  } } ?>
                        </select>
                        <span class='help-block'>数字越大等级越高且不能重复</span>
                    <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $level['level'];?></div>
                    <?php  } ?>
                </div>
            </div>
        <?php  } ?>
        <div class="form-group">
            <label class="col-lg control-label must"> <?php  if($id=='default') { ?>默认<?php  } ?>等级名称</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('member.level' ,$level) ) { ?>
                    <input type="text" name="levelname" class="form-control" value="<?php  echo $level['levelname'];?>" data-rule-required="true" />
                <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $level['levelname'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label must">大厅名称</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('member.level' ,$level) ) { ?>
                    <input type="text" name="hallname" class="form-control" value="<?php  echo $level['hallname'];?>" data-rule-required="true" />
                <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $level['hallname'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label">大厅图片</label>
            <div class="col-sm-9 col-xs-12">
                <div class="">
                    <?php  echo tpl_form_field_image2('picture',$level['picture'])?>
                </div>
            </div>
        </div>

        <?php  if($id!='default') { ?>
            <div class="form-group">
                <label class="col-lg control-label">升级条件</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('member.level' ,$level) ) { ?>
                        <div class='input-group fixsingle-input-group'>
                            <span class='input-group-addon'>邀请人数</span>
                            <input type="text" name="invitations_num" class="form-control" value="<?php  echo $level['invitations_num'];?>" />
                            <span class='input-group-addon'>人</span>
                        </div>
                        <div class='input-group fixsingle-input-group'>
                            <span class='input-group-addon'>单个累计充值</span>
                            <input type="text" name="recharge" class="form-control" value="<?php  echo $level['recharge'];?>" />
                            <span class='input-group-addon'></span>
                        </div>
                        <span class='help-block'>会员升级条件</span>
                    <?php  } else { ?>
                        <div class='form-control-static'>
                            <?php  if($level['invitations_num'] > 0) { ?>
                                邀请人数： <?php  echo $level['invitations_num'];?>人
                                <br/>
                                单个累计充值：<?php  echo $level['recharge'];?>
                            <?php  } else { ?>
                                --
                            <?php  } ?>
                        </div>
                    <?php  } ?>
                </div>
            </div>
        <?php  } ?>

        <div class="form-group">
            <label class="col-lg control-label">佣金比例</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('member.level' ,$level) ) { ?>
                    <div class="input-group fixsingle-input-group">
                        <input type="text" name="c_proportion" class="form-control" value="<?php  echo $level['c_proportion'];?>" />
                        <div class="input-group-addon">%</div>
                    </div>
                    <span class='help-block'>请输入1~100之间的数字,值为空或0代表不设置比例，在此大厅接取任务将不产生佣金</span>
                <?php  } else { ?>
                    <div class='form-control-static'>
                        <?php  if(empty($level['c_proportion'])) { ?>
                            0
                        <?php  } else { ?>
                            <?php  echo $level['c_proportion'];?>%
                        <?php  } ?>
                    </div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label">抢单几率</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('member.level' ,$level) ) { ?>
                    <div class="input-group fixsingle-input-group">
                        <input type="text" name="gs_probability" class="form-control" value="<?php  echo $level['gs_probability'];?>" />
                        <div class="input-group-addon">%</div>
                    </div>
                    <span class='help-block'>请输入1~100之间的数字,抢单几率将在会员福利页面仅供显示</span>
                <?php  } else { ?>
                    <div class='form-control-static'>
                        <?php  if(empty($level['gs_probability'])) { ?>
                            0
                        <?php  } else { ?>
                            <?php  echo $level['gs_probability'];?>%
                        <?php  } ?>
                    </div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label">福利说明</label>
            <div class="col-sm-9 col-xs-12">
                  <textarea style="width: 400px;height: 400px;" size="10"  type="text" id='details' name="details" class="form-control" > <?php  echo $level['details'];?></textarea>
            </div>
        </div>
        
        <div class="form-group"></div>
        <div class="form-group">
            <label class="col-lg control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('member.level' ,$level) ) { ?>
                    <input type="submit" value="提交" class="btn btn-primary"  />
                <?php  } ?>
                <input type="button" name="back" onclick='history.back()' <?php if(cv('member.level.add|member.level.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
            </div>
        </div>
    </form>

</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

