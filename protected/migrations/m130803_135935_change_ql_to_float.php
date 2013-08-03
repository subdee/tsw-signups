<?php

class m130803_135935_change_ql_to_float extends CDbMigration {
    public function up() {
        $this->execute('ALTER TABLE member RENAME TO member_old');
        $this->execute('CREATE TABLE member (
                          id                  INTEGER      NOT NULL PRIMARY KEY AUTOINCREMENT,
                          name                VARCHAR(255) NOT NULL,
                          role                INTEGER      NOT NULL,
                          real_name           VARCHAR(255),
                          forum_name          VARCHAR(255),
                          avatar              VARCHAR(255) NOT NULL,
                          main_archetype      INTEGER      NOT NULL,
                          secondary_archetype INTEGER,
                          third_archetype     INTEGER,
                          avg_weapon_ql       DECIMAL      NOT NULL,
                          avg_talisman_ql     DECIMAL      NOT NULL,
                          avg_glyph_ql        DECIMAL      NOT NULL,
                          chronicle_url       TEXT,
                          notes               TEXT
                        )');
        $this->execute('INSERT INTO member SELECT * FROM member_old');

        $this->execute('ALTER TABLE instance RENAME TO instance_old');
        $this->execute('CREATE TABLE instance (
                          id                INTEGER      NOT NULL PRIMARY KEY AUTOINCREMENT,
                          name              VARCHAR(255) NOT NULL,
                          image             VARCHAR(255) NOT NULL,
                          min_weapon_ql     DECIMAL      NOT NULL,
                          min_talisman_ql   DECIMAL      NOT NULL,
                          min_glyph_ql      DECIMAL      NOT NULL,
                          notes             TEXT
                        )');
        $this->execute('INSERT INTO instance SELECT * FROM instance_old');

        $this->dropTable('member_old');
        $this->dropTable('instance_old');

        $this->execute('UPDATE member SET avg_weapon_ql = avg_weapon_ql / 10');
        $this->execute('UPDATE member SET avg_talisman_ql = avg_talisman_ql / 10');
        $this->execute('UPDATE member SET avg_glyph_ql = avg_glyph_ql / 10');
        $this->execute('UPDATE instance SET min_weapon_ql = min_weapon_ql / 10');
        $this->execute('UPDATE instance SET min_talisman_ql = min_talisman_ql / 10');
        $this->execute('UPDATE instance SET min_glyph_ql = min_glyph_ql / 10');
    }

    public function down() {
        echo "m130803_135935_change_ql_to_float does not support migration down.\n";
        return false;
    }
}