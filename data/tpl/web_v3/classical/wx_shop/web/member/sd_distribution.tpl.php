<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">当前位置：<span class="text-primary">分销设置</span></div>
<div class="page-content">
    <form action="" method="post" class="form-horizontal form-validate">
        
         <div class="form-group">
            <label class="col-lg control-label">一级佣金比例</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="price1" class="form-control" value="<?php  echo $distribution['price1'];?>" />
                    <div class="input-group-addon">%</div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label">二级佣金比例</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="price2" class="form-control" value="<?php  echo $distribution['price2'];?>" />
                    <div class="input-group-addon">%</div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label">三级佣金比例</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" name="price3" class="form-control" value="<?php  echo $distribution['price3'];?>" />
                    <div class="input-group-addon">%</div>
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