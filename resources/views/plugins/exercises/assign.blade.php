@extends('layouts.app', ['activePage' => 'exercises-management', 'titlePage' => __('Exercises Management')])

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post"  id="patient_form" autocomplete="off"
                          class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-success">



                                <h4 class="card-title">Assign {{$exercise}} to a patient</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-12">--}}
{{--                                        <div class="alert alert-danger" style="display:none"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="row">

                                    <div class="col-sm-12">
                                        @if ($errors->has('error'))
                                            <span id="weight-error" class="error text-danger" for="input-error">{{ $errors->first('error') }}</span>
                                        @endif
                                        <div class="alert alert-danger" style="display:none"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('exercises.index') }}"
                                           class="btn btn-sm btn-warning">{{ __('Back to list') }}</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Patient Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('patient_id') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id" id="patient_id" type="text" placeholder="{{ __('Search Patient by name') }}" value="{{ old('patient_id') }}" required />
                                            <input type="text" id='employeeid' hidden>
                                            <input type="text" id='exercise_id' value="{{app('request')->route('id')}}" hidden>
                                            @if ($errors->has('patient_id'))
                                                <span id="patient_id-error" class="error text-danger" for="input-patient_id">{{ $errors->first('patient_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer ml-auto mr-auto">
                                <button type="button" id="add_patient" class="btn btn-primary">{{ __('Add Patient') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ $patients->total() }} {{str_plural('Patient',$patients->count())}}</h4>
                            <p class="card-category">{{str_plural('Patient',$patients->count())}} {{ __(' List') }}</p>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12 text-right">
                                    @can('add_patients')
                                        <a href="{{ route('patients.create') }}" class="btn btn-sm btn-primary">{{ __('Add patient') }}</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="exampl">
                                    <thead class=" text-primary">
                                    <th>
                                        {{ __('#') }}
                                    </th>
                                    <th>
                                        {{ __('Name') }}
                                    </th>
                                    <th>
                                        {{ __('Email') }}
                                    </th>
                                    <th>
                                        {{ __('Gender') }}
                                    </th>
                                    <th>
                                        {{ __('Age') }}
                                    </th>
                                    <th>
                                        {{ __('Phone') }}
                                    </th>
                                    <th>
                                        {{ __('Location') }}
                                    </th>
                                    <th>
                                        {{ __('Added by') }}
                                    </th>
                                    <th class="text-right">
                                        @can('edit_patients','delete_patients')
                                            {{ __('Actions') }}
                                        @endcan
                                    </th>
                                    </thead>
                                    <tbody>
                                    @if($patients->total()>0)
                                        @foreach($patients as $index=>$patient)
                                            <tr>
                                                <td>
                                                    <strong>{{ $index+1 }}.</strong>
                                                </td>
                                                <td>
                                                    <a href="{{ route('patients.show', $patient) }}">{{ $patient->user->name}}</a>

                                                </td>
                                                <td>
                                                    {{ $patient->user->email }}
                                                </td>
                                                <td>
                                                    {{ $patient->gender }}
                                                </td>
                                                <td>
                                                    {{ $patient->age }}
                                                </td>
                                                <td>
                                                    {{ $patient->user->phone }}
                                                </td>
                                                <td>
                                                    {{ $patient->address }}
                                                </td>
                                                <td>
                                                    {{ $patient->created_by }}
                                                </td>
                                                <td class="td-actions text-right">
                                                    {{--                              @include('shared._actions', ['entity' => 'patients','id'=>$patients->id])--}}

                                                    <form action="{{ route('patients.update', $patient) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        @can('edit_patients')
                                                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('patients.edit', $patient) }}" data-original-title="" title="">
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        @endcan
                                                        @can('delete_patients')
                                                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">close</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        @endcan
                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach
                                        {{$patients->links()}}
                                    @else
                                        <td>
                                            <p>No patient created at the moment</p>
                                        </td>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#exampl').DataTable( {
                "stateSave": true,
                "ordering": true,
                "info":true,
                "paging":   true,
                "pagingType": "full_numbers"
            } );
            $( "#patient_id" ).autocomplete({
                source: function( request, response ) {
                    // Fetch data
                    $.ajax({
                        url:"{{route('patients.getPatients')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term
                        },
                        success: function( data ) {
                            response( data );
                            console.log(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#patient_id').val(ui.item.label); // display the selected text
                    $('#employeeid').val(ui.item.value); // save selected id to input
                    return false;
                }
            });

            $("#add_patient").click(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var formData = {
                    exercise_id: jQuery('#exercise_id').val(),
                    user_id: jQuery('#employeeid').val(),

                };

                var type = "POST";
                var ajaxurl = '{{route('projects.store')}}';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    success: function (response) {
                        if(response.success){
                            // jQuery('.alert-danger').show();
                            // jQuery('.alert-danger').append('<p>'+response.message+'</p>');

                                swal({
                                    title: "Success!!",
                                    text: response.message,
                                    type: "success",
                                    showConfirmButton: false,

                            });

                            // alert(response.message) //Message come from controller
                        }else{
                            alert("Error")
                        }
                        console.log(response);


                    },
                    error:function(error){
                        console.log(error)
                    },
                    complete:setTimeout(function() {
                        window.location.href ='{{route('exercises.index')}}';
                    }, 1500)
                });

            });
        } );
    </script>


@endsection
