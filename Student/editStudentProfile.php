<?php

session_start();
include("../Check/authentication.php");
// Retrieve the selected student's information from the database
include("../Database/registerDB.php");

if (isset($_GET['id'])) {
    $id= htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
    if ($_SESSION[$_COOKIE["users"]] == "admin" || $_SESSION[$_COOKIE["users"]] == "teachers"){
        $query = "SELECT * FROM students WHERE id = ?";
    }else{
        $query = "SELECT * FROM students WHERE id = ? and username = '$_SESSION[username]'";
    }

    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, 's', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);
}

// Display the form to edit the student's information
if (isset($student)) {
?><header>
    <link rel="stylesheet" href="../CSS/default.css">
</header>
<h1>Edit Student </h1>
    <form method="POST" action="editStudentProfile.php?id=<?php echo $id; ?>">
    <label>Student's name:</label> <br>
        <input type="text" name="student_name" value="<?php echo $student['student_name']; ?>">
        <br>
        <label>Student's email:</label> <br>
        <input type="text" name="student_email" value="<?php echo $student['student_email']; ?>">
        <br>
        <label>Student's class:</label> <br>
		<input type="text" name="student_class" value="<?php echo $student['student_class']; ?>">
		<br>
        <label>Student's ID:</label> <br>
        <input type="text" name="student_ID" value="<?php echo $student['student_ID']; ?>">
        <br>
        <label>Student's phone number:</label> <br>
        <input type="text" name="phone_num" value="<?php echo $student['phone_num']; ?>">
        <br>
        <input type="submit" name="submit" value="Update">
    </form>
<?php
}else{
    header("Location: ../home.php");
}

// Handle form submission to update the student's information
if (isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, "student_name", FILTER_SANITIZE_SPECIAL_CHARS);   
    $email = filter_input(INPUT_POST, "student_email", FILTER_SANITIZE_SPECIAL_CHARS);  
	$class = filter_input(INPUT_POST, "student_class", FILTER_SANITIZE_SPECIAL_CHARS);   
	$ID = filter_input(INPUT_POST, "student_ID", FILTER_SANITIZE_SPECIAL_CHARS);   
    $phone = filter_input(INPUT_POST, "phone_num", FILTER_SANITIZE_SPECIAL_CHARS);
    $query = "UPDATE students SET student_name='$name', student_email='$email', student_class='$class', 
	student_ID='$ID' ,phone_num='$phone' WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, 's', $id);
    mysqli_stmt_execute($stmt);
    echo "Updated successfully"."<br>";
    if ($_SESSION[$_COOKIE["users"]] == "admin" || $_SESSION[$_COOKIE["users"]] == "teachers"){
    header("Location: ../studentList.php");   
    echo "<button>
	<a href='../studentList.php'>Home</a>
	</button>";
    }else{
        echo "<button>
	<a href='../home.php'>Home</a>
	</button>";
    }
    mysqli_stmt_close($stmt);
mysqli_close($connect);
}
?>