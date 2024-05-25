<?php include 'inc/header.php'; ?>
<section class="bookmarks">
    <div class="container">
        <h1>Bookmark</h1>
        <div class="course-list">
            <?php
            try {
                $conn = new PDO("sqlite:" . __DIR__ . "/kampung_inggris.db");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
                    $course_id = intval($_GET['id']);
                    $stmt = $conn->prepare("INSERT INTO bookmarks (course_id) VALUES (:course_id)");
                    $stmt->execute([':course_id' => $course_id]);
                }

                $stmt = $conn->query("SELECT courses.* FROM courses JOIN bookmarks ON courses.id = bookmarks.course_id");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='course'>";
                    echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                    echo "<p>Alamat: " . htmlspecialchars($row['address']) . "</p>";
                    echo "<p>Harga per pertemuan: Rp" . number_format($row['price'], 0, ',', '.') . "</p>";
                    echo "<p>Rating: " . htmlspecialchars($row['rating']) . "</p>";
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
<?php include 'inc/footer.php'; ?>
