<table class="table table-striped table-bordered table-hover dataTables-wareHouseGoodView table-responsive" style="width: 100%">
    <thead>
        <tr>
            <td width="50%">คลังสินค้า</td>
            <td width="50%">จำนวนคงเหลือ</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($warehouses as $warehouse)
            <tr>
                <td>{{ $warehouse->code .' '. $warehouse->name }}</td>
                <td>
                    @if ($goodviews->count() != 0)
                        {{ $goodviews->where('warehouse_id', $warehouse->id)->count() != 0 ?
                        $goodviews->where('warehouse_id', $warehouse->id)->first()->balance_amount : 0 }}
                    @else
                        0
                    @endif

                    {{-- @if ($goodviews->where('warehouse_id', $warehouse->id)->count() != 0)
                            {{ $goodviews->where('warehouse_id', $warehouse->id)->first()->balance_amount }}
                        @else
                            0
                        @endif --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>

    $(document).ready(function(){
        $('.dataTables-wareHouseGoodView').DataTable({
            pageLength: 50,
            responsive: true,
        });
    });

    $('.setype').on('change', function(){
        selectGood()
    });

</script>
