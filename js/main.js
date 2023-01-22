$('.btn-booking').click(function (event) {

    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: { 'id': event.target.id },
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        
        $('#smestaj').val(response[0]['naziv'].trim());
        $('#smestajId').val(response[0]['id'].trim());
        $('#cenaPoOsobi').val(response[0]['cena_po_osobi'].trim());
        $('#ukupnaCena').val("");
        $('#brojOsoba').val("");
    })

});

$('.btn-update-booking').click(function (event) {

    request = $.ajax({
        url: 'handler/getPrijava.php',
        type: 'post',
        data: { 'id': event.target.id },
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        
        $('#smestaj').val(response[0]['smestaj'].trim());
        $('#smestajId').val(response[0]['smestaj_id'].trim());
        $('#prijavaId').val(response[0]['prijava_id'].trim());
        $('#cenaPoOsobi').val(response[0]['cena_po_osobi'].trim());
        $('#ukupnaCena').val(response[0]['cena'].trim());
        $('#brojOsoba').val(response[0]['broj_osoba'].trim());
        $('#datumOd').val(response[0]['datum_od'].trim());
        $('#datumDo').val(response[0]['datum_do'].trim());
    })

});

$('#brojOsoba').keyup(function (e) {
    let input = document.getElementById("brojOsoba");
    const brojOsoba = input.value;

    let inputCena = document.getElementById("cenaPoOsobi");
    const cenaPoOsobi = inputCena.value;

    const ukupnaCena = brojOsoba * cenaPoOsobi;

    if (ukupnaCena > 0) {
        $('#ukupnaCena').val(ukupnaCena);
    } else {
        $('#ukupnaCena').val("");
    }
});

$('#searchInput').keyup(function () {
    let input = document.getElementById("searchInput");
    let searchText = input.value.toUpperCase();

    let table = document.getElementById("myTable");

    for (let i = 0; i < table.rows.length; i++) {
        let currentRow = table.rows[i + 1];
        if (currentRow) {
            var tdSmestaj = currentRow.getElementsByTagName('TD')[0];

            if (tdSmestaj.textContent.toUpperCase().includes(searchText)) {
                currentRow.style.display = '';
            } else {
                currentRow.style.display = 'none';
            }
        }
    }
})


$('#dodajForm').submit(function () {

    event.preventDefault();
    console.log("Dodaj je pokrenuto");
    const $form = $(this);
    const $inputs = $form.find('input, select, button, textarea');
    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    request = $.ajax({
        url: 'handler/add.php',
        type: 'post',
        data: serijalizacija
    });

    request.done(function (response, textStatus, jqXHR) {
        console.log(response);

        if (response === "Success") {
            console.log("Uspesno prijavljivanje");
            window.location.href = 'prijave.php';
        }
        else {
            alert("Smestaj nije bukiran" + response);
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Sledeca greska se desila: ' + textStatus, errorThrown)
    });

});

$('.btn-delete').click(function (event) {

    $.ajax({
        url: 'handler/delete.php',
        type: 'post',
        data: { 'id': event.target.id },

    }).done(function (response, textStatus, jqXHR) {
        const selectedBtn = $('#' + event.target.id + '.btn-delete');
        console.log(selectedBtn);
        if (response === 'Success') {
            selectedBtn.closest('tr').remove();
            alert('Uspesno obrisana prijava');
            console.log('Uspesno obrisana prijava.');
        } else {
            console.error('Nespesno obrisana prijava: ', response);
            alert('Neuspesno obrisana prijava');
        }
    }).fail(function (response) {
        console.log(response);
        console.error('Greska prilikom brisanja prijave');
        alert('Greska prilikom brisanja prijave');
    });


});

$('#logoutBtn').click(function () {
    window.location.href = 'index.php';
});

$('#sortirajOpadajuce').click(function(){    
    sortiraj('DESC');
});

$('#sortirajRastuce').click(function(){    
    sortiraj('ASC');
});

function sortiraj(direction) {
    request = $.ajax({
        url: 'handler/sortiraj.php',
        type: 'post',
        data: { 'direction': direction },
    });
    request.done(function (response, textStatus, jqXHR) {

        let table = document.getElementById("myTable");
        jsonResponse = JSON.parse(response);
        for (let i = 0; i < jsonResponse.length; i++) {
            table.rows[i + 1].getElementsByTagName("TD")[0].textContent = jsonResponse[i]['naziv'];
            table.rows[i + 1].getElementsByTagName("TD")[1].textContent = jsonResponse[i]['tip'];
            table.rows[i + 1].getElementsByTagName("TD")[2].textContent = jsonResponse[i]['kapacitet'];
            table.rows[i + 1].getElementsByTagName("TD")[3].textContent = jsonResponse[i]['cena_po_osobi'] + ' RSD';
        }
        
    });
}

$('#izmeniForm').submit(function(){

    event.preventDefault();
    console.log("Izmeni je pokrenuto");
    const $form= $(this);
    const $inputs= $form.find('input, select, button, textarea');
    const serijalizacija= $form.serialize();
    console.log(serijalizacija);
    
    request= $.ajax({
          url: 'handler/update.php',
          type:'post',
          data: serijalizacija
    });


    request.done(function (response, textStatus, jqXHR) {


        console.log(response);
        console.log(response.length);
        console.log(response.trim().length);
       if (response.trim() === 'Success') {
           console.log('Prijava je izmenjena');
           location.reload(true);
             //$('#izmeniForm').reset;
       }
        else alert('Neuspešna izmena prijave ' + response);
        console.log(response);
   
    });

});