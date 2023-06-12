
<head>
<title>Create </title>
</head>
<h1>Create Blog</h1>

<form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Name</label>
        <input type="text" name="title" id="title" class="form-control  @error('title') is-invalid @enderror" value="{{ old('title') }}"required>
        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"rows="4" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
