<?php


require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.

use Orhanerday\OpenAi\OpenAi;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

function get_reply($text)
{
    $open_ai_key = getenv('OPEN_AI_KEY');
    $open_ai = new OpenAi($open_ai_key);

    $prompts = json_decode(file_get_contents('prompts.json'), true);

    $new_prompts = null;

    foreach ($prompts as $prompt)
    {
        $new_prompts .= $prompt['name'] . ": " . $prompt['text'] . "\n";
    }

    $new_prompts .= "Human: " . $text . "\n";

    // add new prompt to prompts.json
    $prompts[] = [
        'name' => 'Human',
        'text' => $text
    ];

    file_put_contents('prompts.json', json_encode($prompts, JSON_PRETTY_PRINT));


    $complete = $open_ai->complete([
        'engine' => 'text-davinci-002',
        'prompt' => $new_prompts,
        'temperature' => 0.9,
        'max_tokens' => 850,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
    ]);

    $complete = json_decode($complete, true);
    $response = $complete['choices'][0]['text'];
    $response = str_replace("IhsanDevsBot:", "", $response);
    $response = str_replace("Human:", "", $response);
    $response = trim($response);

    // add new prompt to prompts.json
    $prompts[] = [
        'name' => 'IhsanDevsBot',
        'text' => $response
    ];

    file_put_contents('prompts.json', json_encode($prompts, JSON_PRETTY_PRINT));

    return $response;

}

// if isset jquery POST request then return response
if (isset($_POST['text']))
{
    $reply = get_reply($_POST['text']);

    echo $reply;
}

?>