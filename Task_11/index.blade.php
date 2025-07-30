@extends( 'dashboard.products.layout')
@section('title', 'Halaman Produk Blade')
@section('content')
   <h1> List Product</h1>
   <a href="{{ route('products.create') }}">Add new product</a>
   <table>
    <thead>
        <tr>
            <th> Name</th>
            <th> Price</th>
            <th> Actions</th>
        </tr>
    </thead>
   </table>

@endsection