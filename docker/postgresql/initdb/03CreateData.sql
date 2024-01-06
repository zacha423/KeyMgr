-- -----------------------------------------------------------------------------
-- Filename:  03CreateData.sql
-- Authors:   Zachary Abela-Gale
-- Date:      2023/12/21
-- Purpose:   Generates realistic sample Data for the database
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
  ('1370 N Adair St', 'Cornelius', '97113'),      -- Cornelius Public Library
  ('1355 N Barlow St', 'Cornelius', '97113')      -- Cornelius City Hall
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
  ('Hillsboro Health Professions Campus','222 SE 8th Ave'),
  ('City of Cornelius', '1355 N Barlow St')
)
INSERT INTO "KeyMgr"."Campuses" (Name, AddressID)
SELECT campuses.Name, AddressID
FROM campuses
JOIN "KeyMgr"."Addresses" ON "KeyMgr"."Addresses".StreetAddress = campuses.StreetAddress;

-- -----------------------------------------------------------------------------
-- Buildings Table
-- -----------------------------------------------------------------------------
WITH buildings (Name, StreetAddress, Campus) AS (VALUES
  ('Marsh Hall', '2043 College Way', 'Forest Grove Campus'),
  ('Price Hall', '2150 Cedar Street', 'Forest Grove Campus'),
  ('Strain Science Center', '2172 Cedar Street', 'Forest Grove Campus'),
  ('AuCoin Hall', '2125 College Way', 'Forest Grove Campus'),
  ('Creighton Hall', '222 SE 8th Ave', 'Hillsboro Health Professions Campus'),
  ('Health Professions Campus 2', '190 SE 8th Ave', 'Hillsboro Health Professions Campus'),
  ('Cornelius Public Library', '1370 N Adair St', 'City of Cornelius')
)
INSERT INTO "KeyMgr"."Buildings" (Name, AddressID, CampusID)
SELECT buildings.Name, "KeyMgr"."Addresses".AddressID, CampusID
FROM buildings
JOIN "KeyMgr"."Addresses" ON "KeyMgr"."Addresses".StreetAddress = buildings.StreetAddress
JOIN "KeyMgr"."Campuses" ON "KeyMgr"."Campuses".Name = buildings.Campus;

-- -----------------------------------------------------------------------------
-- Rooms Table
-- -----------------------------------------------------------------------------
WITH rooms (RoomNumber, Description, BuildingName) AS (VALUES
  ('LL6', 'UIS Helpdesk', 'Marsh Hall'),
  ('222', 'Computer Science Lab', 'Strain Science Center'),
  ('204', '', 'Price Hall'),
  ('204', 'Computer Lab', 'AuCoin Hall')
)
INSERT INTO "KeyMgr"."Rooms" (RoomNumber, Description, BuildingID)
SELECT rooms.RoomNumber, rooms.Description, BuildingID FROM rooms
JOIN "KeyMgr"."Buildings" ON name = BuildingName;

-- -----------------------------------------------------------------------------
-- Doors Table
-- -----------------------------------------------------------------------------
WITH doors (Description, HardwareDescription, RoomNumber, BuildingName) AS ( VALUES
  ('always locked', 'lever handle', '222', 'Strain Science Center'),
  ('solid oak door, minor damage', 'lockable lever handle', 'LL6', 'Marsh Hall'),
  ('western entry', 'crashbar interior, lever exterior', '204', 'AuCoin Hall'),
  ('eastern entry', 'crashbar interior, lever exterior', '204', 'AuCoin Hall'),
  ('test', 'lever handle', '204', 'Price Hall')
)
INSERT INTO "KeyMgr"."Doors" (Description, HardwareDescription, RoomID)
SELECT doors.Description, HardwareDescription, RoomID 
FROM doors
JOIN "KeyMgr"."Buildings" ON "KeyMgr"."Buildings".Name = doors.BuildingName
JOIN "KeyMgr"."Rooms" ON "KeyMgr"."Rooms".RoomNumber = doors.RoomNumber 
  AND "KeyMgr"."Rooms".BuildingID = "KeyMgr"."Buildings".BuildingID;

-- -----------------------------------------------------------------------------
-- Keyways Table
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."Keyways" (Name) VALUES
  ('C'),    -- Schlage
  ('L'),    -- Schlage
  ('H'),    -- Schlage
  ('J'),    -- Schlage
  ('K'),    -- Schlage
  ('C'),    -- Schlage
  ('CE'),   -- Schlage
  ('E'),    -- Schlage
  ('EF'),   -- Schlage
  ('F'),    -- Schlage
  ('FG'),   -- Schlage
  ('G'),    -- Schlage
  ('KW1'),  -- Kwikset
  ('KW10'), -- Kwikset
  ('KS');   -- Kwikset

-- -----------------------------------------------------------------------------
-- Manufacturers Table
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."Manufacturers" (Name) VALUES 
  ('Schlage'),
  ('Kwikset'),
  ('Medeco'),
  ('Arrow');

-- -----------------------------------------------------------------------------
-- LockModels Table
-- -----------------------------------------------------------------------------
-- https://cdn.shopify.com/s/files/1/0839/9519/files/MACS.pdf?v=1614759443
WITH locks (MACS, Name, MfrName) AS (VALUES 
  (7, 'Everest', 'Schlage'),
  (7, 'SecureKey', 'Schlage'),
  (5, 'Classic', 'Kwikset'),
  (5, 'Titan', 'Kwikset'),
  (5, 'Smart Key', 'Kwikset')
)
INSERT INTO "KeyMgr"."LockModels" (MACS, Name, ManufacturerID) 
SELECT locks.MACS, locks.Name, ManufacturerID 
FROM locks
JOIN "KeyMgr"."Manufacturers" ON "KeyMgr"."Manufacturers".Name = locks.MfrName;

-- -----------------------------------------------------------------------------
-- MasterKeySystems Table
-- -----------------------------------------------------------------------------
WITH parentSystems (Name) AS (VALUES
  ('Strain'),
  ('Price')
)
INSERT INTO "KeyMgr"."MasterKeySystems" (Name) SELECT * FROM parentSystems;

WITH childSystems (Name, ParentName) AS (VALUES 
  ('Computer Science', 'Strain'),
  ('Physics', 'Strain'),
  ('Math', 'Price')
)
INSERT INTO "KeyMgr"."MasterKeySystems" (Name, ParentMKSID) 
SELECT childSystems.Name, "KeyMgr"."MasterKeySystems".MKSID 
FROM childSystems 
JOIN "KeyMgr"."MasterKeySystems" ON "KeyMgr"."MasterKeySystems".Name = childSystems.ParentName;

-- -----------------------------------------------------------------------------
-- MessageTemplates Table
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."MessageTemplates" (Name, Message) VALUES
  ('Hello World','Hello World'),
  ('Due Date Reminder', 'You have a key due soon. Login for more info.'),
  ('Authorization Completed', 'New keys have been added to your account. Login for more info.');
