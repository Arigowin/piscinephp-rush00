<?php
function  auth($login, $passwd)
{
  if (isset($login) && isset($passwd))
  {
    $file = unserialize(file_get_contents("../htdocs/private/passwd"));
    $passwd = hash('whirlpool', $passwd);
    foreach ($file as $value)
    {
      if ($value['login'] === $login && $value['passwd'] === $passwd)
        return (TRUE);
    }
  }
  return (FALSE);
}
?>
