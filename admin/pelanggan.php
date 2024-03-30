<?php
    include 'layouts/header.php'; //Memasukkan file header.php yang berisi struktur awal HTML, tag pembuka sesuai dengan tata letak halaman.
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <!-- Judul halaman -->
              <h6 class="h2 text-white d-inline-block mb-0">Kelola Pelanggan</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <!-- Tautan ke halaman utama -->
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <!-- Judul halaman -->
              <h3 class="mb-0">Pelanggan</h3>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                  <!-- Tabel pelanggan dengan ID "customerList" -->
                    <table class="table align-items-center table-flush" id="customerList" style="width: 100%">
                        <thead class="thead-light">
                          <!-- Baris header tabel -->
                            <tr>
                              <!-- Kolom-kolom header -->
                                <th scope="col">ID</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">No. HP</th>
                                <th scope="col">Alamat</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            
          </div>
        </div>
      </div>

      <!-- menghapus pelanggan --> 
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <!-- Header modal -->
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Hapus Pelanggan?</h6>
              <!-- Tombol close modal -->
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
           <!-- Form untuk menghapus pelanggan -->
          <form action="#" id="deleteCustomer" method="POST">
        
          <!-- Input tersembunyi untuk menyimpan ID pelanggan yang akan dihapus -->
            <input type="hidden" name="id" value="" class="deleteID">

          <div class="modal-body">
            <!-- Pesan konfirmasi hapus -->
              <p>Yakin ingin pelanggan ini? Semua data seperti data profil, order dan pembayaran juga akan dihapus.</p>
          </div>
          <div class="modal-footer">
            <!-- Tombol untuk mengirimkan form penghapusan -->
              <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
              <!-- Tombol untuk menutup modal -->
              <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Batal</button>
          </div>
          </form>
      </div>
  </div>
</div>
<!-- Menambahkan stylesheet untuk DataTables -->
<link href="../css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Menambahkan script untuk jQuery dan DataTables -->
<script src="../js/datatable/jquery.dataTables.min.js"></script>
<script src="../js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="../js/datatable/datatables.lang.js"></script>
<!-- Menggunakan jQuery untuk menangani tindakan klik pada tombol Delete -->
<script>
$(document).ready(function() {
  // Menggunakan event delegation untuk menangani tindakan klik pada tombol Delete dengan kelas .btnDelete
    $(document).on('click', '.btnDelete', function() {
      // Mendapatkan ID dari atribut data-id pada tombol Delete yang diklik
      var id  = $(this).data('id');
      // Menetapkan nilai ID ke input tersembunyi dalam modal hapus
      $('.deleteID').val(id);
      // Menampilkan hapus
      $('#deleteModal').modal('show');
    });

    // Menggunakan event delegation untuk menangani tindakan klik pada tombol Delete dengan ID deleteCustomer
    $('#deleteCustomer').submit(function(e) {
      // Mencegah form dari pengiriman default
      e.preventDefault();

      // Mendapatkan ID dari input tersembunyi dengan kelas deleteID
      var id = $('.deleteID').val();
      // Mendapatkan tombol hapus dengan kelas btn-delete
      var btn = $('.btn-delete');

      
      // Mengganti teks tombol dengan ikon spinner dan teks "Menghapus..."
      btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

      // Menggunakan jQuery untuk menangani tindakan klik pada tombol Delete di modal
      $.ajax({
        method: 'POST',
        url: 'function/pelanggan_function.php',
        data: {
            id: id,
            action: 'delete_customer'
        },
        success: function (res) {
           // Jika server memberikan respons dengan kode 204 (sukses menghapus)
          if (res.code == 204) {
            // Mengganti teks tombol dengan ikon centang
            btn.html('<i class="fa fa-check"></i> Terhapus!');

            // Menetapkan timeout untuk menunggu sejenak sebelum menutup modal dan me-reload tabel
            setTimeout(() => {
              $('#deleteModal').modal('hide'); // Menutup modal hapus
              table.ajax.reload(); // Me-reload tabel pelanggan
              btn.html('Hapus'); // Mengembalikan teks tombol menjadi "Hapus"
            }, 1500);
          }
        }
      })
    });

    // Inisialisasi tabel DataTable dengan konfigurasi tertentu
    var table = $('#customerList').DataTable({
      "ajax" : {
            type: "GET",
            url: 'function/pelanggan_function.php',
            data: {
                action: 'list'
            },
            success:  function(response) {
              // data lama, menambahkan data baru, dan menggambar tabel ulang
                table.clear().rows.add(response.data).draw();
            }
        },
      "columns" : [
        {"data": "id"},  // Kolom ID
        {"data": function (data, type, row) {
            return '<img src="'+ data.profile_picture +'" class="img img-fluid rounded" style="width: 40px;">'; // Kolom Foto Profil
        }
        },
        {"data": function (data, type, row) {
          // Membuat URL berdasarkan lokasi saat ini dan nama pelanggan
            var url = window.location.href.split('?')[0].replace('#', '');
            url = url + '/view/'+ data.id;

            // Mengembalikan hyperlink dengan URL
            return '<a href="'+ url +'">'+ data.name +'</a>';
        }// Kolom Nama dengan Hyperlink
        },
        {"data": "email"}, // Kolom Email
        {"data": "no_hp"}, // Kolom Nomor HP
        {"data": "alamat"}, // Kolom Alamat
        {"mRender": function (data, type, row) {
          // Membuat URL berdasarkan lokasi saat ini dan ID pelanggan untuk tombol Edit
            var url = window.location.href.split('?')[0].replace('#', '');
            url = url + '/edit/'+ row.id;

            // Mengembalikan tombol Hapus dengan hyperlink untuk mengedit
            return '<div class="text-right"><a href="#" data-id="'+row.id+'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash"></i></a></div>';}
        }// Kolom Aksi (Tombol Hapus)
      ],
      "language" : {
        "search" : "Cari:",// Label kolom pencarian
        "lengthMenu" : "Menampilkan _MENU_ data", // Label untuk menentukan jumlah data per halaman
        "info" : "Menampilkan _START_ sampai _END_ data dari _TOTAL_ data", // Informasi jumlah data yang ditampilkan
        "infoEmpty" : "Tidak ada data yang ditampilkan", // Pesan ketika tabel kosong
        "infoFiltered" : "(dari total _MAX_ data)", // Informasi bahwa data yang ditampilkan telah difilter
        "zeroRecords" : "Tidak ada hasil pencarian ditemukan", // Pesan ketika tidak ada hasil pencarian
        "paginate": {
          "first":"&laquo;", // Label untuk halaman pertama
          "last":"&raquo;",  // Label untuk halaman terakhir
          "next":       "&rsaquo;",  // Label untuk halaman berikutnya
          "previous":   "&lsaquo;" // Label untuk halaman sebelumnya
        },
      }
    });
});
</script>

<?php
    include 'layouts/footer.php';
?>