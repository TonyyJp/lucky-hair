<?php
/**
 * LogController
 * @author chapin <chapinwan@yahoo.com>
 * @date 2019-06-10
 */

namespace App\Admin\Controllers;

use App\Log;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class LogController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('详情')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('修改')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('创建')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Log);
        $grid->admin_name('操作人');
        $grid->member_name('会员');
        $grid->content('内容');
        $grid->amount('金额');
        $grid->type('操作类型')->display(function($type) {
            switch ($type) {
                case "recharge":
                    return "充值";
                    break;
                case "consume":
                    return "消费";
                    break;
                case "frequency":
                    return "冲次";
                    break;
            }
        });
        $grid->created_at('创建时间');
        $grid->model()->orderby('created_at','desc');
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableActions();
        $grid->filter (function ($filter) {
            $filter->like('member_name', '会员');
            $filter->equal('type')->select(['recharge' => '充值','consume' => '消费', 'frequency' => '冲次']);
        });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Log::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Log);



        return $form;
    }
}
