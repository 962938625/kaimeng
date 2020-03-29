<?php

namespace app\common\validate;

use think\Validate;

class System extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'webname|网站名称'=>'require',
	    'copyright|版权信息'=>'require',
    ];
    
    public function sceneEdit()
    {
        return $this->only(['webname','copyright']);
    }
}
