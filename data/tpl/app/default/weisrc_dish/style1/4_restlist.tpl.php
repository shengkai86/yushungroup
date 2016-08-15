<?php defined('IN_IA') or exit('Access Denied');?><html lang="zh-CN">
<head>
    <style type="text/css">@charset "UTF-8";
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak, .ng-hide:not(.ng-hide-animate) {
        display: none !important;
    }

    ng\:form {
        display: block;
    }</style>
    <style type="text/css">@charset "UTF-8";
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak, .ng-hide:not(.ng-hide-animate) {
        display: none !important;
    }
    ng\:form {
        display: block;
    }

    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <title>门店列表</title>
    <link data-turbolinks-track="true" href="<?php echo RES;?>/mobile/<?php  echo $this->cur_tpl?>/assets/diandanbao/weixin.css?v=1" media="all" rel="stylesheet">
    <style type="text/css">
        @media screen {
        .smnoscreen {
            display: none
        }
    }
    @media print {
        .smnoprint {
            display: none
        }
    }</style>
    <script type="text/javascript" src="../addons/weisrc_dish/template/js/2/jQuery.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5PESLgvMcSbSUbPjmDKgvGZ3"></script>
    <script type="text/javascript" src="../addons/weisrc_dish/template/js/postion.js?v=3"></script>
</head>
<body>
<div style="height: 100%;" class="ng-scope">
    <div class="ddb-nav-header ng-scope">
        <a class="nav-left-item" href="javascript:history.back(-1);"><i class="fa fa-angle-left"></i></a>
        <div class="header-title ng-binding">门店列表</div>
        <a class="nav-right-item" href="<?php  echo $this->createMobileUrl('search', array(), true)?>">
            <div class="operation-button gray"><i class="fa fa-search"></i>
            </div>
        </a>
    </div>
    <div class="ddb-secondary-nav-header ng-isolate-scope" on-pickup="onPickupFilter">
        <div class="ddb-tab-bar">
            <div class="ddb-tab-item ng-scope">
                <a href="javascript:;" class="ng-binding" id="store_classify">品牌分类</a>
                <i class="fa fa-caret-down"></i>
            </div>
            <div class="ddb-tab-item ng-scope">
                <a href="javascript:;" class="ng-binding"><?php  echo $curarea;?></a>
                <i class="fa fa-caret-down"></i>
            </div>
            <div class="ddb-tab-item ng-scope" ng-repeat="pane in panes" ng-class="{active:pane.selected}"
                 ng-click="toggle(pane)">
                <a href="javascript:;" class="ng-binding"><?php  echo $cursort;?></a>
                <i class="fa fa-caret-down"></i>
            </div>
        </div>
        <div class="ddb-box filter-nav-box ng-hide" ng-show="mask" ng-click="select()">
            <div class="box-mask"></div>
        </div>
        <div class="filter-nav-menu" ng-transclude="">
            <div class="ddb-nav-pane ng-isolate-scope ng-hide">
                <div class="sub-pane cur-sub-pane ng-scope ng-isolate-scope">
                    <ul class="shoptype ng-scope">
                        <li class="sub-item active" data-id="0">
                            <div class="name ng-binding">
                                品牌分类 <?php  if($typeid == 0) { ?><i class="fa fa-check-circle pull-right ng-scope"></i><?php  } ?>
                            </div>
                        </li>
                        <?php  if(is_array($shoptype)) { foreach($shoptype as $item) { ?>
                        <li class="sub-item ng-scope" data-id="<?php  echo $item['id'];?>">
                            <div class="name ng-binding">
                                <?php  echo $item['name'];?> <?php  if($typeid == $item['id']) { ?><i class="fa fa-check-circle pull-right ng-scope"></i><?php  } ?>
                            </div>
                        </li>
                        <?php  } } ?>
                    </ul>
                </div>
            </div>
            <div class="ddb-nav-pane ng-isolate-scope ng-hide">
                <div class="sub-pane cur-sub-pane ng-scope ng-isolate-scope" >
                    <ul class="areatype ng-scope">
                        <li class="sub-item active" data-id="0">
                            <div class="name ng-binding">
                                全城 <?php  if($areaid == 0) { ?><i class="fa fa-check-circle pull-right ng-scope"></i><?php  } ?>
                            </div>
                        </li>
                        <?php  if(is_array($area)) { foreach($area as $item) { ?>
                        <li class="sub-item ng-scope" data-id="<?php  echo $item['id'];?>">
                            <div class="name ng-binding">
                                <?php  echo $item['name'];?> <?php  if($areaid == $item['id']) { ?><i class="fa fa-check-circle pull-right ng-scope"></i><?php  } ?>
                            </div>
                        </li>
                        <?php  } } ?>
                    </ul>
                </div>
            </div>
            <div class="ddb-nav-pane ng-isolate-scope ng-hide">
                <div class="sub-pane cur-sub-pane ng-scope ng-isolate-scope" >
                    <ul class="shopsort ng-scope">
                        <li class="sub-item active" data-id="0">
                            <div class="name ng-binding">
                                综合排序
                                <?php  if($sortid == 0) { ?>
                                <i class="fa fa-check-circle pull-right ng-scope"></i>
                                <?php  } ?>
                            </div>
                        </li>
                        <li class="sub-item ng-scope" data-id="1">
                            <div class="name ng-binding">
                                正在营业
                                <?php  if($sortid == 1) { ?>
                                <i class="fa fa-check-circle pull-right ng-scope"></i>
                                <?php  } ?>
                            </div>
                        </li>
                        <li class="sub-item ng-scope" data-id="2">
                            <div class="name ng-binding">
                                距离优先
                                <?php  if($sortid == 2) { ?>
                                <i class="fa fa-check-circle pull-right ng-scope"></i>
                                <?php  } ?>
                            </div>
                        </li>
                        <!--<li class="sub-item ng-scope" >-->
                            <!--<div class="name ng-binding">-->
                                <!--预订优先-->
                            <!--</div>-->
                        <!--</li>-->
                        <!--<li class="sub-item ng-scope" >-->
                            <!--<div class="name ng-binding">-->
                                <!--无起送金额-->
                            <!--</div>-->
                        <!--</li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--footer-->
    <?php  include $this->template($this->cur_tpl.'/_menu');?>
    <div id="ddb-delivery-branch-index" class="main-view ng-scope">
        <?php  if(is_array($restlist)) { foreach($restlist as $item) { ?>
        <div class="morelist branch-item ng-scope <?php  if($this->checkStoreHour($item['begintime'], $item['endtime']) == 0) { ?>closed<?php  } ?>" >
            <input id="showlan" type="hidden" value="<?php  echo $item['lng'];?>,<?php  echo $item['lat'];?>"/>
            <a class="branch-info " href="<?php  echo $this->createMobileUrl('detail', array('id' => $item['id']), true)?>">
                <div class="branch-image">
                    <img src="<?php  echo tomedia($item['logo']);?>">
                </div>
                <div class="delivery-info">
                    <div class="first-line">
                        <div class="name ng-binding">
                            <?php  echo $item['title'];?>
                        </div>
                        <?php  if($this->checkStoreHour($item['begintime'], $item['endtime']) == 0) { ?>
                        <div class="tag label-red ng-scope">休息中</div>
                        <?php  } else { ?>
                        <div class="tag label-green ng-scope">营业中</div>
                        <?php  } ?>
                        <?php  if($item['is_meal']==1) { ?>
                        <div class="tag label-red ng-scope">店</div>
                        <?php  } ?>
                        <?php  if($item['is_delivery']==1) { ?>
                        <div class="tag label-blue ng-scope">外</div>
                        <?php  } ?>
                        <div class="distance right ng-binding" id="shopspostion"><?php  echo $this->getDistance($item['lat'], $item['lng'], $lat, $lng).'km';?></div>
                    </div>
                    <div class="second-line">
                        <div class="comment-level red">
                            <div class="ng-isolate-scope">
                                <?php  for($i=0;$i < $item['level']; $i++){ ?>
                                <i class="fa fa-star-o ng-scope"></i>
                                <?php  }?>
                            </div>
                        </div>
                    </div>
                    <div class="third-line">
                        <div class="time ng-hide" ng-show="branch.delivery_times.length &gt; 0">
                            <i class="fa fa-clock-o"></i>
                            配送时间
                        </div>
                        <div class="fee ng-binding">
                            <?php  if(!empty($item['sendingprice'])) { ?>
                            <span class="ng-binding ng-scope">￥<?php  echo $item['sendingprice'];?>起送</span>
                            <span class="spliter"></span>
                            <?php  } ?>
                            <?php  if(!empty($item['dispatchprice'])) { ?>
                            <span class="ng-binding ng-scope">配送费￥<?php  echo $item['dispatchprice'];?></span>
                            <span class="spliter"></span>
                            <?php  } ?>
                        </div>
                        <div class="address ng-binding"><?php  echo $item['address'];?></div>
                    </div>
                </div>
            </a>
            <?php  if(!empty($item['info'])) { ?>
            <div class="top-sales ng-binding ng-scope">
                <?php  echo $item['info'];?>
            </div>
            <?php  } ?>
        </div>
        <?php  } } ?>
    </div>
    <input type="hidden" id="curlat" name="curlat" value="0"/>
    <input type="hidden" id="curlng" name="curlng" value="0"/>
    <input type="hidden" id="isposition" name="isposition" value="<?php  echo $isposition;?>" />
    <input type="hidden" id="cururl" name="cururl" value="<?php  echo $this->createMobileurl('waprestlist', array(), true)?>" />
</div>
</div>
<script src="<?php echo RES;?>/mobile/<?php  echo $this->cur_tpl?>/assets/diandanbao/jquery-1.11.3.min.js"></script>
<script language="javascript">
    $('.ddb-tab-bar .ddb-tab-item').click(function () {
        $(".filter-nav-menu > .ddb-nav-pane").addClass('ng-hide').eq($('.ddb-tab-bar .ddb-tab-item').index(this)).removeClass('ng-hide');
        $(".ddb-box").removeClass('ng-hide');
    });

    $('.ddb-box').click(function () {
        $(".filter-nav-menu > .ddb-nav-pane").addClass('ng-hide').eq($('.ddb-tab-bar .ddb-tab-item').index(this)).addClass('ng-hide');
        $(".ddb-box").addClass('ng-hide');
    });
    //区域
    $('.areatype > li').click(function () {
        var curlat = $('#curlat').val();
        var curlng = $('#curlng').val();
        var id = $(this).attr("data-id");
        window.location.href = "<?php  echo $this->createMobileurl('waprestlist', array('storeid' => $storeid, 'sortid' => $sortid, 'typeid' => $typeid), true)?>" + '&areaid=' + id + '&lat=' + curlat + '&lng=' + curlng;
    });
    //商家类型
    $('.shoptype > li').click(function () {
        var curlat = $('#curlat').val();
        var curlng = $('#curlng').val();
        var id = $(this).attr("data-id");
        window.location.href = "<?php  echo $this->createMobileurl('waprestlist', array('storeid' => $storeid, 'sortid' => $sortid, 'areaid' => $areaid), true)?>" + '&typeid=' + id + '&lat=' + curlat + '&lng=' + curlng;
    });
    //排序
    $('.shopsort > li').click(function () {
        var curlat = $('#curlat').val();
        var curlng = $('#curlng').val();

        var id = $(this).attr("data-id");
        window.location.href = "<?php  echo $this->createMobileurl('waprestlist', array('storeid' => $storeid, 'typeid' => $typeid, 'areaid' => $areaid), true)?>" + '&sortid=' + id + '&lat=' + curlat + '&lng=' + curlng;
    });
</script>
</body>
</html>