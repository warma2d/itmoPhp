<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма регистрации</title>
    <link href="/hw/css/style.css" rel="stylesheet">
</head>
<body>
    <form action="/hw/register.php" method="post">
        <label>Почта: <input type="text" name="email"></label>
        <label>Пароль: <input type="password" name="password"></label>
        <label>Имя: <input type="text" name="firstname"></label>
        <label>Дата рождения: <input type="text" name="hbdate"></label>
        <p>Пол:</p>
        <label><input type="radio" name="sex" value="male">М</label>
        <label><input type="radio" name="sex" value="female">Ж</label>
        <select name="country">
            <option value="noselect">Выбрать страну</option>
            <option value="usa">США</option>
            <option value="de">Германия</option>
            <option value="fr">Франция</option>
            <option value="ru">Россия</option>
        </select>
        <label><input type="submit" value="Отправить запрос"></label>
    </form>
    <p id="response"></p>
    <label><input type="submit" id="sendAjaxBtn" value="Отправить AJAX запрос"></label>
</body>
<script src="/hw/js/validator.js"></script>
<script src="/hw/js/index.js"></script>
</html>
