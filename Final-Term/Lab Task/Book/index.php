<!DOCTYPE html>
<html>

<head>
    <title>Borrow Book Anytime!</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <img src="ID.PNG" alt="sorry" class="center">
    <h1>Book Borrowing Management</h1>

    <div class="container">
        <div class="left">
            <div class="leftbox">
                <div class="box6">
                <img src="left.PNG" alt="sorry" class="center" style="width: 160px; height: 640px;">
                </div>
            </div>
        </div>
        <div class="middle">
            <div class="first">
                <!-- Add Book Feature -->
                <div class="box1">
                    <h4>Add Book</h4>
                    <form action="add_book.php" method="post" class="center">
                        <label for="new_book">Book Name:</label><br>
                        <input type="text" id="new_book" name="new_book" placeholder="Enter Book Name" required><br><br>
                        <input type="submit" value="Add Book">
                    </form>
                </div>
                <div class="box1">
    <h4>Used Tokens</h4>
    <div class="center">
        <?php
        // Read the token.json file
        $json = file_get_contents('token.json');
        $data = json_decode($json, true);

        // Check if tokens are present
        if (isset($data['tokens']) && is_array($data['tokens'])) {
            // Filter the used tokens
            $used_tokens = array_filter($data['tokens'], function($token) {
                return $token['used']; // Only include tokens marked as used
            });

            // Display the used tokens
            if (count($used_tokens) > 0) {
                foreach ($used_tokens as $token_data) {
                    echo "<p>Used Token: " . htmlspecialchars($token_data['token']) . "</p>";
                }
            } else {
                echo "<p>No tokens have been used yet.</p>";
            }
        } else {
            echo "<p>No token data available.</p>";
        }
        ?>
    </div>
</div>

            </div>
            <div class="second">
                <div class="box2"><img id="cover1" alt="Book Cover 1" style="width: 160px; height: 150px;"></div>
                <div class="box2"><img id="cover2" alt="Book Cover 2" style="width: 160px; height: 150px;"></div>
                <div class="box2"><img id="cover3" alt="Book Cover 3" style="width: 160px; height: 150px;"></div>
            </div>
            <div class="third">
                <div class="box3">
                <h4>Search Books</h4>
                <input type="text" id="search_query" placeholder="Enter book title" class="sbar">
                <button id="search_button" class="sbutton">Search</button>
                <div id="search_results"></div>
                </div>
            </div>
            <div class="fourth">
                <div class="box4">
                    <h4>Borrow Form</h4>
                    <!-- Display errors -->
                    <?php
                    if (!empty($_GET['errors'])) {
                        $errors = explode('|', $_GET['errors']);
                        foreach ($errors as $error) {
                            echo "<p style='color:red;'>$error</p>";
                        }
                    }
                    ?>
                    
                    <form action="process.php" method="post" class="center">
                        <input type="text" id="name" name="name" placeholder="Enter your Name" required><br>
                        <input type="text" id="idnum" name="idnum" placeholder="Student ID" required><br>
                        <input type="email" id="mail" name="mail" placeholder="Student e-mail" required><br>
                        <label for="book">Choose a Book Title:</label><br>
                        <select name="book" id="book" required>
                            <option value="select">Select</option>
                        </select><br><br>
                        <label for="borrow_date">Borrow Date:</label>
                        <input type="date" id="borrow_date" name="borrow_date" required><br>
                        <label for="return_date">Return Date:</label>
                        <input type="date" id="return_date" name="return_date" required><br>
                        <label for="token">Token Number:</label>
                        <input type="number" id="token" name="token"><br>
                        <label for="fees">Fees:</label>
                        <input type="number" id="fees" name="fees" required><br><br>
                        <input type="submit" value="Submit">
                    </form>
                </div>
                <div class="box5">
    <h4>Tokens</h4>
    <h4>Available</h4>
    <div class="center">
        <?php
        
        $json = file_get_contents('token.json');
        $data = json_decode($json, true);

        
        if (isset($data['tokens']) && is_array($data['tokens'])) {
            $unused_tokens = array_filter($data['tokens'], function($token) {
                return !$token['used']; 
            });

            if (count($unused_tokens) > 0) {
                foreach ($unused_tokens as $token_data) {
                    echo "<p>" . htmlspecialchars($token_data['token']) . "</p>";
                }
            } else {
                echo "<p>No tokens available</p>";
            }
        } else {
            echo "<p>No tokens available</p>";
        }
        ?>
    </div>
</div>

            </div>
        </div>
        <div class="right">
            <div class="rightbox">
                <div class="box7">
                <img src="right.PNG" alt="sorry" class="center" style="width: 160px; height: 640px;">
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fetch random covers
        fetch('covers.json')
            .then(response => response.json())
            .then(data => {
                const covers = data.covers.sort(() => 0.5 - Math.random()).slice(0, 3);
                document.getElementById("cover1").src = covers[0];
                document.getElementById("cover2").src = covers[1];
                document.getElementById("cover3").src = covers[2];
            });

        // Fetch books dynamically for the select dropdown
        fetch('fetch_books.php')
            .then(response => response.json())
            .then(data => {
                const bookSelect = document.getElementById('book');
                data.forEach(book => {
                    const option = document.createElement('option');
                    option.value = book.name;
                    option.textContent = book.name;
                    bookSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching book data:', error));
 
            
            // Add search functionality
            document.getElementById("search_button").addEventListener("click", function () {
            const query = document.getElementById("search_query").value;

            if (!query) {
                document.getElementById("search_results").innerHTML = "<p style='color: red;'>Please enter a search term.</p>";
                return;
            }

            fetch(`search_books.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    const resultsDiv = document.getElementById("search_results");
                    resultsDiv.innerHTML = "";

                    if (data.found) {
                        resultsDiv.innerHTML = `<p style='color: green;'>Found: ${data.book_name}</p>`;
                    } else {
                        resultsDiv.innerHTML = "<p style='color: red;'>Not Found</p>";
                    }
                })
                .catch(error => {
                    console.error("Error fetching search results:", error);
                    document.getElementById("search_results").innerHTML = "<p style='color: red;'>An error occurred. Please try again later.</p>";
                });
        });
    </script>

</body>

</html>