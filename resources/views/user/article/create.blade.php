@extends('layout_user')

@section('title')
    @if(isset($article))
        Edit Article
    @else
        Create article
    @endif
@endsection

@section('content')
    <form @if(isset($article)) action="/user/articles/update/{{$article->id}}" @else action="/user/articles/store"
          @endif method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" placeholder="Name"
                   @if(isset($article)) value="{{$article->name}}" @endif>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea rows="5" name="description" class="form-control"
                      placeholder="Description">{{isset($article) ? $article->description : ''}}</textarea>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input name="state" type="text" class="form-control" placeholder="State" @if(isset($article)) value="{{$article->state}}" @endif>
        </div>

        <label for="category">Category</label>
        <select style="margin-bottom: 10px" class="form-control" name="category_id">
            <option>Choose category</option>
            @foreach($categories as $category)
                <option @if(isset($article)) @if($article->category->id === $category->id) selected @endif @endif value="{{$category->id}}">{{$category->getLabel()}} </option>
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

        <button type="submit" class="btn btn-primary">@if(isset($article)) Update @else Save @endif</button>
    </form>
@endsection
