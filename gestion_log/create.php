<?php
	if (!$_POST['login'] || !$_POST['passwd'] || $_POST['submit'] !== "OK")
	{
		echo "ERROR\n";
		return ;
	}
	if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] === "OK")
	{
		$private = '../htdocs/private/passwd';
		$passwd = hash('whirlpool', $_POST['passwd'], FALSE);
		if (file_exists($private))
		{
			$file = unserialize(file_get_contents($private));
			foreach ($file as $user)
			{
				foreach ($user as $key => $value)
				{
					if ($key === 'login' && $value === $_POST['login'])
					{
						echo "ERROR\n";
						return ;
					}
				}
			}
		}
		else
		{
			if (!file_exists('../htdocs/private'))
				mkdir('../htdocs/private', 0777, TRUE);
		}
		$file[] = [
			'login'		=>	$_POST['login'],
			'passwd'	=>	$passwd,
		];
		if (file_put_contents($private, serialize($file)) === FALSE)
		{
			echo "ERROR\n";
			return ;
		}
		session_start();
		$_SESSION['login'] = $_POST['login'];
		header('Location: ../index.php');
	}
?>
