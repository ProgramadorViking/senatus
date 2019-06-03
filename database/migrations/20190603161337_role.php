<?php


use Phinx\Migration\AbstractMigration;

class Role extends AbstractMigration
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
      $exists = $this->hasTable('roles');
      if (!$exists) {
        $role = $this->table('roles');
        $role->addColumn('name','string',['limit'=>50,'null'=>false])
             ->addColumn('created','timestamp')
             ->addColumn('updated','timestamp')
             ->addColumn('created_by','integer')
             ->addColumn('updated_by','integer')
             ->create();
         $users = $this->table('users');
         $users->addForeignKey('role_id', 'roles', 'id')->save();
      }
    }
}
