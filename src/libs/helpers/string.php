<?php 

function random_str(int $length): string {

    return substr(bin2hex(random_bytes($length)), 0, $length);

}
