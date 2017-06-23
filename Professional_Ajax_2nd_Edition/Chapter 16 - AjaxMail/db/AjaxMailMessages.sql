CREATE TABLE AjaxMailMessages (
    MessageId int(11) NOT NULL auto_increment,
    `To` text NOT NULL,
    CC text NOT NULL,
    BCC text NOT NULL,
    `From` text NOT NULL,
    Subject text NOT NULL,
    Date bigint(20) default NULL,
    Message text NOT NULL,
    HasAttachments tinyint(1) NOT NULL default '0',
    Unread tinyint(1) NOT NULL default '1',
    FolderId int(11) NOT NULL default '0',
    PRIMARY KEY  (MessageId)
);
