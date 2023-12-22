-- -----------------------------------------------------------------------------
-- Filename:  03CreateData.sql
-- Authors:   Zachary Abela-Gale
-- Date:      2023/12/21
-- Purpose:   Generates sample Data for the database
-- -----------------------------------------------------------------------------

-- -----------------------------------------------------------------------------
-- Countries Table (per ISO3166)
-- https://www.iso.org/iso-3166-country-codes.html
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."Countries" (ISO_Code3, Name) VALUES 
  ('CAN', 'Canada'), 
  ('USA', 'United States of America'), 
  ('MEX', 'Mexico');

-- -----------------------------------------------------------------------------
-- States Table
-- -----------------------------------------------------------------------------
WITH states (Name, Abbreviation, Country) AS (VALUES
  ('Oregon', 'OR', 'USA'),
  ('Washington', 'WA', 'USA'),
  ('California', 'CA', 'USA')
)
INSERT INTO "KeyMgr"."States" (Name, Abbreviation, CountryID)
SELECT states.Name, states.Abbreviation, CountryID
FROM "KeyMgr"."Countries" JOIN states ON (states.Country = ISO_Code3);

-- -----------------------------------------------------------------------------
-- Cities Table
-- -----------------------------------------------------------------------------
WITH cities (Name, StateAbbrev) AS (VALUES
  ('Forest Grove', 'OR'),
  ('Cornelius', 'OR'),
  ('Hillsboro', 'OR'),
  ('Seattle', 'WA'),
  ('San Francisco', 'CA')
)
INSERT INTO "KeyMgr"."Cities" (Name, StateID)
SELECT cities.Name, StateID 
FROM "KeyMgr"."States" JOIN cities ON cities.StateAbbrev = Abbreviation;

-- -----------------------------------------------------------------------------
-- PostalCodes Table
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."PostalCodes" (Code) VALUES
  ('97116'), 
  ('97113'),
  ('97123');

-- -----------------------------------------------------------------------------
-- Addresses Table
-- -----------------------------------------------------------------------------
WITH addresses (StreetAddress, CityName, PostalCode) AS (VALUES
  ('2043 College Way', 'Forest Grove', '97116'),  -- Marsh Hall / PacU FG Campus
  ('2150 Cedar Street', 'Forest Grove', '97116'), -- Price Hall
  ('2172 Cedar Street', 'Forest Grove', '97116'), -- Strain Science Center
  ('2125 College Way', 'Forest Grove', '97116'),  -- AuCoin Hall
  ('222 SE 8th Ave', 'Hillsboro', '97123'),       -- Creighton Hall
  ('190 SE 8th Ave', 'Hillsboro', '97123'),       -- HPC2
  ('1370 N Adair St', 'Cornelius', '97113')       -- Cornelius Public Library
)
INSERT INTO "KeyMgr"."Addresses" (StreetAddress, CityID, PostalID)
SELECT addresses.StreetAddress, CityID, PostalCodeID
FROM addresses
JOIN "KeyMgr"."PostalCodes" ON Code = addresses.PostalCode
JOIN "KeyMgr"."Cities" on Name = addresses.CityName;

-- -----------------------------------------------------------------------------
-- Campuses Table
-- -----------------------------------------------------------------------------
WITH campuses (Name, StreetAddress) AS (VALUES 
  ('Forest Grove Campus','2043 College Way'),
  ('Hillsboro Health Professions Campus','222 SE 8th Ave')
)
INSERT INTO "KeyMgr"."Campuses" (Name, AddressID)
SELECT campuses.Name, AddressID
FROM campuses
JOIN "KeyMgr"."Addresses" ON "KeyMgr"."Addresses".StreetAddress = campuses.StreetAddress;