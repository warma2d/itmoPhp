<?php

/*Удаление каталога.
Написать рекурсивную функцию
удаления непустого каталога*/

function dirIsEmpty($dir) {
    $h = opendir($dir);
    while (false !== ($item = readdir($h))) {
        if ($item != "." && $item != "..") {
            closedir($h);
            return false;
        }
    }
    closedir($h);
    return true;
}

function removeDir($path)
{
    if(is_dir($path))
    {
        if($h = opendir($path))
        {
            while (false !== ($item = readdir($h)))
            {
                if($item == '.' || $item == '..') continue;
                if (is_dir($path.DIRECTORY_SEPARATOR.$item))
                {
                    removeDir($path.DIRECTORY_SEPARATOR.$item);
                }
                else
                {
                    unlink($path.DIRECTORY_SEPARATOR.$item);
                    echo 'Удалили файл: ' .$path.DIRECTORY_SEPARATOR.$item.'<br>';
                }
            }
            if(dirIsEmpty($path))
            {
                rmdir($path);
                echo 'Удалили директорию: ' .$path.'<br>';
            }
        }
    }
}

//removeDir(getcwd().DIRECTORY_SEPARATOR.'folder');

/* Сокращатель ссылок (используем функции)
пользователь вводит в форму ссылку (используйте input type="url")
вы получаете ее валидируете и обрабатываете: проверка на пустоту,
filter_var - FILTER_VALIDATE_URL trim, если все хорошо:
проверяете присутствует ли в файле ссылка, которую вводил пользователь,
если есть, то получаете короткую ссылку и выводите на экран если нет,
создаете хеш определенной длины (алгоритм придумать самостоятельно)
если созданный хеш уже есть в файле, то создаете новый до тех пор,
пока хеш не станет уникальным записать хеш в файл
информация будет храниться в файле следующим образом:
длинная ссылка:короткая ссылка:время, когда ссылка устареет
При таком варианте, если время жизни закончилось, то нужно проверять его и, если нужно, перегенерировать ссылку
*/

define('FILE', getcwd().DIRECTORY_SEPARATOR.'urls.txt') ;
define('DELIMITER', ':');
define('DOMAIN', $_SERVER['HTTP_HOST'].'/');

function getShortUrlByUrl($url)
{
    if(! file_exists(FILE))
    {
        touch(FILE);
    }

    $h = fopen(FILE,'r+');
    while (($str = fgets($h)) !== false)
    {
        $arr = explode(DELIMITER, $str);
        $longUrl = $arr[0];
        $shortUrl= $arr[1];
        $expire = $arr[2];

        if($longUrl == $url)
        {
            fclose($h);
            if(time() > $expire)
            {
                deleteByUrl($url);
                return createShortUrl($url);
            }
            return $shortUrl;
        }
    }
    fclose($h);
    return false;
}

function deleteByUrl($url)
{
    $h  = fopen(FILE,'r');
    $h2 = fopen(getcwd().DIRECTORY_SEPARATOR.'temp.txt','w');
    while (($str = fgets($h)) !== false)
    {
        $arr = explode(DELIMITER, $str);
        $longUrl = $arr[0];

        if($longUrl != $url)
        {
            fwrite($h2, $str);
        }
    }
    fclose($h);
    fclose($h2);
    unlink(FILE);
    rename(getcwd().DIRECTORY_SEPARATOR.'temp.txt', FILE);
}

function shortUrlExists($shortUrl)
{
    $h = fopen(FILE,'r');
    while (($str = fgets($h)) !== false)
    {
        $arr = explode(DELIMITER, $str);
        if($arr[1] == $shortUrl)
        {
            fclose($h);
            return true;
        }
    }
    fclose($h);
    return false;
}

function generateShortUrl($url)
{
    $s = substr(md5($url . time()), 0, 5);
    $out = '';
    for ($i = 0; $i < 5; ++$i) {
        if (rand(0, 1) === 1) {
            $out .= strtoupper($s[$i]);
        } else {
            $out .= $s[$i];
        }
    }
    return DOMAIN.$out;
}

function createShortUrl($url)
{
    do
    {
        $shortUrl = generateShortUrl($url);
    }while(shortUrlExists($shortUrl));
    $expire = time()+(30*24*60*60); //истекает через 30 дней
    //$expire = time()+60; //истекает через 60 сек
    file_put_contents(FILE, $url.DELIMITER.$shortUrl.DELIMITER.$expire.PHP_EOL, FILE_APPEND);
    return $shortUrl;
}

function getShortUrl($url)
{
    $shortUrl = getShortUrlByUrl($url);
    if($shortUrl) return $shortUrl;
    return createShortUrl($url);
}


if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['url']))
{
    $url = trim($_GET['url']);
    if (! filter_var($url, FILTER_VALIDATE_URL))
    {
        echo 'Введеный URL невалидный';
    }
    else
    {
        $url = (substr($url, strpos($url, '//')+2));
        echo getShortUrl($url);
    }
}

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <form action="index.php" method="GET">
        <label>Введите ссылку: <input type="text" name="url"></label>
        <input type="submit">
    </form>
</body>
</html>
