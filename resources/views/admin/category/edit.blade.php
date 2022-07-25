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
                            <h3 class="mb-0">Edit Category</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('categories')}}" class="btn btn-sm btn-primary">Back</a>
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
                        <form method="POST" action="{{route('updateCategory',$category->id)}}" enctype="multipart/form-data" id="addCategory">
                            @csrf
                            <label for="ingredients" class="label_class">Category Name</label>
                             <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><svg width="14" height="27" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M34.2908 38.9189H5.70973C5.56637 38.9189 5.42888 38.8619 5.32751 38.7606C5.22614 38.6592 5.16919 38.5217 5.16919 38.3784V1.6216C5.16919 1.47823 5.22614 1.34075 5.32751 1.23938C5.42888 1.138 5.56637 1.08105 5.70973 1.08105H34.2908C34.4342 1.08105 34.5717 1.138 34.673 1.23938C34.7744 1.34075 34.8314 1.47823 34.8314 1.6216V38.3784C34.8314 38.5217 34.7744 38.6592 34.673 38.7606C34.5717 38.8619 34.4342 38.9189 34.2908 38.9189ZM6.25027 37.8378H33.7503V2.16214H6.25027V37.8378Z" fill="black"/>
                                            <path d="M30.8107 9.32449H15.6756C15.5322 9.32449 15.3947 9.26754 15.2933 9.16617C15.192 9.0648 15.135 8.92731 15.135 8.78395C15.135 8.64059 15.192 8.5031 15.2933 8.40173C15.3947 8.30036 15.5322 8.24341 15.6756 8.24341H30.8107C30.954 8.24341 31.0915 8.30036 31.1929 8.40173C31.2943 8.5031 31.3512 8.64059 31.3512 8.78395C31.3512 8.92731 31.2943 9.0648 31.1929 9.16617C31.0915 9.26754 30.954 9.32449 30.8107 9.32449Z" fill="black"/>
                                            <path d="M30.8107 16.6216H15.6756C15.5322 16.6216 15.3947 16.5647 15.2933 16.4633C15.192 16.3619 15.135 16.2244 15.135 16.0811C15.135 15.9377 15.192 15.8002 15.2933 15.6988C15.3947 15.5975 15.5322 15.5405 15.6756 15.5405H30.8107C30.954 15.5405 31.0915 15.5975 31.1929 15.6988C31.2943 15.8002 31.3512 15.9377 31.3512 16.0811C31.3512 16.2244 31.2943 16.3619 31.1929 16.4633C31.0915 16.5647 30.954 16.6216 30.8107 16.6216Z" fill="black"/>
                                            <path d="M30.8107 24.4595H15.6756C15.5322 24.4595 15.3947 24.4026 15.2933 24.3012C15.192 24.1998 15.135 24.0623 15.135 23.919C15.135 23.7756 15.192 23.6381 15.2933 23.5367C15.3947 23.4354 15.5322 23.3784 15.6756 23.3784H30.8107C30.954 23.3784 31.0915 23.4354 31.1929 23.5367C31.2943 23.6381 31.3512 23.7756 31.3512 23.919C31.3512 24.0623 31.2943 24.1998 31.1929 24.3012C31.0915 24.4026 30.954 24.4595 30.8107 24.4595Z" fill="black"/>
                                            <path d="M30.8107 31.7569H15.6756C15.5322 31.7569 15.3947 31.6999 15.2933 31.5985C15.192 31.4972 15.135 31.3597 15.135 31.2163C15.135 31.073 15.192 30.9355 15.2933 30.8341C15.3947 30.7327 15.5322 30.6758 15.6756 30.6758H30.8107C30.954 30.6758 31.0915 30.7327 31.1929 30.8341C31.2943 30.9355 31.3512 31.073 31.3512 31.2163C31.3512 31.3597 31.2943 31.4972 31.1929 31.5985C31.0915 31.6999 30.954 31.7569 30.8107 31.7569Z" fill="black"/>
                                            <path d="M10.653 10.7879C10.2566 10.7878 9.8691 10.6702 9.53956 10.4499C9.21002 10.2296 8.95321 9.91652 8.80159 9.55027C8.64997 9.18402 8.61035 8.78103 8.68775 8.39227C8.76515 8.0035 8.95608 7.64642 9.23641 7.36616C9.51675 7.0859 9.87388 6.89506 10.2627 6.81777C10.6515 6.74048 11.0544 6.7802 11.4206 6.93192C11.7868 7.08364 12.0998 7.34054 12.3201 7.67013C12.5403 7.99973 12.6578 8.38723 12.6578 8.78362C12.6572 9.31512 12.4458 9.82468 12.0699 10.2005C11.6941 10.5762 11.1844 10.7875 10.653 10.7879V10.7879ZM10.653 7.86038C10.4704 7.86049 10.2919 7.91472 10.1402 8.01624C9.98842 8.11775 9.87017 8.26198 9.80037 8.43069C9.73058 8.5994 9.71237 8.78501 9.74806 8.96407C9.78374 9.14312 9.87171 9.30758 10.0009 9.43664C10.13 9.56571 10.2945 9.65359 10.4736 9.68916C10.6527 9.72474 10.8383 9.70643 11.0069 9.63654C11.1756 9.56664 11.3198 9.44831 11.4212 9.29649C11.5226 9.14468 11.5767 8.9662 11.5767 8.78362C11.5764 8.53876 11.479 8.30401 11.3058 8.13092C11.1326 7.95782 10.8978 7.86052 10.653 7.86038V7.86038Z" fill="black"/>
                                            <path d="M10.653 18.0856C10.2566 18.0855 9.8691 17.9678 9.53956 17.7475C9.21002 17.5272 8.95321 17.2141 8.80159 16.8479C8.64997 16.4816 8.61035 16.0786 8.68775 15.6899C8.76515 15.3011 8.95608 14.944 9.23641 14.6638C9.51675 14.3835 9.87388 14.1927 10.2627 14.1154C10.6515 14.0381 11.0544 14.0778 11.4206 14.2295C11.7868 14.3812 12.0998 14.6381 12.3201 14.9677C12.5403 15.2973 12.6578 15.6848 12.6578 16.0812C12.6572 16.6127 12.4458 17.1223 12.0699 17.4981C11.6941 17.8738 11.1844 18.0851 10.653 18.0856ZM10.653 15.158C10.4704 15.1581 10.2919 15.2123 10.1402 15.3138C9.98842 15.4154 9.87017 15.5596 9.80037 15.7283C9.73058 15.897 9.71237 16.0826 9.74806 16.2617C9.78374 16.4407 9.87171 16.6052 10.0009 16.7343C10.13 16.8633 10.2945 16.9512 10.4736 16.9868C10.6527 17.0224 10.8383 17.004 11.0069 16.9341C11.1756 16.8643 11.3198 16.7459 11.4212 16.5941C11.5226 16.4423 11.5767 16.2638 11.5767 16.0812C11.5764 15.8364 11.479 15.6016 11.3058 15.4285C11.1326 15.2554 10.8978 15.1581 10.653 15.158V15.158Z" fill="black"/>
                                            <path d="M10.653 25.9232C10.2566 25.9231 9.8691 25.8054 9.53956 25.5851C9.21002 25.3648 8.95321 25.0518 8.80159 24.6855C8.64997 24.3193 8.61035 23.9163 8.68775 23.5275C8.76515 23.1388 8.95608 22.7817 9.23641 22.5014C9.51675 22.2212 9.87388 22.0303 10.2627 21.953C10.6515 21.8757 11.0544 21.9155 11.4206 22.0672C11.7868 22.2189 12.0998 22.4758 12.3201 22.8054C12.5403 23.135 12.6578 23.5225 12.6578 23.9189C12.6572 24.4504 12.4458 24.9599 12.0699 25.3357C11.6941 25.7115 11.1844 25.9228 10.653 25.9232V25.9232ZM10.653 22.9956C10.4704 22.9957 10.2919 23.05 10.1402 23.1515C9.98842 23.253 9.87017 23.3972 9.80037 23.5659C9.73058 23.7346 9.71237 23.9203 9.74806 24.0993C9.78374 24.2784 9.87171 24.4428 10.0009 24.5719C10.13 24.701 10.2945 24.7888 10.4736 24.8244C10.6527 24.86 10.8383 24.8417 11.0069 24.7718C11.1756 24.7019 11.3198 24.5836 11.4212 24.4317C11.5226 24.2799 11.5767 24.1014 11.5767 23.9189C11.5764 23.674 11.479 23.4393 11.3058 23.2662C11.1326 23.0931 10.8978 22.9958 10.653 22.9956V22.9956Z" fill="black"/>
                                            <path d="M10.653 33.2205C10.2566 33.2204 9.8691 33.1028 9.53956 32.8825C9.21002 32.6622 8.95321 32.3491 8.80159 31.9829C8.64997 31.6166 8.61035 31.2136 8.68775 30.8249C8.76515 30.4361 8.95608 30.079 9.23641 29.7988C9.51675 29.5185 9.87388 29.3277 10.2627 29.2504C10.6515 29.1731 11.0544 29.2128 11.4206 29.3645C11.7868 29.5163 12.0998 29.7732 12.3201 30.1027C12.5403 30.4323 12.6578 30.8198 12.6578 31.2162C12.6572 31.7477 12.4458 32.2573 12.0699 32.6331C11.6941 33.0088 11.1844 33.2201 10.653 33.2205ZM10.653 30.293C10.4704 30.2931 10.2919 30.3473 10.1402 30.4488C9.98842 30.5504 9.87017 30.6946 9.80037 30.8633C9.73058 31.032 9.71237 31.2176 9.74806 31.3967C9.78374 31.5757 9.87171 31.7402 10.0009 31.8693C10.13 31.9983 10.2945 32.0862 10.4736 32.1218C10.6527 32.1573 10.8383 32.139 11.0069 32.0691C11.1756 31.9992 11.3198 31.8809 11.4212 31.7291C11.5226 31.5773 11.5767 31.3988 11.5767 31.2162C11.5764 30.9714 11.479 30.7366 11.3058 30.5635C11.1326 30.3904 10.8978 30.2931 10.653 30.293V30.293Z" fill="black"/>
                                            </svg></span>
                                </div>
                                <input id="name" type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') ?? $category->category_name }}"  autocomplete="category_name" placeholder="Category name" autofocus>

                               
                                </div>
                                 @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="error_img" id="empty_name"></div>
                            </div>

                            <label for="ingredients" class="label_class">Category Image</label>
                             <div class="form-group avatar-upload blog_image">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="blog_image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file'  name="category_image" id="category_image" accept=".png, .jpg, .jpeg, .gif"/>
                                                <input type="hidden"  name="{{ old("category_image") }}" value=""/>
                                                <label for="category_image" id="cat_img"><i class="fas fa-edit"></i></label>
                                            </div>
                                            <div class="avatar-preview">
                                                @if(isset($category->category_image))
                                                <div id="category_image_preview" style="background-image: url({{$category->category_image}});">
                                                </div>
                                                @else
                                                 <div id="category_image_preview" style="background-image: url({{URL::asset('assets/img/thumbnail-default_2.jpg')}});">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                

                                @error('category_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                </div>
                                <div class="error_img" id="empty_img"></div>
                            </div>
                            
                            
                            
                            
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mt-3" id="save_cat">Update</button>
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
    $("#addCategory").validate({
        errorElement: 'div',
    rules: {
        category_name:{
            required:true,
            minlength: 3
        },
        /*category_image:{
            required:true
        },*/
    },messages: {
        item_name: {
        required: "Please provide item name",
        minlength: jQuery.validator.format("At least {0} characters required!")
        },
        /*category_image: {
        required: "Please provide item image"
        },*/
    },
    submitHandler: function(form) {
        form.submit();
    }

    });
    var _URL = window.URL;
    function readURLTwo(input) {
        var file, img;
        if ((file = input.files[0])) {
            img = new Image();
            img.onload = function () {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#category_image_preview').css('background-image', 'url('+e.target.result +')');
                        $('#category_image_preview').hide();
                        $('#category_image_preview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                    return true;
                
            };
            img.src = _URL.createObjectURL(file);
        }
    }

    $("#category_image").change(function() {
        if($('input[name="category_image"]').get(0).files.length!=0){  
            var fileExtension = ['jpeg', 'jpg','png', 'gif', 'bmp'];
            $("#empty_img").html("");

            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $('<small>Only formats are allowed :'+fileExtension.join(', ')+' </small>').appendTo('#empty_img');
                return
            }
        }

        $("#empty_img").html("");
        $("#category_image-error").html("");
        readURLTwo(this);
    });

</script>
@endsection