
<div style="margin-top:10px">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">ชื่อสินค้า</th>
                @foreach ($warehouses as $warehouse)
                    <th class="text-center" style="width: 50px;">{{ $warehouse->code }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($goods as $good)
                <tr class="trGood">
                    <td>
                        {{ $good->name }}
                        <input type="hidden" class="goodId" value="{{ $good->id }}">
                    </td>
                    @foreach ($warehouses as $warehouse)
                        <th>
                            <label class="{{ $warehouse->code }}">0</label>
                        </th>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
