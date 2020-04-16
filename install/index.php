<?php /** HIDE ALL ERRORS */
error_reporting(1); ?>

<!DOCTYPE html>

<html>

<head>
<title>CouponsCMS Installer</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="robots" content="noindex, nofollow">
<link href="<?php echo str_replace( $_SERVER['DOCUMENT_ROOT'], '', DIR ) . '/install/style.css'; ?>" media="all" rel="stylesheet" /> 
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel="stylesheet" />
</head>

<body>

<div id="install">

<div class="wrapper">

<?php

if( !defined( 'IDIR' ) ) {
    require_once '../settings.php';
}

require_once dirname( __DIR__ ) . '/' . IDIR . '/site/db.php';

$languages = [ 'english' => 'English', 'romanian' => 'Română' ];

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['checked'] ) && isset( $_POST['install'] ) ) {

$i = $_POST['install'];

require_once 'preparation.php';
require_once dirname( __DIR__ ) . '/' . IDIR . '/site/update.php';

if( class_exists( 'mysqli' ) && mysqli_connect_errno() ) {

$sql = new mysqli( $i['db_host'], $i['db_user'], $i['db_password'], $i['db_name'] );

/** check connection */

if( mysqli_connect_errno() ) {

    echo '<div class="error">Connection to mysql database error, please verify your information.</div>';

} else if( !install_preparation() ) {

    echo '<div class="error">We couldn\'t update automatically permissions necessary for installation. Please set manually chmod 777 on the following files and directories: install, settings.php, ' . THEMES_LOC . ', ' . COMMON_LOCATION . ', ' . TEMP_LOCATION . ', ' . UPLOAD_IMAGES_LOC . ', ' . UPDIR . '. Then try again!</div>';

} else if( \site\update::set_define( 'settings.php', array( 'DB_NAME' => $i['db_name'], 'DB_USER' => $i['db_user'], 'DB_PASSWORD' => $i['db_password'], 'DB_HOST' => $i['db_host'], 'DB_TABLE_PREFIX' => $i['table_prefix'] ) ) ) {

    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "banned` (`id` int(100) NOT NULL AUTO_INCREMENT, `ipaddr` varchar(50) NOT NULL DEFAULT '', `registration` tinyint(1) NOT NULL DEFAULT 0, `login` tinyint(1) NOT NULL DEFAULT 0, `site` tinyint(1) NOT NULL DEFAULT 0, `redirect_to` varchar(255) NOT NULL DEFAULT '', `expiration` tinyint(1) NOT NULL DEFAULT 0, `expiration_date` datetime NOT NULL DEFAULT '1970-01-01 00:00:00', `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), UNIQUE KEY `ipaddr` (`ipaddr`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "categories` (`id` int(100) NOT NULL AUTO_INCREMENT, `subcategory` int(10) NOT NULL DEFAULT 0, `user` int(10) NOT NULL DEFAULT 0, `name` text, `description` text, `url_title` varchar(255) NOT NULL DEFAULT '', `meta_title` varchar(255) NOT NULL DEFAULT '', `meta_keywords` text, `meta_desc` text, `extra` text, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "chat` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `text` tinytext, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB    DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "click` (`id` int(100) NOT NULL AUTO_INCREMENT, `store` int(10) NOT NULL DEFAULT 0, `coupon` int(10) NOT NULL DEFAULT 0, `product` int(10) NOT NULL DEFAULT 0, `user` int(10) NOT NULL DEFAULT 0, `subid` varchar(50) NOT NULL DEFAULT '', `ipaddr` varchar(50) NOT NULL DEFAULT '', `browser` varchar(100) NOT NULL DEFAULT '', `country1` varchar(2) NOT NULL DEFAULT '', `country2` varchar(60) NOT NULL DEFAULT '', `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "coupons` (`id` int(100) NOT NULL AUTO_INCREMENT, `feedID` int(10) NOT NULL DEFAULT 0, `user` int(10) NOT NULL DEFAULT 0, `store` int(10) NOT NULL DEFAULT 0, `category` int(10) NOT NULL DEFAULT 0, `popular` tinyint(1) NOT NULL DEFAULT 0, `exclusive` tinyint(1) NOT NULL DEFAULT 0, `printable` tinyint(1) NOT NULL DEFAULT 0, `show_in_store` tinyint(1) NOT NULL DEFAULT 0, `available_online` tinyint(1) NOT NULL DEFAULT 1, `title` text, `link` text, `description` text, `tags` text, `image` varchar(255) NOT NULL DEFAULT '', `code` varchar(255) NOT NULL DEFAULT '', `source` text,  `claim_limit` int(10) NOT NULL DEFAULT 0, `claims` int(10) NOT NULL DEFAULT 0, `visible` tinyint(1) NOT NULL DEFAULT 1, `views` int(10) NOT NULL DEFAULT 0, `clicks` int(10) NOT NULL DEFAULT 0, `start` datetime NOT NULL DEFAULT '1970-01-01 00:00:00', `expiration` datetime NOT NULL DEFAULT '1970-01-01 00:00:00', `cashback` int(5) NOT NULL DEFAULT 0, `url_title` varchar(255) NOT NULL DEFAULT '', `meta_title` varchar(255) NOT NULL DEFAULT '', `meta_keywords` text, `meta_desc` text, `votes` int(10) NOT NULL DEFAULT 0, `votes_percent` double(7,2) NOT NULL DEFAULT '0.00', `verified` tinyint(1) NOT NULL DEFAULT 0, `last_verif` datetime NOT NULL DEFAULT '1970-01-01 00:00:00', `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `paid_until` datetime NOT NULL DEFAULT '1970-01-01 00:00:00', `extra` text, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), FULLTEXT KEY `title` (`title`), FULLTEXT KEY `description` (`description`), FULLTEXT KEY `tags` (`tags`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "coupon_claims` (`id` int(100) NOT NULL AUTO_INCREMENT, `coupon` int(10) NOT NULL DEFAULT '0', `user` int(10) NOT NULL DEFAULT '0', `code` varchar(6) NOT NULL, `used` tinyint(1) NOT NULL DEFAULT '0', `used_date` datetime DEFAULT NULL, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "coupon_votes` (`id` int(100) NOT NULL AUTO_INCREMENT, `coupon` int(10) NOT NULL DEFAULT 0, `user` int(10) NOT NULL DEFAULT 0, `vote` tinyint(1) NOT NULL DEFAULT 0, `ipaddr` varchar(50) NOT NULL DEFAULT '', `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "email_sessions` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `email` varchar(255) NOT NULL DEFAULT '', `target` varchar(50) NOT NULL DEFAULT '', `session` varchar(255) NOT NULL DEFAULT '', `expiration` datetime NOT NULL DEFAULT '1970-01-01 00:00:00', `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "head` (`id` int(100) NOT NULL AUTO_INCREMENT, `text` text, `admin` tinyint(1) NOT NULL DEFAULT 0, `theme` tinyint(1) NOT NULL DEFAULT 0, `plugin` varchar(255) NOT NULL DEFAULT '', `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "favorite` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `store` int(10) NOT NULL DEFAULT 0, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "gallery` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT '0', `title` varchar(50) NOT NULL DEFAULT '', `cat_id` varchar(50) NOT NULL DEFAULT '0', `sizes` text NOT NULL, `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "news` (`newsID` int(10) NOT NULL DEFAULT 0, `title` varchar(255) NOT NULL DEFAULT '', `url` varchar(255) NOT NULL DEFAULT '', `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`newsID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "newsletter` (`id` int(100) NOT NULL AUTO_INCREMENT, `email` varchar(255) NOT NULL DEFAULT '', `ipaddr` varchar(50) NOT NULL DEFAULT '', `econf` tinyint(1) NOT NULL DEFAULT 0, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), UNIQUE KEY (`email`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "options` (`id` int(100) NOT NULL AUTO_INCREMENT, `option_name` varchar(100) NOT NULL DEFAULT '', `option_value` text, PRIMARY KEY (`id`), UNIQUE KEY (`option_name`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "pages` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `name` text, `text` text, `visible` tinyint(1) NOT NULL DEFAULT 0, `views` bigint(20) NOT NULL DEFAULT 0, `url_title` varchar(255) NOT NULL DEFAULT '', `meta_title` varchar(255) NOT NULL DEFAULT '', `meta_keywords` text, `meta_desc` text, `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `extra` text, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";    
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "products` (`id` int(100) NOT NULL AUTO_INCREMENT, `feedID` int(10) NOT NULL DEFAULT 0, `user` int(10) NOT NULL DEFAULT 0, `store` int(10) NOT NULL DEFAULT 0, `category` int(10) NOT NULL DEFAULT 0, `popular` tinyint(1) NOT NULL DEFAULT 0, `title` text, `link` text, `description` text, `tags` text, `image` varchar(255) NOT NULL DEFAULT '', `price` double(15,2) NOT NULL DEFAULT '0.00', `old_price` double(15,2) NOT NULL DEFAULT '0.00', `currency` varchar(6) NOT NULL DEFAULT 'USD', `visible` tinyint(1) NOT NULL DEFAULT 0, `views` bigint(20) NOT NULL DEFAULT 0, `start` datetime NOT NULL DEFAULT '1970-01-01 00:00:00', `expiration` datetime NOT NULL DEFAULT '1970-01-01 00:00:00', `cashback` int(5) NOT NULL DEFAULT 0, `url_title` varchar(255) NOT NULL DEFAULT '', `meta_title` varchar(255) NOT NULL DEFAULT '', `meta_keywords` text, `meta_desc` text, `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `paid_until` datetime NOT NULL DEFAULT '1970-01-01 00:00:00', `extra` text, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), FULLTEXT KEY `title` (`title`), FULLTEXT KEY `description` (`description`), FULLTEXT KEY `tags` (`tags`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "plugins` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `name` varchar(80) NOT NULL DEFAULT '', `image` varchar(255) NOT NULL DEFAULT '', `scope` varchar(60) NOT NULL DEFAULT '', `main` varchar(255) NOT NULL DEFAULT '', `loader` varchar(255) NOT NULL DEFAULT '', `options` varchar(255) NOT NULL DEFAULT '', `menu` tinyint(1) NOT NULL DEFAULT 0, `menu_ready` tinyint(1) NOT NULL DEFAULT 0, `menu_icon` int(2) NOT NULL DEFAULT 1, `subadmin_view` tinyint(1) NOT NULL DEFAULT 0, `extend_vars` text, `description` text, `visible` tinyint(1) NOT NULL DEFAULT 1, `version` double(6,2) NOT NULL DEFAULT 0, `update_checker` text, `uninstall` text, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB    DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "p_plans` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `name` varchar(15) NOT NULL DEFAULT '', `description` text, `price` double(7,2) NOT NULL DEFAULT '0.00', `credits` int(5) NOT NULL DEFAULT '10', `image` varchar(255) NOT NULL DEFAULT '', `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `visible` tinyint(1) NOT NULL DEFAULT 0, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB    DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "p_transactions` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `gateway` varchar(30) NOT NULL DEFAULT '', `price` double(7,2) NOT NULL DEFAULT '0.00', `transaction_id` varchar(255) NOT NULL DEFAULT '', `state` varchar(30) NOT NULL DEFAULT '', `items` text, `details` text, `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `visible` tinyint(1) NOT NULL DEFAULT 0, `paid` tinyint(1) NOT NULL DEFAULT 0, `delivered` tinyint(1) NOT NULL DEFAULT 0, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB    DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "reviews` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `store` int(10) NOT NULL DEFAULT 0, `text` text, `stars` int(1) NOT NULL DEFAULT '5', `valid` tinyint(1) NOT NULL DEFAULT 0, `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "rewards` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `points` int(5) NOT NULL DEFAULT 0, `title` text, `description` text, `image` varchar(255) NOT NULL DEFAULT '', `fields` text, `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `visible` tinyint(1) NOT NULL DEFAULT 0, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB    DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "rewards_reqs` (`id` int(100) NOT NULL AUTO_INCREMENT, `name` varchar(255) NOT NULL DEFAULT '', `user` int(10) NOT NULL DEFAULT 0, `points` int(5) NOT NULL DEFAULT 0, `reward` int(10) NOT NULL DEFAULT 0, `fields` text, `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `claimed` tinyint(1) NOT NULL DEFAULT 0, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB    DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "sessions` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `session` varchar(255) NOT NULL DEFAULT '', `expiration` datetime NOT NULL, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "stores` (`id` int(100) NOT NULL AUTO_INCREMENT, `feedID` int(10) NOT NULL DEFAULT 0, `user` int(10) NOT NULL DEFAULT 0, `category` int(10) NOT NULL DEFAULT 0, `popular` tinyint(1) NOT NULL DEFAULT 0, `physical` tinyint(1) NOT NULL DEFAULT 0, `name` text, `link` text, `description` text, `tags` text, `image` varchar(255) NOT NULL DEFAULT '', `hours` text, `phoneno` varchar(30) NOT NULL DEFAULT '', `sellonline` tinyint(1) NOT NULL DEFAULT 1, `visible` tinyint(1) NOT NULL DEFAULT 1, `views` bigint(20) NOT NULL DEFAULT 0, `url_title` varchar(255) NOT NULL DEFAULT '', `meta_title` varchar(255) NOT NULL DEFAULT '', `meta_keywords` text, `meta_desc` text, `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `extra` text, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), FULLTEXT KEY `name` (`name`), FULLTEXT KEY `description` (`description`), FULLTEXT KEY `tags` (`tags`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "suggestions` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `type` int(2) NOT NULL DEFAULT 1, `viewed` tinyint(1) NOT NULL DEFAULT 0, `name` varchar(255) NOT NULL DEFAULT '', `url` varchar(255) NOT NULL DEFAULT '', `description` text, `message` text, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "users` (`id` int(100) NOT NULL AUTO_INCREMENT, `name` varchar(255) NOT NULL DEFAULT '', `email` varchar(255) NOT NULL DEFAULT '', `password` varchar(255) NOT NULL DEFAULT '', `avatar` text, `points` bigint(20) NOT NULL DEFAULT 0, `credits` bigint(20) NOT NULL DEFAULT 0, `ipaddr` varchar(255) NOT NULL DEFAULT '', `privileges` int(1) NOT NULL DEFAULT 0, `erole` text, `subscriber` tinyint(1) NOT NULL DEFAULT 1, `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `last_action` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `visits` bigint(20) NOT NULL DEFAULT 0, `fail_attempts` int(10) NOT NULL DEFAULT 0, `valid` tinyint(1) NOT NULL DEFAULT 1, `ban` datetime NOT NULL DEFAULT '1970-01-01 00:00:00', `refid` int(10) NOT NULL DEFAULT 0, `extra` text, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), UNIQUE KEY `email` (`email`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "widgets` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `theme` varchar(255) NOT NULL DEFAULT '', `widget_id` varchar(50) NOT NULL DEFAULT '', `sidebar` varchar(255) NOT NULL DEFAULT '', `location` varchar(255) NOT NULL DEFAULT '', `title` varchar(255) NOT NULL DEFAULT '', `stop` int(4) NOT NULL DEFAULT '5', `type` varchar(50) NOT NULL DEFAULT '', `orderby` varchar(50) NOT NULL DEFAULT '', `position` int(2) NOT NULL DEFAULT 1, `text` text, `extra` text, `html` tinyint(1) NOT NULL DEFAULT 0, `mobile_view` tinyint(1) NOT NULL DEFAULT 1, `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "cities` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `name` varchar(255) NOT NULL DEFAULT '', `country` int(10) NOT NULL DEFAULT 0, `state` int(10) NOT NULL DEFAULT 0, `visible` tinyint(1) NOT NULL DEFAULT 1, `lat` double(20,14) NOT NULL, `lng` double(20,14) NOT NULL, `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB    DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "states` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `name` varchar(255) NOT NULL DEFAULT '', `country` int(10) NOT NULL DEFAULT 0, `visible` tinyint(1) NOT NULL DEFAULT 0, `lat` double(20,14) NOT NULL DEFAULT '0.00000000000000', `lng` double(20,14) NOT NULL DEFAULT '0.00000000000000', `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB    DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "countries` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `name` varchar(255) NOT NULL DEFAULT '', `visible` tinyint(1) NOT NULL DEFAULT 1, `lat` double(20,14) NOT NULL DEFAULT '0.00000000000000', `lng` double(20,14) NOT NULL DEFAULT '0.00000000000000', `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB    DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "store_locations` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `store` int(10) NOT NULL DEFAULT 0, `country` varchar(255) NOT NULL DEFAULT '', `countryID` int(10) NOT NULL DEFAULT 0, `state` varchar(255) NOT NULL DEFAULT '', `stateID` int(10) NOT NULL DEFAULT 0, `city` varchar(255) NOT NULL DEFAULT '', `cityID` int(10) NOT NULL DEFAULT 0, `zip` varchar(15) NOT NULL DEFAULT '', `address` varchar(255) NOT NULL DEFAULT '', `lat` double(20,14) NOT NULL DEFAULT '0.00000000000000', `lng` double(20,14) NOT NULL DEFAULT '0.00000000000000', `lastupdate_by` int(10) NOT NULL DEFAULT 0, `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), FULLTEXT KEY `country` (`country`), FULLTEXT KEY `state` (`state`), FULLTEXT KEY `city` (`city`), FULLTEXT KEY `zip` (`zip`), FULLTEXT KEY `address` (`address`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $tables[] = "CREATE TABLE IF NOT EXISTS `" . $i['table_prefix'] . "saved` (`id` int(100) NOT NULL AUTO_INCREMENT, `user` int(10) NOT NULL DEFAULT 0, `item` int(10) NOT NULL DEFAULT 0, `type` varchar(20) NOT NULL DEFAULT '', `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

    $errors = 0;

    foreach( $tables as $table ) {
        if( !$sql->query( $table ) ) $errors++;
    }

    $data[] = "INSERT INTO `" . $i['table_prefix'] . "users` (id, name, email, password, ipaddr, privileges, last_login, date) VALUES (1, 'Admin', '" . $i['admin_email'] . "', '" . md5( $i['admin_password'] ) . "', '" . $_SERVER['REMOTE_ADDR'] . "', 2, NOW(), NOW());";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "pages` (id, user, name, text, visible, lastupdate_by, lastupdate, date) VALUES (1, 1, 'About Us Page', 'Here will be something about us...', 1, 1, NOW(), NOW());";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "categories` (user, name, date) VALUES (1, 'Example Category', NOW());";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "chat` (user, text, date) VALUES (1, 'Hi there :) Welcome to your website !', NOW());";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "coupons` (user, store, category, title, description, start, expiration, extra, date) VALUES (1, 1, 1, 'Coupons Example !', 'This is just an example, you can delete it now !', NOW(), DATE_ADD(NOW(), INTERVAL 7 DAY), '', NOW());";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "stores` (user, category, name, link, description, extra, date) VALUES (1, 1, 'Brand/Store Example', 'http://couponscms.com', 'This is just an example, you can delete it now !', '', NOW());";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('sitename', 'Site Name');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('sitetitle', 'Site Title');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_charset', 'UTF-8');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('sitedescription', 'Welcome, this is my new website ! :)');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('siteinstalled', '" . time() . "');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('theme', 'Default');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('items_per_page', 8);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('delete_old_coupons', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('delete_old_products', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('default_user_avatar', 'avatar_aa.png');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('default_store_avatar', 'store_avatar_aa.png');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('default_reward_avatar', 'reward_avatar_aa.png');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_keywords', 'Meta Keywords');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_description', 'Meta Description');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('registrations', 'opened');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('accounts_per_ip', 3);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('siteurl', 'http://" . implode( '/', array_filter( [ $_SERVER['HTTP_HOST'], strtok( $_SERVER['REQUEST_URI'], '/' ) ] ) ) . "');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('sitelang', '" . ( $language = ( in_array( $i['language'], array_keys( $languages ) ) ? $i['language'] : 'english' ) ) . "');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('allow_select_lang', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('adminpanel_lang', '" . $language . "');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('allow_reviews', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('review_validate', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('allow_stores', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('store_validate', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('allow_coupons', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('coupon_validate', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('allow_products', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('product_validate', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('timezone', '" . date( 'e' ) . "');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('hour_format', 24);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('u_def_points', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('u_points_review', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('u_points_davisit', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('u_points_refer', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('u_confirm_req', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('subscr_confirm_req', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('unsubscr_confirm_req', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('seo_link_store', 'store');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('seo_link_coupon', 'coupon');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('seo_link_product', 'product');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('seo_link_category', 'category');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('seo_link_reviews', 'reviews');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('seo_link_stores', 'stores');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('seo_link_search', 'search');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('seo_link_user', 'user');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('seo_link_plugin', 'plugin');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_store_title', '%NAME% | Site Title');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_store_keywords', 'Store keywords, ...');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_store_desc', 'Everything about %NAME%, list of coupons, deals and reviews from customers and users.');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_coupon_title', 'Coupon %NAME% | Site Title');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_coupon_keywords', 'Coupon keywords, ...');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_coupon_desc', 'Coupon %NAME% available for %STORE_NAME%, get it now !');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_product_title', 'Product %NAME% | Site Title');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_product_keywords', 'Product keywords, ...');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_product_desc', 'Product %NAME% available for %STORE_NAME%, get it now !');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_reviews_title', 'Reviews for %NAME% | Site Title');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_reviews_keywords', 'Store review keywords, ...');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_reviews_desc', 'Reviews for %NAME% received from customers and users !');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_category_title', '%NAME% | Site Title');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_category_keywords', 'Category keywords, ...');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('meta_category_desc', 'Great coupons and deals for %NAME% !');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('email_from_name', 'Your Name');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('email_answer_to', 'answerto@yourdomain.ext');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('email_contact', 'contact@yourdomain.ext');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('facebook_appID', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('facebook_secret', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('google_clientID', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('google_secret', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('google_ruri', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('paypal_mode', 'Sandbox');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('paypal_ID', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('paypal_secret', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('google_maps_key', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('price_store', 5);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('price_coupon', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('price_max_days', 10);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('price_product', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('price_product_max_days', 10);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('feedserver', 'ggCoupon.com');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('feedserver_auth', 'GET');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('feedserver_ID', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('feedserver_secret', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('check_news', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('feed_uppics', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('feed_iexpc', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('feed_iexpp', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('feed_moddt', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('lfeed_check', UNIX_TIMESTAMP());";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('conf_unsubscr', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('mail_method', 'PHP Mail');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('smtp_auth', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('smtp_host', 'tls://smtp.example.com');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('smtp_port', 25);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('smtp_user', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('smtp_password', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('sendmail', '/usr/bin/sendmail');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('admintheme', 'theme/default.css');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('cron_secret', '83fbbe04db31edc136897c160454c7c5');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('mail_signature', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('refer_cookie', 60);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('social_facebook', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('social_google', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('social_twitter', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('social_flickr', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('social_linkedin', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('social_vimeo', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('social_youtube', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('social_myspace', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('social_reddit', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('social_pinterest', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('login_captcha', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('register_captcha', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('contact_captcha', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('suggest_captcha', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('subscribe_captcha', 0);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('extension', '.html');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('site_favicon', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('site_logo', '');";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('site_indexfollow', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('allow_votes', 2);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('delete_old_votes', 30);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('smilies_coupons', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('smilies_products', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('smilies_stores', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('smilies_reviews', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('smilies_pages', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('smilies_categories', 1);";
    $data[] = "INSERT INTO `" . $i['table_prefix'] . "options` (option_name, option_value) VALUES ('maintenance', " . ( isset( $i['maintenance'] ) ? 1 : 0 ) . ");";

    $sql->multi_query( implode( ' ', $data ) );

    if( empty( $errors ) ) {
        echo '<div class="success">Successfully installed!</div>';
    } else {
        echo '<div class="error">' . $errors    . ' tables couldn\'t be created because them exists. Your site will not work properly in this situation.</div>';
    }

    echo '<meta http-equiv="refresh" content="2; url=admin/">';

    /** DELETE INSTALL DIRECTORY WITH ALL FILES INSIDE */

    array_map( 'unlink', glob( 'install/*' ) );
    @rmdir( 'install' );
    @chmod( 'settings.php', 0644 );

} else {

    echo '<div class="error">We couldn\'t save your settings, please verify manually if have chmod 777 on settings.php.</div>';

}

}

}

?>

<form action="#" method="POST">

<?php if( !isset( $_POST['checked'] ) ) { ?>

<h2>Requirements</h2>

<ul>
    
<?php 

$able_to_install = true;

if( ( $version = phpversion() ) >= 5.4 ) {
    echo '<li class="green">&#10004; PHP version: <b>' . $version . '</b>
    <div class="info">Recommended version: 7.0 or greater</div></li>';
} else {
    $able_to_install = false;
    echo '<li class="red">&#10006; PHP min. version: <b>' . $version . '</b>
    <div class="info">Upgrade your PHP version to 5.4 or greater</div></li>';
} 

if( class_exists( 'mysqli' ) ) {
    echo '<li class="green">&#10004; MySQLi extension: <b>enabled</b>
    <div class="info">MySQLi is an extension added in MySQL 4.1</div></li>';
    if( !mysqli_connect_errno() ) {
        $able_to_install = false;
        echo '<li class="red">&#10006; MySQLi already connected
        <div class="info">Your website seems to be installed, please delete "install" directory</div></li>';
    }
} else {
    $able_to_install = false;
    echo '<li class="red">&#10006; MySQLi extension: <b>disabled/not installed</b>
    <div class="info">The mysqli extension allows you to access the functionality provided by MySQL 4.1 and above. Please enable/install this extension</div></li>';
}

if( class_exists( 'ZipArchive' ) ) {
    echo '<li class="green">&#10004; ZipArchive extension: <b>enabled</b>
    <div class="info">Used to: upload themes, install plugins</div></li>';
} else {
    echo '<li class="red">&#10006; ZipArchive extension: <b>disabled/not installed</b>
    <div class="info">You won\'t be able to: upload themes, install plugins</div></li>';
} ?>

</ul>

<?php if( $able_to_install ) { ?>

<input type="hidden" name="checked" />

<button>Let's start</button>

<?php } 

} else { ?>

<h2>Administrator details</h2>
<label for="install[admin_email]">* Email Address</label>
<input type="text" name="install[admin_email]" id="install[admin_email]" value="<?php echo ( isset( $i['admin_email'] ) ? $i['admin_email'] : '' ); ?>" required />
<label for="install[admin_password]">* Password:</label>
<input type="text" name="install[admin_password]" id="install[admin_password]" value="<?php echo ( isset( $i['admin_password'] ) ? $i['admin_password'] : '' ); ?>" required />

<h2>Database details</h2>
<label for="install[db_name]">* Database Name:</label>
<input type="text" name="install[db_name]" id="install[db_name]" value="<?php echo ( isset( $i['db_name'] ) ? $i['db_name'] : '' ); ?>" required />
<label for="install[db_user]">* Database User:</label>
<input type="text" name="install[db_user]" id="install[db_user]" value="<?php echo ( isset( $i['db_user'] ) ? $i['db_user'] : '' ); ?>" required />
<label for="install[db_password]">* Database Password:</label>
<input type="text" name="install[db_password]" id="install[db_password]" value="<?php echo ( isset( $i['db_password'] ) ? $i['db_password'] : '' ); ?>" required />
<label for="install[db_host]">* Database Host:</label>
<input type="text" name="install[db_host]" id="install[db_host]" value="<?php echo ( isset( $i['db_host'] ) ? $i['db_host'] : 'localhost' ); ?>" required />

<label for="install[table_prefix]">Table prefix:</label>
<input type="text" name="install[table_prefix]" id="install[table_prefix]" value="<?php echo ( isset( $i['table_prefix'] ) ? $i['table_prefix'] : '' ); ?>" />

<h2>Other Options</h2>

<div class="table">
    <input type="checkbox" name="install[maintenance]" id="install[maintenance]"<?php echo ( isset( $i['maintenance'] ) ? ' checked' : '' ); ?> class="table-cell" />
    <label for="install[maintenance]" class="table-cell">Maintenance mode (do not make my website public)</label>
</div>

<h2>Site Language</h2>
<select name="install[language]">
<?php foreach( $languages as $lang_id => $lang_name ) {
    echo '<option value="' . $lang_id . '"' . ( isset( $i['language'] ) && $i['language'] == $lang_id ? ' selected' : '' ) . '>' . $lang_name . '</option>';
} ?>
</select>

<input type="hidden" name="checked" />

<button>Install</button>

<?php } ?>

</form>

</div>

<div class="links">
    <a href="//couponscms.com">CouponsCMS.com</a>
</div>

</div>

</body>

</html>