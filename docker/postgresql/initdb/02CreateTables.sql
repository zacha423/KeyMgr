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

DROP TABLE IF EXISTS "KeyMgr"."City";
CREATE TABLE "KeyMgr"."City"
(
  CityID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name character varying (50) NOT NULL,
  StateID bigint NOT NULL,
  PRIMARY KEY (CityID),
  CONSTRAINT City_State_FK FOREIGN KEY (StateID)
    REFERENCES "KeyMgr"."State" (StateID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."City"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."PostalCode";
CREATE TABLE "KeyMgr"."PostalCode"
(
  PostalCodeID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Code varchar(15) NOT NULL,
  PRIMARY KEY (PostalCodeID)
);

ALTER TABLE IF EXISTS "KeyMgr"."PostalCode"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."Address";
CREATE TABLE "KeyMgr"."Address"
(
  AddressID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  StreetAddress character varying (150) NOT NULL,
  CityID bigint NOT NULL,
  PostalID bigint NOT NULL,
  PRIMARY KEY (AddressID),
  CONSTRAINT Address_City_FK FOREIGN KEY (CityID)
    REFERENCES "KeyMgr"."City" (CityID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Address_Postal_FK FOREIGN KEY (PostalID)
    REFERENCES "KeyMgr"."PostalCode" (PostalCodeID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."Address"
  OWNER TO keymgr_global;
-- -----------------------------------------------------------------------------
-- Tables to represent a door to a room in a building.
-- -----------------------------------------------------------------------------