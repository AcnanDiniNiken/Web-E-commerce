<?php 
    include 'layouts/header_chat.php';
?>
<!-- char-area -->
<section class="message-area">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="chat-area">
          <!-- chatbox -->
          <div class="chatbox showbox">
            <div class="modal-dialog-scrollable">
              <div class="modal-content">
                <div class="msg-head">
                  <div class="row">
                    <div class="col-8">
                      <div class="d-flex align-items-center">
                        <span class="chat-icon"><img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg" alt="image title"></span>
                        <div class="flex-grow-1 ms-3">
                          <h3>Chat Admin</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal-body">
                  <div class="msg-body">
                  <div id="chat">
                    <script>
                      // Memeriksa apakah panjang variabel x lebih dari 0
                      if(x.length > 0){
                        // Menulis elemen div dengan teks dari properti 'text' objek x ke dalam dokumen
                        <div>{x['text']}</div>
                      }
                      // else{
                      //   <div class="row">
                      //   <div class="col-md-12 ftco-animate">
                      //     <div class="alert alert-info">Tidak ada chat.Gunakanlah fitur chat ini untuk membantu permasalahan anda pada sistem kami</div>
                      //   </div>
                      // </div>
                      // }
                    </script>
                  </div>
                  </div>
                </div>
                
              <!-- Bagian kotak input pesan -->
                <div class="send-box" id="chat-input">
                  <div class="input-container">
                    <!-- Input teks untuk mengetikkan pesan -->
                    <input type="text" class="form-control" name="pesan" id="message" aria-label="pesan" placeholder="Ketikkan pesan..">
                  </div>
                  <!-- Tombol kirim pesan -->
                    <button type="submit" id="send" name="kirim" style="float: right; margin-top:5px;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Kirim</button>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- chatbox -->

      </div>
    </div>
  </div>
  </div>
</section>

<script>
  // Inisialisasi array kosong 'x' untuk digunakan nanti
let x = [];
// Menyimpan array kosong 'x' ke elemen dengan ID 'chat'
$("#chat").html(x);
// Fungsi yang akan dijalankan setelah dokumen HTML selesai dimuat
$(document).ready(function() {
   // Fungsi untuk mengambil data obrolan dari server
    function getChat() {
        $.ajax({
            method: "GET", // Metode permintaan
            url: "function/chat_function.php", // URL endpoint untuk mengambil data obrolan
            data: { action: 'get_chat' }, // Data yang akan dikirim ke server (dalam hal ini, mengirim aksi 'get_chat')
            success: function(data) {
                 // Membersihkan isi elemen dengan ID 'chat' agar bisa diisi dengan data baru
                $("#chat").html('');
                // Mengiterasi melalui setiap pesan dalam data yang diterima dari server
                data.data.map(el => {
                  // Mengecek tipe pesan (apakah dari pelanggan atau pengirim)
                  if(el['type'] == 'customer'){
                    // Jika pesan dari pelanggan, tambahkan elemen HTML untuk menampilkan pesan pelanggan
                    $("#chat").append(`<ul>
                        <li class="repaly">
                          <p>${el['text']}</p>
                          <span class="time">${new Date(el['date']).getDate() + ' ' + new Date(el['date']).toLocaleString('en-US', { month: 'long' }) + ' ' + new Date(el['date']).getFullYear() + ' ' + new Date(el['date']).getHours() + ':' + new Date(el['date']).getMinutes() + ':' + new Date(el['date']).getSeconds()}</span>
                        </li>
                    </ul>`)
                  }else{
                    // Jika pesan dari pengirim, tambahkan elemen HTML untuk menampilkan pesan pengirim
                    $("#chat").append(`<ul>
                        <li class="sender">
                          <p>${el['text']}</p>
                          <span class="time">${new Date(el['date']).getDate() + ' ' + new Date(el['date']).toLocaleString('en-US', { month: 'long' }) + ' ' + new Date(el['date']).getFullYear() + ' ' + new Date(el['date']).getHours() + ':' + new Date(el['date']).getMinutes() + ':' + new Date(el['date']).getSeconds()}</span>
                        </li>
                    </ul>`)
                  }
                });
            }
        });
    }

    getChat();
// Menggunakan selector untuk menangkap klik pada elemen dengan ID 'send'
    $("#send").click(function() {
      // Mengambil nilai pesan dari input dengan ID 'message'
        var message = $("#message").val();

        // Menggunakan AJAX untuk mengirim data pesan ke server
        $.ajax({
            method: "POST", // Metode permintaan adalah POST
            url: "function/chat_function.php", // URL endpoint untuk mengelola pengiriman pesan
            data: { action: 'send_chat', text: message }, 
            success: function(res) {
              // Mengosongkan input pesan setelah berhasil mengirim pesan
                $("#message").val("");
                getChat();
            }
        });
    });

    // Mengatur interval untuk secara berkala memanggil fungsi getChat() setiap 1000 milidetik (1 detik)
    setInterval(getChat, 1000);
});
</script>
<!-- char-area -->
<?php 
    include 'layouts/footer_chat.php';
?>