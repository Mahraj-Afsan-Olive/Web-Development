<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHARMA CARE</title>

    <link rel="stylesheet" href="Index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<header>

    <div class="header">
        <a onclick="location.href='index.php'" class="logo">PHARMA CARE</a>
        <div class="header-right">
            <input style="font-size: 24px;"  type="text" placeholder="Search.." name="search">
            <button style="font-size: 24px;" type="submit"><i class="fa fa-search"></i></button>

            <button style="font-size:24px"><i class="fa fa-bell"></i></button>
        </div>
      </div>

</header>
<body>

    <div class="options">
        <div>
            <button onclick="location.href='my_profile.php'" class="btn-index" type="button">My Profile</button>
            <button onclick="location.href='record.php'" class="btn-index" type="button">Record</button>
        </div>
        <div>
            <button onclick="location.href='reports.php'" class="btn-index" type="button">Report</button>
            <button onclick="location.href='invoices.php'" class="btn-index" type="button">Invoices</button>
        </div>
        <div>
            <button class="btn-index" type="button">Setings</button>
            <button onclick="location.href='../Login/loginFormAccountant.php'" class="btn-index" type="button">Log Out</button>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Pharma Care. All rights reserved.</p>
        <p>Contact us: <a href="mailto:info@pharmacare.com">info@pharmacare.com</a></p>
    </footer>
    
</body>


</html>