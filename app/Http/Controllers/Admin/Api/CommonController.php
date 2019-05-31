<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Level;

class CommonController extends Controller
{
    //

    /**
     * 获取等级列表
     * @return mixed
     */
    public function getLevel()
    {
        $result = Level::select('id', 'title as text')->where('status', 'start')->get()->toArray();
        $result[] = [
            'id' => 0,
            'text' => '普通会员'
        ];
        return $result;
    }


}
