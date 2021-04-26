<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Upload gambarmu disini">
    <title>Upload Your Image</title>

    <link rel="shortcut icon" href="https://j.top4top.io/p_1942soeck0.jpg"/>
    <style type="text/css">
      * {
        margin: 0;
        padding: 0;
        text-decoration: none;
        font-family: Sans-Serif;
      }
      body {
        background-color: #dcdcdc;
      }
      .tengah {
        margin: auto;
        display: block;
      }
      .jarak {
        margin-top: 10%;
      }
      .jarak-3 {
        margin-top: 3%;
      }
      .jarak-bot {
        margin-bottom: 10%;
      }
      .box {
        padding: 20px;
        background-color: white;
        max-width: 80%;
        border-radius: 2%;
        box-shadow: 0 4px 8px 0 rgb(0,0,0,0.3);
      }
      input[type='file'] {
        background-color: greenyellow;
        padding: 15px;
        border-radius: 2%;
      }
      button[type='submit'] {
        margin-top: 3%;
        width: 30%;
        text-align: center;
        padding: 8px;
        font-size: 15px;
        color: black;
        background-color: #12ca38;
        border: none;
      }
      button[type='submit']:hover {
        border: none;
        background: none;
      }
      .tex {
        width: 50%;
        padding: 8px;
        border-color: black;
        background: none;
      }
      .butt {
        padding: 8px;
        background: black;
        color: white;
        border-color: black;
      }
      .butt:hover {
        color: black;
        background-color: silver;
      }
      .align {
        text-align: center;
      }
      footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        padding: 20px;
        background-color: lightseagreen;
        text-align: center;
        color: white;
      }
      footer a {
        color: greenyellow;
      }
    </style>
  </head>
  <body>
    <h2 align="center" class="jarak">UPLOAD IMAGES</h2>
    <div class="tengah jarak box">
      <?php
        error_reporting(0);
        if (!mkdir("uploads") === 1){
          return true;
        }
        if(isset($_POST["submit"])){
          $source = $_FILES["images"];
          $name = $source["name"];
          $type = $source["type"];
          $TmpName = $source["tmp_name"];
          $error = $source["error"];
          
          // Jika Error = int(4)
          function chek(){
            global $source, $name, $type, $TmpName, $error;
            if($error === 4){
              return '
              <script>
                alert("Pilih Gambar Yang Ingin Anda Upload");
              </script>
              ';
            }else {
              $extensi = ["jpg", "png", "jpeg"];
              $ex = explode(".", $name);
              $ex = strtolower(end($ex));
              if ( !in_array($ex, $extensi) ){
                return '
                  <script>
                    alert("Hanya format gambar yang bisa di upload");
                  </script>
                ';
              }else {
                $namenew = uniqid();
                $namenew .= ".";
                $namenew .= $ex;
          
                // upload
                $ssl = "https://"; // jika kemanan website anda memakai https, ganti menjadi https
                $web = $_SERVER["HTTP_HOST"];
                $main = $ssl.$web."/uploads/".$namenew;
                move_uploaded_file($TmpName, "uploads/".$namenew);
                return '
                    <img src="uploads/'.$namenew.'" alt="result" width="230" height="200" class="tengah"/>
                    <br>
                    <div class="result align">
                      <input type="text" value="'.$main.'" id="getText" class="tex" readonly>
                      <button type="button" onclick="copy_text()" class="butt">copy</button>
                    </div>
                    <hr class="jarak-3 jarak-bot"/>
                ';
              }
            }
          }
          
          echo chek();
          // generate name files
        }
      ?>
      <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="images" class="tengah">
        <button type="submit" name="submit" class="tengah">upload</button>
      </form>
    </div>
    <footer>
      <b>Author By <a href="https://github.com/hekelpro" target="_blank">RizkyDev</a></b>
    </footer>
    
    <script type="text/javascript">
      function copy_text() {
        document.getElementById("getText").select();
        document.execCommand("copy");
        alert("URL berhasil dicopy");
      }
    </script>
  </body>
</html>
