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
        
        
        
        <div class="bottom">

            <select class="add__type">
<?php
                $query = "SELECT * FROM budget GROUP BY budget_month";
                $select_month = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_month)) {
                $month = $row['budget_month'];

                echo "<option value='month'>$month</option>";

                }
?>
            </select>



            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Maand</th>
                        <th>Wat?</th>
                        <th>Beschrijvingf</th>
                        <th>Bedrag</th>
                    </tr>
                </thead>

                <tbody>

                <?php

                $query = "SELECT * FROM budget";
                $select_posts = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($select_posts)) {
                    $budget_id = $row['budget_id'];
                    $budget_month = $row['budget_month'];
                    $budget_beschrijving = $row['budget_beschrijving'];
                    $budget_bedrag = $row['budget_bedrag'];
                    $budget_wat = $row['budget_wat'];

                    echo "<tr>";
                    echo "<td>$budget_month</td>";
                    echo "<td>$budget_wat</td>";
                    echo "<td>$budget_beschrijving</td>";
                    echo "<td>$budget_bedrag</td>";
                    echo "</tr>";
                }

                ?>


                </tbody>
            </table>
            
            <a href="./index.html"><button>Ga terug</button></a>

        </div>
        
        <script src="budget.js"></script>
    </body>
</html>
