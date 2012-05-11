<?php
$menuContainer = ClassRegistry::getObject('MenuContainer');
$menuContainer->addTopMenu(
	array(
		'url' => '/cc_octoland/home/index',
		'class' => 'cc_octoland',
		'caption' => __d('cc_octoland', 'Go to Octoland'),
		'logged' => true,
		'admin' => false
	)
);

$pluginContainer = ClassRegistry::getObject('PluginContainer');
$pluginContainer->installed('cc_octoland','0.1');


