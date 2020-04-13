@section('sidebar')
@hasrole('super-admin')
<li class="nav-item">
    <a href="{{route('pharmacies.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Pharmacies</p>
    </a>
</li>
@endhasrole

@hasanyrole('super-admin|pharmacy')
<li class="nav-item">
    <a href="{{route('doctors.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Doctors</p>
    </a>
</li>
@endhasanyrole

@hasrole('super-admin')
<li class="nav-item">
    <a href="{{route('areas.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Areas</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('clients.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Clients</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('userAddresses.index')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Client Addresses</p>
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
