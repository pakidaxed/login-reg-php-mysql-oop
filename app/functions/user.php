<?php

function is_logged_in()
{
    if (!isset($_SESSION['email'])) {
        return false;
    }

    return true;
}

