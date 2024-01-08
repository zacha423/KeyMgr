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

-- -----------------------------------------------------------------------------
-- Locks Table
-- -----------------------------------------------------------------------------
WITH locks (numPins, installDate, keyway, model, keySystem, RoomNumber) AS (VALUES
 (6, '2023-07-22'::date, 'C', 'Everest', 'Computer Science', ''),
 (6, '2023-07-23'::date, 'C', 'Everest', 'Computer Science', '222'),
 (6, '2023-07-24'::date, 'C', 'Everest', 'Strain', ''),
 (5, '2022-08-25'::date, 'KW1', 'Classic', 'Price', ''),
 (5, '2020-09-30'::date, 'KW10', 'Classic', '', '')
)
INSERT INTO "KeyMgr"."Locks" (numPins, dateUpdated, installDate, KeyWayID, LockModelID, MasterKeySystemID, DoorID)
SELECT locks.numPins, 
  (NOW() + (random() * (interval '90 days')) + '30 days'), 
  locks.installDate, 
  "KeyMgr"."Keyways".KeywayID, 
  "KeyMgr"."LockModels".LockModelID, 
  "KeyMgr"."MasterKeySystems".MKSID,
  "KeyMgr"."Doors".DoorID
FROM locks
JOIN "KeyMgr"."Keyways" ON "KeyMgr"."Keyways".Name = locks.keyway
JOIN "KeyMgr"."LockModels" ON "KeyMgr"."LockModels".Name = locks.model
LEFT OUTER JOIN "KeyMgr"."MasterKeySystems" ON "KeyMgr"."MasterKeySystems".Name = locks.keySystem
JOIN "KeyMgr"."Rooms" ON "KeyMgr"."Rooms".RoomNumber = locks.RoomNumber
JOIN "KeyMgr"."Doors" ON "KeyMgr"."Doors".RoomID = "KeyMgr"."Rooms".RoomID;

-- -----------------------------------------------------------------------------
-- Locks/MessageTemplates (LockMessages) Junction Table
-- -----------------------------------------------------------------------------
WITH locksAndTemplates (keySystemName, templateName) AS (VALUES 
  ('Computer Science', 'Hello World'),
  ('Strain', 'Due Date Reminder')
)
INSERT INTO "KeyMgr"."LockMessages" (LockID, MessageID, MaintenanceDate)
SELECT "KeyMgr"."Locks".LockID, "KeyMgr"."MessageTemplates".TemplateID, (CURRENT_DATE + (random() * (interval '90 days')) + '30 days')::date
FROM locksAndTemplates
JOIN "KeyMgr"."MasterKeySystems" ON "KeyMgr"."MasterKeySystems".Name = locksAndTemplates.keySystemName
JOIN "KeyMgr"."Locks" ON "KeyMgr"."Locks".MasterKeySystemID = "KeyMgr"."MasterKeySystems".MKSID
JOIN "KeyMgr"."MessageTemplates" ON "KeyMgr"."MessageTemplates".Name = locksAndTemplates.templateName;

-- -----------------------------------------------------------------------------
-- UserRoles Table
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."UserRoles" (Name) VALUES 
  ('Key Holder'),
  ('Key Requestor'),
  ('Key Authority'),
  ('Key Issuer'),
  ('Locksmith'),
  ('Administrator');

-- -----------------------------------------------------------------------------
-- PersonGroups Table
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."PersonGroups" (Name) VALUES ('School of Natural Sciences');
WITH groups (GroupName, ParentName) AS (VALUES
  ('Computer Sciencec', 'School of Natural Sciences'),
  ('Data Science', 'School of Natural Sciences'),
  ('Mathematics', 'School of Natural Sciences'),
  ('Undergraduate Students', ''),
  ('Staff', ''),
  ('Faculty', '')
)
INSERT INTO "KeyMgr"."PersonGroups" (Name, ParentGroupID)
SELECT groups.GroupName, "KeyMgr"."PersonGroups".PersonGroupID
FROM groups
LEFT OUTER JOIN "KeyMgr"."PersonGroups" ON "KeyMgr"."PersonGroups".Name = groups.ParentName;

-- -----------------------------------------------------------------------------
-- Persons Table
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."Persons" (Username, FirstName, LastName, Email, Password) VALUES 
  ('admin', 'KeyMgr', 'Admin', 'admin@keymgr.com', 'admin123'),
  ('locksmith', 'Lock', 'Smith', 'locksmith@keymgr.com', 'locksmith123'),
  ('issuer', 'Key', 'Issuer', 'KeyIssuer@keymgr.com', 'keyissuer123'),
  
  ('authority', 'Department', 'Assistant', 'depassist@keymgr.com', 'Spring2024!'),
  ('requestor', 'Prof', 'CompSci', 'prof@keymgr.com', 'Spring2024!'),
  ('holder', 'Student', 'CompSci', 'student@keymgr.com', 'Spring2024!');

-- -----------------------------------------------------------------------------
-- Person/PersonGroups (PersonGroupMemberships) Table
-- -----------------------------------------------------------------------------
WITH usersAndGroups (Username, GroupName) AS (VALUES
  ('authority', 'School of Natural Sciences'),
  ('authority', 'Staff'),
  ('requestor', 'Computer Science'),
  ('requestor', 'Faculty'),
  ('holder', 'Computer Science'),
  ('holder', 'Undergraduate Students')  
)
INSERT INTO "KeyMgr"."PersonGroupMemberships" (PersonID, GroupID)
Select "KeyMgr"."Persons".PersonID, "KeyMgr"."PersonGroups".PersonGroupID
FROM usersAndGroups
JOIN "KeyMgr"."Persons" ON "KeyMgr"."Persons".Username = usersAndGroups.Username
JOIN "KeyMgr"."PersonGroups" ON "KeyMgr"."PersonGroups".Name = usersAndGroups.GroupName;

-- -----------------------------------------------------------------------------
-- Users/Roles (PersonRoleMemberships)
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."PersonRoleMemberships" (PersonID, RoleID)
SELECT "KeyMgr"."Persons".PersonID, "KeyMgr"."UserRoles".RoleID 
FROM "KeyMgr"."Persons" 
JOIN "KeyMgr"."UserRoles" ON "KeyMgr"."UserRoles".Name = 'Key Holder';

WITH requestors (Name) AS (VALUES
  ('authority'), ('requestor'), ('locksmith'), ('issuer')
)
INSERT INTO "KeyMgr"."PersonRoleMemberships" (PersonID, RoleID)
SELECT "KeyMgr"."Persons".PersonID, "KeyMgr"."UserRoles".RoleID 
FROM requestors 
JOIN "KeyMgr"."Persons" ON "KeyMgr"."Persons".Username = requestors.Name 
JOIN "KeyMgr"."UserRoles" ON "KeyMgr"."UserRoles".Name = 'Key Requestor';

WITH authorities (Name) AS (VALUES
  ('authority'), ('issuer'), ('locksmith')
)
INSERT INTO "KeyMgr"."PersonRoleMemberships" (PersonID, RoleID)
SELECT "KeyMgr"."Persons".PersonID, "KeyMgr"."UserRoles".RoleID
FROM authorities
JOIN "KeyMgr"."Persons" ON "KeyMgr"."Persons".Username = authorities.Name
JOIN "KeyMgr"."UserRoles" ON "KeyMgr"."UserRoles".Name = 'Key Authority';

WITH issuers (Name) AS (VALUES
  ('issuer')
)
INSERT INTO "KeyMgr"."PersonRoleMemberships" (PersonID, RoleID)
SELECT "KeyMgr"."Persons".PersonID, "KeyMgr"."UserRoles".RoleID
FROM issuers
JOIN "KeyMgr"."Persons" ON "KeyMgr"."Persons".Username = issuers.Name 
JOIN "KeyMgr"."UserRoles" ON "KeyMgr"."UserRoles".Name = 'Key Issuer';

WITH locksmiths (Name) AS (VALUES
  ('locksmith')
)
INSERT INTO "KeyMgr"."PersonRoleMemberships" (PersonID, RoleID)
SELECT "KeyMgr"."Persons".PersonID, "KeyMgr"."UserRoles".RoleID 
FROM locksmiths 
JOIN "KeyMgr"."Persons" ON "KeyMgr"."Persons".Username = locksmiths.Name 
JOIN "KeyMgr"."UserRoles" ON "KeyMgr"."UserRoles".Name = 'Locksmith';

-- -----------------------------------------------------------------------------
-- KeyStorages Table
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."KeyStorages" (Name, NumRows, NumCols) VALUES ('Cabinet A', 2, 3);

-- -----------------------------------------------------------------------------
-- StorageColLabels Table
-- -----------------------------------------------------------------------------
WITH colLabels (cabinetName, col, label) AS (VALUES
  ('Cabinet A', 1, '1'),
  ('Cabinet A', 2, '2'),
  ('Cabinet A', 3, '3')
)
INSERT INTO "KeyMgr"."StorageColLabels" (StorageID, ColNumber, Label)
SELECT "KeyMgr"."KeyStorages".KeyStorageID, colLabels.col, colLabels.label
FROM colLabels
JOIN "KeyMgr"."KeyStorages" ON "KeyMgr"."KeyStorages".Name = colLabels.cabinetName;

-- -----------------------------------------------------------------------------
-- StorageRowLabels Table
-- -----------------------------------------------------------------------------
WITH rowLabels (cabinetName, row, label) AS (VALUES
  ('Cabinet A', 1, 'A'),
  ('Cabinet A', 2, 'B')
)
INSERT INTO "KeyMgr"."StorageRowLabels" (StorageID, RowNumber, Label)
SELECT "KeyMgr"."KeyStorages".KeyStorageID, rowLabels.row, rowLabels.label
FROM rowLabels
JOIN "KeyMgr"."KeyStorages" ON "KeyMgr"."KeyStorages".Name = rowLabels.cabinetName;

-- -----------------------------------------------------------------------------
-- StorageHooks Table
-- -----------------------------------------------------------------------------
WITH hooks (cabinetName, row, col) AS (VALUES
  ('Cabinet A', 1, 1),
  ('Cabinet A', 1, 2),
  ('Cabinet A', 1, 3),
  ('Cabinet A', 2, 1),
  ('Cabinet A', 2, 2),
  ('Cabinet A', 2, 3)
)
INSERT INTO "KeyMgr"."StorageHooks" (StorageID, RowNum, ColNum)
SELECT "KeyMgr"."KeyStorages".KeyStorageID, hooks.row, hooks.col
FROM hooks
JOIN "KeyMgr"."KeyStorages" ON "KeyMgr"."KeyStorages".Name = hooks.cabinetName;

-- -----------------------------------------------------------------------------
-- KeyStatus Table
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."KeyStatus" (Name, Description) VALUES
  ('Lost', 'Key is lost'),
  ('In', ''),
  ('Out', ''),
  ('Damaged', ''),
  ('Missing', '');

-- -----------------------------------------------------------------------------
-- KeyType Table
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."KeyType" (Name) VALUES 
  ('Change Key'), 
  ('Master Key');

-- -----------------------------------------------------------------------------
-- Keys Table
-- -----------------------------------------------------------------------------
WITH keys (KeyLevel, KeySystem, CopyNumber, Cabinet, Row, Col, Status, Keyway, MKS) AS (VALUES
  ('ACE', '20', 16, 'Cabinet A', 1, 1, 'Out', 'KW1', 'Computer Science'),
  ('ACE', '20', 15, 'Cabinet A', 1, 1, 'Out', 'KW1', 'Computer Science'),
  ('ACC', '19', 16, 'Cabinet A', 1, 2, 'In', 'KW1', 'Computer Science'),
  ('ACE', '20', 1, 'Cabinet A', 2, 1, 'Lost', 'KW10', 'Computer Science')
)
INSERT INTO "KeyMgr"."Keys" (KeyLevel, KeySystem, CopyNumber, StorageHookID, StatusID, KeywayID, MasterKeySystemID)
SELECT keys.KeyLevel, keys.KeySystem, keys.CopyNumber, "KeyMgr"."StorageHooks".HookID, "KeyMgr"."KeyStatus".StatusID, "KeyMgr"."Keyways".KeywayID, "KeyMgr"."MasterKeySystems".MKSID 
FROM keys
JOIN "KeyMgr"."KeyStorages" ON "KeyMgr"."KeyStorages".Name = keys.Cabinet
JOIN "KeyMgr"."StorageHooks" ON "KeyMgr"."StorageHooks".StorageID = "KeyMgr"."KeyStorages".KeyStorageID 
AND "KeyMgr"."StorageHooks".RowNum = keys.Row 
AND "KeyMgr"."StorageHooks".ColNum = keys.Col
JOIN "KeyMgr"."Keyways" ON "KeyMgr"."Keyways".Name = keys.Keyway
JOIN "KeyMgr"."MasterKeySystems" ON "KeyMgr"."MasterKeySystems".Name = keys.MKS
JOIN "KeyMgr"."KeyStatus" ON "KeyMgr"."KeyStatus".Name = keys.Status;

-- -----------------------------------------------------------------------------
-- Keys/Locks (LocksOpenedByKeys) Junction Table
-- -----------------------------------------------------------------------------
WITH keys AS (SELECT * FROM "KeyMgr"."Keys" WHERE SerialNumber ='ACE20')
INSERT INTO "KeyMgr"."LocksOpenedByKeys" (KeyID, LockID)
SELECT keys.KeyID, "KeyMgr"."Locks".LockID
FROM keys
JOIN "KeyMgr"."Rooms" ON "KeyMgr"."Rooms".RoomNumber = '222'
JOIN "KeyMgr"."Doors" ON "KeyMgr"."Doors".RoomID = "KeyMgr"."Rooms".RoomID
JOIN "KeyMgr"."Locks" ON "KeyMgr"."Locks".DoorID = "KeyMgr"."Doors".DoorID;

-- -----------------------------------------------------------------------------
-- KeyAuthStatus Table
-- -----------------------------------------------------------------------------
INSERT INTO "KeyMgr"."KeyAuthStatus" (Name, Description) VALUES 
  ('Pending', ''),
  ('Active', ''),
  ('Ready for pickup', ''),
  ('Requested', 'Request has been submitted');

-- -----------------------------------------------------------------------------
-- KeyAuthorizations Table
-- -----------------------------------------------------------------------------
WITH agreements (agreement, statusName, requestorUName, holderUName) AS (VALUES
  ('yes', 'Pending', 'requestor', 'holder'),
  ('agree', 'Active', 'requestor', 'requestor'),
  ('I suppose so', 'Ready for pickup', 'authority', 'authority')
)
INSERT INTO "KeyMgr"."KeyAuthorizations" (Agreement, StatusID, KeyHolderID, KeyRequestorID)
SELECT agreements.agreement, "KeyMgr"."KeyAuthStatus".StatusID, Holders.PersonID, Requestors.PersonID
FROM agreements
JOIN "KeyMgr"."KeyAuthStatus" ON "KeyMgr"."KeyAuthStatus".Name = agreements.statusName
JOIN "KeyMgr"."Persons" Requestors ON Requestors.Username = agreements.requestorUName 
JOIN "KeyMgr"."Persons" Holders ON Holders.Username = agreements.holderUName;

-- -----------------------------------------------------------------------------
-- KeyAuthorizations/Keys (AuthorizedKeys) Junction Tables
-- -----------------------------------------------------------------------------
WITH authkeys (KeyHolder, KeySerial, KeyCopy, DueDate, Deposit) AS (VALUES 
  ('holder', 'ACE20', 16, '2024/05/18', 25.00),
  ('requestor', 'ACE20', 15, NULL, NULL),
  ('authority', 'ACC19', 16, NULL, NULL)
)
INSERT INTO "KeyMgr"."AuthorizedKeys" (AuthID, KeyID, DueDate, Deposit)
SELECT "KeyMgr"."KeyAuthorizations".AuthID, keys.KeyID, authkeys.DueDate::date, authKeys.Deposit::numeric(10,4)
FROM authkeys
JOIN "KeyMgr"."Persons" ON "KeyMgr"."Persons".Username = authkeys.KeyHolder
JOIN "KeyMgr"."KeyAuthorizations" ON "KeyMgr"."KeyAuthorizations".KeyHolderID = "KeyMgr"."Persons".PersonID
JOIN "KeyMgr"."Keys" keys ON keys.SerialNumber = authkeys.KeySerial and keys.CopyNumber = authkeys.KeyCopy;

-- -----------------------------------------------------------------------------
-- KeyAuthorizations/Persons (KeyHolderContacts) Junction Table
-- -----------------------------------------------------------------------------
WITH contacts (KeyHolder, Contact) AS (VALUES 
  ('requestor', 'authority'),
  ('holder', 'requestor'),
  ('holder', 'authority')
)
INSERT INTO "KeyMgr"."KeyHolderContacts" (AuthID, PersonID)
SELECT Auths.AuthID, People.PersonID 
FROM contacts
JOIN "KeyMgr"."Persons" Holders ON Holders.Username = contacts.KeyHolder
JOIN "KeyMgr"."Persons" People ON People.Username = contacts.Contact
JOIN "KeyMgr"."KeyAuthorizations" Auths ON Auths.KeyHolderID = Holders.PersonID;

-- -----------------------------------------------------------------------------
-- KeyAuthorizationMessages Table
-- -----------------------------------------------------------------------------
WITH AuthKeys AS (SELECT * FROM "KeyMgr"."AuthorizedKeys" AuthKey WHERE AuthKey.DueDate IS NOT NULL)
INSERT INTO "KeyMgr"."KeyAuthorizationMessages" (KeyAuthID, KeyID, MessageTemplateID)
SELECT AuthKeys.AuthID, AuthKeys.KeyID, Msg.TemplateID
FROM AuthKeys
JOIN "KeyMgr"."MessageTemplates" Msg ON Msg.Name = 'Due Date Reminder';