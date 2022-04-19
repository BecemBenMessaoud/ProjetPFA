@extends('layout_user')

@section('title')
    Picture article
@endsection


@section('content')
    <table style="width: 50%" class="table border">

        <tbody>
        <tr>
            <th>Category</th>
            <td>{{$article->category->getLabel()}}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{$article->name}}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{$article->description}}</td>
        </tr>
        <tr>
            <th>Status</th>

            <td>{{trans('global.article_status.' . $article->status)}}</td>
        </tr>
        <tr>
            <th>State</th>
            <td>{{$article->state}}</td>
        </tr>
        </tbody>
    </table>

    <div class="row" style="margin-bottom: 20px">
        @foreach($pictures as $picture )
            <div class="col justify-content-center">
                <div class="d-flex justify-content-center">
                    <img src="/pictures/{{$picture->name}}" height="200px" width="200px">
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <form action="/user/articles/picture/{{$picture->id}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <button onclick="window.location='/user/articles/given'" style="margin-bottom: 20px" class="btn btn-success">Done</button>

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

    <form action="/user/articles/picture/{{$article->id}}" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="file" name="picture" placeholder="Choose image"><br>

        <button style="margin-top: 20px" type="submit" class="btn btn-primary">Add picture</button>
    </form>


@endsection
