-- Marsh Hall  2043 College Way, Forest Grove, OR 97116
-- // Pacific University (Campus)  2043 College Way, Forest Grove, OR 97116
-- Price Hall 2150 Cedar Street
-- Strain Science Center 2172 Cedar Street
-- AuCoin Hall 2125 College Way FG OR 97116
-- Creighton 222 SE 8th Ave, Hillsboro, OR 97123
-- HPC2 190 SE 8th Ave, Hillsboro, OR 97123

-- -----------------------------------------------------------------------------
-- Filename:  03CreateData.sql
-- Authors:   Zachary Abela-Gale
-- Date:      2023/12/21
-- Purpose:   Generates sample Data for the database
-- -----------------------------------------------------------------------------

-- -----------------------------------------------------------------------------
-- Country Table (per ISO3166)
-- https://www.iso.org/iso-3166-country-codes.html
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."Country" (ISO_Code3, Name) VALUES 
  ('CAN', 'Canada'), 
  ('USA', 'United States of America'), 
  ('MEX', 'Mexico') ;

-- -----------------------------------------------------------------------------
-- State Table
-- -----------------------------------------------------------------------------
WITH states (Name, Abbreviation, Country) AS ( VALUES
  ('Oregon', 'OR', 'USA'),
  ('Washington', 'WA', 'USA'),
  ('California', 'CA', 'USA')
)
INSERT INTO "KeyMgr"."State" (Name, Abbreviation, CountryID)
SELECT states.Name, states.Abbreviation, CountryID
FROM "KeyMgr"."Country" JOIN states ON (states.Country = ISO_Code3);

-- -----------------------------------------------------------------------------
-- City Table
-- -----------------------------------------------------------------------------
-- Forest Grove
-- Cornelius
-- Hillsboro
-- Seatle
-- San Francisco

-- https://www.getsynth.com/docs/blog/2021/03/09/postgres-data-gen (APACHE2)
