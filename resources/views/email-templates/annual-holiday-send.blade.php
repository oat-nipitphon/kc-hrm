
    
    <small>KCM HR/xxx-xxxx</small>
    
    <div style="text-align: center; margin-top:25px;">
        ประกาศ
    </div>
    <div style="text-align: center; margin-top:35px;">
        เรื่อง วันหยุดประจำปี 2563
    </div>
    <div style="text-align: center; margin-top:35px;">
        ด้วยบริษัท ได้กำหนดให้วันหยุดนักขัติฤกษ์ หรือวันหยุดตามประเภณี พ.ศ. 2563 ดังนี้
    </div>
    <div style="text-align: center; margin-top:35px;">
        <table id="email-contents" style="width:60%;border: 1px solid black;border-collapse: collapse;" align="center">
            <tr>
              <th style="width:15%;border: 1px solid black;border-collapse: collapse;text-align: center;">ลำดับที่</th>
              <th style="width:42.5%;border: 1px solid black;border-collapse: collapse;text-align: center;">ปี/เดือน/วัน</th>
              <th style="width:42.5%;border: 1px solid black;border-collapse: collapse;text-align: center;">เหตุการณ์</th>
            </tr>
            @foreach ($events as $index => $event)
            <tr>
            <td style="border: 1px solid black;border-collapse: collapse;text-align: center;">{{ $index+1 }}</td>
                <td style="border: 1px solid black;border-collapse: collapse;text-align: center;">{{ $event->start }}</td>
                <td style="border: 1px solid black;border-collapse: collapse;text-align: center;">{{ $event->title }}</td>
            </tr>
            @endforeach
            
        </table>
    </div>
    <div style="margin-top:75px;padding-left:20%">
        ประกาศเมื่อวันที่ 20 เดือน พฤศจิกายน พ.ศ. 2562
    </div>