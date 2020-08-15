@extends('admin.common.header')

@section('content')


  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Invoice Management</h1>
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

  <section class="content">
    <div class="container-fluid">
      <div class="row">

        @foreach ($invoices as $invoice)
          <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4> Invoice Id - #{{$invoice->id}} </h4>

                    <br>
                    
                    <h5>{{$invoice->hotel->hotel_name}}</h5>
                    <p>{{$invoice->hotel->address}} </p>
                    
                </div>
                <div class="card-body">
                    <p>Check-in datetime&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{$invoice->checkin_date_time}}</p>
                    <p>Check-out datetime&nbsp;&nbsp;&nbsp; : {{$invoice->checkout_date_time}}</p>
                    <p>Reserved datetime&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{$invoice->reserved_date_time}}</p>

                    <hr>
                  
                    <h4>Reservations</h4>

                    @foreach ($invoice->reservations as $reservation)
                      <ul>
                        <li>Room_id&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{$reservation->individual_hotel_room_id}}</li>
                        <li>Reservation Price : Rs.{{number_format($reservation->price, 2, ".", "")}}</li>
                      </ul>
                    @endforeach

                    <hr>
                    <div class="row">
                                            {{--  Reservation Price  --}}
                      <div class="col-md-7">
                        {{--  <b>Total Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rs.{{$invoice->total_price_format}}</b>  --}}
                        <b>Total Price -> Rs.{{$invoice->total_price_format}}</b>
                      </div>
                      @if($invoice->is_paid == 0)
                        <a href="{{url('/admin/invoice/'.$invoice->id.'/settle')}}" class="btn btn-block bg-gradient-success col-md-5"> Pay </a>
                      @elseif($invoice->is_paid == 1)
                        <button class="btn col-md-5 bg-gradient-info" disabled>&nbsp;Bill allready settled&nbsp;</button>
                      @endif
                    </div>
                </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </section>


@endsection