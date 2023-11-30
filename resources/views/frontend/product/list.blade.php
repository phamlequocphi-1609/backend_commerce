@extends('frontend.layouts.app')
@section('content')
<section id="cart_items">
    <div class="breadcrumbs">
                    <ol class="breadcrumb">
                    <li><a href="{{url('/index')}}">Home</a></li>
                    <li class="active">Shopping Cart</li>
                    </ol>
                </div>
                <div class="table-responsive cart_info">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h4><i class="icon fa fa-check"></i>Thông báo !</h4>
                            {{session('success')}}
                        </div>
                    @endif
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Id</td>
                                <td class="name">Name</td>
                                <td class="image">Image</td>
                                <td class="price">Price</td>
                                <td class="action">Action</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>

                          @foreach($getProducts as $product)
                                @php
                                    $imgArr = json_decode($product['image'], true);
                                @endphp
                                <tr>
                                    <td>
                                        <p>{{$product['id']}}</p>
                                    </td>
                                    <td>
                                        <p>{{$product['name']}}</p>
                                    </td>
                                    <td class="cart_product">
                                        @if(isset($imgArr[0]))
                                            <a href="">
                                                <img src="{{asset('upload/product/'.$imgArr[0])}}" alt="" style="width: 100px">
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <p>{{$product['price']}}</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a href="{{route('productEdit', ['id' => $product['id']])}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                                <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                                            </svg>
                                        </a>
                                     </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="{{route('productDelete', ['id'=>$product['id']])}}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                          @endforeach
                        </tbody>
                    </table>

        </div>
          <div style="text-align: right; margin-bottom: 30px; ">
                <a href="{{url('/member/account/add-product')}}" class="btn btn-success">Add Product</a>
          </div>
</section>
@endsection
