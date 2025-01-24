<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $id = trim($_POST["idnum"]);
    $email = trim($_POST["mail"]);
    $book = trim($_POST["book"]);
    $borrow_date = $_POST["borrow_date"];
    $return_date = $_POST["return_date"];
    $token = trim($_POST["token"]);
    $fees = trim($_POST["fees"]);

    $errors = [];

    // Validate inputs
    if (empty($name) || !preg_match("/^[a-zA-Z. ]+$/", $name)) {
        $errors[] = "Name can only contain letters and dots.";
    }

    if (empty($id) || !preg_match("/^\\d{2}-\\d{5}-\\d$/", $id)) {
        $errors[] = "ID must follow the format XX-XXXXX-X.";
    }

    if (empty($email) || !preg_match("/^{$id}@student\\.aiub\\.edu$/", $email)) {
        $errors[] = "Email must follow the format Student ID@student.aiub.edu.";
    }

    if (empty($book) || $book === "select") {
        $errors[] = "You must select a book title.";
    }

    // Check if the book is already borrowed (using cookies or tokens)
    $book_cookie = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower($book)); 

    // If the book has already been borrowed by someone else (via cookies)
    if (isset($_COOKIE[$book_cookie])) {
        $errors[] = "The book '$book' is currently borrowed by " . htmlspecialchars($_COOKIE[$book_cookie]) . ". Please wait until it is returned.";
    }

    if (empty($borrow_date) || empty($return_date)) {
        $errors[] = "Borrow and Return dates are required.";
    } else {
        $borrow_time = strtotime($borrow_date);
        $return_time = strtotime($return_date);
        $difference_in_days = ($return_time - $borrow_time) / (60 * 60 * 24);

        if ($difference_in_days <= 0) {
            $errors[] = "Return date must be later than borrow date.";
        }
        if ($difference_in_days > 10) {
            
            if (empty($token)) {
                $errors[] = "For borrowing more than 10 days, a valid token is required.";
            } else {
              
                $json = file_get_contents('token.json');
                $data = json_decode($json, true);

                $token_valid = false;
                $book_available = true;

                // Check if the token is valid and not used
                foreach ($data['tokens'] as &$token_data) {
                    if ($token_data['token'] === $token) {
                        if ($token_data['used']) {
                            $errors[] = "The token '$token' has already been used. Please use another token.";
                        } else {
                            // Check if the book is already borrowed by another user
                            if (!empty($token_data['book']) && $token_data['book'] === $book && $token_data['used']) {
                                $book_available = false;
                                $errors[] = "The book '$book' is already borrowed and cannot be taken.";
                            } else {
                                // Valid token: Do not mark it as used yet, we will do that after the validation
                                $token_valid = true;
                            }
                        }
                        break;
                    }
                }

                if (!$token_valid) {
                    $errors[] = "Invalid token provided. Please enter a valid token.";
                }

                if (!$book_available) {
                    $errors[] = "This book is already borrowed. Please wait until it's returned.";
                }

            }
        }
    }

    if (empty($fees) || !is_numeric($fees)) {
        $errors[] = "Fees must be a valid number.";
    }

    if (!empty($errors)) {
        // Return the user to the form with error messages
        $error_string = implode('|', $errors);
        header("Location: index.php?errors=$error_string");
        exit;
    }

    // If there are no errors, proceed with the successful borrowing process
    // Mark token as used now, since all validation passed
    $json = file_get_contents('token.json');
    $data = json_decode($json, true);

    foreach ($data['tokens'] as &$token_data) {
        if ($token_data['token'] === $token) {
            // Mark the token as used and associate it with the book
            $token_data['used'] = true;
            $token_data['book'] = $book;
            $token_data['borrowed_by'] = $name;  // Optionally track who borrowed it
            break;
        }
    }

    // Save updated token.json data
    file_put_contents('token.json', json_encode($data, JSON_PRETTY_PRINT));

    // Store session variables for the receipt page
    $_SESSION["name"] = $name;
    $_SESSION["idnum"] = $id;
    $_SESSION["email"] = $email;
    $_SESSION["book"] = $book;
    $_SESSION["borrow_date"] = $borrow_date;
    $_SESSION["return_date"] = $return_date;
    $_SESSION["token"] = $token;
    $_SESSION["fees"] = $fees;

    // Set a cookie to track the book borrowed
    setcookie($book_cookie, $name, time() + (10 * 24 * 60 * 60), '/');

    // Redirect to the receipt page
    header("Location: receipt.php");
    exit;
}
