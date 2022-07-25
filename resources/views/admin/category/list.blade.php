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
                            <h3 class="mb-0">Categories</h3>
                        </div>
                        <div class="col text-right"> 
                            <a href="{{route('addCategory')}}" class="btn btn-sm btn-primary">Add Category</a>
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
                        @if(count($categories) > 0)

                        <!-- Projects table -->
                        <table class="table table-sm table-striped table-hover dataTable no-footer" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Sr.no</th>
                                    <th scope="col" class="sort" data-sort="name">Name</th>
                                    <th scope="col" class="sort" data-sort="name">Image</th>
                                    <th scope="col" class="sort" data-sort="email">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                 @php {{$count=1;}} @endphp
                                @foreach($categories as $category)
                                <tr>
                                    <th>{{ $count++ }}</th>
                                    <th>{{ $category->category_name }}</th>
                                    <th><img src="{{$category->category_image}}" height="100" width="100"></th>
                                    <th>@if($category->is_publish==0)<span class="text-danger">Deactivated</span> @else <span class="text-success">Activated</span> @endif</th>
                                   
                                    <th>
                                   @if($category->is_publish==0)
                                    <a onclick="javascript:confirmation($(this));return false;" href="{{route('publishCategory',$category->id)}}" class="btn btn-warning btn-sm" id="0">Activate</a>
                                    @else
                                    <a onclick="javascript:confirmation($(this));return false;" href="{{route('publishCategory',$category->id)}}" class="btn btn-warning btn-sm" id="1">Deactivate</a>
                                    @endif

                                    <a href="{{route('editCategory',$category->id)}}" class="btn btn-info btn-sm"><i class="fas fa-user-edit"></i></a>
                                   
                                    <a onclick="javascript:confirmationDelete($(this));return false;" href="{{route('deleteCategory',$category->id)}}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                   
                                    </th>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                         @else
                           <div class="no-data-found"><h4>No categories found</h4></div>
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
            title: "Are you sure,you want to delete this category ?",
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
        let title=(block==1)?"Are you sure, you want to deactivate this category ?":"Are you sure, you want to activate this category ?"
        
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