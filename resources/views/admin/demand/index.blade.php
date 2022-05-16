@extends('layout')

@section('title')
    Demands
@endsection


@section('style')
    <style>
        .error {
            width: 100%;
            color: red;
            font-size: 15px;
            line-height: 1.5;
            border-color: red;
        }
    </style>
@endsection

@section('content')
    <div style="margin-bottom: 20px">
        <h1 class="h3 mb-0 text-gray-800">Demands</h1>
    </div>

    <div class="row">
        @foreach($demands as $demand)
            <div class="col col-lg-6" data-demand-id= {{$demand->id}}>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{$demand->article->name}}</h6>
                            <div class="row" style="margin-right: 5px;">
                                <button class="btn btn-accept-demand"><i class="fas fa-check"></i></button>
                                <button class="btn btn-refuse-demand"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Description :</strong> {{$demand->article->description}}</li>
                            <li><strong>Motive :</strong> {{$demand->motive}}</li>
                            <li><strong>State :</strong> {{$demand->article->state}}</li>
                        </ul>
                        @foreach($demand->article->pictures as $picture)
                            <img height="50px" width="50px" src="/pictures/{{$picture->name}}">
                        @endforeach
                        <hr>

                        <ul>
                        <li><strong>Requested by : </strong>{{$demand->user->getFullName() . ' ('. $demand->user->email .')'}}</li>
                        <li><strong>Demand date : </strong>{{$demand->created_at->format('d/m/Y H:i')}}</li>
                        <li class="li-motive"><strong>Motive : </strong>{{$demand->getMotive()}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{asset('js/requested_admin.js')}}"></script>
@endsection
