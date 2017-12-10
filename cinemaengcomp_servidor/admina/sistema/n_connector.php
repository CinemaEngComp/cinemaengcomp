<?

	session_start();

	require_once ("../../config/n_config.php");
	require_once "../..//config/pr_functions.php";
	require_once "../..//lib/nucci_ingresso.php";



	$dbcnx = @mysql_connect($mysql_host,$mysql_user, $mysql_senha);
	if (!$dbcnx) {
		echo( "Unable to connect to the database server at this time." );
		exit();
	}
	
	if (! @mysql_select_db($mysql_db) ) {
		echo( "Unable to locate the $mysql_db database at this time." );
		exit();
	}

	$info = array(
	   		"db_host"                => $mysql_host,
  		  	"db_user"                => $mysql_user,
    		"db_pass"                => $mysql_senha,
  		  	"db_database"            => $mysql_db,
    		"cod_usr"                => $cookie_cod_usr    );

	$nucciIngresso = new Nucci_Ingresso($info) ;

?>