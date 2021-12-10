@extends('layouts.admin_app')

@section('content')

<br>
<div class="tab-pane" id="change_password">
    <form class="form-horizontal" action="{{ route('adminChangePassword') }}" method="POST" id="changePasswordAdminForm">
        <div class="form-group row">
        <label for="inputName" class="col-sm-2 col-form-label">Old Passord</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="oldpassword" placeholder="Enter current password" name="oldpassword">
            <span class="text-danger error-text oldpassword_error"></span>
        </div>
        </div><br>
        <div class="form-group row">
        <label for="inputName2" class="col-sm-2 col-form-label">New Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="newpassword" placeholder="Enter new password" name="newpassword">
            <span class="text-danger error-text newpassword_error"></span>
        </div>
        </div><br>
        <div class="form-group row">
        <label for="inputName2" class="col-sm-2 col-form-label">Confirm New Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="cnewpassword" placeholder="ReEnter new password" name="cnewpassword">
            <span class="text-danger error-text cnewpassword_error"></span>
        </div>
        </div>
        <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-danger">Update Password</button>
        </div>
        </div>
    </form>
    </div>
</div>

@include('dashboards/profile_script')  
 @endsection