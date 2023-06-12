
<h1>Edit BLog</h1>

<form action="{{ route('tasks.update', $task) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Name</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" required>{{ $task->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control-file">
        @if ($task->image)
            <img src="{{ asset('storage/images/' . $task->image) }}" alt="Task Image" class="img-fluid mt-2">
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<style>
    .task-image {
        max-width: 100px; 
        height: auto;
    }
</style>
