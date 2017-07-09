分区
// http://blog.51yip.com/mysql/1013.html
https://my.oschina.net/jasonultimate/blog/548745
分表
http://blog.51yip.com/mysql/1029.html

// 创建range分区表

use test;

CREATE TABLE IF NOT EXISTS `user` (  
   `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',  
   `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',  
   `sex` int(1) NOT NULL DEFAULT '0' COMMENT '0为男，1为女',  
   PRIMARY KEY (`id`)  
 ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1  
 PARTITION BY RANGE (id) (  
     PARTITION p0 VALUES LESS THAN (3),  
     PARTITION p1 VALUES LESS THAN (6),  
     PARTITION p2 VALUES LESS THAN (9),  
     PARTITION p3 VALUES LESS THAN (12),  
     PARTITION p4 VALUES LESS THAN MAXVALUE  
 );

//插入一些数据  
 INSERT INTO `test`.`user` (`name` ,`sex`)VALUES ('tank', '0')  
 ,('zhang',1),('ying',1),('张',1),('映',0),('test1',1),('tank2',1)  
 ,('tank1',1),('test2',1),('test3',1),('test4',1),('test5',1),('tank3',1)  
 ,('tank4',1),('tank5',1),('tank6',1),('tank7',1),('tank8',1),('tank9',1)  
 ,('tank10',1),('tank11',1),('tank12',1),('tank13',1),('tank21',1),('tank42',1);  

 
//到存放数据库表文件的地方看一下，my.cnf里面有配置，datadir后面就是  
sudo ls /var/lib/mysql/test/

//取出数据  
mysql> select count(id) as count from user;  
+-------+  
| count |  
+-------+  
|    25 |  
+-------+

