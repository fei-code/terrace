<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateAdminMenuTable extends Migrator
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
        $table = $this->table('admin_menu', ['primary_key' => ['id']]);
        $table
            ->addColumn('parent_id', 'integer', ['default' => 0, 'comment' => '父级菜单'])
            ->addColumn('name', 'string', ['default' => null, 'comment' => '名称'])
            ->addColumn('url', 'string', ['default' => null, 'comment' => 'url'])
            ->addColumn('icon', 'string', ['default' => null, 'comment' => '图标'])
            ->addColumn('is_show', 'integer', ['default' => 0, 'comment' => '等级'])
            ->addColumn('sort_id', 'integer', ['default' => 1000, 'comment' => '排序'])
            ->addColumn('log_method', 'string', ['default' => 0, 'comment' => '记录日志方法'])
            ->addColumn('create_time', 'integer', ['default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['default' => 0, 'comment' => '更新时间'])
            ->create();

    }
}
