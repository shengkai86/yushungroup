<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  echo $this -> set_tabbar($action, $storeid);?>
<?php  if($operation == 'display') { ?>
<div class="main">
    <style>
        .form-control-excel {
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
    </style>
    <div class="panel panel-default" id="uploaddata" style="display: none;">
        <div class="panel-body">
            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
                <input type="hidden" name="leadExcel" value="true">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weisrc_dish" />
                <input type="hidden" name="do" value="UploadExcel" />
                <input type="hidden" name="ac" value="goods" />
                <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
                <a class="btn btn-primary" href="javascript:location.reload()"><i class="fa fa-refresh"></i> 刷新</a>
                <input name="viewfile" id="viewfile" type="text" value="" style="margin-left: 40px;" class="form-control-excel" readonly>
                <a class="btn btn-primary"><label for="unload" style="margin: 0px;padding: 0px;">上传...</label></a>
                <input type="file" class="pull-left btn-primary span3" name="inputExcel" id="unload" style="display: none;"
                       onchange="document.getElementById('viewfile').value=this.value;this.style.display='none';">
                <!--<input type="file" class=" pull-left btn-primary span3" name="inputExcel">-->
                <input type="submit" class="btn btn-primary" name="btnExcel" value="导入数据">
                <a class="btn btn-primary" href="../addons/weisrc_dish/example/example_goods.xls">下载导入模板</a>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="./index.php" method="post" class="form-horizontal form" onsubmit="return formcheck(this)"  enctype="multipart/form-data">
                <a class="btn btn-default" href="<?php  echo $this->createWebUrl('goods', array('op' => 'post', 'storeid' => $storeid))?>"><i class="fa fa-plus"></i> 添加商品</a>
                <a class="btn btn-default" href="<?php  echo $this->createWebUrl('category', array('op' => 'display', 'storeid' => $storeid))?>"><i class="fa fa-list"></i> 商品分类</a>
                <a class="btn btn-success" href="#" onclick="$('#uploaddata').slideToggle();">批量导入</a>
            </form>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weisrc_dish" />
                <input type="hidden" name="do" value="goods" />
                <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="width: 100px;">关键字</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 100px;">商品分类</label>
                    <div class="col-sm-2 col-lg-2">
                        <select style="margin-right:15px;" name="category_id" class="form-control">
                            <option value="0">请选择商品分类</option>
                            <?php  if(is_array($category)) { foreach($category as $row) { ?>
                            <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['category_id']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                    <div class="col-sm-2 col-lg-2">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
        <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
                    <th class='with-checkbox' style="width: 20px;"><input type="checkbox" class="check_all" /></th>
                    <th style="width:10%;">顺序</th>
					<th style="width:6%;">ID</th>
                    <th style="width:10%;">类别</th>
					<th style="width:14%">商品名称</th>
                    <th style="width:8%;">价格</th>
					<th style="width:8%;">原价</th>
                    <th style="width:8%;">单位</th>
                    <th style="width:8%;">积分</th>
					<th style="width:10%;">是否上架</th>
                    <th style="width:8%;">人气</th>
					<th style="text-align:right; width:10%;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
                    <td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $item['id'];?>"></td>
                    <td><input type="text" class="form-control" name="displayorder[<?php  echo $item['id'];?>]" value="<?php  echo $item['displayorder'];?>"></td>
					<td><?php  echo $item['id'];?></td>
                    <td>
                        <?php  if(!empty($category[$item['pcate']])) { ?><?php  echo $category[$item['pcate']]['name'];?><?php  } ?>
                    </td>
					<td>
                        <img src="<?php  echo tomedia($item['thumb']);?>" width="50" onerror="this.src='./resource/images/nopic.jpg';" style="border-radius: 3px;" /><br/>
                        <?php  echo $item['title'];?></td>
                    <td style="color:#f00;">
                        <?php  if($item['isspecial'] == 2) { ?><?php  echo $item['marketprice'];?>元<?php  } else if($item['isspecial'] == 3) { ?><?php  echo $item['marketprice'];?>元<?php  } ?>
                    </td>
					<td>
                        <?php  echo $item['productprice'];?>元
                    </td>
                    <td>
                        <?php  echo $item['unitname'];?>
                    </td>
                    <td>
                        <?php  echo $item['credit'];?>
                    </td>
					<td><?php  if($item['status']) { ?><span class="label label-success">已上架</span><?php  } else { ?><span class="label label-error">已下架</span><?php  } ?></td>
                    <td><?php  echo $item['subcount'];?></td>
					<td style="text-align:right;">
						<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('goods', array('id' => $item['id'], 'op' => 'post', 'storeid' => $storeid))?>" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('goods', array('id' => $item['id'], 'op' => 'delete', 'storeid' => $storeid))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
			<tr>
				<td colspan="10">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary" name="submit" value="批量更新排序" />
                    <input type="button" class="btn btn-primary" name="btndeleteall" value="批量删除" />
				</td>
			</tr>
		</table>
        <?php  echo $pager;?>
    </form>
        </div>
    </div>
</div>
<script type="text/javascript">
<!--
	var category = <?php  echo json_encode($children)?>;
//-->
$(function(){
    $(".check_all").click(function(){
        var checked = $(this).get(0).checked;
        $("input[type=checkbox]").attr("checked",checked);
    });

    $("input[name=btndeleteall]").click(function(){
        var check = $("input[type=checkbox][class!=check_all]:checked");
        if(check.length < 1){
            alert('请选择要删除的商品!');
            return false;
        }
        if(confirm("确认要删除选择的商品?")){
            var id = new Array();
            check.each(function(i){
                id[i] = $(this).val();
            });
            var url = "<?php  echo $this->createWebUrl('goods', array('op' => 'deleteall', 'storeid' => $storeid))?>";
            $.post(
                url,
                {idArr:id},
                function(data){
                    alert(data.error);
                    location.reload();
                },'json'
            );
        }
    });

});
</script>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                商品编辑
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">人气值</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="subcount" value="<?php  echo $item['subcount'];?>" />
                        <div class="help-block">人气值大于20时显示人气图标</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品名称</label>
                    <div class="col-sm-9">
                        <input type="text" name="goodsname" class="form-control" value="<?php  echo $item['title'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品分类</label>
                    <div class="col-sm-9">
                        <select class="form-control" style="margin-right:15px;" name="pcate" onchange="fetchChildCategory(this.options[this.selectedIndex].value)"  autocomplete="off" class="form-control">
                            <option value="0">请选择分类</option>
                            <?php  if(is_array($category)) { foreach($category as $row) { ?>
                            <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $item['pcate']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品图片</label>
                    <div class="col-sm-9">
                        <?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--<div class="form-group">-->
                    <!--<label class="col-xs-12 col-sm-3 col-md-2 control-label">特价商品</label>-->
                    <!--<div class="col-sm-9">-->
                        <!--<select class="form-control" style="margin-right:15px;" id="isspecial" name="isspecial" autocomplete="off">-->
                            <!--<option value="1" <?php  if($item['isspecial']==1 || empty($item)) { ?> selected="selected"<?php  } ?>>未启用</option>-->
                            <!--<option value="2" <?php  if($item['isspecial']==2) { ?> selected="selected"<?php  } ?>>特价</option>-->
                            <!--&lt;!&ndash;<option value="3" <?php  if($item['isspecial']==3) { ?> selected="selected"<?php  } ?>>会员</option>&ndash;&gt;-->
                        <!--</select>-->
                    <!--</div>-->
                <!--</div>-->
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" name="marketprice" class="form-control" value="<?php  echo $item['marketprice'];?>" />
                            <span class="input-group-addon">元</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">原价</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" name="productprice" class="form-control" value="<?php  echo $item['productprice'];?>" />
                            <span class="input-group-addon">元</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">购买积分</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" name="credit" class="form-control" value="<?php  echo $item['credit'];?>" />
                            <span class="input-group-addon">分</span>
                        </div>
                        <div class="help-block">点此商品所能获取的积分数</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品单位</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="unitname" value="<?php  if(empty($item['unitname'])) { ?>份<?php  } else { ?><?php  echo $item['unitname'];?><?php  } ?>" />
                        <div class="help-block">份、例、斤、半斤、个 等</div>
                        <!--<select id="unitname" name="unitname" class="form-control">-->
                            <!--<option <?php  if($item['unitname']=='份' || empty($item)) { ?>selected="selected"<?php  } ?> value="份">份</option>-->
                            <!--<option <?php  if($item['unitname']=='斤') { ?>selected="selected"<?php  } ?> value="斤">斤</option>-->
                            <!--<option <?php  if($item['unitname']=='两') { ?>selected="selected"<?php  } ?> value="两">两</option>-->
                            <!--<option <?php  if($item['unitname']=='打') { ?>selected="selected"<?php  } ?> value="打">打</option>-->
                            <!--<option <?php  if($item['unitname']=='袋') { ?>selected="selected"<?php  } ?> value="袋">袋</option>-->
                            <!--<option <?php  if($item['unitname']=='台') { ?>selected="selected"<?php  } ?> value="台">台</option>-->
                            <!--<option <?php  if($item['unitname']=='升') { ?>selected="selected"<?php  } ?> value="升">升</option>-->
                            <!--<option <?php  if($item['unitname']=='个') { ?>selected="selected"<?php  } ?> value="个">个</option>-->
                            <!--<option <?php  if($item['unitname']=='罐') { ?>selected="selected"<?php  } ?> value="罐">罐</option>-->
                            <!--<option <?php  if($item['unitname']=='瓶') { ?>selected="selected"<?php  } ?> value="瓶">瓶</option>-->
                            <!--<option <?php  if($item['unitname']=='支') { ?>selected="selected"<?php  } ?> value="支">支</option>-->
                        <!--</select>-->

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品描述</label>
                    <div class="col-sm-9">
                        <textarea style="height:150px;" class="form-control richtext" name="description" cols="70"><?php  echo $item['description'];?></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">口味</label>
                    <div class="col-sm-9">
                        <textarea style="height:50px;" class="form-control" name="taste" cols="70"><?php  echo $item['taste'];?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否上架</label>
                    <div class="col-sm-9">
                        <label for="isshow1" class="radio-inline"><input type="radio" name="status" value="1" id="isshow1" <?php  if(empty($item) || $item['status'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                        &nbsp;&nbsp;&nbsp;
                        <label for="isshow2" class="radio-inline"><input type="radio" name="status" value="0" id="isshow2"  <?php  if(!empty($item) && $item['status'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<script type="text/javascript">
    <!--
    var category = <?php  echo json_encode($children)?>;
    //-->
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>