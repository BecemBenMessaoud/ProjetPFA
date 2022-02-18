@extends('layout')

@section('title')
    @if(isset($category))
        Edit category
    @else
        Create category
    @endif
@endsection

@section('content')

    @if ($errors->any())
        <div>
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

    <form @if(isset($category)) action="/admin/categories/update/{{$category->id}}" @else action="/admin/categories/store"
          @endif method="POST">
        @csrf
        <div class="form-group">
            <label for="type">Type</label>
            <input name="type" type="text" class="form-control" placeholder="Type"
                   @if(isset($category)) value="{{$category->type}}" @endif>
        </div>


        <label for="level">Level</label>
        <select class="form-control" name="level">
            @foreach(\App\Models\Category::getLevels() as $level)
                <option value="{{$level}}">{{\App\Models\Category::getLevelLabel($level)}}</option>
            @endforeach
        </select>


        <button style="margin-top: 20px" type="submit" class="btn btn-primary">@if(isset($category)) Update @else Save @endif</button>
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        $('li.categories').addClass('active')
    </script>
@endsection
