-- ****************************************************************************
-- Filename: 01init.sql
-- Author:   Zachary Abela-Gale
-- Date:     2023/11/24
-- Purpose:  Defines the roles and database for use by KeyManager
-- ****************************************************************************
-- Docker runs this script as the default 'postgres' user on the default 'postgres' database.

CREATE ROLE "keymgr" WITH 
  NOLOGIN 
  NOINHERIT;
COMMENT ON ROLE "keymgr" IS 'Owner of any keymgr resources.';

CREATE ROLE "keymgr_readonly" WITH 
  NOLOGIN;
COMMENT ON ROLE "keymgr_readonly" IS 'Read only role for keymgr users.';

CREATE ROLE "keymgr_readwrite" WITH
  NOLOGIN;
COMMENT ON ROLE "keymgr_readwrite" IS 'Read/write role for keymgr users.';

CREATE ROLE "keymgr_webro_u" WITH
  LOGIN
  NOSUPERUSER
  NOCREATEDB
  NOCREATEROLE
  PASSWORD 'abc123';
COMMENT ON ROLE "keymgr_webro_u" IS 'Read only user for web server connections.';

CREATE ROLE "keymgr_webrw_u" WITH
  LOGIN
  NOSUPERUSER
  NOCREATEDB
  NOCREATEROLE
  PASSWORD 'cba321';
COMMENT ON ROLE "keymgr_webrw_u" IS 'Read/write user for web server connections.';

CREATE DATABASE keymgr
  WITH OWNER = "keymgr" 
  ENCODING = 'UTF8' 
  CONNECTION LIMIT = -1 
  IS_TEMPLATE = False;