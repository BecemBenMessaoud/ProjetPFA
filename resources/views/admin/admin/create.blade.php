@extends('layout')

@section('title')
    @if(isset($admin))
        Edit admin
    @else
        Create admin
    @endif
@endsection

@section('content')

    <form @if(isset($admin)) action="/admin/admins/update/{{$admin->id}}" @else action="/admin/admins/store"
          @endif method="POST">
        @csrf
        <div class="form-group">
            <label for="first_name">First name</label>
            <input @if(isset($admin)) disabled @endif name="first_name" type="text" class="form-control"
                   placeholder="First name"
                   @if(isset($admin)) value="{{$admin->first_name}}" @endif>
        </div>

        <div class="form-group">
            <label for="last_name">Last name</label>
            <input @if(isset($admin)) disabled @endif name="last_name" type="text" class="form-control"
                   placeholder="Last name"
                   @if(isset($admin)) value="{{$admin->last_name}}" @endif>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input @if(isset($admin)) disabled @endif name="email" type="email" class="form-control" placeholder="Email"
                   @if(isset($admin)) value="{{$admin->email}}" @endif>
        </div>

        <label for="is_superadmin">Role</label>
        <select class="form-control role" name="is_superadmin">
            <option>Choose role</option>
            <option @if(isset($admin)) @if(!$admin->isSuperAdmin()) selected @endif @endif value="0">Administrator
            </option>
            <option @if(isset($admin)) @if($admin->isSuperAdmin()) selected @endif @endif value="1">Super
                Administrator
            </option>
        </select>

        <label class="region_id" for="region_id">Region</label>
        <select class="form-control region_id" name="region_id">
            <option>Choose region</option>
            @foreach($regions as $region)
                <option @if(isset($admin)) @if($admin->region_id==$region->id) selected
                        @endif @endif value="{{$region->id}}">{{$region->name}}</option>
            @endforeach
        </select>


        @if ($errors->any())
            <div style="margin-top: 20px">
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

        <button style="margin-top: 20px" type="submit" class="btn btn-primary">@if(isset($admin)) Update @else
                Save @endif</button>
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        $('li.admins').addClass('active')
    </script>
@endsection
