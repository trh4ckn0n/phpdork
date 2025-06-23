<?php include 'load_env.php'; load_env(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>trhacknon - GPT-4 Red Team Terminal</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1 class="title">🕶️ trhacknon GPT-4 PENTEST AI</h1>
  <form method="POST" action="ask.php">
    <textarea name="prompt" placeholder="Décris ta cible, besoin, payload ou scénario..." required></textarea>
    <button type="submit">🎯 Lancer GPT-4</button>
  </form>

  <div class="shortcuts">
    <form method="POST" action="ask.php">
      <button name="prompt" value="Donne un payload XSS pour un champ HTML non filtré.">XSS</button>
      <button name="prompt" value="Méthodes pour détecter une faille LFI sur un site PHP.">LFI</button>
      <button name="prompt" value="Payload SQLi pour injection basique sur un formulaire login.">SQLi</button>
      <button name="prompt" value="Reverse Shell Bash via Netcat.">Reverse Shell</button>
      <button name="prompt" value="Scan initial à lancer sur une cible avec Nmap.">Scan Nmap</button>
    </form>
  </div>

  <?php if (isset($_GET['r'])): ?>
    <div class="response"><pre><?= htmlspecialchars($_GET['r']) ?></pre></div>
  <?php endif; ?>
</body>
</html>
