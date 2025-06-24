@extends('backend.layouts.master')
@section('main-content')
<div class="card">
    <h5 class="card-header">Change Password for {{$user->name}}</h5>
    <div class="card-body">
        <form method="POST" action="{{ route('auser.users.update-password', $user->id) }}">
            @csrf

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="current_password" class="col-form-label">Current Password</label>
                <input id="current_password" type="password" name="current_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password" class="col-form-label">New Password</label>
                <input id="new_password" type="password" name="new_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_confirm_password" class="col-form-label">Confirm New Password</label>
                <input id="new_confirm_password" type="password" name="new_confirm_password" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <button class="btn btn-success" type="submit">Update Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
