<?php
try {
    $db_file = __DIR__ . '/kampung_inggris.db';
    if (file_exists($db_file)) {
        unlink($db_file);
    }

    $conn = new PDO("sqlite:" . $db_file);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buat tabel courses
    $sql = "
        CREATE TABLE IF NOT EXISTS courses (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            description TEXT,
            address TEXT,
            price REAL,
            rating REAL,
            image TEXT,
            distance INTEGER
        );
    ";
    $conn->exec($sql);

    // Masukkan data kursus
    $sql = "
    INSERT INTO courses (name, description, address, price, rating, image, distance) VALUES
    ('English First', 'Tempat les bahasa Inggris terbaik.', 'Jl. Ahmad Dahlan No. 3', 500000, 4.7, 'assets/images/english_first.jpg', 3),
    ('Briton International English School', 'Tempat les dengan metode internasional.', 'Jl. Diponegoro No. 5', 600000, 4.8, 'assets/images/briton.jpg', 5),
    ('Kampung Inggris LC', 'Les dengan suasana menyenangkan.', 'Jl. Mawar No. 2', 400000, 4.5, 'assets/images/kampung_inggris_lc.jpg', 2),
    ('Mr. Bob', 'Les dengan metode interaktif.', 'Jl. Melati No. 6', 550000, 4.6, 'assets/images/mr_bob.jpg', 6),
    ('The Daffodils', 'Les dengan suasana belajar yang nyaman.', 'Jl. Kenanga No. 4', 450000, 4.5, 'assets/images/the_daffodils.jpg', 4),
    ('ABC English Course', 'Kursus bahasa Inggris dengan metode praktis.', 'Jl. Flamboyan No. 10', 350000, 4.2, 'assets/images/abc_english.jpg', 7),
    ('XYZ Language Center', 'Tempat les dengan fasilitas modern.', 'Jl. Anggrek No. 12', 480000, 4.4, 'assets/images/xyz_language.jpg', 8),
    ('Quick English', 'Belajar bahasa Inggris cepat dan efektif.', 'Jl. Kamboja No. 9', 300000, 4.1, 'assets/images/quick_english.jpg', 1),
    ('English Academy', 'Pelatihan bahasa Inggris untuk semua usia.', 'Jl. Nusa Indah No. 15', 550000, 4.3, 'assets/images/english_academy.jpg', 9),
    ('Global English Course', 'Metode belajar yang mudah dipahami.', 'Jl. Srikandi No. 11', 400000, 4.6, 'assets/images/global_english.jpg', 10),
    ('Intensive English Program', 'Program intensif untuk hasil cepat.', 'Jl. Merak No. 7', 600000, 4.7, 'assets/images/intensive_english.jpg', 3),
    ('Proficient English Course', 'Les dengan fokus pada percakapan.', 'Jl. Cendana No. 8', 450000, 4.5, 'assets/images/proficient_english.jpg', 4),
    ('Lingua Franca Institute', 'Kursus dengan tutor berpengalaman.', 'Jl. Palem No. 6', 500000, 4.8, 'assets/images/lingua_franca.jpg', 5),
    ('Advanced English Center', 'Pusat belajar bahasa Inggris tingkat lanjut.', 'Jl. Anggrek No. 10', 520000, 4.4, 'assets/images/advanced_english.jpg', 6),
    ('Fluent English School', 'Les untuk kelancaran berbicara.', 'Jl. Kemuning No. 14', 300000, 4.2, 'assets/images/fluent_english.jpg', 2),
    ('Perfect English Institute', 'Institut untuk pembelajaran menyeluruh.', 'Jl. Melati No. 16', 470000, 4.5, 'assets/images/perfect_english.jpg', 7),
    ('Elite English Program', 'Program elite dengan hasil terbaik.', 'Jl. Jambu No. 5', 600000, 4.9, 'assets/images/elite_english.jpg', 8);
";
    $conn->exec($sql);

    echo "Database created and populated successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
