@extends('layout')

@section('title')
    Admins
@endsection

@section('content')
    <a style="margin-bottom: 25px" href="/admin/admins/create" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
        <span class="text">New Admin</span>
    </a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 16.5%" scope="col">First Name</th>
            <th style="width: 16.5%" scope="col">Last Name</th>
            <th style="width: 16.5%" scope="col">Email</th>
            <th style="width: 16.5%" scope="col">Region</th>
            <th style="width: 16.5%" scope="col">Role</th>
            <th style="width: 17.5%" scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($admins as $admin)


            <tr>
                <td>{{$admin->first_name}}</td>
                <td>{{$admin->last_name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->region->name ?? '-'}}</td>
                <td>{{$admin->isSuperAdmin() ? 'Super Administrator' : 'Administrator'}}</td>
                <td>
                    @if(!$admin->isDefaultSuperAdmin())
                        <div class="row d-flex justify-content-center">
                            <a style="margin-right: 5px" href="/admin/admins/edit/{{$admin->id}}"
                               class="btn btn-warning btn-circle">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form style="margin-left: 5px" action="/admin/admins/delete/{{$admin->id}}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger btn btn-circle" type="submit">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endif


                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection

@section('script')
    <script type="text/javascript">
        $('li.admins').addClass('active')
    </script>
@endsection
