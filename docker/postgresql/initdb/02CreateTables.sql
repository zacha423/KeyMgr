-- -----------------------------------------------------------------------------
-- Filename:  02CreateTables.sql
-- Authors:   Zachary Abela-Gale
-- Date:      2023/12/19
-- Purpose:   Creates all the tables for KeyMgr's DB
-- -----------------------------------------------------------------------------

-- -----------------------------------------------------------------------------
-- Tables to represent an address.
-- -----------------------------------------------------------------------------

DROP TABLE IF EXISTS "KeyMgr"."rawCountries";
CREATE TABLE "KeyMgr"."rawCountries"
(
  CountryID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  ISO_Code3 character(3) NOT NULL,
  Name text NOT NULL,
  PRIMARY KEY (CountryID)
);

ALTER TABLE IF EXISTS "KeyMgr"."rawCountries"
  OWNER to keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawStates";
CREATE TABLE "KeyMgr"."rawStates"
(
  StateID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  Abbreviation text NOT NULL,
  CountryID bigint NOT NULL,
  PRIMARY KEY (StateID),
  CONSTRAINT State_Country_FK FOREIGN KEY (CountryID)
    REFERENCES "KeyMgr"."rawCountries" (CountryID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawStates"
  OWNER to keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawCities";
CREATE TABLE "KeyMgr"."rawCities"
(
  CityID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  StateID bigint NOT NULL,
  PRIMARY KEY (CityID),
  CONSTRAINT City_State_FK FOREIGN KEY (StateID)
    REFERENCES "KeyMgr"."rawStates" (StateID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawCities"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawPostalCodes";
CREATE TABLE "KeyMgr"."rawPostalCodes"
(
  PostalCodeID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Code text NOT NULL,
  PRIMARY KEY (PostalCodeID)
);

ALTER TABLE IF EXISTS "KeyMgr"."rawPostalCodes"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawAddresses";
CREATE TABLE "KeyMgr"."rawAddresses"
(
  AddressID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  StreetAddress text NOT NULL,
  CityID bigint NOT NULL,
  PostalID bigint NOT NULL,
  PRIMARY KEY (AddressID),
  CONSTRAINT Address_City_FK FOREIGN KEY (CityID)
    REFERENCES "KeyMgr"."rawCities" (CityID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Address_Postal_FK FOREIGN KEY (PostalID)
    REFERENCES "KeyMgr"."rawPostalCodes" (PostalCodeID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawAddresses"
  OWNER TO keymgr_global;


-- -----------------------------------------------------------------------------
-- Tables to represent a door to a room in a building.
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS "KeyMgr"."rawCampuses";
CREATE TABLE "KeyMgr"."rawCampuses" (
  CampusID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  AddressID bigint NOT NULL,
  PRIMARY KEY (CampusID),
  CONSTRAINT Campuses_Address_FK FOREIGN KEY (AddressID)
    REFERENCES "KeyMgr"."rawAddresses" (AddressID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawCampuses"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawBuildings";
CREATE TABLE "KeyMgr"."rawBuildings" (
  BuildingID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  AddressID bigint NOT NULL,
  CampusID bigint NOT NULL,
  PRIMARY KEY (BuildingID),
  CONSTRAINT Buidlings_Address_FK FOREIGN KEY (AddressID)
    REFERENCES "KeyMgr"."rawAddresses" (AddressID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Buildings_Campus_FK FOREIGN KEY (CampusID)
    REFERENCES "KeyMgr"."rawCampuses" (CampusID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawBuildings"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawRooms";
CREATE TABLE "KeyMgr"."rawRooms" (
  RoomID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  RoomNumber text NOT NULL,
  Description text,
  BuildingID bigint NOT NULL,
  PRIMARY KEY (RoomID),
  CONSTRAINT Rooms_BuildingID_FK FOREIGN KEY (BuildingID)
    REFERENCES "KeyMgr"."rawBuildings" (BuildingID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawRooms"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawDoors";
CREATE TABLE "KeyMgr"."rawDoors" (
  DoorID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Description text,
  HardwareDescription text,
  RoomID bigint NOT NULL,
  PRIMARY KEY (DoorID),
  CONSTRAINT Doors_RoomID_FK FOREIGN KEY (RoomID)
    REFERENCES "KeyMgr"."rawRooms" (RoomID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawDoors"
  OWNER TO keymgr_global;

-- -----------------------------------------------------------------------------
-- Tables to represent a lock.
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS "KeyMgr"."rawKeyways";
CREATE TABLE "KeyMgr"."rawKeyways" (
  KeywayID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  PRIMARY KEY (KeywayID)
);

ALTER TABLE IF EXISTS "KeyMgr"."rawKeyways"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawManufacturers";
CREATE TABLE "KeyMgr"."rawManufacturers" (
  ManufacturerID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  PRIMARY KEY (ManufacturerID)
);

ALTER TABLE IF EXISTS "KeyMgr"."rawManufacturers" 
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawLockModels";
CREATE TABLE "KeyMgr"."rawLockModels" (
  LockModelID bigint NOT NULL GENERATED ALWAYS AS IDENTITY, 
  MACS smallint NOT NULL, 
  Name text NOT NULL, 
  ManufacturerID bigint NOT NULL, 
  PRIMARY KEY (LockModelID),
  CONSTRAINT LockModels_ManufacturerID_FK FOREIGN KEY (ManufacturerID)
    REFERENCES "KeyMgr"."rawManufacturers" (ManufacturerID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawLockModels" OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawMasterKeySystems";
CREATE TABLE "KeyMgr"."rawMasterKeySystems" (
  MKSID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  ParentMKSID bigint,
  PRIMARY KEY (MKSID),
  CONSTRAINT MasterKeySystem_ParentMKSID_FK FOREIGN KEY (ParentMKSID)
    REFERENCES "KeyMgr"."rawMasterKeySystems" (MKSID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawMasterKeySystems" 
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawMessageTemplates";
CREATE TABLE "KeyMgr"."rawMessageTemplates" (
  TemplateID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  Message text NOT NULL,
  PRIMARY KEY (TemplateID)
);

ALTER TABLE IF EXISTS "KeyMgr"."rawMessageTemplates"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawLocks";
CREATE TABLE "KeyMgr"."rawLocks" (
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
    REFERENCES "KeyMgr"."rawKeyways" (KeywayID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Locks_LockModelID_FK FOREIGN KEY (LockModelID)
    REFERENCES "KeyMgr"."rawLockModels" (LockModelID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Locks_MKSID_FK FOREIGN KEY (MasterKeySystemID)
    REFERENCES "KeyMgr"."rawMasterKeySystems" (MKSID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Locks_DoorID_FK FOREIGN KEY (DoorID)
    REFERENCES "KeyMgr"."rawDoors" (DoorID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawLocks"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawLockMessages";
CREATE TABLE "KeyMgr"."rawLockMessages" (
  LockID bigint NOT NULL,
  MessageID bigint NOT NULL,
  MaintenanceDate date NOT NULL,
  PRIMARY KEY (LockID, MessageID),
  CONSTRAINT LockMessages_LockID_FK FOREIGN KEY (LocKID)
    REFERENCES "KeyMgr"."rawLocks" (LockID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT LocKMessages_MessageID_FK FOREIGN KEY (MessageID)
    REFERENCES "KeyMgr"."rawMessageTemplates" (TemplateID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawLockMessages" 
  OWNER TO keymgr_global;

-- -----------------------------------------------------------------------------
-- Tables to represent a Person
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS "KeyMgr"."rawUserRoles";
CREATE TABLE "KeyMgr"."rawUserRoles" (
  RoleID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  PRIMARY KEY (RoleID)
);

ALTER TABLE IF EXISTS "KeyMgr"."rawUserRoles"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawPersonGroups";
CREATE TABLE "KeyMgr"."rawPersonGroups" (
  PersonGroupID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  ParentGroupID bigint,
  PRIMARY KEY (PersonGroupID),
  CONSTRAINT PersonGroups_ParentGroupID_FK FOREIGN KEY (ParentGroupID)
    REFERENCES "KeyMgr"."rawPersonGroups" (PersonGroupID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawPersonGroups"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawPersons";
CREATE TABLE "KeyMgr"."rawPersons" (
  PersonID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Username text NOT NULL,
  FirstName text NOT NULL,
  LastName text NOT NULL,
  Email text NOT NULL,
  Password text NOT NULL,
  PRIMARY KEY (PersonID)
);

ALTER TABLE IF EXISTS "KeyMgr"."rawPersons"
  OWNER TO keymgr_global;


DROP TABLE IF EXISTS "KeyMgr"."rawPersonGroupMemberships"; 
CREATE TABLE "KeyMgr"."rawPersonGroupMemberships" (
  PersonID bigint NOT NULL,
  GroupID bigint NOT NULL,
  PRIMARY KEY (PersonID, GroupID),
  CONSTRAINT PersonGroupMemberships_PersonID_FK FOREIGN KEY (PersonID)
    REFERENCES "KeyMgr"."rawPersons" (PersonID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT PersonGroupMemberships_GroupID_FK FOREIGN KEY (GroupID)
    REFERENCES "KeyMgr"."rawPersonGroups" (PersonGroupID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawPersonGroupMemberships"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawPersonRoleMemberships";
CREATE TABLE "KeyMgr"."rawPersonRoleMemberships" (
  PersonID bigint NOT NULL,
  RoleID bigint NOT NULL,
  PRIMARY KEY (PersonID, RoleID),
  CONSTRAINT PersonRoleMemberships_PersonID_FK FOREIGN KEY (PersonID)
    REFERENCES "KeyMgr"."rawPersons" (PersonID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT PersonRoleMemberships_RoleID_FK FOREIGN KEY (RoleID)
    REFERENCES "KeyMgr"."rawUserRoles" (RoleID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawPersonRoleMemberships"
  OWNER TO keymgr_global;
-- -----------------------------------------------------------------------------
-- Tables to represent a key.
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS "KeyMgr"."rawKeyStorages";
CREATE TABLE "KeyMgr"."rawKeyStorages" (
  KeyStorageID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  NumRows smallint NOT NULL,
  NumCols smallint NOT NULL,
  PRIMARY KEY (KeyStorageID)
);

ALTER TABLE IF EXISTS "KeyMgr"."rawKeyStorages"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawStorageColLabels";
CREATE TABLE "KeyMgr"."rawStorageColLabels" (
  StorageID bigint NOT NULL,
  ColNumber bigint NOT NULL,
  Label text NOT NULL,
  PRIMARY KEY (StorageID, ColNumber),
  CONSTRAINT StorageColLabels_KeyStorageID_FK FOREIGN KEY (StorageID)
    REFERENCES "KeyMgr"."rawKeyStorages" (KeyStorageID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawStorageColLabels"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawStorageRowLabels";
CREATE TABLE "KeyMgr"."rawStorageRowLabels" (
  StorageID bigint NOT NULL,
  RowNumber bigint NOT NULL,
  Label text NOT NULL,
  PRIMARY KEY (StorageID, RowNumber),
  CONSTRAINT StorageRowLabels_KeyStorageID_FK FOREIGN KEY (StorageID)
    REFERENCES "KeyMgr"."rawKeyStorages" (KeyStorageID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawStorageRowLabels"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawStorageHooks";
CREATE TABLE "KeyMgr"."rawStorageHooks" (
  HookID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  RowNum smallint NOT NULL,
  ColNum smallint NOT NULL,
  StorageID bigint NOT NULL,
  PRIMARY KEY (HookID),
  CONSTRAINT StorageHooks_KeyStoragesID_FK FOREIGN KEY (StorageID)
    REFERENCES "KeyMgr"."rawKeyStorages" (KeyStorageID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawStorageHooks"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawKeyStatus";
CREATE TABLE "KeyMgr"."rawKeyStatus" (
  StatusID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  Description text,
  PRIMARY KEY (StatusID)
);

ALTER TABLE IF EXISTS "KeyMgr"."rawKeyStatus"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawKeyType";
CREATE TABLE "KeyMgr"."rawKeyType" (
  TypeID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Name text NOT NULL,
  PRIMARY KEY (TypeID)
);

ALTER TABLE IF EXISTS "KeyMgr"."rawKeyType"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawKeys";
CREATE TABLE "KeyMgr"."rawKeys" (
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
    REFERENCES "KeyMgr"."rawStorageHooks" (HookID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Keys_StatusID_FK FOREIGN KEY (StatusID)
    REFERENCES "KeyMgr"."rawKeyStatus" (StatusID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Keys_KeywayID_FK FOREIGN KEY (KeywayID)
    REFERENCES "KeyMgr"."rawKeyways" (KeywayID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT Keys_MasterKeySystemID_FK FOREIGN KEY (MasterKeySystemID)
    REFERENCES "KeyMgr"."rawMasterKeySystems" (MKSID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawKeys"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawLocksOpenedByKeys";
CReATE TABLE "KeyMgr"."rawLocksOpenedByKeys" (
  KeyID bigint NOT NULL,
  LockID bigint NOT NULL,
  PRIMARY KEY (KeyID, LockID),
  CONSTRAINT LocksOpenedByKeys_KeyID_FK FOREIGN KEY (KeyID)
    REFERENCES "KeyMgr"."rawKeys" (KeyID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT LocksOpenedByKeys_LockID_FK FOREIGN KEY (LockID)
    REFERENCES "KeyMgr"."rawLocks" (LockID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawLocksOpenedByKeys"
  OWNER TO keymgr_global;

-- -----------------------------------------------------------------------------
-- Tables to represent a key authorization agreement.
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS "KeyMgr"."rawKeyAuthStatus";
CREATE TABLE "KeyMgr"."rawKeyAuthStatus" (
  StatusID bigint NOT NULL  GENERATED ALWAYS  AS IDENTITY,
  Name text NOT NULL,
  Description text,
  PRIMARY KEY (StatusID)
);

ALTER TABLE IF EXISTS "KeyMgr"."rawKeyAuthStatus"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawKeyAuthorizations";
CREATE TABLE "KeyMgr"."rawKeyAuthorizations" (
  AuthID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  Agreement text NOT NULL, -- probably needs refinement still
  StatusID bigint NOT NULL,
  KeyHolderID bigint NOT NULL,
  KeyRequestorID bigint NOT NULL,
  PRIMARY KEY (AuthID),
  CONSTRAINT KeyAuthorizations_StatusID_FK FOREIGN KEY (StatusID)
    REFERENCES "KeyMgr"."rawKeyAuthStatus" (StatusID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT KeyAuthorizations_KeyHolderID_FK FOREIGN KEY (KeyHolderID)
    REFERENCES "KeyMgr"."rawPersons" (PersonID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT KeyAuthorizations_KeyRequestorID_FK FOREIGN KEY (KeyRequestorID)
    REFERENCES "KeyMgr"."rawPersons" (PersonID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawKeyAuthorizations"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawAuthorizedKeys";
CREATE TABLE "KeyMgr"."rawAuthorizedKeys" (
  AuthID bigint NOT NULL,
  KeyID bigint NOT NULL,
  DueDate date,
  Deposit numeric (10, 4) DEFAULT 0,
  PRIMARY KEY (AuthID, KeyID),
  CONSTRAINT AuthorizedKeys_AutHID_FK FOREIGN KEY (AuthID)
    REFERENCES "KeyMgr"."rawKeyAuthorizations" (AuthID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT AuthorizedKeys_KeyID_FK FOREIGN KEY (KeyID)
    REFERENCES "KeyMgr"."rawKeys" (KeyID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawAuthorizedKeys"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawKeyHolderContacts";
CREATE TABLE "KeyMgr"."rawKeyHolderContacts" (
  AuthID bigint NOT NULL,
  PersonID bigint NOT NULL,
  PRIMARY KEY (AuthID, PersonID),
  CONSTRAINT KeyHolderContacts_AuthID_FK FOREIGN KEY (AuthID)
    REFERENCES "KeyMgr"."rawKeyAuthorizations" (AuthID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT KeyHolderContacts_PersonID_FK FOREIGN KEY (PersonID)
    REFERENCES "KeyMgr"."rawPersons" (PersonID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."rawKeyHolderContacts"
  OWNER TO keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."rawKeyAuthorizationMessages";
CREATE TABLE "KeyMgr"."rawKeyAuthorizationMessages" (
  AuthKeyMsgID bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  KeyAuthID bigint NOT NULL,
  KeyID bigint NOT NULL,
  MessageTemplateID bigint NOT NULL,
  PRIMARY KEY (AuthKeyMsgID),
  CONSTRAINT KeyAuthMsg_AuthKeyMsg_ID_FK FOREIGN KEY (KeyAuthID, KeyID)
    REFERENCES "KeyMgr"."rawAuthorizedKeys" (AuthID, KeyID) 
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
  CONSTRAINT KeyAuthMsg_MessageTemplateID_FK FOREIGN KEY (MessageTemplateID) 
    REFERENCES "KeyMgr"."rawMessageTemplates" (TemplateID) MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);  

ALTER TABLE IF EXISTS "KeyMgr"."rawKeyAuthorizationMessages"
  OWNER TO keymgr_global;