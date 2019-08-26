@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{isset($category) ? 'Edit Category' : 'Create Category'}}
        </div>
        <div class="card-body">
            <form
                action="{{!isset($category) ?
                    route('categories.store') :
                    route('categories.update', $category->id)}}"
                method="POST"
            >
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error ('name') is-invalid @enderror"
                        value="{{isset($category) ? old('name') ? : $category->name : old('name')}}"
                        placeholder="{{isset($category) ? : 'Enter Title'}}"
                    >
                    @error ('name')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">
                    {{!isset($category) ? 'Add Category' : 'Update Category'}}
                </button>
            </form>
        </div>
    </div>
@stop
