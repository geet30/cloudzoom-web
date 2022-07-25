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
                    <h3 class="mb-0">Order Detail</h3>
                </div>
                <div class="col text-right">
                   <button class="btn btn-sm btn-primary" onclick="window.history.go(-1); return false;">Back</button>
                </div>
                </div>
            </div>
            <div class="container">
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                        <div class="col-sm-4"> Order ID</div>
                             <div class="col-sm-8"> {{ $order_view->id}}</div>
                        </div>
                        <div class="row">
                        <div class="col-sm-4">Sub total </div>
                          <div class="col-sm-8">{{$order_view->sub_total}}</div>
                        </div>
                        <div class="row">
                        <div class="col-sm-4"> Service fee</div>
                          <div class="col-sm-8">{{$order_view->service_fee}}</div>
                        </div>
                        <div class="row">
                        <div class="col-sm-4">  Delievery fee </div>         
                          <div class="col-sm-8">{{$order_view->delivery_fee}}</div>
                        </div>
                        <div class="row">
                        <div class="col-sm-4">Order Status  </div>    
                          <div class="col-sm-8">{{$order_view->order_status}}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                           <div class="col-sm-4">User Name </div>    
                          <div class="col-sm-8">{{$order_view->user->name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"> User Email  </div>
                            <div class="col-sm-8">{{ $order_view->user->email }} </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"> Discount </div>
                            <div class="col-sm-8"> {{$order_view->discount}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">Total </div>
                            <div class="col-sm-8"> {{$order_view->total}} </div>
                        </div>
                        @if(isset($order_view->promos->name) && !empty( $order_view->promos->name))
                        <div class="row">
                            <div class="col-sm-4">Promo Name </div>
                            <div class="col-sm-8"> {{$order_view->promos->name}}  </div>
                        </div>
                        @endif
                        @if(isset($order_view->promos->promo_code) && !empty( $order_view->promos->promo_code))
                        <div class="row">
                            <div class="col-sm-4">Promo Code </div>
                            <div class="col-sm-8"> {{$order_view->promos->promo_code}} </div>
                        </div>
                        @endif
                    </div>
                  </div>

              </div>
      
            <div class="table-responsive">
            <table class="table table-sm table-striped table-hover dataTable no-footer" id="dataTable">
              <thead>
                  <tr>
                      <th scope="col" class="sort" data-sort="name">Sr No</th>
                      <th scope="col" class="sort" data-sort="name">Category Name</th>
                      <th scope="col" class="sort" data-sort="name">Product Name</th>
                      <th scope="col" class="sort" data-sort="email">Quantity</th>
                      <th scope="col" class="sort" data-sort="name">Price</th>
                  </tr>
              </thead>
              <tbody class="list">
                  @php {{$count=1;}} {{$total_quantity = 0; }}@endphp
                  
                   @foreach($order_products as $order)
                  <tr>
                      <th>{{ $count++ }}</th>
                      @foreach($order->product as $product)
                      <th>{{ $product->Category->category_name }}</th>
                     
                      <th>{{ $product->item_name }}</th>
                      
                      <th>{{ $order->quantity}}
                      <th>{{ $product->price }}</th>
                      @endforeach
                      
                  </tr>
                  @endforeach
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