@extends('layout_guest')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="first_name" class="col-md-4 col-form-label text-md-end">First Name</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" name="first_name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="last_name" class="col-md-4 col-form-label text-md-end">Last Name</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>

                                <div class="col-md-6">
                                    <textarea id="address" name="address" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="region_id" class="col-md-4 col-form-label text-md-end">Region</label>

                                <div class="col-md-6">
                                    <select class="form-control " name="region_id">
                                        <option>Choose Region</option>
                                        @foreach($regions as $region)
                                            <option value="{{$region->id}}">{{$region->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="level"  class="col-md-4 col-form-label text-md-end">Level</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="level">
                                        <option>Choose Level</option>
                                        @foreach(\App\Models\Category::getLevels() as $level)
                                            <option value="{{$level}}">{{\App\Models\Category::getLevelLabel($level)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>


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

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button style="margin-top:20px" type="submit" class="btn btn-primary">
                                         Create Account
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
