<?php

session_start();
unset($_SESSION["cart"]);
echo "
<script type='text/javascript'>
    alert('Yay! anda berhasil menghapus');
    window.location = 'cart.php';
</script>
";

?>