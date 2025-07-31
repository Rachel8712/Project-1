@extends('dashboard.layoutcart')
@section('title','Keranjang Belanja')
@section('content')

    <h2 class="mb-4">Keranjang Belanja</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Total</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Produk A</td>
                <td>Rp 100.000</td>
                <td>
                    <input type="number" class="form-control" value="1" min="1">
                </td>
                <td>Rp 100.000</td>
                <td>
                    <button class="btn btn-danger">Hapus</button>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Produk B</td>
                <td>Rp 200.000</td>
                <td>
                    <input type="number" class="form-control" value="1" min="1">
                </td>
                <td>Rp 200.000</td>
                <td>
                    <button class="btn btn-danger">Hapus</button>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Produk C</td>
                <td>Rp 150.000</td>
                <td>
                    <input type="number" class="form-control" value="1" min="1">
                </td>
                <td>Rp 150.000</td>
                <td>
                    <button class="btn btn-danger">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
    
    <div class="d-flex justify-content-between">
        <h4>Total Keseluruhan: <span id="total">Rp 450.000</span></h4>
        <button class="btn btn-primary">Lanjutkan ke Pembayaran</button>
    </div>
@endsection

