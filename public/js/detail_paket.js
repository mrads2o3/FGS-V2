document.getElementById("promo").onchange = function() {
    var x = document.getElementById("promo");
    x.value = x.value.toUpperCase();

    // Instantiate an new XHR Object
    const xhr = new XMLHttpRequest();

    // Open an obejct (GET/POST, PATH,
    // ASYN-TRUE/FALSE)

    xhr.open("GET", "http://localhost:8080/api/promocode?kode=" + x.value, true);

    // When response is ready
    xhr.onload = function() {
        if (this.status >= 200 && this.status < 400) {
            let list = document.getElementById("textDetailKode");
            if(x.value !== ''){
                list.innerHTML = 'Loading...';
            }else{
                list.innerHTML = '';
            }

            // Changing string data into JSON Object
            obj = JSON.parse(this.responseText);

            //Check
            if (obj.status == 0) {
                list.innerHTML = '<div class="alert alert-danger" role="alert"><i class="fa fa-times" aria-hidden="true"></i> Kode promo <b>' + x.value + '</b> Tidak valid!</div>';
            } else {
                splitText = window.location.href.split('/');
                sliceText = splitText.slice(-1);

                if(obj.data.paket == 53 || obj.data.paket == sliceText){
                    const timeNow = new Date();
                    // alert(timeNow);
                    const expired = new Date(obj.data.expired);
                    // alert(expired);
                    if(timeNow < expired){
                        if (obj.data.disc <= 1) {
                            diskon = (obj.data.disc * 100) + '%';
                            text = '<i class="fa fa-check" aria-hidden="true"></i> Diskon Sebesar ' + diskon + '<br> <i class="fa fa-check" aria-hidden="true"></i> Minimal beli ' + obj.data.min + ' IDR' +
                                '<br> <i class="fa fa-check" aria-hidden="true"></i> Maksimal ' + obj.data.max + ' IDR';
                        } else {
                            diskon = obj.data.disc + ' IDR';
                            text = '<i class="fa fa-check" aria-hidden="true"></i> Diskon Sebesar ' + diskon + '<br> <i class="fa fa-check" aria-hidden="true"></i> Minimal beli ' + obj.data.min + ' IDR';
                        }

                        list.innerHTML = '<div class="alert alert-success" role="alert"><i class="fa fa-check" aria-hidden="true"></i> Kode promo : <b>' + x.value + '</b> Valid. <br>' + text + '</div>';
                    }else{
                        list.innerHTML = '<div class="alert alert-danger" role="alert"><i class="fa fa-times" aria-hidden="true"></i> Kode promo <b>' + x.value + '</b> Sudah <b>Expired!</b></div>';
                    }
                }else if(obj.data.paket != sliceText){
                    list.innerHTML = '<div class="alert alert-danger" role="alert"><i class="fa fa-times" aria-hidden="true"></i> Kode promo <b>' + x.value + '</b> Tidak tersedia untuk paket ini!</div>';
                }else{
                    
                }
            }
        } else {
            list.innerHTML = 'Gagal Mengambil Data';
        }
    }
    xhr.send();
};
