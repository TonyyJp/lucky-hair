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
        return Level::select('id', 'title as text')->where('status', 'start')->get();
    }


}
