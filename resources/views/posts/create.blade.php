@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{isset($post) ? 'Edit Post' : 'Create Post'}}
        </div>
        <div class="card-body">
            <form
                action="{{!isset($post) ?
                    route('posts.store') :
                    route('posts.update', $post->id)}}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @if (isset($post))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control @error ('title') is-invalid @enderror"
                        value="{{isset($post) ? old('title') ? : $post->title : old('title')}}"
                        placeholder="{{isset($post) ? : 'Enter Title'}}"
                    >
                    @error ('title')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        cols="5"
                        rows="5"
                        class="form-control @error ('description') is-invalid @enderror"
                    >{{isset($post) ? old('description') ? : $post->description : old('description')}}</textarea>
                    @error ('description')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <input
                        id="content"
                        type="hidden"
                        name="post_content"
                        value="{{isset($post) ? old('post_content') ? : $post->content : old('post_content')}}"
                    >
                    <trix-editor input="content"></trix-editor>
                </div>

                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input
                        type="text"
                        name="published_at"
                        id="published_at"
                        class="form-control"
                        value="{{isset($post) ? old('published_at') ? : $post->published_at : old('published_at')}}"
                    >
                </div>

                @if (isset($post))
                    <div class="form-group">
                        <img src="{{asset('storage/posts/'.$post->image)}}" alt="" class="img-fluid rounded">
                    </div>
                @endif

                <div class="form-group">
                    <label for="image">Image</label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control-file @error ('image') is-invalid @enderror"
                    >
                    @error ('image')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="custom-select">
                        <option selected="">Select a Category</option>
                        @foreach ($categories as $category)
                            <option
                              value="{{$category->id}}"
                              @if (isset($post))
                              @if ($category->id == $post->category_id)
                              selected
                              @endif
                              @endif
                            >
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary" type="submit">
                    {{!isset($post) ? 'Add Post' : 'Update Post'}}
                </button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/trix.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop

@section('scripts')
    <script src="{{asset('js/trix.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true
        })
    </script>
@stop
