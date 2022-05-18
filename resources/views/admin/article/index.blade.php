
@extends('layout')

@section('title')
    Dons
@endsection



@section('content')
    <div style="margin-bottom: 20px">
        <h1 class="h3 mb-0 text-gray-800">Dons</h1>
    </div>

    <div class="row">
        @foreach($articles as $article)
            <div class="col col-lg-6" data-article-id= {{$article->id}}>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{$article->name}}</h6>
                            <div class="row" style="margin-right: 5px;">
                                <button class="btn btn-accept-article"><i class="fas fa-check"></i></button>
                                <button class="btn btn-refuse-article"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Category :</strong> {{$article->category->type}}</li>
                            <li><strong>State :</strong> {{$article->state}}</li>
                            <li><strong>Description :</strong> {{$article->description}}</li>
                        </ul>
                        @foreach($article->pictures as $picture)
                            <img height="50px" width="50px" src="/pictures/{{$picture->name}}">
                        @endforeach
                        <hr>

                        <ul>
                            <li><strong> Donation date : </strong>{{$article->created_at->format('d/m/Y H:i')}}</li>
                            <li><strong>Donated by : </strong>{{$article->user->getFullName() . ' ('. $article->user->email .')'}}</li>

                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $('li.articles').addClass('active')
    </script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{asset('js/article_admin.js')}}"></script>
@endsection


