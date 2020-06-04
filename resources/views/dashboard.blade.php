@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_circle</i>
              </div>
              <p class="card-category">Clients</p>


              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">input</i>

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">settings_input_antenna</i>
              </div>
              <p class="card-category">Projects</p>

            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-danger">input</i>

                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Reports</p>

            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-danger">input</i>

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
          $('#examp').DataTable( {
              "stateSave": true,
              "ordering": true,
              "info":true,
              "paging":   true,
              "pagingType": "full_numbers"
          } );
      } );
  </script>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
