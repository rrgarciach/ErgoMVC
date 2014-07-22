<?php 
class Connection{
	private $Databasename;
	private	$Pass ;
	private $conn;

function __construct(){
	$Databasename = "db_emergencia@ol_informix1210";
	$User = "informix";
	$Pass = "informix";
	$this->conn = ifx_connect($Databasename,$User,$Pass);
	//if($conn){echo "Si existe";}
	
}
function connect()
{
	if($this->conn){
		return true;
	}
	return false;
}

function close($conn) {
        ifx_close($conn);
    }

    function conn() {
        return $this->conn;
    }

function query($query) {
        //$rid = ifx_prepare ("select * from emp where name like " . $name, $connid, IFX_SCROLL);
        //$rid = ifx_prepare ($query, $this->connR() );
	
		$select = ifx_query($query, $this->conn);
       // if (! $rid) {
       //         echo 'Could not select database';
        //    }
        //$rowcount = ifx_affected_rows($rid);
         //   if ($rowcount > 1000) {
         //       printf ("Too many rows in result set (%d)\n<br />", $rowcount);
         //       die ("Please restrict your query<br />\n");
           // }
        //if (! ifx_do ($rid)) {
                /* ... error ... */
          //  }
        $row = ifx_fetch_row ($select, "NEXT");
        $rows = array();
        while (is_array($row)) {
            array_push($rows, $row);
            $row = ifx_fetch_row($select, "NEXT");
        }
        //ifx_free_result ($rid);
        return $rows;
    }

}

?>
