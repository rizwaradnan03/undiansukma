@extends('layout.layout')
@section('content')
    <div class="row mt-3">
        <div class="table">
            <table id="datatables" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Jumlah</th>
                    </tr>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach ($data as $d)
                        <tr>
                            <td>{{++$no}}</td>
                            <td>{{$d->date}}</td>
                            <td>{{$d->jumlah}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#datatables').DataTable();
    </script>
@endsection
