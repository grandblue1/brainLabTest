@extends('admin.layout')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Dashboard</h1>
    <p>Welcome to the admin panel.</p>
    <div class="mb-3 d-flex">
        <form class="d-flex">
            <input type="text" name="name" class="form-control me-2" value="{{ $query['name'] ?? '' }}" placeholder="Name" style="flex: 1;" />
            <input type="email" name="email" class="form-control me-2" value="{{ $query['email'] ?? '' }}" placeholder="Email" style="flex: 2;" />
            <select class="form-control me-2" name="status" style="flex: 1;">
                <option value="">Select Status</option>
                <option value="active" {{ isset($query['status']) && $query['status'] === 'active' ? 'selected' : '' }}>Active</option>
                <option value="nonactive" {{ isset($query['status']) && $query['status'] === 'nonactive' ? 'selected' : '' }}>NonActive</option>
            </select>
            <button type="submit" class="btn btn-primary" style="flex: 0 0 auto;">Filter</button>
        </form>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Email</th>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <!-- Example row -->
        @foreach($users as $user)
            <tr>
                <td>{{ $user->email }}</td>
                <td>{{ $user->name }} </td>
                <td> {{ $user->status }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('admin.edit', $user->id) }}">Edit</a>
                    <a class="btn btn-danger" href="{{ route('admin.delete', $user->id) }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-success h-25" href="{{ route('admin.add') }}">Add</a>
        {{ $users->links() }}
    </div>
@endsection
