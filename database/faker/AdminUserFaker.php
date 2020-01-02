<?php
namespace database\faker;
class  AdminUserFaker
{
    public function run()
    {
        $faker = \Faker\Factory::create('zh_CN');
        $adminUser = new \app\model\AdminUser();
        $adminUser::create([
            'username' => 'admin',
            'password' => base64_encode(password_hash('111111', PASSWORD_DEFAULT)),
        ]);


    }
}