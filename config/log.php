<?php
// ONLY USE FOR DEBUGGING - COMMENT OUT OTHERWISE OR YOU'LL GET "Updating failed. The response is not a valid JSON response." ERRORS IN THE EDITOR
function _log($value)
{
  echo "<script>console.log('" . json_encode($value) . "');</script>";
  // $js_code = 'console.log(' . json_encode($value, JSON_HEX_TAG) . ');';
  // if ($value) {
  //     $js_code = '<script>' . $js_code . '</script>';
  // }
  // echo $js_code;

  // echo "<script>console.log('" . $value . "');</script>";
}
?>