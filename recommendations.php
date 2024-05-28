<?php include 'inc/header.php'; ?>
<section class="recommendations">
    <div class="container">
        <h1>Tempat Les Bahasa Inggris di Kampung Inggris</h1>
        <form method="GET" action="">
        <input type="text" name="search" placeholder="Cari kursus...">
            <button type="button" id="filterBtn">Filter</button>
            <div id="filterOptions" style="display: none;">
                <select name="rating">
                    <option value="">Semua Rating</option>
                    <option value="4.5">4.5 ke atas</option>
                    <option value="4.0">4.0 ke atas</option>
                    <option value="3.5">3.5 ke atas</option>
                </select>
                <select name="distance">
                    <option value="">Semua Jarak</option>
                    <option value="5">Jarak 5 ke bawah</option>
                    <option value="10">Jarak 10 ke bawah</option>
                </select>
                <select name="price">
                    <option value="">Semua Harga</option>
                    <option value="500000">Rp500.000 ke bawah</option>
                    <option value="1000000">Rp1.000.000 ke bawah</option>
                </select>
            </div>
            <button type="submit">Cari</button>
        </form>
        <div class="course-list">
            <?php
            try {
                $conn = new PDO("sqlite:" . __DIR__ . "/kampung_inggris.db");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM courses WHERE 1=1";
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $sql .= " AND name LIKE :search";
                }
                if (isset($_GET['rating']) && !empty($_GET['rating'])) {
                    $sql .= " AND rating >= :rating";
                }
                if (isset($_GET['distance']) && !empty($_GET['distance'])) {
                    $sql .= " AND distance <= :distance";
                }
                if (isset($_GET['price']) && !empty($_GET['price'])) {
                    $sql .= " AND price <= :price";
                }

                $stmt = $conn->prepare($sql);

                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $stmt->bindValue(':search', '%' . $_GET['search'] . '%');
                }
                if (isset($_GET['rating']) && !empty($_GET['rating'])) {
                    $stmt->bindValue(':rating', $_GET['rating']);
                }
                if (isset($_GET['distance']) && !empty($_GET['distance'])) {
                    $stmt->bindValue(':distance', $_GET['distance']);
                }
                if (isset($_GET['price']) && !empty($_GET['price'])) {
                    $stmt->bindValue(':price', $_GET['price']);
                }

                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='course'>";
                    echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                    echo "<p>Alamat: " . htmlspecialchars($row['address']) . "</p>";
                    echo "<p>Harga per pertemuan: Rp" . number_format($row['price'], 0, ',', '.') . "</p>";
                    echo "<p>Rating: " . htmlspecialchars($row['rating']) . "</p>";
                    echo "<p>Jarak: " . htmlspecialchars($row['distance']) . " km</p>";
                    echo "<a href='course_detail.php?id=" . htmlspecialchars($row['id']) . "' class='btn'>Lihat Detail</a>";
                    echo "</div>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
            ?>
        </div>
    </div>
</section>

<script>
    document.getElementById('filterBtn').addEventListener('click', function() {
        var filterOptions = document.getElementById('filterOptions');
        if (filterOptions.style.display === 'none') {
            filterOptions.style.display = 'block';
        } else {
            filterOptions.style.display = 'none';
        }
    });
</script>

<?php include 'inc/footer.php'; ?>
