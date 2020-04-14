<?php
declare (strict_types = 1);

namespace app;

use think\Service;

/**
 * 应用服务类
 */
class AppService extends Service
{
    public function register()
    {
        // 服务注册
        $register = app()->make(\HZEX\Blade\Register::class);
        $register->directive('strlen', function ($parameter) {
            return "<?php echo strlen($parameter) ?>";
        });
        $register->if('auth', function ($parameter) {
            return true;
        });
    }

    public function boot()
    {
        // 服务启动
    }
}
