<?php

/*Загрузка нескольких файлов на сервер (обязательно проверять на тип и размер)*/

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $cnt = count($_FILES['pictures']['type']);

    for($i=0; $i<$cnt; ++$i)
    {
        if($_FILES['pictures']['error'][$i] === 0)
        {
            if($_FILES['pictures']['size'][$i] < 1024000)
            {
                if(    $_FILES['pictures']['type'][$i] == 'image/jpeg'
                    || $_FILES['pictures']['type'][$i] == 'image/png')
                {
                    $name = md5(time().$_FILES['pictures']['tmp_name'][$i]);
                    $ext = pathinfo($_FILES['pictures']['name'][$i], PATHINFO_EXTENSION);

                    if (move_uploaded_file($_FILES['pictures']['tmp_name'][$i], "img/$name.$ext"))
                    {
                        echo 'Файл успешно загружен: '.$_FILES['pictures']['name'][$i].'<br>';
                    }else
                    {
                        echo 'Файл не был загружен: '.$_FILES['pictures']['name'][$i].'<br>';
                    }
                }
                else
                {
                    echo 'Ошибка! Файл: '.$_FILES['pictures']['name'][$i]. 'не является ни PNG ни JPG изображением<br>';
                }
            }else
            {
                echo 'Ошибка! Файл '.$_FILES['pictures']['name'][$i]. ' больше чем 1 мб<br>';
            }
        }else
        {
            echo 'Ошибка с файлом: '.$_FILES['pictures']['name'][$i].'<br>';
        }
    }

}
else
{
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="upload.php" method="post"
      enctype="multipart/form-data"> <!-- атрибут, необходимый при загрузке файлов -->
    <p><input type="file" name="pictures[]" multiple accept="image/*"></p>
    <p><input type="submit" value="Отправить"></p>
</form>

</body>
</html>
<?php } ?>