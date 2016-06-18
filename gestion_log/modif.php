<?php
	$private = '../htdocs/private/passwd';
	if ($_POST['login'] && $_POST['newpw'] && $_POST['oldpw'] && $_POST['submit'] === "OK")
	{
		if (file_exists($private))
		{
			$file = unserialize(file_get_contents($private));
			if ($file)
			{
				for ($i = 0; $file[$i]; $i++)
				{
					if ($file[$i]['login'] === $_POST['login'])
					{
						if ($file[$i]['passwd'] === hash('whirlpool', $_POST['oldpw']))
						{
							$file[$i]['passwd'] = hash('whirlpool', $_POST['newpw']);
							if (file_put_contents($private, serialize($file)) !== FALSE)
							{
								echo "OK\n";
								return ;
							}
						}
					}
				}
			}
		}
	}
	echo "ERROR\n";
	return ;
?>
