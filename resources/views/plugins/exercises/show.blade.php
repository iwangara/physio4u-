@extends('layouts.app', ['activePage' => 'exercises-management', 'titlePage' => __('Exercises Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">


                        <div class="card ">
                            <div class="card-header card-header-primary">


                                <h4 class="card-title">{{ $exercise->name }}</h4>
                                {{--                                <p class="card-category"> {{ __('You can separate them using a comma e.g Chair,Ball') }}</p>--}}
                            </div>
                            <div class="card-body ">

                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('exercises.index') }}"
                                           class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h3>
                                            <small>Media</small>
                                        </h3>
                                        <!-- Tabs with icons on Card -->
                                        <div class="card card-nav-tabs">
                                            <div class="card-header card-header-warning">
                                                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                                <div class="nav-tabs-navigation">
                                                    <div class="nav-tabs-wrapper">
                                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" href="#photos"
                                                                   data-toggle="tab">
                                                                    <i class="material-icons">camera_alt</i>
                                                                    Photos
                                                                </a>
                                                            </li>

                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#videos" data-toggle="tab">
                                                                    <i class="material-icons">videocam</i>
                                                                    Video
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body ">
                                                <div class="tab-content text-center">
                                                    <div class="tab-pane active" id="photos">

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <h4>
                                                                    <small>Start</small>

                                                                </h4>
                                                                <b class="caret"></b>
                                                                <div class="col-sm-6">
                                                                    <div class="">

                                                                        <img class="rounded " src="{{ $exercise->getMedia('exercises')[0]->getUrl('thumb')}}" alt="">
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="col-sm-6">
                                                                <h4>
                                                                    <small>End</small>
{{--                                                                    @if ($errors->has('start'))--}}
{{--                                                                        <span id="end-error" class="error text-danger"--}}
{{--                                                                              for="input-modules">{{ $errors->first('end') }}</span>--}}
{{--                                                                    @endif--}}
                                                                </h4>
                                                                <b class="caret"></b>
                                                                <div class="col-sm-6">
                                                                    <div class="">
                                                                        @if(count($exercise->getMedia('exercises'))>1)
                                                                        <img class="rounded float-right " src="{{ $exercise->getMedia('exercises')[1]->getUrl('thumb')}}" alt="">
                                                                            @endif
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="videos">
                                                        <div class="col-sm-6">
                                                            <div class="embed-responsive embed-responsive-1by1 align-items-center">

                                                                @if(count($exercise->getMedia('exercises'))==1)
                                                                <video class="embed-responsive-item" src="{{ $exercise->getMedia('exercises')[0]->getUrl()}}" controls></video>
                                                                    @elseif(count($exercise->getMedia('exercises'))==2)
                                                                    <video class="embed-responsive-item" src="{{ $exercise->getMedia('exercises')[1]->getUrl()}}" controls></video>
                                                                    @elseif(count($exercise->getMedia('exercises'))==3)
                                                                    <video class="embed-responsive-item"  src="{{ $exercise->getMedia('exercises')[2]->getUrl()}}" controls></video>
                                                                    @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Tabs with icons on Card -->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card" style="width: 16rem;">
                                            <div class="card-body">
                                                <h5 class="card-title">Title: </h5><h6>{{$exercise->name}}</h6>
                                                <h5 class="card-subtitle mb-2 text-muted">Description:  </h5><h6>{{$exercise->description}}</h6>
                                                <h5 class="card-subtitle mb-2 text-muted">Instruction:</h5>
                                                <p class="card-text"> {{$exercise->instruction}} .</p>
{{--                                                <a href="#" class="card-link">Card link</a>--}}
{{--                                                <a href="#" class="card-link">Another link</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

{{--                            <div class="card-footer ml-auto mr-auto">--}}
{{--                                <button type="submit" id="add_client"--}}
{{--                                        class="btn btn-primary">{{ __('Add exercise') }}</button>--}}
{{--                            </div>--}}
                        </div>

                </div>
            </div>
        </div>
    </div>

@endsection
