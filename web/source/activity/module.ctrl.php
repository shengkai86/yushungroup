<?php

/**

 * [yushunbox System] Copyright (c) 2014 yushunbox.com

 * yushunbox isNOT a free software, it under the license terms, visited http://www.yushunbox.com/ for more details.

 */

defined('IN_IA') or exit('Access Denied');

$dos = array('module');

$do = in_array($do, $dos) ? $do : 'module';



if($do == 'module') {

	$module = uni_modules();

	$new = array();

	if(!empty($module)) {

		$filter = array('services', 'customer', 'activity');

		foreach($module as $mou) {

			if(!in_array($mou['type'], $filter) && !$mou['issystem']) {

				$new[] = $mou;

			}

		}

	}

	unset($module);

	template('activity/module_model');

	die;

}