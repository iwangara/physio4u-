@extends('layouts.app', ['activePage' => 'patients-management', 'titlePage' => __('Patient Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#exampl').DataTable( {
                "stateSave": true,
                "ordering": true,
                "info":true,
                "paging":   true,
                "pagingType": "full_numbers"
            } );
        } );
            </script>
@endsection
