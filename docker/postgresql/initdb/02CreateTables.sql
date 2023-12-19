DROP TABLE IF EXISTS "KeyMgr"."Country";
CREATE TABLE "KeyMgr"."Country"
(
  "ID" bigint NOT NULL GENERATED ALWAYS AS IDENTITY,
  iso_code3 character(3) NOT NULL,
  name character varying(50) NOT NULL,
  PRIMARY KEY ("ID")
);

ALTER TABLE IF EXISTS "KeyMgr"."Country"
  OWNER to keymgr_global;

DROP TABLE IF EXISTS "KeyMgr"."State";
CREATE TABLE "KeyMgr"."State"
(
  "ID" bigint NOT NULL,
  name character varying(50) NOT NULL,
  abbreviation character varying(3) NOT NULL,
  "FK_Country" bigint NOT NULL,
  PRIMARY KEY ("ID"),
  CONSTRAINT "FK_Country" FOREIGN KEY ("FK_Country")
    REFERENCES "KeyMgr"."Country" ("ID") MATCH FULL
    ON UPDATE NO ACTION
    ON DELETE CASCADE
);

ALTER TABLE IF EXISTS "KeyMgr"."State"
  OWNER to keymgr_global;