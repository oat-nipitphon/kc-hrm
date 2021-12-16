@extends('layouts-whs-center.app')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>

    /* Start Style Loading */
    .loading {
        position: fixed;
        z-index: 999;
        height: 2em;
        width: 2em;
        overflow: visible;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }

    /* Transparent Overlay */
    .loading:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.3);
    }

    /* :not(:required) hides these rules from IE9 and below */
    .loading:not(:required) {
        /* hide "loading..." text */
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }

    .loading:not(:required):after {
        content: '';
        display: block;
        font-size: 10px;
        width: 1em;
        height: 1em;
        margin-top: -0.5em;
        -webkit-animation: spinner 1500ms infinite linear;
        -moz-animation: spinner 1500ms infinite linear;
        -ms-animation: spinner 1500ms infinite linear;
        -o-animation: spinner 1500ms infinite linear;
        animation: spinner 1500ms infinite linear;
        border-radius: 0.5em;
        -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
        box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
    }

        /* Animation */
    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
    }

    100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
    }

    100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-o-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
    }

    100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }

    }

    @keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
    }

    100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    /* End Style Loading */


</style>
@section('content')
    <div id="loader"></div>



    {{-- Start Menu --}}
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>รายงานจำนวนสินค้า</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="http://127.0.0.1:8000/whs-center/dashboard">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <strong>
                        <a href="http://127.0.0.1:8000/whs-center/report/amount-goods">จำนวนสินค้า</a>
                    </strong>
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-7"></div>
            <div class="col-lg-5">
                <select class="form-control form-control-sm setype" id="setype">
                    <option>--- เลือกประเภทสินค้า ---</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                </select>
            </div>
        </div>
    </div>
    {{-- End Menu --}}

    {{-- Line --}}
    <div class="col-lg-12"><hr></div>

    {{-- List Data --}}
    <div class="table-reponsive tableshowgood">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td style="width:15%" class="text-center">รหัสสินค้า</td>
                    <td  class="text-center">ชื่อสืนค้า</td>
                    <td style="width:15%" class="text-center">จำนวนสินค้า</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="text-center">ไม่มีรายการสินค้าที่เลือก</td>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- End List Data --}}

    {{-- Modal List Data --}}
    <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLongTitle">
                        <span class="badge badge-primary badge-pill">จำนวนคงเหลือของคลังทั้งหมด</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" >
                    <span aria-hidden="true"><i class="fa fa-ban"></i></span>
                    </button>
                </div>
                <div class="modal-body mdView">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-close"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal List Data --}}

@endsection

@section('script')

<script type="text/javascript">
    // Strat Function Show Select Good
    $('.setype').on('change', function(){
        selectGood()
    });

    function selectGood()
    {
        OpenLoading();
        var setype = $('#setype').val();
        $.ajax({
            type: "POST",
            url: "amount-goods/ajaxrequestpost",
            data: {
                "_token": "{{ csrf_token()}}",
                "setype": setype,
            },
            success: function (data) {
                $('.tableshowgood').html(data.html);
                CloseLoading();
            }
        });
    }
    // End Function Show Select Good

    // Start Function Loading
    function OpenLoading() {
        $( "#loader" ).delay(10).fadeIn();
        $( "#loader" ).addClass( "loading" );
        }

    function CloseLoading() {
        $( "#loader" ).delay(10).fadeOut();
        $( "#loader" ).addClass( "loading" );
    }
    // End Function Loading

</script>

@endsection
