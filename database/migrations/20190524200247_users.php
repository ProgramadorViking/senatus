<?php


use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
      $exists = $this->hasTable('users');
        if (!$exists) {
            $users = $this->table('users');
            //Id es automaticamente la Primery Key
            $users->addColumn('name','string',['limit'=>50,'null'=>false])
                  ->addColumn('worker_id','integer')
                  ->addColumn('date1','date')
                  ->addColumn('active','boolean',['default'=>false])
                  ->addColumn('role_id','integer')
                  ->addColumn('password','string',['limit'=>300])
                  ->addColumn('token','string',['limit'=>500])
                  ->create();
        }
    }
}
