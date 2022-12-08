<html>




<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

    $yr=$_POST['expenditureyr'];
    
}
?>

<body>

<form action="test.php" method="post" onchange="myFunction()" id="myForm">
<select name="expenditureyr" id="">
<option value="0" selected disabled><--select the expenditure year--></option>
<option value="1">1 year</option>
<option value="3">3 year</option>
<option value="5">5 year</option>
</form>

<script>
    function myFunction(){
        document.getElementById("myForm").submit()
    }
</script>

</body>


</html>