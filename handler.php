<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Отримуємо дані з форми
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // Замініть це значення на токен вашого бота
    $telegramBotToken = '5134471146:AAGm9SHWhEKhj7XI2U9WLksQK6I0Pi4loJI';

    // Замініть це значення на ідентифікатор вашої телеграм-групи
    $telegramGroupId = '-4091831699'; // Знак "-" перед числовим значенням є важливим

    // Формуємо повідомлення для відправки в групу
    $message = "Нове замовлення:\nІм'я: $name\nТелефон: $phone";

    // Викликаємо функцію відправки повідомлення в телеграм
    sendTelegramMessage($telegramBotToken, $telegramGroupId, $message);

    // Відповідь для клієнта
    $responseMessage = "Дякуємо за ваше замовлення. Очікуйте, менеджер зв'яжеться з вами.";
    echo $responseMessage;
} else {
    http_response_code(400);
    echo "Помилка: невірний метод запиту.";
}

// Функція для відправлення повідомлення в телеграм
function sendTelegramMessage($token, $chatId, $message) {
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $params = [
        'chat_id' => $chatId,
        'text' => $message,
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>
