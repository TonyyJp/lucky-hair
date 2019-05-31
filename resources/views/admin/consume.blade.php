<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="content">

    <div class="row">
        <div class="col-lg-3">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control key-world" name="key" value="{{ $key }}" placeholder="电话">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">查找</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid member" style="margin-top:30px;">
        <dl class="dl-horizontal">
            <dt>姓名:</dt>
            <dd>@isset($result->name) {{ $result->name }} @endisset</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>性别:</dt>
            <dd>@isset($result->gender) {{ $result->gender == 1 ? "男" : "女" }} @endisset</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>电话:</dt>
            <dd>@isset($result->phone) {{ $result->phone }} @endisset</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>余额:</dt>
            <dd>@isset($result->amount) {{ $result->amount }} @endisset</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>创建时间:</dt>
            <dd>@isset($result->created_at) {{ $result->created_at }} @endisset</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>状态:</dt>
            <dd>@isset($result->status) {{ $result->status == "start" ? "正常" : "冻结" }} @endisset</dd>
        </dl>

        <form class="form-inline recharge" style="margin-top:30px;">
            <div class="form-group">
                <label class="sr-only" for="exampleInputAmount">Amount (RMB)</label>
                <div class="input-group">
                    <input type="hidden" id="phone" value="@isset($result->phone) {{ $result->phone }} @endisset">
                    <div class="input-group-addon">￥</div>
                    <input type="text" class="form-control" id="exampleInputAmount" placeholder="金额">
                    <div class="input-group-addon">.00</div>
                </div>
            </div>
            <button type="button" class="btn btn-primary btn_recharge">消费</button>
        </form>
    </div>

</section>
<script>

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


    $('.btn_recharge').click(function () {
        var amount = $("#exampleInputAmount").val();
        var phone = $("#phone").val();
        $.post("/admin/api/consume", {"phone": phone, "amount": amount}, function (data) {
            window.location.reload()
        });
    })

</script>