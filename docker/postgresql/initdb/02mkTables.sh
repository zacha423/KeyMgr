#!/bin/sh
###############################################################################
# Filename: 02mkTables.sh
# Author:   Zachary Abela-Gale
# Date:     2023/11/25
# Purpose:  Add tables to the public schema for KeyMgr's database.
###############################################################################
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "keymgr" <<-EOSQL
  DROP TABLE IF EXISTS book;
  CREATE TABLE IF NOT EXISTS book (
    book_id character varying(10) NOT NULL,
    book_name character varying(50) NOT NULL,
    author character varying(25),
    publisher character varying(25),
    date_of_publication date,
    price numeric(8, 2)
  );
EOSQL