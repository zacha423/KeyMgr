-- Sample Table
DROP TABLE IF EXISTS "KeyMgr".book;
CREATE TABLE IF NOT EXISTS "KeyMgr".book (
  book_id character varying(10) NOT NULL,
  book_name character varying(50) NOT NULL,
  author character varying(25),
  publisher character varying(25),
  date_of_publication date,
  price numeric(8, 2)
);
ALTER TABLE IF EXISTS "KeyMgr".book
  OWNER to keymgr_global;