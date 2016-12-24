-- MySQL dump 10.13  Distrib 5.5.52, for osx10.8 (i386)
--
-- Host: localhost    Database: flora_dating
-- ------------------------------------------------------
-- Server version	5.5.52

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `wjw_access`
--

DROP TABLE IF EXISTS `wjw_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_access`
--

LOCK TABLES `wjw_access` WRITE;
/*!40000 ALTER TABLE `wjw_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_ads`
--

DROP TABLE IF EXISTS `wjw_ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_ads`
--

LOCK TABLES `wjw_ads` WRITE;
/*!40000 ALTER TABLE `wjw_ads` DISABLE KEYS */;
INSERT INTO `wjw_ads` VALUES (1,'顶部横幅左侧','<a title=\"weibo\" target=\"_blank\" href=\"http://www.weibo.com/2568812924/profile?topnav=1&wvr=6\"><img src=\"holder.js/100%x100/random/广告图片二\"/></a>'),(2,'顶部横幅右侧','<a title=\"weibo\" target=\"_blank\" href=\"http://www.weibo.com/2568812924/profile?topnav=1&wvr=6\"><img src=\"holder.js/100%x100/random/广告图片二\"/></a>'),(3,'广告图片三','<a title=\"weibo\" target=\"_blank\" href=\"http://www.weibo.com/2568812924/profile?topnav=1&wvr=6\"><img src=\"holder.js/100%x100/random/广告图片二\"/></a>');
/*!40000 ALTER TABLE `wjw_ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_bookmark`
--

DROP TABLE IF EXISTS `wjw_bookmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_bookmark` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `wechat` tinyint(1) NOT NULL DEFAULT '0',
  KEY `pid` (`pid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_bookmark`
--

LOCK TABLES `wjw_bookmark` WRITE;
/*!40000 ALTER TABLE `wjw_bookmark` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_bookmark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_cat`
--

DROP TABLE IF EXISTS `wjw_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `pid` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `pos` int(11) NOT NULL DEFAULT '999999',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_cat`
--

LOCK TABLES `wjw_cat` WRITE;
/*!40000 ALTER TABLE `wjw_cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_cfg`
--

DROP TABLE IF EXISTS `wjw_cfg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_cfg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(64) DEFAULT 'site name',
  `kw` varchar(128) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `domain` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `tel` varchar(32) DEFAULT NULL,
  `company` varchar(32) DEFAULT NULL,
  `redline_price` int(11) NOT NULL DEFAULT '1' COMMENT '红线价格',
  `vip_price_month` int(11) NOT NULL DEFAULT '15',
  `vip_price_month_redline` int(11) NOT NULL DEFAULT '0',
  `vip_price_quarter` int(11) NOT NULL DEFAULT '50',
  `vip_price_quarter_redline` int(11) NOT NULL DEFAULT '0',
  `vip_price_half_year` int(11) NOT NULL DEFAULT '120',
  `vip_price_half_year_redline` int(11) NOT NULL DEFAULT '0',
  `vip_price_year` int(11) NOT NULL DEFAULT '200',
  `vip_price_year_redline` int(11) NOT NULL DEFAULT '0',
  `new_user_redline_free` int(11) NOT NULL DEFAULT '5',
  `redline_free_frequence_days` int(11) NOT NULL DEFAULT '1',
  `max_group` int(11) NOT NULL DEFAULT '1',
  `audit_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_cfg`
--

LOCK TABLES `wjw_cfg` WRITE;
/*!40000 ALTER TABLE `wjw_cfg` DISABLE KEYS */;
INSERT INTO `wjw_cfg` VALUES (1,'姻缘德国','德国相亲，德国交友','网站描述','yinyuan.de','yinyuan.de@hotmail.com','400-1234-5678','姻缘德国Ltd.co',10,50,20,50,50,120,120,80,50,5,1,0,'#');
/*!40000 ALTER TABLE `wjw_cfg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_city`
--

DROP TABLE IF EXISTS `wjw_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_city` (
  `class_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `class_parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `class_name` varchar(120) NOT NULL DEFAULT '',
  `class_type` tinyint(1) NOT NULL DEFAULT '2',
  `pinyin` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`class_id`),
  KEY `class_parent_id` (`class_parent_id`),
  KEY `class_type` (`class_type`)
) ENGINE=MyISAM AUTO_INCREMENT=3409 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_city`
--

LOCK TABLES `wjw_city` WRITE;
/*!40000 ALTER TABLE `wjw_city` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_classify_image`
--

DROP TABLE IF EXISTS `wjw_classify_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_classify_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) NOT NULL,
  `create_time` int(11) NOT NULL,
  `url` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_classify_image`
--

LOCK TABLES `wjw_classify_image` WRITE;
/*!40000 ALTER TABLE `wjw_classify_image` DISABLE KEYS */;
INSERT INTO `wjw_classify_image` VALUES (4,'/Upload/classify/584253489e297.jpg',1480741704,'baidu.com'),(6,'/Upload/classify/5842c3525d195.jpg',1480770386,'');
/*!40000 ALTER TABLE `wjw_classify_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_classify_info`
--

DROP TABLE IF EXISTS `wjw_classify_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_classify_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `classname` varchar(100) NOT NULL COMMENT '分类名称',
  `pid` int(11) DEFAULT '0' COMMENT '父类id',
  `url` varchar(255) NOT NULL COMMENT 'URL地址',
  `no` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_classify_info`
--

LOCK TABLES `wjw_classify_info` WRITE;
/*!40000 ALTER TABLE `wjw_classify_info` DISABLE KEYS */;
INSERT INTO `wjw_classify_info` VALUES (4,'海外酒店',3,'',1),(3,'酒店',0,'',0),(5,'机票',0,'',0),(6,'test',0,'',1);
/*!40000 ALTER TABLE `wjw_classify_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_date_cache`
--

DROP TABLE IF EXISTS `wjw_date_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_date_cache` (
  `cachekey` char(50) NOT NULL,
  `data` varchar(500) NOT NULL,
  `datacrc` varchar(50) DEFAULT NULL,
  `expire` int(11) NOT NULL,
  PRIMARY KEY (`cachekey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_date_cache`
--

LOCK TABLES `wjw_date_cache` WRITE;
/*!40000 ALTER TABLE `wjw_date_cache` DISABLE KEYS */;
INSERT INTO `wjw_date_cache` VALUES ('','i:10000;','',1481884708),('wx_login_token','s:9:\"694255073\";','',1450971500);
/*!40000 ALTER TABLE `wjw_date_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_date_record`
--

DROP TABLE IF EXISTS `wjw_date_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_date_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `from_sex` tinyint(4) NOT NULL,
  `from_vip` tinyint(4) NOT NULL DEFAULT '0',
  `from_user_time` int(11) NOT NULL,
  `to_user_id` int(11) DEFAULT '0',
  `to_user_time` int(11) DEFAULT '0' COMMENT '匹配时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_date_record`
--

LOCK TABLES `wjw_date_record` WRITE;
/*!40000 ALTER TABLE `wjw_date_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_date_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_nav`
--

DROP TABLE IF EXISTS `wjw_nav`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat` int(11) NOT NULL DEFAULT '0',
  `pos` smallint(6) NOT NULL DEFAULT '999',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_nav`
--

LOCK TABLES `wjw_nav` WRITE;
/*!40000 ALTER TABLE `wjw_nav` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_nav` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_news`
--

DROP TABLE IF EXISTS `wjw_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `addtime` int(11) DEFAULT '0',
  `cat` int(11) DEFAULT '0',
  `start_time` int(11) DEFAULT '0',
  `end_time` int(11) DEFAULT '0',
  `reg` int(11) NOT NULL DEFAULT '0',
  `arrival` int(11) NOT NULL DEFAULT '0',
  `pos` int(11) NOT NULL DEFAULT '999999',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `userid` int(11) NOT NULL DEFAULT '0',
  `alive` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0,允许报名,1,允许男性报名,2,允许女性报名3,报名截止',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_news`
--

LOCK TABLES `wjw_news` WRITE;
/*!40000 ALTER TABLE `wjw_news` DISABLE KEYS */;
INSERT INTO `wjw_news` VALUES (1,'的萨芬的说法第三方杀毒','55a54767c001f.jpg','生大幅度是发生大幅度是','上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法',1455441735,1,1436895000,1456909380,3,0,999999,1,0,2),(2,'的萨芬的说法第三方杀毒','55a54767c001f.jpg','生大幅度是发生大幅度是','上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法',1436895306,1,1436895000,1457909400,1,0,999999,1,0,0),(3,'的萨芬的说法第三方杀毒','55a54767c001f.jpg','生大幅度是发生大幅度是','上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法',1436895306,1,1436895000,1436909400,1,0,999999,1,0,0),(4,'的萨芬的说法第三方杀毒','55a54767c001f.jpg','生大幅度是发生大幅度是','上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法',1451492018,1,1436895000,1456909380,0,0,999999,1,0,2),(5,'的萨芬的说法第三方杀毒','55a54767c001f.jpg','生大幅度是发生大幅度是','上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法',1436895306,1,1436895000,1436909400,2,0,999999,1,0,0),(6,'的萨芬的说法第三方杀毒','55a54767c001f.jpg','生大幅度是发生大幅度是','上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法',1436895306,1,1436895000,1436909400,2,0,999999,1,0,0),(7,'的萨芬的说法第三方杀毒','55a54767c001f.jpg','生大幅度是发生大幅度是','上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法',1436895306,1,1436895000,1536909400,2,0,999999,1,0,0),(8,'的萨芬的说法第三方杀毒','55a54767c001f.jpg','生大幅度是发生大幅度是','上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法上的发是大法师大法',1436895306,1,1436895000,1436909400,1,0,999999,1,0,0),(9,'国人相聚','5626fdf3c78c7.jpg','德国','撒旦法施工的环境分开过S东方广场就考虑',1445396007,2,1445395980,1445741580,1,0,999999,1,0,0);
/*!40000 ALTER TABLE `wjw_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_news_cat`
--

DROP TABLE IF EXISTS `wjw_news_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_news_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pos` int(11) NOT NULL DEFAULT '999999',
  `pid` int(11) NOT NULL DEFAULT '0',
  `header` tinyint(1) NOT NULL DEFAULT '0',
  `footer` tinyint(1) NOT NULL DEFAULT '0',
  `home` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_news_cat`
--

LOCK TABLES `wjw_news_cat` WRITE;
/*!40000 ALTER TABLE `wjw_news_cat` DISABLE KEYS */;
INSERT INTO `wjw_news_cat` VALUES (1,'女选男',NULL,NULL,999999,0,0,0,0),(2,'男选女',NULL,NULL,999999,0,0,0,0);
/*!40000 ALTER TABLE `wjw_news_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_node`
--

DROP TABLE IF EXISTS `wjw_node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT '999',
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_node`
--

LOCK TABLES `wjw_node` WRITE;
/*!40000 ALTER TABLE `wjw_node` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_orders`
--

DROP TABLE IF EXISTS `wjw_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_orders` (
  `id` bigint(20) NOT NULL,
  `goods` text COLLATE utf8_unicode_ci NOT NULL,
  `goods_price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `ship_fee` decimal(9,2) NOT NULL DEFAULT '0.00',
  `pay_price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `pay_time` int(11) NOT NULL DEFAULT '0',
  `send_time` int(11) NOT NULL DEFAULT '0',
  `receive_time` int(11) NOT NULL DEFAULT '0',
  `realname` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_time` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `uid` int(11) NOT NULL DEFAULT '0',
  `hub` int(11) NOT NULL DEFAULT '0',
  `payment` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_orders`
--

LOCK TABLES `wjw_orders` WRITE;
/*!40000 ALTER TABLE `wjw_orders` DISABLE KEYS */;
INSERT INTO `wjw_orders` VALUES (20151129000001,'购买红线10根',0.00,10.00,100.00,1448774834,0,0,0,NULL,NULL,NULL,NULL,NULL,10019,0,0,0);
/*!40000 ALTER TABLE `wjw_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_product`
--

DROP TABLE IF EXISTS `wjw_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price1` decimal(9,2) NOT NULL DEFAULT '0.00',
  `price2` decimal(9,2) NOT NULL DEFAULT '0.00',
  `price3` decimal(9,2) NOT NULL DEFAULT '0.00',
  `score` int(11) NOT NULL DEFAULT '0',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `hits` int(11) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL COMMENT '发布时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1上架、0下架',
  `pos` int(11) NOT NULL DEFAULT '999999',
  `code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=218 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_product`
--

LOCK TABLES `wjw_product` WRITE;
/*!40000 ALTER TABLE `wjw_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_product_pic`
--

DROP TABLE IF EXISTS `wjw_product_pic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_product_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0是横幅，1是幻灯片，2是小图',
  `url` text COLLATE utf8_unicode_ci,
  `pos` mediumint(6) NOT NULL DEFAULT '999999',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_product_pic`
--

LOCK TABLES `wjw_product_pic` WRITE;
/*!40000 ALTER TABLE `wjw_product_pic` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_product_pic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_record`
--

DROP TABLE IF EXISTS `wjw_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_record` (
  `news_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reg_time` int(11) NOT NULL DEFAULT '0',
  `arrival_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`news_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_record`
--

LOCK TABLES `wjw_record` WRITE;
/*!40000 ALTER TABLE `wjw_record` DISABLE KEYS */;
INSERT INTO `wjw_record` VALUES (1,10000,1441265073,0),(2,10000,1441265090,0),(5,10010,1443516581,0),(8,10010,1445260080,0),(6,10014,1445882511,0);
/*!40000 ALTER TABLE `wjw_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_redline_log`
--

DROP TABLE IF EXISTS `wjw_redline_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_redline_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `types` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `addtime` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0：正常 -1：被投诉 1：管理员已处理并且已返回道具 2：已处理没有返回道具',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_redline_log`
--

LOCK TABLES `wjw_redline_log` WRITE;
/*!40000 ALTER TABLE `wjw_redline_log` DISABLE KEYS */;
INSERT INTO `wjw_redline_log` VALUES (51,1,10000,'showWechatPayFree','查看微信号',1446127690,10002,1),(50,1,10000,'showWechatPay','查看微信号',1446106039,10005,2),(49,1,10000,'showWechatPay','查看微信号',1446105866,10006,1),(48,1,10000,'showWechatPay','查看微信号',1446105115,10004,-1),(47,1,10000,'showWechatPay','查看微信号',1446105077,10003,0),(46,1,10000,'showWechatPayFree','查看微信号',1446104543,10001,0),(45,1,10018,'showWechatPay','查看微信号',1446104236,10006,0),(44,1,10018,'showWechatPay','查看微信号',1446104037,10005,0),(43,1,10018,'showWechatPayFree','查看微信号',1446103967,10002,0),(42,1,10018,'showWechatPay','查看微信号',1446099446,10004,0),(41,1,10018,'showWechatPay','查看微信号',1446098960,10001,0),(52,5,10005,'AdminFree','系统赠送红线',1446301870,0,0),(53,1,10000,'showWechatPayFree','查看微信号',1450794513,10000,0),(54,1,10000,'showWechatPay','查看微信号',1450796657,10000,0);
/*!40000 ALTER TABLE `wjw_redline_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_relationship`
--

DROP TABLE IF EXISTS `wjw_relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_relationship` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  KEY `pid` (`pid`,`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_relationship`
--

LOCK TABLES `wjw_relationship` WRITE;
/*!40000 ALTER TABLE `wjw_relationship` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_relationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_role`
--

DROP TABLE IF EXISTS `wjw_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_role`
--

LOCK TABLES `wjw_role` WRITE;
/*!40000 ALTER TABLE `wjw_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_role_user`
--

DROP TABLE IF EXISTS `wjw_role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_role_user`
--

LOCK TABLES `wjw_role_user` WRITE;
/*!40000 ALTER TABLE `wjw_role_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_show`
--

DROP TABLE IF EXISTS `wjw_show`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `upload_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_show`
--

LOCK TABLES `wjw_show` WRITE;
/*!40000 ALTER TABLE `wjw_show` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_show` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_slide`
--

DROP TABLE IF EXISTS `wjw_slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(256) COLLATE utf8_unicode_ci DEFAULT '#',
  `pos` tinyint(1) NOT NULL DEFAULT '9',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_slide`
--

LOCK TABLES `wjw_slide` WRITE;
/*!40000 ALTER TABLE `wjw_slide` DISABLE KEYS */;
INSERT INTO `wjw_slide` VALUES (7,'这个是标题','1.jpg','http://weibo.com',9,0),(8,'who are we','2.jpg','#',9,0),(9,'的撒开了房间爱看了电视剧','3.jpg','http://weibo.com',9,0),(10,'好好哈市的方式的范德萨','4.jpg','#',9,0);
/*!40000 ALTER TABLE `wjw_slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_user`
--

DROP TABLE IF EXISTS `wjw_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(28) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `wechat` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `realname` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT '0',
  `birthday` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `edu` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `income` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `love` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `interest` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sign` varchar(80) COLLATE utf8_unicode_ci DEFAULT '这个家伙很懒，还没留下个性签名',
  `address` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logtime` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '127.0.0.1',
  `regtime` int(11) NOT NULL,
  `vipendtime` int(11) NOT NULL,
  `pos` int(11) NOT NULL DEFAULT '999999',
  `reg` int(11) NOT NULL DEFAULT '0',
  `arrival` int(11) NOT NULL DEFAULT '0',
  `redline` int(11) NOT NULL DEFAULT '0',
  `redlinefree` int(11) NOT NULL DEFAULT '0',
  `redline1` int(11) NOT NULL DEFAULT '0',
  `vip` int(11) NOT NULL DEFAULT '0' COMMENT 'VIP类型',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `idcard` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twelve` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qq` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weixin` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msn` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nickname` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wedding` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blood` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buyhouse` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buycar` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_type` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `income2` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Professional` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faith` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age_scope` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `h_scope` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edu_scope` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `love2` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i_scope` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `star` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hukou` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jiguan` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ranking` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_sta` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jici` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plan` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kid` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `live` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `friend_sta` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nation` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastsendtime` int(11) DEFAULT '0',
  `audit` tinyint(4) NOT NULL DEFAULT '0',
  `remark` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10020 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_user`
--

LOCK TABLES `wjw_user` WRITE;
/*!40000 ALTER TABLE `wjw_user` DISABLE KEYS */;
INSERT INTO `wjw_user` VALUES (10000,'oxzNruLWQ1euN_sQRMuF0BBo9-hA','flora','e10adc3949ba59abbe56e057f20f883e','bonytsin1','13900000000','flora@china.com','flora-zhang','no_face.gif',0,'1990-09-09',29,160,'本科','800-1500欧','有稳定伴侣','兴趣及爱好B','1是打开了附近的思考了房间爱打瞌睡了房间里卡戴珊缴费卡拉斯的盛大','江西南昌文教路7号',1481879885,'0.0.0.0',0,1477125435,999999,22,2,100930,1,15,1446021435,1,'','','0','','','0','flora-zhang1','','A型','暂未购房','暂未购车','政府机关','福利优越','中文','信仰A','20-24','170-180','无要求','保密','无照片','一星期以上','','','独生子女','退休','1次','近期有结婚打算','愿意','愿意','约会中','中国','满族','青岛',1450882653,1,NULL),(10019,'oxzNruI1SEBnO-Qtkztug0ioB5zQ','251278498@qq.com','e10adc3949ba59abbe56e057f20f883e','123456','','251278498@qq.com',NULL,'no_face.gif',1,NULL,0,0,'不详','保密','保密','','这个家伙很懒，还没留下个性签名',NULL,1454588598,'127.0.0.1',1448634793,0,999999,0,0,0,5,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,'暂未购房','暂未购车','不详','福利优越','','',NULL,NULL,NULL,NULL,NULL,NULL,'','','不详','退休','没有','近期有结婚打算','愿意','愿意','正在征友','保密','',NULL,0,0,'remakr');
/*!40000 ALTER TABLE `wjw_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_vote`
--

DROP TABLE IF EXISTS `wjw_vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '投票活动标题',
  `start_time` int(11) DEFAULT '0' COMMENT '投票开始时间',
  `end_time` int(11) DEFAULT '0' COMMENT '投票结束时间',
  `content` varchar(255) NOT NULL COMMENT '活动内容详情',
  `image` varchar(255) NOT NULL COMMENT '图片路径',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '投票类型',
  `desc` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_vote`
--

LOCK TABLES `wjw_vote` WRITE;
/*!40000 ALTER TABLE `wjw_vote` DISABLE KEYS */;
INSERT INTO `wjw_vote` VALUES (3,'tile2',1478811940,1487898340,'fdsa2','/Upload/vote/5815a2af66f40.jpg',0,'');
/*!40000 ALTER TABLE `wjw_vote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_vote_record`
--

DROP TABLE IF EXISTS `wjw_vote_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_vote_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `open_id` varchar(100) NOT NULL,
  `vote_time` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `vote_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_vote_record`
--

LOCK TABLES `wjw_vote_record` WRITE;
/*!40000 ALTER TABLE `wjw_vote_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_vote_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_vote_select`
--

DROP TABLE IF EXISTS `wjw_vote_select`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_vote_select` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '选项标题',
  `vote_id` int(11) DEFAULT '0' COMMENT '投票活动id',
  `image` varchar(255) NOT NULL COMMENT '图片路径',
  `order` int(11) NOT NULL DEFAULT '0',
  `add_num` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_vote_select`
--

LOCK TABLES `wjw_vote_select` WRITE;
/*!40000 ALTER TABLE `wjw_vote_select` DISABLE KEYS */;
INSERT INTO `wjw_vote_select` VALUES (1,'yrytr1',3,'/Upload/vote/5815aee74fbca.jpg',1,2);
/*!40000 ALTER TABLE `wjw_vote_select` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_wechat`
--

DROP TABLE IF EXISTS `wjw_wechat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_wechat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `itemlist` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_wechat`
--

LOCK TABLES `wjw_wechat` WRITE;
/*!40000 ALTER TABLE `wjw_wechat` DISABLE KEYS */;
INSERT INTO `wjw_wechat` VALUES (50,'关注自动回复','欢迎进入姻缘德国','55266af1c178d.jpg','','http://yinyuan.de',''),(49,'注册','注册成为姻缘德国网站会员','5524e737c055e.jpg','','http://yinyuan.de/Member/register','');
/*!40000 ALTER TABLE `wjw_wechat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_wechat_cfg`
--

DROP TABLE IF EXISTS `wjw_wechat_cfg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_wechat_cfg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `encodingaeskey` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `appid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `appsecret` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `mchid` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_wechat_cfg`
--

LOCK TABLES `wjw_wechat_cfg` WRITE;
/*!40000 ALTER TABLE `wjw_wechat_cfg` DISABLE KEYS */;
INSERT INTO `wjw_wechat_cfg` VALUES (1,'18507092728','lW0rscRkq3pnVGHU7JiRVMUNQxm6CGJUv6Y23BhVorV','wxb80db666dfd207b2','2e5a39638e15d6ed173a36884fc143e3','1252913501','Testtest1234Testtest1234Testtest');
/*!40000 ALTER TABLE `wjw_wechat_cfg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_wechat_menu`
--

DROP TABLE IF EXISTS `wjw_wechat_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_wechat_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `types` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `val` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `pos` int(11) NOT NULL DEFAULT '999',
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_wechat_menu`
--

LOCK TABLES `wjw_wechat_menu` WRITE;
/*!40000 ALTER TABLE `wjw_wechat_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_wechat_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_wechat_tplmsg`
--

DROP TABLE IF EXISTS `wjw_wechat_tplmsg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_wechat_tplmsg` (
  `id` varchar(43) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_wechat_tplmsg`
--

LOCK TABLES `wjw_wechat_tplmsg` WRITE;
/*!40000 ALTER TABLE `wjw_wechat_tplmsg` DISABLE KEYS */;
INSERT INTO `wjw_wechat_tplmsg` VALUES ('Goe9iYZYWfBIJ1AhbdGdWmz5RU0S9bVmQbYm5SnDZzM','注册成功通知','文体娱乐 - 娱乐休闲',147000000),('OERtqP6XcRKEt5nMCadlcZOlhy-t3Idv_vvdhpEgcsI','活动变动通知','文体娱乐 - 娱乐休闲',147000000),('VIWrhJWp32juZs8pzzhyz3lfftKZqmEFJEqPOk4qVzE','活动报名成功通知','文体娱乐 - 娱乐休闲',1438643138),('ahuYTW6bpT9WQw3l-udB48IFPz4q6Vz-Egkiridbs_A','成为会员通知','文体娱乐 - 娱乐休闲',1438644832),('ohfE-4ZTHKt9gB7KHIVhV7Ckr7EXsaKi6_gpP-2VM0I','预约到期提醒','文体娱乐 - 娱乐休闲',1438644870),('tN-BolM8cQ5cgkeRCM-RFOmCgjITyC34vgB5TX_OBFs','购买成功通知','文体娱乐 - 娱乐休闲',1438644899);
/*!40000 ALTER TABLE `wjw_wechat_tplmsg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_wechatcomplain`
--

DROP TABLE IF EXISTS `wjw_wechatcomplain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_wechatcomplain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `wechat` varchar(45) NOT NULL,
  `complaintime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_wechatcomplain`
--

LOCK TABLES `wjw_wechatcomplain` WRITE;
/*!40000 ALTER TABLE `wjw_wechatcomplain` DISABLE KEYS */;
/*!40000 ALTER TABLE `wjw_wechatcomplain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wjw_yyb_log`
--

DROP TABLE IF EXISTS `wjw_yyb_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wjw_yyb_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `redline` int(11) NOT NULL,
  `remarks` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wjw_yyb_log`
--

LOCK TABLES `wjw_yyb_log` WRITE;
/*!40000 ALTER TABLE `wjw_yyb_log` DISABLE KEYS */;
INSERT INTO `wjw_yyb_log` VALUES (1,10000,10,'购买VIP服务',1441526034),(2,10000,25,'购买VIP服务',1441526120),(3,10000,100,'购买VIP服务',1441526642),(4,10000,10,'购买VIP服务',1443074323),(5,10000,10,'购买VIP服务',1443153093),(6,10000,0,'购买VIP服务',1443156316),(7,10000,0,'购买VIP服务',1443156331),(8,10000,0,'购买VIP服务',1443156803),(9,10000,0,'购买VIP服务',1443156829),(10,10000,0,'购买VIP服务',1443158468),(11,10000,0,'购买VIP服务',1443158642);
/*!40000 ALTER TABLE `wjw_yyb_log` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-24 12:12:00
