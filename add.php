<?php 
       include("config/db_connect.php");

       $email = $title = $ingredients = "";
        $errors = array('email' => '', 'title' => '', 'ingredients' => '');
    if(isset($_POST["submit"])){

        
        //email check        
        if(empty($_POST["email"])){
            $errors["email"] = "An email is required <br/>";
        }else{
            $email = $_POST["email"];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors["email"] = "Email must be valid email address";
            }            
        }
        // title check    
        if(empty($_POST["title"])){
            $errors["title"] = "A title is required <br/>";
        }else{
            $title = $_POST["title"];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors["title"] = 'Enter valid title(it should include letter and space)';
            }
            
        }
        // ingredients check
        if(empty($_POST['ingredients'])){
			$errors['ingredients'] = 'At least one ingredient is required';
		} else{
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Ingredients must be a comma separated list';
			}
		}

        if(array_filter($errors)){
			//echo 'errors in form';
		} else {
            // htmlspecialchar gibi datayı temizleyim veriyor. ( override var)
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
			$title = mysqli_real_escape_string($conn, $_POST["title"]);
            $ingredients = mysqli_real_escape_string($conn, $_POST["ingredients"]);

            // create sql
            $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')"; 
            if(mysqli_query($conn, $sql)){
                // success - form is valid
			    header('Location: index.php');
            }else{
                echo "query error" . mysqli_error($conn);
            }

            
		}
    }
    
// fff

?>


<!DOCTYPE html>
<html>
    <?php include("templates/header.php"); ?>
    <section class="container grey-text">
		<h4 class="center">Add a Pizza</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="red-text"> <?php echo $errors["email"]; ?></div>
			<label>Pizza Title</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
            <div class="red-text"> <?php echo $errors["title"]; ?></div>
			<label>Ingredients (comma separated)</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
            <div class="red-text"> <?php echo $errors["ingredients"]; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

    <?php include("templates/footer.php"); ?>
</html>