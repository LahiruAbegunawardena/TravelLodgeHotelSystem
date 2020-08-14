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
                <h3 class="card-title col-md-10">Hotel Details</h3>

              <a href="{{ route('hotelsCreate')}}" class="col-md-2 btn btn-block bg-gradient-success"> Add Hotel </a>
              </div>
              

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="hotelDet" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Hotel Name</th>
                    <th>Address</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Room Count</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($hotelsData as $key => $hotel)
                    <tr>
                      <td>{{$key + 1}}</td>
                      <td>{{$hotel->hotel_name}}</td>
                      <td>{{$hotel->address}}</td>
                      <td>{{$hotel->longitude}}</td>
                      <td>{{$hotel->latitude}}</td>
                      <td>
                        Bed x 1 Rooms:  <br>
                        Bed x 2 Rooms:  <br>
                        Bed x 3 Rooms: 
                      </td>
                      <td>
                        <a href="{{url('/admin/hotels/'.$hotel->id.'/edit')}}" class="btn btn-block bg-gradient-info btn-xs"> Edit </a>
                        <a href="{{url('/admin/hotels/'.$hotel->id.'/rooms')}}" class="btn btn-block bg-gradient-info btn-xs"> Rooms Details </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Hotel Name</th>
                    <th>Address</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Room Count</th>
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