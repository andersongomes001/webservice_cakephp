<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    public $autoId = false;
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true
        ])->addPrimaryKey('id');
        $table->addColumn('email','string',[
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('password','string',[
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
