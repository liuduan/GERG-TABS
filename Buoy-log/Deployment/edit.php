<?php 
// Guinasso, circa 2011
// Based on http://lpmj.net Example 10-8 http://lpmj.net/10.php
//
//  require_once 'cas.php';
//  getCAS(); 
  

  $db_server = mysql_connect("localhost","tabs","tabsuser") or die(mysql_error());
  
  
  mysql_select_db("tabs_status") or die("Unable to select database: " . mysql_error());
	$qu='"';


    echo "--abuoy from file--$abuoy <br>";

####################################################################### 1
	if(isset($_POST['abuoy']));
	{
	
	$abuoy = get_post('abuoy'); 
    $zz=strlen($abuoy);    
     echo "<br>after post buoy is $abuoy $zz<br>";
	 if($zz < 1) {$abuoy="R"; }
	 echo "after post buoy is $abuoy<br>";
   }

####################################################################### 2
if (isset($_POST['delete']) && isset($_POST['File_Number'])){
	$File_Number  = get_post('File_Number');
	$query = "DELETE FROM deployment_table2 where File_Number='$File_Number'";

	if (!mysql_query($query, $db_server))	
		echo "DELETE failed: $query<br />" .
		mysql_error() . "<br /><br />";
	}
$now1=date("Y-m-d H:i:s");

####################################################################### 3
if (isset($_POST['File_Number'])) 
{
// If File_Number is set update that record 
	
	$File_Number =		 get_post('File_Number');        $abuoy  =get_post('fbuoy');
	$depltime  = get_post('depltime'); $rectime =get_post('rectime');
	$comment  =  get_post('comment');

	$bl=" "; 
	$File_Number1=0;                       # no File_Number so enter new record
	if(strlen($File_Number) == 0) $File_Number1=1;  # File_Number so update record
	

	print  "len of File_Number,abuoy,depltime,rectime,comment: ".strlen($File_Number).$bl.strlen($abuoy).$bl.strlen($depltime).$bl;
	print  strlen($rectime).$bl.strlen($comment)."<br>".$File_Number1." File_Number1<br>";
    print "here";
	
	if($File_Number1 == 0) 
	{                    // if record File_Number is there update any field that is filled in
	if(strlen($depltime)>0) {$query="UPDATE deployment_talbe2 set depltime=".$qu.$depltime.$qu." where File_Number=".$File_Number;
	print $query."\n";   $result = mysql_query($query);	print   $result."<br>";}
	if(strlen($rectime)>0) {$query="UPDATE deployment_talbe2  set rectime=".$qu.$rectime.$qu." where File_Number=".$File_Number;
	print $query."<br>"; $result = mysql_query($query); print  $result."<br>";}
	if(strlen($comment)>0) {$query="UPDATE deployment_talbe2  set comment=".$qu.$comment.$qu." where File_Number=".$File_Number;
	print $query."<br>"; $result = mysql_query($query); print  $result."<br>";}
	}
// File_Number defined end 
    $zz=strlen($abuoy); 
	if($File_Number1 and ($zz ==0)) {echo "<br>INSERT FAILED -- ENTER BUOY NAME fbuoy $fbuoy abuoy $abuoy<br>";}
	if($File_Number1 && $zz>0)  {

	 print $File_Number1." adding a record to the data base ";
	 
$query= "INSERT into deployment_talbe2 (site,depltime,rectime,comment) VALUES ($qu$abuoy$qu,$qu$depltime$qu,$qu$rectime$qu,$qu$comment$qu)";
	print "<br>Here is the query: ".$query."<br>"; 
$result = mysql_query($query);	print "result:".$result."<br>";} } 







	
    print "<title>TABS Deployment Database</title><br>";
	
	echo "Hello, world.";
     
	echo <<<_END
		
 <h3>TABS Deployment Database </h3><br /><hr>
 <a href="https://cas_server/cas/logout">cas logout</a>
 <p>First Select Site to use<br>
 <p>To add a new record, leave File_Number blank fill out the whole form<br>
 To modify an existing record, enter File_Number and at least one other field<br>
 Then click ADD RECORD<hr>


<form action="edit.php" method="post"><pre> 
 Select Site<select name="abuoy" size="1">
 <option value="B">B</option>
 <option value="D">D</option>
 <option value="F">F</option>
 <option value="H">H</option>
 <option value="J">J</option>
 <option value="K">K</option>
 <option value="N">N</option>
 <option value="R">R</option>
 <option value="V">V</option>
 <option value="W">W</option>
 <option value="R001">R001</option>
 <option value="R002">R002</option>
 <option value="R003">R003</option>
</select> <input type="submit" value="Select Site"    />
</table></pre></form>

<table>
 <form action="edit.php" method="post"><pre><table>
 <tr>
 <td>File_Number</td><td>			<input type="text" name="File_Number"    /></td>
 <td>Checkout</td><td>     			<input type="text" name="checkout"/></td>
 <td>site</td><td>					<input type="text" name="site" /></td></tr>
 
 <tr>
 <td>Seapac SN</td><td> 			<input type="text" name="Seapac_SN" /></td>
 <td>Current Sensor SN</td><td>  	<input type="text" name="Current_Sensor_SN" /></td>
 <td>Current Sensor Model</td><td>	<input type="text" name="Current_Sensor_model"    /></td></tr>
 <td>Modem Type</td><td>     		<input type="text" name="Modem_Type"/></td></tr>
 <tr> <td> &nbsp;</td>  </tr>

 <tr>
 <td>Deployment Ship</td><td> 		<input type="text" name="Deployment_Ship" /></td>
 <td>Deployment time</td><td> 		<input type="text" name="Dep_time" /></td>
 <td>Recovery time</td><td>  		<input type="text" name="Recovery_time" /></td>
 <td>Recovery Ship</td><td>     	<input type="text" name="Recovery_Ship"/></td></tr>
 
 <tr>
 <td>Deployment Days</td><td> 		<input type="text" name="Deployment_days" /></td>
 <td>Site Inclination</td><td> 		<input type="text" name="inclination" /></td></tr>
 <tr><td>Comments</td><td>  		 	<input type="text" name="Comments" /></td></tr></table>
 
 <tr><td></td><td><input type="submit" value="ADD RECORD"    /></td></tr>
</pre></form>

<hr>
_END;

$az=$abuoy." value of abuoy<br />";
echo "BUOY ".$az."<br>".$fbuoy."<br>";

$q1 = "SELECT * FROM deployment_table2 where site = ";
$q2= $qu.$abuoy.$qu." AND dep_time > ";
$q3= $qu."2010-01-01".$qu." order by File_Number desc";
$query=$q1.$q2.$q3;

echo '<br>$query = '. $query. '<br>';

$result = mysql_query($query);
if (!$result) die ("Database access failed: " . mysql_error());
$rows = mysql_num_rows($result);
echo $rows.' rows '. $row[1].'<br>';
echo "<table border='1'>";
echo "<tr BGCOLOR='#99CCFF'>
		<th>File_Number</th><th>Checkout</th><th>Site</th><th>Seapac SN</th><th>Current Sensor SN</th><th>Current Sensor Model</th>
		<th>Modem Type</th><th>Deployment Ship</th><th>Deployment Time</th><th>Recovery Time</th><th>Recovery Ship</th>
		<th>Days Deployed</th><th>inclination</th><th>Comment</th><th>-</th>";

for ($j = 0 ; $j < $rows ; ++$j){
	$row = mysql_fetch_row($result);
	echo <<<_END
		<tr>
			<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td>
			<td>$row[6]</td><td>$row[7]</td><td>$row[8]</td><td>$row[9]</td><td>$row[10]</td>
			<td>$row[11]</td><td>$row[12]</td><td>$row[13]</td><td>$row[14]</td>
		<td style="vertical-align:middle"><form action="edit.php" method="post">
		<input type="hidden" name="delete" value="yes" />
		<input type="hidden" name="id" value="$row[0]" />
		<input type="submit" value="DELETE RECORD" /></form></td></tr>
_END;
	}
echo "</table>";

mysql_close($db_server);

function get_post($var)
{  
	return mysql_real_escape_string($_POST[$var]);
}
?>
