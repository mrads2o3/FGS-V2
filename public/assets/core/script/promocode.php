<head>
    <!-- Tutorial : https://remotestack.io/codeigniter-rest-api-development-example-tutorial/ -->
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,
            initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

    <title>
        How to use simple API using AJAX ?
    </title>
</head>

<body>

    <div class="container">
        <input type="text" id="text" name="text" placeholder="text">
        <div id="list"></div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js,
         then Bootstrap JS -->
    <script>
    let fetchBtn = document.getElementById("fetchBtn");


    document.getElementById("text").onkeyup = function() {

        // Instantiate an new XHR Object
        const xhr = new XMLHttpRequest();

        // Open an obejct (GET/POST, PATH,
        // ASYN-TRUE/FALSE)
        var kode = document.getElementById('text');
        xhr.open("GET", "https://fastgamingstore.com/api/promocode?kode=" + kode.value, true);

        // When response is ready
        xhr.onload = function() {
            if (this.status >= 200 && this.status < 400) {
                let list = document.getElementById("list");
                list.innerHTML = 'Loading...';

                kode.value = kode.value.toUpperCase();

                // Changing string data into JSON Object
                obj = JSON.parse(this.responseText);

                //Check
                if (obj.status == 0) {
                    list.innerHTML = 'Kode promo <b>' + kode.value + '</b> Tidak valid';
                } else {

                    if (obj.data.disc <= 1) {
                        diskon = (obj.data.disc * 100) + '%';
                        text = 'Diskon Sebesar ' + diskon + '<br> Minimal beli ' + obj.data.min + ' IDR' +
                            '<br> Maksimal ' + obj.data.max + ' IDR';
                    } else {
                        diskon = obj.data.disc + ' IDR';
                        text = 'Diskon Sebesar ' + diskon + '<br> Minimal beli ' + obj.data.min + ' IDR';
                    }

                    list.innerHTML = 'Kode promo : <b>' + kode.value + '</b> Valid. <br>' + text;
                }
                // console.log(obj);
            } else {
                list.innerHTML = 'Gagal Mengambil Data';
            }
        }
        xhr.send();
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>