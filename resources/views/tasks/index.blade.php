@extends('layouts.app-master')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="bg-light p-5 rounded">
        @auth
        <h1>Blogs</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Blog</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Blogs</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                @if ($task->image)
                                    <img src="{{ asset('storage/images/' . $task->image) }}" alt="Task Image" class="img-fluid task-image">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endauth

        @guest
        <h1>Blog</h1>
        <p class="lead">Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection

