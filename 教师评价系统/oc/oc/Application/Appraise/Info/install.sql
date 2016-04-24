-- -----------------------------
-- 表结构 `ocenter_appraise`
-- -----------------------------
CREATE TABLE IF NOT EXISTS `ocenter_appraise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` int(11) NOT NULL COMMENT '学生用户Id',
  `teacherId` int(11) NOT NULL COMMENT '教师用户Id',
  `sessionId` int(11) NOT NULL COMMENT '评价时段Id',
  `point` tinyint(4) NOT NULL COMMENT '评价分数',
  `content` varchar(255) NOT NULL COMMENT '评价内容',
  `anonymous` tinyint(4) NOT NULL COMMENT '匿名评价,0不匿名,1匿名',
  `createTime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- -----------------------------
-- 表结构 `ocenter_appraise_lesson`
-- -----------------------------
CREATE TABLE IF NOT EXISTS `ocenter_appraise_lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '课程名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- -----------------------------
-- 表结构 `ocenter_appraise_session`
-- -----------------------------
CREATE TABLE IF NOT EXISTS `ocenter_appraise_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lessonId` int(11) NOT NULL COMMENT '课程Id',
  `sTime` int(11) NOT NULL COMMENT '评价开始时间',
  `eTime` int(11) NOT NULL COMMENT '评价结束时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- -----------------------------
-- 表结构 `ocenter_appraise_student_lesson`
-- -----------------------------
CREATE TABLE IF NOT EXISTS `ocenter_appraise_student_lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '学生用户Id',
  `lessonId` int(11) NOT NULL COMMENT '课程Id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- -----------------------------
-- 表结构 `ocenter_appraise_teacher_lesson`
-- -----------------------------
CREATE TABLE IF NOT EXISTS `ocenter_appraise_teacher_lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '教师用户Id',
  `lessonId` int(11) NOT NULL COMMENT '课程Id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ocenter_appraise_lesson` (`id`, `title`) VALUES ('1', 'PHP');
INSERT INTO `ocenter_appraise_lesson` (`id`, `title`) VALUES ('2', '项目管理');
INSERT INTO `ocenter_appraise_session` (`id`, `lessonId`, `sTime`, `eTime`) VALUES ('1', '1', '1459267200', '1459440000');
INSERT INTO `ocenter_appraise_session` (`id`, `lessonId`, `sTime`, `eTime`) VALUES ('2', '2', '1459267200', '1459440000');