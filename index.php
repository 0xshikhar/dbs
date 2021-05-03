<!DOCTYPE HTML>
<html>
    <head>
      <title>DAC</title>
         <style>
         </style>
     </head>


    <body>
       <form action="dac.php" method="post">
             <label>ENTER THE PATH:</label><br>
             <input type="text" name="a1">
             <input type="submit" value="SUBMIT">
       </form><br>
    
    
         <?php

          $x=$_POST['acs.php'];

          chdir($x);

          //$list_files = shell_exec('ls -l');

          $list_files=shell_exec('ls | head -n 10000');

          $perms= shell_exec("ls -l | cut -d ' ' -f 1");
          $arra=explode("\n",$list_files);

         ?>

         <table id="t1">
         <tr>
             <th rowspan="2">FILE NAME</th>
             <th colspan="3">OWNER</th>
             <th rowspan="2">CHANGE OWNER PERMISSION</th> 
             <th colspan="3">GROUP</th>
             <th colspan="3">UNIVERSAL</th>  
         </tr>   
         <tr id="tr1">
             <td>READ(r)</td>
             <td>WRITE(w)</td>
             <td>EXECUTE(x)</td>
             <td>READ(r)</td>
             <td>WRITE(w)</td>
             <td>EXECUTE(x)</td>
             <td>READ(r)</td>
             <td>WRITE(w)</td>
             <td>EXECUTE(x)</td>
         </tr>  

         <?php
         $len=strlen($perms);
         $j=0;
         for($i=6;$i<$len;$i++)
         {
          echo "<tr><td>".$arra[$j++]."</td><td>".$perms[$i+1]."</td><td>".$perms[$i+2]."</td><td>".$perms[$i+3]."</td>
                <td>
                <select>
                <option selected>select</option>
                <option>--x</option>
                <option>r--</option>
                <option>-w-</option>
                <option>rw-</option>
                <option>-wx</option>
                <option>rwx</option>
                <option>r-x</option>
                </select>
                </td>
                    <td>".$perms[$i+4]."</td><td>".$perms[$i+5]."</td><td>".$perms[$i+6]."</td>
                    <td>".$perms[$i+7]."</td><td>".$perms[$i+8]."</td><td>".$perms[$i+9]."</td></tr>";
          $i=$i+10;
         }
         ?>

      </table>
 
    </body>
</html>





