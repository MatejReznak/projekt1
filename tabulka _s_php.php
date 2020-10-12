<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reznak";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(!empty($_GET))
{
    $where=" WHERE rozvrh.trieda='".$_GET["trieda"]."'";
}
else
{
    $where="";
}
$sql = "SELECT * FROM rozvrh".$where;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $rozvrh[$row["den"]][$row["hodina"]]=$row["predmet"];
    }
} else {
    echo "0 results";
}
//$conn->close();
?>
</hr>
<?php
$hodiny=array(0,1,2,3,4,5);
$dni=array("pondelok", "utorok", "streda", "štvrtok", "piatok");
?>
<table border = 1>
    <tr>
        <td>&nbsp;</td>
            <?php foreach($hodiny As $hodina):?>
                 <td><?php echo $hodina;?></td>
            <?php endforeach;?>
    </tr>
    <?php foreach($dni As $i=>$den):?>
    <tr>
        <td><?php echo $den;?></td>
            <?php foreach($hodiny As $j=>$hodina):?>
                <td><?php echo @$rozvrh[$i][$j];?></td>
        <?php endforeach;?>
    </tr>
<?php endforeach;?>



</table>
<?php
$sql="SELECT trieda
        From rozvrh
        GROUP BY trieda ORDER BY trieda";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result))
{
    echo "<a href=tabulka_s_php.php?trieda=".$row["trieda"].">".$row["trieda"]."</a>
    <br/>";
}