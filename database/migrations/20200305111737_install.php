<?php
/*
 * @Author: Kingsr
 * @Date: 2020-03-05 19:17:37
 * @LastEditors: Kingsr
 * @LastEditTime: 2020-03-05 23:22:36
 * @Description: file content
 */

use think\migration\Migrator;
use think\migration\db\Column;

class Install extends Migrator
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
        $members = $this->table('members', ['id' => 'uid']);
        $members->addColumn('username', 'string', array('limit'  =>  15, 'default' => '', 'comment' => '用户名'))
            ->addColumn('email', 'string', array('default' => '', 'comment' => '邮箱，登录使用'))
            ->addColumn('password', 'string', array('limit'  =>  64,  'comment' => '用户密码'))
            ->addColumn('status', 'integer', array('limit'  =>  1, 'default' => 0, 'comment' => '用户状态'))
            ->addColumn('create_time', 'integer', ['comment' => '创建时间'])
            ->addColumn('last_login_ip', 'integer', array('limit'  =>  11, 'default' => 0, 'comment' => '最后登录IP'))
            ->addColumn('last_login_time', 'integer', array('default' => 0, 'comment' => '最后登录时间'))
            ->addColumn('delete_time', 'integer', array('comment' => '删除时间', 'null' => true))
            ->addIndex(array('username'), array('unique'  =>  true))
            ->create();

        $user_rss = $this->table('user_rss', ['id' => 'user_rss_id']);
        $user_rss->addColumn('uid', 'uuid', ['comment' => '订阅者ID'])
            ->addColumn('rss_url', 'string', ['comment' => 'rss订阅URL'])
            ->addColumn('create_time', 'integer', ['comment' => '创建时间'])
            ->create();

        $user_subscribe = $this->table('user_subscribe', ['id' => 'sub_id']);
        $user_subscribe->addColumn('uid', 'integer', ['comment' => '订阅人ID'])
            ->addColumn('type', 'integer', ['comment' => '套餐类型'])
            ->addColumn('create_time', 'integer', ['comment' => '套餐创建时间'])
            ->addColumn('expire_time', 'integer', ['comment' => '套餐失效时间'])
            ->create();

        $subscribe_type = $this->table('subscribe_type', ['id' => 'sub_type_id']);
        $subscribe_type->addColumn('name', 'string', ['comment' => '套餐名称'])
            ->addColumn('rss_number', 'integer', ['default' => 60, 'comment' => '套餐支持最大订阅数'])
            ->addColumn('price_month', 'decimal', ['comment' => '套餐月付价格'])
            ->addColumn('price_quarter', 'decimal', ['comment' => '套餐季度付价格'])
            ->addColumn('price_halfyear', 'decimal', ['comment' => '套餐半年付价格'])
            ->addColumn('price_year', 'decimal', ['comment' => '套餐年付价格'])
            ->addColumn('create_time', 'integer', ['comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['comment' => '修改时间'])
            ->create();

        $system_rss_list = $this->table('system_rss_list', ['id' => 'rss_id']);
        $system_rss_list->addColumn('title', 'string', ['comment' => 'RSS名称'])
            ->addColumn('description', 'text', ['comment' => 'RSS介绍'])
            ->addColumn('rule', 'string', ['comment' => 'RSS规则'])
            ->addColumn('link', 'string', ['comment' => 'RSS链接'])
            ->addColumn('form', 'string', ['comment' => 'RSS来源'])
            ->addColumn('form_link', 'string', ['comment' => 'RSS来源链接'])
            ->addColumn('create_time', 'integer', ['comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['comment' => '修改时间'])
            ->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'null' => true])
            ->create();
    }
}
