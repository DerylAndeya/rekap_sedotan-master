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
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama_user">Nama</label>
                        <input type="text" class="form-control" name="name" id="nama_user">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="select" class="form-control" name="role" id="role">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="passcon">Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation" id="passcon">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <button type="submit" class="btn btn-primary col-1">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
