<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">本日数据<br /><small>（统计时间段：{{ $today_start }}至{{ $today_end }} 同步时间稍有延迟，数据可能出现微小误差）</small></h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">

                @foreach($envs as $env)
                    <tr>
                        <td width="120px">{{ $env['name'] }}</td>
                        <td>{{ $env['value'] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
</div>