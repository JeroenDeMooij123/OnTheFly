<!DOCTYPE html>
<html>
<head>
    <title>On the Fly</title>
<link rel="stylesheet" type="text/css" href="OnTheFlycss.css" media="screen"/>

</head>
<body>

    <h1>On the fly!</h1>
    <hr/>
	<center>
    <form method="POST">
        <label for="txtAirplanenumber">Airplanenumber</label>
        <input type="text" name="txtAirplanenumber" id="txtAirplanenumber">
        <br/>
        <label for="txtPlanetype">Planetype</label>
        <input type="text" name="txtPlanetype" id="txtPlanetype">
        <br/>
        <label for="txtAirline">Airline</label>
        <input type="text" name="txtAirline" id="txtAirline">
        <br/>
        <label for="txtStatus">Status</label>
        <input type="text" name="txtStatus" id="txtStatus">
        <br/>
        <input type="submit" name="btnSave" value="Opslaan">
    </form>
	</center>
    <?php

include "OnTheFlyDB.php";


    // Als er op de knop btnSave geklikt is
    if(isset($_POST['btnSave'])) {
        // Tekstvelden uitlezen en opslaan in variable
        $Planenumber = $_POST['txtAirplanenumber'];
        $Planetype = $_POST['txtPlanetype'];
        $airline = $_POST['txtAirline'];
        $Status = $_POST['txtStatus'];
        // Query maken om vliegtuig toe te voegen
        $query = "INSERT INTO airplanes (Planenumber, Planetype, airline, Status)
                  VALUES ('$Planenumber', '$Planetype', '$airline', '$Status')";
        // Query klaar zetten om uit te voeren
        $stm = $con->prepare($query);
        // Als de Query succesvol uit gevoerd wordt
        if($stm->execute()){
            echo "Airplane has been successfully added.";
        } else {
            echo "Something wrong!";
        }
    }
    ?>
    <hr/>
    <table>
        <thead>
        <tr>
            <th>airplanenumber</th>
            <th>planetype</th>
            <th>airline</th>
            <th>status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Query om vliegtuigen op te halen
        $query = "SELECT * FROM airplanes";
        $stm = $con->prepare($query);
        if($stm->execute()){
            // Vliegtuigen uit het resultaat halen als objecten en opslaan in $airplanes
            $airplanes = $stm->fetchAll(PDO::FETCH_OBJ);
            // Loop door alle vliegtuigen heen
            foreach($airplanes as $airplane){
                // Let op: tr in de loop omdat we 1 vliegtuig per row hebben
                echo "<tr>";
                echo "<td>$airplane->Planenumber</td>";
                echo "<td>$airplane->Planetype</td>";
                echo "<td>$airplane->airline</td>";
                echo "<td>$airplane->Status</td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
	<select>
        <option value="All"> All Planes </option>
        <option value="Flying"> Flying </option>
        <option value="Landed"> Landed </option>
        <option value="Crashed"> Crashed </option>
        <option value="Repairing"> Repairing </option>
    </select>

</body>
</html>