<?php 

    include('./config/db_connect.php') ;  

    if(isset($_POST['delete'])) {
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            header("Location: index.php"); 
        } else { 
            echo 'query error' . mysqli_error( $conn );
        }    
    }

    // Check get request id param
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        // make sql
        $sql = "SELECT * FROM pizzas WHERE id = $id";

        // Get the query result
        $result = mysqli_query($conn, $sql);

        // Fetch result in query format
        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
        // print_r($pizza);
    }

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php') ?>

    <div class="container center">
        <?php if($pizza): ?>

            <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
            <p>Create by: <?php echo htmlspecialchars($pizza['email']); ?></p>
            <p><?php echo date($pizza['created_at']); ?></p>
            <h5>Ingredients:</h5>
            <p><?php echo htmlspecialchars($pizza['ingredients']) ?></p>

            <!-- DELETE FORM -->
            <form action="details.php" method="post">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
                <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
            </form>

        <?php else: ?>
            <h5>Ooops we don't have that.</h5>            
        <?php endif ?>    
    </div>

    <?php include('templates/footer.php') ?>
</html>
