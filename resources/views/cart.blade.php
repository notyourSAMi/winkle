<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script> --}}

</head>
@include('head')

<body class="goto-here">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show corner-alert" role="alert">

            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show corner-alert" role="alert">

            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif
    <div class="py-1 bg-black">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-phone2"></span></div>
                            <span class="text">+ 1235 2355 98</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-paper-plane"></span></div>
                            <span class="text">youremail@email.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text">3-5 Business days delivery &amp; Free Returns</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('navbar');

    <!-- END nav -->

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span>
                    </p>
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th style="
    background-color: black;
">&nbsp;</th>
                                    <th style="
    background-color: black;
">&nbsp;</th>
                                    <th style="
    background-color: black;
">Product</th>
                                    <th style="
    background-color: black;
">Price</th>
                                    <th style="
    background-color: black;
">Quantity</th>
                                    <th style="
    background-color: black;
">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session('cart'))
                                    @php
                                        $Payment = 0;
                                        $discountPercentage = 5;
                                    @endphp
                                    @foreach (session('cart') as $id => $details)
                                        <tr rowId="{{ $id }}" class="text-center">
                                            <td class="product-remove"><a
                                                    href="{{ route('delete.cart.product', ['id' => $id]) }}"><span
                                                        class="ion-ios-close"></span></a></td>


                                            <td class="image-prod">
                                                <div class="img"
                                                    style="background-image:url({{ $details['image'] }});"></div>

                                            </td>

                                            <td class="product-name">
                                                <h3>{{ $details['name'] }}</h3>
                                            </td>

                                            <td class="price">{{ $details['price'] }}</td>

                                            <td class="quantity">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="quantity"
                                                        class="quantity form-control input-number"
                                                        value="{{ $details['quantity'] }}" min="1"
                                                        max="100">
                                                </div>
                                            </td>

                                            <td class="total">
                                                ${{ (float) str_replace('$', '', $details['price']) * (int) $details['quantity'] }}
                                            </td>
                                            <form action="{{ url('/Cart/Checkout') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="p_name[]" value="{{ $details['name'] }}">
                                                <input type="hidden" name="p_price[]" value="{{ $details['price'] }}">
                                                <input type="hidden" name="p_qty[]"
                                                    value="{{ $details['quantity'] }}">
                                                <input type="hidden" name="img[]" value="{{ $details['image'] }}">
                                                {{-- for user who is checking out --}}
                                                {{-- <input type="hidden" name="p_name" value="{{$details['']}}"> --}}

                                        </tr>
                                        @php
                                            $itemPrice = (float) str_replace('$', '', $details['price']);
                                            $quantity = (int) $details['quantity'];
                                            $Payment += $itemPrice * $quantity;
                                        @endphp
                                    @endforeach
                                    @php
                                        $discountAmount = ($Payment * $discountPercentage) / 100;
                                        $totalPayment = $Payment - $discountAmount;
                                    @endphp
                                @else
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center">
                                            <h3>Shopping Cart Is Empty</h3>
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                @endif
                                <!-- END TR-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>
                                @if (isset($totalPayment))
                                    ${{ number_format($Payment, 2) }}
                                @else
                                    $0
                                @endif
                            </span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span>$0.00</span>
                        </p>
                        <p class="d-flex">
                            <span>Discount</span>
                            <span>
                                @if (isset($totalPayment))
                                    ({{ $discountPercentage }}%): ${{ number_format($discountAmount, 2) }}
                                @else
                                    $0
                                @endif
                            </span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>
                                @if (isset($totalPayment))
                                    ${{ number_format($totalPayment, 2) }}
                                @else
                                    $0
                                @endif
                            </span>
                        </p>
                    </div>
                    <p class="text-center"><input type="submit" class=" py-3 px-4 btn btn-primary"
                            value="Proceed to Checkout"></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('footer')




    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    @include('scripts')

    @section('scripts')
        <script>
            $(document).on("click", ".product-remove a", function(e) {
                e.preventDefault();
                var product = $(this);
                if (confirm("Do you really want to delete")) {
                    $.ajax({
                        url: product.attr('href'),
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });


            $(document).ready(function() {

                var quantitiy = 0;
                $('.quantity-right-plus').click(function(e) {

                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    var quantity = parseInt($('#quantity').val());

                    // If is not undefined

                    $('#quantity').val(quantity + 1);


                    // Increment

                });

                $('.quantity-left-minus').click(function(e) {
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    var quantity = parseInt($('#quantity').val());

                    // If is not undefined

                    // Increment
                    if (quantity > 0) {
                        $('#quantity').val(quantity - 1);
                    }
                });

            });
        </script>
    @endsection

</body>

</html>
