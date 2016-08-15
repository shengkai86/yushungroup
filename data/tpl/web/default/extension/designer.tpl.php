<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>

<script type="text/javascript">

require(['filestyle', 'util'], function($, u){

	$(".form-group").find(':file').filestyle({buttonText: '上传图片'});

	$('.form-control').blur(function(){

		var identifie = $('input[name="application[identifie]"]').val();

		$(".identifie").html(identifie);

	});

	$(':checkbox[name="platform[rule]"]').click(function(){

		if($(this).is(':checked')) {

			$('.rule-ops').show();

			$(':checkbox[name="handles[]"]').eq(0).attr('checked', 'checked');

			$(':checkbox[name="handles[]"]').eq(0).attr('disabled', 'disabled');

		} else {

			$('.rule-ops').hide();

			$(':checkbox[name="handles[]"]').eq(0).removeAttr('disabled');

		}

	});



	$("#form1").submit(function(){

		var msg = '';

		var m = $.trim($(':text[name="application[name]"]').val());

		if(m == '') {

			msg += '必须输入模块名称. <br />';

		}

		if((/\*\/|\/\*|eval|\$\_/i).test(m)) {

			msg += '必须输入有效的模块名称. <br />';

		}

		var identifie = $.trim($(':text[name="application[identifie]"]').val());

		if(identifie == '' || !(/^[a-z][a-z\d_]+$/i).test(identifie)) {

			msg += '必须输入模块标识(只能包括字母和数字, 且只能以字母开头). <br />';

		}

		var ver = $.trim($(':text[name="application[version]"]').val());

		if(identifie == '' || !(/^[\d\.]+$/i).test(ver)) {

			msg += '必须输入模块版本号(只能包括数字和句点). <br />';

		}

		if($.trim($(':text[name="application[ability]"]').val()) == '') {

			msg += '必须输入模块简述. <br />';

		}

		var author = $.trim($(':text[name="application[author]"]').val());

		if(author != '' && (/\*\/|\/\*|eval|\$\_/i).test(author)) {

			msg += '必须输入有效的作者. <br />';

		}

		var url = $.trim($(':text[name="application[url]"]').val());

		if(url != '' && (/\*\/|\/\*|eval|\$\_/i).test(url)) {

			msg += '必须输入有效的模块发布页. <br />';

		}

		if($(':checkbox[name="versions[]"]:checked').length == 0) {

			msg += '必须选择模块支持的域顺版本. <br />';

		}

		if(msg != '') {

			u.message(msg, '', 'error');

			return false;

		}

		if($(':hidden[name=do]').val() == '') {

			return false;

		}

		return true;

	});

});

function addOption(point, title) {

	var html = '<div class="form-group">' +

					'<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">' + title +'</label>' +

					'<div class="col-sm-10">' +

						'<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">' + 

							'<div class="input-group" style="margin-left:-15px;margin-bottom:10px">' +

								'<span class="input-group-addon">操作名称</span>' +

								'<input class="form-control" name="bindings[' + point + '][titles][]" type="text" placeholder="请输入操作名称"> ' +

							'</div>' +

						'</div>' + 

						'<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">' + 

							'<div class="input-group" style="margin-left:-15px;margin-bottom:10px">' +

								'<span class="input-group-addon">入口标识</span>' +

								'<input class="form-control" name="bindings[' + point + '][dos][]" type="text" placeholder="请输入操作入口"> ' +

							'</div>' +

						'</div>' + 

						'<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">' + 

							'<div class="input-group" style="margin-left:-15px;margin-bottom:10px">' +

								'<span class="input-group-addon">操作附加数据</span>' +

								'<input class="form-control" name="bindings[' + point + '][state][]" type="text" placeholder="操作附加数据"> ' +

							'</div>' +

						'</div>' +

						'<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 '+ (point == 'menu' ? 'hide' : '') +'">' +

								'<div style="margin-left:-15px;">' +

									'<label class="checkbox-inline" style="vertical-align:bottom"> ' +

										'<input type="hidden" name="bindings[' + point + '][direct][]" value="false" /> ' +

										'<input type="checkbox" onclick="$(this).prev().val(this.checked ? \'true\' : \'false\');" /> 无需登陆直接展示 ' +

									'</label> ' +

									'&nbsp; &nbsp; &nbsp; <a href="javascript:;" onclick="deleteOption(this)" class="fa fa-times-circle" title="删除此操作"></a> ' +

							'</div>' +

						'</div>' +

					'</div>' +

				'</div>';

	$('#bindings-' + point).append(html);

}

function deleteOption(o) {

	$(o).parent().parent().parent().parent().remove();

}

</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('extension/module-tabs', TEMPLATE_INCLUDEPATH)) : (include template('extension/module-tabs', TEMPLATE_INCLUDEPATH));?>

<div class="clearfix">

	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">

		<input type="hidden" name="id" value="<?php  echo $rule['rule']['id'];?>">

		<h5 class="page-header">模块基本信息 <small>这里来定义你自己模块的基本信息</small></h5>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模块名称</label>

			<div class="col-sm-10 col-xs-12">

				<input type="text" class="form-control" placeholder="" name="application[name]"/>

				<span class="help-block">模块的名称, 由于显示在用户的模块列表中. 不要超过10个字符 </span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模块标识</label>

			<div class="col-sm-10 col-xs-12">

				<input type="text" class="form-control" placeholder="" name="application[identifie]" />

				<span class="help-block">模块标识符, 应对应模块文件夹的名称, 域顺系统按照此标识符查找模块定义, 只能由字母数字下划线组成 </span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">版本</label>

			<div class="col-sm-10 col-xs-12">

				<input type="text" class="form-control" placeholder="" name="application[version]" />

				<span class="help-block">模块当前版本, 此版本号用于模块的版本更新</span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模块类型</label>

			<div class="col-sm-10 col-xs-12">

				<select name="application[type]" class="form-control">

					<?php  if(is_array($modtypes)) { foreach($modtypes as $tp) { ?>

					<option value="<?php  echo $tp['name'];?>"><?php  echo $tp['title'];?></option>

					<?php  } } ?>

				</select>

				<span class="help-block">模块的类型, 用于分类展示和查找你的模块</span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模块简述</label>

			<div class="col-sm-10 col-xs-12">

				<input type="text" class="form-control" placeholder="" name="application[ability]"/>

				<span class="help-block">模块功能描述, 使用简单的语言描述模块的作用, 来吸引用户 </span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模块介绍</label>

			<div class="col-sm-10 col-xs-12">

				<textarea class="form-control" name="application[description]" rows="4"></textarea>

				<span class="help-block">模块详细描述, 详细介绍模块的功能和使用方法 </span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">作者</label>

			<div class="col-sm-10 col-xs-12">

				<input type="text" class="form-control" placeholder="" name="application[author]"/>

				<span class="help-block">模块的作者, 留下你的大名吧</span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">发布页</label>

			<div class="col-sm-10 col-xs-12">

				<input type="text" class="form-control" placeholder="" name="application[url]" value="http://bbs.yushunbox.com/" />

				<span class="help-block">模块的发布页, 用于发布模块更新信息的页面, 推荐使用域顺模块版块</span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">设置项</label>

			<div class="col-sm-10 col-xs-12">

				<label class="checkbox-inline">

					<input type="checkbox" name="application[setting]" value="true" />

					存在全局设置项

				</label>

				<span class="help-block">此模块是否存在全局的配置参数, 此参数是针对公众账号独立保存的</span>

			</div>

		</div>

		<h5 class="page-header">公众平台消息处理选项 <small>这里来定义公众平台消息相关处理</small></h5>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">订阅的消息类型</label>

			<div class="col-sm-10 col-xs-12">

				<?php  if(is_array($mtypes)) { foreach($mtypes as $k => $v) { ?>

				<div class="checkbox">

					<label>

						<input name="subscribes[]" type="checkbox" value="<?php  echo $k;?>" /> <?php  echo $v;?>

					</label>

				</div>

				<?php  } } ?>

				<span class="help-block">订阅特定的消息类型后, 此消息类型的消息到达域顺系统后将会以通知的方式(消息数据只读, 并不能返回处理结果)调用模块的接受器, 用这样的方式可以实现全局的数据统计分析等功能. 请参阅 <a href="http://www.yushunbox.com/docs/#flow-module-subscribe">模块消息订阅</a></span>

				<div class="alert-warning alert">注意: 订阅的消息信息是只读的, 只能用作分析统计, 不能更改, 也不能改变域顺处理主流程</div>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">直接处理的类型</label>

			<div class="col-sm-10 col-xs-12">

				<?php  if(is_array($mtypes)) { foreach($mtypes as $k => $v) { ?>

				<?php  if($k != 'unsubscribe' && $k != 'view') { ?>

				<div class="checkbox">

					<label>

						<input name="handles[]" type="checkbox" value="<?php  echo $k;?>" /> <?php  echo $v;?>

					</label>

				</div>

				<?php  } ?>

				<?php  } } ?>

				<span class="help-block">当前模块能够直接处理的消息类型(没有上下文的对话语境, 能直接处理消息并返回数据). 如果公众平台传递过来的消息类型不在设定的类型列表中, 那么系统将不会把此消息路由至此模块</span>

				<div class="alert-warning alert">

					注意: 关键字路由只能针对文本消息有效, 文本消息最为重要. 其他类型的消息并不能被直接理解, 多数情况需要使用文本消息来进行语境分析, 再处理其他相关消息类型<br>

					注意: 上下文锁定的模块不受此限制, 上下文锁定期间, 任何类型的消息都会路由至锁定模块

				</div>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">是否要嵌入规则</label>

			<div class="col-sm-10 col-xs-12">

				<label class="checkbox-inline">

					<input type="checkbox" name="platform[rule]" value="true" />

					需要嵌入规则

				</label>

				<span class="help-block">是否要在规则编辑时添加此规则的相应的规则</span>

				<div class="alert-warning alert">注意: 如果需要嵌入规则, 那么此模块必须能够处理文本类型消息 (需要定义Processor)</div>

			</div>

		</div>

		<h5 class="page-header">微站功能绑定 <small>这里来定义此功能模块中微站的相关功能如何同系统对接</small></h5>

		<?php  if(is_array($points)) { foreach($points as $point => $row) { ?>

		<div id="bindings-<?php  echo $point;?>">

			<div class="form-group">

				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"><?php  echo $row['title'];?></label>

				<div class="col-sm-10 col-xs-12">

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">

						<div class="input-group" style="margin-left:-15px;margin-bottom:10px">

							<span class="input-group-addon">操作名称</span>

							<input class="form-control" name="bindings[<?php  echo $point;?>][titles][]" type="text" placeholder="请输入操作名称">

						</div>

					</div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">

						<div class="input-group" style="margin-left:-15px;margin-bottom:10px">

							<span class="input-group-addon">入口标识</span>

							<input class="form-control" name="bindings[<?php  echo $point;?>][dos][]" type="text" placeholder="请输入操作入口">

						</div>

					</div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">

						<div class="input-group" style="margin-left:-15px;margin-bottom:10px">

							<span class="input-group-addon">操作附加数据</span>

							<input class="form-control" name="bindings[<?php  echo $point;?>][state][]" type="text" placeholder="操作附加数据">

						</div>

					</div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 <?php  if($point == 'menu') { ?>hide<?php  } ?>">

						<div style="margin-left:-15px;margin-bottom:17px">

							<label class="checkbox-inline" style="vertical-align:bottom">

								<input type="hidden" name="bindings[<?php  echo $point;?>][direct][]" value="false" />

								<input type="checkbox" onclick="$(this).prev().val(this.checked ? 'true' : 'false');" /> 无需登陆直接展示

							</label>

							&nbsp; &nbsp; &nbsp; <a href="javascript:;" onclick="deleteOption(this)" class="fa fa-times-circle" title="删除此操作"></a>	

						</div>

					</div>

				</div>

			</div>

		</div>

		<?php  if($point == 'menu' && !$flag) { ?>

		<?php  $flag = 1;?>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">权限标识</label>

			<div class="col-sm-10 col-xs-12">

				<textarea name="permission" class="form-control" cols="30" rows="10" placeholder="添加门店：we7_demo_store_add"></textarea>

				<span class="help-block">

					<strong class="text-danger">

					如果您设计的模块需要对某些操作设置权限，您可以在这里输入权限标识，并在对应的文件进行标识判断<br>

					权限标识由：标识名称和标识组成。例如,添加门店：we7_demo_store_add"。标识格式：模块名称_标识。例如，名称名称为：we7_demo,标识为：store_add,则对应标识为：we7_demo_store_add<br>

					标识名称和标识之间使用英文半角“：”隔开。多个权限标识使用换行隔开

					</strong>

				</span>

			</div>

		</div>

		<?php  } ?>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>

			<div class="col-sm-10 col-xs-12">

				<div class="well well-sm">

					<a href="javascript:;" onclick="addOption('<?php  echo $point;?>', '<?php  echo $row['title'];?>');">添加操作 <i class="fa fa-plus-circle" title="添加菜单"></i></a>

				</div>

				<span class="help-block"><?php  echo $row['desc'];?></span>

				<span class="help-block"><strong>注意: <?php  echo $row['title'];?>扩展功能定义于 WeSite 类的实现中</strong></span>

			</div>

		</div>

		<?php  } } ?>

		<h5 class="page-header">计划任务 <small>这里来定义模块的计划任务<span class="text-danger">(如果您的模块不需要计划任务,跳过此项)</span></small></h5>

		<div id="cron-container"></div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>

			<div class="col-sm-10 col-xs-12">

				<div class="well well-sm">

					<a href="javascript:;" onclick="addCronOption();">添加计划任务 <i class="fa fa-plus-circle" title="添加菜单"></i></a>

				</div>

				<span class="help-block"><strong>注意: XXXXXX</strong></span>

			</div>

		</div>





		<h5 class="page-header">模块发布 <small>这里来定义模块发布时需要的配置项</small></h5>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">兼容的域顺版本</label>

			<div class="col-sm-10 col-xs-12">

				<?php  if(is_array($versions)) { foreach($versions as $v) { ?>

				<label class="checkbox-inline">

					<input name="versions[]" type="checkbox" value="<?php  echo $v;?>" <?php  if(in_array($v, $m['versions'])) { ?> checked="checked"<?php  } ?> />yushunbox <?php  echo $v;?>

				</label>

				<?php  } } ?>

				<span class="help-block">当前模块兼容的域顺系统版本, 安装时会判断版本信息, 不兼容的版本将无法安装</span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模块缩略图</label>

			<div class="col-sm-10 col-xs-12">

				<input type="file" name="icon" value="<?php  echo $m['icon'];?>">

				<span class="help-block">用 48*48 的图片来让你的模块更吸引眼球吧</span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模块封面</label>

			<div class="col-sm-10 col-xs-12">

				<input type="file" name="preview" value="<?php  echo $m['preview'];?>">

				<span class="help-block">模块封面, 大小为 600*350, 更好的设计将会获得官方推荐位置</span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模块安装脚本</label>

			<div class="col-sm-10 col-xs-12">

				<textarea class="form-control" name="install" rows="4"><?php  echo $m['install'];?></textarea>

				<span class="help-block">当前模块全新安装时所执行的脚本, 可以定义为SQL语句. 也可以指定为单个的php脚本文件, 如: install.php</span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模块卸载脚本</label>

			<div class="col-sm-10 col-xs-12">

				<textarea class="form-control" name="uninstall" rows="4"><?php  echo $m['uninstall'];?></textarea>

				<span class="help-block">当前模块卸载时所执行的脚本, 可以定义为SQL语句. 也可以指定为单个的php脚本文件, 如: uninstall.php</span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模块升级脚本</label>

			<div class="col-sm-10 col-xs-12">

				<textarea class="form-control" name="upgrade" rows="4"><?php  echo $m['upgrade'];?></textarea>

				<span class="help-block">当前模块更新时所执行的脚本, 可以定义为SQL语句. 也可以指定为单个的php脚本文件, 如: upgrade.php. (推荐使用php脚本, 方便检测字段及兼容性)</span>

				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>

			<div class="col-sm-10 col-xs-12">

				<input name="method" type="hidden" value="download"/>

				<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />

				<?php  if($available['create']) { ?>

				<input type="submit" class="btn btn-primary" name="submit" onclick="$(':hidden[name=method]').val('create');" value="直接生成模块模板" />

				<?php  } else { ?>

				<input type="submit" class="btn btn-primary disabled" disabled="disabled" name="submit" value="直接生成模块模板" />

				<div class="alert-warning alert" style="width:auto;margin-top:5px;">需要 addons 目录具有可写权限</div>

				<?php  } ?>

				<span class="help-block">点此直接在源码目录 addons/<span class="identifie"></span> 处生成模块开发的模板文件, 方便快速开发</span>

			</div>

		</div>

		<div class="form-group">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>

			<div class="col-sm-10 col-xs-12">

				<?php  if($available['download']) { ?>

				<input type="submit" class="btn btn-primary span3" name="submit" onclick="$(':hidden[name=method]').val('download');" value="下载模块模板" />

				<?php  } else { ?>

				<input type="submit" class="btn btn-primary span3 disabled" disabled="disabled" name="submit" value="下载模块模板" />

				<div class="alert-warning alert">需要启用 Zip 模块</div>

				<?php  } ?>

				<span class="help-block">如果您的服务器不能直接读写文件, 请下载后上传至服务器目录 addons/<span class="identifie"></span> 下来编辑开发 </span>

			</div>

		</div>

	</form>

</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>

