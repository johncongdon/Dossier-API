<?php

use Phinx\Migration\AbstractMigration;

class AddDeletedAtSpeakers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
         $this->query('ALTER TABLE `speakers` ADD COLUMN deleted_at datetime not null');    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->query('ALTER TABLE `speakers` DROP COLUMN deleted_at');
    }
}
