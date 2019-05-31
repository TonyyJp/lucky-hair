<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="content">


    <div class="container-fluid member" style="margin-top:30px;">
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
        $.post("/admin/api/signleconsume", {"amount": amount}, function (data) {
            window.location.reload()
        });
    })

</script>