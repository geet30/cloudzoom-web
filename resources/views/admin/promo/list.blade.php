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
                            <h3 class="mb-0">Promo code</h3>
                        </div>
                        <div class="col text-right"> 
                            <a href="{{route('addPromo')}}" class="btn btn-sm btn-primary">Add Promo</a>
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
                        @if(count($promos) > 0)

                        <!-- Projects table -->
                        <table class="table table-sm table-striped table-hover dataTable no-footer" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Sr.no</th>
                                    <th scope="col" class="sort" data-sort="name">Promo name</th>
                                    <th scope="col" class="sort" data-sort="name">Description</th>
                                    <th scope="col" class="sort" data-sort="name">Promo Code</th>
                                    <th scope="col" class="sort" data-sort="email">Promo Discount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                 @php {{$count=1;}} @endphp
                                @foreach($promos as $promo)
                                <tr>
                                    <th>{{ $count++ }}</th>
                                    <th>{{ $promo->name }}</th>
                                    <th>{{ $promo->description }}</th>
                                    <th>{{ $promo->promo_code }}</th>
                                    <th>{{ $promo->discount }}%</th>
                                    <th><a href="{{route('editPromo',$promo->id)}}" class="btn btn-info btn-sm"><i class="fas fa-user-edit"></i></a>
                                   
                                    <a onclick="javascript:confirmationDelete($(this));return false;" href="{{route('deletePromo',$promo->id)}}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                   
                                    </th>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                         @else
                           <div class="no-data-found"><h4>No Promos found</h4></div>
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
            title: "Are you sure,you want to delete this promo ?",
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


</script>
@endsection