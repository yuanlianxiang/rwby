<?php
return array(
	//'配置项'=>'配置值'
	'MODULE_ALLOW_LIST' => array('Home','Admin'),

	'SHOW_PAGE_TRACE'   => false, 
	'LOAD_EXT_CONFIG'   => 'db', 
	'URL_CASE_INSENSITIVE'  => true,//url不区分大小写
	'URL_MODEL'   =>0,
	'URL_HTML_SUFFIX'  =>'html',
	'SUPER_ADMIN_ID'=>1,  //超级管理员id删除用户的时候用这个禁止删除
	'SHOW_ERROR_MSG'   =>  true, 
	//主题静态文件路径
	'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => __ROOT__.'/Public'
    ),
);