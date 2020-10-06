@extends('layouts.app', ['activePage' => 'exercises-management', 'titlePage' => __('exercises Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post"  action="{{route('exercises.update',$exercises->id)}}" autocomplete="off"
                          class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card ">
                            <div class="card-header card-header-primary">



                                <h4 class="card-title">{{ __('Edit exercise') }}</h4>
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
                                        <a href="{{ route('exercises.index') }}"
                                           class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('exercise Name:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" id="input-name" type="text"
                                                   placeholder="{{ __('exercise Name') }}" value="{{ old('name',$exercises->name) }}"
                                                   required="true" aria-required="true"/>
                                            @if ($errors->has('name'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Description:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                name="description" id="input-description" type="text"
                                                placeholder="{{ __('Exercise description') }}"
                                                value="{{ old('description',$exercises->description) }}"
                                                required="true" aria-required="true"/>
                                            @if ($errors->has('description'))
                                                <span id="description-error" class="error text-danger"
                                                      for="input-description">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Instructions:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('instruction') ? ' has-danger' : '' }}">
                                            <textarea
                                                class="form-control{{ $errors->has('instruction') ? ' is-invalid' : '' }}"
                                                name="instruction" id="input-instruction" type="text"
                                                placeholder="{{ __('Exercise instruction') }}"
                                                value="{{ old('instruction') }}"
                                                required="true" aria-required="true" value="{{ old('instruction',$exercises->instructions) }}" rows="3">{{$exercises->instruction}}</textarea>
                                            @if ($errors->has('instruction'))
                                                <span id="instruction-error" class="error text-danger"
                                                      for="input-instruction">{{ $errors->first('instruction') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <label class="col-sm-2 col-form-label">{{ __('Modules:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('modules') ? ' has-danger' : '' }}">

                                            {{--                                            {!! Form::select('modules[]', $equips->tagList, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control', 'multiple']) !!}--}}
                                            {{--                                            {!! Form::select('product_id', $groups, 1, ['class' => 'form-control']) !!}--}}

                                            {!! Form::select('modules', $equips, $exercises->modules, ['class' => 'form-control']) !!}
                                            @if ($errors->has('modules'))
                                                <span id="modules-error" class="error text-danger"
                                                      for="input-modules">{{ $errors->first('modules') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"  class="btn btn-primary">{{ __('Update exercise') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
