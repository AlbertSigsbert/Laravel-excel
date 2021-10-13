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
                  <li class="breadcrumb-item"><a href="{{ route('price-requests.create')}}">Create</a></li>
                  <li class="breadcrumb-item"><a href="#">Export</a></li>

                </ol>
              </nav>
            <div class="card">
                <div class="card-header">{{ __('Price Quotes Request') }}</div>

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
                            <th scope="col">Price</th>
                            <th scope="col">Cost</th>
                            <th width="280px">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($priceRequests as $request)
                            <tr>
                                <th scope="row">{{ $request->id }}</th>
                                <td>{{ $request->items }}</td>
                                <td  style="width: 20%;">{{ $request->descriptions }}</td>
                                <td>{{ $request->quantity }}</td>
                                <td>{{ $request->units }}tonnes</td>
                                <td style="width: 15%;">{{ number_format($request->price, 0, ".", ",") }} TZS</td>
                                <td style="width: 15%;">{{ number_format($request->cost, 0, ".", ",") }} TZS</td>
                                <td>
                                    <form action="{{ route('price-requests.delete', $request->id) }}" method="POST">

                                        <a class="btn btn-primary btn-sm" href="{{ route('price-requests.edit', $request->id) }}">Edit</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {!! $priceRequests->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
