<?php
	if (($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['submit']))) {

        $formerrors = '';
        $errors = 0;

        if ($_POST['firstname'] !== '') {
            $firstname = $_POST['firstname'];
        } else {
            $error_firstname = '<em id="firstname-error" class="error">Your first name is required!</em>';
            $formerrors .= '<li><a href="#firstname">Please provide a first name.</a></li>';
            $errors++;
        }

        if ($_POST['lastname'] !== '') {
            $lastname = $_POST['lastname'];
        } else {
            $error_lastname = '<em id="lastname-error" class="error">Your last name is required!</em>';
            $formerrors .= '<li><a href="#lastname">Please provide a last name.</a></li>';
            $errors++;
        }

        if ($_POST['email'] !== '') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_email = '<em id="email-error" class="error">Your email address is not a valid email address!</em>';
                $formerrors .= '<li><a href="#email">Please provide a valid email address.</a></li>';
                $errors++;
            }
        } else {
            $error_email = '<em id="email-error" class="error">Your email address is required!</em>';
            $formerrors .= '<li><a href="#email">Please provide an email address.</a></li>';
            $errors++;
        }

        if ($_POST['phone'] !== '') {
            $phone = $_POST['phone'];
        } else {
            $error_phone = '<em id="phone-error" class="error">Your phone is required!</em>';
            $formerrors .= '<li><a href="#phone">Please provide a phone number.</a></li>';
            $errors++;
        }
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forms Validation and Error Handling Testing</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <script src="JavaScript/modernizr_forms.js"></script>
    <script src="JavaScript/placeholder.js"></script>
    <style>
        span.required { font-style: italic; }
        input {
            display: block;
            font-size: 1em;
            margin: .25em 0 1em 0;
            width: 100%;
            max-width: 600px;
        }
        input#submit {
            background: #000099;
            border: 0;
            border-radius: 0.5em;
            color: #ffffff;
            max-width: 300px;
            padding: 0.75em 0.25em;
            width: 50%;
        }
        .error label span {
            color: #990000;
        }
        em.error {
            background: #990000;
            color: #ffffff;
            padding: 0.25em;
        }
    </style>
</head>
<body>
    <h1 id="site-title">Forms Validation and Error Handling Testing</h1>
    
    <form id="basicform" name="basicform" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" novalidate="novalidate">
        <div class="error-notice" id="message" <?php if($formerrors != '') { echo 'role="alert" tabindex="-1"'; } ?>>
            <?php if ($formerrors != ''): ?>
            <h2>Please correct the <?php echo $errors; ?> errors below.</h2>
            <ul>
                <?php echo $formerrors; ?>
            </ul>
            <?php endif; ?>
        </div>
                
        <div class="wrap <?php if (isset($error_firstname)) { echo 'error'; } ?>">
            <label for="firstname">
                <span>First name:</span><span aria-required="true" class="required">(required)</span>
                <?php if (isset($error_firstname)) { echo $error_firstname; } ?>
                <input type="text" id="firstname" name="firstname" aria-required="true" value="<?php if (isset($firstname)) { echo $firstname; } ?>">
            </label>
        </div>

        <div class="wrap <?php if (isset($error_lastname)) { echo 'error'; } ?>">
            <label for="lastname">
                <span>Last name:</span><span aria-required="true" class="required">(required)</span>
                <?php if (isset($error_lastname)) { echo $error_lastname; } ?>
                <input type="text" id="lastname" name="lastname" aria-required="true" value="<?php if (isset($lastname)) { echo $lastname; } ?>">
            </label>
        </div>

        <div class="wrap <?php if (isset($error_email)) { echo 'error'; } ?>">
            <label for="email">
                <span>Email:</span><span aria-required="true" class="required">(required)</span>
                <?php if (isset($error_email)) { echo $error_email; } ?>
                <input type="email" id="email" name="email" placeholder="name@domain.com" aria-required="true" value="<?php if (isset($email)) { echo $email; } ?>">
            </label>
        </div>

        <div class="wrap <?php if (isset($error_phone)) { echo 'error'; } ?>">
            <label for="phone">
                <span>Phone:</span><span aria-required="true" class="required">(required)</span>
                <?php if (isset($error_phone)) { echo $error_phone; } ?>
                <input type="tel" id="phone" name="phone" placeholder="xxx-xxx-xxxx" aria-required="true" value="<?php if (isset($phone)) { echo $phone; } ?>"><!-- working pattern: \d{3}([\-\.\s])?\d{3}([\-\.\s])?\d{4} -->
            </label>
        </div>

        <div class="wrap">
            <input type="submit" id="submit" name="submit" value="Submit">
        </div>
    </form>
    <!-- testing text after form for error alerts -->
    <p>Nullam eget suscipit lectus. Praesent vel orci a dui gravida sollicitudin. Sed interdum turpis et neque vestibulum, volutpat placerat nisl tempus. Fusce a sodales urna, sit amet posuere nisl. Quisque at placerat libero. Suspendisse potenti. Pellentesque rutrum tortor ut elit congue, nec commodo diam elementum. Cras dignissim eu ipsum eu.</p>
</body>
</html>
