
<li>
    <a href="/kc-hrm/hrm-report"><i class="fas fa-search"></i><span>ค้นหารายงาน</span></a>
</li>
<li>
    <a href="{{ route('kc-pos.report.amount-goods') }}"><i class="fas fa-search"></i><span>Amount good</span></a>
</li>

<li>
    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="index.html">Dashboard v.1</a></li>
        <li><a href="dashboard_2.html">Dashboard v.2</a></li>
        <li><a href="dashboard_3.html">Dashboard v.3</a></li>
        <li><a href="dashboard_4_1.html">Dashboard v.4</a></li>
        <li><a href="dashboard_5.html">Dashboard v.5</a></li>
    </ul>

</li>

@role('admin')

<li>
    <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Role & Permission</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        {{-- <li><a href="{{ route('roles.index') }}">Role</a></li> --}}
        <li><a href="{{ route('manage permissions') }}">Permission</a></li>
    </ul>
</li>
<li>
    <a href="{{ route('users.index') }}"><i class="fa fa-diamond"></i> <span class="nav-label">Manage Users</span></a>
</li>
@endrole

{{-- <li>
    <a href="{{ route('departments.index') }}"><i class="fa fa-diamond"></i> <span class="nav-label">จัดการสาขา</span></a>
</li> --}}
{{-- <li>
    <a href="{{ route('employees.index') }}"><i class="fa fa-diamond"></i> <span class="nav-label">จัดการพนักงาน</span></a>
</li>
<li>
    <a href="{{ route('warehouses.index') }}"><i class="fa fa-diamond"></i> <span class="nav-label">จัดการ Warehouse</span></a>
</li>
<li>
    <a href="{{ route('divisions.index') }}"><i class="fa fa-diamond"></i> <span class="nav-label">จัดการฝ่าย</span></a>
</li>
<li>
    <a href="{{ route('sections.index') }}"><i class="fa fa-diamond"></i> <span class="nav-label">จัดการแผนก</span></a>
</li>
<li>
    <a href="{{ route('positions.index') }}"><i class="fa fa-diamond"></i> <span class="nav-label">จัดการตำแหน่ง</span></a>
</li>
<li>
    <a href="{{ route('warehouse-position.index') }}"><i class="fa fa-diamond"></i> <span class="nav-label">ตำแหน่ง + สาขา</span></a>
</li> --}}

<li>
    <a href="#"><i class="fa fa-home"></i><span class="nav-label">Warehouse</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li>
            <a href="{{ route('warehouses.index') }}"><span class="nav-label">สาขา</span></a>
        </li>
        <li>
            <a href="{{ route('divisions.index') }}"><span class="nav-label">ฝ่ายงาน</span></a>
        </li>
        <li>
            <a href="{{ route('sections.index') }}"><span class="nav-label">แผนก</span></a>
        </li>
        <li>
            <a href="{{ route('positions.index') }}"><span class="nav-label">ตำแหน่ง</span></a>
        </li>
        {{-- <li>
            <a href="{{ route('warehouse-position.index') }}"><span class="nav-label">สาขา ตำแหน่ง</span></a>
        </li> --}}
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-user"></i><span class="nav-label">พนักงาน</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li>
            <a href="{{ route('employees.index') }}"><span class="nav-label">พนักงาน</span></a>
        </li>
        <li>
            <a href="{{ route('employee-report') }}"><span class="nav-label">รายงานวัน</span></a>
        </li>        
        <li>
            <a href="{{ route('user-permisisons') }}"><span class="nav-label">สิทธิ์การเข้าถึง</span></a>
        </li>
        <li>
            <a href="{{ route('employee.worktime') }}"><span class="nav-label">เวลาทำงาน</span></a>
        </li>
        <li>
            <a href="{{ route('timeAttendance.index') }}"><span class="nav-label">ประวัติการเข้างาน</span></a>
        </li>
    </ul>
</li>
{{-- <li>
    <a href="#"><i class="fa fa-user"></i><span class="nav-label">Permission</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li>
            <a href="#"><span class="nav-label">จัดการ Permission</span></a>
        </li>
        <li>
            <a href="#"><span class="nav-label">Employee - permission</span></a>
        </li>
    </ul>
</li> --}}
<li>
    <a href="#"><i class="fa fa-calendar"></i><span class="nav-label">ปฏิทิน / ประกาศ</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li>
            <a href="{{ route('calendar.index') }}"><span class="nav-label">จัดการปฏิทิน</span></a>
        </li>
        <li>
            <a href="{{ route('announce.index') }}"><span class="nav-label">ประกาศ</span></a>
        </li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-calendar"></i><span class="nav-label">ตั้งค่าเวลาทำงาน</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li>
            <a href="{{ route('worktime.index') }}"><span class="nav-label">กะงาน</span></a>
        </li>
        <li>
            <a href="{{ route('worktime.leave') }}"><span class="nav-label">ขาด/ลา/มาสาย</span></a>
        </li>
        <li>
            <a href="{{ route('worktime.ot') }}"><span class="nav-label">OT</span></a>
        </li>
    </ul>
</li>
{{-- <li>
    <a href="#"><i class="fas fa-pen"></i><span class="nav-label">ขอ / ทำรายการ</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li>
            <a href="{{ route('worktime.index') }}"><span class="nav-label"></span></a>
        </li>
    </ul>
</li> --}}
<li>
    <a href="{{ route('request-work-time.approve') }}"><i class="fas fa-pen"></i> <span class="nav-label">อนุมัติรายการขอ</span></a>
</li>
<li>
    <a href="{{ route('request-work-time.index') }}"><i class="fas fa-pen"></i> <span class="nav-label">ขอ / ทำรายการ</span></a>
</li>
<li>
    <a href="#"><i class="fa fa-list"></i><span class="nav-label">รายงาน</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li>
            <a href="{{ route('report.ot') }}"><span class="nav-label">รายงาน</span></a>
        </li>
    </ul>
</li>
