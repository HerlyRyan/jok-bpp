<?php
if (isset($_SESSION['status']) != "login") {
  header("location:../..");
}   