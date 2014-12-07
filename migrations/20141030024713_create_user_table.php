<?php

use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
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
        $this->query('
            CREATE TABLE `speakers` (
                `id`           varchar(20) not null,
                `first_name`   varchar(255),
                `last_name`    varchar(255),
                `email`        varchar(255),
                `password`     varchar(80),

                primary key (`id`)
            )
        ');    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->query('DROP TABLE `speakers`');
    }
}
