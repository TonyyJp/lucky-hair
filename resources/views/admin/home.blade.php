<div class="container-fluid member">
    <div class="row">
        <p><span class="glyphicon glyphicon-menu-right"></span> 本日数据<small>（统计时间段：{{ $data['today_start'] }}至{{ $data['today_end'] }} 同步时间稍有延迟，数据可能出现微小误差）</small></p>
    </div>
    <div class="row">
        <div class="col-md-2">
            <p>本日总收入：<span class="text-danger ">{{ $data['td_sum'] }}元</span></p>
        </div>
        <div class="col-md-2">
            <p>散客收入：<span class="text-danger ">{{ $data['td_traveler'] }}元</span></p>
        </div>
        <div class="col-md-2">
            <p>储值卡消耗：<span class="text-danger ">{{ $data['td_card'] }}元</span></p>
        </div>
        <div class="col-md-2">
            <p>新开会员：<span class="text-danger ">{{ $data['td_news'] }}人</span></p>
        </div>
        <div class="col-md-2">
            <p>储值卡充值：<span class="text-danger ">{{ $data['td_card_recharge'] }}元</span></p>
        </div>
    </div>

    <p class="divider"> </p>

    <div class="row">
        <p><span class="glyphicon glyphicon-menu-right"></span> 本月营收<small>（统计时间段：{{ $data['month_start'] }}至{{ $data['month_end'] }} 同步时间稍有延迟，数据可能出现微小误差）</small></p>
    </div>
    <div class="row">
        <div class="col-md-2">
            <p>本月总收入：<span class="text-danger ">{{ $data['month_sum'] }}元</span></p>
        </div>
        <div class="col-md-2">
            <p>散客收入：<span class="text-danger ">{{ $data['month_traveler'] }}元</span></p>
        </div>
        <div class="col-md-2">
            <p>储值卡消耗：<span class="text-danger ">{{ $data['month_card'] }}元</span></p>
        </div>
        <div class="col-md-2">
            <p>本月消费会员数：<span class="text-danger ">{{ $data['month_members'] }}人</span></p>
        </div>
        <div class="col-md-2">
            <p>新开会员卡：<span class="text-danger ">{{ $data['month_news'] }}人</span></p>
        </div>
        <div class="col-md-2">
            <p>顾客充值：<span class="text-danger ">{{ $data['month_recharge'] }}人</span></p>
        </div>
    </div>

    <p class="divider"> </p>

    <div class="row">
        <p><span class="glyphicon glyphicon-menu-right"></span> 店铺数据</p>
    </div>
    <div class="row">
        <div class="col-md-2">
            <p>店铺总会员数：<span class="text-danger ">{{ $data['store_members'] }}人</span></p>
        </div>
        <div class="col-md-3">
            <p>店铺总剩余卡额：<span class="text-danger ">{{ $data['store_sum'] }}元</span></p>
        </div>
    </div>



</div>