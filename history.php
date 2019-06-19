<?php include ("dbh.php") ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,600" rel="stylesheet" type="text/css">
        <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
        <link type="text/css" rel="stylesheet" href="style.css">
        <title>Budget App Futuris</title>
    </head>
    <body>
        
        <div class="top">
            <div class="budget">
                <div class="budget__title">
                    Geschiedenis budget
                </div>
            </div>
        </div>
        
        
        


            <form action="#" method="post" enctype="multipart/form-data" class="middle">
                <select class="add__type" name="select_month">
                    <?php

                        // Uit de database worden de beschikbare maanden gehaald
                        $query = "SELECT DISTINCT budget_month FROM budget";
                        $select_month = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_month)) {
                        $month = $row['budget_month'];

                        // Waardes in box zetten
                        echo "<option value='$month'>$month</option>";

                        }
                    ?>
                </select><br><br>


                <div class="form-group">
                    <input class="btn" type="submit" name="bekijk_maand" value="Bekijk deze maand">
                </div><br><br>
            </form>



            <table>
                <thead>
                    <tr>
                        <th>Maand</th>
                        <th>Wat?</th>
                        <th>Beschrijving</th>
                        <th>Bedrag</th>
                    </tr>
                </thead>

                <tbody>

                <?php



                if(isset($_POST['bekijk_maand'])) {

                    // Bekijk de geselecteerde maand
                    $month = $_POST['select_month'];

                    // Query
                    $query = "SELECT * FROM budget WHERE budget_month = '$month'";
                    $select_posts = mysqli_query($connection,$query);


                    // Tabel vullen met data
                    while($row = mysqli_fetch_assoc($select_posts)) {
                        $budget_id = $row['budget_id'];
                        $budget_month = $row['budget_month'];
                        $budget_beschrijving = $row['budget_beschrijving'];
                        $budget_bedrag = $row['budget_bedrag'];
                        $budget_wat = $row['budget_wat'];

                        // Geef uitgaven een rode kleur
                        if($budget_wat == "Uitgaven") {
                            echo "<tr>";
                            echo "<td class='td-red'>$budget_month</td>";
                            echo "<td class='td-red'>$budget_wat</td>";
                            echo "<td class='td-red'>$budget_beschrijving</td>";
                            echo "<td class='td-red'>$budget_bedrag</td>";
                            echo "</tr>";
                        }
                        // Geef inkomsten een groene kleur
                        else if ($budget_wat == "Inkomen") {
                            echo "<tr>";
                            echo "<td class='td-green'>$budget_month</td>";
                            echo "<td class='td-green'>$budget_wat</td>";
                            echo "<td class='td-green'>$budget_beschrijving</td>";
                            echo "<td class='td-green'>$budget_bedrag</td>";
                            echo "</tr>";
                        }
                    }





                        // INKOMSTEN

                        // Hieronder geef je aan wat er weergegeven moet worden
                        // Dit is synchroom aan wat er in de database staat
                        $what = "Inkomen";

                        // Query
                        $query_income = "SELECT * FROM budget WHERE budget_wat = '$what' AND budget_month = '$month'";
                        $query = mysqli_query($connection, $query_income);

                        // Alle waardes worden in een array gestopt
                        while ($row = mysqli_fetch_assoc($query)) {
                            $value_inkom[] = $row['budget_bedrag'];;
                        }

                        // Alle waardes in de array worden bij elkaar opgeteld
                        $value_inkomen = array_sum($value_inkom);


                        // UITGAVEN!!!

                        // Hieronder geef je aan wat er weergegeven moet worden
                        // Dit is synchroom aan wat er in de database staat
                        $what = "Uitgaven";

                        // Query
                        $query_income = "SELECT * FROM budget WHERE budget_wat = '$what' AND budget_month = '$month'";
                        $query = mysqli_query($connection, $query_income);

                        // Alle waardes worden in een array gestopt
                        while ($row = mysqli_fetch_assoc($query)) {
                            $value_uitgav[] = $row['budget_bedrag'];;
                        }

                        // Alle waardes in de array worden bij elkaar opgeteld
                        $value_uitgaven = array_sum($value_uitgav);

                        echo "<div class='middle'>";
                        echo "<p>Eindbudget = </p>";
                        echo "<br>";
                        echo $value_inkomen - $value_uitgaven;
                        echo "</div><br><br>";



                }


                ?>


                </tbody>
            </table><br><br>

            <div class="middle">
                <a href="index.php"><button>Ga terug</button></a>
            </div>



        <script src="budget.js"></script>
    </body>
</html>
