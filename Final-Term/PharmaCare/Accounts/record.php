<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECORDS</title>

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
    <main class="record">

        <section id="records">
            <h2>Pharmaceutical Records</h2>
            <table>
                <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Medicine Name</th>
                        <th>Batch Number</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Aspirin</td>
                        <td>AB1234</td>
                        <td>2026-12-31</td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Paracetamol</td>
                        <td>BC2345</td>
                        <td>2025-11-30</td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ibuprofen</td>
                        <td>CD3456</td>
                        <td>2027-05-15</td>
                        <td>Active</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Documents Section -->
        <section id="documents">
            <h2>Pharmaceutical Documents</h2>
            <ul>
                <li><a href="#">Regulatory Guidelines</a></li>
                <li><a href="#">Drug Safety Protocols</a></li>
                <li><a href="#">FDA Approvals</a></li>
                <li><a href="#">Research Reports</a></li>
                <li><a href="#">Annual Audit Reports</a></li>
            </ul>
        </section>

    </main>
    <footer>
        <p>&copy; 2025 Pharma Care. All rights reserved.</p>
        <p>Contact us: <a href="mailto:info@pharmacare.com">info@pharmacare.com</a></p>
    </footer>
    
</body>
</html>