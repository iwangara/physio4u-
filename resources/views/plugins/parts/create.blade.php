@extends('layouts.app', ['activePage' => 'parts-management', 'titlePage' => __('Body Parts Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{route('parts.store')}}"  autocomplete="off"
                          class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-primary">



                                <h4 class="card-title">{{ __('Add a Body Part') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger" style="display:none"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('parts.index') }}"
                                           class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Part name:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" id="input-name" type="text"
                                                   placeholder="{{ __('Part name e.g Jaw') }}" value="{{ old('name') }}"
                                                   required="true" aria-required="true"/>
                                            @if ($errors->has('name'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>




                            </div>

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" id="add_client" class="btn btn-primary">{{ __('Add Part') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
