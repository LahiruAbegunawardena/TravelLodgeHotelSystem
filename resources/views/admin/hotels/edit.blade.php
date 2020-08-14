@extends('admin.common.header')

@section('content')


  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Hotels Management</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('hotelsIndex') }}">Home</a></li>
            <li class="breadcrumb-item active">Update Hotel</li>
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
                    <h4 class="card-title"> Update Hotel</h4>
                </div>
                <div class="card-body">
                  {{ Form::open(array('url' => url('admin/hotels/'.$hotel_id.'/update'),'method'=>'PUT')) }}
                    
                    <div class="row">
                      <div class="form-group col-md-8">
                        <label for="hotel_name">Hotel Name</label>
                        {!! Form::text('hotel_name', $hotel_data["hotel_name"], array('class' => 'form-control')) !!}
                        @if ($errors->has('hotel_name'))
                          @slot('error')
                            {{ $errors->first('hotel_name') }}
                          @endslot
                        @endif
                      </div>
                    
                      <div class="form-group col-md-8">
                        <label for="address">Address</label>
                        {!! Form::text('address', $hotel_data["address"], array('class' => 'form-control')) !!}
                        @if ($errors->has('address'))
                          @slot('error')
                            {{ $errors->first('address') }}
                          @endslot
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="longitude">Longitude</label>
                        {!! Form::text('longitude', $hotel_data["longitude"], array('class' => 'form-control')) !!}
                        @if ($errors->has('longitude'))
                          @slot('error')
                            {{ $errors->first('longitude') }}
                          @endslot
                        @endif
                      </div>
                      <div class="form-group col-md-4">
                        <label for="latitude">Latitude</label>
                        {!! Form::text('latitude', $hotel_data["latitude"], array('class' => 'form-control')) !!}
                        @if ($errors->has('latitude'))
                          @slot('error')
                            {{ $errors->first('latitude') }}
                          @endslot
                        @endif
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