<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Laporan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
     <?php 
     include 'home.php';
     ?>
    <div class="container">
        <!-- Form for search -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <div class="mb-3">
                <label for="searchKeyword" class="form-label">Cari Data :</label>
                <input type="text" class="form-control" id="searchKeyword" name="searchKeyword">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary"><i class="fas fa-database"></i> Tampilkan Semua Data</a>
        </form><br>
        <?php
        // Database connection
        include 'koneksi.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Constants
        $recordsPerPage = 10; // Number of records per page

        // Initialize search keyword variable
        $searchKeyword = "";

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Check if search keyword is provided
            if (!empty($_GET['searchKeyword'])) {
                $searchKeyword = $_GET['searchKeyword'];
            }
        }

        // Query to count total records
        $countSql = "SELECT COUNT(*) AS totalRecords FROM (
            SELECT
                'Upload Foto' AS Activity,
                f.judulfoto AS Item,
                f.tanggalunggah AS Activity_Date,
                u.username AS User
            FROM
                foto f
            JOIN
                user u ON f.userid = u.userid
            UNION
            SELECT
                'Edit Album' AS Activity,
                a.namaalbum AS Item,
                a.tanggaldibuat AS Activity_Date,
                u.username AS User
            FROM
                album a
            JOIN
                user u ON a.userid = u.userid
            UNION
            SELECT
                'Beri Komentar' AS Activity,
                k.isikomentar AS Item,
                k.tanggalkomentar AS Activity_Date,
                u.username AS User
            FROM
                komentarfoto k
            JOIN
                user u ON k.userid = u.userid
            UNION
            SELECT
                'Beri Like' AS Activity,
                CONCAT('Foto: ', f.judulfoto) AS Item,
                l.tanggallike AS Activity_Date,
                u.username AS User
            FROM
                likefoto l
            JOIN
                foto f ON l.fotoid = f.fotoid
            JOIN
                user u ON l.userid = u.userid
        ) AS combined";

        if (!empty($searchKeyword)) {
            $countSql .= " WHERE Item LIKE '%$searchKeyword%'";
        }

        $countResult = $conn->query($countSql);
        $rowCount = $countResult->fetch_assoc()['totalRecords'];
        $totalPages = ceil($rowCount / $recordsPerPage);

        // Check current page
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $currentPage = intval($_GET['page']);
        } else {
            $currentPage = 1;
        }

        // Calculate offset for pagination
        $offset = ($currentPage - 1) * $recordsPerPage;

        // Query to retrieve user activities with pagination and search
        $sql = "
            SELECT *
            FROM (
                SELECT
                    'Upload Foto' AS Activity,
                    f.judulfoto AS Item,
                    f.tanggalunggah AS Activity_Date,
                    u.username AS User
                FROM
                    foto f
                JOIN
                    user u ON f.userid = u.userid
                UNION
                SELECT
                    'Edit Album' AS Activity,
                    a.namaalbum AS Item,
                    a.tanggaldibuat AS Activity_Date,
                    u.username AS User
                FROM
                    album a
                JOIN
                    user u ON a.userid = u.userid
                UNION
                SELECT
                    'Beri Komentar' AS Activity,
                    k.isikomentar AS Item,
                    k.tanggalkomentar AS Activity_Date,
                    u.username AS User
                FROM
                    komentarfoto k
                JOIN
                    user u ON k.userid = u.userid
                UNION
                SELECT
                    'Beri Like' AS Activity,
                    CONCAT('Foto: ', f.judulfoto) AS Item,
                    l.tanggallike AS Activity_Date,
                    u.username AS User
                FROM
                    likefoto l
                JOIN
                    foto f ON l.fotoid = f.fotoid
                JOIN
                    user u ON l.userid = u.userid
            ) AS combined
        ";

        if (!empty($searchKeyword)) {
            $sql .= " WHERE Item LIKE '%$searchKeyword%'";
        }

        $sql .= " ORDER BY Activity_Date DESC LIMIT $offset, $recordsPerPage";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='table-dark'><tr><th>User</th><th>Activity</th><th>Item</th><th>Date</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["User"] . "</td><td>" . $row["Activity"] . "</td><td>" . $row["Item"] . "</td><td>" . $row["Activity_Date"] . "</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";

            // Pagination links
            echo "<div class='d-flex justify-content-center'>";
            echo "<ul class='pagination'>";
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li class='page-item'><a class='page-link' href='laporan.php?page=$i'>$i</a></li>";
            }
            echo "</ul>";
            echo "</div>";
        } else {
            echo "No activities found";
        }

        $conn->close();
        ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    include 'footer.php'; // Include footer
    ?>
</body>
</html>
