-- ****************************************************************************
-- Filename:init.sql
-- Author:Zachary Abela-Gale
-- Date:2023/11/24
-- Purpose: Defines the roles and database for use by KeyManager
-- ****************************************************************************
CREATE ROLE "keymgr" WITH 
  NOLOGIN 
  NOINHERIT;
COMMENT ON ROLE "keymgr" IS 'Owner of any keymgr resources.';

CREATE ROLE "keymgr_readonly" WITH 
  NOLOGIN
  NOINHERIT;
COMMENT ON ROLE "keymgr_readonly" IS 'Read only role for keymgr users.';

CREATE ROLE "keymgr_readwrite" WITH
  NOLOGIN
  NOINHERIT;
COMMENT ON ROLE "keymgr_readwrite" IS 'Read/write role for keymgr users.';

CREATE DATABASE keymgr
  WITH OWNER = "keymgr" 
  ENCODING = 'UTF8' 
  CONNECTION LIMIT = -1 
  IS_TEMPLATE = False;