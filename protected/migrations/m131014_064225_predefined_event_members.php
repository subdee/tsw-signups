<?php

class m131014_064225_predefined_event_members extends CDbMigration {
    public function up() {
        $this->execute('ALTER TABLE event ADD COLUMN is_private INTEGER DEFAULT 0');
    }

    public function down() {
        echo "m131014_064225_predefined_event_members does not support migration down.\n";
        return false;
    }
}