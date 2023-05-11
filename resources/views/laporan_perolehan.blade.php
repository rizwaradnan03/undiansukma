@extends('layout.layout')
@section('content')
    <div class="row mt-5">
        <div class="lg-12 col-12 mb-3">
            <input type="date" id="datepicker" class="form-control" placeholder="Pilih Bulan">
        </div>
        <div class="table">
            <table id="datatables" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                    </tr>
                    <tbody id="table">

                    </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#datatables').DataTable();
        $('#datepicker').on("change", function(){
            let date = new Date($('#datepicker').val())
            let month = String(date.getMonth() + 1).padStart(2, '0')
            let year = date.getFullYear();

            $.ajax({
                url: "{{url('/getPerolehan')}}",
                data: {month: month, year: year},
                type: "GET",
            }).done(function(reponse){
                let data = JSON.parse(reponse);
                let table = "";
                let no = 0;
                if(data != null){
                    for(let i = 0;i < data.length;i++){
                        table += "<tr>"
                            table += "<td>"+ ++no; +"</td>"
                            table += "<td>"+ data[i].nama_lengkap +"</td>"
                            table += "<td>"+ data[i].jumlah +"</td>"
                        table += "</tr>"
                    }
                }else if(data == null){
                    table += "<tr>"
                        table += "<td>0</td>"
                        table += "<td>Undefined</td>"
                        table += "<td>Undefined</td>"
                    table += "</tr>"
                }
                $('#table').html(table)
            })
        })

    </script>
@endsection
