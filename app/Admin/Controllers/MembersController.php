<?php
/**
 * MembersController
 * @author chapin <chapinwan@yahoo.com>
 * @date 2019-06-10
 */

namespace App\Admin\Controllers;

use App\Members;
use App\Level;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MembersController extends Controller
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
        $grid = new Grid(new Members);

        $grid->id('编号')->sortable();
        $grid->name('昵称');
        $grid->gender('性别')->display(function($gender) {
            return $gender ? "男" : "女";
        });
        $grid->phone('电话');
        $grid->level_id('等级')->display(function($levelId) {
            if ($levelId) {
                return Level::find($levelId)->title;
            } else {
                return "普通会员";
            }
        });
        $grid->status('状态')->display(function($status) {
            return $status=="start" ? "正常" : "冻结";
        });
        $grid->amount('余额');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');
        $grid->model()->orderby('created_at','desc');
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        $grid->filter (function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->like('name', '姓名');
                $filter->like('phone', '电话')->mobile();
            });
            $filter->column(1/2, function ($filter) {
                $filter->equal('gender', '性别')->radio([
                    ''   => '全部',
                    0    => '女',
                    1    => '男',
                ]);
                $filter->equal('level_id', '等级')->select(
                    Level::pluck('title', 'id')
                );
                $filter->between('created_at', '登记时间')->datetime();
            });


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
        $show = new Show(Members::findOrFail($id));

        $show->id('编号');
        $show->name('昵称');
        $show->gender('性别');
        $show->phone('电话');
        $show->level_id('等级');
        $show->status('状态');
        $show->amount('余额');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Members);

        $form->text('name', '昵称')->placeholder('请输入用户昵称')->rules('required');
        $form->radio('gender', '性别')->options(['1' => '男', '0'=> '女'])->default('1')->rules('required');
        $form->mobile('phone', '电话')->placeholder('请输入电话')->rules('required');
        $form->select('level_id', '等级')->options('/api/level')->default("0");
        $status = [
            'on'  => ['value' => 'start', 'text' => '正常', 'color' => 'success'],
            'off' => ['value' => 'close', 'text' => '冻结', 'color' => 'danger'],
        ];
        $form->switch('status', '状态')->states($status)->default('start');
        $form->currency('amount', '余额')->symbol('￥');
        $form->textarea('note', '备注')->rows(7)->placeholder('备注');

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });
        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();

        });
        $form->setWidth(3, 2);

        return $form;
    }
}
