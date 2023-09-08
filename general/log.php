<?php
function _log($output)
{
  echo '<script>console.log("_ ", ' . json_encode($output) . ')</script>';
}
?>