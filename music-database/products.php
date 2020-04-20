<?php
include_once('includes/header.php');
include_once('includes/shirts.php');
include_once('includes/functions.php');


if (empty($_POST)) {
    // do nothing.... display regular version of page because they haven't submitted form yet
} else if (
    !empty($_POST['shirt']) && !empty($_POST['color']) && !empty($_POST['size']) && !empty($_POST['style'])
    && !empty($_POST['first-name']) && !empty($_POST['last-name']) && !empty($_POST['address']) && !empty($_POST['city'])
    && !empty($_POST['state']) && !empty($_POST['zip']) && !empty($_POST['email']) && !empty($_POST['phone'])
) {
    // all fields have been filled out so  display confirmation
    $completedForm = true;

    $shirtImage = $_POST['shirt'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $style = $_POST['style'];
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $address = $_POST['address'];
    $addressTwo = $_POST['address-two'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
} else {
    $errors = true;
    $errArr = checkFormForEmptyFields();
    $errInfo = buildErrorInfo($errArr);
}



$states = array(
    "AK - Alaska",
    "AL - Alabama",
    "AR - Arkansas",
    "AS - American Samoa",
    "AZ - Arizona",
    "CA - California",
    "CO - Colorado",
    "CT - Connecticut",
    "DC - District of Columbia",
    "DE - Delaware",
    "FL - Florida",
    "GA - Georgia",
    "GU - Guam",
    "HI - Hawaii",
    "IA - Iowa",
    "ID - Idaho",
    "IL - Illinois",
    "IN - Indiana",
    "KS - Kansas",
    "KY - Kentucky",
    "LA - Louisiana",
    "MA - Massachusetts",
    "MD - Maryland",
    "ME - Maine",
    "MI - Michigan",
    "MN - Minnesota",
    "MO - Missouri",
    "MS - Mississippi",
    "MT - Montana",
    "NC - North Carolina",
    "ND - North Dakota",
    "NE - Nebraska",
    "NH - New Hampshire",
    "NJ - New Jersey",
    "NM - New Mexico",
    "NV - Nevada",
    "NY - New York",
    "OH - Ohio",
    "OK - Oklahoma",
    "OR - Oregon",
    "PA - Pennsylvania",
    "PR - Puerto Rico",
    "RI - Rhode Island",
    "SC - South Carolina",
    "SD - South Dakota",
    "TN - Tennessee",
    "TX - Texas",
    "UT - Utah",
    "VA - Virginia",
    "VI - Virgin Islands",
    "VT - Vermont",
    "WA - Washington",
    "WI - Wisconsin",
    "WV - West Virginia",
    "WY - Wyoming"

);

?>

<html>

<body onload="showShirtImageInConfirmation()">
    <div id="header">
        <a href="index.php">
            <p><span class="back-link">Back</span></p>
        </a>
        <h1>T-Shirts</h1>
    </div>
    <?php if ($errors == true) {
        echo '<div class="error-message">';
        echo $errInfo;
        echo '</div>';
    }
    ?>
    <div class="container">
        <?php if ($completedForm !== true) { ?>
            <div class="row t-shirt-area">
                <div class="col">
                    <!-- shirt pic column-->
                    <div id="image-area" class="card text-center" style="width: 18rem;">
                        <img id="album-image" src='img/tshirt.jpg' class='card-img-top' alt='album image'>
                    </div>
                    <div class="price text-center">
                        <p>$25.00</p>
                    </div>
                </div>
                <div class="col">
                    <!-- shirt form-->
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="shirtSelect">Select album for T-shirt</label>
                            <select class="form-control" onchange="showShirtImage()" id="shirt" name="shirt">
                                <option value="" selected disabled>Select an album</option>

                                <?php
                                foreach ($shirtArray as $shirt) {
                                    extract($shirt);
                                    echo '<option value="' . $albumName . '" ' . (($shirt == $_POST['shirt']) ? 'selected="selected"' : "") . '>' . $albumName . ' by ' . $artist . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="colorSelect">Color:</label>
                            <select class="form-control" id="color" name="color">
                                <?php
                                foreach ($shirtColor as $color) {
                                    echo '<option value="' . $color . '" ' . (($color == $_POST['color']) ? 'selected="selected"' : "") . '>' . $color . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sizeSelect">Size:</label>
                            <select class="form-control" id="size" name="size">
                                <?php
                                foreach ($shirtSize as $size) {
                                    echo '<option value="' . $size . '" ' . (($size == $_POST['size']) ? 'selected="selected"' : "") . '>' . $size . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Style:</label>
                            <select class="form-control" id="style" name="style">
                                <?php
                                foreach ($shirtStyle as $style) {
                                    echo '<option value="' . $style . '" ' . (($style == $_POST['style']) ? 'selected="selected"' : "") . '>' . $style . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                </div>

            </div><!-- end of tshirt order form-->

            <div class="customer-details-form">
                <!-- customer details part of form -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first-name">First Name:</label>
                        <input type="text" class="form-control" name="first-name" id="first-name" value="<?php echo isset($_POST['first-name']) ? ($_POST['first-name']) : ''; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last-name">Last Name:</label>
                        <input type="text" class="form-control" name="last-name" id="last-name" value="<?php echo isset($_POST['last-name']) ? ($_POST['last-name']) : ''; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?php echo isset($_POST['address']) ? ($_POST['address']) : ''; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address-two">Address 2</label>
                        <input type="text" class="form-control" id="address-two" name="address-two" placeholder="Apartment, studio, or floor" value="<?php echo isset($_POST['address-two']) ? ($_POST['address-two']) : ''; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" id="city" value="<?php echo isset($_POST['city']) ? ($_POST['city']) : ''; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="state">State</label>
                        <select id="state" class="form-control" name="state">
                            <option value="" selected disabled>Select state</option>
                            <?php foreach ($states as $state) {
                                echo '<option  value="' . $state . '" ' . (($state == $_POST['state']) ? 'selected="selected"' : "") . '> ' . $state . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name='zip' value="<?php echo isset($_POST['zip']) ? ($_POST['zip']) : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST['email']) ? ($_POST['email']) : ''; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone:</label>
                        <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="###-###-####" class="form-control" name="phone" id="phone" value="<?php echo isset($_POST['phone']) ? ($_POST['phone']) : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                </form>
            </div> <!-- end of customer detail form-->
        <?php }
        if ($completedForm == true) { ?>
            <div class="confirmation">
                <!-- confirmation area -->
                <h3>Thank you for your order <?php echo $firstName; ?>!</h3>

                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div id="image-area" class="card text-center" style="width: 18rem;">
                            <img id="shirt-image" src='img/tshirt.jpg' class='card-img-top' alt='shirt image'>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo '<p id="shirt-image-title">The ' . $shirtImage . ' Shirt</p>'; ?></h5>
                                <ul class="card-text">
                                    <li>Color: <?php echo $color; ?></li>
                                    <li>Size: <?php echo $size; ?></li>
                                    <li>Style: <?php echo $style; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end of confirmation area-->

        <?php } ?>
    </div><!-- end of container-->
</body>

</html>