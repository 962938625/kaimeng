<?php

namespace app\common\validate;

use think\Validate;

class Member extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'username|用户名' => 'require',
        'email|邮箱' => 'require|email',
        'password|密码' => 'require',
        'conpass|确认密码' => 'require|confirm:password',
        'status|状态' => 'require',
        'oldpass|原密码' => 'require',
        'newpass|新密码' => 'require',
        'nickname|昵称' => 'require',
        'verify|验证码' => 'require|captcha'
    ];
    
    public function sceneAdd()
    {
        return $this->only(['username','password','nickname','email']);
    }
    public function sceneEdit()
    {
        return $this->only(['password','nickname']);
    }
    public function sceneRegister()
    {
        return $this->only(['username', 'password', 'conpass', 'nickname', 'email','verify'])
            ->append('username', 'unique:admin');
    }
    public function sceneLogin()
    {
        return $this->only(['username','password','verify']);
    }
}
