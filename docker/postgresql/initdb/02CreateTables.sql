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
DROP TABLE IF EXISTS "KeyMgr"."Countries";
CREATE TABLE "KeyMgr"."Countries"
(
  CountryID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  ISO_Code3 character(3) NOT NULL,
  Name text NOT NULL,
  PRIMARY KEY (CountryID)
);

ALTER TABLE IF EXISTS "KeyMgr"."Countries"
  OWNER to keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."States";
CREATE TABLE "KeyMgr"."States"
(
  StateID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  Abbreviation text NOT NULL,
  CountryID bigint NOT NULL,
  PRIMARY KEY (StateID),
  CONSTRAINT State_Country_FK FOREIGN KEY (CountryID)
    REFERENCES "KeyMgr"."Countries" (CountryID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."States"
  OWNER to keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."Cities";
CREATE TABLE "KeyMgr"."Cities"
(
  CityID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  StateID bigint NOT NULL,
  PRIMARY KEY (CityID),
  CONSTRAINT City_State_FK FOREIGN KEY (StateID)
    REFERENCES "KeyMgr"."States" (StateID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."Cities"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."PostalCodes";
CREATE TABLE "KeyMgr"."PostalCodes"
(
  PostalCodeID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Code text NOT NULL,
  PRIMARY KEY (PostalCodeID)
);

ALTER TABLE IF EXISTS "KeyMgr"."PostalCodes"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."Addresses";
CREATE TABLE "KeyMgr"."Addresses"
(
  AddressID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  StreetAddress text NOT NULL,
  CityID bigint NOT NULL,
  PostalID bigint NOT NULL,
  PRIMARY KEY (AddressID),
  CONSTRAINT Address_City_FK FOREIGN KEY (CityID)
    REFERENCES "KeyMgr"."Cities" (CityID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Address_Postal_FK FOREIGN KEY (PostalID)
    REFERENCES "KeyMgr"."PostalCodes" (PostalCodeID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."Addresses"
  OWNER TO keymgr_global;


-- -----------------------------------------------------------------------------
-- Tables to represent a door to a room in a building.
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS "KeyMgr"."Campuses";
CREATE TABLE "KeyMgr"."Campuses" (
  CampusID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  AddressID bigint NOT NULL,
  PRIMARY KEY (CampusID),
  CONSTRAINT Campuses_Address_FK FOREIGN KEY (AddressID)
    REFERENCES "KeyMgr"."Addresses" (AddressID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."Campuses"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."Buildings";
CREATE TABLE "KeyMgr"."Buildings" (
  BuildingID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  AddressID bigint NOT NULL,
  CampusID bigint NOT NULL,
  PRIMARY KEY (BuildingID),
  CONSTRAINT Buidlings_Address_FK FOREIGN KEY (AddressID)
    REFERENCES "KeyMgr"."Addresses" (AddressID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Buildings_Campus_FK FOREIGN KEY (CampusID)
    REFERENCES "KeyMgr"."Campuses" (CampusID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."Buildings"
  OWNER TO keymgr_global;

-- -----------------------------------------------------------------------------
-- Tables to represent a lock.
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- Tables to represent a key.
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- Tables to represent a Person
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- Tables to represent a key authorization agreement.
-- -----------------------------------------------------------------------------