@extends('admin.common.header')

@section('content')


  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Customers Management</h1>
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
                <h3 class="card-title col-md-10">Customer Details</h3>
              </div>
              

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="customerDet" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact No - 1</th>
                    <th>Contact No - 2</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($customers as $key => $customer)
                    <tr>
                      <td>{{$key + 1}}</td>
                      <td>{{$customer->first_name}}</td>
                      <td>{{$customer->last_name}}</td>
                      <td>{{$customer->email}}</td>
                      <td>{{$customer->contact_no_1}}</td>
                      <td>{{$customer->contact_no_2}}</td>
                      <td>
                        <a href="{{url('')}}" class="btn btn-block bg-gradient-info btn-xs"> Check Reservations </a>

                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact No - 1</th>
                    <th>Contact No - 2</th>
                    <th>Email</th>
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