<?php
$insert = false;
$servername = "localhost";
$usrename = "root";
$password = "";
$database = "notes";

$conn = mysqli_connect($servername ,$usrename , $password, $database);
if(!$conn){
  die("Failed to connect: " . mysqli_connect_error());
}



//Insert data into database
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $title = $_POST['title'];
  $disc = $_POST['description'];

  $sql = "INSERT INTO `note` (`title`, `description`, `tstamp`) VALUES ('$title', '$disc', current_timestamp())";
  $result = mysqli_query($conn , $sql);
  if($result){
    $insert = true;
    header("Location: boot.php"); 
    exit(); 
  }
  else{
    echo "Failed";
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Death Note</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

  <script>
  $(document).ready(function () {
    $('#myTable').DataTable(); // Ensure the table has the correct ID
  });
</script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been submitted.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  
  }
  ?>
  <div class="container my-4">
    <form action="/CRUD/boot.php" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input type="text" name="title" class="form-control" id="title">
      </div>
      <div class="form-group">
        <label for="desc">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>


    <div class="table_Data">
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">S.No</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        
        <?php
        $sno = 0;
  $sql = "SELECT * FROM `note`";
  $result = mysqli_query($conn , $sql);
  while($row = mysqli_fetch_assoc($result)){
    $sno =  $sno+1;
    echo "<tr>
      <th scope='row'>" . $sno ."</th>
      <td>" . $row['title'] . "</td>
      <td>". $row['description'] ."</td>
      <td>Action</td>
    </tr>";
  }
  ?>

        <tbody>

        </tbody>
      </table>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    

</body>

</html>