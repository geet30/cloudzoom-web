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
                            <h3 class="mb-0">Approved Drivers</h3>
                        </div>
                        <div class="col text-right"> 
                            <a href="{{route('addDriver',['is_approved'=>0])}}" class="btn btn-sm btn-primary">Add Driver</a>
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
                        @if(count($drivers) > 0)
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
                              @foreach($drivers as $user)
                                <tr>
                                    <th>{{ $count++ }}</th>
                                    <th>{{ $user->name }}</th>
                                    <th>{{ $user->username }}</th>
                                    <th>{{ $user->email }}</th>
                                    <th>
                                     @if($user->is_approved==0)
                                    <a onclick="javascript:confirmation($(this));return false;" href="{{route('approveDriver',$user->id)}}" class="btn btn-warning btn-sm" id="0">Approve </a>
                                    @else
                                    <a onclick="javascript:confirmation($(this));return false;" href="{{route('approveDriver',$user->id)}}" class="btn btn-warning btn-sm" id="1">Disapprove</a>
                                    @endif
                                        
                                    <a href="{{route('editDriver',$user->id)}}" class="btn btn-info btn-sm"><i class="fas fa-user-edit"></i></a>
                                        
                                    <a  href="{{route('viewProfile',$user->id)}}" class="btn btn-success btn-sm"><i class="far fa-eye"></i></a>

                                    <a onclick="javascript:confirmationDelete($(this));return false;" href="{{route('deleteDriver',$user->id)}}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                   
                                    </th>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                        @else
                           <div class="no-data-found"><h4>No driver found</h4></div>
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
                window.location = anchor.attr("href");
            }
        });
        //   var conf = confirm("Are you sure want to delete this User?");
        //   if (conf) window.location = anchor.attr("href");
    }


    function confirmationDelete(anchor) {

        swal({
            title: "Are you sure,you want to delete this driver ?",
            text: "Once deleted, you will not be able to recover this data!",
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

</script>
@endsection