<?php
    //koneksi databse
    $server = "localhost";
    $user = "root";
    $pass = "passowrdKamu";
    $database = "databaseKamu";
    $koneksi = mysqli_connect($server, $user, $pass, $database)
        or die (mysqli_error($koneksi));

    $avg = mysqli_query($koneksi, "select avg(score) as avg from mhs");
    /*Metode lain*/
    // foreach($avg as $a){
    //     $nilaiRata = $a['avg'];
    // }

    /*Cara Efektif*/
    $nilaiRata = mysqli_fetch_row($avg)[0];

    date_default_timezone_set('Asia/Singapore');
    // l = hari; j=tanggal; F = bulan; Y = tahun; h = jam; i = minute; A = dateformat; s= second
    $tanggal = date('F j\, Y\, h:i a');
    // var_dump($tanggal);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project UAS</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4d636c26ba.js" crossorigin="anonymous"></script>
</svg>
    <style>
            .body-table {
                overflow-x: scroll;
            }
    </style>
</head>
<body>

<div class="container">  
    <h2 class="text-center bg-light text-dark p-1">PROJECT UAS</h2>
    <div class="card">
        <div class="d-flex flex-lg-row justify-content-between flex-column card-header bg-success text-white">
            <div class="subJudul">New Data</div>
             <div class="waktu"><?=$tanggal?></div>
        </div>
        
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group col-md-6">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="name" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Department</label>
                    <select name="fakultas" class="form-control">
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Teknik Industri">Teknik Industri</option>
                    </select>
                </div> 
                
                <div class="form-group col-md-6">
                    <label>Score</label>
                    <input type="number" max="100" placeholder="0" min="0" step="1" name="score" class="form-control" required>
                </div>
                
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary btn-sm" name="save" >SAVE</button>    
                </div>
                
            </form>
        </div>
    </div> 

    <div class="card mt-3">
        <div class="card-header bg-primary text-white d-flex flex-lg-row flex-column justify-content-start">
             <div class="flex-grow-1"> Students Data </div>
             <div class="ml-1 mr-1 d-none d-lg-block"> | </div>
             <div class="">Avarage Score: <?=$nilaiRata?></div>
        </div>
        <div class="card-body overflowX-auto body-table">
           
            <table class="table table-bordered table-striped table-position">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Score</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
    <?php
        
        $no = 1;
        $tampil =mysqli_query($koneksi,"SELECT *from mhs order by id_mhs asc");
        
        //jika tombol SAVE di klik
        if(isset($_POST['save']))
            {   $status = "";
                $score = $_POST['score'];
                if(($score > 59) AND ($score < 101 ))
                        {
                            $status = "OK";
                        }
                        else if(($score > 0) AND ($score < 60))
                        {
	                        $status = "REMEDIAL";
                        }
                // $query ='INSERT INTO mhs (nama, department, score, statusNilai)'
                $save = mysqli_query($koneksi, "INSERT INTO mhs (nama, department, score, statusNilai)
                                                VALUES  ('$_POST[name]',  
                                                        '$_POST[fakultas]', 
                                                        '$score',
                                                        '$status')
                                                ");
                     
                if($save) //save success
                {
                    echo    "<script>
                            alert('Save Data Success!');
                            document.location='index.php';
                            </script>";
                }
                else
                {
                    echo    "<script>
                            alert('Save Data Failed!');
                            // document.location='index.php';
                            </script>";
                }
               
            }
        if(isset($_GET['del']))
        {
            if($_GET['del'] == "delete")
            {
                $delete = mysqli_query($koneksi, "DELETE FROM mhs WHERE id_mhs = '$_GET[id]' ");
                if(delete)
                {
                    echo    "<script>
                            alert('Delete Data Success!');
                            document.location='index.php';
                            </script>";
                }
            }
        }

        while($data = mysqli_fetch_array($tampil)) :  
    
    ?>
                <tr>
                    <td><?=$no++;?></td>
                    <td><?=$data['nama']?></td>
                    <td><?=$data['department']?></td>
                    <td><?=$data['score']?></td>
                    <td>
                        <span class="badge badge-pill <?=($data['score'] >=60) ? "badge-success" : "badge-danger"?>"><?=$data['statusNilai']?></span>
                    </td>
                    <td>
                        <a href="index.php?del=delete&id=<?=$data['id_mhs']?>" 
                        onclick="return confirm('Are you sure delete this data?')" class="btn btn-warning btn-sm text-justify"><i class="far fa-trash-alt mr-2"></i>Delete</a>
                    </td>
                </tr>
            <?php endwhile; //penutup perulangan while?>
            
            </table>

        </div>
    </div>
</div>


<script type="text/javasciprt" src="js/bootstrap.min.js"></script>
</body>
</html>