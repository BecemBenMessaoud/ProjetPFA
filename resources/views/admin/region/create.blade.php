@extends('layout')

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

    <form @if(isset($region)) action="/admin/regions/update/{{$region->id}}" @else action="/admin/regions/store"
          @endif method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" placeholder="Name"
                   @if(isset($region)) value="{{$region->name}}" @endif>
        </div>

        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input name="postal_code" type="text" class="form-control" placeholder="Postal Code"
                   @if(isset($region)) value="{{$region->postal_code}}" @endif>
        </div>

        <button type="submit" class="btn btn-primary">@if(isset($region)) Update @else Save @endif</button>
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        $('li.regions').addClass('active')
    </script>
@endsection
