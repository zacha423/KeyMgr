#!/bin/sh
###############################################################################
# Filename: mkTables.sh
# Author:   Zachary Abela-Gale
# Date:     2023/11/25
# Purpose:  Add tables to the public schema for KeyMgr's database.
###############################################################################

#psql
#HEREDOC tags, write SQL...


# -- GRANT ALL PRIVILEGES ON keymgr TO keymgr; 
# -- ALTER DATABASE keymgr OWNER TO keymgr;

# -- DROP TABLE book;



# -- CREATE TABLE IF NOT EXISTS public.book (
# --   book_id character varying(10) NOT NULL,
# --   book_name character varying(50) NOT NULL,
# --   author character varying(25),
# --   publisher character varying(25),
# --   date_of_publication date,
# --   price numeric(8, 2)
# -- );