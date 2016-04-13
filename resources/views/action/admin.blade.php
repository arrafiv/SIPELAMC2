@extends('layouts.master') @section('styles')
<style>
    body {
        background-color: #F9F6F6;
    }
    
    #row {
        margin: 2em;
    }
    
    #assethome {
        margin-top: 2em;
    }
</style>
@endsection @extends('elements.element') @section('content')
<div>
    <div class="row" id="row">
        <div class="col s12 l9">
            <h1>Ini Admin</h1>
        </div>
        <div class="col s12 l3">
            <div class="card blue-grey lighten-5">
                <div class="card-content white">
                    <span class="card-title">Card Title</span>
                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
            </div>
        </div>
    </div>

    @endsection @section('script')
    <script>
        $(document).ready(function () {
        $('.slider').slider({
            full_width: true
        });
        $(".button-collapse").sideNav();
    });
    </script>
    @endsection