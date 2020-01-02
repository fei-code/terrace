<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateAdminUserTable extends Migrator
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
        $table = $this->table('admin_user', ['primary_key' => ['id']]);
        $table->addColumn('username', 'string')
            ->addColumn('password', 'string')
            ->addColumn('create_time', 'integer' ,['default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['default' => 0, 'comment' => '最后登录时间'])
            ->create();
    }
}
