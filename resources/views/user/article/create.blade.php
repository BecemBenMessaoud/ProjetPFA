@extends('layout_user')

@section('title')
    Create article
@endsection

@section('content')
    <form action="/user/articles/store" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" placeholder="Name">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea rows="5" name="description" class="form-control" placeholder="Description"></textarea>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input name="state" type="text" class="form-control" placeholder="State">
        </div>

        <label for="category">Category</label>
        <select style="margin-bottom: 10px" class="form-control" name="category_id">
            <option>Choose category</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->getLabel()}} </option>
            @endforeach
        </select>

        @if ($errors->any())
            <div style="margin-bottom: 20px">
                <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>

        @endif

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
