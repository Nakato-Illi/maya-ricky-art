@extends('layouts.app')


@section('content')
    <h2>Ordersection</h2>
    <h3>Order sum</h3>


    <p>Order details / Item(s)-name + price / order sum </p>
    <?php
            $it = json_decode($items);
            print_r($it);
            print_r($it[0]);
    ?>
    <component :is="'script'">

        console.log('************+++++++++++++++++++++++------------');

    </component>
    <div class="left-container-gal">
    @if(!is_null($it) && count($it) > 1)
    @foreach($it as $item)
        <div>
{{--            <small>{{$item->title}} </small>--}}
{{--            <small>{{$item->price}}</small>--}}
            <small>kuzvligl {{$item}}</small>
            <small>lizlizvl</small>
        </div>
    @endforeach
    @endif
    </div>
    <p>pleas fill in for the order information</p>
    <form method="GET" action="/stripe" class="contact-container">

        <label for="fname">Full Name :</label>
        <input type="text" id="fname" name="fname" value=""><br>

        <label for="adress-name">Adress Name:</label>
        <input type="text" id="lname" name="lname" value=""><br>

        <label for="adress-numb">Adress Number</label>
        <input type="text" id="adress-numb" name="adress-numb" value=""><br>

        <label for="postcode">Post Code</label>
        <input type="text" id="postcode" name="postcode" value=""><br>

        <div class="container-sub-del">
            <input type="submit" value="Submit">
            <input type="reset" value="Delete">
        </div>

    </form>
@endsection
