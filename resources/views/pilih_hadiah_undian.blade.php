@extends('layout.layout')
@section('content')
    <div class="container-fluid mt-5">
        <div class="row" id="tempat_card">

        </div>
    </div>
@endsection
@section('js')
    <script>
        $.ajax({
            url: "{{url('/pilih-hadiah-undian-ajax')}}",
            type: "GET",
        }).done(function(response){
            let data = JSON.parse(response)

            let html = ""
            for(let i = 0;i < data.data.length;i++){
                html += "<div class='col-md-4 mb-5'>"
                    html += "<div class='card'>"
                        html += "<img src="+data.data[i].gambar+" class='card-img-top' alt='Gambar'>"
                        html += "<div class='card-body'>"
                            html += "<h5 class='card-title'>"+ data.data[i].nama +"</h5>"
                            html += '<a href="{{url('/undian-id/')}}/'+data.data[i].id+'" class="btn btn-primary form-control">Undi ('+data.data[i].jumlah +')</a>'
                        html += "</div>"
                    html += "</div>"
                html += "</div>"
            }
            $('#tempat_card').html(html)
        })
    </script>
@endsection
