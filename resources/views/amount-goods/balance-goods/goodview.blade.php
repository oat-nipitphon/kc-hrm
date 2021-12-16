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
<div id="loader"></div>
<table class="table table-striped table-bordered table-hover dataTables-example" style="width: 100%">
    <thead>
        <tr>
        <td style="width:15%" class="text-center">รหัสสินค้า</td>
        <td  class="text-center">ชื่อสืนค้า</td>
        <td style="width:15%" class="text-center">จำนวนสินค้า</td>
        </tr>
    </thead>
    <tbody>
        @foreach($goods as $good)
            <tr class="trGood">
                <td>{{ $good->code }}</td>
                <td>{{ $good->name }}</td>
                <td>
                    <button class="btn btn-primary viewAmount" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fa fa-dropbox"></i> ดูจำนวนสินค้า
                    </button>
                    <input type="hidden" value="{{ $good->id }}" class="goodId">

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>

    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
        });
    });

    $('.viewAmount').on('click', function(){
        OpenLoading();

        tr = $(this).closest('.trGood');

        goodId = tr.find('.goodId').val();

        dataRaesponse = null;

        $.ajax({
            type: "POST",
            url: "amount-goods/amountGoodView",
            data: {
                "_token": "{{ csrf_token()}}",
                "goodId": goodId,
            },
            success: function (data) {
                dataRaesponse = data;
                CloseLoading();
            }
        }).done(function (){
            $('.mdView').html(dataRaesponse.html);
            $('#modalCenter').modal('show');
        });
    });



    // $('.setype').on('change', function(){
    //     selectGood()
    // });



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
