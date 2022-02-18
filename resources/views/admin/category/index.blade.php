@extends('layout')

@section('title')
    Categories
@endsection

@section('content')
    <a style="margin-bottom: 25px" href="/admin/categories/create" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
        <span class="text">New Category</span>
    </a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 33%" scope="col">Type</th>
            <th style="width: 33%" scope="col">Level</th>
            <th style="width: 33%" scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)


            <tr>
                <td>{{$category->type}}</td>
                {{-- if level not null show level else show all --}}
                <td>{{\App\Models\Category::getLevelLabel($category->level)}}</td>
                <td>
                    <div class="row d-flex justify-content-center">
                        <a style="margin-right: 5px" href="/admin/categories/edit/{{$category->id}}"
                           class="btn btn-warning btn-circle">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form style="margin-left: 5px" action="/admin/categories/delete/{{$category->id}}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-danger btn btn-circle" type="submit">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>


                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection

@section('script')
    <script type="text/javascript">
        $('li.categories').addClass('active')
    </script>
@endsection
