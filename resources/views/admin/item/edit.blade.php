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
                            <h3 class="mb-0">Edit Item</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('items')}}" class="btn btn-sm btn-primary">Back</a>
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
                        <form method="POST" action="{{ route('updateItem',$item->id) }}" enctype="multipart/form-data" id="addCategory">
                            @csrf
                            <label for="ingredients" class="label_class">Item Name</label>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><svg width="14" height="27" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M35.8334 0H25.2616C23.2583 0 21.375 0.78 19.9583 2.19664L1.42164 20.7334C0.505 21.65 0 22.8684 0 24.17C0 25.465 0.505 26.6834 1.42164 27.6L12.4 38.5784C13.3166 39.495 14.535 40 15.8366 40C17.1316 40 18.35 39.495 19.2666 38.5784L37.8033 20.0417C39.22 18.625 40 16.7416 40 14.7384V4.16664C40 1.87 38.13 0 35.8334 0ZM38.3334 14.7384C38.3334 16.2967 37.7267 17.7617 36.6267 18.8617L18.0884 37.4C16.89 38.5984 14.7884 38.6066 13.58 37.4L2.6 26.42C1.99836 25.82 1.66664 25.02 1.66664 24.1634C1.66664 23.3134 1.99828 22.5134 2.6 21.9117L21.1366 3.375C22.24 2.27336 23.7033 1.66664 25.2616 1.66664H35.8333C37.2116 1.66664 38.3333 2.78828 38.3333 4.16664V14.7384H38.3334Z" fill="#353535"/>
                                    <path d="M30.8334 5C28.5367 5 26.6667 6.87 26.6667 9.16664C26.6667 11.4633 28.5367 13.3333 30.8334 13.3333C33.13 13.3333 35 11.4634 35 9.16664C35 6.87 33.13 5 30.8334 5ZM30.8334 11.6666C29.455 11.6666 28.3334 10.545 28.3334 9.16664C28.3334 7.78828 29.455 6.66664 30.8334 6.66664C32.2117 6.66664 33.3334 7.78828 33.3334 9.16664C33.3334 10.545 32.2117 11.6666 30.8334 11.6666Z" fill="#353535"/>
                                    </svg>
                                    </span>
                                </div>
                                <input id="name" type="text" class="form-control @error('item_name') is-invalid @enderror" name="item_name" value="{{ old('item_name')??$item->item_name }}"  autocomplete="item_name" placeholder="Item name" autofocus>
                                
                                </div>
                                @error('item_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="ingredients" class="label_class">Item Weight</label>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><svg width="14" height="27" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M34.4823 37.0225H5.51794C4.88786 37.0225 4.265 36.8883 3.69084 36.6288C3.11668 36.3693 2.6044 35.9904 2.1881 35.5175C1.7718 35.0445 1.46104 34.4883 1.27652 33.8858C1.09199 33.2834 1.03793 32.6485 1.11794 32.0235L3.38821 14.2571C3.52718 13.1875 4.05015 12.205 4.85971 11.4924C5.66927 10.7798 6.71024 10.3857 7.78875 10.3835H32.2098C33.2883 10.3857 34.3293 10.7798 35.1389 11.4924C35.9484 12.205 36.4714 13.1875 36.6104 14.2571L38.8806 32.0235C38.9607 32.6485 38.9066 33.2834 38.7221 33.8858C38.5375 34.4883 38.2268 35.0445 37.8105 35.5175C37.3942 35.9904 36.8819 36.3693 36.3077 36.6288C35.7336 36.8883 35.1107 37.0225 34.4806 37.0225H34.4823ZM7.79037 11.4646C6.97466 11.4662 6.18733 11.7643 5.57505 12.3033C4.96278 12.8423 4.56729 13.5854 4.46226 14.3944L2.18983 32.1625C2.1295 32.6351 2.17052 33.1152 2.31018 33.5708C2.44983 34.0264 2.6849 34.447 2.99976 34.8046C3.31461 35.1623 3.70203 35.4488 4.13622 35.6451C4.57042 35.8414 5.04144 35.9429 5.51794 35.943H34.4823C34.9588 35.9429 35.4298 35.8414 35.864 35.6451C36.2982 35.4488 36.6856 35.1623 37.0004 34.8046C37.3153 34.447 37.5504 34.0264 37.69 33.5708C37.8297 33.1152 37.8707 32.6351 37.8104 32.1625L35.5401 14.396C35.4351 13.5871 35.0396 12.8439 34.4273 12.3049C33.815 11.7659 33.0277 11.4678 32.212 11.4662L7.79037 11.4646Z" fill="black"/>
                                    <path d="M26.8065 11.4645H13.1892C13.0459 11.4645 12.9084 11.4075 12.807 11.3061C12.7056 11.2048 12.6487 11.0673 12.6487 10.9239V8.38771C12.6487 8.24435 12.7056 8.10686 12.807 8.00549C12.9084 7.90412 13.0459 7.84717 13.1892 7.84717C13.3326 7.84717 13.4701 7.90412 13.5714 8.00549C13.6728 8.10686 13.7298 8.24435 13.7298 8.38771V10.3834H26.266V8.38771C26.266 8.24435 26.3229 8.10686 26.4243 8.00549C26.5257 7.90412 26.6632 7.84717 26.8065 7.84717C26.9499 7.84717 27.0874 7.90412 27.1888 8.00549C27.2901 8.10686 27.3471 8.24435 27.3471 8.38771V10.9239C27.3471 11.0673 27.2901 11.2048 27.1888 11.3061C27.0874 11.4075 26.9499 11.4645 26.8065 11.4645Z" fill="black"/>
                                    <path d="M30.1698 8.92722H9.83037C8.52383 8.92579 7.27117 8.40632 6.34705 7.48271C5.42294 6.5591 4.90278 5.30673 4.90063 4.00019V3.51857C4.90063 3.37521 4.95758 3.23772 5.05896 3.13635C5.16033 3.03498 5.29782 2.97803 5.44118 2.97803H34.559C34.7024 2.97803 34.8399 3.03498 34.9412 3.13635C35.0426 3.23772 35.0996 3.37521 35.0996 3.51857V4.00019C35.0974 5.30673 34.5773 6.5591 33.6531 7.48271C32.729 8.40632 31.4764 8.92579 30.1698 8.92722V8.92722ZM5.98226 4.05911C5.99968 5.06862 6.41261 6.03098 7.13224 6.73918C7.85187 7.44739 8.8207 7.84487 9.83037 7.84614H30.1698C31.1795 7.84487 32.1483 7.44739 32.868 6.73918C33.5876 6.03098 34.0005 5.06862 34.0179 4.05911H5.98226Z" fill="black"/>
                                    <path d="M20.0001 32.3294C18.2939 32.3295 16.626 31.8237 15.2073 30.8758C13.7886 29.928 12.6828 28.5807 12.0298 27.0044C11.3768 25.4281 11.2059 23.6935 11.5388 22.0201C11.8716 20.3467 12.6932 18.8095 13.8997 17.6031C15.1062 16.3966 16.6433 15.575 18.3167 15.2421C19.9902 14.9093 21.7247 15.0802 23.301 15.7332C24.8773 16.3862 26.2246 17.4919 27.1724 18.9106C28.1203 20.3293 28.6261 21.9972 28.626 23.7035C28.6234 25.9904 27.7138 28.183 26.0967 29.8001C24.4796 31.4172 22.287 32.3268 20.0001 32.3294V32.3294ZM20.0001 16.158C18.5077 16.1579 17.0488 16.6004 15.8079 17.4294C14.567 18.2584 13.5998 19.4368 13.0286 20.8156C12.4575 22.1943 12.308 23.7115 12.599 25.1752C12.8901 26.6389 13.6087 27.9834 14.6639 29.0387C15.7192 30.094 17.0636 30.8127 18.5273 31.1038C19.991 31.395 21.5081 31.2456 22.8869 30.6746C24.2657 30.1035 25.4442 29.1364 26.2733 27.8955C27.1024 26.6547 27.5449 25.1958 27.5449 23.7035C27.5428 21.703 26.7472 19.7852 25.3328 18.3706C23.9183 16.956 22.0005 16.1603 20.0001 16.158V16.158Z" fill="black"/>
                                    <path d="M20.0002 24.244C19.9103 24.244 19.8218 24.2217 19.7427 24.1789C19.6636 24.1362 19.5964 24.0744 19.5472 23.9991L16.5521 19.4207C16.5132 19.3611 16.4865 19.2945 16.4734 19.2245C16.4603 19.1546 16.4611 19.0828 16.4757 19.0132C16.4904 18.9435 16.5186 18.8775 16.5588 18.8188C16.599 18.7601 16.6503 18.7098 16.7099 18.671C16.7695 18.6321 16.8362 18.6054 16.9061 18.5923C16.976 18.5792 17.0479 18.58 17.1175 18.5946C17.1871 18.6093 17.2531 18.6375 17.3119 18.6777C17.3706 18.7179 17.4208 18.7692 17.4597 18.8288L20.4548 23.4072C20.5083 23.4889 20.5387 23.5836 20.5427 23.6812C20.5467 23.7788 20.5242 23.8756 20.4776 23.9615C20.431 24.0473 20.362 24.1189 20.2779 24.1686C20.1938 24.2184 20.0979 24.2444 20.0002 24.244V24.244Z" fill="black"/>
                                    <path d="M20 18.4328C19.8764 18.4316 19.7571 18.3876 19.6623 18.3084C19.5674 18.2291 19.5029 18.1195 19.4797 17.9982C19.4565 17.8768 19.476 17.7511 19.535 17.6425C19.5939 17.5339 19.6886 17.449 19.803 17.4023C19.9174 17.3556 20.0444 17.3499 20.1626 17.3862C20.2807 17.4225 20.3826 17.4985 20.451 17.6014C20.5194 17.7044 20.5501 17.8278 20.5378 17.9507C20.5256 18.0737 20.4712 18.1886 20.3838 18.276C20.2801 18.3747 20.1431 18.4307 20 18.4328Z" fill="black"/>
                                    <path d="M20.0003 30.0542C19.9291 30.0549 19.8585 30.0414 19.7926 30.0145C19.7267 29.9876 19.6668 29.9478 19.6165 29.8975C19.5661 29.8472 19.5263 29.7873 19.4994 29.7214C19.4725 29.6555 19.459 29.5849 19.4597 29.5137C19.4606 29.443 19.4753 29.3733 19.503 29.3083C19.5304 29.2428 19.5688 29.1825 19.6165 29.1299C19.6795 29.0675 19.7568 29.0215 19.8417 28.996C19.9266 28.9705 20.0165 28.9663 20.1035 28.9837C20.1904 29.0011 20.2717 29.0397 20.3402 29.096C20.4087 29.1523 20.4624 29.2245 20.4964 29.3064C20.5304 29.3883 20.5437 29.4773 20.5352 29.5655C20.5267 29.6538 20.4966 29.7386 20.4476 29.8125C20.3986 29.8864 20.3321 29.9471 20.2541 29.9892C20.1761 30.0314 20.089 30.0537 20.0003 30.0542V30.0542Z" fill="black"/>
                                    <path d="M25.8108 24.2434C25.6677 24.2413 25.5307 24.1854 25.427 24.0867C25.3782 24.035 25.3396 23.9744 25.3135 23.9083C25.2858 23.8433 25.2711 23.7735 25.2703 23.7029C25.2724 23.5598 25.3283 23.4227 25.427 23.3191C25.5044 23.2463 25.6008 23.197 25.7051 23.1769C25.8095 23.1568 25.9173 23.1667 26.0162 23.2056C26.0817 23.233 26.142 23.2714 26.1946 23.3191C26.2933 23.4227 26.3493 23.5598 26.3513 23.7029C26.3532 23.7738 26.3384 23.8442 26.3081 23.9083C26.2838 23.9754 26.2451 24.0363 26.1947 24.0867C26.1442 24.1372 26.0833 24.1759 26.0162 24.2002C25.9521 24.2305 25.8817 24.2453 25.8108 24.2434V24.2434Z" fill="black"/>
                                    <path d="M14.1892 24.2434C14.0461 24.2413 13.9091 24.1853 13.8054 24.0866C13.7554 24.0359 13.7167 23.9751 13.6919 23.9083C13.6642 23.8433 13.6495 23.7735 13.6487 23.7029C13.6508 23.5598 13.7068 23.4227 13.8054 23.3191C13.8822 23.2453 13.9787 23.1954 14.0833 23.1752C14.1878 23.1551 14.2959 23.1656 14.3946 23.2056C14.4608 23.2317 14.5213 23.2702 14.573 23.3191C14.6492 23.3947 14.7012 23.4913 14.7223 23.5965C14.7435 23.7018 14.7328 23.811 14.6916 23.9101C14.6504 24.0093 14.5806 24.094 14.4912 24.1533C14.4017 24.2127 14.2966 24.244 14.1892 24.2434V24.2434Z" fill="black"/>
                                    </svg></span>
                                </div>
                                <input id="price" type="text" class="form-control @error('item_weight') is-invalid @enderror" name="item_weight" value="{{ old('item_weight') ?? $item->item_weight }}"  autocomplete="item_weight" placeholder="Item Weight" autofocus>
                                
                                </div>
                                @error('item_weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="error_img" id="empty_item_weight"></div>
                            </div>
                            <label for="ingredients" class="label_class">Item Image</label>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="blog_image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file'  name="category_image" id="category_image" class="form-control @error('category_image') is-invalid @enderror"/>
                                                <label for="category_image" id="cat_img"><i class="fas fa-edit"></i></label>
                                            </div>
                                            <div class="avatar-preview">
                                                @if(isset($item->item_image))
                                                <div id="category_image_preview" style="background-image: url({{$item->item_image}});">
                                                </div>
                                                @else
                                                 <div id="category_image_preview" style="background-image: url({{URL::asset('assets/img/thumbnail-default_2.jpg')}});">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 @error('category_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>`
                                @enderror
                                 <div class="error_img" id="empty_img"></div>
                            </div>
                           
                            <label for="ingredients" class="label_class">Category</label>
                             <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-satisfied"></i></span>
                                    </div> 
                                    <select class="form-control @error('category') is-invalid @enderror" name="category" id="dish_type">
                                        <option value="">Category</option>                                   
                                        @foreach($categories as $category)
                                        <option value="{{ $category['id'] }}" {{ $category['id']== $item['category_id'] ? 'selected' : '' }}>{{$category['category_name']}}
                                        </option>
                                        @endforeach 
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            <label for="ingredients" class="label_class">Item Description</label>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><svg width="14" height="27" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M34.9397 5.30116H31.5662V1.92773C31.5663 0.86742 30.6987 0 29.6389 0H5.06022C3.99999 0 3.13257 0.86742 3.13257 1.92773V32.771C3.13257 33.8313 3.99999 34.6988 5.0603 34.6988H8.43381V38.0723C8.43381 39.1325 9.30084 40 10.3615 40H26.7466C27.8064 40 29.3061 39.4053 30.0777 38.6791L35.4627 33.6102C36.2352 32.8839 36.8666 31.4217 36.8666 30.3615L36.8675 7.22905C36.8674 6.16866 35.9999 5.30116 34.9397 5.30116ZM8.43365 7.22897V33.253H5.06022C4.79905 33.253 4.57835 33.0323 4.57835 32.7711V1.92773C4.57835 1.66656 4.79905 1.44586 5.06022 1.44586H29.639C29.8997 1.44586 30.1209 1.66656 30.1209 1.92773V5.30124H10.3614C9.30068 5.30124 8.43365 6.16866 8.43365 7.22897ZM34.4718 32.5575L29.0867 37.626C28.9764 37.7297 28.8328 37.8313 28.6742 37.9281V33.4939C28.6742 33.1628 28.8077 32.8649 29.0279 32.6433C29.2501 32.4231 29.5479 32.2892 29.879 32.2892H34.7007C34.6259 32.3907 34.5494 32.4842 34.4718 32.5575ZM35.4206 30.3613C35.4206 30.5045 35.3945 30.6703 35.3551 30.8432H29.8789C28.4163 30.8461 27.2313 32.0312 27.2283 33.4938V38.4957C27.0563 38.5305 26.8905 38.554 26.7464 38.554H10.3614V38.5541C10.0997 38.5541 9.87951 38.3334 9.87951 38.0722V7.22889C9.87951 6.96772 10.0997 6.74702 10.3614 6.74702H34.9396C35.2008 6.74702 35.4215 6.96772 35.4215 7.22889L35.4206 30.3613Z" fill="#393939"/>
                                        <path d="M29.6389 12.0481H15.6631C15.2635 12.0481 14.9402 12.3715 14.9402 12.771C14.9402 13.1705 15.2636 13.4939 15.6631 13.4939H29.6389C30.038 13.4939 30.3618 13.1705 30.3618 12.771C30.3618 12.3715 30.038 12.0481 29.6389 12.0481Z" fill="#393939"/>
                                        <path d="M29.6389 21.6865H15.6631C15.2635 21.6865 14.9402 22.0099 14.9402 22.4094C14.9402 22.8089 15.2636 23.1323 15.6631 23.1323H29.6389C30.038 23.1323 30.3618 22.8089 30.3618 22.4094C30.3618 22.0098 30.038 21.6865 29.6389 21.6865Z" fill="#393939"/>
                                        <path d="M23.3738 26.5059H15.6631C15.2635 26.5059 14.9402 26.8292 14.9402 27.2287C14.9402 27.6283 15.2635 27.9516 15.6631 27.9516H23.3738C23.7729 27.9516 24.0963 27.6283 24.0963 27.2287C24.0963 26.8292 23.7729 26.5059 23.3738 26.5059Z" fill="#393939"/>
                                        <path d="M29.6389 16.8674H15.6631C15.2635 16.8674 14.9402 17.1908 14.9402 17.5903C14.9402 17.9899 15.2636 18.3132 15.6631 18.3132H29.6389C30.038 18.3132 30.3618 17.9899 30.3618 17.5903C30.3618 17.1908 30.038 16.8674 29.6389 16.8674Z" fill="#393939"/>
                                        </svg></span>
                                </div>
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"  placeholder="Item description" autofocus>{{ old('description') ??$item->description}}</textarea>
                                
                                </div>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>
                            <label for="ingredients" class="label_class">Item Price</label>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><svg width="14" height="27" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 0C8.97195 0 0 8.97195 0 20C0 24.5652 1.57844 29.0301 4.44469 32.5722C4.72258 32.9156 5.22648 32.9687 5.56977 32.6908C5.9132 32.4129 5.96633 31.9091 5.68836 31.5656C3.05195 28.3075 1.6 24.2 1.6 20C1.6 9.85422 9.85422 1.6 20 1.6C30.1458 1.6 38.4 9.85422 38.4 20C38.4 30.1458 30.1458 38.4 20 38.4C15.8 38.4 11.6927 36.948 8.43453 34.3116C8.09109 34.0339 7.5875 34.0869 7.30945 34.4304C7.03156 34.7738 7.08469 35.2775 7.4282 35.5555C10.9702 38.4216 15.4348 40 20 40C31.028 40 40 31.028 40 20C40 8.97195 31.028 0 20 0Z" fill="#393939"/>
                                    <path d="M28.1408 8.7445C28.379 8.37247 28.2704 7.87763 27.8984 7.63942C25.5418 6.13075 22.8107 5.33325 20.0001 5.33325C11.9129 5.33325 5.3335 11.9126 5.3335 19.9999C5.3335 28.0872 11.9129 34.6665 20.0001 34.6665C28.0874 34.6665 34.6668 28.0872 34.6668 19.9999C34.6668 16.5804 33.4645 13.2516 31.2814 10.6268C30.9988 10.2871 30.4944 10.2408 30.1547 10.5234C29.815 10.8058 29.7687 11.3103 30.0513 11.65C31.9958 13.9881 33.0668 16.9534 33.0668 19.9999C33.0668 27.2049 27.2051 33.0665 20.0001 33.0665C12.7951 33.0665 6.9335 27.2049 6.9335 19.9999C6.9335 12.7949 12.7951 6.93325 20.0001 6.93325C22.5044 6.93325 24.9371 7.64341 27.0357 8.987C27.4076 9.22521 27.9024 9.11677 28.1408 8.7445Z" fill="#393939"/>
                                    <path d="M22.4 16.8001C22.4 17.2419 22.7582 17.6001 23.2 17.6001C23.6418 17.6001 24 17.2419 24 16.8001C24 14.8684 22.6236 13.2523 20.8 12.8807V11.4667C20.8 11.025 20.4418 10.6667 20 10.6667C19.5582 10.6667 19.2 11.025 19.2 11.4667V12.8807C17.3764 13.2523 16 14.8684 16 16.8001C16 18.7318 17.3764 20.3479 19.2 20.7196V25.4625C18.2689 25.1323 17.6 24.2431 17.6 23.2001C17.6 22.7583 17.2418 22.4001 16.8 22.4001C16.3582 22.4001 16 22.7583 16 23.2001C16 25.1318 17.3764 26.7479 19.2 27.1195V28.5335C19.2 28.9752 19.5582 29.3335 20 29.3335C20.4418 29.3335 20.8 28.9752 20.8 28.5335V27.1195C22.6236 26.7479 24 25.1318 24 23.2001C24 21.2684 22.6236 19.6523 20.8 19.2806V14.5377C21.7311 14.8679 22.4 15.7571 22.4 16.8001ZM19.2 19.0625C18.2689 18.7323 17.6 17.8431 17.6 16.8001C17.6 15.7571 18.2689 14.8679 19.2 14.5377V19.0625ZM22.4 23.2001C22.4 24.2431 21.7311 25.1323 20.8 25.4625V20.9378C21.7311 21.2679 22.4 22.1571 22.4 23.2001Z" fill="#393939"/>
                                    </svg></span>
                                </div>
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price')??$item->price }}"  autocomplete="price" placeholder="Price" autofocus>
                                
                                </div>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="error_img" id="empty_name"></div>
                            </div>
                             
                 
                            <div class="text-right">
                                <button type="submit" id="save_cat" class="btn btn-primary mt-3">Update</button>
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
    item_name:{
        required:true,
        minlength: 4
    },
    item_weight:{
        required:true,
        number: true
    },
    /*category_image:{
        required:true
    },*/
    category:{
        required:true
    },
    description:{
        required:true
    },
    price:{
        required:true,
        number: true
    },
},messages: {
    item_name: {
        required: "Please provide item name",
        minlength: jQuery.validator.format("At least {0} characters required!")
    },
    item_weight: {
        required: "Please provide weight",
        number: "Only numbers allowed",
    },
    /*category_image: {
    required: "Please provide item image"
    },*/
    category: {
    required: "Please select category"
    },
    description : {
    required: "Please provide description"
    },
    price: {
    required: "Please provide price",
    number: "Only numbers allowed",
    },
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