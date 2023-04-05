@extends('layout.layout')
@section('css')
<link rel="stylesheet" href="{{asset('css/undian.css')}}">
<style>
  .img_center{
    margin-top: 10px;
  }
</style>
@endsection
@section('content')
<br><br><br>
{{-- <button class="btn btn-warning" id="cari_pemenang">Mulai</button> --}}
  
  <div class="machine">
    <div class="slot-machine">
      <h1>PENGUNDIAN</h1>
      <select name="hadiah_id" id="select2" class="form-control">
        <option value="0" selected>Pilih Hadiah</option>
        @foreach ($data as $d)
          <option value="{{$d->id}}">{{$d->nama}} ({{$d->jumlah}})</option>
        @endforeach
      </select>
      <div class="group">
        <div class="reel"><img src="{{asset('img/sukma_icon_leaflet.png')}}" width="80px" class="img_center"></div>
        <div class="reel"><img src="{{asset('img/sukma_icon_leaflet.png')}}" width="80px" class="img_center"></div>
        <div class="reel"><img src="{{asset('img/sukma_icon_leaflet.png')}}" width="80px" class="img_center"></div>
        <div class="reel"><img src="{{asset('img/sukma_icon_leaflet.png')}}" width="80px" class="img_center"></div>
        <div class="reel"><img src="{{asset('img/sukma_icon_leaflet.png')}}" width="80px" class="img_center"></div>
        <div class="reel"><img src="{{asset('img/sukma_icon_leaflet.png')}}" width="80px" class="img_center"></div>
      </div><br>
      <h1 id="text_selamat" class="text-center"></h1>
      <h1 id="text_nama" class="text-left"></h1>
      <h1 id="text_noacc" class="text-left"></h1>
      <h1 id="text_hadiah" class="text-left"></h1>
      <h1 class="js-announcement announcement"></h1>
  
      <button class="lever button" id="cari_pemenang">
        MULAI
      </button>
      <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
      <input type="hidden" name="no_undian_id" id="no_undian_id">
      <input type="hidden" name="hadiah_id" id="hadiah_id">
      <input type="hidden" name="periode_id" id="periode_id" value="{{$periode['id']}}">
      <a class="button2 btn" id="save">SAH</a>
      <a class="button3 btn" id="tolak">TIDAK SAH</a>
  </div>
  </div>
  <footer class="footer mt-auto py-3">
    <div class="row">
      <div class="col-6">
        <img src="{{asset('img/ojk_icon.png')}}" width="100%" class="mt-5" alt="OJK">
      </div>
      <div class="col-6">
        <img src="{{asset('img/lps_icon.png')}}" width="100%" alt="LPS"> 
      </div>
    </div>
  </footer>
@endsection
@section('js')
<script>
$('#select2').select2(); 
$('#cari_pemenang').css("visibility","hidden");
$('#save').css("visibility","hidden");
$('#tolak').css("visibility","hidden");

$('#select2').on("change", function(){
  $('#cari_pemenang').css("visibility","visible");
  var hadiah_id = $('#select2').val();
  if(hadiah_id == 0){
    Swal.fire({
      title: 'Hadiah tidak sah!',
      icon: 'error',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok',
    }).then((result) => {
      if (result.isConfirmed) {
    // Melakukan reload halaman
      location.reload();
      }else{
        location.reload();
      }
    });
  }else{
    $.ajax({
    url: "{{url('/getHadiah')}}",
    data: {hadiah_id:hadiah_id},
    type: 'GET'
  }).done(function(response){
    var data = JSON.parse(response);
    $('#hadiah_id').val(data.hadiah_id);

    $('#cari_pemenang').on("click", function(){
      $('.img_center').hide();
      $.ajax({
        url: "{{url('/getPemenang')}}",
        type: 'GET'
      }).done(function(response){
        var data = JSON.parse(response);
        $('#no_undian_id').val(data.data.id);
        console.log(data)
        var tMax = 2000, // animation time, ms
        height = 700,
        speeds = [],
        r = [],
        target = data.data.no_undian,
        reading = 123456,
        sTarget = target.toString(),
        sReading = reading.toString(),
        numberOutput = [],
        numberIsi = [],
        
        start,
        reels = [
            ['1', '2', '3','4','5','6','7','8','9','0'],
            ['1', '2', '3','4','5','6','7','8','9','0'],
            ['1', '2', '3','4','5','6','7','8','9','0'],
            ['1', '2', '3','4','5','6','7','8','9','0'],
            ['1', '2', '3','4','5','6','7','8','9','0'],
            ['1', '2', '3','4','5','6','7','8','9','0'],
        ];

    function init(){
        $reels = $('.reel').each(function(i, el){
            el.innerHTML = '<div class="reel-holder"><p>' + reels[i].join('</p><p>') + '</p></div><div class="reel-holder"><p>' + reels[i].join('</p><p>') + '</p></div><div class="reel-door">?</div>'
        });

        // Add user's meter reading to fake reel for comparison
        $('.fake-reel').each(function(i, el){
            el.innerHTML = sReading.charAt(i);
        });

        action();
    }

    function action(){
      $('#cari_pemenang').remove();
      $('#select2').attr("disabled","");
        if (start !== undefined) return;

        $('.reel-door').fadeOut(100);
        $('.lever').attr('disabled', true)
                   .addClass('button-inactive')
                   .text('Good luck!');
        for (var i = 0, len = sTarget.length; i < len; i += 1) {
            var intOffset = (parseInt(+sTarget.charAt(i))) * height / 10 - ((height / 10) * 2);

            if(intOffset >= 0){
              numberIsi[i] = intOffset;
            }else if(intOffset == -140){
              numberIsi[i] = 560;
            }else if(intOffset == -70){
              numberIsi[i] = 630;
            }
        }
        for (var j = 0; j < 6; ++j) {
            speeds[j] = Math.random() + .7;
            r[j] = (Math.random() * 10 || 0) * height / 10;
        }
        animate();
    }

    function animate(now){
        if (!start) start = now;
        var t = now - start || 0;

        for (var i = 0; i < 6; ++i)
            $reels[i].scrollTop = (speeds[i] / tMax / 2 * (tMax - t) * (tMax - t) + numberIsi[i]) % height | 0;
        if (t < tMax) {
            requestAnimationFrame(animate);
        } else {
            start = undefined;
            check();
        }
    }

    function check(){
        var matchedNumbers = 0;

        for (var i = 0, len = sTarget.length; i < len; i += 1) {
            var targetReading = sReading.charAt(i) || 0,
                targetInt = sTarget.charAt(i) || 0,
                reelClass = 'no-match';

            $('.reel:eq(' + i + '), .fake-reel:eq(' + i + ')').addClass(reelClass);
            targetReading == targetInt ? matchedNumbers ++ : null;
        }

        // var announcement;

        // if (matchedNumbers == 5) {
        //     announcement = 'You matched all 5 numbers! you win!!!';
        // } else if (matchedNumbers == 1) {
        //     announcement = 'You matched 1 number. Better luck next time!';
        // } else {
        //     announcement = 'You matched ' + matchedNumbers + ' numbers. Better luck next time!';
        // }
        $('#save').css("visibility","visible")
        $('#tolak').css("visibility","visible")
        $('#text_selamat').html("SELAMAT KEPADA");
        $('#text_nama').html(data.pemenang.nama_lengkap);
        $('#text_noacc').html("Nomor Rekening : " + data.pemenang.noacc);
        $('#text_hadiah').html("Memenangkan Hadiah : " + $('#select2 option:selected').html())
        var audio = new Audio('tepuk_tangan.mp3')
        audio.play();
    }
    init();
      })
    })

  $('#save').on("click", function(){
    var periode_id = $('#periode_id').val();
    var no_undian_id = $('#no_undian_id').val();
    var hadiah_id = $('#hadiah_id').val();

    $.ajax({
      url: "{{url('/postPemenang')}}",
      data: {no_undian_id:no_undian_id, hadiah_id:hadiah_id, periode_id:periode_id, "_token":$('#token').val()},
      type: "POST",
    }).done(function(response){
      var data = JSON.parse(response);
      Swal.fire({
      title: 'Selamat Telah Memenangkan!',
      icon: 'success',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok',
    }).then((result) => {
      if (result.isConfirmed) {
    // Melakukan reload halaman
      location.reload();
      }else{
        location.reload();
      }
    });
    });

  });
  $('#tolak').on("click", function(){
    Swal.fire({
      title: 'Undian tidak sah!',
      icon: 'error',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok',
    }).then((result) => {
      if (result.isConfirmed) {
    // Melakukan reload 
      location.reload();
      }else{
        location.reload();
      }
    });

  })
    
  })
  }
})

</script>
@endsection