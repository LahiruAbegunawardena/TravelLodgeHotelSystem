@extends('admin.common.header')

@section('content')


  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reserve Room</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('hotelsIndex') }}">Home</a></li>
            <li class="breadcrumb-item active">Reserve Room</li>
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
                    <h4 class="card-title"> Create Room Reservation</h4>
                </div>
                <div class="card-body">
                  
                  <h5>Hotel Name: {{$hotel->hotel_name}}<h5>
                  <h6>CheckIn Date: {{$checkin}}</h6>
                  <h6>CheckOut Date: {{$checkout}}</h6>

                  <br>

                  {{ Form::open(array('url' => '/admin/hotels/'.$hotel->id.'/reserve-rooms', 'method'=>'POST')) }}
                    
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="hotel_name">Customer</label>
                        <select id="customer_id" name="customer_id" class="form-control" required>
                          @foreach ($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}</option>
                          @endforeach
                        </select>

                        {!! Form::hidden('checkin', $checkin, array('class' => 'form-control')) !!}
                        {!! Form::hidden('checkout', $checkout, array('class' => 'form-control')) !!}

                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label for="hotel_name">Room</label>
                        <div class="row">
                          @foreach ($availableHotelRooms as $hotelRoom)
                            <div class="form-group col-md-4">
                              <input class="custom-control" type="checkbox" name="selectedHotelRooms[]" id="{{$hotelRoom->id}}" value="{{$hotelRoom->id}}">
                              <label for="selectedHotelRooms[1]">
                                Hotel Room Id:#{{$hotelRoom->id}} (No_of_beds: {{$hotelRoom->no_of_beds}})<br>Price per night: {{number_format($hotelRoom->price_per_night, 2, ".", "")}}
                              </label>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>

                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    </div>
  </section>

@endsection