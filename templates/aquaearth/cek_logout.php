<?php
  session_start();
  session_destroy();
echo "<script> alert('Terima Kasih, \nAnda telah sukses logout!'); </script>";
echo "<script>location='home'</script>";
?>
