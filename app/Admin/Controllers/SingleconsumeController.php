<?php
/**
 * SingleconsumeController
 * @author chapin <chapinwan@yahoo.com>
 * @date 2019-06-10
 */

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Illuminate\Http\Request;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;

class SingleconsumeController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Request $request)
    {
        $key = $request->input ('key');
        return Admin::content(function (Content $content) use ($key) {
            $result = DB::table('members')
                ->leftJoin('level', 'members.level_id', '=', 'level.id')
                ->select('members.*', 'level.title')
                ->where('phone', $key)->first();
            $articleView = view('admin.singleconsume',['result' => $result, 'key'=> $key])
                ->render();
            $content->row($articleView);

        })->header('散客消费');
    }


}
