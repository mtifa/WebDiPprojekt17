
var obrazac = document.getElementById("forma3");
obrazac.addEventListener("submit", stvoriKolacic);

function stvoriKolacic() {
    var vrijemen = new Date().getTime();
    var sadrzajcookie = document.cookie.split("=");
    document.cookie = "trajanje="+ vrijeme.getTime()*5000 +";";

    if(vrijemen - sadrzajcookie[1] > 300000){
        alert('Proslo je vise od 5 min!');
        event.preventDefault();
        var inputs = formular.getElementsByTagName("INPUT");
        for (var i = 0 ; i < obrazac.length; i++)
            obrazac[i].disabled=true;

        inputs.disabled =true;

        document.getElementById("refresh").style.visibility="visible";

        for (var i = 0 ; i< inputs.length; i++){
            inputs[i].style.backgroundColor="gray";
        }
    }
}
