@extends('layouts.app-master')
@section('pageTitle', "Dashboard")
@section('content')


<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
</head>
    <div class="row">
        <!-- First box -->
          <div class="col-xl-3 col-md-6">
            <div class="card card-default">
              <div class="d-flex p-5 justify-content-between">
                <div class="icon-md bg-secondary rounded-circle mr-3">
                  <i class="mdi mdi-calendar-check"></i> <!-- Booking or reservation icon -->
                </div>
                <div class="text-right">
                  <span class="h2 d-block">{{ $clientCount }}</span>
                  <p>All Reservation</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Fourth box -->
          <div class="col-xl-3 col-md-6">
            <div class="card card-default">
              <div class="d-flex p-5 justify-content-between">
                <div class="icon-md bg-info rounded-circle mr-3">
                  <i class="mdi mdi-wallet"></i> <!-- Wallet or spending icon -->
                </div>
                <div class="text-right">
                  <span class="h2 d-block">${{ $totalSpends }}</span>
                  <p>Total Spends</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Second box -->
          <div class="col-xl-3 col-md-6">
            <div class="card card-default">
              <div class="d-flex p-5 justify-content-between">
                <div class="icon-md bg-success rounded-circle mr-3">
                  <i class="mdi mdi-cash"></i> <!-- Money or revenue icon -->
                </div>
                <div class="text-right">
                  <span class="h2 d-block">${{ $hotelRevenue }}</span>
                  <p>Hotel Revenue</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Third box -->
          <div class="col-xl-3 col-md-6">
            <div class="card card-default">
              <div class="d-flex p-5 justify-content-between">
                <div class="icon-md bg-primary rounded-circle mr-3">
                  <i class="mdi mdi-history"></i> <!-- Recent activity or history icon -->
                </div>
                <div class="text-right">
                  <span class="h2 d-block">Coming Soon</span>
                  <p>Recent Activity</p>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection
@section('scripts')
<script>
    $( document ).ready(function() {
        setTimeout(function() {
            $("#login").hide('blind', {}, 500)
        }, 5000);
    });
</script>
@endsection
