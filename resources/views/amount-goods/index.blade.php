@extends('layouts.app')

@section('content')

<select class="form-control selectType">
    <option value="กรุณาเลือกประเภท">กรุณาเลือกประเภท</option>
    @foreach ($types as $type)
        <option value="{{ $type->id }}">{{ $type->name }}</option >
    @endforeach
</select>

<button class="btn btn-primary clickAmountGoodWarehouse">คำนวณจำนวนสินค้าแต่ละคลัง</button>

<div class="formDataTable"></div>

@stop

@section('script')

<script>

    $(document).on("change paste keyup", ".selectType", function() {
        typeId = $(this).val();
        if (typeId != 'กรุณาเลือกประเภท') {
            ajaxSearchGoodFormType(typeId);
        }
    });

    function ajaxSearchGoodFormType(typeId) {
        $.ajax({
            type: "POST",
            url: "/report/amount-goods/balanceGoods",
            data: {
                "_token": "{{ csrf_token() }}",
                "type_id": typeId
            },
            success: function (data) {
                $('.formDataTable').html(data.html);
            }
        });
    }

    $(document).on("click", ".clickAmountGoodWarehouse", function() {
        $(this).attr('disabled', true);
        calAmountGoodWarehouse();
        $(this).attr('disabled', false);
    });

    function calAmountGoodWarehouse() {
        $('.trGood').each(function() {
            row = $(this);
            goodId = $(this).find('.goodId').val();
            ajaxCheckAmount(row, goodId);
        });
    }

    function ajaxCheckAmount(row, goodId) {
        $.ajax({
            type: "POST",
            url: "/report/amount-goods/viewBalance",
            data: {
                "_token": "{{ csrf_token() }}",
                "good_id": goodId
            },
            async: false,
        }).done(function (data) {
            $.each(data , function(i, value) {
                if (value['goodview'] != null) {
                    console.log(+value['goodview']['balance_amount']);
                    row.find('.'+value['code']).text(+value['goodview']['balance_amount']);
                }else {
                    row.find('.'+value['code']).text(0);
                }
            })
        });
    }

</script>
