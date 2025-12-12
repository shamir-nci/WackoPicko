<?php 
// Direct compatibility fix
if (!function_exists('mysql_error')) {
    function mysql_error($link = null) { return "Error"; }
}
if (!function_exists('mysql_num_rows')) {
    function mysql_num_rows($result) { return 0; }
}
if (!function_exists('mysql_fetch_assoc')) {
    function mysql_fetch_assoc($result) { return false; }
}
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/website/include/mysql-compat.php');
?>

require_once("include/html_functions.php");
require_once("include/guestbook.php");

if (isset($_POST["name"]) && isset($_POST["comment"]))
{
   if ($_POST['name'] == "" || $_POST['comment'] == "")
   {
      $flash['error'] = "Must include both the name and comment field!";
   }
   else
   {
      $res = Guestbook::add_guestbook($_POST["name"], $_POST["comment"], False);
      if (!$res)
      {
	 die("Database error");
      }      
   }
}

$guestbook = Guestbook::get_all_guestbooks();
?>

<?php our_header("guestbook"); ?>

<div class="column prepend-1 span-24 first last">
<h2>Guestbook</h2>
<?php error_message(); ?>
<h4>See what people are saying about us!</h4>

<?php
   if ($guestbook)
   { 
     foreach ($guestbook as $guest)
     {
	?>
   <p class="comment"><?=h( $guest["comment"] )?></p> //Fixed Code #4
	<p> - by <?=h( $guest["name"] ) ?> </p>
	<?php
     } ?>
<?php
   }
?>




<form action="<?=h( Guestbook::$GUESTBOOK_URL )?>" method="POST">
   Name: <br>
   <input type="text" name="name" /><br>
   Comment: <br>
   <textarea id="comment-box" name="comment"></textarea> <br>
   <input type="submit" value="Submit" />
</form>


</div>
<?php
   our_footer();
?>
