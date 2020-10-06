@extends('layouts.app', ['activePage' => 'exercises-management', 'titlePage' => __('Exercises Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            {{--                            <h4 class="card-title ">{{ $exercises->total() }} {{str_plural('exercise',$exercises->count())}}</h4>--}}
                            <p class="card-category"> {{ __('Here you can manage exercises') }}</p>
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
                                    @can('add_exercises')
                                        <a href="{{ route('exercises.create') }}"
                                           class="btn btn-sm btn-primary">{{ __('Add exercise') }}</a>
                                    @endcan
                                </div>
                            </div>

                            <div class="row">


                                @if($exercises->total()>0)

                                    @foreach($exercises as $index=>$exercise)
                                        <div class="col-sm-3">
                                            <div class="card" style="width: 10rem;">


                                                <img class=" img-raised rounded img-fluid"
                                                     src="{{ $exercise->getMedia('exercises')[0]->getUrl('thumb') }}"
                                                     rel="nofollow" alt="Card image cap">
                                                <div class="card-body">
                                                    <p class="card-text"><a href="{{ route('exercises.show', $exercise) }}">{{ $exercise->name}}</a></p>
                                                    <form action="{{ route('exercises.update', $exercise) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        @can('edit_exercises')
                                                            <a rel="tooltip" class="card-link pull-left" href="{{ route('exercises.edit', $exercise) }}" data-original-title="" title="">
                                                                Edit
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        @endcan
                                                        @can('delete_exercises')
                                                            <a href="javascript:;" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''" class="card-link pull-right">Delete</a>

                                                        @endcan
                                                    </form>
{{--                                                    <a href="javascript:;" class="card-link pull-left">Edit</a>--}}
{{--                                                    <a href="javascript:;" class="card-link pull-right">Delete</a>--}}
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                    {{$exercises->links()}}
                                @else

                                    <p>No exercises created at the moment</p>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#exampl').DataTable({
                "stateSave": true,
                "ordering": true,
                "info": true,
                "paging": true,
                "pagingType": "full_numbers"
            });
        });
    </script>
@endsection
