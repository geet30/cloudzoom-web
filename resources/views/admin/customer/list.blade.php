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
                            <h3 class="mb-0">Customers</h3>
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
                        @if(count($customers) > 0)

                        <!-- Projects table -->
                        <table class="table table-sm table-striped table-hover dataTable no-footer" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Sr.no</th>
                                    <th scope="col" class="sort" data-sort="name">Name</th>
                                    <th scope="col" class="sort" data-sort="name">User Name</th>
                                    <th scope="col" class="sort" data-sort="email">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                 @php {{$count=1;}} @endphp
                                @foreach($customers as $user)
                                <tr>
                                    <th>{{ $count++ }}</th>
                                    <th>{{ $user->name }}</th>
                                    <th>{{ $user->username }}</th>
                                    <th>{{ $user->email }}</th>
                                    <th>
                                   @if($user->is_block==0)
                                    <a onclick="javascript:confirmationBlock($(this));return false;" href="{{route('blockCustomer',$user->id)}}" class="btn btn-warning btn-sm" id="0">Block</a>
                                    @else
                                    <a onclick="javascript:confirmationBlock($(this));return false;" href="{{route('blockCustomer',$user->id)}}" class="btn btn-warning btn-sm" id="1">Unblock</a>
                                    @endif
                                   
                                    <a onclick="javascript:confirmationDelete($(this));return false;" href="{{route('deleteCustomer',$user->id)}}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                   
                                    </th>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                         @else
                           <div class="no-data-found"><h4>No customers found</h4></div>
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
    function confirmationDelete(anchor) {

        swal({
            title: "Are you sure,you want to delete this customer?",
            //text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: ["No","Yes"],
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = anchor.attr("href");
            }
        });
        //   var conf = confirm("Are you sure want to delete this User?");
        //   if (conf) window.location = anchor.attr("href");
    }

    function confirmationBlock(anchor) {
        let block=anchor.attr("id");
        let title=(block==0)?"Are you sure,you want to block this customer ?":"Are you sure,you want to unblock this customer ?"
        
        swal({
            title: title,
           // text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            // buttons: true,
            buttons: ["No","Yes"],
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = anchor.attr("href");
            }
        });
        //   var conf = confirm("Are you sure want to delete this User?");
        //   if (conf) window.location = anchor.attr("href");
    }

</script>
@endsection