<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;
use App\Log;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {
            // today time
            $today_start = date ('Y-m-d 06:00:00', time ());
            $today_end = date ('Y-m-d 06:00:00', strtotime("+1 day"));
            // 本日总收入
            $todaySum = Log::where('type', 'consume')->whereBetween('created_at', [$today_start, $today_end])->sum('amount');
            // 散客收入
            $singleSum = Log::where('type', 'consume')->where('member_name', '0')->whereBetween('created_at', [$today_start, $today_end])->sum('amount');
//            dd ($singleSum);
            // 储值卡消耗

            // 新开会员

            // 储值卡充值


//            dd ($todaySum);

            $articleView = view('admin.home')
                ->render();
            $content->row($articleView);
        })->header('首页');
    }
}
