@extends('layout')

@section('title')
    Regions
@endsection

@section('content')
    <a style="margin-bottom: 25px" href="/admin/regions/create" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
        <span class="text">New region</span>
    </a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 20%" scope="col">Name</th>
            <th style="width: 20%" scope="col">Postal code</th>
            <th style="width: 20%" scope="col">Customers</th>
            <th style="width: 20%" scope="col">Admins</th>
            <th style="width: 20%; text-align: center" scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($regions as $region)
            <tr>
                <td>{{$region->name}}</td>
                <td>{{$region->postal_code}}</td>
                <td>{{$region->users_count}}</td>
                <td>{{$region->admins_count}}</td>
                <td>
                    <div class="row d-flex justify-content-center">
                        <a style="margin-right: 5px" href="/admin/regions/edit/{{$region->id}}" class="btn btn-warning btn-circle">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form style="margin-left: 5px" action="/admin/regions/delete/{{$region->id}}" method="POST">
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
        $('li.regions').addClass('active')
    </script>
@endsection
