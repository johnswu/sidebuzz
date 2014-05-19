<?php
if($result)
{
$_SESSION['userSession']=$result;
$home=$base_url.'ssw/index.php';
echo "<script>window.location.href='".$home."'</script>";
//header("Location:$home");
}
?>