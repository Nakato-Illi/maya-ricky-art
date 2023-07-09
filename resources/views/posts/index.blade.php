@extends('layouts.app')

@section('content')

    <component :is="'script'">
        var jcart = '';
        var cartItems = [];
        var click = false;

    </component>

    @php
    function rm($arr) {
//        unset($arr);
        print_r($arr);
        return 'cool';
    }
    @endphp

        <h1 class="margin-top-content">Welcome to our Gallery</h1>
        <div class="gallery-container">
            <div class="left-container-gal">
                @if( count($posts) > 1)
                    <div class="gallery-container-img">
                        @foreach($posts as $post)
                            <div class="img-container-gal-text">
                                <div class="img-container-gal">
                                    {{--                    <img style="width: 100%" src="/storage/gal_img/{{$post->gal_img}}" alt="">--}}
                                    <a href="/posts/{{$post->id}}"><img class="gallery-img"
                                                                        src="/storage/gal_img/{{$post->gal_img}}"
                                                                        alt=""></a>
                                </div>
                                <div class="but-margin">


                                    <h3 class="gal-title">{{$post->title}}</h3>
                                    <small>Price {{$post->price}}</small>
                                    <div class="gal-but-con">
                                            <button>Details</button>
                                            <button>Buy</button>
                                            <button type="submit" name="cart" id="cart{{$post->id}}">Einkaufswagen</button>
                                    </div>
                                    <component :is="'script'">
                                        console.log(cartItems, "qwertzuioyxcvbnm");
                                        var e = document.getElementById('cart{{$post->id}}');
                                        e.addEventListener("click", () => {

                                        if (document.readyState === 'complete' && !document.getElementById('{{$post->id}}')) {
                                        var cart = document.getElementById('cartContent');
                                        var sum = document.getElementById('cartSum');
                                        const c = document.createElement('div');
                                        c.id = '{{$post->id}}';
                                        const n = document.createTextNode('{{$post->title}} ');
                                        const p = document.createTextNode('{{$post->price}}');
                                        cartItems.push(<?php echo json_encode($post); ?>);
                                        jcart = <?php echo json_encode($post); ?>;

                                        c.appendChild(n);
                                        c.appendChild(p);
                                        sum.innerHTML = cartItems.map(item => item.price).reduce((a,b) => a+b);
                                        cart.appendChild(c);
                                        }
{{--                                        var v = <?php echo array_push($cartItems, $post); ?>--}}
                                        console.log(sum, cartItems, "qwertzuiopölkjhgfdsayxcvbnm", <?php echo json_encode($cartItems) ?>);
                                        });
{{--                                        var n = <?php echo rm($cartItems); ?>;--}}
                                        console.log({{$post->id}}, "qwertzuioyxcvbnm", e.innerHTML);
                                    </component>
                                        <?php
//                                                                            $cartItems[0] = $post;
//                                        echo "<script type=\"text/javascript\">
//                                            var e = document.getElementById('cart');
//                                            e.addEventListener(\"click\", () => {console.log(\"qwertzuiopölkjhgfdsayxcvbnm\")});
//                                         </script>"
                                        if(array_key_exists('cart', $_POST)){
                                            $post->price = 55;
                                            print '---------------------------------------';
                                            $cartItems[0] = $post;
                                        }
                                        ?>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                @endif
            </div>
            <div class="right-container-gal">
                @if(count($posts) > 1)
{{--                    <small>{{$posts}}</small>--}}
                    <div id="cartContent" class="gallery-container-img">
                        @foreach($cartItems as $item )
                            <div>
                                <small>{{$item->title}} </small>
                                <small>{{$item->price}}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                @endif
{{--                    {{array_sum(array_map(function ($e){ return $e->price;}, $cartItems))}}--}}
                <p>Summe <small id="cartSum">0</small></p>
                <div>

                    <button id="cart-delete">Delete</button>
                    <component :is="'script'">
                        var e = document.getElementById('cart-delete');
                        e.addEventListener("click", () => {
                        if (document.readyState === 'complete') {
                        var cart = document.getElementById('cartContent');
                        var sum = document.getElementById('cartSum');

                        cartItems.length = 0;
                        cart.innerHTML = '';
                        sum.innerHTML = '0';

                        }
                        });

                    </component>
                    @php
                        if(isset($_POST['cart-buy'])) {
                            echo '----------------------------------';
                        }
//                        rm($posts);
                    @endphp
                    <form id="cart-buy-form" method="POST" action="services" enctype="multipart/form-data">
                        <button onclick="event.preventDefault(); buycart();" type="submit" id="cart-buy">Buy</button>
                        <div class="form-group" style="padding-bottom: 20px">
                            {{Form::label('items', '$posts')}}
                            {{--                        {{Form::text('items', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}--}}
                        </div>
                        @csrf
                    </form>
                    {!! Form::open(['id' => 'cart-form' , 'action' => '\App\Http\Controllers\PagesController@services', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group" style="padding-bottom: 20px">
{{--                        {{Form::label('posts', '')}}--}}
{{--                        {{Form::label('items', 'posts')}}--}}
                        {{Form::text('items', '', ['id' => 'cartItemss'])}}
                    </div>
                    <component :is="'script'">

                        function buycart() {



                        $.ajax(
                        {
                        type : "POST",
                        url  : "\\services",
                        data : { "_token": "{{ csrf_token() }}", "text": {"items" : jcart}},
{{--                        data : { "_token": "{{ csrf_token() }}", "text": {"items" : JSON.stringify(cartItems)}},--}}
                        header: {"Content-Type": 'application/json'},
                        error: function(res){
                                                console.log('----------------------------------post error', res);


                        },
                        success: function(res){
{{--                        console.log('----------------------------------post success', res);--}}
                        var f = document.getElementById('cartItemss');
                        f.value = JSON.stringify(cartItems);
                        console.log('************+++++++++++++++++++++++------------',f);
                        document.getElementById('cart-form').submit();
{{--                        if(res.redirect) {--}}
{{--                        window.location.href = res.redirect;--}}
{{--                        window.location = '\\services';--}}
{{--                        }--}}
                        }
                        }
                        );
                        }
                    </component>
                    {{Form::submit('Submit', ['class' => 'btn-primary'])}}
                    {!! Form::close() !!}



                </div>
            </div>
        </div>
@endsection
