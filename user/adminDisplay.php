<?php
include("method.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - User Info</title>
  <style>
    /* styles.css */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f9f9f9;
  color: #333;
}
.main-content {
  max-width: 1200px;
  margin: 2rem auto;
  padding: 1rem;
  background: white;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}
h2 {
  margin-bottom: 1rem;
}
table {
  width: 100%;
  border-collapse: collapse;
}
table, th, td {
  border: 1px solid #ddd;
}
th, td {
  padding: 0.75rem;
  text-align: left;
}
th {
  background-color: #f4f4f4;
}
td button {
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
}
.a1{
  text-decoration: none;
}
.edit-btn {
  background-color: #28a745;
  color: white;
}
.delete-btn {
  background-color: #dc3545;
  color: white;
}
.edit-btn:hover {
  background-color: #218838;
}
.delete-btn:hover {
  background-color: #c82333;
}
  </style>
</head>
<body>
  <main class="main-content">
    <section>
      <h1><center><b><u>User Information</u></b></center></h1>
      <table >
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $result=displayUserData();
          if ($result->num_rows > 0) 
          {
              // output data of each row
              while($row = $result->fetch_assoc())
              {
                  echo'
                  <tr>
                  <td>'.$row["reg_id"].'</td>
                  <td>'.$row["username"].'</td>
                  <td>'.$row["email"].'</td>
                  <td>'.$row["contact"].'</td>
                  <td>
                    <button class="edit-btn"><a class="a1" href="editInfo.php?reg_id='.$row["reg_id"].'">Edit</a></button>
                    <button class="delete-btn"><a onclick="delInfo('.$row["reg_id"].')">Delete</a></button>
                  </td>
                </tr>
                ';
              }
          }
             else {
            echo "0 results";
          }
        ?>  
        </tbody>
      </table>
    </section>
  </main>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
  function delInfo(reg_id)
    {  
       // alert(id)
        if( confirm("Are you sure to delete this data?"))
        {
            $.ajax({
                        url:"delInfo.php",
                        method:"get",
                        data:{"reg_id":reg_id},
                        success: function(response)
                            {
                                alert(response);
                                window.location.href = "";
                            }
                    })
        }
    }
</script>
</body>
</html>