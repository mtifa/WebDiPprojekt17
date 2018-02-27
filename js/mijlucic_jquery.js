
$(document).ready(
    function izvr() {
        var href = document.location.href;
        var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);

        if(lastPathSegment.search("popis_korisnika.php") !== -1){
            $("#tabela").dataTable();
        }
    }
);
