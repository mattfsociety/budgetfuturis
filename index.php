<?php include  "dbh.php"; ?>
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


    <?php
        $month = "Juni";
    ?>


        <div class="top">
            <div class="budget">
                <div class="budget__title">
                    Beschikbaar Budget in <span class="budget__title--month"><?php echo $month ?></span>:
                </div>
                
                <div class="budget__income clearfix">
                    <div class="budget__income--text">Inkomen</div>
                    <div class="right">
                        <div class="budget__income--value">
                            <?php

                            // Hieronder geef je aan wat er weergegeven moet worden
                            // Dit is synchroom aan wat er in de database staat
                            $what = "Inkomen";

                            // Query
                            $query_income = "SELECT * FROM budget WHERE budget_wat = '$what' AND budget_month = '$month'";
                            $query = mysqli_query($connection, $query_income);

                            // Alle waardes worden in een array gestopt
                            while($row = mysqli_fetch_assoc($query)) {
                                $value_inkom[] = $row['budget_bedrag'];;
                            }

                            // Alle waardes in de array worden bij elkaar opgeteld
                            $value_inkomen = array_sum($value_inkom);

                            echo $value_inkomen;

                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="budget__expenses clearfix">
                    <div class="budget__expenses--text">Uitgaven</div>
                    <div class="right clearfix">
                        <div class="budget__expenses--value">
                            <?php

                            // Hieronder geef je aan wat er weergegeven moet worden
                            // Dit is synchroom aan wat er in de database staat
                            $what = "Uitgaven";

                            // Query
                            $query_income = "SELECT * FROM budget WHERE budget_wat = '$what' AND budget_month = '$month'";
                            $query = mysqli_query($connection, $query_income);

                            // Alle waardes worden in een array gestopt
                            while($row = mysqli_fetch_assoc($query)) {
                                $value_uitgav[] = $row['budget_bedrag'];;
                            }

                            // Alle waardes in de array worden bij elkaar opgeteld
                            $value_uitgaven = array_sum($value_uitgav);

                            echo $value_uitgaven;

                            ?>
                        </div>
                    </div>
                </div>


                <div class="budget__value">
                    <?php

                    // Berekening van het beschikbare budget
                    echo $value_inkomen - $value_uitgaven;

                    ?>
                </div>
            </div>
        </div>
        
        
        
        <div class="bottom">
            <div class="add">
                <div class="add__container">
                    <form id="formpje" action="" method="post" enctype="multipart/form-data">
                    <select class="add__type" name="TheWhat">
                        <option value="Inkomen" selected>Inkomen</option>
                        <option value="Uitgaven">Uitgaven</option>
                    </select>
                    <input name="TheDescription" type="text" class="add__description" placeholder="Voeg iets toe">
                    <input name="TheValue" type="number" class="add__value" placeholder="Waarde">
                   <button class="add__btn" name="sendValue" onclick=""><i class="ion-ios-checkmark-outline"></i></button>
                    </form>
                </div>
            </div>

            <?php

                if(isset($_POST['sendValue'])) {

                    $the_what = $_POST['TheWhat'];
                    $the_value = $_POST['TheValue'];
                    $the_description = $_POST['TheDescription'];

                    // Query
                    $query = "INSERT INTO budget(budget_month, budget_wat, budget_beschrijving, budget_bedrag) VALUE('{$month}', '{$the_what}', '{$the_description}', '{$the_value}')";
                    $insert_into_db = mysqli_query($connection, $query);

                    if(!$insert_into_db) {
                        die('QUERY FAILED'. mysqli_error($connection));
                    }

                    // Redirect zodat resultaat zichtbaar is
                    header("Location: http://i362437.hera.fhict.nl/Budget2/index.php");

                }

            ?>

                <table class="double">
                    <thead>
                        <tr>
                            <th>Inkomen</th>
                            <th> € </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                            // Hieronder geef je aan wat er weergegeven moet worden
                            // Dit is synchroom aan wat er in de database staat
                            $wat = "Inkomen";

                            // Query
                            $query = "SELECT * FROM budget WHERE budget_month = '$month' AND budget_wat = '$wat'";
                            $select_posts = mysqli_query($connection,$query);

                            // Tabel vullen
                            while($row = mysqli_fetch_assoc($select_posts)) {
                                $budget_id = $row['budget_id'];
                                $budget_beschrijving = $row['budget_beschrijving'];
                                $budget_bedrag = $row['budget_bedrag'];
                                $budget_wat = $row['budget_wat'];

                                echo "<tr>";
                                echo "<td>$budget_beschrijving</td>";
                                echo "<td>$budget_bedrag</td>";
                                echo "</tr>";

                            }

                        ?>
                    </tbody>
                </table>

                <table class="double">
                    <thead>
                    <tr>
                        <th>Uitgaven</th>
                        <th> € </th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                        // Hieronder geef je aan wat er weergegeven moet worden
                        // Dit is synchroom aan wat er in de database staat
                        $wat = "Uitgaven";

                        // Query
                        $query = "SELECT * FROM budget WHERE budget_month = '$month' AND budget_wat = '$wat'";
                        $select_posts = mysqli_query($connection,$query);

                        // Tabel vullen
                        while($row = mysqli_fetch_assoc($select_posts)) {
                            $budget_id = $row['budget_id'];
                            $budget_beschrijving = $row['budget_beschrijving'];
                            $budget_bedrag = $row['budget_bedrag'];
                            $budget_wat = $row['budget_wat'];

                            echo "<tr>";
                            echo "<td>$budget_beschrijving</td>";
                            echo "<td>$budget_bedrag</td>";
                            echo "</tr>";

                        }
                    ?>
                    </tbody>
                </table>
            <br><br>


            </div>

        <div class="middle">
            <a href="history.php"><button>Bekijk geschiedenis</button></a>
        </div>
    </body>
</html>
