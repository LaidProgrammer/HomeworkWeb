<!DOCTYPE html>
<?php
    session_start();
    $_COOKIE["user"] = time() + random_int(0, time());
    echo $_COOKIE["user"];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
    <title>X and O</title>
</head>
<body>
    <div id="window">
        <div id="header">
            <div id="logo">
                <img src="logo.jpg" alt="lost connection" id="logo_image">
                <p id="logo_text">179 Inc</p>
            </div>
            <h1 id="title">Indefatigable school children</h1>
        </div>
        <div id="main">
            <div id="table">

            </div>
            <div id="chat">
                <label for="chat_text"></label><textarea id="chat_text" disabled>

                </textarea>
                <label for="chat_input"></label><input type="text" id="chat_input">
                <button id="chat_button">Send</button>
            </div>
            <div id="options">
                <button id="create_game_button" onclick="create_game()">create game</button><br>
                <input type="text" id="text_for_join_game">
                <button id="goin_game_button" onclick="join_game()">join</button><br>
            </div>
        </div>
    </div>
</body>
</html>