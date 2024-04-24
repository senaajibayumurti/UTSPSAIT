<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<?php
$nim = $_GET['nim'];
$kode_mk = $_GET['kode_mk'];


$curl= curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
curl_setopt($curl, CURLOPT_URL, 'http://localhost/psait_uts/mahasiswa_api.php?nim='.$nim.'&kode_mk='.$kode_mk.'');
$res = curl_exec($curl);
$json = json_decode($res, true);
// var_dump($json);

{
?>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h2>Update Data</h2>
                        </div>
                        <p>Please fill this form and submit to update game record in the database.</p>
                        <form action="updateNilaiDo.php" method="post">
                            <input type = "hidden" name="nim" value="<?php echo"$nim";?>">
                            <input type = "hidden" name="kode_mk" value="<?php echo"$kode_mk";?>">
                            <div class="form-group">
                                <label>Nilai</label>
                                <input type="text" name="nilai" class="form-control" value="<?php echo ($json["data"][0]["nilai"]); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-3" name="submit" value="submit">Simpan</button>
                        </form>
                    </div>
                </div>        
            </div>
        </div>
<?php
    }
?>
</body>
</html>
