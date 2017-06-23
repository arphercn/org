CREATE TABLE AjaxMailAttachments (
  AttachmentId int(11) NOT NULL auto_increment,
  MessageId int(11) NOT NULL default '0',
  Filename text NOT NULL,
  ContentType text NOT NULL,
  Size int(11) NOT NULL default '0',
  Data longtext NOT NULL,
  PRIMARY KEY  (AttachmentId)
)
