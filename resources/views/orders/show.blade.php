@extends('layouts.app')

@section('content')

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">{{$order->items}}</h1>
        <p class="lead">{{$order->descriptions}}</p>
        <hr class="my-4">
        <p>{{$order->descriptions}}</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
      </div>
</div>
@endsection
