-- ±íµÄ½á¹¹£ºxh_access --
CREATE TABLE `xh_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限配备表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_classes --
CREATE TABLE `xh_classes` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `ccode` varchar(6) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `master` varchar(9) NOT NULL COMMENT '班主任',
  `zjsj` varchar(11) NOT NULL COMMENT '组建时间',
  `proname` varchar(50) NOT NULL COMMENT '专业名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ccode` (`ccode`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='班级表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_course --
CREATE TABLE `xh_course` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `proname` varchar(50) NOT NULL COMMENT '专业名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='课程表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_discuss --
CREATE TABLE `xh_discuss` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `lytime` int(11) NOT NULL,
  `lyip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='留言板';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_link --
CREATE TABLE `xh_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `imgsrc` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='友情连接表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_news --
CREATE TABLE `xh_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `pubtype` int(1) NOT NULL,
  `userxm` varchar(30) NOT NULL,
  `pubtime` int(10) NOT NULL,
  `updatetime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='新闻通知公告表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_node --
CREATE TABLE `xh_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 COMMENT='节点表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_office --
CREATE TABLE `xh_office` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='处室表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_professional --
CREATE TABLE `xh_professional` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='专业';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_role --
CREATE TABLE `xh_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_role_user --
CREATE TABLE `xh_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色配置表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_site --
CREATE TABLE `xh_site` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `copyright` varchar(200) NOT NULL,
  `icp` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='站点信息表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_student --
CREATE TABLE `xh_student` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `xsno` varchar(13) NOT NULL,
  `xsxm` varchar(20) NOT NULL,
  `xsxb` varchar(2) NOT NULL,
  `xsmm` varchar(32) NOT NULL DEFAULT '123456',
  `rxsj` varchar(11) NOT NULL COMMENT '入学时间',
  `ccode` int(5) unsigned NOT NULL COMMENT '班级编码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `xsno` (`xsno`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COMMENT='学生表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_sxdisexicise --
CREATE TABLE `xh_sxdisexicise` (
  `deid` int(11) NOT NULL AUTO_INCREMENT,
  `peid` int(11) NOT NULL COMMENT '所属任务',
  `atuser` varchar(50) NOT NULL DEFAULT '',
  `content` text NOT NULL COMMENT '评价内容',
  `userxm` varchar(20) NOT NULL COMMENT '参评用户',
  `usertype` varchar(10) NOT NULL COMMENT '参评用户类型：教师和学生',
  `distime` int(11) NOT NULL COMMENT '参评时间',
  `pdeid` int(11) NOT NULL COMMENT 'pid',
  PRIMARY KEY (`deid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='实训任务讨论评价表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_sxpubexcise --
CREATE TABLE `xh_sxpubexcise` (
  `peid` int(10) NOT NULL AUTO_INCREMENT,
  `scid` int(10) NOT NULL COMMENT '指定教师班级课程',
  `title` varchar(100) NOT NULL COMMENT '任务标题',
  `desc` text NOT NULL COMMENT '任务描述',
  `url` varchar(500) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '布置否，0表示否',
  `pubtime` int(11) NOT NULL COMMENT '布置时间',
  `isrec` int(1) NOT NULL DEFAULT '0' COMMENT '是否推荐，0表示不推荐',
  PRIMARY KEY (`peid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='发布作业表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_sxsetcourse --
CREATE TABLE `xh_sxsetcourse` (
  `scid` int(10) NOT NULL AUTO_INCREMENT,
  `jsno` varchar(9) NOT NULL,
  `ccode` varchar(6) NOT NULL,
  `coursename` varchar(50) NOT NULL COMMENT '课程名称',
  `term` varchar(11) NOT NULL COMMENT '学期',
  PRIMARY KEY (`scid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='设置课程表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_sxsubexcise --
CREATE TABLE `xh_sxsubexcise` (
  `seid` int(11) NOT NULL AUTO_INCREMENT,
  `peid` int(10) NOT NULL COMMENT '教师布置的任务',
  `xsno` varchar(13) NOT NULL COMMENT '学号',
  `desc` varchar(50) NOT NULL COMMENT '自我评价',
  `filename` varchar(100) NOT NULL COMMENT '附件文件名',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '提交否，0未提交',
  `subtime` int(11) NOT NULL COMMENT '提交时间',
  `isrec` varchar(50) NOT NULL COMMENT '教师评价',
  PRIMARY KEY (`seid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='学生任务完成表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_teacher --
CREATE TABLE `xh_teacher` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `jsno` varchar(9) NOT NULL,
  `jsxm` varchar(10) NOT NULL,
  `jsxb` varchar(2) NOT NULL,
  `jsdh` varchar(11) NOT NULL,
  `jsmm` varchar(32) NOT NULL DEFAULT '123456',
  `offname` varchar(50) NOT NULL COMMENT '处室名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jsno` (`jsno`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='教师表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_term --
CREATE TABLE `xh_term` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='学期';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_user --
CREATE TABLE `xh_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0',
  `loginip` char(20) CHARACTER SET ucs2 NOT NULL DEFAULT '',
  `lock` smallint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户表';-- <xjx> --

-- ±íµÄ½á¹¹£ºxh_vedio --
CREATE TABLE `xh_vedio` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `videourl` varchar(255) NOT NULL,
  `videoext` varchar(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `pubtime` int(10) NOT NULL,
  `updtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='微课资源表';-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_access --
INSERT INTO `xh_access` VALUES
('1','1','1',NULL),
('1','61','2',NULL),
('1','62','3',NULL),
('1','63','2',NULL),
('1','65','3',NULL),
('1','66','3',NULL),
('1','67','3',NULL),
('1','68','3',NULL),
('1','69','2',NULL),
('1','70','3',NULL),
('1','71','3',NULL),
('1','72','3',NULL),
('1','73','3',NULL),
('1','74','3',NULL),
('1','75','2',NULL),
('1','76','3',NULL),
('1','77','3',NULL),
('1','78','3',NULL),
('1','79','3',NULL),
('1','80','3',NULL),
('1','81','3',NULL),
('1','82','3',NULL),
('1','83','3',NULL),
('1','84','3',NULL),
('1','85','3',NULL),
('1','86','3',NULL),
('1','87','3',NULL),
('1','88','3',NULL),
('1','89','3',NULL),
('1','90','3',NULL),
('1','91','2',NULL),
('1','92','3',NULL),
('1','93','3',NULL),
('1','94','3',NULL),
('1','95','3',NULL),
('1','96','3',NULL),
('1','97','2',NULL),
('1','98','3',NULL),
('1','99','3',NULL),
('1','100','3',NULL),
('1','101','3',NULL),
('1','102','3',NULL),
('1','103','3',NULL),
('1','104','3',NULL),
('1','105','3',NULL),
('1','106','3',NULL),
('1','107','3',NULL),
('1','108','3',NULL),
('1','109','3',NULL),
('1','110','3',NULL),
('1','111','3',NULL),
('1','112','3',NULL),
('1','113','3',NULL),
('1','114','3',NULL),
('1','115','3',NULL),
('1','116','3',NULL),
('1','117','3',NULL),
('1','118','3',NULL),
('1','119','3',NULL),
('1','120','3',NULL),
('1','121','3',NULL),
('1','122','3',NULL),
('1','123','3',NULL),
('1','124','3',NULL),
('1','125','3',NULL),
('1','126','3',NULL),
('1','127','3',NULL),
('1','128','3',NULL),
('1','129','3',NULL),
('1','130','3',NULL),
('1','131','3',NULL),
('1','132','3',NULL),
('1','133','3',NULL),
('1','134','2',NULL),
('1','135','3',NULL),
('1','136','3',NULL),
('1','137','3',NULL),
('1','138','3',NULL),
('1','139','3',NULL),
('1','140','3',NULL),
('1','141','3',NULL),
('1','142','3',NULL),
('1','143','3',NULL),
('1','144','3',NULL),
('1','145','3',NULL),
('1','146','3',NULL),
('1','147','3',NULL),
('1','148','3',NULL),
('1','149','3',NULL),
('1','150','3',NULL),
('1','2','1',NULL),
('1','27','2',NULL),
('1','28','3',NULL),
('1','29','3',NULL),
('1','31','2',NULL),
('1','32','3',NULL),
('1','33','3',NULL),
('1','34','3',NULL),
('1','35','3',NULL),
('1','36','2',NULL),
('1','37','3',NULL),
('1','38','2',NULL),
('1','39','3',NULL),
('1','40','3',NULL),
('1','41','3',NULL),
('1','42','3',NULL),
('1','43','2',NULL),
('1','44','3',NULL),
('1','45','3',NULL),
('1','46','3',NULL),
('1','47','3',NULL),
('1','48','3',NULL),
('1','50','3',NULL),
('1','52','3',NULL),
('1','53','3',NULL),
('1','54','3',NULL),
('1','55','3',NULL),
('1','56','3',NULL),
('1','57','3',NULL),
('1','58','3',NULL),
('1','59','3',NULL),
('1','60','3',NULL),
('1','3','1',NULL),
('1','9','2',NULL),
('1','10','3',NULL),
('1','11','3',NULL),
('1','12','2',NULL),
('1','13','3',NULL),
('1','14','3',NULL),
('1','15','3',NULL),
('1','16','3',NULL),
('1','17','2',NULL),
('1','18','3',NULL),
('1','19','2',NULL),
('1','20','3',NULL),
('1','21','3',NULL),
('1','22','3',NULL),
('1','25','3',NULL),
('1','26','3',NULL),
('1','51','3',NULL),
('1','4','1',NULL),
('1','5','2',NULL),
('1','6','3',NULL),
('1','7','3',NULL),
('1','8','3',NULL),
('1','23','3',NULL),
('1','24','3',NULL),
('2','61','2',NULL),
('2','62','3',NULL),
('2','63','2',NULL),
('2','65','3',NULL),
('2','66','3',NULL),
('2','67','3',NULL),
('2','68','3',NULL),
('2','70','3',NULL),
('2','91','2',NULL),
('2','92','3',NULL),
('2','93','3',NULL),
('2','94','3',NULL),
('2','95','3',NULL),
('2','96','3',NULL),
('2','97','2',NULL),
('2','98','3',NULL),
('2','99','3',NULL),
('2','100','3',NULL),
('2','101','3',NULL),
('2','102','3',NULL),
('2','103','3',NULL),
('2','104','3',NULL),
('2','105','3',NULL),
('2','106','3',NULL),
('2','107','3',NULL),
('2','108','3',NULL),
('2','109','3',NULL),
('2','110','3',NULL),
('2','111','3',NULL),
('2','112','3',NULL),
('2','113','3',NULL),
('2','114','3',NULL),
('2','115','3',NULL),
('2','116','3',NULL),
('2','117','3',NULL),
('2','118','3',NULL),
('2','119','3',NULL),
('2','120','3',NULL),
('2','121','3',NULL),
('2','122','3',NULL),
('2','123','3',NULL),
('2','124','3',NULL),
('2','125','3',NULL),
('2','126','3',NULL),
('2','127','3',NULL),
('2','128','3',NULL),
('2','129','3',NULL),
('2','130','3',NULL),
('2','131','3',NULL),
('2','132','3',NULL),
('2','133','3',NULL),
('2','134','2',NULL),
('2','135','3',NULL),
('2','136','3',NULL),
('2','137','3',NULL),
('2','138','3',NULL),
('2','139','3',NULL),
('2','140','3',NULL),
('2','141','3',NULL),
('2','142','3',NULL),
('2','143','3',NULL),
('2','144','3',NULL),
('2','145','3',NULL),
('2','146','3',NULL),
('2','147','3',NULL),
('2','148','3',NULL),
('2','149','3',NULL),
('2','150','3',NULL),
('2','2','1',NULL),
('2','27','2',NULL),
('2','28','3',NULL),
('2','29','3',NULL),
('2','31','2',NULL),
('2','32','3',NULL),
('2','33','3',NULL),
('2','34','3',NULL),
('2','35','3',NULL),
('2','36','2',NULL),
('2','37','3',NULL),
('2','38','2',NULL),
('2','39','3',NULL),
('2','40','3',NULL),
('2','41','3',NULL),
('2','42','3',NULL),
('2','43','2',NULL),
('2','44','3',NULL),
('2','45','3',NULL),
('2','46','3',NULL),
('2','47','3',NULL),
('2','48','3',NULL),
('2','50','3',NULL),
('2','52','3',NULL),
('2','53','3',NULL),
('2','54','3',NULL),
('2','55','3',NULL),
('2','56','3',NULL),
('2','57','3',NULL),
('2','58','3',NULL),
('2','59','3',NULL),
('2','60','3',NULL),
('2','3','1',NULL),
('2','9','2',NULL),
('2','10','3',NULL),
('2','11','3',NULL),
('2','12','2',NULL),
('2','13','3',NULL),
('2','14','3',NULL),
('2','15','3',NULL),
('2','16','3',NULL),
('2','17','2',NULL),
('2','18','3',NULL),
('2','19','2',NULL),
('2','20','3',NULL),
('2','21','3',NULL),
('2','22','3',NULL),
('2','25','3',NULL),
('2','26','3',NULL),
('2','51','3',NULL),
('2','4','1',NULL),
('2','5','2',NULL),
('2','6','3',NULL),
('2','7','3',NULL),
('2','8','3',NULL),
('2','23','3',NULL),
('2','24','3',NULL);-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_classes --
INSERT INTO `xh_classes` VALUES
('1','201601','2016级计算机1班','jsj02','2016-2017-1','计算机平面设计'),
('2','201602','2016级计算机2班','jsj03','2016-2017-1','计算机平面设计'),
('3','201603','2016级电子商务班','jsj05','2016-2017-1','电子商务');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_course --
INSERT INTO `xh_course` VALUES
('1','计算机应用基础','计算机平面设计'),
('2','商品E化','电子商务'),
('3','淘宝美工','电子商务'),
('4','专业实训','计算机平面设计');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_link --
INSERT INTO `xh_link` VALUES
('6','泾川职中','http://www.jczyxx.com/','58fd748709144.png','0');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_news --
INSERT INTO `xh_news` VALUES
('9','关于实训课上机实训说明','<p>&nbsp; &nbsp;请各位同学在今后的实训课上课前打开本系统（网址：<a href=\"http://192.168.1.100/xsgl/\" _src=\"http://192.168.1.100/xsgl/\" style=\"white-space: normal;\">http://192.168.1.100/xsgl/</a>&nbsp;用户名为学号，密码默认为123456），进入“实训作业管理”，找到本节课的实训任务，进行实训任务要求查看和素材下载。在实训作业完成后，请先压缩成zip格式的文件进行上传，接着对本次实训进行自我评价，最后提交作业完成本次实训！</p>','1','xiaohan','1494378864',NULL);-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_node --
INSERT INTO `xh_node` VALUES
('1','Admin','后台模块','1',NULL,'1','0','1'),
('2','Teacher','教师模块','1',NULL,'2','0','1'),
('3','Student','学生模块','1',NULL,'3','0','1'),
('4','Index','登录模块','1',NULL,'4','0','1'),
('5','Index','登录的默认控制','1',NULL,'1','4','2'),
('6','index','登录视图','1',NULL,'1','5','3'),
('7','login','登录验证','1',NULL,'1','5','3'),
('8','fpass','密码重置','1',NULL,'1','5','3'),
('9','Index','登录后的默认控制','1',NULL,'1','3','2'),
('10','index','登录后的默认框架','1',NULL,'1','9','3'),
('11','welcome','登录后的欢迎页面','1',NULL,'1','9','3'),
('12','Login','登录控制','1',NULL,'1','3','2'),
('13','index','登录视图','1',NULL,'1','12','3'),
('14','login','登录处理','1',NULL,'1','12','3'),
('15','verify','显示验证码','1',NULL,'1','12','3'),
('16','logout','退出登录','1',NULL,'1','12','3'),
('17','Userinfor','个人信息控制','1',NULL,'1','3','2'),
('18','editUserpass','修改密码','1',NULL,'1','17','3'),
('19','Excise','实训作业控制','1',NULL,'1','3','2'),
('20','sxsubexciseList','实训作业列表','1',NULL,'1','19','3'),
('21','sxsubexciseDo','实训作业提交','1',NULL,'1','19','3'),
('22','sxsubexciseRedo','实训作业重做','1',NULL,'1','19','3'),
('23','sxpubexciseDownAttac','实训素材下载','1',NULL,'1','5','3'),
('24','sxsubexciseDownAttac','作业附件下载(评价时使用)','1',NULL,'1','5','3'),
('25','sxexciseDiscuss','评论列表','1',NULL,'1','19','3'),
('26','sxexciseDiscussSave','评论添加','1',NULL,'1','19','3'),
('27','Index','登录后的默认控制','1',NULL,'1','2','2'),
('28','index','登录后的默认框架','1',NULL,'1','27','3'),
('29','welcome','登录后的欢迎页面','1',NULL,'1','27','3'),
('31','Login','登录控制','1',NULL,'1','2','2'),
('32','index','登录视图','1',NULL,'1','31','3'),
('33','login','登录处理','1',NULL,'1','31','3'),
('34','verify','显示验证码','1',NULL,'1','31','3'),
('35','logout','退出登录','1',NULL,'1','31','3'),
('36','Userinfor','个人信息控制','1',NULL,'1','2','2'),
('37','editUserpass','修改密码','1',NULL,'1','36','3'),
('38','News','消息管理','1',NULL,'1','2','2'),
('39','news','消息列表','1',NULL,'1','38','3'),
('40','addNews','添加消息','1',NULL,'1','38','3'),
('41','detailNews','消息详情','1',NULL,'1','38','3'),
('42','delNews','删除消息','1',NULL,'1','38','3'),
('43','Excise','实训作业管理','1',NULL,'1','2','2'),
('44','courseTable','课程表','1',NULL,'1','43','3'),
('45','coursetableSave','添加课程表','1',NULL,'1','43','3'),
('46','sxcoursePackage','课程所有资料下载','1',NULL,'1','43','3'),
('47','delcourseTable','删除课程表','1',NULL,'1','43','3'),
('48','sxpubexciseList','实训任务列表','1',NULL,'1','43','3'),
('50','sxpubexciseSave','添加实训任务','1',NULL,'1','43','3'),
('51','sxpubexciseStatus','发布或撤销发布任务','1',NULL,'1','19','3'),
('52','sxpubexciseDel','删除实训任务','1',NULL,'1','43','3'),
('53','sxexcisePackage','本次实训下载(任务和作业附件)','1',NULL,'1','43','3'),
('54','sxsubexciseList','学生完成列表','1',NULL,'1','43','3'),
('55','sxsubexciseTable','学生完成情况下载','1',NULL,'1','43','3'),
('56','sxexciseDiscuss','实训任务评论列表','1',NULL,'1','43','3'),
('57','sxexciseDiscussSave','发表实训任务的评论','1',NULL,'1','43','3'),
('58','sxexciseDiscussDel','删除实训任务的评论','1',NULL,'1','43','3'),
('59','sxsubexciseDownAttac','学生作业附件下载','1',NULL,'1','43','3'),
('60','sxsubexciseRedo','设置学生重做','1',NULL,'1','43','3'),
('61','Index','登录后的默认控制','1',NULL,'1','1','2'),
('62','index','默认框架页面','1',NULL,'1','61','3'),
('63',' Login','登录控制','1',NULL,'1','1','2'),
('65','index','登录视图','1',NULL,'1','63','3'),
('66','login','登录处理','1',NULL,'1','63','3'),
('67','verify','显示验证码','1',NULL,'1','63','3'),
('68','logout','退出登录','1',NULL,'1','63','3'),
('69','System','系统基本设置','1',NULL,'1','1','2'),
('70','systeminfor','系统开发环境','1',NULL,'1','69','3'),
('71','site','系统配置信息','1',NULL,'1','69','3'),
('72','verify','验证码设置','1',NULL,'1','69','3'),
('73','reset','系统重置','1',NULL,'1','69','3'),
('74','backup','数据备份与恢复','1',NULL,'1','69','3'),
('75','Rbac','系统权限管理','1',NULL,'1','1','2'),
('76','index','用户列表','1',NULL,'1','75','3'),
('77','role','角色列表','1',NULL,'1','75','3'),
('78','node','节点列表','1',NULL,'1','75','3'),
('79','sortNode','节点排序','1',NULL,'1','75','3'),
('80','addUser','添加用户','1',NULL,'1','75','3'),
('81','editUser','编辑用户','1',NULL,'1','75','3'),
('82','lock','修改用户锁定状态','1',NULL,'1','75','3'),
('83','delUser','删除用户','1',NULL,'1','75','3'),
('84','addRole','添加角色','1',NULL,'1','75','3'),
('85','editRole','编辑角色','1',NULL,'1','75','3'),
('86','delRole','删除角色','1',NULL,'1','75','3'),
('87','addNode','添加节点','1',NULL,'1','75','3'),
('88','editNode','编辑节点','1',NULL,'1','75','3'),
('89','delNode','删除节点','1',NULL,'1','75','3'),
('90','access','给角色配置权限','1',NULL,'1','75','3'),
('91','Home','系统消息管理','1',NULL,'1','1','2'),
('92','news','消息列表','1',NULL,'1','91','3'),
('93','addNews','添加消息','1',NULL,'1','91','3'),
('94','detailNews','消息详情','1',NULL,'1','91','3'),
('95','editNews','编辑消息','1',NULL,'1','91','3'),
('96','delNews','删除消息','1',NULL,'1','91','3'),
('97','Basicdata','基础数据管理','1',NULL,'1','1','2'),
('98','term','学期列表','1',NULL,'1','97','3'),
('99','saveTerm','添加和修改学期视图','1',NULL,'1','97','3'),
('100','saveTermH','添加和修改学期处理','1',NULL,'1','97','3'),
('101','delTerm','删除学期','1',NULL,'1','97','3'),
('102','office','处室列表','1',NULL,'1','97','3'),
('103','saveOffice','添加和修改处室视图','1',NULL,'1','97','3'),
('104','saveOfficeH','添加和修改处室处理','1',NULL,'1','97','3'),
('105','importOffice','批量导入处室','1',NULL,'1','97','3'),
('106','delOffice','删除处室','1',NULL,'1','97','3'),
('107','professional','专业列表','1',NULL,'1','97','3'),
('108','saveProfessional','添加和修改专业视图','1',NULL,'1','97','3'),
('109','saveProfessionalH','添加和修改专业处理','1',NULL,'1','97','3'),
('110','importProfessional','批量导入专业','1',NULL,'1','97','3'),
('111','delProfessional','删除专业','1',NULL,'1','97','3'),
('112','course','课程列表','1',NULL,'1','97','3'),
('113','saveCourse','添加和修改课程视图','1',NULL,'1','97','3'),
('114','saveCourseH','添加和修改课程处理','1',NULL,'1','97','3'),
('115','importCourse','批量导入课程','1',NULL,'1','97','3'),
('116','delCourse','删除课程','1',NULL,'1','97','3'),
('117','classes','班级列表','1',NULL,'1','97','3'),
('118','saveClasses','添加和修改班级视图','1',NULL,'1','97','3'),
('119','saveClassesH','添加和修改班级处理','1',NULL,'1','97','3'),
('120','importClasses','批量导入班级','1',NULL,'1','97','3'),
('121','delClasses','删除班级','1',NULL,'1','97','3'),
('122','teacher','教师列表','1',NULL,'1','97','3'),
('123','saveTeacher','添加和修改教师视图','1',NULL,'1','97','3'),
('124','saveTeacherH','添加和修改教师处理','1',NULL,'1','97','3'),
('125','importTeacher','批量导入教师','1',NULL,'1','97','3'),
('126','resetTeacherPass','重置教师登录密码','1',NULL,'1','97','3'),
('127','delTeacher','删除教师','1',NULL,'1','97','3'),
('128','student','学生列表','1',NULL,'1','97','3'),
('129','saveStudent','添加和修改学生视图','1',NULL,'1','97','3'),
('130','saveStudentH','添加和修改学生处理','1',NULL,'1','97','3'),
('131','importStudent','批量导入学生','1',NULL,'1','97','3'),
('132','resetStudentPass','重置学生登录密码','1',NULL,'1','97','3'),
('133','delStudent','删除学生','1',NULL,'1','97','3'),
('134','Excise','实训作业管理','1',NULL,'1','1','2'),
('135','courseTable','课程表','1',NULL,'1','134','3'),
('136','coursetableSave','添加课程表','1',NULL,'1','134','3'),
('137','sxcoursePackage','课程资源下载','1',NULL,'1','134','3'),
('138','delcourseTable','删除课程','1',NULL,'1','134','3'),
('139','sxpubexciseList','实训任务列表','1',NULL,'1','134','3'),
('140','sxpubexciseSave','添加实训任务','1',NULL,'1','134','3'),
('141','sxpubexciseStatus','设置实训任务发布状态','1',NULL,'1','134','3'),
('142','sxpubexciseDownAttac','实训任务附件下载','1',NULL,'1','134','3'),
('143','sxpubexciseDel','实训任务删除','1',NULL,'1','134','3'),
('144','sxexcisePackage','本次实训下载(任务和作业附件)','1',NULL,'1','134','3'),
('145','sxsubexciseList','学生实训完成列表','1',NULL,'1','134','3'),
('146','sxexciseDiscuss','实训任务评论列表','1',NULL,'1','134','3'),
('147','sxexciseDiscussSave','添加评论','1',NULL,'1','134','3'),
('148','sxexciseDiscussDel','删除评论','1',NULL,'1','134','3'),
('149','sxsubexciseDownAttac','学生作业附件下载','1',NULL,'1','134','3'),
('150','sxsubexciseRedo','设置学生重做','1',NULL,'1','134','3');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_office --
INSERT INTO `xh_office` VALUES
('1','计算机教研室'),
('2','职高教研室'),
('3','数英教研室'),
('4','语政教研室');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_professional --
INSERT INTO `xh_professional` VALUES
('1','计算机平面设计'),
('2','电子商务'),
('3','数控技术'),
('4','学前教育'),
('5','电子电器教研室');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_role --
INSERT INTO `xh_role` VALUES
('1','SuperManager',NULL,'1','超级管理员'),
('2','CommonManager',NULL,'1','普通管理员');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_role_user --
INSERT INTO `xh_role_user` VALUES
('1','9'),
('2','10');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_site --
INSERT INTO `xh_site` VALUES
('1','学生管理系统','基于B/S模式，采用PHP语言+Apache服务器+MySQL数据库设计开发。全面管理学校的各个方面。','学生管理系统','©版权归泾川县职业教育中心计算机教研室郭盛老师所有','','地址：泾川县城北新区新城西路  电话：0933-3308249'),
('2','简介','<p style=\"margin-top: 0px; margin-bottom: 0px; padding: 8px; font-family: Arial, Helvetica, sans-serif, 宋体; font-size: 12px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><span style=\"color: rgb(238, 19, 15); font-family: Arial, Helvetica, sans-serif, 宋体; font-weight: bold; line-height: 40px; text-align: center; font-size: 20px; background-color: rgb(255, 255, 255);\">泾川县职业教育中心简介</span><span style=\"margin: 0px; padding: 0px; line-height: 28px; color: rgb(77, 78, 83); font-size: 14px;\"></span></p><hr/><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 8px; font-family: Arial, Helvetica, sans-serif, 宋体; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"color: rgb(77, 78, 83); font-size: 14px; line-height: 28px;\">&nbsp; &nbsp; &nbsp; <strong>泾川县职业教育中心</strong>始建于1983年7月。建校以来，三迁校址，四易校名，现已成为以中等职业技术教育为主体，集高等成人教育、专业技术人员继续教育、城镇下岗职工再就业培训和农村劳动力转移培训为一体的职业教育实体，是国家级重点中等职业学校，国家中等职业教育改革发展示范学校第三批项目建设单位。</span></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 8px; list-style-type: none; -webkit-padding-start: 0px; -webkit-margin-before: 0px; -webkit-margin-after: 0px; font-family: Arial, Helvetica, sans-serif, 宋体; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; line-height: 28px; color: rgb(77, 78, 83); font-size: 14px;\">&nbsp; &nbsp; &nbsp; &nbsp;近年来，在省、市、县党委、政府和教育主管部门的正确领导、大力支持和亲切关怀下，泾川县职业教育中心认真贯彻落实党和国家教育方针，以发展职业教育为己任，坚持以服务为宗旨，以就业为导向，不断创新办学理念，大力深化教学改革，不断丰富教育内涵，努力突出办学特色，实现了职业教育的转型跨越发展。基础设施配套完备。</span></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 8px; list-style-type: none; -webkit-padding-start: 0px; -webkit-margin-before: 0px; -webkit-margin-after: 0px; font-family: Arial, Helvetica, sans-serif, 宋体; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; line-height: 28px; color: rgb(77, 78, 83); font-size: 14px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style=\"margin: 0px; padding: 0px;\">&nbsp;教学质量显著提升。</strong>学校建有教学楼、科技实验楼、学生公寓楼、实训中心、餐饮中心等。建有独立的校园网站，装备有电力拖动、维修电工、数控加工中心、CAD/CAM、PLC、数控仿真模拟等40多个高标准实训室，能满足各个专业学生实习实训及社会培训鉴定需求。</span></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 8px; list-style-type: none; -webkit-padding-start: 0px; -webkit-margin-before: 0px; -webkit-margin-after: 0px; font-family: Arial, Helvetica, sans-serif, 宋体; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; line-height: 28px; color: rgb(77, 78, 83); font-size: 14px;\">&nbsp; &nbsp; &nbsp; &nbsp;积极推行理实一体化教学模式和“做中教，做中学”的教学方式，狠抓实训教学，实行“定标、实训、考核、鉴定、竞赛”系列管理，努力培养学生实训操作技能，学生的技能鉴定合格率达到了100%，毕业生“双证”率达到98%以上。先后有400多名学生在各级技能大赛中荣获等次奖；2013年47名学生参加全省“三校生”对口高考，本科录取4人，占参考人数的8.5%，高出全省本科录取率5个百分点，专科及以上录取率达到了100%，参加各级各类征文及课堂讲赛活动获奖师生达200余人次。</span></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 8px; list-style-type: none; -webkit-padding-start: 0px; -webkit-margin-before: 0px; -webkit-margin-after: 0px; font-family: Arial, Helvetica, sans-serif, 宋体; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; line-height: 28px; color: rgb(77, 78, 83); font-size: 14px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style=\"margin: 0px; padding: 0px;\">培养模式灵活多样。</strong>学校积极开展多层次办学，不断探索职业教育发展途径，加强校际、校企合作，积极推进工学结合、半工半读、订单培养（联合办学）办学模式，联手培养高素质技能型人才。与甘肃电大、陇东学院、陕西中医学院等学校联合，开办成人高等学历教育；与大金中国投资有限公司、宁波菱茂、上海英业达集团等企业签订了校外实训基地协议，建立了企业冠名班，使学生学习有方向，就业有保障。</span></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 8px; list-style-type: none; -webkit-padding-start: 0px; -webkit-margin-before: 0px; -webkit-margin-after: 0px; font-family: Arial, Helvetica, sans-serif, 宋体; font-size: 12px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; line-height: 28px; color: rgb(77, 78, 83); font-size: 14px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style=\"margin: 0px; padding: 0px;\">就业网络四通八达。</strong>积极拓宽就业渠道，持续加大学校与企业的合作力度，与天津、上海、苏州、宁波等地的部分企业建立合作伙伴关系，初步形成了南到广东，西至兰州，北临北京，东达上海的四通八达的就业网络，毕业生就业率达97.4%，学生月收入达到了3500元以上, 实现了“招收一个学生，培养一个学生，就业一个学生，致富一个家庭”的目标。</span></p><p><span style=\"margin: 0px; padding: 0px; line-height: 28px; color: rgb(77, 78, 83); font-size: 14px;\"><strong style=\"margin: 0px; padding: 0px; color: rgb(77, 78, 83); font-family: Arial, Helvetica, sans-serif, 宋体; font-size: 14px; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;学校所在位置</strong></span></p><p style=\"text-align: center;\"><span style=\"margin: 0px; padding: 0px; line-height: 28px; color: rgb(77, 78, 83); font-size: 14px;\"><strong style=\"margin: 0px; padding: 0px; color: rgb(77, 78, 83); font-family: Arial, Helvetica, sans-serif, 宋体; font-size: 14px; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);\"><iframe class=\"ueditor_baidumap\" src=\"http://localhost/xygl/Data/Ueditor/dialogs/map/show.html#center=107.368549,35.346975&zoom=17&width=530&height=340&markers=107.37427,35.338584&markerStyles=l,A\" style=\"width: 617px; height: 414px;\" frameborder=\"0\" width=\"534\" height=\"344\"></iframe></strong></span></p>','','','',''),
('3','首页顶端显示的网站所属单位','平凉理工中等专业学校 | 泾川县职业教育中心','','','','http://www.jczyxx.com');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_student --
INSERT INTO `xh_student` VALUES
('1','160903001','于强','男','123456','2016-2017-1','201601'),
('2','160903002','仇小梅','女','123456','2016-2017-1','201601'),
('3','160903003','何丽','女','123456','2016-2017-1','201601'),
('4','160903004','刘伟莉','女','123456','2016-2017-1','201601'),
('5','160903005','刘发强','男','123456','2016-2017-1','201601'),
('6','160903006','刘宝隆','男','123456','2016-2017-1','201601'),
('7','160903008','刘薇','女','123456','2016-2017-1','201601'),
('8','160903009','口自芳','女','123456','2016-2017-1','201601'),
('9','160903010','周世英','女','123456','2016-2017-1','201601'),
('10','160903012','尚玉娇','女','123456','2016-2017-1','201601'),
('11','160903013','岳小乐','女','123456','2016-2017-1','201601'),
('12','160903014','巨喜娟','女','123456','2016-2017-1','201601'),
('13','160903015','康雅哲','女','123456','2016-2017-1','201601'),
('14','160903016','张伟','男','123456','2016-2017-1','201601'),
('15','160903017','张文军','男','123456','2016-2017-1','201601'),
('16','160903018','张淑毅','女','123456','2016-2017-1','201601'),
('17','160903019','张鸿艳','女','123456','2016-2017-1','201601'),
('18','160903020','晁娅莉','女','123456','2016-2017-1','201601'),
('19','160903021','景桐','男','123456','2016-2017-1','201601'),
('20','160903022','曹亚龙','男','123456','2016-2017-1','201601'),
('21','160903023','朱丽娟','女','123456','2016-2017-1','201601'),
('22','160903024','朱宁宁','男','123456','2016-2017-1','201601'),
('23','160903025','朱海燕','女','123456','2016-2017-1','201601'),
('24','160903026','李小满','女','123456','2016-2017-1','201601'),
('25','160903028','樊龙','男','123456','2016-2017-1','201601'),
('26','160903029','温欢','男','123456','2016-2017-1','201601'),
('27','160903030','王丹','女','123456','2016-2017-1','201601'),
('28','160903031','王丽娜','女','123456','2016-2017-1','201601'),
('29','160903033','王春凤','女','123456','2016-2017-1','201601'),
('30','160903034','王雪','女','123456','2016-2017-1','201601'),
('31','160903036','王鹏','男','123456','2016-2017-1','201601'),
('32','160903037','申文娜','女','123456','2016-2017-1','201601'),
('33','160903038','白小红','女','123456','2016-2017-1','201601'),
('34','160903039','白文丽','女','123456','2016-2017-1','201601'),
('35','160903040','章文佩','女','123456','2016-2017-1','201601'),
('36','160903041','章鹏杰','男','123456','2016-2017-1','201601'),
('37','160903042','胡亚军','男','123456','2016-2017-1','201601'),
('38','160903043','胡瑾毓','女','123456','2016-2017-1','201601'),
('39','160903044','脱玲玲','女','123456','2016-2017-1','201601'),
('40','160903045','薛倩','女','123456','2016-2017-1','201601'),
('41','160903046','袁丽萍','女','123456','2016-2017-1','201601'),
('42','160903048','郝晶','女','123456','2016-2017-1','201601'),
('43','160903050','鲁娇娇','女','123456','2016-2017-1','201601'),
('44','160903051','鲁金丽','女','123456','2016-2017-1','201601'),
('45','283348','陈亚萍','女','123456','2016-2017-1','201603'),
('46','171412','成飞龙','男','123456','2016-2017-1','201603'),
('47','101413','代金鑫','男','123456','2016-2017-1','201603'),
('48','242022','杜美娟','女','123456','2016-2017-1','201603'),
('49','293320','杜悦','女','123456','2016-2017-1','201603'),
('50','243827','樊金凤','女','123456','2016-2017-1','201603'),
('51','051415','樊明星','男','123456','2016-2017-1','201603'),
('52','243843','樊玉凤','女','123456','2016-2017-1','201603'),
('53','14204X','高娅妮','女','123456','2016-2017-1','201603'),
('54','210620','康蕾','女','123456','2016-2017-1','201603'),
('55','212016','口文华','男','123456','2016-2017-1','201603'),
('56','153818','雷鑫','男','123456','2016-2017-1','201603'),
('57','022628','李春艳','女','123456','2016-2017-1','201603'),
('58','022025','李雪','女','123456','2016-2017-1','201603'),
('59','061433','李永强','男','123456','2016-2017-1','201603'),
('60','253323','力文慧','女','123456','2016-2017-1','201603'),
('61','134125','刘兰','女','123456','2016-2017-1','201603'),
('62','164923','吕花婷','女','123456','2016-2017-1','201603'),
('63','142038','吕勇涛','男','123456','2016-2017-1','201603'),
('64','212028','马海娟','女','123456','2016-2017-1','201603'),
('65','183840','毛敏娟','女','123456','2016-2017-1','201603'),
('66','243821','宁璐','女','123456','2016-2017-1','201603'),
('67','193322','史玲玲','女','123456','2016-2017-1','201603'),
('68','084929','史肖肖','女','123456','2016-2017-1','201603'),
('69','041437','王博','男','123456','2016-2017-1','201603'),
('70','071026','王丹','女','123456','2016-2017-1','201603'),
('71','204929','王娟','女','123456','2016-2017-1','201603'),
('72','294923','王靓','女','123456','2016-2017-1','201603'),
('73','043321','王苗苗','女','123456','2016-2017-1','201603'),
('74','051418','王宁','男','123456','2016-2017-1','201603'),
('75','153824','王瑢','女','123456','2016-2017-1','201603'),
('76','061026','王雅楠','女','123456','2016-2017-1','201603'),
('77','110617','魏浩强','男','123456','2016-2017-1','201603'),
('78','060623','魏雅雯','女','123456','2016-2017-1','201603'),
('79','172015','席文涛','男','123456','2016-2017-1','201603'),
('80','221410','许永新','男','123456','2016-2017-1','201603'),
('81','014141','闫婷婷','女','123456','2016-2017-1','201603'),
('82','264422','姚芸','女','123456','2016-2017-1','201603'),
('83','153324','袁敏','女','123456','2016-2017-1','201603'),
('84','30061X','张健楠','男','123456','2016-2017-1','201603'),
('85','02142X','张小娟','女','123456','2016-2017-1','201603'),
('86','014660','张瑜','女','123456','2016-2017-1','201603'),
('87','050612','张玉宏','男','123456','2016-2017-1','201603'),
('88','125220','章彤彤','女','123456','2016-2017-1','201603'),
('89','102068','赵苗苗','女','123456','2016-2017-1','201603'),
('90','125211','赵明辉','男','123456','2016-2017-1','201603'),
('91','264420','朱玉燕','女','123456','2016-2017-1','201603'),
('92','09202X','左丽霞','女','123456','2016-2017-1','201603'),
('93','072012','赵静然','女','123456','2016-2017-1','201603'),
('94','062012','吕锴','男','123456','2016-2017-1','201603');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_sxsetcourse --
INSERT INTO `xh_sxsetcourse` VALUES
('1','jsj02','201601','计算机应用基础','2016-2017-2');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_teacher --
INSERT INTO `xh_teacher` VALUES
('3','jsj01','王永辉','男','12345678910','123456','计算机教研室'),
('2','jsj02','郭盛','男','18993312345','123456','计算机教研室'),
('4','jsj03','姚振华','男','18993312345','123456','计算机教研室'),
('5','jsj04','王喜前','男','12345678910','123456','计算机教研室'),
('6','jsj05','李永祥','男','1234578','123456','计算机教研室');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_term --
INSERT INTO `xh_term` VALUES
('1','2016-2017-1'),
('2','2016-2017-2');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_user --
INSERT INTO `xh_user` VALUES
('1','admin','21232f297a57a5a743894a0e4a801fc3','1494843214','127.0.0.1','0'),
('9','xiaohan','e10adc3949ba59abbe56e057f20f883e','1468986590','127.0.0.1','0'),
('10','zhangsan','e10adc3949ba59abbe56e057f20f883e','1478159049','127.0.0.1','0');-- <xjx> --

-- ±íµÄÊý¾Ý£ºxh_vedio --
INSERT INTO `xh_vedio` VALUES
('3','测试','<p>的四大</p>','阿斯顿 阿萨','./Public/Resourse/image/58f355521c403.png','./Public/Resourse/video/58f3555222d7c.mp4','mp4','1','1492342098','0'),
('2','测试','<p>sds</p>','sd','./Public/Resourse/image/58ec862fdc417.png','./Public/Resourse/video/58ec862fdcbe7.mp4','mp4','1','1491895855','0');-- <xjx> --

