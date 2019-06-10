<?php
/**
 * HomeController
 * @author chapin <chapinwan@yahoo.com>
 * @date 2019-06-10
 */

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Members;
use Encore\Admin\Layout\Content;
use App\Log;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
//            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append($this->today ());
                });

                $row->column(4, function (Column $column) {
                    $column->append($this->month());
                });

                $row->column(4, function (Column $column) {
                    $column->append($this->store());
                });
            });

    }

    protected function today()
    {
        // today time
        $today_start = date ('Y-m-d 06:00:00', time ());
        $today_end = date ('Y-m-d 06:00:00', strtotime("+1 day"));
        // 本日总收入
        $td_sum = Log::where('type', 'consume')->whereBetween('created_at', [$today_start, $today_end])->sum('amount');
        // 散客收入
        $td_traveler = Log::where('type', 'consume')->where('member_name', '0')->whereBetween('created_at', [$today_start, $today_end])->sum('amount');
        // 储值卡消耗
        $td_card = Log::where('type', 'consume')->where('member_name', '!=', '0')->whereBetween('created_at', [$today_start, $today_end])->sum('amount');
        // 新开会员
        $td_news = Members::where('status', 'start')->whereBetween('created_at', [$today_start, $today_end])->count();
        // 储值卡充值
        $td_card_recharge = Log::where('type', 'recharge')->where('member_name', '!=', '0')->whereBetween('created_at', [$today_start, $today_end])->sum('amount');
        $envs = [
            ['name' => '本日总收入',       'value' => $td_sum],
            ['name' => '散客收入',   'value' => $td_traveler],
            ['name' => '储值卡消耗',               'value' => $td_card],
            ['name' => '新开会员',             'value' => $td_news],
            ['name' => '储值卡充值',            'value' => $td_card_recharge],
        ];


        return view('admin.today', compact('envs', 'today_start', 'today_end'));
    }

    protected function month()
    {
        // month time
        $month_start = date('Y-m-d 00:00:00', mktime(0, 0, 0, date('m'), 1, date('Y')));
         $month_end = date('Y-m-d 23:59:59', mktime(0, 0, 0, date('m')+1, 0, date('Y')));
        // 本月总收入
        $month_sum = Log::where('type', 'consume')->whereBetween('created_at', [$month_start, $month_end])->sum('amount');
        // 散客收入
        $month_traveler = Log::where('type', 'consume')->where('member_name', '0')->whereBetween('created_at', [$month_start, $month_end])->sum('amount');
        // 储蓄卡消耗
        $month_card = Log::where('type', 'consume')->where('member_name', '!=', '0')->whereBetween('created_at', [$month_start, $month_end])->sum('amount');
        // 本月消费会员数
        $month_members = Log::where('type', 'consume')->where('member_name', '!=', '0')->whereBetween('created_at', [$month_start, $month_end])->distinct('member_name')->count('member_name');
        // 新开会员卡
        $month_news = Members::where('status', 'start')->whereBetween('created_at', [$month_start, $month_end])->count();
        //顾客充值（人）
        $month_recharge = Log::where('type', 'recharge')->where('member_name', '!=', '0')->whereBetween('created_at', [$month_start, $month_end])->distinct('member_name')->count('member_name');
        $envs = [
            ['name' => '本月总收入',       'value' => $month_sum],
            ['name' => '散客收入',   'value' => $month_traveler],
            ['name' => '储值卡消耗',               'value' => $month_card],
            ['name' => '本月消耗会员数',             'value' => $month_members],
            ['name' => '新开会员卡',            'value' => $month_news],
            ['name' => '顾客充值（人）',            'value' => $month_recharge],
        ];

        return view('admin.month', compact('envs', 'month_start', 'month_end'));

    }

    protected function store()
    {
        // store data
        // 店铺总会员数
        $store_members = Members::where('status', 'start')->count();
        // 店铺总剩余卡额
        $store_sum = Members::where('status', 'start')->sum('amount');

        $envs = [
            ['name' => '店铺总会员数',       'value' => $store_members],
            ['name' => '店铺总剩余卡额',       'value' => $store_sum],
        ];

        return view ('admin.store', compact ('envs'));
    }
}
