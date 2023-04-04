@extends('layout.layout')
@section('content')
<div class="row">
  <div class="col-9">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{asset('img/banner1.jpg')}}" class="d-block w-100" height="385px" alt="...">
        </div>
        <div class="carousel-item">
          <img src="{{asset('img/dana_cepat.jpg')}}" class="d-block w-100" height="385px" alt="...">
        </div>
        <div class="carousel-item">
          <img src="{{asset('img/infobank.png')}}" class="d-block w-100" height="385px" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="col-3 card shadow-lg px-3 mb-5 bg-body rounded">
    <div class="row d-flex justify-content-center">
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      <div class="col-1 rounded-circle border border-3 border-dark bg-light text-light mx-1">
        .
      </div>
      
    </div>
    <h1 style="font-size: 150px" class="text-center text-danger">{{$date_diff->days}}</h1>
    <h1 class="text-center">HARI LAGI!</h1>
    <hr>
    <h3 class="text-center">TERUS TINGKATKAN SALDO ANDA!!!</h3>
  </div>
</div>
  {{-- <p id="count" hidden>{{$data}}</p> --}}
  <br>
  <div class="row">
    <div class="col-12">
        <h1>APA ITU TABUNGAN SUKMA BERHADIAH?</h1>
        <hr>
        <p class="h5">Tabungan Berhadiah adalah produk BPR dalam bentuk tabungan dengan imbalan jasa berupa hadiah yang diundi. Penabung berhak atas suatu hadiah, yang diundi melalui mekanisme undian pada setiap periode atas nomor rekening, yang dihitung berdasarkan SRT (Saldo Rata-rata Bulanan) dari nilai tabungannya. BPR menyediakan hadiah-hadiah menarik yang dapat dibawa pulang.</p>
    </div>
    {{-- <div class="col-6">
        <figure class="highcharts-figure">
            <div id="highcharts1"></div>
        </figure> 
    </div> --}}
  </div>
@endsection
@section('js')
    <script>
      // $.ajax({
      //   url: "{{url('/getChart')}}",
      //   type: 'GET',
      // }).done(function(response){
      //   var data = JSON.parse(response);
      //   Highcharts.chart('highcharts1', {
      //     chart: {
      //       type: 'column'
      //     },
      //     title: {
      //       text: 'Jumlah Pemenang Undian '
      //     },
      //     xAxis: {
      //     categories: [
      //       data.periode[0],
      //       data.periode[1],
      //       data.periode[2],
      //       data.periode[3],
      //       data.periode[4],
      //       data.periode[5],
      //       data.periode[6],
      //       data.periode[7],
      //       data.periode[8],
      //       data.periode[9],
      //       data.periode[10],
      //       data.periode[11],
      //       data.periode[12],
      //       data.periode[13],
      //       data.periode[14],
      //       data.periode[15],
      //     ],
      //     crosshair: true
      //     },
      //     yAxis: {
      //       min: 0,
      //       title: {
      //         text: 'Pemenang Undian'
      //       }
      //     },
      //     tooltip: {
      //       headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      //       pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      //         '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
      //       footerFormat: '</table>',
      //       shared: true,
      //       useHTML: true
      //     },
      //     plotOptions: {
      //       column: {
      //         pointPadding: 0.2,
      //         borderWidth: 0
      //       }
      //     },
      //     series: [{
      //       name: 'Jumlah Pemenang',
      //       data: data.jumlah,
      //     }]
      // });
      // })

        
    </script>
@endsection