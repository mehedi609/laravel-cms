@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('categories.create')}}" class="btn btn-success float-right">
            Create Category
        </a>
    </div>
    <div class="card">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            @if (count($categories) > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Post Counts</th>
                    <th>Actions</th>
                    </thead>

                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{count($category->posts)}}</td>
                            <td>
                                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info">
                                    Edit
                                </a>
                                <a href="#"
                                   class="btn btn-danger"
                                   data-toggle="modal"
                                   data-target="#delete-modal"
                                >
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade" id="delete-modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Todo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="document.querySelector('#delete-form').submit()">Proceed</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" id="delete-form" action="{{route('categories.destroy',$category->id)}}">
                    @csrf
                    @method('DELETE')
                </form>
            @else
                <h5 class="text-center">No Records found!</h5>
            @endif
        </div>
    </div>
@stop
