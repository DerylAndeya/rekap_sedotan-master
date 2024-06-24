@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>LIST USER</h4>
                    <div class="card-header-action">
                        <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah Baru</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($users)
                                    @foreach ($users as $u)
                                        <tr>
                                            <td>{{ $u->id }}</td>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->role }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>
                                                <a href="{{ route('user.edit', $u) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title=""
                                                    data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{ route('user.destroy', ['user' => $u]) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

