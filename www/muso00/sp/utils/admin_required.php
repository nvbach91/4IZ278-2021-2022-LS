<?php

require './utils/user_required.php';

if ($_SESSION['user_privilege'] < 2) {
    exit('<div class="alert alert-danger text-center" role="alert">Access denied. <a href="javascript:history.back(1);" class="stretched-link link-danger">Go back</a></div>');
}
