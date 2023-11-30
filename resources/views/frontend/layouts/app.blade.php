    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
        <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
        <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="{{asset('frontend/images/ico/favicon.ico')}}">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" href="{{asset('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">

        <link rel="stylesheet" href="{{asset('frontend/css/rate.css')}}">
    </head>
    <body>
        @if(Route::currentRouteName() == 'cart')
            @include('frontend.layouts.header');
            @include('frontend.layouts.slide');
            <section>
                <div class="container">
                    <section>
                            @yield('content')
                    </section>
                </div>
            </section>
            @include('frontend.layouts.footer')
        @else
            @include('frontend.layouts.header')
            @include('frontend.layouts.slide');
            <section>
                <div class="container">
                    <div class="row">
                        @if(Route::currentRouteName() == 'account')
                        @include('frontend.layouts.menu-account')
                        @else
                        @include('frontend.layouts.menu-left')
                        @endif
                        <div class="col-sm-9 padding-right">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
            @include('frontend.layouts.footer')
        @endif


        <script src="{{asset('frontend/js/jquery.js')}}"></script>
        <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
        <script src="{{asset('frontend/js/price-range.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('frontend/js/main.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#form-cmt').submit(function(){
                    var checkLogin="{{Auth::check()}}";
                    var getcmt = $(".messCmt").val();
                    var isSuccess = true;
                    if(checkLogin == false){
                        $(".error").text('Vui lòng đăng nhập trước khi bình luận');
                        return false;
                    }else{
                        if(getcmt === ''){
                            $(".error").text('Xin vui lòng nhập bình luận');
                            return false;
                        }
                    }
                    if(isSuccess == true){
                        return true;
                    }
                })
                $('.comment__reply').click(function() {
                    var getID = $(this).attr('data-id');
                    $('#comment-level').val(getID);
                });



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                    //vote
                $('.ratings_stars').hover(
                    // Handles the mouseover
                    function() {
                        $(this).prevAll().andSelf().addClass('ratings_hover');
                        // $(this).nextAll().removeClass('ratings_vote');
                    },
                    function() {
                        $(this).prevAll().andSelf().removeClass('ratings_hover');
                        // set_votes($(this).parent());
                    }
                );

                $('.ratings_stars').click(function(){
                    var checkLogin = "{{Auth::check()}}";
                    if(checkLogin == false){
                        alert('VUI LÒNG ĐĂNG NHẬP TRƯỚC KHI ĐÁNH GIÁ');
                    }else{
                        var rate =  $(this).find("input").val();
                        var idBlog = $(this).closest(".rating-area").find(".blograte").val();
                        if ($(this).hasClass('ratings_over')) {
                            $('.ratings_stars').removeClass('ratings_over');
                            $(this).prevAll().andSelf().addClass('ratings_over');
                        } else {
                            $(this).prevAll().andSelf().addClass('ratings_over');
                        }
                        $.ajax({
                            type: 'POST',
                            url: "{{url('/member/blog/rate')}}" ,
                            data:{
                                rate: rate,
                                idBlog: idBlog,
                            },
                            success: function(data){
                                console.log(data.success);

                            }
                        })
                    }
                });
                var check = $(".rate-np").text()
                if(check == 1){
                    $('.star_1').addClass('ratings_over');
                }else if(check == 2){
                    $('.star_1, .star_2').addClass('ratings_over');
                }else if(check == 3){
                    $('.star_1, .star_2, .star_3').addClass('ratings_over');
                }else if(check == 4){
                    $('.star_1, .star_2, .star_3, .star_4').addClass('ratings_over');
                }else if(check == 5){
                    $('.star_1, .star_2, .star_3, .star_4, .star_5').addClass('ratings_over');
                }
                var getSaleValue = localStorage.getItem("SelectSaleValue");
                    if (getSaleValue) {
                        var getValue = JSON.parse(getSaleValue);
                        $("#id_sale").val(getValue);
                        if (getValue == '0') {
                            $("#saleShow").hide();
                        } else {
                            $("#saleShow").show();
                        }
                    }
                    $("#id_sale").change(function() {
                        var inputSelect = $(this).val();
                        if (inputSelect == '0') {
                            $("#saleShow").hide();
                        } else {
                            $("#saleShow").show();
                        }

                        var valueSale = JSON.stringify(inputSelect);
                        localStorage.setItem("SelectSaleValue", valueSale);
                    });

                    var getValueStatus = $('#id_sale').val();
                    if (getValueStatus == '1') {
                        $("#saleShow").show();
                    } else {
                        $("#saleShow").hide();
                    }

                    $("button.add-to-cart").click(function(){
                        var getId = $(this).attr('id');
                        // alert(getId);
                        $.ajax({
                            type: "POST",
                            url: "{{url('index')}}",
                            data: {
                                idProduct : getId,
                            },
                            success: function(data){
                                console.log(data.success)
                            }
                        })
                    })
                    
                    // Tính tổng
                    function total_area(){
                        var getPrice = $(".cart_total_price");
                        var s = 0
                        for(var i=0; i<getPrice.length; i++){
                            var getTotal = $(getPrice[i]).text().replace("$", "");
                            s += parseFloat(getTotal)
                        }
                        $(".total_area ul li:first-child span").text("$" + s)
                        var getFax = $(".total_area ul li:nth-child(2) span").text().replace("$", "")
                        var totalPrice = s + parseInt(getFax);
                        $(".total_area ul li:last-child span").text("$" + totalPrice)
                    }
                    total_area()
                    $(".cart_quantity_up").click(function(){
                        var clickIncrease = $(this).closest("tr");
                        var price = parseFloat(clickIncrease.find(".cart_price p").text().replace("$", ""))
                        var qty = clickIncrease.find(".cart_quantity_input");
                        var qtyValue = parseInt(qty.val())
                        qtyValue++;
                        qty.val(qtyValue)
                        var totalPrice = price*qtyValue;
                        clickIncrease.find(".cart_total_price").text("$" + totalPrice)
                        var id = clickIncrease.find(".cart_description p").text().replace("Web ID:", "")
                        $.ajax({
                            method: "POST",
                            url : "{{url('/cart/increase')}}",
                            data: {
                                idProduct: id,
                                qtyNew: qtyValue,
                            },
                            success: function(data){
                                console.log(data.success)
                            }
                        })
                        total_area()
                    })
                    $(".cart_quantity_down").click(function(){
                        var clickDecrease = $(this).closest("tr");
                        var price = parseFloat(clickDecrease.find(".cart_price p").text().replace("$", ""))
                        var qty = clickDecrease.find(".cart_quantity_input")
                        var qtyValue = parseInt(qty.val())
                        var idReduce = clickDecrease.find(".cart_description p") .text().replace("Web ID:", "")
                        if(qtyValue > 1){
                            qtyValue--
                            clickDecrease.find(".cart_quantity_input").val(qtyValue)
                            var total = qtyValue*price;
                            clickDecrease.find(".cart_total_price").text("$" + total)
                            $.ajax({
                                type: "POST",
                                url: "{{url('/cart/reduce')}}",
                                data: {
                                    idProduct: idReduce,
                                    qtyNew: qtyValue,
                                },
                                success: function(data){
                                    console.log(data.success)
                                }
                            })
                        }else{
                            $.ajax({
                                type: "POST",
                                url : "{{url('/cart/remove')}}",
                                data: {
                                    deleteId: idReduce
                                },
                                success: function(data){
                                    console.log(data.success)
                                }
                            })
                        }
                        total_area()
                    })
                    $(".cart_quantity_delete").click(function(){
                        var getId = $(this).attr("id");
                        console.log(getId)
                        $.ajax({
                            type: "POST",
                            url: "{{url('/cart/remove')}}",
                            data: {
                                deleteId : getId,
                            },
                            success: function(data){
                                console.log(data.success)
                            }
                        })
                        total_area()
                    })
                    // $("#tabs li").click(function(){
                    //     $(this).addClass("active")
                    //     $(this).removeClass("active")
                    // })
                    $(".slider").click(function(){
                        var getPrice = $(this).find(".tooltip-inner").text();
                        $.ajax({
                            type: "POST",
                            url: "{{url('/price/selected')}}",
                            data: {
                                priceSelected: getPrice,
                            },
                            success: function(data){
                                const getdata = data.products;  
                                console.log(getdata)          
                                var html = '';
                                getdata.map(function(value, key){
                                    let imgPath = JSON.parse(value.image)[0];            
                                    let img = "http://localhost:8080/user-profile/public/upload/product/" + imgPath;
                                    html += `
                                    <div class="col-sm-4 body">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="${img}" alt="" />
                                                    <h2>${value['price']}</h2>
                                                    <p>${value['name']}</p>
                                                    <button class="btn btn-default add-to-cart" id="${value['id']}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                                <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2>${value['price']}</h2>
                                                        <p>${value['name']}</p>
                                                        <button class="btn btn-default add-to-cart" id="${value['id']}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="choose">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>Product detail</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    `;
                                })
                                $(".features_items").html(html)
                            }
                        })
                    }) 
                    $('.nav-tabs a').on('click', function (e) {
            e.preventDefault();
            var categoryId = $(this).data('category-id');
            $('.category-tab .tab-pane').removeClass('active in');
            $('.category-tab .tab-pane.category-' + categoryId).addClass('active in');
        });
            })
        </script>
    </body>
</html>  

<!-- session()->has('cart): kiểm tra session có khôh
// session()->get('cart'): lấy session ra
// session()->push('cart', $array) : đưa mảng vào so sánh
// session()->put('cart', $getSession) : thay đổi 1 cái trong session -->

