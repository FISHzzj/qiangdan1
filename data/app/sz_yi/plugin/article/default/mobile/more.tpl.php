<?php defined('IN_IA') or exit('Access Denied');?><?php  if($article_sys['article_temp']==0) { ?>
    <?php  if(is_array($articles)) { foreach($articles as $article) { ?>
        <a href="<?php  echo $this->createPluginMobileUrl('article',array('aid'=>$article['id']))?>">
            <div class="line-main">
                <div class="line">
                    <div class="img">
                        <?php  if(!empty($article['resp_img'])) { ?>
                            <img src="<?php  echo $article['resp_img'];?>"/>
                        <?php  } else { ?>
                            <p style='line-height: 12px; font-size: 12px; padding: 6px; text-align: center; color: #999;'>no img</p>
                        <?php  } ?>
                    </div>
                    <div class="info" >
                        <div class="title"><?php  echo $article['article_title'];?></div>
                        <div class="ico-main">
                            <?php  if($article['article_rule_money']>0 || !empty($article['article_rule_credit'])) { ?>
                                <div class="ico">
                                    <?php  if($article['article_rule_money']>0) { ?>
                                        <?php  echo $article['article_rule_money'];?>元余额
                                    <?php  } ?>
                                    <?php  if(!empty($article['article_rule_credit'])) { ?>
                                        <?php  echo $article['article_rule_credit'];?>个积分
                                    <?php  } ?>
                                </div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    <?php  } } ?>
<?php  } else if($article_sys['article_temp']==1) { ?>
        <?php  if(is_array($articles)) { foreach($articles as $k => $v) { ?>
            <div class="list">
                <div class="date"><?php  echo $k;?></div>
                    <?php  if(count($v['articles'])==1) { ?>
                        <a href="<?php  echo $this->createPluginMobileUrl('article',array('aid'=>$v['articles'][0]['id']))?>">
                            <div class="title"><?php  echo $v['articles'][0]['article_title'];?></div>
                            <div class="img"><img src="<?php  echo $v['articles'][0]['resp_img'];?>" /></div>
                            <div class="desc"><?php  echo $v['articles'][0]['resp_desc'];?></div>
                            <div class="read">
                                <span class="left">阅读原文</span>
                                <span class="right"><span class="ico"></span></span>
                            </div>
                        </a>
                    <?php  } else { ?>
                        <?php  if(is_array($v['articles'])) { foreach($v['articles'] as $index => $vv) { ?>
                            <?php  if($index==0) { ?>
                                <a href="<?php  echo $this->createPluginMobileUrl('article',array('aid'=>$vv['id']))?>">
                                    <div class="img">
                                        <img src="<?php  echo $vv['resp_img'];?>" />
                                        <div class="img-title"><p><?php  echo $vv['article_title'];?></p></div>
                                    </div>
                                </a>
                            <?php  } else { ?>
                                <a href="<?php  echo $this->createPluginMobileUrl('article',array('aid'=>$vv['id']))?>">
                                    <div class="line">
                                        <div class="icon"><img src="<?php  echo $vv['resp_img'];?>" /></div>
                                        <div class="title"><?php  echo $vv['article_title'];?></div>
                                    </div>
                                </a>
                            <?php  } ?>
                        <?php  } } ?>
                    <?php  } ?>
            </div>
        <?php  } } ?>	 
<?php  } else if($article_sys['article_temp']==2) { ?>
    <?php  if(is_array($articles)) { foreach($articles as $article) { ?>
        <a href="<?php  echo $this->createPluginMobileUrl('article',array('aid'=>$article['id']))?>">
            <div class="line">
                <div class="img"><img src="<?php  echo $article['resp_img'];?>"/></div>
                <div class="info">
                    <div class="title"><?php  echo $article['article_title'];?></div>
                    <div class="desc"><?php  if(!empty($article['resp_desc'])) { ?><?php  echo $article['resp_desc'];?><?php  } else { ?>编辑比较懒还没有填写介绍...<?php  } ?></div>
                    <div class="date"><?php  echo $article['article_author'];?> <?php  echo $article['article_date_v'];?></div>
                </div>
            </div>
        </a>
    <?php  } } ?>
<?php  } ?>