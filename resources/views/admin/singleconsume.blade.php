<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="content">


    <div class="container-fluid member" style="margin-top:30px;">
        <form class="form-inline recharge" style="margin-top:30px;">
            <div class="form-group">
                <label class="sr-only" for="exampleInputAmount">Amount (RMB)</label>
                <div class="input-group">
                    <input type="hidden" id="phone" value="@isset($result->phone) {{ $result->phone }} @endisset">
                    <div class="input-group-addon">￥</div>
                    {{--<input type="text" class="form-control" id="exampleInputAmount" placeholder="金额">--}}
                    {{--<div class="input-group-addon">.00</div>--}}
                    <input style="width: 120px; text-align: right;" type="text" id="exampleInputAmount" value="0.00" class="form-control amount" placeholder="金额">
                </div>
            </div>
            <select id="product" class="form-control">
                <option value="洗吹">洗吹</option>
                <option value="洗剪吹">洗剪吹</option>
                <option value="染发">染发</option>
                <option value="烫发">烫发</option>
                <option value="护理">护理</option>
                <option value="产品">产品</option>
            </select>
            <button type="button" class="btn btn-primary btn_recharge">消费</button>
        </form>
    </div>

</section>
<script>

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


    $('.btn_recharge').click(function () {
        var amount = $("#exampleInputAmount").val();
        var product = $("#product").val();
        $.post("/admin/api/signleconsume", {"amount": amount, "product":product}, function (data) {
            window.location.reload()
        });
    })

</script>