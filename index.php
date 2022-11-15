
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>chatai</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css?h=f1a8fe9e98944b9d682ec5c3efac8f17">
</head>

<body>
    <div class="container pt-4">
        <div class="row justify-content-center align-items-center mt-4">
            <div class="col-md-9 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Chat AI</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Engine: <code>text-davinci-002</code></p>
                        <div class="row">
                            <div id="chats" class="col-lg-12"
                                style="min-height: 20rem;max-height: 30rem;overflow: hidden;overflow-y: scroll;">

                                <?php foreach (json_decode(file_get_contents('prompts.json'), true) as $prompt): ?>
                                <div class="card mt-2 chat">
                                    <p class="text-light text-bg-secondary rounded-top" style="padding: 7px;">
                                        <?= $prompt['name'] ?>
                                    </p>
                                    <p class="ms-1">
                                        <?= $prompt['text'] ?>
                                    </p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="col p-0 mt-3">
                                <textarea id="message" class="form-control form-control"
                                    placeholder="Type your message..."></textarea><button id="message_button"
                                    class="btn btn-primary mt-3" type="button">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/bootstrap/js/bootstrap.min.js?h=01bb7ae0c0b11509558f2aa83f244399"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        /**
         * If form id message send button clicked then send POST request to index.php
         */

        $('#message_button').click(function () {
            // prevent default form submit
            event.preventDefault();

            // get form data
            var text = $('#message').val();
            $.post('./core.php', {
                text: text,
            }).done(function (response) {
                console.log(response);
                /**
                 * Duplicate card and change text
                 */
                var card = $('.chat').first().clone();
                card.find('p').last().text(text);
                card.find('p').first().text('Human');
                card.appendTo('#chats');

                // scroll to bottom
                $('#chats').scrollTop($('#chats')[0].scrollHeight);


                var card_bot = $('.chat').first().clone();
                card_bot.find('p').last().text(response);
                card_bot.find('p').first().text('IhsanDevsBot');
                card_bot.appendTo('#chats');

                // scroll to bottom
                $('#chats').scrollTop($('#chats')[0].scrollHeight);
            });
        });
    </script>
</body>

</html>