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
                            <h3 class="mb-0">Items</h3>
                        </div>
                        <div class="col text-right"> 
                            <a href="{{route('addItem')}}" class="btn btn-sm btn-primary">Add Item</a>
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
                        @if(count($items) > 0)

                        <!-- Projects table -->
                        <table class="table table-sm table-striped table-hover dataTable no-footer" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Sr.no</th>
                                    <th scope="col" class="sort" data-sort="name">Item Name</th>
                                    <th scope="col" class="sort" data-sort="name">Item Weight</th>
                                    <th scope="col" class="sort" data-sort="name">Image</th>
                                    <th scope="col" class="sort" data-sort="name">Category Name</th>
                                    <th scope="col" class="sort" data-sort="email">Price</th>
                                    <th scope="col" class="sort" data-sort="email">Status</th>
                                    <th scope="col" class="sort" data-sort="email">Is Featured</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                 @php {{$count=1;}} @endphp
                                @foreach($items as $item)
                                <tr>
                                    <th>{{ $count++ }}</th>
                                    <th>{{ $item->item_name }}</th>
                                    <th>{{ $item->item_weight }}g</th>
                                    <th><img src="{{$item->item_image}}" height="100" width="100"></th>

                                     <th>{{ $item->category->category_name }}</th>
                                    <th>{{ $item->price }}</th>
                                    <th>@if($item->is_publish==0)<span class="text-danger">Deactivated</span> @else <span class="text-success">Activated</span> @endif</th>
                                   
                                  
                                    <th>@if($item->is_featured==0)<span class="text-danger">No</span> @else <span class="text-success">Yes</span> @endif</th>

                                   
                                    <th>
                                    @if($item->is_publish==0)
                                    <a onclick="javascript:confirmationactivate($(this));return false;" href="{{route('publishItem',$item->id)}}" class="btn btn-primary btn-sm" id="0"> Activate</a>
                                    @else
                                    <a onclick="javascript:confirmationactivate($(this));return false;" href="{{route('publishItem',$item->id)}}" class="btn btn-warning btn-sm" id="1">Deactivate </a>
                                    @endif

                                   @if($item->is_featured==0)
                                    <a onclick="javascript:confirmation($(this));return false;" href="{{route('featureItem',$item->id)}}" class="btn btn-primary  btn-sm" id="0"> Featured</a>
                                    @else
                                    <a onclick="javascript:confirmation($(this));return false;" href="{{route('featureItem',$item->id)}}" class="btn btn-warning btn-sm" id="1">Unfeatured</a>
                                    @endif

                                    <a href="{{route('editItem',$item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-user-edit"></i></a>
                                   
                                    <a onclick="javascript:confirmationDelete($(this));return false;" href="{{route('deleteItem',$item->id)}}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                   
                                    </th>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                         @else
                           <div class="no-data-found"><h4>No items found</h4></div>
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
    function confirmationactivate(anchor) {
        let block=anchor.attr("id");
        let title=(block==1)?"Are you sure, you want to deactivate this item ?":"Are you sure, you want to activate this item ?"
        
        swal({
            title: title,
           // text: "Once deleted, you will not be able to recover this data!",
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
            title: "Are you sure, you want to delete this item ?",
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

    function confirmation(anchor) {
        let block=anchor.attr("id");
        let title=(block==1)?"Are you sure, you want to unfeature this item ?":"Are you sure, you want to feature this item ?"
        
        swal({
            title: title,
           // text: "Once deleted, you will not be able to recover this data!",
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