-- -----------------------------------------------------------------------------
-- Filename:  02CreateTables.sql
-- Authors:   Zachary Abela-Gale
-- Date:      2023/12/19
-- Purpose:   Creates all the tables for KeyMgr's DB
-- -----------------------------------------------------------------------------

-- -----------------------------------------------------------------------------
-- Tables to represent an address.
-- -----------------------------------------------------------------------------

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

DROP TABLE IF EXISTS "KeyMgr"."Rooms";
CREATE TABLE "KeyMgr"."Rooms" (
  RoomID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  RoomNumber text NOT NULL,
  Description text,
  BuildingID bigint NOT NULL,
  PRIMARY KEY (RoomID),
  CONSTRAINT Rooms_BuildingID_FK FOREIGN KEY (BuildingID)
    REFERENCES "KeyMgr"."Buildings" (BuildingID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."Rooms"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."Doors";
CREATE TABLE "KeyMgr"."Doors" (
  DoorID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Description text,
  HardwareDescription text,
  RoomID bigint NOT NULL,
  PRIMARY KEY (DoorID),
  CONSTRAINT Doors_RoomID_FK FOREIGN KEY (RoomID)
    REFERENCES "KeyMgr"."Rooms" (RoomID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."Doors"
  OWNER TO keymgr_global;

-- -----------------------------------------------------------------------------
-- Tables to represent a lock.
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS "KeyMgr"."Keyways";
CREATE TABLE "KeyMgr"."Keyways" (
  KeywayID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  PRIMARY KEY (KeywayID)
);

ALTER TABLE IF EXISTS "KeyMgr"."Keyways"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."Manufacturers";
CREATE TABLE "KeyMgr"."Manufacturers" (
  ManufacturerID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  PRIMARY KEY (ManufacturerID)
);

ALTER TABLE IF EXISTS "KeyMgr"."Manufacturers" 
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."LockModels";
CREATE TABLE "KeyMgr"."LockModels" (
  LockModelID bigint NOT NULL GENERATED ALWAYS AS IDENTITY, 
  MACS smallint NOT NULL, 
  Name text NOT NULL, 
  ManufacturerID bigint NOT NULL, 
  PRIMARY KEY (LockModelID),
  CONSTRAINT LockModels_ManufacturerID_FK FOREIGN KEY (ManufacturerID)
    REFERENCES "KeyMgr"."Manufacturers" (ManufacturerID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."LockModels" OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."MasterKeySystems";
CREATE TABLE "KeyMgr"."MasterKeySystems" (
  MKSID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  ParentMKSID bigint,
  PRIMARY KEY (MKSID),
  CONSTRAINT MasterKeySystem_ParentMKSID_FK FOREIGN KEY (ParentMKSID)
    REFERENCES "KeyMgr"."MasterKeySystems" (MKSID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."MasterKeySystems" 
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."MessageTemplates";
CREATE TABLE "KeyMgr"."MessageTemplates" (
  TemplateID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  Message text NOT NULL,
  PRIMARY KEY (TemplateID)
);

ALTER TABLE IF EXISTS "KeyMgr"."MessageTemplates"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."Locks";
CREATE TABLE "KeyMgr"."Locks" (
  LockID bigint NOT NULL  GENERATED ALWAYS AS IDENTITY,
  numPins smallint NOT NULL,
  upperPinLengths smallint[],
  masterPinLengths smallint[],
  lowerPinLengths smallint[],
  dateUpdated timestamptz NOT NULL,
  installDate date NOT NULL,
  KeywayID bigint NOT NULL,
  LockModelID bigint NOT NULL,
  MasterKeySystemID bigint,
  DoorID bigint,
  PRIMARY KEY (LockID),
  CONSTRAINT Locks_KeywayID_FK FOREIGN KEY (KeywayID)
    REFERENCES "KeyMgr"."Keyways" (KeywayID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Locks_LockModelID_FK FOREIGN KEY (LockModelID)
    REFERENCES "KeyMgr"."LockModels" (LockModelID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Locks_MKSID_FK FOREIGN KEY (MasterKeySystemID)
    REFERENCES "KeyMgr"."MasterKeySystems" (MKSID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Locks_DoorID_FK FOREIGN KEY (DoorID)
    REFERENCES "KeyMgr"."Doors" (DoorID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."Locks"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."LockMessages";
CREATE TABLE "KeyMgr"."LockMessages" (
  LockID bigint NOT NULL,
  MessageID bigint NOT NULL,
  MaintenanceDate date NOT NULL,
  PRIMARY KEY (LockID, MessageID),
  CONSTRAINT LockMessages_LockID_FK FOREIGN KEY (LocKID)
    REFERENCES "KeyMgr"."Locks" (LockID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT LocKMessages_MessageID_FK FOREIGN KEY (MessageID)
    REFERENCES "KeyMgr"."MessageTemplates" (TemplateID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."LockMessages" 
  OWNER TO keymgr_global;

-- -----------------------------------------------------------------------------
-- Tables to represent a Person
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS "KeyMgr"."UserRoles";
CREATE TABLE "KeyMgr"."UserRoles" (
  RoleID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  PRIMARY KEY (RoleID)
);

ALTER TABLE IF EXISTS "KeyMgr"."UserRoles"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."PersonGroups";
CREATE TABLE "KeyMgr"."PersonGroups" (
  PersonGroupID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  ParentGroupID bigint,
  PRIMARY KEY (PersonGroupID),
  CONSTRAINT PersonGroups_ParentGroupID_FK FOREIGN KEY (ParentGroupID)
    REFERENCES "KeyMgr"."PersonGroups" (PersonGroupID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."PersonGroups"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."Persons";
CREATE TABLE "KeyMgr"."Persons" (
  PersonID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Username text NOT NULL,
  FirstName text NOT NULL,
  LastName text NOT NULL,
  Email text NOT NULL,
  Password text NOT NULL,
  PRIMARY KEY (PersonID)
);

ALTER TABLE IF EXISTS "KeyMgr"."Persons"
  OWNER TO keymgr_global;


DROP TABLE IF EXISTS "KeyMgr"."PersonGroupMemberships"; 
CREATE TABLE "KeyMgr"."PersonGroupMemberships" (
  PersonID bigint NOT NULL,
  GroupID bigint NOT NULL,
  PRIMARY KEY (PersonID, GroupID),
  CONSTRAINT PersonGroupMemberships_PersonID_FK FOREIGN KEY (PersonID)
    REFERENCES "KeyMgr"."Persons" (PersonID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT PersonGroupMemberships_GroupID_FK FOREIGN KEY (GroupID)
    REFERENCES "KeyMgr"."PersonGroups" (PersonGroupID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."PersonGroupMemberships"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."PersonRoleMemberships";
CREATE TABLE "KeyMgr"."PersonRoleMemberships" (
  PersonID bigint NOT NULL,
  RoleID bigint NOT NULL,
  PRIMARY KEY (PersonID, RoleID),
  CONSTRAINT PersonRoleMemberships_PersonID_FK FOREIGN KEY (PersonID)
    REFERENCES "KeyMgr"."Persons" (PersonID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT PersonRoleMemberships_RoleID_FK FOREIGN KEY (RoleID)
    REFERENCES "KeyMgr"."UserRoles" (RoleID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."PersonRoleMemberships"
  OWNER TO keymgr_global;
-- -----------------------------------------------------------------------------
-- Tables to represent a key.
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS "KeyMgr"."KeyStorages";
CREATE TABLE "KeyMgr"."KeyStorages" (
  KeyStorageID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  NumRows smallint NOT NULL,
  NumCols smallint NOT NULL,
  PRIMARY KEY (KeyStorageID)
);

ALTER TABLE IF EXISTS "KeyMgr"."KeyStorages"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."StorageColLabels";
CREATE TABLE "KeyMgr"."StorageColLabels" (
  StorageID bigint NOT NULL,
  ColNumber bigint NOT NULL,
  Label text NOT NULL,
  PRIMARY KEY (StorageID, ColNumber),
  CONSTRAINT StorageColLabels_KeyStorageID_FK FOREIGN KEY (StorageID)
    REFERENCES "KeyMgr"."KeyStorages" (KeyStorageID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."StorageColLabels"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."StorageRowLabels";
CREATE TABLE "KeyMgr"."StorageRowLabels" (
  StorageID bigint NOT NULL,
  RowNumber bigint NOT NULL,
  Label text NOT NULL,
  PRIMARY KEY (StorageID, RowNumber),
  CONSTRAINT StorageRowLabels_KeyStorageID_FK FOREIGN KEY (StorageID)
    REFERENCES "KeyMgr"."KeyStorages" (KeyStorageID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."StorageRowLabels"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."StorageHooks";
CREATE TABLE "KeyMgr"."StorageHooks" (
  HookID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  RowNum smallint NOT NULL,
  ColNum smallint NOT NULL,
  StorageID bigint NOT NULL,
  PRIMARY KEY (HookID),
  CONSTRAINT StorageHooks_KeyStoragesID_FK FOREIGN KEY (StorageID)
    REFERENCES "KeyMgr"."KeyStorages" (KeyStorageID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."StorageHooks"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."KeyStatus";
CREATE TABLE "KeyMgr"."KeyStatus" (
  StatusID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  Description text,
  PRIMARY KEY (StatusID)
);

ALTER TABLE IF EXISTS "KeyMgr"."KeyStatus"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."KeyType";
CREATE TABLE "KeyMgr"."KeyType" (
  TypeID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  PRIMARY KEY (TypeID)
);

ALTER TABLE IF EXISTS "KeyMgr"."KeyType"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."Keys";
CREATE TABLE "KeyMgr"."Keys" (
  KeyID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  KeyLevel text NOT NULL,
  KeySystem text,
  CopyNumber smallint NOT NULL DEFAULT 0,
  SerialNumber text NOT NULL GENERATED ALWAYS AS (KeyLevel::text || KeySystem::text) STORED,
  Bitting smallint[],
  BlindCode text,
  MainAngles text,
  DoubleAngles text,
  ReplacementCost numeric (10, 4),
  ValidCut boolean,
  DateUpdated timestamptz,
  StorageHookID bigint NOT NULL,
  StatusID bigint NOT NULL,
  KeywayID bigint NOT NULL,
  MasterKeySystemID bigint NOT NULL,
  PRIMARY KEY (KeyID),
  CONSTRAINT Keys_StorageHookID_FK FOREIGN KEY (StorageHookID)
    REFERENCES "KeyMgr"."StorageHooks" (HookID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Keys_StatusID_FK FOREIGN KEY (StatusID)
    REFERENCES "KeyMgr"."KeyStatus" (StatusID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Keys_KeywayID_FK FOREIGN KEY (KeywayID)
    REFERENCES "KeyMgr"."Keyways" (KeywayID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Keys_MasterKeySystemID_FK FOREIGN KEY (MasterKeySystemID)
    REFERENCES "KeyMgr"."MasterKeySystems" (MKSID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."Keys"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."LocksOpenedByKeys";
CReATE TABLE "KeyMgr"."LocksOpenedByKeys" (
  KeyID bigint NOT NULL,
  LockID bigint NOT NULL,
  PRIMARY KEY (KeyID, LockID),
  CONSTRAINT LocksOpenedByKeys_KeyID_FK FOREIGN KEY (KeyID)
    REFERENCES "KeyMgr"."Keys" (KeyID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT LocksOpenedByKeys_LockID_FK FOREIGN KEY (LockID)
    REFERENCES "KeyMgr"."Locks" (LockID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."LocksOpenedByKeys"
  OWNER TO keymgr_global;

-- -----------------------------------------------------------------------------
-- Tables to represent a key authorization agreement.
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS "KeyMgr"."KeyAuthStatus";
CREATE TABLE "KeyMgr"."KeyAuthStatus" (
  StatusID bigint NOT NULL  GENERATED ALWAYS  AS IDENTITY,
  Name text NOT NULL,
  Description text,
  PRIMARY KEY (StatusID)
);

ALTER TABLE IF EXISTS "KeyMgr"."KeyAuthStatus"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."KeyAuthorizations";
CREATE TABLE "KeyMgr"."KeyAuthorizations" (
  AuthID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Agreement text NOT NULL, -- probably needs refinement still
  StatusID bigint NOT NULL,
  KeyHolderID bigint NOT NULL,
  KeyRequestorID bigint NOT NULL,
  PRIMARY KEY (AuthID),
  CONSTRAINT KeyAuthorizations_StatusID_FK FOREIGN KEY (StatusID)
    REFERENCES "KeyMgr"."KeyAuthStatus" (StatusID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT KeyAuthorizations_KeyHolderID_FK FOREIGN KEY (KeyHolderID)
    REFERENCES "KeyMgr"."Persons" (PersonID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT KeyAuthorizations_KeyRequestorID_FK FOREIGN KEY (KeyRequestorID)
    REFERENCES "KeyMgr"."Persons" (PersonID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."KeyAuthorizations"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."AuthorizedKeys";
CREATE TABLE "KeyMgr"."AuthorizedKeys" (
  AuthID bigint NOT NULL,
  KeyID bigint NOT NULL,
  DueDate date,
  Deposit numeric (10, 4) DEFAULT 0,
  PRIMARY KEY (AuthID, KeyID),
  CONSTRAINT AuthorizedKeys_AutHID_FK FOREIGN KEY (AuthID)
    REFERENCES "KeyMgr"."KeyAuthorizations" (AuthID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT AuthorizedKeys_KeyID_FK FOREIGN KEY (KeyID)
    REFERENCES "KeyMgr"."Keys" (KeyID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."AuthorizedKeys"
  OWNER TO keymgr_global;