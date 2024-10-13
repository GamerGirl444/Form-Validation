<?php
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$instrument = isset($_POST['instrument']) ? $_POST['instrument'] : '';
$activity = isset($_POST['activity']) ? $_POST['activity'] : '';
$urban_area = isset($_POST['urban_area']) ? $_POST['urban_area'] : '';
$animals = isset($_POST['animal']) ? (array)$_POST['animal'] : array(); // Cast to array
$name = $_GET['name'];
$email = $_GET['email'];
$instrument = $_GET['instrument'];
$activity = $_GET['activity'];
$urban_area = $_GET['urban_area'];
$animals = $_GET['animals'];
$pageTitle = 'Results';

include 'template.php'; 
?>

<div class="container">
    <div class="alert alert-success">
        <p>Congratulations, your form has been submitted successfully!</p>
	    <h2>Results</h2>

    </div>

    <div class="row">
        <div class="col-md-6">
            <ul>
                  <p>Welcome <?php echo $name; ?>!</p>
            <p>Your email is <?php echo $email; ?>.</p>
            <p>Your favorite musical instrument is <?php echo $instrument; ?>.</p>
            <p>Your favorite animals are <?php echo $animals[0]; ?> and <?php echo $animals[1]; ?>.</p>
            <p>Your favorite activity is <?php echo $activity; ?>.</p>
            </ul>
        </div>
    </div>
</div>
<pre><?php  print_r($_POST); ?></pre>
