$(document).ready(function() {
    //Cari Nick ML
    $('#cari').click(function() {
        //$('#hasil-validate').text("Loading...");
        $('.test-cari-ml').text("Loading...");
        var data = $('#form_validate').serialize();
        $.ajax({
            type: 'POST',
            url: "<?=base_url('assets/core/script/validate.php')?>",
            data: data,
            cache: false,
            success: function(data) {
                //test(data);
                $('.test-cari-ml').text(data);
                //$('.test-cari-ml3').val(data);
                nono(data);
                //document.getElementById("test-cari-ml2").innerHTML = data;
            }
        });
    });

    //Cari Nick FF
    $('#cari_ff').click(function() {
        $('#hasil-validate').text("Loading...");
        var data = $('#form_validate_ff').serialize();
        $.ajax({
            type: 'POST',
            url: "<?=base_url('assets/core/script/validate-ff.php')?>",
            data: data,
            cache: false,
            success: function(data) {
                $('#hasil-validate').text(data);
            }
        });
    });
});

function test(nick) {
    alert(nick);
    //$('#test-cari-ml').text(nick);
}

function tes(id, nickname) {
    alert(id + nickname);
}

$(document).ready(function() {
    $("#mwheel").keyup(function() {
        // Get the current value of textarea
        var text = $(this).val();
        magic = 200 - text;
        if (magic == 0) {
            diamonds_magic = ": 0 Diamond";
            diamonds_magic_disc = ": 0 Diamond";
            magic_point = ": Selamat! Anda sudah mendapat magic Crystal!";
        } else if (magic < 0) {
            magic_point = ": Magic point tidak dapat melebihi 200!";
            diamonds_magic = ": 0 Diamond";
            diamonds_magic_disc = ": 0 Diamond";
        } else {
            magic_point = ": " + magic + " Magic point";
            diamonds_magic = ": " + (magic * 60) + " Diamond";
            diamonds_magic_disc = ": " + (magic * 48) + " Diamond";
        }
        // Update div content
        $(".magic_point").text(magic_point);
        $(".diamonds_magic").text(diamonds_magic);
        $(".diamonds_magic_disc").text(diamonds_magic_disc);
    });

    $("#starpoint").keyup(function() {
        // Get the current value of textarea
        var text = $(this).val();
        starpoint = 100 - text;
        if (starpoint == 0) {
            diamonds_star = ": 0 Diamond";
            diamonds_star_disc = ": 0 Diamond";
            star_point = ": Selamat! Anda sudah mendapat magic Crystal!";
        } else if (starpoint < 0) {
            star_point = ": Magic point tidak dapat melebihi 100!";
            diamonds_star = ": 0 Diamond";
            diamonds_star_disc = ": 0 Diamond";
        } else {
            star_point = ": " + starpoint + " Magic point";
            min_dm_n = Math.ceil((starpoint * 20 / 5) / 20) * 20;
            max_dm_n = Math.ceil(starpoint * 20);
            min_dm_d = Math.ceil((starpoint * 14 / 5) / 14) * 14;
            max_dm_d = Math.ceil(starpoint * 14);

            if (min_dm_n < 20) {
                min_dm_n = 20;
            }
            if (min_dm_d < 14) {
                min_dm_d = 14;
            }

            diamonds_star = ": " + min_dm_n + " - " + max_dm_n + " Diamond";
            diamonds_star_disc = ": " + min_dm_d + " - " + max_dm_d + " Diamond"

            if (max_dm_n == 20) {
                diamonds_star = ": " + max_dm_n + " Diamond";
            }
            if (max_dm_d == 14) {
                diamonds_star_disc = ": " + max_dm_d + " Diamond"
            }
        }
        // Update div content
        $(".star_point").text(star_point);
        $(".diamonds_star").text(diamonds_star);
        $(".diamonds_star_disc").text(diamonds_star_disc);
    });

});

function calculate() {
    /*var id = $("#calculate").text();
    $(".text-hitungwr").text(id);
    if(id == "Hitung"){
        $("#calculate").text("Ulangi");
    }else if(id == "Ulangi"){
        $("#calculate").text("Hitung");
    }*/

    var jumlah_p = $("#jumlah_p").val();
    var current_wr = $("#current_wr").val();
    var new_wr = $("#new_wr").val();
    var win = Math.floor(jumlah_p * (current_wr / 100));
    var lose = jumlah_p - win;
    var newwin = Math.floor(((100 / (100 - new_wr)) * lose) - jumlah_p);
    var newlose = Math.floor(jumlah_p * (current_wr - new_wr) / 100);

    if (jumlah_p == '' || current_wr == '' || new_wr == '') {
        $(".text-hitungwr").text("Semua field harus diisi ya!");
    } else if (current_wr > 100 || current_wr < 0 || new_wr > 100 || new_wr < 0) {
        $(".text-hitungwr").text("WR Tidak bisa lebih dari 100 atau kurang dari 0!");
    } else if (win < 1) {
        $(".text-hitungwr").text("Tolong cek kembali inputannya ya terimakasih!");
    } else if (current_wr < 100 && new_wr == 100) {
        $(".text-hitungwr").text("Jika WR Sekarang adalah " + current_wr + "% maka tidak bisa mencapai WR " + new_wr +
            "%");
    } else if (jumlah_p % 1 != 0) {
        $(".text-hitungwr").text("Tidak mungkin jumlah pertandingan itu desimal!");
    } else if (newwin > 100000) {
        $(".text-hitungwr").text(
            "Anda sudah win sebanyak " + win + " kali dengan lose sebanyak " + lose + " kali." +
            "Kamu perlu lebih dari 100.000 win tanpa lose untuk mencapai winrate " + new_wr + "% !");
    } else if (newlose > 100000) {
        $(".text-hitungwr").text(
            "Anda sudah win sebanyak " + win + " kali dengan lose sebanyak " + lose + " kali." +
            "Kamu perlu lebih dari 100.000 lose tanpa win untuk mencapai winrate " + new_wr + "% !");
    } else if (win >= 1) {
        if (current_wr > new_wr) {
            newtext = newlose + " kali lose tanpa win!";
        } else if (current_wr < new_wr) {
            newtext = newwin + " kali win tanpa lose!";
        }
        $(".text-hitungwr").text(
            "Anda sudah win sebanyak " + win + " kali dengan lose sebanyak " + lose + " kali." +
            " Untuk mencapai WR " + new_wr + "% membutuhkan " + newtext
        );
    }
}

function calculatels() {
    var jumlah_p = $("#jumlah_p_2").val();
    var current_wr = $("#current_wr_2").val();
    var ls = $("#current_ls").val();
    const wr = Math.floor(jumlah_p * (current_wr / 100) - ls) / jumlah_p * 100;
    const minlose = Math.ceil(jumlah_p * current_wr / 100);

    if (jumlah_p == '' || current_wr == '' || new_wr == '') {
        $(".text-hitungwr-ls").text("Semua field harus diisi ya!");
    } else if (ls % 1 != 0 || ls % 1 != 0) {
        $(".text-hitungwr-ls").text("Field harus bilangan bulat!");
    } else if (jumlah_p < 0 || current_wr < 0 || ls < 0) {
        $(".text-hitungwr-ls").text("Semua field tidak boleh kurang dari 0!");
    } else if (wr < 0) {
        $(".text-hitungwr-ls").text("Minimal anda harus losestreak sebanyak " + minlose + " kali");
    } else if (current_wr > 100) {
        $(".text-hitungwr-ls").text("WR Tidak bisa lebih besar dari 100!");
    } else {
        $(".text-hitungwr-ls").text("Jika anda lose streak sebanyak " + ls + " kali, maka winrate anda menjadi " + wr +
            "%");
    }
}