@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-end mb-3">
    <a href="{{route('posts.create')}}" class="btn btn-success float-right">
      Create Post
    </a>
  </div>
  <div class="card">
    <div class="card-header">
      Posts
    </div>
    <div class="card-body">
      @if (count($posts) > 0)
        <table class="table">
          <thead>
          <th>Image</th>
          <th>Title</th>
          <th>Category</th>
          <th>Actions</th>
          </thead>

          <tbody>
          @foreach ($posts as $post)
            <tr>
              <td>
                <img
                  src="{{asset('storage/posts/'.$post->image)}}"
                  alt="title image"
                  class="img-fluid rounded"
                  width="100px"
                  height="50px"
                >
              </td>
              <td>{{$post->title}}</td>
              <td>
                <a href="{{route('categories.edit', $post->category->id)}}">
                  {{$post->category->name}}
                </a>
              </td>
              <td>
                @if ($post->trashed())
                  <button
                    class="btn btn-info"
                    data-toggle="modal"
                    data-target="#restore-modal"
                  >
                    Restore
                  </button>
                @else
                  <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info">
                    Edit
                  </a>
                @endif
                <button
                  class="btn btn-danger"
                  data-toggle="modal"
                  data-target="#delete-modal"
                >
                  {{$post->trashed() ? 'Delete' : 'Trash'}}
                </button>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>

        <div class="modal fade" id="delete-modal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Delete Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Do you want to delete?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        onclick="event.preventDefault(); document.querySelector('#delete-form').submit()">Proceed
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
        <form method="POST" id="delete-form" action="{{route('posts.destroy',$post->id)}}">
          @csrf
          @method('DELETE')
        </form>

        {{--Restore Post Modal--}}
        <div class="modal fade" id="restore-modal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Restore Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Do you want to Restore this Post?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        onclick="event.preventDefault(); document.querySelector('#restore-form').submit()">Proceed
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
        <form method="POST" id="restore-form" action="{{route('posts.restore',$post->id)}}">
          @csrf
          @method('PUT')
        </form>
      @else
        <h5 class="text-center">No posts found!</h5>
      @endif
    </div>
  </div>
@stop
