<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">当前位置：<span class="text-primary">关于我们</span></div>
<div class="page-content">
    <form action="" method="post" class="form-horizontal form-validate">

        <div class="form-group">
            <label class="col-lg control-label">视频</label>
            <div class="col-sm-9 col-xs-12">
                <div class="">
                    <?php  echo tpl_form_field_video2("video", $data['video'])?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label">公司简介</label>
            <div class="col-sm-9 col-xs-12">
                <div class="">
                    <?php  echo tpl_ueditor('data[introduction]',$data['introduction'],array('height'=>'300'))?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label">规则说明</label>
            <div class="col-sm-9 col-xs-12">
                <div class="">
                    <?php  echo tpl_ueditor('data[rule]',$data['rule'],array('height'=>'300'))?>
                </div>
            </div>
        </div>
       
        <div class="form-group">
            <label class="col-lg control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <input type="submit" value="提交" class="btn btn-primary" />
            </div>
        </div>
		
    </form>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>


