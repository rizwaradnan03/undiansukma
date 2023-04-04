@extends('layout.layout')
@section('content')
<br>
<br>
<h1 class="text-center">LIST PERIODE</h1>
<hr>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="tabel">

</div>
{{-- <table class="table" id="datatables">
    <thead class="thead-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Periode</th>
        <th scope="col">Tanggal Pelaksanaan</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
        <?php $no = 0; ?>
        @foreach ($data as $d)
        <tr>
            <th scope="row">{{++$no;}}</th>
            <td>{{$d->nama_periode}}</td>
            <td>{{$d->tgl_expired}}</td>
            <td class="text-center">
                @if ($d->status == 0)
                    <button class="text-success border border-2 border-success rounded bg-light p-3">Aktif</button>
                @else
                    <a href="{{url('/updateperiode/'.$d->id)}}" class="text-danger border border-2 border-danger rounded bg-light p-2 text-decoration-none" id="tidak_aktif"> Tidak Aktif</a>
                @endif
            </td>
          </tr>
        @endforeach
    </tbody>
  </table> --}}
@endsection
@section('js')
    <script>
        
        
        var to_html = "";
        var jsonData = {!! $jsonData !!};
        to_html += "<table class='table' id='datatables'>";
            to_html += "<thead class='thead-dark'>";
                to_html += "<th scope='col'>No</th>";
                to_html += "<th scope='col'>Nama Periode</th>";
                to_html += "<th scope='col'>Tanggal Pelaksanaan</th>";
                to_html += "<th scope='col'>Status</th>";
            to_html +=  "</thead>";
            to_html += "<tbody>";
                var no = 0;
                for(var i = 0;i < jsonData.length;i++){
                    to_html += "<tr>";
                        to_html += "<td>"+ (++no) +"</td>";
                        to_html += "<td>"+jsonData[i].nama_periode+"</td>";
                        to_html += "<td>"+jsonData[i].tgl_expired+"</td>";
                        if(jsonData[i].status == 0){
                            to_html += "<td><button class='text-success border border-2 border-success rounded bg-light p-3'>Aktif</button></td>";
                        }else if(jsonData[i].status == 1){
                            to_html += "<td><button class='text-danger border border-2 border-danger rounded bg-light p-3' id='tidak_aktif"+jsonData[i].id+"' value="+jsonData[i].id+">Tidak Aktif</button></td>";      
                        }
                    to_html += "</tr>";
                }
            to_html += "</tbody>";
        to_html += "</table>";

        $('.tabel').html(to_html);
        $('#datatables').DataTable();
        $('#tidak_aktif1, #tidak_aktif2, #tidak_aktif3, #tidak_aktif4, #tidak_aktif5, #tidak_aktif6, #tidak_aktif7, #tidak_aktif8, #tidak_aktif9, #tidak_aktif10, #tidak_aktif11, #tidak_aktif12, #tidak_aktif13, #tidak_aktif14, #tidak_aktif15, #tidak_aktif16, #tidak_aktif17, #tidak_aktif18, #tidak_aktif19, #tidak_aktif20').on("click", function(){
            var id = $(this).val();
            console.log(id)
            Swal.fire({
                title: 'Ingin mengubah periode saat ini?',
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                icon: 'question'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{url('/updateperiode')}}",
                        data: {id: id, "_token":$('#token').val()},
                        type: 'POST'
                    }).done(function(response){
                        var data = JSON.parse(response);
                        Swal.fire({
                            title: 'Berhasil Mengubah!',
                            confirmButtonText: 'Ok', 
                            icon: 'success'
                        }).then((resultt) =>{ 
                            if(resultt.isConfirmed){
                                location.reload();
                            }else{
                                location.reload();
                            }
                        })
                    })
                }
            })
        })
    </script>
@endsection