<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            font-size: 14px;
        }

        .error {
            color: #FF0000;
        }

        input[type=text], input[type=email], input[type=tel], select {
            width: 100%;
            padding: 8px 12px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 8px 12px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 12px;
        }

        input[type=submit] {
            width: 100%;
            background-color: #0099CC;
            color: white;
            padding: 8px 12px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #0066CC;
        }

        input[type=submit]:disabled {
            background-color: #DDDDDD;
            cursor: not-allowed;
        }

        #left {
            float:left;
            width:270px;
        }

        #right {
            float:right;
            width:250px;
            font-size:12px;
            text-align:justify;
        }
    </style>

</head>
<body>
<?php
if(isset($_POST["submit"])){
    $hostname='localhost';
    $username='root';
    $password='mysql';

    try {
        $dbh = new PDO("mysql:host=$hostname;dbname=KULDatabase",$username,$password);

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
        $sql = "INSERT INTO KULDalyviai (KULVardas, KULPavarde, EPastas, Pareigos, Darboviete, Telefonas)
VALUES ('".$_POST["asmuo"]."','".$_POST["pavarde"]."','".$_POST["email"]."','".$_POST["tel"]."','".$_POST["istaiga"]."'
   ,'".$_POST["pareigos"]."')";
        if ($dbh->query($sql)) {
            echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
        }
        else{
            echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
        }

        $dbh = null;
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

}
?>

<form name="regForma" method="post" action="Registracija.php">
    <label for="rengID">Renginys</label>
    <span class="error"><div id="KUL_info" style="visibility: hidden"></div></span><br />
    <label for="asmID">Vardas, Pavardė<span class="error"> * </span></label>
    <input type="text" id="asmID" name="asmuo" maxlength="100" value="">
    <label for="pavardeID">PAVARDE<span class="error"> * </span></label>
    <input type="text" id="pavardeID" name="pavarde" maxlength="100" value="">
    <label for="mailID">E-paštas<span class="error"> * </span></label>
    <input type="email" id="mailID" name="email" maxlength="100" value="">
    <label for="telID">Tel.:</label>
    <input type="tel" id="telID" name="tel" maxlength="45" value="">
    <label for="istID">Darbovietė<span class="error"> * </span></label>
    <input type="text" id="istID" name="istaiga" maxlength="100" value="">
    <label for="parID">Pareigos</label>
    <input type="text" id="parID" name="pareigos" maxlength="100" value="">
    <span class="error"> * </span>

    <input id="submitButton" type="submit" name="submit" value="submit">
</form>
<span class="error">* privalomas laukas.</span><br />
Pildydami registracijos formą naudokite lietuviškus rašmenis.
<script> valueselect(0); </script>