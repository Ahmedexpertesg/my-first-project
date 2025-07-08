@extends ('Layouts.admin')

@section('admin')


    <div class="container-fluid">

        <h2 class="h3 mb-2 text-gray-800">Orders</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Orders</h6>

                {{-- Assuming you have a route named 'products.create' for your product creation form --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Actions</th> {{-- Actions column --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allOrders as $order)
                                @php
                                    // Initialize orderTotal for the current order
                                    $orderTotal = 0;
                                    // Loop through order items attached to this order
                                    // Accessing product info via $item->product
                                    foreach ($order->items as $item) { // <-- CHANGED from $order->products
                                        // Ensure 'price' and 'quantity' are available directly on the OrderItem model
                                        $itemPrice = $item->price;    // <-- CHANGED from $product->pivot->price
                                        $itemQuantity = $item->quantity; // <-- CHANGED from $product->pivot->quantity
                                        $orderTotal += $itemPrice * $itemQuantity;
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        {{ $order->id }}
                                    </td>
                                    <td>
                                        {{-- Assuming 'name' column exists on your Order model for customer name --}}
                                        {{-- OR if customer is a relationship: $order->user->name --}}
                                        {{ $order->name ?? ($order->user->name ?? 'N/A') }} {{-- Use $order->name if it's directly on Order model, or adjust --}}
                                        {{-- If Order has a 'user' relationship, prefer: {{ $order->user->name }} (ensure user is eager loaded) --}}
                                    </td>
                                    <td>
                                        {{-- Display the calculated order total, formatted as currency --}}
                                        ${{ number_format($orderTotal, 2) }}
                                    </td>

                                    <td>
                                        {{ $order->created_at->format('M d, Y H:i A') }}
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let table = new DataTable('#dataTable');
        });
    </script>
@endpush
