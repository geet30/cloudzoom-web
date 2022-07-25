@extends('layouts.main')
@section('content')
<div class="">
    <div class="container-fluid mt-3">
        <div class="row" id="main_content">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Orders</h3>
                        </div>
                        
                       
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        @if(session('status'))
                            <div class="alert alert-{{ Session::get('status') }}" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        @if(count($orders) > 0)
                        <!-- Projects table -->
                        <table class="table table-sm table-striped table-hover dataTable no-footer" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Order ID</th>
                                    <th scope="col" class="sort" data-sort="name">User Name</th>
                                    <th scope="col" class="sort" data-sort="email">User Email</th>
                                    <th scope="col" class="sort" data-sort="name">Total Quantity</th>
                                    <th scope="col" class="sort" data-sort="name">Total Price</th>
                                    <th scope="col" class="sort" data-sort="name">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @php {{$count=1;}} {{$total_quantity = 0; }}@endphp
                                
                              @foreach($orders as $order)
                                <tr>
                                    <th>{{ $count++ }}</th>
                                    <th>{{ $order->user->name }}</th>
                                    <th>{{ $order->user->email }}</th>
                                    
                                    <th>{{  $order->quantity}}</th>
                                    <th>{{  $order->sub_total}}</th>
                                   
                                    <th>
                                        @if($order->order_status==1) <span class="text-danger">Pending</span>
                                        @elseif($order->order_status==2) <span class="text-danger">Pickup</span>
                                        @elseif($order->order_status==3) <span class="text-success">Confirm Arrival</span>
                                        @elseif($order->order_status==4) <span class="text-success">Delivered</span>
                                        @endif
                                    </th>
                                    
                                   
                                    <th><a href="{{route('viewOrder',$order->id)}}" class="btn btn-success btn-sm"><i class="far fa-eye"></i></a>

                                    <a onclick="javascript:confirmationDelete($(this));return false;" href="{{route('deleteDriver',$order->id)}}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                   
                                    </th>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                        @else
                           <div class="no-data-found"><h4>No drivers found</h4></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>
@endsection

@section('script')
<script>
  function confirmation(anchor) {
        let block=anchor.attr("id");
        let title=(block==0)?"Are you sure,you want to approve this driver ?":"Are you sure,you want to disapprove this driver ?"
        
        swal({
            title: title,
            //text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: ["No","Yes"],
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                var url = anchor.attr("href");
                $.get( url, function( data ) {
                    console.log(data);
                if(data.success==true)
                {
                  toastr.success(data.message,'Success');
                  location.reload();
                }else{
                  toastr.warning('Something went wrong', 'Warning');
                }
                
              });
            }
        });
        //   var conf = confirm("Are you sure want to delete this User?");
        //   if (conf) window.location = anchor.attr("href");
    }

function confirmationDelete(anchor) {
        swal({
            title: "Are you sure,you want to delete this driver ?",
           // text: "Once deleted, you will not be able to recover its data.",
            icon: "warning",
            buttons: ["No","Yes"],
            dangerMode: true,
            })
            .then((willDelete) => {
            var url = anchor.attr("href");
            if (willDelete) {
              $.get( url, function( data ) {
                if(data.success==true)
                {
                  toastr.success('Driver Deleted!','Success');
                  location.reload();
                }else{
                  toastr.warning('Something went wrong', 'Warning');
                }
                
              });
               
            }
        });
        
    }
    

</script>
@endsection