<?php 
    include 'layouts/header.php'; // Mengimpor header template ke halaman
?>
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Kelola Kategori Produk</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="produk.php">Produk</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" data-target="#addModal" data-toggle="modal" class="btn btn-sm btn-neutral">Tambah</a>
              <!-- Tombol "Tambah" dengan atribut data-target dan data-toggle untuk menampilkan modal ketika diklik -->
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
            <div class="card-header border-0">
              <h3 class="mb-0">Kategori Produk</h3>
            </div>

            <div class="packageContainer">
            <!-- Light table -->
            <div class="table-responsive">
              <!-- Tabel untuk menampilkan daftar kategori produk -->
              <table class="table align-items-center table-flush" id="packageList" style="width: 100%">
                <thead class="thead-light">
                  <!-- Baris kepala tabel dengan judul kolom -->
                  <tr>
                    <!-- Kolom untuk nomor urut,nama -->
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
               
              </table>
            </div>
          </div>
            
          </div>
        </div>
      </div>

<!-- Modal untuk menambah kategori -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-body p-0">
              <div class="card bg-secondary border-0 mb-0">
                  <div class="card-header bg-transparent">
                      <h3 class="card-heading text-center mt-2">Tambah Kategori</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                     <!-- Formulir untuk menambah kategori -->
                      <form role="form" action="#" method="POST" id="addCategoryForm">
                          <!-- Grup formulir untuk nama kategori -->
                          <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                  </div>
                                  <!-- Input teks untuk memasukkan nama kategori -->
                                  <input name="name" class="form-control" placeholder="Nama " type="text" minlength="4" maxlength="255" required>
                                </div>
                                <!-- Pesan kesalahan jika terjadi kesalahan pada nama -->
                                <div class="text-danger err name-error"></div>
                          </div>
                           <!-- Tombol untuk membatalkan penambahan kategori -->
                          <div class="text-left">
                              <button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
                          </div>
                          <!-- Tombol untuk menambahkan kategori -->
                          <div class="float-right" style="margin-top: -90px">
                            <button type="submit" class="btn btn-primary my-4 addPackageBtn">Tambah</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Hapus Kategori</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <!-- Formulir untuk menghapus kategori -->
          <form action="#" id="deleteCategory" method="POST">
            <!-- Input tersembunyi untuk menyimpan ID kategori yang akan dihapus -->
            <input type="hidden" name="id" value="" class="deleteID">

          <div class="modal-body">
            <!-- Pesan konfirmasi untuk menghapus kategori -->
              <p>Yakin ingin menghapus? Tindakan ini tidak dapat dibatalkan.</p>
          </div>
          <div class="modal-footer">
             <!-- Tombol untuk menghapus kategori -->
              <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
              <!-- Tombol untuk membatalkan penghapusan kategori dan menutup modal -->
              <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Batal</button>
          </div>
          </form>
      </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-body p-0">
              <div class="card bg-secondary border-0 mb-0">
                  <div class="card-header bg-transparent">
                      <h3 class="card-heading text-center mt-2">Edit Kategori</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                    <!-- Formulir untuk mengedit kategori -->
                      <form role="form" action="#" method="POST" id="editCategoryForm">
                        <!-- Input tersembunyi untuk menyimpan ID kategori yang akan diedit -->
                        <input type="hidden" name="id" value="" class="edit-id">
                          <!-- Grup formulir dengan input teks untuk mengedit nama kategori -->
                          <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                  </div>
                                  <!-- Input teks untuk mengedit nama kategori -->
                                  <input name="name" class="form-control edit-name" placeholder="Nama paket" type="text" minlength="4" maxlength="100" required>
                                </div>
                                 <!-- Pesan kesalahan untuk validasi nama -->
                                <div class="text-danger err name-error"></div>
                          </div>
                          <!-- Tombol untuk membatalkan pengeditan -->
                          <div class="text-left">
                              <button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
                          </div>
                                <!-- Tombol untuk menyimpan perubahan dan menutup modal -->
                          <div class="float-right" style="margin-top: -90px">
                            <button type="submit" class="btn btn-primary my-4 editPackageBtn">Simpan</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Menambahkan stylesheet untuk DataTables -->
<link href="../css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Menambahkan script untuk jQuery dan DataTables -->
<script src="../js/datatable/jquery.dataTables.min.js"></script>
<script src="../js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="../js/datatable/datatables.lang.js"></script>
<script>
  $(document).ready(function() {
    // Menggunakan event delegation untuk menangani tindakan klik pada tombol Delete dengan kelas .btnDelete
    $(document).on('click', '.btnDelete', function() {
      // Mendapatkan ID dari atribut data-id pada tombol Delete yang diklik
      var id  = $(this).data('id');

       // Menetapkan nilai ID ke input tersembunyi dalam modal hapus
      $('.deleteID').val(id);
        // Menampilkan modal hapus
      $('#deleteModal').modal('show');
       // Debugging: Log ID ke konsol
      console.log(id);
    });

     // Menggunakan event delegation untuk menangani tindakan klik pada tombol Edit dengan kelas .btnEdit
    $(document).on('click', '.btnEdit', function() {
      // Mendapatkan ID dari atribut data-id pada tombol Edit yang diklik
      var id  = $(this).data('id');

      // Mengirim permintaan AJAX untuk mendapatkan data kategori berdasarkan ID
      $.ajax({
        method: 'GET',
        url: 'function/kategori_function.php',
        data: {
            action:'view_data',
            id:id,
        },
        success: function(res) {
          // Memeriksa apakah respon mengandung data
          if (res.data) {
            var d  = res.data;


            // Menetapkan nilai ID dan nama kategori ke formulir edit dalam modal
            $('.edit-id').val(d.id);
            $('.edit-name').val(d.nama);
            
            // Menampilkan modal edit
            $('#editModal').modal('show');
          }
        }
      });
    });

    // Menggunakan jQuery untuk menangani pengiriman formulir saat mengedit kategori
    $('#editCategoryForm').submit(function(e) {
      e.preventDefault();

      // Mendapatkan elemen tombol edit
      var btn = $('.editPackageBtn');
      // Mendapatkan ID dan data formulir
      var id = $('.edit-id').val();
      var data = $(this).serialize();

      // Menampilkan ikon spinner pada tombol edit dan menonaktifkan tombol
      btn.html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...').attr('disabled', true);

      // Mengirim permintaan AJAX untuk mengedit kategori
      $.ajax({
        method: 'POST',
        url: 'function/kategori_function.php',
        data: data + '&action=edit_category',
        success: function (res) {
           // Memeriksa apakah pengeditan berhasil
          if (res.code == 201) {
            // Menampilkan ikon centang pada tombol edit
            btn.html('<i class="fa fa-check"></i> Berhasil').removeAttr('disabled');

             // Menunda beberapa detik, kemudian menyembunyikan modal edit, memuat ulang tabel, dan mengembalikan teks tombol edit
            setTimeout(() => {
              $('#editModal').modal('hide');
              table.ajax.reload();
              btn.html('Simpan');
            }, 1500);
          }
        }
      })
    });

    // Menggunakan jQuery untuk menangani pengiriman formulir saat menghapus kategori
    $('#deleteCategory').submit(function(e) {
      e.preventDefault();

      // Mendapatkan ID dan elemen tombol hapus
      var id = $('.deleteID').val();
      var btn = $('.btn-delete');

      // Menampilkan ikon spinner pada tombol hapus
      btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

      // Mengirim permintaan AJAX untuk menghapus kategori
      $.ajax({
        method: 'POST',
        url: 'function/kategori_function.php',
        data: {
            action: 'delete_category',
            id:id
        },
        success: function (res) {
           // Memeriksa apakah penghapusan berhasil
          if (res.code == 204) {
            // Menampilkan ikon centang pada tombol hapus
            btn.html('<i class="fa fa-check"></i> Terhapus!');

            setTimeout(() => {
              $('#deleteModal').modal('hide');
              table.ajax.reload();
              btn.html('Hapus');
            }, 1500);
          }
        }
      })
    });

    // Inisialisasi DataTable
    var table = $('#packageList').DataTable({
      "ajax" : {
            type: "GET",
            url: 'function/kategori_function.php',
            data: {
                action: 'list'
            },
            success:  function(response) {
              // Membersihkan dan mengganti data tabel dengan data yang diterima dari server, kemudian menggambar tabel ulang
                table.clear().rows.add(response.data).draw();
            }
        },
      "columns" : [
        {"data": "id"},
        {"data": "nama"},
        {"mRender": function (data, type, row) {
          // Kolom Aksi (Edit dan Delete) dengan menggunakan tombol dan ikon Font Awesome
          return '<div class="text-right"><a href="#" data-id="'+row.id+'" class="btn btn-warning btn-sm btnEdit"><i class="fa fa-edit"></i></a><a href="#" data-id="'+row.id+'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash"></i></a></div>';}
        }
      ],
      "language" : {
         // Konfigurasi teks dan tata bahasa untuk antarmuka DataTable
        "search" : "Cari:",
        "lengthMenu" : "Menampilkan _MENU_ data",
        "info" : "Menampilkan _START_ sampai _END_ data dari _TOTAL_ data",
        "infoEmpty" : "Tidak ada data yang ditampilkan",
        "infoFiltered" : "(dari total _MAX_ data)",
        "zeroRecords" : "Tidak ada hasil pencarian ditemukan",
        "paginate": {
          "first":"&laquo;",
          "last":"&raquo;",
          "next":       "&rsaquo;",
          "previous":   "&lsaquo;"
        },
      }
    });


    // Menggunakan jQuery untuk menangani pengiriman formulir penambahan kategori
    $('#addCategoryForm').submit(function(e) {
      e.preventDefault();

       // Mengambil data formulir dalam format URL-encoded
      var data = $(this).serialize();
      var btn = $('.addPackageBtn');

      // Menampilkan ikon spinner dan pesan "Menambah..."
      btn.html('<i class="fa fa-spin fa-spinner"></i> Menambah...');
      $('.err').empty();// Menghapus pesan kesalahan sebelumnya

      // Mengirim permintaan AJAX untuk menambahkan kategori baru
      $.ajax({
        method: 'POST',
        url: 'function/kategori_function.php',
        data: data + '&action=add_category',
        context: this,
        success: function(response) {
          console.log(response);
          // Jika penambahan berhasil, menampilkan ikon cek dan pesan "Berhasil!"
          if (response.data) {
            btn.html('<i class="fa fa-check"></i> Berhasil!');

             // Mengatur timeout untuk membersihkan formulir setelah 2 detik
            setTimeout(function() {
              $('#addCategoryForm .form-control').val(null);
              btn.html('Tambah');
            }, 2000);
            setTimeout(() => {
              $('#addModal').modal('hide');
            }, 2222);

             // Me-reload data tabel kategori
            table.ajax.reload();
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          // Jika terjadi kesalahan, menampilkan pesan kesalahan dan merestore tombol Tambah
          btn.html('Tambah');

           // Mendapatkan dan menangani kesalahan validasi dari server
      var errors = xhr.responseJSON.errors;
          var errors = xhr.responseJSON.errors;

          $.each(errors, function(keys, val) {
            $.each(val, function(key, val) {
              // Menampilkan pesan kesalahan pada elemen dengan kelas .{nama}-error
              $('.'+ keys +'-error').text(val);  
            });
          });
        }
      })
    })
  });
</script>

<?php 
    include "layouts/footer.php";
?>