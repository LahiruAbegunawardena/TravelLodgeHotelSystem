@extends('admin.common.header')

@section('content')


  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-8">
          <h1>{{ $hotel_data["hotel_name"] }} -> Rooms Management</h1>
        </div>
        <div class="col-sm-4">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('hotelsIndex') }}">Home</a></li>
            <li class="breadcrumb-item active">Hotel Rooms</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Room Reservation</h4>
              </div>
              <div class="card-body">
                {{ Form::open(array('url' => url('admin/hotels/'.$hotel_data["id"].'/get-available-rooms'),'method'=>'POST')) }}
                    <div class="row">
                      <div class="form-group col-md-6">
                        <div class="form-group">
                          <label for="checkin">Check In Date</label>
                          {!! Form::date('checkin', null, array('min' => Date('Y-m-d'), 'class' => 'form-control')) !!}
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <div class="form-group">
                          <label for="checkout">Check Out Date</label>
                          {!! Form::date('checkout', null, array('min' => Date('Y-m-d'), 'class' => 'form-control')) !!}
                        </div>
                      </div>
                      
                      <button type="submit" class="btn btn-primary">Check Available Rooms</button>
                    </div>
                  {{ Form::close() }}
              </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Update Hotel Rooms</h4>
                </div>
                <div class="card-body">
                  
                  {{ Form::open(array('url' => url('admin/hotels/'.$hotel_data["id"].'/update-rooms'),'method'=>'POST')) }}
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="hotel_name">Single Bed Room</label>
                        <hr>
                        <div class="form-group">
                          <label for="no_of_bed_rooms[1]">No Of Bed Rooms</label>
                          {!! Form::number('no_of_bed_rooms[1]', $single_bedroom_count, array('min' => $single_bedroom_count, 'class' => 'form-control')) !!}
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="hotel_name">Double Bed Room</label>
                        <hr>
                        <div class="form-group">
                          <label for="no_of_bed_rooms[2]">No Of Bed Rooms</label>
                          {!! Form::number('no_of_bed_rooms[2]', $double_bedroom_count, array('min' => $double_bedroom_count, 'class' => 'form-control')) !!}
                        </div>

                      </div>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  {{ Form::close() }}

                </div>
            </div>

            <div class="card">
              <div class="card-header">
                
                <div class="row">
                  <h3 class="card-title col-md-10">Hotel Room Details</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="hotelRoomDet" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>No of Beds</th>
                      <th>Air Conditioned</th>
                      <th>Price for a night</th>
                      <th>Action</th>
                    </tr>
                  </thead>
  
                  <tbody>
                    @foreach ($hotel_rooms as $key => $hotelRoom)
                      <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$hotelRoom->no_of_beds}}</td>
                        <td>
                          @if($hotelRoom->is_ac == 1) Yes @else No @endif
                        </td>
                        <td>Rs. {{number_format($hotelRoom->price_per_night, 2, ".", "")}}</td>
                        <td>
                          <a href="{{url('/admin/hotel-room/'.$hotelRoom->id.'/reservations')}}" class="btn btn-block bg-gradient-info btn-xs"> Check Reservations </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>No of Beds</th>
                      <th>Air Conditioned</th>
                      <th>Price for a night</th>
                      <th>Action</th>
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