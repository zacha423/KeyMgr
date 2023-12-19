-- -----------------------------------------------------------------------------
-- Filename:  02CreateTables.sql
-- Authors:   Zachary Abela-Gale
-- Date:      2023/12/19
-- Purpose:   Creates all the tables for KeyMgr's DB
-- -----------------------------------------------------------------------------

-- -----------------------------------------------------------------------------
-- Tables to represent an address.
-- -----------------------------------------------------------------------------

-- Country
DROP TABLE IF EXISTS "KeyMgr"."Country";
CREATE TABLE "KeyMgr"."Country"
(
  CountryID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  ISO_Code3 character(3) NOT NULL,
  Name character varying(50) NOT NULL,
  PRIMARY KEY (CountryID)
);

ALTER TABLE IF EXISTS "KeyMgr"."Country"
  OWNER to keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."State";
CREATE TABLE "KeyMgr"."State"
(
  StateID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  name character varying(50) NOT NULL,
  abbreviation character varying(3) NOT NULL,
  CountryID bigint NOT NULL,
  PRIMARY KEY (StateID),
  CONSTRAINT State_Country_FK FOREIGN KEY (CountryID)
    REFERENCES "KeyMgr"."Country" (CountryID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."State"
  OWNER to keymgr_global;


-- -----------------------------------------------------------------------------
-- Tables to represent a door to a room in a building.
-- -----------------------------------------------------------------------------