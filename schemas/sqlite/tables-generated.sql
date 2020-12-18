-- This file is automatically generated using maintenance/generateSchemaSql.php.
-- Source: tables.json
-- Do not modify this file directly.
-- See https://www.mediawiki.org/wiki/Manual:Schema_changes
CREATE TABLE /*_*/wsu_batchlist (
  wsubl_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  wsubl_name VARCHAR(255) NOT NULL,
  wsubl_actor BIGINT UNSIGNED NOT NULL,
  wsubl_createdat BLOB NOT NULL,
  wsubl_status VARCHAR(50) DEFAULT NULL
);

CREATE INDEX wsu_batchlist_actor ON /*_*/wsu_batchlist (wsubl_actor);


CREATE TABLE /*_*/wsu_batch (
  wsub_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  wsub_batch INTEGER NOT NULL, wsub_input BLOB NOT NULL,
  wsub_output BLOB DEFAULT NULL
);

CREATE INDEX wsu_batch_batch ON /*_*/wsu_batch (wsub_batch);
