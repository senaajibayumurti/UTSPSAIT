<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Data</title>
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
    <div class="card-header">
        <h1 class="text-center">UTS PSAIT</h1>
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="true" href="selectNilaiView.php">Games</a>
            </li>
            <li class="nav-item">
                <a href="insertNilaiView.php" class="nav-link active"> Add New</a>
            </li>
        </ul>
    </div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <p>Please fill this form and submit to add a new game record to the database.</p>
                    <form action="insertGamesDo.php" method="post">
                        <div class="form-group">
                            <label>Games Name</label>
                            <input type="text" name="nim" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Games Description</label>
                            <input type="text" name="kode_mk" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Games Main Type</label>
                            <input type="text" name="nilai" class="form-control">
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
