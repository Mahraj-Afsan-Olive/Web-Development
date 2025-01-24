<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICES</title>

    <link rel="stylesheet" href="Index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
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

    <main>
        <section id="invoices">
            <h2>Company Invoices</h2>
            <table>
                <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Client Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>INV001</td>
                        <td>John Doe</td>
                        <td>$5000</td>
                        <td>2024-12-20</td>
                        <td>Paid</td>
                    </tr>
                    <tr>
                        <td>INV002</td>
                        <td>Jane Smith</td>
                        <td>$3000</td>
                        <td>2024-11-15</td>
                        <td>Pending</td>
                    </tr>
                    <tr>
                        <td>INV003</td>
                        <td>Acme Pharmaceuticals</td>
                        <td>$8000</td>
                        <td>2024-10-10</td>
                        <td>Paid</td>
                    </tr>
                    <tr>
                        <td>INV004</td>
                        <td>Global Med</td>
                        <td>$4500</td>
                        <td>2024-09-25</td>
                        <td>Pending</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
   
    <footer>
        <p>&copy; 2025 Pharma Care. All rights reserved.</p>
        <p>Contact us: <a href="mailto:info@pharmacare.com">info@pharmacare.com</a></p>
    </footer>
</body>
</html>