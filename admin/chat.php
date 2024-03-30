<?php 
    include 'layouts/header_chat.php';
?>
<!-- char-area -->
<section class="message-area">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="chat-area">
          <!-- chatlist -->
          <div class="chatlist">
            <div class="modal-dialog-scrollable">
              <div class="modal-content">
                <div class="chat-header">
                </div>

                <div class="modal-body">
                  <!-- chat-list -->
                  <div class="chat-lists">
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="Open" role="tabpanel" aria-labelledby="Open-tab">
                        <!-- chat-list -->
                        <div class="chat-list" id="chat_list">
                          
                        </div>
                        <!-- chat-list -->
                      </div>
                    </div>

                  </div>
                  <!-- chat-list -->
                </div>
              </div>
            </div>
          </div>
          <!-- chatlist -->

          <!-- chatbox -->
          <div class="chatbox showbox">
            <div class="modal-dialog-scrollable">
              <div class="modal-content">
                <div class="msg-head">
                  <div class="row">
                    <div class="col-8">
                    <div id="profile-chat">

                    </div>
                    </div>
                    <div class="col-4">
                      <ul class="moreoption">
                        <li class="navbar nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="modal-body">
                  <div class="msg-body">
                  <div id="chat">
                    <script>
                      if(x.length > 0){
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

                <div class="send-box" id="chat-input">
                  <div class="input-container">
                    <input type="text" class="form-control" name="pesan" id="message" aria-label="pesan" placeholder="Ketikkan pesan..">
                  </div>
                    <button type="submit" id="send" name="kirim" style="float: right; margin-top:5px;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Kirim</button>
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
<!-- char-area -->

<script>
  // Variable untuk menyimpan data chat
$(document).ready(function() {
    let x = [];
    let y = [];
    let user_id = 0;
    $("#chat").html(x);
    $("#chat_list").html(y);

     // Fungsi untuk mendapatkan histori chat berdasarkan user_id
    function getChat(user_id) {
        $.ajax({
            method: "GET",
            url: "function/chat_function.php",
            data: { action: 'get_chat', user_id: user_id },
            success: function(data) {
                $("#chat").html('');
                data.data.map(el => {
                    if (el['type'] == 'admin') {
                        $("#chat").append(`<ul>
                            <li class="repaly">
                                <p>${el['text']}</p>
                                <span class="time">${new Date(el['date']).getDate() + ' ' + new Date(el['date']).toLocaleString('en-US', { month: 'long' }) + ' ' + new Date(el['date']).getFullYear() + ' ' + new Date(el['date']).getHours() + ':' + new Date(el['date']).getMinutes() + ':' + new Date(el['date']).getSeconds()}</span>
                            </li>
                        </ul>`)
                    } else {
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

     // Mengaktifkan fungsi untuk mengirim pesan saat tombol kirim diklik
    $("#send").click(function() {
        var message = $("#message").val();

        $.ajax({
            method: "POST",
            url: "function/chat_function.php",
            data: { action: 'send_chat', text: message, user_id: user_id },
            success: function(res) {
                $("#message").val("");
                // Mendapatkan dan menampilkan histori chat setelah mengirim pesan
                getChat(user_id);
            }
        });
    });

    function get_user() {
        $.ajax({
            method: "GET",
            url: "function/chat_user_function.php",
            data: { action: 'get_user'},
            success: function(data) {
                // $("#chat").html(data.data[0]['text']);
                $("#chat_list").html('');
                data.data.map(ch => {
                  $("#chat_list").append(`<div class="user d-flex align-items-center" data-user-id="${ch['user_id']}">
                            <div class="flex-shrink-0" style="cursor:pointer;">
                              <img class="img-fluid" src="../customer/customer_gambar/${ch['profile_picture']}" alt="user img" style="width:70px;border-radius:50%;">
                            </div>
                            <div class="flex-grow-1 ms-3" style="cursor:pointer;">
                              <h3>${ch['name']}</h3>
                            </div>
                          </div>`)
                });

                $(".user").click(function() {
                    const userId = $(this).attr("data-user-id");
                    user_id = userId;
                    getUser(userId);
                    getChat(userId);
                });

            }
        });
    }

    // Fungsi untuk mendapatkan daftar user dan menampilkan dalam chat_list
    function getUser(user_id) {
        $.ajax({
            method: "GET",
            url: "function/chat_user_function.php",
            data: { action: 'get_user_by_id', user_id: user_id },
            success: function(data) {
              $("#profile-chat").html('');
              $("#profile-chat").append(`<div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                          <img class="img-fluid" src="../customer/customer_gambar/${data.data['profile_picture']}" alt="user img" style="width:70px;border-radius:50%;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                          <h3>${data.data['name']}</h3>
                        </div>
                        </div>`);
            }
        });
    }

    setInterval(function() {
        getChat(user_id);
        get_user();
    }, 1000);
});

</script>

<?php 
    include 'layouts/footer_chat.php';
?>