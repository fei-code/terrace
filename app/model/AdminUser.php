<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * @mixin think\Model
 */
class AdminUser extends Model
{
    public function setAvatarAttr($value)
    {

        if (empty($value)) {
            return "/static/admin/images/avatar.jpg";
        } else {
            return $value;
        }
    }

    public function adminRole()
    {
        return $this->hasOne('AdminRole', 'id', 'role');
    }

    public function setPasswordAttr($value)
    {
        return base64_encode(password_hash(trim($value), PASSWORD_DEFAULT));
    }

}
