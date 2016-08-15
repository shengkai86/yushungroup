<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">系统设置</a></li>
    <!--<li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('nave', array('op' => 'display'))?>">管理首页导航</a></li>-->
</ul>

<script type="text/javascript">
    $(function(){
        $(':radio[name="ismail"]').click(function(){
            if(this.checked) {
                if($(this).val() == '1') {
                    $('.mail').show();
                } else {
                    $('.mail').hide();
                }
            }
        });
        $(':radio[name="sms_enable"]').click(function(){
            if(this.checked) {
                if($(this).val() == '1') {
                    $('.sms').show();
                } else {
                    $('.sms').hide();
                }
            }
        })
        $(':radio[name="isprint"]').click(function(){
            if(this.checked) {
                if($(this).val() == '1') {
                    $('.print').show();
                } else {
                    $('.print').hide();
                }
            }
        });
    });
</script>
<link rel="stylesheet" type="text/css" href="../addons/weisrc_dish/plugin/clockpicker/clockpicker.css" media="all">
<script type="text/javascript" src="../addons/weisrc_dish/plugin/clockpicker/clockpicker.js"></script>
<link rel="stylesheet" type="text/css" href="../addons/weisrc_dish/plugin/clockpicker/standalone.css" media="all">
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                基本设置
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">网站名称</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" value="<?php  echo $setting['title'];?>" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索关键字设置</label>
                    <div class="col-sm-9">
                        <input type="text" name="searchword" value="<?php  echo $setting['searchword'];?>" class="form-control"/>
                        <div class="help-block">多个搜索关键词请用空格符号分开</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                管理员信息提醒设置
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否信息提醒</label>
                    <div class="col-sm-9">
                        <label for="is_notice1" class="radio-inline"><input type="radio" name="is_notice" value="1" id="is_notice1" <?php  if($setting['is_notice'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                        &nbsp;&nbsp;&nbsp;
                        <label for="is_notice2" class="radio-inline"><input type="radio" name="is_notice" value="0" id="is_notice2"  <?php  if(empty($setting) || $setting['is_notice'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">通知用户OPENID</label>
                    <div class="col-sm-9">
                        <input type="text" name="tpluser" class="form-control" value="<?php  echo $setting['tpluser'];?>"/>
                        <span class="help-block">请填写微信编号。系统根据微信编号获取对应公众号的openid,多个管理员请用','符号分开</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮箱</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control" value="<?php  echo $setting['email'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">手机号</label>
                    <div class="col-sm-9">
                        <input type="text" name="sms_mobile" class="form-control" value="<?php  echo $setting['sms_mobile'];?>" />
                        <div class="help-block">请输入要接受订单提醒的手机号码.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                模式
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">模式</label>
                    <div class="col-sm-9">
                        <label for="mode2" class="radio-inline"><input type="radio" name="mode" value="0" id="mode2"  <?php  if(empty($setting) || $setting['mode'] == 0) { ?>checked="true"<?php  } ?> /> 多店</label>
                        <label for="mode1" class="radio-inline"><input type="radio" name="mode" value="1" id="mode1" <?php  if($setting['mode'] == 1) { ?>checked="true"<?php  } ?> /> 单店</label>
                        <span class="help-block">选择单店模式的情况下搜索页和门店搜索栏目将会隐藏</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">默认门店</label>
                    <div class="col-sm-9">
                        <select id="storeid" name="storeid" class="form-control">
                            <?php  if(is_array($stores)) { foreach($stores as $item) { ?>
                            <option value="<?php  echo $item['id'];?>" <?php  if($item['id']==$setting['storeid']) { ?>selected<?php  } ?>><?php  echo $item['title'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                模版消息通知
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启</label>
                    <div class="col-sm-9">
                        <label for="isshow1" class="radio-inline"><input type="radio" name="istplnotice" value="1" id="isshow1" <?php  if($setting['istplnotice'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                        &nbsp;&nbsp;&nbsp;
                        <label for="isshow2" class="radio-inline"><input type="radio" name="istplnotice" value="0" id="isshow2"  <?php  if(empty($setting) || $setting['istplnotice'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">行业类型</label>
                    <div class="col-sm-9">
                        <label for="tpltype1" class="radio-inline"><input type="radio" name="tpltype" value="1" id="tpltype1" <?php  if(empty($setting) || $setting['tpltype'] == 1) { ?>checked="true"<?php  } ?> /> 餐饮</label>
                        &nbsp;&nbsp;&nbsp;
                        <label for="tpltype2" class="radio-inline"><input type="radio" name="tpltype" value="2" id="tpltype2"  <?php  if($setting['tpltype'] == 2) { ?>checked="true"<?php  } ?> /> IT科技</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">订单状态提醒模版ID</label>
                    <div class="col-sm-9">
                        <input type="text" name="tplneworder" value="<?php  echo $setting['tplneworder'];?>" class="form-control"/>
                        <div class="help-block">
                            a.<code>餐饮行业</code>在模板库选择行业<code>餐饮－餐饮</code>，搜索“<code>订单状态提醒</code>”编号为<code>OPENTM202045454</code>的模板<br/>
                            b.<code>IT科技行业</code>在模板库选择行业<code>IT科技－互联网|电子商务</code>，搜索“<code>订单状态提醒</code>”编号为<code>OPENTM206848054</code>的模板
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排队通知模版ID</label>
                    <div class="col-sm-9">
                        <input type="text" name="tplnewqueue" value="<?php  echo $setting['tplnewqueue'];?>" class="form-control"/>
                        <div class="help-block">
                            a.<code>餐饮行业</code>在模板库选择行业<code>餐饮－餐饮</code>，搜索“<code>排号通知</code>”编号为<code>OPENTM383288748</code>的模板<br/>
                            b.<code>IT科技行业</code>在模板库选择行业<code>IT科技－互联网|电子商务</code>，搜索“<code>排号提醒通知</code>”编号为<code>OPENTM205984119</code>的模板
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
        <div class="panel-heading">
            邮件设置
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮箱提醒</label>
                <div class="col-sm-9">
                    <label for="email_enable" class="radio-inline"><input type="radio" name="email_enable" value="1" id="email_enable" <?php  if($setting['email_enable']==1) { ?>checked<?php  } ?> /> 是</label>
                    &nbsp;&nbsp;&nbsp;
                    <label for="email_enable2" class="radio-inline"><input type="radio" name="email_enable" value="0" id="email_enable2"  <?php  if($setting['email_enable']==0 || empty($setting)) { ?>checked<?php  } ?> /> 否</label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮箱服务器</label>
                <div class="col-sm-9">
                    <select name="email_host" class="form-control">
                        <option value="smtp.qq.com" <?php  if($setting['email_host'] == 'smtp.qq.com' ) { ?> selected="selected"<?php  } ?>>QQ邮箱</option>
                        <option value="smtp.126.com" <?php  if($setting['email_host'] == 'smtp.126.com' ) { ?> selected="selected"<?php  } ?>>126邮箱</option>
                        <option value="smtp.163.com" <?php  if($setting['email_host'] == 'smtp.163.com' ) { ?> selected="selected"<?php  } ?>>163邮箱</option>
                        <option value="smtp.sina.com" <?php  if($setting['email_host'] == 'smtp.sina.com' ) { ?> selected="selected"<?php  } ?>>sina邮箱</option>
                    </select>
                    <div class="help-block">QQ邮箱务必开启smtp服务</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">发件人名称</label>
                <div class="col-sm-9">
                    <input type="text" name="email_user" class="form-control" value="<?php  if(empty($setting['email_user']) || empty($setting)) { ?>域顺微点餐<?php  } else { ?><?php  echo $setting['email_user'];?><?php  } ?>" />
                    <div class="help-block">指定发送邮件发信人名称</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">发送帐号用户名</label>
                <div class="col-sm-9">
                    <input type="text" name="email_send" class="form-control" value="<?php  echo $setting['email_send'];?>" />
                    <div class="help-block">指定发送邮件的用户名，例如：123456@qq.com</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">发送帐号密码</label>
                <div class="col-sm-9">
                    <input type="password" name="email_pwd" class="form-control" value="<?php  echo $setting['email_pwd'];?>" />
                    <div class="help-block">指定发送邮件的密码</div>
                </div>
            </div>
        </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                短信设置
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户短信提醒</label>
                    <div class="col-sm-9">
                        <label for="sms_enable" class="radio-inline"><input type="radio" name="sms_enable" value="1" id="sms_enable" <?php  if($setting['sms_enable']==1) { ?>checked<?php  } ?> /> 是</label>
                        &nbsp;&nbsp;&nbsp;
                        <label for="sms_enable2" class="radio-inline"><input type="radio" name="sms_enable" value="0" id="sms_enable2"  <?php  if($setting['sms_enable']==0 || empty($setting)) { ?>checked<?php  } ?> /> 否</label>
                        <div>
                            使用短信提醒必须申请接口才能使用 <a href="http://www.dxton.com/" target="_blank">申请网址查看这里</a>.
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">短信平台帐号</label>
                    <div class="col-sm-9">
                        <input type="text" name="sms_username" class="form-control" value="<?php  echo $setting['sms_username'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">短信平台密码</label>
                    <div class="col-sm-9">
                        <input type="password" name="sms_pwd" class="form-control" value="<?php  echo $setting['sms_pwd'];?>" />
                    </div>
                </div>
                <div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启全局短信</label>
				<div class="col-sm-9 col-xs-12">
					<label class='radio-inline'><input type="radio" name="is_sms" value="0" <?php  if($setting['is_sms'] == 0) { ?> checked="true" <?php  } ?> onclick="$('#sms_id').show();">开启</label>
					<label class='radio-inline'><input type="radio" name="is_sms" value="1"  <?php  if($setting['is_sms'] == 1) { ?> checked="true" <?php  } ?> onclick="$('#sms_id').hide();"> 关闭</label>
				</div>
			</div>
                <div class="form-group" id="sms_id" <?php  if($setting['is_sms']!='0') { ?>style="display: none;"<?php  } ?>>
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">短信平台模板ID</label>
                    <div class="col-sm-9">
                        <input type="text" name="sms_id" class="form-control" value="<?php  echo $setting['sms_id'];?>" />
                        <div>
                            短信模板可使用变量${phone},${name} </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="hidden" name="id" value="<?php  echo $setting['id'];?>" />
            <input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
	    <input type="hidden" name="id" value="<?php  echo $setting['id'];?>" />
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>