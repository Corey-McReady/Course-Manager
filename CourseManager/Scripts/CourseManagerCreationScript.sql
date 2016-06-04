CREATE DATABASE `course_manager` /*!40100 DEFAULT CHARACTER SET utf8 */;

CREATE TABLE `assignment` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `assignment_name` varchar(45) NOT NULL,
  `assignment_type_id` int(11) NOT NULL,
  `assignment_grade` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `assignment_type` (
  `assignment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `assignment_type` varchar(45) NOT NULL,
  `weight_percent` double NOT NULL,
  PRIMARY KEY (`assignment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(45) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE `course_lookup` (
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
