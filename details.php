<?php 

    include("config/db_connect.php");

    if(isset($_GET["id"])) {
        $id = mysqli_real_escape_string($conn , $_GET["id"]);

        //create query
        $sql = "SELECT * FROM pizzas WHERE id = $id";

        //get the result
        $result = mysqli_query($conn, $sql);
        
        // fetch it
        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html>
    <?php include("templates/header.php"); ?>
        <div class = "container center">
            <?php if($pizza) :?> 
            
                <h4><?php echo htmlspecialchars($pizza["title"]) ?></h4>
                <p><strong>Created By:</strong> <?php echo htmlspecialchars($pizza["email"])?></p>
                <p><strong>Created At:</strong> <?php echo htmlspecialchars($pizza["created_at"])?></p>
                <h5> Ingredients:</h5>
                <p> <?php echo htmlspecialchars($pizza["ingredients"])?></p>
            
            <?php else : ?>
                <h5> No such like pizza !!</h5>
            <?php endif ?>


        </div>
    <?php include("templates/footer.php"); ?>
</html>