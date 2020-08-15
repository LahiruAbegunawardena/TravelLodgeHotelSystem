@extends('admin.common.header')

@section('content')


  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Room Reservations</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('hotelsIndex') }}">Home</a></li>
            <li class="breadcrumb-item active">Hotels</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              
              <div class="row">
                <h3 class="card-title col-md-10">Room Reservation Details</h3>
              </div>
              

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="roomReserveationDet" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Invoice Id</th>
                    <th>Customer Name</th>
                    <th>Check-In Date</th>
                    <th>Check-Out Date</th>
                    <th>Reserved Date</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($reservations as $key => $reservation)
                    <tr>
                      <td>{{$key + 1}}</td>
                      <td>{{$reservation->pivot->invoice_id}}</td>
                      <td>{{$reservation->first_name}} {{$reservation->last_name}}</td>
                      <td>{{$reservation->pivot->checkin_date_time}}</td>
                      <td>{{$reservation->pivot->checkout_date_time}}</td>
                      <td>{{$reservation->pivot->reserved_date_time}}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Invoice Id</th>
                    <th>Customer Name</th>
                    <th>Check-In Date</th>
                    <th>Check-Out Date</th>
                    <th>Reserved Date</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection