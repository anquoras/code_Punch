<!DOCTYPE html>
<html>

<head>
    <title>HomeWork</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>List of HomeWork</h2>
    <button><a href="../home.php"> Home</a></button>
    <button><a href="viewStudentFileUpload.php">View your submission</a></button>
       
    <table>
        <thead>
            <tr>
                <th>Challenge ID</th>
                <th>File Name</th>
                <th>Download</th>
                <th>Add Submission</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $directory = "../Student_Teacher/uploadByTeacher/"; // Specify the directory path where the files are uploaded
            // Get the list of files in the directory
            $files = scandir($directory);

            include("../Database/registerDB.php");
            // Get the list of files in the directory
            $result = mysqli_query($connect, "SELECT * FROM challenge ORDER BY challengeID ASC");

            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    echo "<tr>";
                    while ($res = mysqli_fetch_assoc($result)) {
                        echo "<td>" . $res['challengeID'] . "</td>";
                        echo "<td>" . $res['challengeName'] . "</td>";
                        echo "<td><a href='$directory$res[challengeName]' download target='_blank'>
                        Download</a></td>";
                        echo "<td><a href='studentFileUpload.php?id=$res[challengeID]' target='_blank'>Add submission</a></td>";
                        echo "</tr>";
                    }
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>