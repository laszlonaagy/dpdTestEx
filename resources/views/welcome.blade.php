<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    </head>
    <body class="bg-gray-100">
    <h1 class="text-center mt-8">Test Exercise for DPD</h1>
    <div class="container border border-gray rounded p-6 mt-8 bg-light">

        <div class="calculate-form">
            <h4 class="p-2 font-weight-bold">Point A</h4>
            <form id="form-calculation">
            @csrf <!-- {{ csrf_field() }} -->
        <div class="row">
            <div class="col">
                <label for="latitude-a">Latitude:</label>
                <input class="form-control" type="text" name="latitude-a" placeholder="Latitude goes here...">
            </div>
            <div class="col">

                <label for="longitude-a">Longitude:</label>
                <input class="form-control" type="text" name="longitude-a" placeholder="Longitude goes here...">
            </div>
        </div>
        <h4 class="p-2 mt-4 font-weight-bold">Point B</h4>
        <div class="row">
            <div class="col">
                <label for="latitude-b">Latitude:</label>
                <input class="form-control" type="text" name="latitude-b" placeholder="Latitude goes here...">
            </div>
            <div class="col">
                <label for="longitude-b">Longitude:</label>
                <input class="form-control" type="text" name="longitude-b" placeholder="Longitude goes here...">
            </div>
        </div>
                <div class="row">
                    <div class="col-1">
                        <input id="calculateButton" class="mt-4 mb-4 btn btn-info" type="submit" value="Calculate">
                    </div>
                    <div class="col-11">
                        <input id="reloadButton" class="mt-4 mb-4 btn btn-info" type="submit" value="Reload">
                    </div>
                </div>

            </form>
        </div>
        <hr>
    <div>
        <div class="row">
            <div class="col-1">
                <p>Point C: </p>
            </div>
            <p id="point-c" class="font-weight-bold"></p>
        </div>
        <hr>
        <div class="row">
            <div class="col-1">
                <p>Point D: </p>
            </div>
            <p id="point-d" class="font-weight-bold"></p>
        </div>
    </div>
        <hr>
        <div class="row">
            <div class="col-1">
                <p>Perimeter (m): </p>
            </div>
            <p id="perimeter" class="font-weight-bold"></p>
        </div>
        <hr>
        <div class="row">
            <div class="col-1">
                <p>Area (m²): </p>
            </div>
            <p id="area" class="font-weight-bold"></p>
        </div>
        <hr>
        <div class="row">
            <div class="col-1">
                <p>Total cost (€): </p>
            </div>
            <p id="total-cost" class="font-weight-bold"></p>
        </div>
    </div>
    </body>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
        });

        $('#calculateButton').click(function (e)
        {
            e.preventDefault();


                let latReg = new RegExp('^(\\+|-)?(?:90(?:(?:\\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\\.[0-9]{1,6})?))$');
                let longReg = new RegExp('^(\\+|-)?(?:180(?:(?:\\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\\.[0-9]{1,6})?))$');

                let latitudeA = latReg.test($("input[name=latitude-a]").val()) ? $("input[name=latitude-a]").val() : false;
                let longitudeA = longReg.test($("input[name=longitude-a]").val()) ? $("input[name=longitude-a]").val() : false;
                let latitudeB = latReg.test($("input[name=latitude-b]").val()) ? $("input[name=latitude-b]").val() : false;
                let longitudeB = longReg.test($("input[name=longitude-b]").val()) ? $("input[name=longitude-b]").val() : false;

                if ((latitudeA != false && longitudeA != false && latitudeB != false && longitudeB != false) && (latitudeA != latitudeB && longitudeA != longitudeB))
                {

                    $.ajax({
                        type:'POST',
                        url:"{{ url('welcomeController') }}",
                        data:{
                            latA:latitudeA,
                            longA:longitudeA,
                            latB:latitudeB,
                            longB:longitudeB,
                        },
                        success:function(data){
                            console.log(data);
                            $('#point-c').html('Latitude C: ' + data['latitudeC'] + ', Longitude C: ' + data['longitudeC']);
                            $('#point-d').html('Latitude D: ' + data['latitudeD'] + ', Longitude D: ' + data['longitudeD']);
                            $('#perimeter').html(Math.round((measure(latitudeA,longitudeA,data['latitudeD'],data['longitudeD']) + measure(latitudeA,longitudeA,data['latitudeC'],data['longitudeC'])) * 2));
                            $('#area').html(Math.round(measure(latitudeA,longitudeA,data['latitudeD'],data['longitudeD']) * measure(latitudeA,longitudeA,data['latitudeC'],data['longitudeC'])));
                            $('#total-cost').html(data['totalPrice']);

                        }
                    });
                }
                else
                {
                    alert('One of the input field has contain invalid coordinate value. Please check the input fields.')
                }




        });

        function measure(lat1, lon1, lat2, lon2)
        {
            var R = 6378.137;
            var dLat = lat2 * Math.PI / 180 - lat1 * Math.PI / 180;
            var dLon = lon2 * Math.PI / 180 - lon1 * Math.PI / 180;
            var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon/2) * Math.sin(dLon/2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            var d = R * c;
            return d * 1000;
        }

        function reLoad()
        {
            $('#point-c').empty();
            $('#point-d').empty();
            $('#perimeter').empty();
            $('#area').empty();
            $('#total-cost').empty();
        }

    </script>
</html>
