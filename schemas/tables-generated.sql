CREATE TABLE /*_*/wsu_batchlist (
  wsubl_id INT AUTO_INCREMENT NOT NULL,
  wsubl_name VARCHAR(255) NOT NULL,
  wsubl_actor BIGINT UNSIGNED NOT NULL,
  wsubl_createdat BINARY(14) NOT NULL,
  wsubl_status VARCHAR(50) DEFAULT NULL,
  INDEX wsu_batchlist_actor (wsubl_actor),
  PRIMARY KEY(wsubl_id)
) /*$wgDBTableOptions*/;


CREATE TABLE /*_*/wsu_batch (
  wsub_id INT AUTO_INCREMENT NOT NULL,
  wsub_batch INT NOT NULL,
  wsub_input BLOB NOT NULL,
  wsub_output BLOB DEFAULT NULL,
  INDEX wsu_batch_batch (wsub_batch),
  PRIMARY KEY(wsub_id)
) /*$wgDBTableOptions*/;
