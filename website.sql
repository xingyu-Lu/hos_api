DROP TABLE IF EXISTS `syy_admins`;
CREATE TABLE `syy_admins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员账号',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '管理员账号状态 0：禁用 1：开启',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='管理员表';

INSERT INTO `syy_admins` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, 1642750967, 1642750967);

DROP TABLE IF EXISTS `syy_rotates`;
CREATE TABLE `syy_rotates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) unsigned NOT NULL default 0 COMMENT '文件id',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否启用 0：不启用 1：启用',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `created_at` int(20) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(20) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='菜单表';

DROP TABLE IF EXISTS `syy_menus`;
CREATE TABLE `syy_menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `url` varchar(300) NOT NULL DEFAULT '' COMMENT '前端路由',
  `icon` varchar(300) NOT NULL DEFAULT '' COMMENT 'icon',
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否启用 0：不启用 1：启用',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `created_at` int(20) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(20) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='菜单表';

DROP TABLE IF EXISTS `syy_role_has_menus`;
CREATE TABLE `syy_role_has_menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '菜单id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='角色菜单表';

DROP TABLE IF EXISTS `syy_upload_files`;
CREATE TABLE `syy_upload_files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件id',
  `storage` tinyint(1) NOT NULL DEFAULT 0 COMMENT '存储方式 0：本地',
  `file_url` varchar(255) NOT NULL DEFAULT '' COMMENT '存储路径',
  `file_name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
  `file_size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小(字节)',
  `file_size_m` varchar(100) NOT NULL DEFAULT '' COMMENT '文件大小(兆)',
  `file_type` varchar(200) NOT NULL DEFAULT '' COMMENT '文件类型',
  `real_name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件真实名',
  `extension` varchar(20) NOT NULL DEFAULT '' COMMENT '文件扩展名',
  `created_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文件库记录表';

DROP TABLE IF EXISTS `syy_codes`;
CREATE TABLE `syy_codes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件id',
  `code` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '验证码',
  `release_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '发布时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 0：不可用 1：可用',
  `created_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='验证表';

DROP TABLE IF EXISTS `syy_staffs`;
CREATE TABLE `syy_staffs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `name` varchar(10) NOT NULL DEFAULT '' COMMENT '姓名',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '管理员账号状态 0：禁用 1：开启',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='员工表';

DROP TABLE IF EXISTS `syy_staff_articles`;
CREATE TABLE `syy_staff_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `staff_id` int(11) unsigned NOT NULL default 0 COMMENT '员工id',
  `content` text not null comment '文章内容',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `author` varchar(20) not null default '' comment '作者',
  `title` varchar(30) not null default '' comment '文章标题',
  `count` int(11) not null default 0 comment '浏览次数',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='员工文章表';

DROP TABLE IF EXISTS `syy_briefs`;
CREATE TABLE `syy_briefs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `content` text not null comment '文章内容',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='医院简介';

DROP TABLE IF EXISTS `syy_leaders`;
CREATE TABLE `syy_leaders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `file_id` int(11) unsigned NOT NULL default 0 COMMENT '文件id',
  `name` varchar(20) not null default '' comment '姓名',
  `position` varchar(100) NOT NULL DEFAULT '' COMMENT '职务',
  `professional` varchar(100) NOT NULL DEFAULT '' COMMENT '职称',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='领导团队';

DROP TABLE IF EXISTS `syy_leader_news`;
CREATE TABLE `syy_leader_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `content` text not null comment '内容',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='领导团队新';

DROP TABLE IF EXISTS `syy_cultures`;
CREATE TABLE `syy_cultures` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text not null comment '文章内容',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='医院文化';

DROP TABLE IF EXISTS `syy_historys`;
CREATE TABLE `syy_historys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text not null comment '内容',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='历史沿革';

DROP TABLE IF EXISTS `syy_history_leaders`;
CREATE TABLE `syy_history_leaders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) unsigned NOT NULL default 0 COMMENT '文件id',
  `name` varchar(20) not null default '' comment '姓名',
  `time` varchar(20) not null default '' comment '在任时间',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='历任院长';

DROP TABLE IF EXISTS `syy_history_pics`;
CREATE TABLE `syy_history_pics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) unsigned NOT NULL default 0 COMMENT '文件id',
  `title` varchar(20) not null default '' comment '抬头',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='历史照片';

DROP TABLE IF EXISTS `syy_organizations`;
CREATE TABLE `syy_organizations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text not null comment '内容',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='组织机构';

DROP TABLE IF EXISTS `syy_honors`;
CREATE TABLE `syy_honors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text not null comment '内容',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='医院荣誉';

DROP TABLE IF EXISTS `syy_futures`;
CREATE TABLE `syy_futures` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text not null comment '内容',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='未来展望';

DROP TABLE IF EXISTS `syy_news`;
CREATE TABLE `syy_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `file_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '新闻封面图id',
  `attachment_id` varchar(20) NOT NULL DEFAULT '' COMMENT '附件id',
  `content` text not null comment '内容',
  `release_time` int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `type` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '0: 医院新闻 1：医院公告 2：视频新闻',
  `is_recommend` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '0：非推荐 1：推荐',
  `office_article_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '科室文章id',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='新闻';

DROP TABLE IF EXISTS `syy_technical_offices`;
CREATE TABLE `syy_technical_offices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '科室地址',
  `phone` varchar(50) NOT NULL DEFAULT '' COMMENT '科室电话',
  `index` varchar(10) NOT NULL DEFAULT '' COMMENT '科室索引',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `type` tinyint(3) NOT NULL DEFAULT 0 COMMENT '类型 0：临床部门 1：医技部门 2：保障部门',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='医院科室';

DROP TABLE IF EXISTS `syy_technical_office_introduces`;
CREATE TABLE `syy_technical_office_introduces` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` int(11) unsigned NOT NULL default 0 COMMENT '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `content` text NOT NULL COMMENT '内容',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科室介绍';

DROP TABLE IF EXISTS `syy_technical_office_dynamics`;
CREATE TABLE `syy_technical_office_dynamics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` int(11) unsigned NOT NULL default 0 COMMENT '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `file_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '新闻封面图id',
  `content` text not null comment '内容',
  `release_time` int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见；2：删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科室动态';

DROP TABLE IF EXISTS `syy_technical_office_doctors`;
CREATE TABLE `syy_technical_office_doctors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '图片id',
  `office_id` int(11) unsigned NOT NULL default 0 COMMENT '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '医生名字',
  `professional` varchar(50) NOT NULL DEFAULT '' COMMENT '职称',
  `excel` varchar(500) NOT NULL DEFAULT '' COMMENT '擅长',
  `content` text NOT NULL COMMENT '医生介绍',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见；2：删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科室医生';

DROP TABLE IF EXISTS `syy_technical_office_outpatients`;
CREATE TABLE `syy_technical_office_outpatients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` int(11) unsigned NOT NULL default 0 COMMENT '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `monday` varchar(50) NOT NULL DEFAULT '' COMMENT '周一门诊医生',
  `tuesday` varchar(50) NOT NULL DEFAULT '' COMMENT '周二门诊医生',
  `wednesday` varchar(50) NOT NULL DEFAULT '' COMMENT '周三门诊医生',
  `thursday` varchar(50) NOT NULL DEFAULT '' COMMENT '周四门诊医生',
  `friday` varchar(50) NOT NULL DEFAULT '' COMMENT '周五门诊医生',
  `saturday` varchar(50) NOT NULL DEFAULT '' COMMENT '周六门诊医生',
  `sunday` varchar(50) NOT NULL DEFAULT '' COMMENT '周日门诊医生',
  `type` tinyint(10) unsigned NOT NULL DEFAULT 0 COMMENT '0:上午 1：下午',
  `yq_type` tinyint(10) unsigned NOT NULL DEFAULT 0 COMMENT '0:院本部 1：李庄院区',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见；2：删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科室门诊';

DROP TABLE IF EXISTS `syy_technical_office_outpatient_news`;
CREATE TABLE `syy_technical_office_outpatient_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `content` text not null comment '文章内容',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科室门诊新';

DROP TABLE IF EXISTS `syy_technical_office_features`;
CREATE TABLE `syy_technical_office_features` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` int(11) unsigned NOT NULL default 0 COMMENT '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `file_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '封面图id',
  `content` text not null comment '内容',
  `release_time` int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见；2：删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科室特色医疗';

DROP TABLE IF EXISTS `syy_technical_office_pics`;
CREATE TABLE `syy_technical_office_pics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` int(11) unsigned NOT NULL default 0 COMMENT '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `file_id` int(11) unsigned NOT NULL default 0 COMMENT '文件id',
  `title` varchar(20) not null default '' comment '抬头',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科室图片';

DROP TABLE IF EXISTS `syy_technical_office_health_sciences`;
CREATE TABLE `syy_technical_office_health_sciences` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` int(11) unsigned NOT NULL default 0 COMMENT '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `file_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '封面图id',
  `content` text not null comment '内容',
  `release_time` int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见；2：删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科室健康科普';

DROP TABLE IF EXISTS `syy_technical_office_members`;
CREATE TABLE `syy_technical_office_members` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` int(11) unsigned NOT NULL default 0 COMMENT '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `staff_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '员工id',
  `staff_name` varchar(50) NOT NULL DEFAULT '' COMMENT '员工姓名',
  `is_head` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '0：非负责人 1：负责人',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科室成员';

DROP TABLE IF EXISTS `syy_technical_office_column_sets`;
CREATE TABLE `syy_technical_office_column_sets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` int(11) unsigned NOT NULL default 0 COMMENT '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '0：图文或视频 1：仅图',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见；2：删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科室栏目设置';

DROP TABLE IF EXISTS `syy_technical_office_columns`;
CREATE TABLE `syy_technical_office_columns` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` int(11) unsigned NOT NULL default 0 COMMENT '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `column_id` int(11) NOT NULL DEFAULT 0 COMMENT '栏目id',
  `column_name` varchar(50) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `file_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '图片id',
  `content` text not null comment '内容',
  `release_time` int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见；2：删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科室栏目';

DROP TABLE IF EXISTS `syy_experts`;
CREATE TABLE `syy_experts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `office_id` int(11) unsigned NOT NULL default 0 COMMENT '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `file_id` int(11) unsigned NOT NULL default 0 COMMENT '文件id',
  `office_doctor_id` int(11) NOT NULL DEFAULT 0 COMMENT '科室医生id',
  `name` varchar(20) not null default '' comment '姓名',
  `position` varchar(100) NOT NULL DEFAULT '' COMMENT '职务',
  `professional` varchar(100) NOT NULL DEFAULT '' COMMENT '职称',
  `excel` varchar(500) NOT NULL DEFAULT '' COMMENT '擅长',
  `content` text NOT NULL COMMENT '医生介绍',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `index` varchar(10) NOT NULL DEFAULT 0 COMMENT '索引',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='专家介绍';

DROP TABLE IF EXISTS `syy_scientifics`;
CREATE TABLE `syy_scientifics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text not null comment '内容',
  `release_time` int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `type` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '0: 科研动态 1：学科建设 2：继续教育',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='科研教学';

DROP TABLE IF EXISTS `syy_patient_services`;
CREATE TABLE `syy_patient_services` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_column_id` int not null default 0 comment '科室栏目文章id',
  `office_id` int not null default 0 comment '科室id',
  `office_name` varchar(50) NOT NULL DEFAULT '' COMMENT '科室名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text not null comment '内容',
  `release_time` int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `type` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '0: 门诊流程 1：住院流程 2：检查须知 3：健康体检 4：医保指南 5：艾滋病预防 6：楼宇分布 7：联系我们 8:护理园地 9:健康促进',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='患者服务';

DROP TABLE IF EXISTS `syy_partys`;
CREATE TABLE `syy_partys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `file_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '封面图id',
  `content` text not null comment '内容',
  `release_time` int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `type` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '0: 党务管理 1：党员教育 2：党风廉政 3：职工之家 4：医德医风 5：青年加油站',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='党建';

DROP TABLE IF EXISTS `syy_jobs`;
CREATE TABLE `syy_jobs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attachment_id` varchar(20) NOT NULL DEFAULT '' COMMENT '附件id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text not null comment '内容',
  `release_time` int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `type` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '0: 招聘信息 1：应聘流程',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='招聘信息';

DROP TABLE IF EXISTS `syy_voice_employees`;
CREATE TABLE `syy_voice_employees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '员工id',
  `staff_name` varchar(30) NOT NULL DEFAULT '' COMMENT '员工姓名',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text not null comment '内容',
  `release_time` int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='员工之声';

DROP TABLE IF EXISTS `syy_file_employees`;
CREATE TABLE `syy_file_employees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '员工id',
  `staff_name` varchar(50) NOT NULL DEFAULT '' COMMENT '员工姓名',
  `file_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '文件id',
  `file_name` varchar(50) NOT NULL DEFAULT '' COMMENT '文件名',
  `status` tinyint(1) unsigned not null default '1' comment '0:删除；1:正常',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='员工文件(云盘)';

DROP TABLE IF EXISTS `syy_epidemic_controls`;
CREATE TABLE `syy_epidemic_controls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attachment_id` varchar(20) NOT NULL DEFAULT '' COMMENT '附件id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text not null comment '内容',
  `release_time` int(11) NOT NULL DEFAULT 0 COMMENT '发布时间',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `status` tinyint(1) unsigned not null default '0' comment '0:待审核院内可见；1:院内外都可见',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='疫情防控';