@extends('layouts.main')
@section('content')

 <!-- Page content -->
   <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <!-- Card header -->
             <div class="card-header border-0">
                <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Driver Profile</h3>
                </div>
                <div class="col text-right">
                   <button class="btn btn-sm btn-primary" onclick="window.history.go(-1); return false;">Back</button>
                </div>
                </div>
            </div>

            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-bordered" id="dataTables">
      
                <tbody class="list">
               
                  <tr>
                    <th>Name</th>
                    <td class="budget">{{$driver->name}}</td>
                  </tr>
                   <tr>
                    <th>User Name</th>
                    <td class="budget">{{$driver->username}}</td>
                  </tr>
                   <tr>
                    <th>Email</th>
                    <td class="budget">{{$driver->email}}</td>
                  </tr>
                  
                  <tr>
                    <th>Driving Licence</th>
                     @if($driver->driving_licence)
                    <td class="budget">
                      <a href="{{$driver->driving_licence}}" target="_blank"><img src="{{$driver->driving_licence}}" height="100" width="100"></a>
                    </td>
                    @else
                    <td class="text-danger">No document found</td>
                    @endif
                  </tr>

                   <tr>
                    <th>Vehicle Insurance</th>
                     @if(isset($driver->vehicle_insurance))
                    <td class="budget">
                      <a href="{{$driver->vehicle_insurance}}" target="_blank"><img src="{{$driver->vehicle_insurance}}" height="100" width="100"></a>
                    </td>
                     @else
                        <td class="text-danger">No document found</td>
                      @endif
                  </tr>

                  <tr>
                    <th>Backgroud Check</th>
                    @if(isset($driver->backgroud_check))
                    <td class="budget">
                     <a href="{{$driver->backgroud_check}}" target="_blank"><img src="{{$driver->backgroud_check}}" height="100" width="100"></a>
                    </td>
                    @else
                        <td class="text-danger">No document found</td>
                    @endif
                  </tr>
                  <tr>
                    <th>Fill Out W9</th>
                    @if(isset($driver->fill_out_w9))
                    <td class="budget">
                      <a href="{{$driver->fill_out_w9}}" target="_blank"><img src="{{$driver->fill_out_w9}}" height="100" width="100"></a>
                    </td>
                     @else
                        <td class="text-danger">No document found</td>
                      @endif
                  </tr>

                   <tr>
                    <th>Agree Contractor Terms</th>
                     @if(isset($driver->agree_contractor_terms))
                     <td class="budget">
                      <a href="{{$driver->agree_contractor_terms}}" target="_blank"><img src="{{$driver->agree_contractor_terms}}" height="100" width="100"></a>
                    </td>
                     @else
                        <td class="text-danger">No document found</td>
                      @endif
                  </tr>

                 

                </tbody>
              </table>
               
            </div>
          </div>
        </div>
      </div>
        <!-- Footer -->
     @include('layouts.footer')
    </div>
@endsection