<?php


use Phinx\Migration\AbstractMigration;

class Permission extends AbstractMigration
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
      $exists = $this->hasTable('permissions');
      if (!$exists) {
        $permission = $this->table('permissions');
        $permission->addColumn('name','string',['limit'=>30,'null'=>false])
                   ->addColumn('action','integer')
                   /* 0 => Read
                    * 1 => Add
                    * 2 => Edit
                      3 => Delete */
                   ->addColumn('table','string',['limit'=>30,'null'=>false])
                   ->addColumn('created','timestamp')
                   ->addColumn('updated','timestamp')
                   ->addColumn('created_by','timestamp')
                   ->addColumn('updated_by','timestamp')
                   ->create();
      }

    }
}
