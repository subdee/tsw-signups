CREATE TABLE instance (
  id                INTEGER      NOT NULL PRIMARY KEY AUTOINCREMENT,
  name              VARCHAR(255) NOT NULL,
  image             VARCHAR(255) NOT NULL,
  min_weapon_ql     INTEGER      NOT NULL,
  min_talisman_ql   INTEGER      NOT NULL,
  min_glyph_ql      INTEGER      NOT NULL,
  notes             TEXT
);
CREATE TABLE member (
  id                  INTEGER      NOT NULL PRIMARY KEY AUTOINCREMENT,
  name                VARCHAR(255) NOT NULL,
  role                INTEGER      NOT NULL,
  real_name           VARCHAR(255),
  forum_name          VARCHAR(255),
  avatar              VARCHAR(255) NOT NULL,
  avg_weapon_ql       INTEGER      NOT NULL,
  avg_talisman_ql     INTEGER      NOT NULL,
  avg_glyph_ql        INTEGER      NOT NULL,
  chronicle_url       TEXT,
  notes               TEXT
);
CREATE TABLE loot (
  id          INTEGER      NOT NULL PRIMARY KEY AUTOINCREMENT,
  name        VARCHAR(255) NOT NULL,
  description TEXT,
  image       VARCHAR(255),
  ql          INTEGER
);
CREATE TABLE event (
  id           INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,
  start_date   DATETIME NOT NULL,
  end_date     DATETIME,
  instance_id  INTEGER  NOT NULL,
  completed_in DATETIME,
  archetypes   TEXT NOT NULL,
  notes        TEXT
);
CREATE TABLE cabal_info (
  id         INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  name       VARCHAR(255),
  faction    INTEGER,
  website    TEXT,
  social     TEXT,
  voice_chat TEXT
);
CREATE TABLE event_loot (
  event_id INTEGER NOT NULL,
  loot_id  INTEGER NOT NULL,
  PRIMARY KEY (event_id, loot_id)
);
CREATE TABLE event_member (
  event_id    INTEGER  NOT NULL,
  member_id   INTEGER  NOT NULL,
  archetype   INTEGER  NOT NULL,
  date_signed DATETIME NOT NULL,
  notes TEXT,
  PRIMARY KEY (event_id, member_id)
);