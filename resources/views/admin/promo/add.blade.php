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
                            <h3 class="mb-0">Add Promo</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('promos')}}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-{{ Session::get('status') }}" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('savePromo') }}" enctype="multipart/form-data" id="addpromo">
                            @csrf
                            <label for="ingredients" class="label_class">Name</label>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><svg width="14" height="27" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.3333 22H12V23.3333H13.3333V22Z" fill="black"/>
                                    <path d="M13.3333 24.6667H12V26.0001H13.3333V24.6667Z" fill="black"/>
                                    <path d="M13.3333 27.3333H12V28.6666H13.3333V27.3333Z" fill="black"/>
                                    <path d="M13.3333 19.3333H12V20.6666H13.3333V19.3333Z" fill="black"/>
                                    <path d="M13.3333 16.6667H12V18.0001H13.3333V16.6667Z" fill="black"/>
                                    <path d="M13.3333 14H12V15.3333H13.3333V14Z" fill="black"/>
                                    <path d="M13.3333 11.3333H12V12.6666H13.3333V11.3333Z" fill="black"/>
                                    <path d="M3.99984 11.3333H2.6665V12.6666H3.99984V11.3333Z" fill="black"/>
                                    <path d="M37.3333 11.3333H36V12.6666H37.3333V11.3333Z" fill="black"/>
                                    <path d="M37.3333 27.3333H36V28.6666H37.3333V27.3333Z" fill="black"/>
                                    <path d="M3.99984 27.3333H2.6665V28.6666H3.99984V27.3333Z" fill="black"/>
                                    <path d="M39.3333 16.6667C39.7015 16.6667 40 16.3682 40 16.0001V9.33341C40 8.96525 39.7015 8.66675 39.3333 8.66675H0.666667C0.2985 8.66675 0 8.96525 0 9.33341V16.0001C0 16.3682 0.2985 16.6667 0.666667 16.6667C2.50758 16.6667 4 18.1592 4 20.0001C4 21.841 2.50758 23.3334 0.666667 23.3334C0.2985 23.3334 0 23.6319 0 24.0001V30.6667C0 31.0349 0.2985 31.3334 0.666667 31.3334H39.3333C39.7015 31.3334 40 31.0349 40 30.6667V24.0001C40 23.6319 39.7015 23.3334 39.3333 23.3334C37.4924 23.3334 36 21.841 36 20.0001C36 18.1592 37.4924 16.6667 39.3333 16.6667ZM34.7103 20.6631C35.0047 22.7139 36.6159 24.3251 38.6667 24.6194V30.0001H1.33333V24.6194C3.8845 24.2532 5.65583 21.8883 5.28967 19.3371C4.99533 17.2863 3.38417 15.6751 1.33333 15.3807V10.0001H38.6667V15.3807C36.1155 15.7469 34.3442 18.1118 34.7103 20.6631Z" fill="black"/>
                                    <path d="M20.0002 13.3333C18.5274 13.3333 17.3335 14.5272 17.3335 15.9999C17.3335 17.4727 18.5274 18.6666 20.0002 18.6666C21.4729 18.6666 22.6668 17.4727 22.6668 15.9999C22.6668 14.5272 21.4729 13.3333 20.0002 13.3333ZM20.0002 17.3333C19.2637 17.3333 18.6668 16.7363 18.6668 15.9999C18.6668 15.2635 19.2637 14.6666 20.0002 14.6666C20.7366 14.6666 21.3335 15.2635 21.3335 15.9999C21.3335 16.7363 20.7366 17.3333 20.0002 17.3333Z" fill="black"/>
                                    <path d="M28.0002 21.3333C26.5274 21.3333 25.3335 22.5272 25.3335 23.9999C25.3335 25.4727 26.5274 26.6666 28.0002 26.6666C29.4729 26.6666 30.6668 25.4727 30.6668 23.9999C30.6668 22.5272 29.4729 21.3333 28.0002 21.3333ZM28.0002 25.3333C27.2637 25.3333 26.6668 24.7363 26.6668 23.9999C26.6668 23.2635 27.2637 22.6666 28.0002 22.6666C28.7366 22.6666 29.3335 23.2635 29.3335 23.9999C29.3335 24.7363 28.7366 25.3333 28.0002 25.3333Z" fill="black"/>
                                    <path d="M28.8617 14.1939L18.1953 24.8604L19.1381 25.8032L29.8045 15.1367L28.8617 14.1939Z" fill="black"/>
                                    </svg>
                                    </span>
                                </div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" placeholder="Promo Name" autofocus>
                                
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="error_img" id="empty_name"></div>
                            </div>

                           
                            <label for="ingredients" class="label_class">Description</label>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><svg width="14" height="27" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M34.9397 5.30116H31.5662V1.92773C31.5663 0.86742 30.6987 0 29.6389 0H5.06022C3.99999 0 3.13257 0.86742 3.13257 1.92773V32.771C3.13257 33.8313 3.99999 34.6988 5.0603 34.6988H8.43381V38.0723C8.43381 39.1325 9.30084 40 10.3615 40H26.7466C27.8064 40 29.3061 39.4053 30.0777 38.6791L35.4627 33.6102C36.2352 32.8839 36.8666 31.4217 36.8666 30.3615L36.8675 7.22905C36.8674 6.16866 35.9999 5.30116 34.9397 5.30116ZM8.43365 7.22897V33.253H5.06022C4.79905 33.253 4.57835 33.0323 4.57835 32.7711V1.92773C4.57835 1.66656 4.79905 1.44586 5.06022 1.44586H29.639C29.8997 1.44586 30.1209 1.66656 30.1209 1.92773V5.30124H10.3614C9.30068 5.30124 8.43365 6.16866 8.43365 7.22897ZM34.4718 32.5575L29.0867 37.626C28.9764 37.7297 28.8328 37.8313 28.6742 37.9281V33.4939C28.6742 33.1628 28.8077 32.8649 29.0279 32.6433C29.2501 32.4231 29.5479 32.2892 29.879 32.2892H34.7007C34.6259 32.3907 34.5494 32.4842 34.4718 32.5575ZM35.4206 30.3613C35.4206 30.5045 35.3945 30.6703 35.3551 30.8432H29.8789C28.4163 30.8461 27.2313 32.0312 27.2283 33.4938V38.4957C27.0563 38.5305 26.8905 38.554 26.7464 38.554H10.3614V38.5541C10.0997 38.5541 9.87951 38.3334 9.87951 38.0722V7.22889C9.87951 6.96772 10.0997 6.74702 10.3614 6.74702H34.9396C35.2008 6.74702 35.4215 6.96772 35.4215 7.22889L35.4206 30.3613Z" fill="#393939"/>
                                        <path d="M29.6389 12.0481H15.6631C15.2635 12.0481 14.9402 12.3715 14.9402 12.771C14.9402 13.1705 15.2636 13.4939 15.6631 13.4939H29.6389C30.038 13.4939 30.3618 13.1705 30.3618 12.771C30.3618 12.3715 30.038 12.0481 29.6389 12.0481Z" fill="#393939"/>
                                        <path d="M29.6389 21.6865H15.6631C15.2635 21.6865 14.9402 22.0099 14.9402 22.4094C14.9402 22.8089 15.2636 23.1323 15.6631 23.1323H29.6389C30.038 23.1323 30.3618 22.8089 30.3618 22.4094C30.3618 22.0098 30.038 21.6865 29.6389 21.6865Z" fill="#393939"/>
                                        <path d="M23.3738 26.5059H15.6631C15.2635 26.5059 14.9402 26.8292 14.9402 27.2287C14.9402 27.6283 15.2635 27.9516 15.6631 27.9516H23.3738C23.7729 27.9516 24.0963 27.6283 24.0963 27.2287C24.0963 26.8292 23.7729 26.5059 23.3738 26.5059Z" fill="#393939"/>
                                        <path d="M29.6389 16.8674H15.6631C15.2635 16.8674 14.9402 17.1908 14.9402 17.5903C14.9402 17.9899 15.2636 18.3132 15.6631 18.3132H29.6389C30.038 18.3132 30.3618 17.9899 30.3618 17.5903C30.3618 17.1908 30.038 16.8674 29.6389 16.8674Z" fill="#393939"/>
                                        </svg>
                                        </span>
                                    </div>
                                     <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"  autocomplete="description" placeholder="Promo Description" autofocus>
                                </div>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="error_img" id="empty_des"></div>
                            
                            </div>

                            <label for="ingredients" class="label_class">Discount</label>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                </div>
                                <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') }}"  autocomplete="discount" placeholder="Discount(%)" autofocus>
                                
                                </div>
                                @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="error_img" id="discount"></div>
                            </div>
                             
                 
                            <div class="text-right">
                                <button type="submit" id="save_promo" class="btn btn-primary mt-3">Save</button>
                            </div>
                        </form>
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
$("#addpromo").validate({
    errorElement: 'div',
    rules: {
        name:{
            required:true,
            minlength: 4
        },
        description:{
            required:true
        },
        discount:{
            required:true,
            number: true
        },
    },messages: {
        name: {
            required: "Please provide name",
            minlength: jQuery.validator.format("At least {0} characters required!")
        }, 
        description : {
            required: "Please provide description"
        },
        discount: {
            required: "Please provide discount",
            number: "Only numbers allowed",
        },
    },
    submitHandler: function(form) {
      form.submit();
    }

});

</script>
@endsection