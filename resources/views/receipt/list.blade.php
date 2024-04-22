@extends('layouts.layout')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="invoice-list-wrapper">
                    <div class="card">
                        <div class="card-datatable m-1">
                            <table class="produk-list-table table" id="produk">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pembeli</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th class="cell-fit">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($data as $dt)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $dt['customer'] ? $dt['customer'] : 'Null' }}</td>
                                            <td>Rp {{ number_format($dt['sub_total'], 2, ',', '.') }}</td>
                                            <td>{{ $dt['status'] }}</td>
                                            <td class="">
                                                <div class="d-flex">
                                                    <a href="{{ Route('receiptDetail', $dt->id) }}" class="btn btn-warning me-1 {{ $dt->status == 'Undone' ? 'disabled' : '' }}"><i data-feather="eye"></i></a>
                                                    {{-- <form action="{{ Route('func-receipt-delete', $dt->id) }}" method="POST" class="m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection