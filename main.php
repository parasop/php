<?php
include 'db.php';

// Add new employee
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO employees (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update employee details
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE employees SET name='$name', email='$email' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete employee
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM employees WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Management</title>
</head>
<body>
    <h2>Employee Management</h2>

    <form method="post" action="">
        <input type="hidden" name="id" id="id">
        <label>Name:</label>
        <input type="text" name="name" id="name" required>
        <label>Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit" name="add">Add Employee</button>
        <button type="submit" name="update">Update Employee</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM employees";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>
                    <a href='index.php?edit=" . $row['id'] . "'>Edit</a>
                    <a href='index.php?delete=" . $row['id'] . "'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php
    // If edit button is clicked, get the details of the employee
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM employees WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo "<script>
                document.getElementById('id').value = '" . $row['id'] . "';
                document.getElementById('name').value = '" . $row['name'] . "';
                document.getElementById('email').value = '" . $row['email'] . "';
              </script>";
    }
    ?>
</body>
</html>
