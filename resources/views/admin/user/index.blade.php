@extends('layout')

@section('title')
    Clients
@endsection

@section('content')


    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 16.5%" scope="col">First Name</th>
            <th style="width: 16.5%" scope="col">Last Name</th>
            <th style="width: 16.5%" scope="col">Email</th>
            <th style="width: 16.5%" scope="col">Region</th>
            <th style="width: 16.5%" scope="col">Given articles</th>
            <th style="width: 16.5%" scope="col">Demands</th>
            <th style="width: 17.5%" scope="col">Actions</th>



        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)


            <tr>
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->region->name ?? '-'}}</td>
                <td>{{$user->givenArticles()->count()}}</td>
                <td>{{$user->demands->count()}}</td>
                <td>
                    <form style="margin-left: 5px" action="/admin/users/delete/{{$user->id}}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-danger btn btn-circle" type="submit">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection


@section('script')
    <script type="text/javascript">
        $('li.users').addClass('active')
    </script>
@endsection
