<?php

namespace App\Admin\Controllers;

use App\Members;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Illuminate\Http\Request;
use App\Log;
use Encore\Admin\Facades\Admin;

class CommonController extends Controller
{
    use HasResourceActions;

    /**
     * 充值
     * @param Request $request
     * @return false|int|string
     */
    public function putRecharge(Request $request)
    {
        header("Content-type:text/html; charset=UTF-8");
        $phone = $request->input ('phone');
        $amount = $request->input ('amount');
        $info = Members::where('phone', trim ($phone))->first();
        if($info) {
            $balance = $amount + $info->amount;
            Members::where('phone', trim ($phone))->update(['amount' => $balance]);
            $log = [
                'admin_name' => Admin::user()->username,
                'member_name' => $info->name,
                'content' => '用户 '.$info->name.' 充值金额 ¥'.$amount,
                'type' => 'recharge',
                'created_at' => date ('Y-m-d H:i:s', time()),
                'updated_at' => date ('Y-m-d H:i:s', time()),
                'amount' => $amount
            ];
            $post_data = "account=".env ('SMS_APPID')."&password=".env ('SMS_KEY')."&mobile=".$phone."&content=".rawurlencode("尊敬的".$phone."，您这次在本店充值了¥".$amount."，成为本店VIP，可在美容美发中消费～往后日子，有你有我哦");
            xml_to_array(Post($post_data, env ('SMS_URL')));

            return json_encode (Log::insert($log));
        }else{
            return 0;
        }

    }

    /**
     * 会员消费
     * @param Request $request
     * @return false|int|string
     */
    public function putConsume(Request $request)
    {
        header("Content-type:text/html; charset=UTF-8");
        $phone = $request->input ('phone');
        $amount = $request->input ('amount');
        $product = $request->input ('product');
        $info = Members::where('phone', trim ($phone))->first();

        if($info) {

            $balance = $info->amount - $amount;
            if ($info->amount >= $amount) {

                Members::where('phone', trim ($phone))->update(['amount' => $balance]);
                $log = [
                    'admin_name' => Admin::user()->username,
                    'member_name' => $info->name,
                    'content' => '用户 '.$info->name.' 消费金额 ¥'.$amount. ' 产品：'.$product,
                    'type' => 'consume',
                    'created_at' => date ('Y-m-d H:i:s', time()),
                    'updated_at' => date ('Y-m-d H:i:s', time()),
                    'amount' => $amount
                ];
                $post_data = "account=".env ('SMS_APPID')."&password=".env ('SMS_KEY')."&mobile=".$phone."&content=".rawurlencode("尊敬的会员 ".$phone."，您这次在本店消费了".$amount."，余额剩".$balance."，十分感谢您的支持");
                xml_to_array(Post($post_data, env ('SMS_URL')));

                return json_encode (Log::insert($log));

            }else{
                return 0;
            }
        }else{
            return 0;
        }

    }

    /**
     * 散客消费
     * @param Request $request
     * @return false|string
     */
    public function putSignleconsume(Request $request)
    {
        $amount = $request->input ('amount');
        $product = $request->input ('product');

        $log = [
            'admin_name' => Admin::user ()->username,
            'member_name' => 0,
            'content' => '散客消费金额 ¥'.$amount. ' 产品：'.$product,
            'type' => 'consume',
            'created_at' => date ('Y-m-d H:i:s', time ()),
            'updated_at' => date ('Y-m-d H:i:s', time ()),
            'amount' => $amount
        ];
        return json_encode (Log::insert($log));
    }
}
