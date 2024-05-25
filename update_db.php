<?php
try {
    $conn = new PDO("sqlite:" . __DIR__ . "/../kampung_inggris.db");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tambah kolom harga dan gambar di tabel courses
    $sql = "
        ALTER TABLE courses ADD COLUMN price REAL;
        ALTER TABLE courses ADD COLUMN image TEXT;
    ";
    $conn->exec($sql);

    // Update data dengan harga dan gambar
    $sql = "
        UPDATE courses SET
        price = CASE
            WHEN name = 'English First' THEN 500000
            WHEN name = 'Briton International English School' THEN 600000
            WHEN name = 'Kampung Inggris LC' THEN 400000
            WHEN name = 'Mr. Bob' THEN 550000
            WHEN name = 'The Daffodils' THEN 450000
        END,
        image = CASE
            WHEN name = 'English First' THEN 'assets/images/english_first.jpg'
            WHEN name = 'Briton International English School' THEN 'assets/images/briton.jpg'
            WHEN name = 'Kampung Inggris LC' THEN 'assets/images/kampung_inggris_lc.jpg'
            WHEN name = 'Mr. Bob' THEN 'assets/images/mr_bob.jpg'
            WHEN name = 'The Daffodils' THEN 'assets/images/the_daffodils.jpg'
        END;
    ";
    $conn->exec($sql);

    // Buat tabel bookmarks
    $sql = "
        CREATE TABLE IF NOT EXISTS bookmarks (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            course_id INTEGER NOT NULL,
            FOREIGN KEY (course_id) REFERENCES courses(id)
        );
    ";
    $conn->exec($sql);

    echo "Database updated successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
