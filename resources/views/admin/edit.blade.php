@extends('admin.layout')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.update', $user->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select id="status" name="status" class="form-select" required>
                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="nonactive" {{ $user->status == 'nonactive' ? 'selected' : '' }}>Non-Active</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Profile Image:</label>
            <div class="input-group">
            <span class="input-group-btn" style="margin-right: 15px">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
                <input id="thumbnail" class="form-control" type="text" name="image" value="{{ $user->image }}">
            </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
        </div>
        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var route_prefix = "/laravel-filemanager";
            $('#lfm').filemanager('image', {prefix: route_prefix});
        });
    </script>
@endsection
