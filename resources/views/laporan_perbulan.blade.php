@extends('layout.layout')
@section('content')
    <div class="row mt-3">
        <div class="table">
            <table id="datatables" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Rekening</th>
                        <th>Nama</th>
                        <th>Point</th>
                    </tr>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach ($data as $d)
                        <tr>
                            <td>{{++$no}}</td>
                            <td>{{$d->norekening}}</td>
                            <td>{{$d->namalengkap}}</td>
                            <td>{{intval($d->point)}}</td>
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
