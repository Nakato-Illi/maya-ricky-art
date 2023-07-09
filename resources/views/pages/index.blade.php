@extends('layouts.app')


@section('content')
    <div class="index-hero">
    </div>
    <div class="about-container">
        <div class="about-container-text">
            <h3>About Us</h3>
            <p>Bla text wir und so weiter. Bestehen seid. Sind Familie
                mit viel Fantasie. Voll tolle Bilder uns so. Kauft gerne.
                Persönlich haben wir einen Stand dort so an den Tagen. Sonst online genießen und erwerben. Wird
                Deutschlandweit verschickt. Juhuuuuu</p>
        </div>
        <div class="about-container-img"></div>
    </div>
    <div class="message-index-container">
        <h2>Send us a Message</h2>

        <form method="GET" action="/home" class="contact-container">

            <label for="fname">First name :</label>
            <input type="text" id="fname" name="fname" value=""><br>

            <label for="lname">Last name :</label>
            <input type="text" id="lname" name="lname" value=""><br>

            <label for="email">E-Maile: </label>
            <input type="text" id="email" name="email" value=""><br>

            <label for="message">You message: </label>
            <textarea id="message" name="message"></textarea><br>

            <div class="container-sub-del">
                <input type="submit" value="Submit">
                <input type="submit" value="Delete">
            </div>

        </form>
    </div>
@endsection
