<?php 
        //connect to database
        $conn = mysqli_connect("localhost", "Furkan", "pizzacıfurkan", "furkan_pizza");

        //checking connection
        if(!$conn){
                echo "Connection error" . mysqli_connect_error();
        }
        // write wuery for all pizzas
        $sql = "SELECT title, ingredients, id FROM pizzas ORDER BY created_at";

        // make query and get result
        $result = mysqli_query($conn, $sql);

        // fetch all pizzas as an array
        $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        // free memory and close mysql
        mysqli_free_result($result);
        mysqli_close($conn);

        //print_r(explode(',', $pizzas[0]['ingredients']));  ***************  bu kısmı sor öğren ************


?>

<!DOCTYPE html>
<html lang="en">

        <?php include("templates/header.php") ?>

        <h4 class="center grey-text">Pizzas!</h4>

	<div class="container">
		<div class="row">

			<?php foreach($pizzas as $pizza){ ?>

				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
							<ul class = "grey-text">
                                                                <?php foreach(explode("," , $pizza["ingredients"]) as $ing){ ?> 
                                                                <li> <?php echo htmlspecialchars($ing)?></li>
                                                                <?php } ?>                                                                                  
                                                        </ul>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="#">more info</a>
						</div>
					</div>
				</div>

			<?php } ?>

		</div>
	</div>
        <?php include("templates/footer.php") ?>
</html>