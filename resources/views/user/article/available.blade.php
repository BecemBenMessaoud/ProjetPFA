@extends('layout_user')

@section('title')
    Available articles
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
        <h1 class="h3 mb-0 text-gray-800">Available articles</h1>
    </div>

    <div class="row">
        @foreach($articles as $article)
            <div class="col col-lg-6" data-article-id= {{$article->id}}>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{$article->name}}</h6>
                            <div class="row" style="margin-right: 5px;">
                                <button class="btn btn-demand"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Description :</strong> {{$article->description}}</li>
                            <li><strong>State :</strong> {{$article->state}}</li>
                        </ul>
                        @foreach($article->pictures as $picture)
                            <img height="50px" width="50px" src="/pictures/{{$picture->name}}">
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="motive-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">State your motive</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="demand-form">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Motive :</label>
                            <textarea rows="5" id="motive-text" name="motive" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="submit-demand" type="button" class="btn btn-primary">Submit demand</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{asset('js/available.js')}}"></script>
@endsection
