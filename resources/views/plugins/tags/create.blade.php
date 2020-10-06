@extends('layouts.app', ['activePage' => 'details-management', 'titlePage' => __('Details Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{route('details.store')}}"  autocomplete="off"
                          class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-primary">



                                <h4 class="card-title">{{ __('Add Module detail') }}</h4>
                                <p class="card-category"> {{ __('Details are things like body parts,Objectives,Equipments e.tc') }}</p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger" style="display:none"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('details.index') }}"
                                           class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Detail name:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
{{--                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"--}}
{{--                                                   name="name" id="input-name" type="text"--}}
{{--                                                   placeholder="{{ __('detail name e.g Chair') }}" value="{{ old('name') }}"--}}
{{--                                                   required="true" aria-required="true"/>--}}

                                            <select name="name" class="form-control  {{ $errors->has('name') ? ' is-invalid' : '' }}" data-style="btn btn-link"  required>
                                                <option>Body Parts</option>
                                                <option>Equipment</option>
                                                <option>Exercise</option>
                                                <option>Movement</option>
                                                <option>Muscle</option>
                                                <option>Movement Class</option>
                                                <option>Objectives</option>
                                                <option>Position</option>
                                                <option>Specification</option>
                                                <option>Type</option>

                                            </select>
                                            @if ($errors->has('name'))
                                                <span id="name-error" class="error text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Tags:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('tags') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}" name="tags" id="input-tags" type="text" placeholder="{{ __('E.g Pelvis,Wall,Standing') }}" value="{{ old('name') }}" required="true" aria-required="true"/>
                                            @if ($errors->has('tags'))
                                                <span id="tags-error" class="error text-danger" >{{ $errors->first('tags') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" id="add_detail" class="btn btn-primary">{{ __('Add detail') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
