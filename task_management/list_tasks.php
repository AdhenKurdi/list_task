<?php
require 'db_connection.php'; // Koneksi ke database
?>

<h2>Daftar Tugas</h2>
<table border="1">
    <tr>
        <th>Nama Task</th>
        <th>Status</th>
        <th>User</th>
    </tr>
    <?php
    $taskQuery = "SELECT tasks.task_name, task_status.status_name, users.username, users.id AS user_id
                  FROM tasks
                  INNER JOIN task_status ON tasks.status_id = task_status.id
                  INNER JOIN users ON tasks.user_id = users.id";
    $taskResult = $conn->query($taskQuery);
    if ($taskResult->num_rows > 0) {
        while ($row = $taskResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['task_name'] . "</td>";
            echo "<td>" . $row['status_name'] . "</td>";

            // Check if "user_id" exists in the row before using it
            if (isset($row['user_id'])) {
                echo "<td>" . $row['username'] . "</td>";
            } else {
                echo "<td>No User</td>";
            }
            
            echo "</tr>";
        }
    } else {
        echo "Tidak ada tugas yang ditemukan.";
    }
    $conn->close();
    ?>
</table>
<p> <button class="add-button" onclick="location.href='add_tasks.php?user_id=1'">Tambah Tugas</button> </p>

<head> 
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    h2 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .add-button {
        background-color: #008CBA;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px;
        cursor: pointer;
    }

    .add-button:hover {
        background-color: #005f7f;
    }
    </style>
</head>