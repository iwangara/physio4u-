@extends('layouts.app', ['activePage' => 'modules-management', 'titlePage' => __('Modules Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ $modules->total() }} {{str_plural('Module',$modules->count())}}</h4>
                            <p class="card-category"> {{ __('Here you can manage Modules(Example Aqua therapy )') }}</p>
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
                                    @can('add_modules')
                                        <a href="{{ route('modules.create') }}" class="btn btn-sm btn-primary">{{ __('Add Module') }}</a>
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
                                        {{ __('Added by') }}
                                    </th>
                                    <th class="text-right">
                                        @can('edit_modules','delete_modules')
                                            {{ __('Actions') }}
                                        @endcan
                                    </th>
                                    </thead>
                                    <tbody>
                                    @if($modules->total()>0)
                                        @foreach($modules as $index=>$module)
                                            <tr>
                                                <td>
                                                    <strong>{{ $index+1 }}.</strong>
                                                </td>
                                                <td>
                                                    {{ $module->name }}
                                                </td>

                                                <td>
                                                    {{ $module->created_by }}
                                                </td>
                                                <td class="td-actions text-right">
                                                    {{--                              @include('shared._actions', ['entity' => 'modules','id'=>$module->id])--}}

                                                    <form action="{{ route('modules.update', $module) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        @can('edit_modules')
                                                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('modules.edit', $module) }}" data-original-title="" title="">
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        @endcan
                                                        @can('delete_modules')
                                                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">close</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        @endcan
                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach
                                        {{$modules->links()}}
                                    @else
                                        <td>
                                            <p>No modules created at the moment</p>
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
