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
            <dt>等级:</dt>
            <dd>@isset($result->title) {{ $result->title ? $result->title : "普通会员" }} @endisset</dd>
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
                    {{--<input type="text" class="form-control" id="exampleInputAmount" placeholder="金额">--}}
                    <input style="width: 120px; text-align: right;" type="text" id="exampleInputAmount" value="0" class="form-control amount" placeholder="金额">
                    {{--<div class="input-group-addon">.00</div>--}}
                </div>
            </div>
            <select id="product" class="form-control">
                <option value="洗吹">洗吹</option>
                <option value="洗剪吹">洗剪吹</option>
                <option value="染发">染发</option>
                <option value="烫发">烫发</option>
                <option value="护理">护理</option>
                <option value="产品">产品</option>
                <option value="单剪">单剪</option>
                <option value="美容项目">美容项目</option>
                <option value="泰式">泰式</option>
                <option value="其他">其他</option>
            </select>
            <button type="button" class="btn btn-primary btn_recharge">消费</button>
        </form>
    </div>

</section>
<script>

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


    $('.btn_recharge').click(function () {
        var amount = $("#exampleInputAmount").val();
        var phone = $("#phone").val();
        var product = $("#product").val();
        $.post("/admin/api/consume", {"phone": phone, "amount": amount, "product": product}, function (data) {
            window.location.reload()
        });
    })

</script>