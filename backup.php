<?php include 'db_connect.php' ?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row" style="margin-top:40px; margin-left: 5px;">
        <button type="button" id="export_database" class="btn btn-primary">Export Database</button>
		</div>
</div>
</div>

<script>
	$('#export_database').click(function(){
        var product = '1';
        $.ajax({
				url:'ajax.php?action=backup_data',
				method:'POST',
				data:{id:product},
				success:function(resp){
					resp = JSON.parse(resp).toString();
					if(resp.filename != ''){
                        alert_toast("Backup Success",'success')
					}else{
						alert_toast("Backup Error",'danger')
					}
				}
			})
	})
</script>

<?php

//MySQL server and database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'sales_inventory_db';
$tables = '*';

// 'localhost','root','','sales_inventory_db'

//Call the core function
// backup_tables($dbhost, $dbuser, $dbpass, $dbname, $tables);

//Core function
function backup_tables($host, $user, $pass, $dbname, $tables = '*') {
    $link = mysqli_connect($host,$user,$pass, $dbname);

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    mysqli_query($link, "SET NAMES 'utf8'");

    //get all of the tables
    if($tables == '*')
    {
        $tables = array();
        $result = mysqli_query($link, 'SHOW TABLES');
        while($row = mysqli_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    $return = '';
    //cycle through
    foreach($tables as $table)
    {
        $result = mysqli_query($link, 'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $num_rows = mysqli_num_rows($result);

        $return.= 'DROP TABLE IF EXISTS '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        $counter = 1;

        //Over tables
        for ($i = 0; $i < $num_fields; $i++) 
        {   //Over rows
            while($row = mysqli_fetch_row($result))
            {   
                if($counter == 1){
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                } else{
                    $return.= '(';
                }

                //Over fields
                for($j=0; $j<$num_fields; $j++) 
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }

                if($num_rows == $counter){
                    $return.= ");\n";
                } else{
                    $return.= "),\n";
                }
                ++$counter;
            }
        }
        $return.="\n\n\n";
    }

    //save file
    // $fileName = 'TT-db'.time().'-'.(md5(implode(',',$tables))).'.sql';
    $fileName = 'ZTT-db-'.time().'.sql';
    $handle = fopen($fileName,'w+');
    fwrite($handle,$return);
    if(fclose($handle)){ ?>
        <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card mt-5">
              <div class="card-header" style="background-color: white; text-align:center; color:black;">
                <h5>Done, the file <?php echo $fileName;  ?> was Backup Successfully</h5>
              </div>
              </div>
              </div>
              </div>
              </div>
              <?php 
        exit; 
    }
}
?>
