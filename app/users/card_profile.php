<?php
include_once '../config/database.php';

$query = "SELECT * FROM  user_profile";

$keyword=$_GET["username"];

if(isSet($keyword))

    $query=$query."WHERE user_profile LIKE '%".$keyword."%'";
    $result= $pdo->query($query);
    print"<table>\n";
    print"<tr>\n";
    print"<th>Name</th><th>Email</th><th>Telephone</th><th>Company</th><th>Role title</th><th>Role Description</th>
<th>LinkedIn</th><th>Twitter</th><th>Facebook</th><th>Instagram</th>";
    print"</tr>\n";

if($result->rowCount()==0)
  {echo "<p>No data retrieved. <\p>\n";}
else{
    foreach($result as $row)
    {print "<tr>\n";
    print "<td>".$row["firstname"]." ".$row["lastname"]."</td>\n";
    print "<td>".$row["email"]."</td>\n";
    print "<td>".$row["telephone"]."</td>\n";
    print "<td>".$row["company"]."</td>\n";
    print "<td>".$row["jobtitle"]."</td>\n";
    print "<td>".$row["job_desc"]."</td>\n";
    print "<td>".$row["linkedin"]."</td>\n";
    print "<td>".$row["instagram"]."</td>\n";
    print "<td>".$row["twitter"]."</td>\n";
    print "<td>".$row["facebook"]."</td>\n";


    }
print"</table>\n";

}
$pdo=null;
?>