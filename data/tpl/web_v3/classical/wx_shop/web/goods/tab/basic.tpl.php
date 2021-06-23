<?php defined('IN_IA') or exit('Access Denied');?><div class="region-goods-details row">
    <div class="region-goods-left col-sm-2">
        基本信息
    </div>
    <div class="region-goods-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">排序</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('goods' ,$item) ) { ?>
                    <input type="text" name="displayorder" id="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
                    <span class='help-block'>数字越大，排名越靠前,如果为空，默认排序方式为创建时间</span>
                <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $item['displayorder'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">商品名称</label>
            <?php if( ce('goods' ,$item) ) { ?>
                <div class="col-sm-7"  style="padding-right:0;" >
                    <input type="text" name="goodsname" id="goodsname" class="form-control" value="<?php  echo $item['title'];?>" data-rule-required="true" />
                </div>
                <div class="col-sm-2" style="padding-left:5px">
                    <input type="text" name="unit" id="unit" class="form-control" value="<?php  echo $item['unit'];?>" placeholder="单位, 如: 个/件/包"  />
                </div>
            <?php  } else { ?>
                <div class='form-control-static'><?php  echo $item['title'];?></div>
            <?php  } ?>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label must">商品订单归属</label>
            <?php if( ce('goods' ,$item) ) { ?>
                <div class="col-sm-7"  style="padding-right:0;" >
                    <input type="text" name="guishu" id="guishu" class="form-control" value="<?php  echo $item['guishu'];?>" data-rule-required="true" />
                </div>
            <?php  } else { ?>
                <div class='form-control-static'><?php  echo $item['guishu'];?></div>
            <?php  } ?>
        </div>
    </div>
</div>

    <!--商品信息-->
    <div class="region-goods-details row">
        <div class="region-goods-left col-sm-2">
            商品信息
        </div>

        <div class="region-goods-right col-sm-10">
            <div class="form-group price">
                <label class="col-sm-2 control-label">商品价格</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('goods' ,$item) ) { ?>
                        <div class="input-group">
                            <input type="text" name="marketprice" id="marketprice" class="form-control" value="<?php  echo $item['marketprice'];?>" />
                            <span class="input-group-addon">元</span>
                        </div>
                        ~~
                        <div class="input-group">
                            <input type="text" name="marketprice2" id="marketprice2" class="form-control" value="<?php  echo $item['marketprice2'];?>" />
                            <span class="input-group-addon">元</span>
                        </div>
                        <span class='help-block'>尽量填写完整，有助于于商品销售的数据分析</span>
                    <?php  } else { ?>
                        <div class='form-control-static'>价格：<?php  echo $item['marketprice'];?> 元 ~~ <?php  echo $item['marketprice2'];?> 元</div>
                    <?php  } ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label must">商品图片</label>
                <div class="col-sm-9 col-xs-12 gimgs">
                    <?php if( ce('goods' ,$item) ) { ?>
                        <!-- <?php  echo tpl_form_field_multi_image2('thumbs',$piclist)?> -->
                        <?php  echo tpl_form_field_image2('thumbs', $item['thumb'])?>
                        <!-- <span class="help-block">您可以拖动图片改变其显示顺序 </span> -->
                    <?php  } else { ?>
                        <!-- <?php  if(is_array($piclist)) { foreach($piclist as $p) { ?>
                            <a href='<?php  echo tomedia($p)?>' target='_blank'>
                                <img src="<?php  echo tomedia($p)?>" style='height:100px;border:1px solid #ccc;padding:1px;float:left;margin-right:5px;' />
                            </a>
                        <?php  } } ?> -->
                        <a href="<?php  echo tomedia($item['thumb'])?>" target='_blank'>
                            <img src="<?php  echo tomedia($item['thumb'])?>" style='height:100px;border:1px solid #ccc;padding:1px;float:left;margin-right:5px;' />
                        </a>
                    <?php  } ?>
                </div>
            </div>
        </div>
    </div>

<div class="region-goods-details row">
    <div class="region-goods-left col-sm-2">
        商品属性
    </div>
    <div class="region-goods-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">特殊商品</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('goods' ,$item) ) { ?>
                    <label class="radio-inline"><input type="radio" name="type" value="0" <?php  if(empty($item['type'])) { ?>checked="true"<?php  } ?>/> 否</label>
                    <label class="radio-inline"><input type="radio" name="type" value="1" <?php  if($item['type'] == 1) { ?>checked="true"<?php  } ?>   /> 是</label>
                <?php  } else { ?>
                    <div class='form-control-static'><?php  if(empty($item['type'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">上架</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('goods' ,$item) ) { ?>
                    <label class="radio-inline"><input type="radio" name="status" value="0" <?php  if(empty($item['status'])) { ?>checked="true"<?php  } ?>/> 否</label>
                    <label class="radio-inline"><input type="radio" name="status" value="1" <?php  if($item['status'] == 1) { ?>checked="true"<?php  } ?>   /> 上架</label>
                <?php  } else { ?>
                    <div class='form-control-static'><?php  if(empty($item['status'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
                <?php  } ?>
            </div>
        </div>

        <!-- 等级大厅7244追加 -->
        <div class="form-group">
            <label class="col-sm-2 control-label">等级大厅</label>
            <div class="col-sm-8 col-xs-12">
                <?php if( ce('goods' ,$item) ) { ?>
                    <select id="sd_hall"  name='sd_hall' class="form-control select2" style='width:605px;' >
                        <option value="0">默认大厅</option>
                        <?php  if(is_array($levelHall)) { foreach($levelHall as $hall) { ?>
                            <option value="<?php  echo $hall['level'];?>" <?php  if($hall['level'] == $item['sd_hall']) { ?> selected="" <?php  } ?> ><?php  echo $hall['levelname'];?></option>
                        <?php  } } ?>
                    </select>
                <?php  } else { ?>
                    <div class='form-control-static ops'>
                        <?php  if(is_array($levelHall)) { foreach($levelHall as $hall) { ?>
                            <a><?php  echo $hall['levelname'];?></a>
                        <?php  } } ?>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </div>
</div>

<script language="javascript">
    require(['jquery.ui'],function(){
        $('.multi-img-details').sortable({scroll:'false'});
        $('.multi-img-details').sortable('option', 'scroll', false);
    })
</script>

<?php  if(empty($new_area)) { ?>
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('shop/selectareas', TEMPLATE_INCLUDEPATH)) : (include template('shop/selectareas', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('shop/selectareasNew', TEMPLATE_INCLUDEPATH)) : (include template('shop/selectareasNew', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
