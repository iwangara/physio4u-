@extends('layouts.app', ['activePage' => 'details-management', 'titlePage' => __('Details Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ $details->total() }} {{str_plural('detail',$details->count())}}</h4>
                            <p class="card-category"> {{ __('Here you can manage details') }}</p>
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
                                    @can('add_details')
                                        <a href="{{ route('details.create') }}" class="btn btn-sm btn-primary">{{ __('Add detail') }}</a>
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
                                        {{ __('Tags') }}
                                    </th>
                                    
                                    
                                    <th>
                                        {{ __('Added by') }}
                                    </th>
                                    <th class="text-right">
                                        @can('edit_details','delete_details')
                                            {{ __('Actions') }}
                                        @endcan
                                    </th>
                                    </thead>
                                    <tbody>
                                    @if($details->total()>0)
                                        @foreach($details as $index=>$detail)
                                            <tr>
                                                <td>
                                                    <strong>{{ $index+1 }}.</strong>
                                                </td>
                                                <td>
                                                    {{ $detail->name }}
                                                </td>
                                                <td>
                                                    {{ $detail->tagList }}
                                                </td>

                                                <td>
                                                    {{ $detail->created_by }}
                                                </td>
                                                <td class="td-actions text-right">
                                                    {{--                              @include('shared._actions', ['entity' => 'details','id'=>$detail->id])--}}

                                                    <form action="{{ route('details.update', $detail) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        @can('edit_details')
                                                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('details.edit', $detail) }}" data-original-title="" title="">
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        @endcan
                                                        @can('delete_details')
                                                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">close</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        @endcan
                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach
                                        {{$details->links()}}
                                    @else
                                        <td>
                                            <p>No details created at the moment</p>
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
