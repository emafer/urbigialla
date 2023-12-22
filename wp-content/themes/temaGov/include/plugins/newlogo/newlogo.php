<?php
global $madisoftTheme;
madisoft_get_theme_class()->addGlobalVar('lastaccessClass', time()-600);

if (isset($_COOKIE['lastaccess'])) {
   global $madisoftTheme;
    if (time() < ($_COOKIE['lastaccess'] + 86400)) {
        madisoft_get_theme_class()->addGlobalVar('lastaccessClass',  $_COOKIE['lastaccess']);
        setCookieLastAccess();
        }

} else {
    setCookieLastAccess();
}
function setCookieLastAccess()
{
    $cookie_name = "lastaccess";
    $cookie_value = time() - 600;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/",
        "",
        true,
        true
    );
}