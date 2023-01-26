<?php
include 'dbconnect.php';

if(isset($_POST['submit'])){
  $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
  $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
  $number = mysqli_real_escape_string($conn,$_POST['contact']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $country = mysqli_real_escape_string($conn,$_POST['country']);
  $city = mysqli_real_escape_string($conn,$_POST['city']);

$query = "INSERT INTO addressbook(firstname,lastname,contact,email,country,city) VALUES('$firstname','$lastname','$number','$email','$country','$city')";

if(mysqli_query($conn,$query)){
  header('Location:address.php');

}
else {
  echo "Error".mysqli_error($conn);
}
}

//get all contact list
//query
$query = 'select *from addressbook';
//get result
$result = mysqli_query($conn,$query);
//get allpost in array
$contacts = mysqli_fetch_all($result,MYSQLI_ASSOC);

//delete the contact details here
if(isset($_POST['delete'])){
  $id = $_POST['id'];
  $query = "delete from addressbook where id=$id";

  if(mysqli_query($conn,$query)){
    echo "<script>window.alert('Deleted!');</script>";
    header('Location:address.php');

  }
  else {
    echo "<script>window.alert('Failed To Delete!');</script>";
  }
}

$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

 ?>
<html>
  <head>
    <script src="js/jquery-1.11.2.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <title>My Address book</title>
  </head>
  <body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
 echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
  
 echo "Cookie '" . $cookie_name . "' is set!<br>";
 echo "Value is: " . $_COOKIE[$cookie_name];
}
?>



    <div class="container text-center col-lg-12">
      <h2>My Address Book</h2>
        <div class="col-lg-12 text-center">
          <h3>Add a new Address List</h3>
          <form method="post">
            <div class="form-group">
              <label for="new-first-name">Enter First name</label>
              <input type="text" name="firstname" class="form-control" id="new-first-name" required> 
            </div>
            <div class="form-group">
              <label for="new-last-name">Enter Last name</label>
              <input type="text" name="lastname" class="form-control" id="new-last-name" required>
            </div>
            <div class="form-group">
              <label for="new-address">Enter Contact</label>
              <input type="text" name="contact" class="form-control" id="new-address" required>
            </div>
            <div class="form-group">
              <label for="new-email">Enter Email</label>
              <input type="text" name="email" class="form-control" id="new-email" required>
            </div>
			<div class="form-group">
              <label for="new-first-name">Enter your Country name</label>
              <input type="text" name="country" class="form-control" id="new-country" required> 
            </div>
			<div class="form-group">
              <label for="new-first-name">Enter City name</label>
              <input type="text" name="city" class="form-control" id="new-city" required> 
            </div>

            <input type="submit" name="submit" class="btn btn-primary">
          </form>

          </div>
        </div>

          <div class="container col-lg-5 text-center" id="data-col">
          <h2>My Contacts:</h2>
          <ul class="list-group">
          </ul>
                <table class="table table-hovered">
                  <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Contact</th>
                    <th>Email</th>
					<th>Country</th>
					<th>City</th>
                    <th>Action</th>
                  </tr>
              <?php
                foreach ($contacts as $contact) {
                  ?>
                    <tr>
                      <td><?php echo $contact['firstname']; ?></td>
                      <td><?php echo $contact['lastname']; ?></td>
                      <td><?php echo $contact['contact']; ?></td>
                      <td><?php echo $contact['email']; ?></td>
          					  <td><?php echo $contact['country']; ?></td>
					            <td><?php echo $contact['city']; ?></td>
                      <td><form method="post"><input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                      <input type="submit" name="delete" value="Delete" class="btn btn-danger"></form></td>
                    </tr>
                  <?php
                }
               ?>
             </table>
        </div>
      <footer class="text-center"><p>My Address Book &copy; 2019, All RIghts Reserved</p></footer>
  </body>
</html>
