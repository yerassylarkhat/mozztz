@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-4 ">
                    <div class="text-center">
                    @if($post->preview)
                        <img src="{{ asset($post->preview) }}" alt="Post Preview" class="img-fluid mb-3"style="max-width: 430px; max-height: 300px; width: auto; height: auto" >
                    @else
                        <img src="{{ asset('images/default-post-image.png') }}" alt="Default Preview" class="img-fluid mb-3">
                    @endif
                    </div>
                        <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text">{{ $post->content }}</p>
                    </div>
                    <div class="card-footer">
                        @if(auth()->user()->role == \App\Enums\Role::MODERATOR || auth()->user()->role == \App\Enums\Role::ADMIN)
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editPostModal">Edit</button>
                        @endif

                        @if(auth()->user()->role == \App\Enums\Role::ADMIN)
                        <form action="{{ route('post_delete', $post->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editPostForm" action="{{ route('post_edit', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit-title">Title</label>
                            <input type="text" class="form-control" id="edit-title" name="title" value="{{ $post->title }}">
                        </div>
                        <div class="form-group">
                            <label for="edit-content">Content</label>
                            <textarea class="form-control" id="edit-content" name="content">{{ $post->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-category">Categories</label>
                            <select class="form-control" id="edit-category" name="category_ids[]" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-preview">Preview Image</label>
                            <input type="file" class="form-control-file" id="edit-preview" name="preview">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="edit-status" name="status">
                            <label class="form-check-label" for="edit-status">Set as Draft</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
