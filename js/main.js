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
            var tdPredmet = currentRow.getElementsByTagName('TD')[0];

            if (tdPredmet.textContent.toUpperCase().includes(searchText)) {
                currentRow.style.display = '';
            } else {
                currentRow.style.display = 'none';
            }
        }
    }
})


$('#dodajForm').submit(function () {

    // event.preventDefault();
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
            console.log("Smestaj nije bukiran" + response);
            console.log(response);
            console.log(textStatus);
            console.log(jqXHR);
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
            alert('Obrisana prijava');
            console.log('Uspesno obrisana prijava.');
        } else {
            console.error('Nespesno obrisana prijava: ', response);
            alert('Nije obrisana prijava');
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