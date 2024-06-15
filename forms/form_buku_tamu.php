<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Buku Tamu Kabupaten Gresik</title>
    <link rel="icon" href="../assets/img/logo2.png">
    <!-- <link href="../assets/css/style.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js@2.1.4/dist/tesseract.min.js"></script>

</head>
<style>
    
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background: #121212;
    color: #fff;
    display:contents;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: auto;
    overflow-y: auto;
}
h2 {
    padding: 0;
    margin: 0;
    text-align: center;
}

a {
    text-decoration: none;
    color: inherit;
}

ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Container */
div {
    text-align: center;
    align-items: center;
    align-content: center;
    padding: 20px;
    background: #1f1f1f;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Logo Styles */
#logo {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}

.sitename {
    font-size: 24px;
    font-weight: 700;
    color: #ffc107;
}

/* Navbar Styles */
#nav {
    display: flex;
    justify-content: center;
}

#nav ul {
    display: flex;
}

#nav ul li {
    margin: 0 10px;
}

#nav ul li a {
    padding: 10px 20px;
    color: #fff;
    background: #343a40;
    border-radius: 4px;
    transition: background 0.3s, color 0.3s;
}

#nav ul li a:hover {
    background: #ffc107;
    color: #343a40;
}

/* Responsive Styles */
@media (max-width: 600px) {
    .sitename {
        font-size: 18px;
    }

    #nav ul {
        flex-direction: column;
    }

    #nav ul li {
        margin-bottom: 10px;
    }

    #nav ul li a {
        width: 100%;
        text-align: center;
    }
}





/*CSS Untuk form*/
form {
    background: #1f1f1f;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    margin: 0 auto;
}
#manual-form {
    background: #1f1f1f;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    margin: 0 auto;
    height: 100%;
}

form input[type="text"],
form textarea {
    width: 50%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #343a40;
    border-radius: 4px;
    background: #2d2d2d;
    color: #fff;
}

form input[type="text"]::placeholder,
form textarea::placeholder {
    color: #aaa;
}

form input[type="submit"] {
    background: red;
    color: #ffffff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s, color 0.3s;
}

form input[type="submit"]:hover {
    background: #00e04b;
    color: rgb(0, 0, 0);
}

/* Reset styling for select element */
select{
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #343a40;
    border-radius: 4px;
    background: #2d2d2d;
    color: #fff;
    cursor: pointer;
}

/* Styling when select element is hovered */
select:hover {
    border-color: #ffffff;
}


button{
    background: #ff0000;
    color: #ffffff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s, color 0.3s;
}


#button-container {
    position: relative;
    display: flex;
    justify-content: space-between;
}

#select-form, #admin-button {
    position: absolute;
    top: 60px;
}

#select-form {
    right: 180px;
}

#admin-button {
    right: 20px;
}






#video {
    transform: scaleX(-1); /* Untuk membalikkan video secara horizontal */
}
#message {
    width: 300px; /* Atur lebar sesuai kebutuhan */
    height: 100px; /* Atur tinggi sesuai kebutuhan */
  }




  
  /* dropdown */
  .custom-dropdown select {
    border-bottom: 2px solid #ccc;
    font-size: 16px;
    font-family: Arial, sans-serif;
    color: #ffffff;
    cursor: pointer;
  }
</style>
<body>
    <div id="button-container">
        <div id="select-form">
            <button onclick="toggleForm('manual-form')" id="manual-button"><span id="manual-button-text">Isi
                    Manual</span></button>
        </div>
        <div id="admin-button">
            <a href="forms/loginadmin/form_login_admin.php"><button>Login Admin</button></a>
        </div>
    </div>
    <div id="ktp-form">
    <form action="script/submit_data_buku_tamu.php" method="post">
            <div>
            <span id="countdown-display" style="font-size: 20px; margin-left: 10px;"></span><br>
            <video id="video" width="320" height="240" autoplay></video>
            <br>
            <br>
            <button type="button" onclick="startCountdown()">Capture & Scan KTP</button><script src="script/count2.js"></script><br><br>
            
                <div id="frame"
                    style="position: absolute; margin: 0 auto; width: 320px; height: 180px; border: 2px solid white; pointer-events: none;">
                </div>
            </div>
            <div>
                <br><br><br><br><br><br><br><br><br><br><br>
            </div>

            <div id="nik-container" border: 1px solid #ccc; padding: 10px; margin-top: 10px;">
                <div id="progress-container" margin-top: 10px; style="display:none;">
                    <strong>Progress:</strong>
                    <progress id="progress-bar" value="0" max="100"></progress>
                </div><br><br>
                <strong>NIK:</strong> <span id="scanned-nik"></span><br>
                <input type="text" id="no_ktp" name="no_ktp" readonly><br>
            </div>
            
           
            

            <div class="custom-dropdown">
                <label for="tempat">Tempat:</label>
                <select id="tempat" name="tempat" required>
                    <option value="" disabled selected hidden>Tempat</option>
                    <option value="Diskominfo">Diskominfo</option>
                    <option value="Pemkab">Pemkab</option>
                    <option value="Dinsos">Dinsos</option>
                </select>
            </div>

            <div class="custom-dropdown">
                <label for="layanan">Layanan:</label>
                <select id="layanan" name="layanan">
                    <option value="" disabled selected hidden>Layanan</option>
                    <option value="Bidang SIP">Bidang SIP</option>
                    <option value="Bidang SPBE">Bidang SPBE</option>
                    <option value="Bidang TI">Bidang TI</option>
                    <option value="Kepala Dinas Kominfo">Kepala Dinas Kominfo</option>
                    <option value="Radio">Radio</option>
                    <option value="Sekretariat">Sekretariat</option>
                    <option value="Sekretaris Dinas Kominfo">Sekretaris Dinas Kominfo</option>
                </select>
            </div>
            <br>
            
            <!-- //manipulated script -->
            <input type="text" id="name-ktp"placeholder="" style="display:none;"><br>

            <label for="name-ktp">Nama:</label>
            <input type="text" name="nama" placeholder=""><br> 

            <label for="email-ktp">Email:</label>
            <input type="text" id="email-ktp" name="email" placeholder="" required><br>

            <label for="message">Keperluan:</label>
            <textarea id="message" name="message" placeholder="" required></textarea><br>
            
            <input type="submit" value="Submit">
        </form>
        <script src="script/ocr_ktp2.js"></script>
    </div>  

    <div id="manual-form" style="display:none;">

        <form action="script/submit_data_buku_tamu.php" method="post">
            <label for="no_ktp">No KTP:</label>
            <input type="text" id="no_ktp" name="no_ktp" placeholder="No KTP"><br>

            <div class="custom-dropdown">
                <label for="tempat">Tempat:</label>
                <select id="tempat" name="tempat" required>
                    <option value="" disabled selected hidden>Tempat</option>
                    <option value="Diskominfo">Diskominfo</option>
                    <option value="Pemkab">Pemkab</option>
                    <option value="Dinsos">Dinsos</option>
                </select>
            </div>

            <div class="custom-dropdown">
                <label for="layanan">Layanan:</label>
                <select id="layanan" name="layanan">
                    <option value="" disabled selected hidden>Layanan</option>
                    <option value="Bidang SIP">Bidang SIP</option>
                    <option value="Bidang SPBE">Bidang SPBE</option>
                    <option value="Bidang TI">Bidang TI</option>
                    <option value="Kepala Dinas Kominfo">Kepala Dinas Kominfo</option>
                    <option value="Radio">Radio</option>
                    <option value="Sekretariat">Sekretariat</option>
                    <option value="Sekretaris Dinas Kominfo">Sekretaris Dinas Kominfo</option>
                </select>
            </div>
            <br>
            <label for="name-ktp">Nama:</label>
            <input type="text" name="nama" placeholder=""><br> 
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><br>
            <label for="message">Message:</label>
            <textarea id="message" name="message"></textarea><br>
            <input type="submit" value="Submit">

        </form>
        <!-- <script src="script/ocr_ktp2.js"></script> -->
    </div>
</body>

</html>