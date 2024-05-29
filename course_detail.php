<?php include 'inc/header.php'; ?>
<?php
try {
    $conn = new PDO("sqlite:" . __DIR__ . "/kampung_inggris.db");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $conn->prepare("SELECT * FROM courses WHERE id = :id");
    $stmt->execute([':id' => $course_id]);
    $course = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($course) {
        echo "<section class='course-detail'>";
        echo "<div class='container'>";
        echo "<img src='" . htmlspecialchars($course['image']) . "' alt='" . htmlspecialchars($course['name']) . "' class='course-image'>";
        echo "<h1>" . htmlspecialchars($course['name']) . "</h1>";
        echo "<p>" . htmlspecialchars($course['description']) . "</p>";
        echo "<p>" . htmlspecialchars($course['description_details']) . "</p>";
        echo "<p>Alamat: " . htmlspecialchars($course['address']) . "</p>";
        echo "<p>Harga per pertemuan: Rp" . number_format($course['price'], 0, ',', '.') . "</p>";
        echo "<p>Rating: " . htmlspecialchars($course['rating']) . "</p>";
        echo "<p>Jarak: " . htmlspecialchars($course['distance']) . " km</p>";
        echo "<p>" . htmlspecialchars($course['book']) . "</p>";
        echo "<a href='contact.php?action=add&id=" . htmlspecialchars($course['id']) . "' class='btn'>Tambahkan ke Bookmark</a>";
        echo "</div>";
        echo "</section>";
    } else {
        echo "<p>Course not found.</p>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<?php include 'inc/footer.php'; ?>
