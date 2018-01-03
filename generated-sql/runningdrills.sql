
BEGIN;

-----------------------------------------------------------------------
-- account
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "account" CASCADE;

CREATE TABLE "account"
(
    "account_pk" serial NOT NULL,
    "guid" VARCHAR,
    "account_name" VARCHAR,
    "account_email" VARCHAR,
    "account_password" VARCHAR,
    "is_removed" BOOLEAN DEFAULT 'f' NOT NULL,
    PRIMARY KEY ("account_pk"),
    CONSTRAINT "idx_account_email" UNIQUE ("account_email")
);

-----------------------------------------------------------------------
-- rungroup
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "rungroup" CASCADE;

CREATE TABLE "rungroup"
(
    "rungroup_pk" serial NOT NULL,
    "rungroup_name" VARCHAR,
    PRIMARY KEY ("rungroup_pk")
);

-----------------------------------------------------------------------
-- rungroup_account
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "rungroup_account" CASCADE;

CREATE TABLE "rungroup_account"
(
    "rungroup_account_pk" serial NOT NULL,
    "account_fk" INTEGER NOT NULL,
    "rungroup_fk" INTEGER NOT NULL,
    PRIMARY KEY ("rungroup_account_pk"),
    CONSTRAINT "idx_account_rungroup" UNIQUE ("account_fk","rungroup_fk")
);

-----------------------------------------------------------------------
-- session
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "session" CASCADE;

CREATE TABLE "session"
(
    "session_pk" serial NOT NULL,
    "guid" VARCHAR,
    "session_date" DATE,
    "session_name" VARCHAR,
    "session_description" VARCHAR,
    "session_description_html" VARCHAR,
    PRIMARY KEY ("session_pk")
);

-----------------------------------------------------------------------
-- drill
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "drill" CASCADE;

CREATE TABLE "drill"
(
    "drill_pk" serial NOT NULL,
    "guid" VARCHAR,
    "id" VARCHAR,
    "category_fk" INTEGER NOT NULL,
    "drill_title" VARCHAR,
    "drill_description" VARCHAR,
    "drill_description_html" VARCHAR,
    "drill_intervals" VARCHAR,
    "drill_image" VARCHAR,
    "drill_video" VARCHAR,
    PRIMARY KEY ("drill_pk")
);

-----------------------------------------------------------------------
-- session_drill
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "session_drill" CASCADE;

CREATE TABLE "session_drill"
(
    "session_drill_pk" serial NOT NULL,
    "drill_fk" INTEGER NOT NULL,
    "session_fk" INTEGER NOT NULL,
    "sort_order" INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY ("session_drill_pk")
);

-----------------------------------------------------------------------
-- session_rungroup
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "session_rungroup" CASCADE;

CREATE TABLE "session_rungroup"
(
    "session_rungroup_pk" serial NOT NULL,
    "session_fk" INTEGER NOT NULL,
    "rungroup_fk" INTEGER NOT NULL,
    "sort_order" INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY ("session_rungroup_pk")
);

-----------------------------------------------------------------------
-- category
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "category" CASCADE;

CREATE TABLE "category"
(
    "category_pk" serial NOT NULL,
    "category_name" VARCHAR,
    PRIMARY KEY ("category_pk")
);

-----------------------------------------------------------------------
-- tag
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "tag" CASCADE;

CREATE TABLE "tag"
(
    "tag_pk" serial NOT NULL,
    "tag_name" VARCHAR,
    PRIMARY KEY ("tag_pk")
);

-----------------------------------------------------------------------
-- drill_tag
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "drill_tag" CASCADE;

CREATE TABLE "drill_tag"
(
    "drill_tag_pk" serial NOT NULL,
    "tag_fk" INTEGER NOT NULL,
    "drill_fk" INTEGER NOT NULL,
    PRIMARY KEY ("drill_tag_pk")
);

ALTER TABLE "rungroup_account" ADD CONSTRAINT "rungroup_account_fk_d9d75b"
    FOREIGN KEY ("account_fk")
    REFERENCES "account" ("account_pk")
    ON DELETE CASCADE;

ALTER TABLE "rungroup_account" ADD CONSTRAINT "rungroup_account_fk_76a5a1"
    FOREIGN KEY ("rungroup_fk")
    REFERENCES "rungroup" ("rungroup_pk")
    ON DELETE CASCADE;

ALTER TABLE "drill" ADD CONSTRAINT "drill_fk_819e4c"
    FOREIGN KEY ("category_fk")
    REFERENCES "category" ("category_pk");

ALTER TABLE "session_drill" ADD CONSTRAINT "session_drill_fk_abcda9"
    FOREIGN KEY ("drill_fk")
    REFERENCES "drill" ("drill_pk")
    ON DELETE CASCADE;

ALTER TABLE "session_drill" ADD CONSTRAINT "session_drill_fk_6a0cc8"
    FOREIGN KEY ("session_fk")
    REFERENCES "session" ("session_pk")
    ON DELETE CASCADE;

ALTER TABLE "session_rungroup" ADD CONSTRAINT "session_rungroup_fk_6a0cc8"
    FOREIGN KEY ("session_fk")
    REFERENCES "session" ("session_pk")
    ON DELETE CASCADE;

ALTER TABLE "session_rungroup" ADD CONSTRAINT "session_rungroup_fk_76a5a1"
    FOREIGN KEY ("rungroup_fk")
    REFERENCES "rungroup" ("rungroup_pk")
    ON DELETE CASCADE;

ALTER TABLE "drill_tag" ADD CONSTRAINT "drill_tag_fk_dd99c5"
    FOREIGN KEY ("tag_fk")
    REFERENCES "tag" ("tag_pk")
    ON DELETE CASCADE;

ALTER TABLE "drill_tag" ADD CONSTRAINT "drill_tag_fk_abcda9"
    FOREIGN KEY ("drill_fk")
    REFERENCES "drill" ("drill_pk")
    ON DELETE CASCADE;

COMMIT;
