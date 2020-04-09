<!-- @hasrole('super-admin') -->

@section('sidebar')
@hasrole('super-admin')
<li class="nav-item">
    <a href="{{route('admin.pharmacies.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Pharmacies</p>
    </a>
</li>
@endhasrole

@hasanyrole('super-admin|pharmacy')
<li class="nav-item">
    <a href="{{route('pharmacies.doctors.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Doctors</p>
    </a>
</li>
@endhasanyrole

@hasrole('super-admin')
<li class="nav-item">
    <a href="{{route('admin.areas.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Areas</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.clients.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Users</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.userAddresses.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>User Addresses</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('medicines.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Medicines</p>
    </a>
</li>
@endhasrole

@hasanyrole('super-admin|pharmacy|doctor')
<li class="nav-item">
    <a href="{{route('orders.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Orders</p>
    </a>
</li>
@endhasanyrole

@hasanyrole('super-admin|pharmacy')
<li class="nav-item">
    <a href="{{route('revenues.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Revenues</p>
    </a>
</li>
@endhasanyrole

@stop

<!-- @endhasrole

@hasrole('pharmacy')

@section('sidebar')
<li class="nav-item">
    <a href="{{route('orders.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Orders</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('pharmacies.doctors.show')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Doctors</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('revenues.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Revenues</p>
    </a>
</li>
@stop

@endhasrole

@hasrole('doctor')
@section('sidebar')

<li class="nav-item">
    <a href="{{route('orders.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Orders</p>
    </a>
</li>

@stop
@endhasrole -->
