-- ****************************************************************************
-- Filename: 03setPermissions.sql
-- Author:   Zachary Abela-Gale
-- Date:     2023/11/25
-- Purpose:  Set permissions for the different keymgr database roles and users.
-- ****************************************************************************

-- https://dba.stackexchange.com/questions/60942/postgresql-how-to-add-a-role-that-inherits-from-another

-- Enable all keymgr roles to connect to the database
GRANT CONNECT ON DATABASE keymgr TO keymgr;
GRANT CONNECT ON DATABASE keymgr TO keymgr_readonly;
GRANT CONNECT ON DATABASE keymgr TO keymgr_readwrite;

-- https://aws.amazon.com/blogs/database/managing-postgresql-users-and-roles/

-- ****************************************************************************
-- Configure permissions for read only user.
-- ****************************************************************************
GRANT USAGE ON SCHEMA public TO keymgr_readonly;
GRANT SELECT ON ALL TABLES IN SCHEMA public TO keymgr_readonly;

-- presets the above grant for any future tables
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT SELECT ON TABLES TO keymgr_readonly;


-- ****************************************************************************
-- Configure permissions for read and write user.
-- ****************************************************************************



-- ****************************************************************************
-- Assign users to roles.
-- ****************************************************************************
GRANT keymgr_readonly TO keymgr_webro_u;
GRANT keymgr_readwrite TO keymgr_webrw_u;