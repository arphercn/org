CREATE TABLE AjaxMailFolders (
  FolderId int(11) NOT NULL auto_increment,
  Name text NOT NULL,
  PRIMARY KEY  (FolderId)
);

INSERT INTO AjaxMailFolders VALUES (1, 'Inbox');
INSERT INTO AjaxMailFolders VALUES (2, 'Trash');
