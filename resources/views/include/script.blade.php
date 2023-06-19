<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
 
<script>
    
// Tampilkan Data tiket
    // $('body').on('click', '.cek', function(e) {

    //     $.ajax({
    //         url: 'tampil',
    //         type: 'GET',
    //         success: function(response) {
    //             $('#exampleModal').modal('show');
    //             $('#nomor').text(response.result.nomor);
    //             $('#nama_pelanggan').text(response.result.nama_pelanggan);
    //             $('#hp_pelanggan').text(response.result.hp_pelanggan);
    //             $('#email_pelanggan').text(response.result.email_pelanggan);
    //             // $('#nama_tiket').text(response.result2.nama);
    //             $('#harga').text(response.result.harga);
    //             $('#kuantiti').text(response.result.kuantiti);
    //             $('#total').text(response.result.total);
    //         }
    //     });
        
    // });

$('body').on('click', '.cek', function(e) {

$.ajax({
    url: '/tampil', // Ganti dengan URL yang sesuai dengan rute yang Anda definisikan
    type: 'GET',
    success: function(response) {
        var data = response.data;

        // Kosongkan isi modal sebelum menambahkan data baru
        $('#exampleModal').modal('show');
        $('#modal-body').empty();

        // Tampilkan data dalam modal
        $.each(data, function(index, item) {
            var content = 

                '<span> Nomor : </span>' +
                '<p>' + item.nomor +  '</p> ' +
                '<span> Nama Pelanggan : </span>' +
                '<p>' + item.nama_pelanggan + '</p>' +
                '<span> Nomor Hp Pelanggan : </span>' +
                '<p>' + item.hp_pelanggan + '</p>'+
                '<span> Email Pelanggan : </span>' +
                '<p>' + item.email_pelanggan + '</p>'+
                '<span> ID tiket : </span>' +
                '<p>' + item.tiket_id + '</p>'+
                '<span> Jumlah tiket : </span>' +
                '<p>' + item.kuantiti + '</p>'+
                '<span> Harga tiket : </span>' +              
                '<p>' + item.harga + '</p>'+
                '<span> Bank : </span>' +
                '<p>' + item.bank_id + '</p> <hr>'
                '<span> Total Harga : </span>' +
                '<p>' + item.total + '</p> <hr>';

            $('#modal-body').append(content);
        });
    }
});
});

// 03_PROSES EDIT 
$('body').on('click', '.tombol-edit', function(e) {
        var id = $(this).data('id');
        $.ajax({
            url: 'pegawaiAjax/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                let parser = new DOMParser();
                const doc = parser.parseFromString(response.result.konten, 'text/html');
                
                $('#exampleModal').modal('show');
                // $('#konten').text(response.result.konten);
                $('#konten').innerHTML += doc;
                $('#judul').text(response.result.judul);
            }
        });

    });

  
    document.addEventListener("DOMContentLoaded", function () {
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    mobileMenuButton.addEventListener("click", function () {
        mobileMenu.classList.toggle("hidden");
    });
});






</script>



