<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
function callback_init(){
    $db = MySql::getInstance();
    $db->query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."cpdown` (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `logid` int(10) unsigned NOT NULL,
        `start` enum('n','y') NOT NULL DEFAULT 'n',
        `name` varchar(255) NOT NULL,
        `size` varchar(10) NOT NULL,
        `up_date` varchar(20) NOT NULL,
        `version` varchar(10) NOT NULL,
        `author` varchar(150) NOT NULL,
        `yanshi` varchar(150) NOT NULL,
        `baidudown` varchar(150) NOT NULL,
        `baidumima` varchar(10) NOT NULL,
        `web` varchar(150) NOT NULL,
        `ctldown` varchar(150) NOT NULL,
        `general` varchar(150) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
}