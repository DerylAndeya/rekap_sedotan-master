@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Form User</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Input Text</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="nama_user">User</label>
                        <input type="text" class="form-control" name="name" id="nama_user" value="{{ $user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" name="role" id="role" value="{{ $user->role }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="">
                        <small class="form-text text-muted">Leave blank if you don't want to change the password</small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                    </div>
                    <button type="submit" class="btn btn-primary col-1">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
