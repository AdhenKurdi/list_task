<?php
require 'db_connection.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskName = $_POST['task_name'];
    $statusId = $_POST['status_id'];
    $userId = $_GET['user_id']; // Mengambil ID pengguna dari URL

    // Pastikan Anda memiliki validasi untuk memeriksa apakah $userId sesuai dengan pengguna yang sah.

    $sql = "INSERT INTO tasks (task_name, status_id, user_id) VALUES ('$taskName', $statusId, $userId)";
    if ($conn->query($sql) === TRUE) {
        header('Location: list_tasks.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<h2>Tambah Tugas Baru</h2>
<form method="POST" action="add_tasks.php?user_id=<?php echo $_GET['user_id']; ?>">
    Nama Tugas: <input type="text" name="task_name" required><br><br>
    Status Tugas:
    <select name="status_id">
        <!-- Isi opsi status dari tabel task_status -->
        <?php
        require 'db_connection.php'; // Koneksi ke database
        $statusQuery = "SELECT * FROM task_status WHERE user_id=".$_GET['user_id'];
        $statusResult = $conn->query($statusQuery);
        if ($statusResult->num_rows > 0) {
            while ($row = $statusResult->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['status_name'] . "</option>";
            }
        }
        $conn->close();
        ?>
    </select><br><br>
    <input type="submit" name="submit" value="Tambah Task">
</form>

<head> 
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    form input[type="text"],
    form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    form select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: transparent;
        background-image: url('arrow.png'); /* Ganti 'arrow.png' dengan path gambar panah dropdown yang Anda inginkan */
        background-repeat: no-repeat;
        background-position: right center;
        padding-right: 30px; /* Sesuaikan padding-right sesuai dengan lebar gambar panah */
    }

    form input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
    }

    form input[type="submit"]:hover {
        background-color: #0056b3;
    }

</style>

</head>