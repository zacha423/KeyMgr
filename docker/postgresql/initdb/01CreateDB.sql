-- -----------------------------------------------------------------------------
-- Filename:  01CreateDB.sql
-- Authors:   Zachary Abela-Gale
-- Date:      2023/12/17
-- Purpose:   Create database and roles for KeyMgr.
-- -----------------------------------------------------------------------------

-- -----------------------------------------------------------------------------
-- Create admin access
-- -----------------------------------------------------------------------------
CREATE ROLE keymgr_global WITH
	NOLOGIN     -- Only a role, not a user.
	NOSUPERUSER -- Do not need global admin.
	CREATEDB
	CREATEROLE
	INHERIT
	NOREPLICATION
	CONNECTION LIMIT -1;
COMMENT ON ROLE keymgr_global IS 'Global access to KeyMgr resources.';

CREATE ROLE keymgr_global_u WITH
	LOGIN
	NOSUPERUSER
	NOCREATEDB
	NOCREATEROLE
	INHERIT
	NOREPLICATION
	CONNECTION LIMIT -1
	PASSWORD 'xxxxxx';
GRANT keymgr_global TO keymgr_global_u WITH ADMIN OPTION;
COMMENT ON ROLE keymgr_global_u IS 'Admin user for all KeyMgr resources';

-- -----------------------------------------------------------------------------
-- Create read only access
-- -----------------------------------------------------------------------------
CREATE ROLE keymgr_readonly WITH
	NOLOGIN
	NOSUPERUSER
	NOCREATEDB
	NOCREATEROLE
	INHERIT
	NOREPLICATION
	CONNECTION LIMIT -1;
COMMENT ON ROLE keymgr_readonly IS 'Role for application users that need readonly access';

CREATE ROLE keymgr_webro_u WITH
	LOGIN
	NOSUPERUSER
	NOCREATEDB
	NOCREATEROLE
	INHERIT
	NOREPLICATION
	CONNECTION LIMIT -1
	PASSWORD 'abc123'; -- How to do shared/dynamic secret at load time?

GRANT keymgr_readonly TO keymgr_webro_u;
COMMENT ON ROLE keymgr_webro_u IS 'Read only user for web server connections.';

-- -----------------------------------------------------------------------------
-- Create read write access.
-- -----------------------------------------------------------------------------
CREATE ROLE keymgr_readwrite WITH
	NOLOGIN
	NOSUPERUSER
	NOCREATEDB
	NOCREATEROLE
	INHERIT
	NOREPLICATION
	CONNECTION LIMIT -1;
COMMENT ON ROLE keymgr_readwrite IS 'Role for application users that need readwrite access.';

CREATE ROLE keymgr_webrw_u WITH
	LOGIN
	NOSUPERUSER
	NOCREATEDB
	NOCREATEROLE
	INHERIT
	NOREPLICATION
	CONNECTION LIMIT -1
	PASSWORD 'cba321';

GRANT keymgr_readwrite TO keymgr_webrw_u;
COMMENT ON ROLE keymgr_webrw_u IS 'Read/write user for web server connections.';

-- -----------------------------------------------------------------------------
-- Create database and assign permissions
-- -----------------------------------------------------------------------------
ALTER DATABASE "KeyMgr" OWNER TO keymgr_global;

COMMENT ON DATABASE "KeyMgr"
  IS 'Data for KeyMgr application';

GRANT ALL ON DATABASE "KeyMgr" TO keymgr_global WITH GRANT OPTION;

GRANT CONNECT ON DATABASE "KeyMgr" TO keymgr_readonly;

GRANT CONNECT ON DATABASE "KeyMgr" TO keymgr_readwrite;

CREATE SCHEMA "KeyMgr"
  AUTHORIZATION keymgr_global;

GRANT ALL ON SCHEMA "KeyMgr" TO keymgr_global WITH GRANT OPTION;

GRANT USAGE ON SCHEMA "KeyMgr" TO keymgr_readonly;

GRANT USAGE ON SCHEMA "KeyMgr" TO keymgr_readwrite;

ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA "KeyMgr"
GRANT ALL ON TABLES TO keymgr_global WITH GRANT OPTION;

ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA "KeyMgr"
GRANT SELECT ON TABLES TO keymgr_readonly;

ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA "KeyMgr"
GRANT INSERT, SELECT, UPDATE, DELETE ON TABLES TO keymgr_readwrite;