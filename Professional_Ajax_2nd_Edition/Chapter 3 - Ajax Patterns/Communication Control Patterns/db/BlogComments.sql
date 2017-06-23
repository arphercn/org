CREATE TABLE `BlogComments` (
`CommentId` INT NOT NULL AUTO_INCREMENT ,
`BlogEntryId` INT NOT NULL ,
`Name` VARCHAR( 100 ) NOT NULL ,
`Message` VARCHAR( 255 ) NOT NULL ,
`Date` DATETIME NOT NULL ,
PRIMARY KEY (`CommentId`)
) COMMENT = 'Blog Comments';
