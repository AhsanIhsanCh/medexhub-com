@php
use Carbon\Carbon;    
@endphp
@extends('admin.assets.adminlayout')
@section('content')
    <div class="container-fluid">
<!-- Page Heading -->
<div class='row align-items-center justify-content-between pt-3 mb-3'>
    <div class='col-auto mb-0 h3 text-gray-800'>User</div>
    <div class='col-12 col-xl-auto mb-0'>
        <a href="main.php?ab=2&p=2&record=7" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-users-cog fa-sm text-white-50"></i>&nbsp;&nbsp;Show All Users</a>
        <button type='button' id="addUserModal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-users-cog fa-sm text-white-50"></i>Add User</button>
    </div>
</div>    
{{-- @if(session('success'))
    <div class="successAlert">
        {{ session('success') }}
    </div>
@endif --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr #</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Jion IP</th>
                            <th>User Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sr #</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Jion IP</th>
                            <th>User Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($Users as $User)
                            @php
                                $ResUT = DB::table('user_types')->select('ut_color', 'ut_name')->where('ut_id', $User->u_ut_id)->get();
                                $UserTypeColor = $ResUT->first()->ut_color ?? '#000000';
                                $UserTypeName = $ResUT->first()->ut_name ?? 'Null';
                                if($User->u_jionip == "0.0.0.0") $ShowIp = "<span style='color:#f00;'>Admin Added</span>"; else $ShowIp = $User->u_jionip;
                                $JionDate = Carbon::parse($User->u_jiontimedate)->format('F j, Y, g:i A'); // August 15, 2025, 2:30 PM
                            @endphp 
                            <tr>
                                <td style='text-align: center;'>{{$loop->iteration}}</td>
                                <td>{{$User->email}}</td>
                                <td>{{$User->u_fname}} {{$User->u_lname}}</td>
                                <td style='text-align:center;'>{!! $ShowIp !!}</td>
                                <td style='text-align:center;color:{{$UserTypeColor}}'>{{$UserTypeName}}</td>
                                <td>{{ $JionDate }}</td>
                                <td style='text-align:center;'>
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#userModal{{ $User->id }}"><i class="fas fa-comment-alt-edit"></i></button>
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#viewModal{{ $User->id }}"><i class="fas fa-eye"></i></button>
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#sendPassModal{{ $User->id }}"><i class="fas fa-paper-plane"></i></button>    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
// Get elements
const modal = document.getElementById('myModal');
const openLink = document.getElementById('addUserModal');
const closeBtn = document.querySelector('.close');
// Open modal
openLink.onclick = function(event) {
  event.preventDefault(); // Prevent default link behavior
  modal.style.display = 'block';
}
// Close modal when clicking the X
closeBtn.onclick = function() {
  modal.style.display = 'none';
}
</script>
@endsection