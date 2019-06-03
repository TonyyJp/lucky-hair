<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Members;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;
use App\Log;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {
            // today time
            $data['today_start'] = date ('Y-m-d 06:00:00', time ());
            $data['today_end'] = date ('Y-m-d 06:00:00', strtotime("+1 day"));
            // 本日总收入
            $data['td_sum'] = Log::where('type', 'consume')->whereBetween('created_at', [$data['today_start'], $data['today_end']])->sum('amount');
            // 散客收入
            $data['td_traveler'] = Log::where('type', 'consume')->where('member_name', '0')->whereBetween('created_at', [$data['today_start'], $data['today_end']])->sum('amount');
            // 储值卡消耗
            $data['td_card'] = Log::where('type', 'consume')->where('member_name', '!=', '0')->whereBetween('created_at', [$data['today_start'], $data['today_end']])->sum('amount');
            // 新开会员
            $data['td_news'] = Members::where('status', 'start')->whereBetween('created_at', [$data['today_start'], $data['today_end']])->count();
            // 储值卡充值
            $data['td_card_recharge'] = Log::where('type', 'recharge')->where('member_name', '!=', '0')->whereBetween('created_at', [$data['today_start'], $data['today_end']])->sum('amount');
//            dd ($data['td_card_recharge']);

            // month time
            $data['month_start'] = date('Y-m-d 00:00:00', mktime(0, 0, 0, date('m'), 1, date('Y')));
            $data['month_end'] = date('Y-m-d 23:59:59', mktime(0, 0, 0, date('m')+1, 0, date('Y')));
            // 本月总收入
            $data['month_sum'] = Log::where('type', 'consume')->whereBetween('created_at', [$data['month_start'], $data['month_end']])->sum('amount');
            // 散客收入
            $data['month_traveler'] = Log::where('type', 'consume')->where('member_name', '0')->whereBetween('created_at', [$data['month_start'], $data['month_end']])->sum('amount');
            // 储蓄卡消耗
            $data['month_card'] = Log::where('type', 'consume')->where('member_name', '!=', '0')->whereBetween('created_at', [$data['month_start'], $data['month_end']])->sum('amount');
            // 本月消费会员数
            $data['month_members'] = Log::where('type', 'consume')->where('member_name', '!=', '0')->whereBetween('created_at', [$data['month_start'], $data['month_end']])->distinct('member_name')->count('member_name');
            // 新开会员卡
            $data['month_news'] = Members::where('status', 'start')->whereBetween('created_at', [$data['month_start'], $data['month_end']])->count();
            //顾客充值（人）
            $data['month_recharge'] = Log::where('type', 'recharge')->where('member_name', '!=', '0')->whereBetween('created_at', [$data['month_start'], $data['month_end']])->distinct('member_name')->count('member_name');

            // store data
            // 店铺总会员数
            $data['store_members'] = Members::where('status', 'start')->count();
            // 店铺总剩余卡额
            $data['store_sum'] = Members::where('status', 'start')->sum('amount');

            $articleView = view('admin.home', compact ('data'))
                ->render();
            $content->row($articleView);
        })->header('首页');
    }
}
