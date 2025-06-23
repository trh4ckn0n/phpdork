<?php
include 'load_env.php';
load_env();

$prompt = $_POST['prompt'] ?? '';
$key = getenv('OPENAI_API_KEY');

$system_prompt = <<<EOT
Tu es un expert en pentesting, red teaming, bug bounty, hacking éthique.
Tu donnes des exemples pratiques, scripts shell/python/bash, payloads offensifs.
Réponds comme un hacker professionnel, avec un ton direct et concis.
EOT;

$data = [
  "model" => "gpt-4",
  "messages" => [
    ["role" => "system", "content" => $system_prompt],
    ["role" => "user", "content" => $prompt]
  ]
];

$ch = curl_init("https://api.openai.com/v1/chat/completions");
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "Authorization: Bearer $key"
  ],
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);
curl_close($ch);

$decoded = json_decode($response, true);
$reply = $decoded["choices"][0]["message"]["content"] ?? "Erreur de réponse GPT.";

// Sauvegarde de l'historique
$history = [];
if (file_exists("history.json")) {
    $history = json_decode(file_get_contents("history.json"), true) ?? [];
}
$history[] = [
    "prompt" => $prompt,
    "response" => $reply,
    "timestamp" => date("Y-m-d H:i:s")
];
file_put_contents("history.json", json_encode($history, JSON_PRETTY_PRINT));

header("Location: index.php?r=" . urlencode($reply));
exit;
