@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-2">
            <ul class="list-group">
                 <a href="{{ route('orders') }}" class="list-group-item">Orders</a>
                 <a href="{{ route('price-requests.index') }}" class="list-group-item">Price Requests</a>
                 <a href="#" class="list-group-item">Items</a>
                 <a href="#" class="list-group-item">Items</a>
                 <a href="#" class="list-group-item">Items</a>
              </ul>
        </div>
        <div class="col-md-10">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">View</li>
                  <li class="breadcrumb-item"><a href="{{ route('order.create') }}">Create</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('orders.export')}}">Export</a></li>

                </ol>
              </nav>
            <div class="card">
                <div class="card-header">{{ __('Orders') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Items</th>
                            <th scope="col">Descriptions</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Units</th>
                            <th width="280px">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->items }}</td>
                                <td>{{ $order->descriptions }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->units }}tonnes</td>
                                <td>
                                    <form action="{{ route('orders.delete',$order->id) }}" method="POST">

                                        {{-- <a class="btn btn-info btn-sm" href="{{ route('order.show', $order->id) }}">Show</a> --}}
                                         @if (!$order->done)
                                            <a class="btn btn-success btn-sm" href="{{ route('orders.done',$order->id) }}">Done</a>

                                         @endif
                                        <a class="btn btn-primary btn-sm" href="{{ route('orders.edit',$order->id) }}">Edit</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {!! $orders->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
