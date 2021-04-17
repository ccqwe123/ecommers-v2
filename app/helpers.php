<?php

use Carbon\Carbon;

function presentPrice($price)
{
    return number_format($price,2);
}