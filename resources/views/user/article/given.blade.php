@extends('layout_user')

@section('title')
    Given articles
@endsection

@section('content')
    <div style="margin-bottom: 20px">
        <h1 class="h3 mb-0 text-gray-800">Given articles</h1>
        <br>
        <h6>School Out Box thanks you for your contributions <i class="fas fa-heart"></i></h6>
    </div>


    <div class="row">
        @foreach($articles as $article)
            <div class="col col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{$article->name}}</h6>
                            {{-- TODO there's a problem with this condition, fix it --}}
                            @if($article->canEdit())
                                <div class="row">
                                    <button  onclick="window.location='/user/articles/edit/{{$article->id}}'" class="btn"><i class="fas fa-edit"></i></button>
                                    <form method="POST" action="/user/articles/delete/{{$article->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Description :</strong> {{$article->description}}</li>
                            <li><strong>State :</strong> {{$article->state}}</li>
                            <li><strong>Status :</strong> {{trans('global.article_status.' . $article->status)}}</li>
                        </ul>

                        @foreach($article->pictures as $picture)
                            <img height="50px" width="50px" src="/pictures/{{$picture->name}}">
                        @endforeach
                    </div>
                </div>
            </div>

        @endforeach
    </div>

@endsection
