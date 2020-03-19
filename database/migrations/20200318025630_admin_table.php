<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AdminTable extends Migrator
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
    public function up()
    {
        $table = $this->table('users', ['engine' => 'MyISAM']);
        $table->addColumn('username', 'string', ['limit' => 15, 'default' => '', 'comment' => '用户名，登录使用'])
            ->addColumn('password', 'string', ['limit' => 100, 'default' => '', 'comment' => '用户密码'])
            ->addColumn('create_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '创建时间'))
            ->addColumn('update_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '更新时间'))
            ->create();

        $table1 = $this->table('admin_user', ['engine' => 'MyISAM']);
        $table1->addColumn('avatar', 'string', ['limit' => 100, 'default' => '', 'comment' => '用户头像'])
            ->addColumn('username', 'string', ['limit' => 15, 'default' => '', 'comment' => '用户名，登录使用'])
            ->addColumn('nickname', 'string', ['limit' => 15, 'default' => '', 'comment' => '昵称'])
            ->addColumn('password', 'string', ['limit' => 100, 'default' => '', 'comment' => '用户密码'])
            ->addColumn('role', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '权限id'))
            ->addColumn('create_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '创建时间'))
            ->addColumn('update_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '更新时间'))
            ->create();
        $table2 = $this->table('admin_role', ['engine' => 'MyISAM']);
        $table2
            ->addColumn('name', 'string', ['limit' => 15, 'default' => '', 'comment' => '权限名称'])
            ->addColumn('menu', 'string', ['limit' => 150, 'default' => '', 'comment' => '菜单id'])
            ->addColumn('description', 'string', ['limit' => 100, 'default' => '', 'comment' => '描述'])
            ->addColumn('create_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '创建时间'))
            ->addColumn('update_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '更新时间'))
            ->create();

        $table3 = $this->table('admin_menu', ['engine' => 'MyISAM']);
        $table3
            ->addColumn('parent_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '父级id'))
            ->addColumn('name', 'string', ['limit' => 15, 'default' => '', 'comment' => '菜单名称'])
            ->addColumn('url', 'string', ['limit' => 150, 'default' => '', 'comment' => '菜单url'])
            ->addColumn('icon', 'string', ['limit' => 100, 'default' => '', 'comment' => '图标'])
            ->addColumn('log_method', 'string', ['limit' => 100, 'default' => '', 'comment' => '提交方法'])
            ->addColumn('is_show', 'integer', array('limit' => 1, 'default' => 0, 'comment' => '显示'))
            ->addColumn('sort_id', 'integer', array('limit' => 11, 'default' => 1000, 'comment' => '排序'))
            ->addColumn('create_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '创建时间'))
            ->addColumn('update_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '更新时间'))
            ->create();


    }

    public function down()
    {

    }


}
