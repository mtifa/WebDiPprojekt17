function korimefoc() {
    var korIme = $("#korime").val();
    var korIme_provjera;
    $.ajax({
        url: 'http://barka.foi.hr/WebDiP/2016/materijali/zadace/dz3/korisnikImePrezime.php',
        data: {ime: korIme, prezime: korIme},
        type: 'GET',
        dataType: 'json',
        success: function (xml) {
            $(xml).find('korime').each(function () {
                korIme_provjera = $(this).text();
            });
            if ($.isNumeric(korIme_provjera)) {
                $("#greskeKor").text("Korisnik ne postoji!");
                boolkorpostoji =  true;
                $("#lozinka_registracija").removeAttr("disabled");
            } else {
                boolkorpostoji = false;
                $("#greskeKor").text("Korisnik postoji!");
                $("#lozinka_registracija").attr("disabled", true);
            }
        }
    });
}

function lozinkaValid() {
    var Regex = /(?=.*?\d)(?=(.*?[A-Z]){2})(?=(.*?[a-z]){2}).{5,15}/;
    if (!Regex.test($lozinka.val())) {
        $lozinka.addClass("greske");
        boolvaljloz = false;
        $("#greskeLoz").text("Lozinka mora sadrzavati 2 velika slova, 2 mala slova i 1 brojku.");
    }
    else {
        $lozinka.removeClass("greske");
        boolvaljloz = true;
        $("#greskeLoz").text("");
    }
}

function validacija(){
    if(!boolvaljloz || !boolkorpostoji){
        alert("Ispravite greske u oznacenim poljima ili ako je sve prazno unesite podatke!");
        return false;
    }
}

$(document).ready(
    function glavni() {
        var href = document.location.href;
        var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);
        if (lastPathSegment.search("prijava.php") !== -1) {
            $korime = $("#korime");
            $lozinka = $("#lozinka");

            $("#forma3").submit(validacija());
        }
    }
);