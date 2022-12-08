<?php

require '../db_connect.php';
session_start();


echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hey '.$_SESSION["name"].'!</strong> WELCOME!!!!.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snoedit'])) {
    $amount = $_POST['amountedit'];
    $desc = $_POST['descedit'];
    $category = $_POST['categoryedit'];
    $sno = $_POST['snoedit'];
    // echo $sno;
    $sql = "UPDATE `expenditure` SET `amount` = '$amount' , `description` = '$desc' , `category` = '$category' WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
 
  }
  else if (isset($_POST['deletesno'])) {
    $sno = (int)$_POST['deletesno'];
    $sql = "DELETE FROM `expenditure` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);

  }
  else if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("location:../home/finalhomepage.html");
  }
  
 else{
  $amount = $_POST['amount'];
  $desc = $_POST['desc'];
  $category = $_POST['category'];
  //date_default_timezone_set('Asia/Kolkata');
 // $dt = date('d/m/Y') . "," . date('h:i A');
  $user=$_SESSION['user'];
  $sql = "INSERT INTO `expenditure` ( `amount`, `description`, `category`,`email`) VALUES ('$amount', '$desc', '$category','$user')";
  $result = mysqli_query($conn, $sql);
 }
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="dashboard.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com"> 
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com"> 
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
  <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300&family=Permanent+Marker&display=swap" rel="stylesheet">
  <title>Groww more</title>
  <style>
   
      #btnlogout{
        color:pink;
        border:none;
      }
      #btnlogout:hover{
        color: red;
        background-color: darkblue;
        border: 2px solid black;
        border-radius: 2px;
      }
      a{
        color:aquamarine;
        font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
      }

      th{
        font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        color: brown;
        font-size: 25px;
      }
      
  </style>
</head>

<body>

  <div class="bgimage">
    <img src="bg.jpeg" alt="" style="position:absolute;z-index:-1;width:100%;height:150%;filter:blur(4px);opacity:0.5px">

  </div>


  <!-- add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Add expenditure</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <form action="dashboard.php" method="POST">
            <div class="mb-3">
              <label for="amount" class="form-label">Amount:</label>
              <input type="text" class="form-control" name="amount" id="amount" aria-describedby="amountHelp">
            </div>
            <div class="mb-3">
              <label for="desc" class="form-label">Description:</label>
              <input type="text" class="form-control" id="desc" name="desc">
            </div>
            <div class="mb-3 category">
              <label>Category:</label>
              <!-- <input type="text" class="form-control" id="exampleInputPassword1"> -->
              <!-- <h5>Category</h5> -->
              <div>
                <input type="radio" name="category" id="productivity" value="productivity">
                <label for="productivity">Productivity</label>
              </div>
              <div>
                <input type="radio" name="category" id="entertainment" value="entertainment">
                <label for="entertainment">Entertainment</label>
              </div>
              <div>
                <input type="radio" name="category" id="basicneeds" value="basicneeds">
                <label for="basicneeds">Other basic needs</label>
              </div>
              <div>
                <input type="radio" name="category" id="health" value="health">
                <label for="health">Health</label>
              </div>
              <div>
                <input type="radio" name="category" id="misc" value="misc">
                <label for="misc">Miscellaneous</label>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- end of add model -->

  <!-- edit modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Update expenditure</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <form action="dashboard.php" method="POST">
            <input type="hidden" id="snoedit" name="snoedit">
            <div class="mb-3">
              <label for="amountedit" class="form-label">Amount:</label>
              <input type="text" class="form-control" name="amountedit" id="amountedit" aria-describedby="amountHelp">
            </div>
            <div class="mb-3">
              <label for="descedit" class="form-label">Description:</label>
              <input type="text" class="form-control" id="descedit" name="descedit">
            </div>
            <div class="mb-3 category">
              <label>Category:</label>
              <!-- <input type="text" class="form-control" id="exampleInputPassword1"> -->
              <!-- <h5>Category</h5> -->
              <div>
                <input type="radio" name="categoryedit" id="productivityedit" value="productivity">
                <label for="productivity">Productivity</label>
              </div>
              <div>
                <input type="radio" name="categoryedit" id="entertainmentedit" value="entertainment">
                <label for="entertainment">Entertainment</label>
              </div>
              <div>
                <input type="radio" name="categoryedit" id="basicneedsedit" value="basicneeds">
                <label for="basicneeds">Other basic needs</label>
              </div>
              <div>
                <input type="radio" name="categoryedit" id="healthedit" value="health">
                <label for="health">Health</label>
              </div>
              <div>
                <input type="radio" name="categoryedit" id="miscedit" value="misc">
                <label for="misc">Miscellaneous</label>
              </div>

            </div>

            <button type="submit" class="btn btn-primary">save changes</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- end of edit modal -->

  <!-- delete modal -->
  <div class="modal fade" id="deletemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deletemodalLabel">Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Do you want to delete transaction?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="dashboard.php" method="POST">
            <input type="hidden" id="deletesno" name="deletesno">
            <button type="submit" class="btn btn-primary">yes delete!!!</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- end of delete modal -->

  <!-- update income modal -->
  <div class="modal fade" id="updateincomeModal" tabindex="-1" aria-labelledby="updateincomeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateincomeModalLabel">Update Income</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/update.php" method="POST">
            <div class="mb-3">
              <label for="updateincome" class="form-label">Amount:</label>
              <input type="number" class="form-control" id="updateincome" aria-describedby="updateincomeHelp" name="updateincome">
            </div>
          </form>

        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-primary">update</button>
        </div>
      </div>
    </div>
  </div>

  <!-- end of update income modal -->

  <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color:#34568B;border:2px solid white;border-radius: 5px;">
    <div class="container-fluid" style="background-color: #34568B;">
      <a class="navbar-brand" href="#" style="margin:0px;font-size:30px;">Groww more</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#" style="margin:15px;font-size:16px">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/growwmore/investment/investment.php" style="margin:15px;font-size:16px">Investment</a>
          </li>
          <li>
          <div class="logout" style="margin:15px  ;">
            <form action="dashboard.php" method="POST">
            <input type="hidden" value="logout" name="logout">
            <button class="logoutbtn" id="btnlogout" type="submit" style="background-color:transparent;margin-top:6px;font-size:16px">Logout</button>
            </form>
          </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container dash">

    <!-- <div class="card d1" style="background-color:transparent;border:4px solid black">
      <h5 class="card-header" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">INCOME</h5>
      <div class="card-body">

        <h5 class="card-title" style="font-family:cursive">Amount earned:</h5>
        <?php
        $sql = "SELECT * FROM `user` ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo "<p>" . $row['amountearned'] . "</p>";
        ?>
        <p style="font-size:20px">250000</p>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateincomeModal">
          Update
        </button>
      </div>
    </div> -->

    <div class="card d2"  style="background-color:transparent;border:4px solid black">
      <h5 class="card-header" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">EXPENDITURE</h5>
      <div class="card-body">
        <h5 class="card-title" style="font-family:cursive">Amount spent:</h5>
        <?php
        $user=$_SESSION['user'];
        $sql = "SELECT SUM(amount) FROM expenditure GROUP BY(email) HAVING email='$user' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if($row!=NULL)
          echo '<p class="card-text" style="font-size:20px">' . $row[0] . '</p>';
        else
        echo '<p class="card-text" style="font-size:20px">0</p>';
        ?>
        <button class="btn btn-primary update" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
      </div>
    </div>

  </div>

  <div class="table mb-4">
    <h1 style="color:#993333;font-family: permanent marker,cursive;text-decoration:underline;text-align:center">Transaction details:</h1>
    <table class="table mb-4" id="myTable" style="color: black;">
      <thead>
        <tr>
          <th scope="col">Timestamp</th>
          <th scope="col">Amount</th>
          <th scope="col">Description</th>
          <th scope="col">Category</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $user=$_SESSION['user'];
        $sql = "SELECT * FROM `expenditure` WHERE email='$user'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr style='background-color:transparent;color:black;font-size:30px;font-family: Kalam, cursive;color:#660033'>
                 <td>" . $row['timestamp'] . "</td>
                 <td>" . $row['amount'] . "</td>
                 <td>" . $row['description'] . "</td>
                 <td>" . $row['category'] . "</td>
                 <td><button class='btn edit btn-primary' data-bs-toggle='modal' data-bs-target='#editModal' id=" . $row['sno'] . ">Edit</button>
                 <button type='button' class='btn btn-primary delete' data-bs-toggle='modal' data-bs-target='#deletemodal' id=d" . $row['sno'] . ">
                 Delete
                </button>
                 </td>
                 </tr>
                 ";
        }
        ?>
      </tbody>
    </table>

  </div>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode;
        timestamp = tr.getElementsByTagName("td")[0].innerText;
        amount = tr.getElementsByTagName("td")[1].innerText;
        desc = tr.getElementsByTagName("td")[2].innerText;
        category = tr.getElementsByTagName("td")[3].innerText;
        sno = e.target.id;
        amountedit.value = amount;
        descedit.value = desc;
        radiobtn = document.getElementById(category + 'edit');
        radiobtn.checked = true;
        snoedit.value = sno;
        console.log(sno);
      })
    })

      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
          sno = e.target.id.substr(1);
          deletesno.value = sno;
          console.log(deletesno.value);
        })
      })

      

   
    

  </script>



</body>

</html>