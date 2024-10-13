<?php require_once 'template.php'; ?>

<?php
// error messages  sticky form fields
$errors = array();
$name = $email = $instrument = $activity = $urban_area = '';
$animals = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process 
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $instrument = $_POST['instrument'];
    $activity = $_POST['activity'];
    $urban_area = $_POST['urban_area'];
    $animals = $_POST['animal'] ?? array();

    // Validate 
    if (empty($name)) {
        $errors['name'] = 'Please enter your name.';
    } else {
        $name = ucwords(strtolower($name));
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    if (!isset($_POST['instrument'])) {
        $errors['instrument'] = 'Please select a favorite musical instrument.';
    }

    if (count($animals) != 2) {
        $errors['animal'] = 'Please select exactly 2 favorite animals.';
    } elseif (count(array_unique($animals)) != 2) {
        $errors['animal'] = 'Please select two different favorite animals.';
    }

if (empty($_POST['activity'])) {
    $errors['activity'] = 'Please select a favorite activity.';
}

if (empty($_POST['urban_area'])) {
    $errors['urban_area'] = 'Please select a favorite urban area.';
}
if (count($errors) == 0) {
    $url = 'results.php?';
    $url .= 'name=' . urlencode($name);
    $url .= '&email=' . urlencode($email);
    $url .= '&instrument=' . urlencode($instrument);
    $url .= '&activity=' . urlencode($activity);
    $url .= '&urban_area=' . urlencode($urban_area);
    $url .= '&animals[]=' . urlencode($animals[0]);
    $url .= '&animals[]=' . urlencode($animals[1]);

    header('Location: ' . $url);
    exit;
}
    if (empty($errors)) {
        header('Location: results.php');
        exit;
    }
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <?php if (isset($errors['name'])): ?>
            <div class="alert alert-danger"><?php echo $errors['name']; ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <?php if (isset($errors['email'])): ?>
            <div class="alert alert-danger"><?php echo $errors['email']; ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Favorite Musical Instrument:</label>
        <div>
            <input type="radio" name="instrument" value="guitar" <?php if ($instrument == 'guitar'): ?>checked<?php endif; ?>> Guitar
            <input type="radio" name="instrument" value="harmonica" <?php if ($instrument == 'harmonica'): ?>checked<?php endif; ?>> Harmonica
            <input type="radio" name="instrument" value="piano" <?php if ($instrument == 'piano'): ?>checked<?php endif; ?>> Piano
            <input type="radio" name="instrument" value="drums" <?php if ($instrument == 'drums'): ?>checked<?php endif; ?>> Drums
        </div>
        <?php if (isset($errors['instrument'])): ?>
            <div class="alert alert-danger"><?php echo $errors['instrument']; ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Favorite Animals:</label>
        <div>
            <input type="checkbox" name="animal[]" value="dogs" <?php if (in_array('dogs', $animals)): ?>checked<?php endif; ?>> Dogs
            <input type="checkbox" name="animal[]" value="cats" <?php if (in_array('cats', $animals)): ?>checked<?php endif; ?>> Cats
            <input type="checkbox" name="animal[]" value="chickens" <?php if (in_array('chickens', $animals)): ?>checked<?php endif; ?>> Chickens
            <input type="checkbox" name="animal[]" value="hamsters" <?php if (in_array('hamsters', $animals)): ?>checked<?php endif; ?>> Hamsters
        </div>
        <?php if (isset($errors['animal'])): ?>
            <div class="alert alert-danger"><?php echo $errors['animal']; ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="activity">Favorite Activity:</label>
        <select class="form-control" id="activity" name="activity">
 <option value="">Select an activity</option>
            <option value="soccer" <?php if ($activity == 'soccer'): ?>selected<?php endif; ?>> Soccer
            <option value="gaming" <?php if ($activity == 'gaming'): ?>selected<?php endif; ?>> Gaming
            <option value="cards" <?php if ($activity == 'cards'): ?>selected<?php endif; ?>> Cards
            <option value="baseball" <?php if ($activity == 'baseball'): ?>selected<?php endif; ?>> Baseball
            <option value="other" <?php if ($activity == 'other'): ?>selected<?php endif; ?>> Other
        </select>
        <?php if (isset($errors['activity'])): ?>
            <div class="alert alert-danger"><?php echo $errors['activity']; ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="urban_area">Favorite Urban Area:</label>
        <select class="form-control" id="urban_area" name="urban_area">
            <option value="">Select an urban area</option>
            <option value="Downtown Dallas" <?php if ($urban_area == 'Downtown Dallas'): ?>selected<?php endif; ?>> Downtown Dallas
            <option value="Deep Ellum" <?php if ($urban_area == 'Deep Ellum'): ?>selected<?php endif; ?>> Deep Ellum
            <option value="Uptown" <?php if ($urban_area == 'Uptown'): ?>selected<?php endif; ?>> Uptown
            <option value="Oak Lawn" <?php if ($urban_area == 'Oak Lawn'): ?>selected<?php endif; ?>> Oak Lawn
            <option value="Park Cities" <?php if ($urban_area == 'Park Cities'): ?>selected<?php endif; ?>> Park Cities
        </select>
        <?php if (isset($errors['urban_area'])): ?>
            <div class="alert alert-danger"><?php echo $errors['urban_area']; ?></div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
