<?php


$goods = [
    [
        'id'=>1,
        'title'=>'Piano',
        'price'=>2345
    ],
    [
        'id'=>2,
        'title'=>'Guitar',
        'price'=>1753
    ],
    [
        'id'=>3,
        'title'=>'Drum',
        'price'=>1224
    ],
];


// TODO: получить товар из массива $goods по id, сохранить в переменную $good
$id = (int) $_GET['id'] ?? 0;

foreach($goods as $item)
{
    if($item['id'] == $id)
    {
        $good = $item;
    }
}



$isAuth = false; // флаг - авторизован пользователь или нет

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<section>
<!--    TODO: вывести информацию о товаре $good-->
<?php if($good): ?>
    <p>ID: <?php echo $good['id']; ?></p>
    <p>Заголовок: <?php echo $good['title']; ?></p>
    <p>Цена: <?php echo $good['price']; ?></p>
<?php else:?>
    <p>Товар не найден!</p>
<?php endif;?>
</section>


<!--    TODO: если пользователь авторизован $isAuth - отобразить блок для добавления комментариев, в противном случае, сообщить, что ему нужно авторизоваться-->
<?php if($isAuth === true): ?>
    <textarea></textarea><br>
    <input type="submit" value="Добавить комментарий">
<?php else:?>
    <p>Для добавления комментариев вам следует авторизоваться</p>
<?php endif;?>

</body>
</html>
