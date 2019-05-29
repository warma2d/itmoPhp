<?php

/* 1.
 * Дана строка, содержащая полное имя файла
(например, 'C:\OpenServer\testsite\www\someFile.txt').
Написать функцию, которая сможет выделить из подобной строки
имя файла без расширения.
*/

function getBaseName(string $filePath):string
{
    $slashPos = strripos($filePath,'/');
    if(! $slashPos)
    {
        $slashPos = strripos($filePath,'\\');
    }
    $fileName = substr($filePath,++$slashPos);
    $dotPos = strripos($fileName,'.');
    if(! $dotPos)
        return substr($fileName,0);
    else
        return substr($fileName,0, $dotPos);
}

echo getBaseName('C:\Open.Server\testsite\www\someFile.txt').'<br>';
echo getBaseName('C:\Open.Server\testsite\www\someFile2').'<br>';
echo getBaseName('/home/path/folder/file.mp3').'<br>';
echo getBaseName('/home/path/folder/file2').'<br>';
echo '<hr>';

/* 2.
Написать функцию - конвертер строки.
Возможности (в зависимости от второго аргумента - флаг,
который указывает, какую именно операцию следует выполнить):
1) перевод всех символов в верхний регистр,
2) перевод всех символов в нижний регистр,
3) перевод всех символов в нижний регистр и первых символов слов в верхний регистр.*/

function convertStr(string $str, int $option) : string
{
    if($option == 1)
    {
        return strtoupper($str);
    }
    elseif($option == 2)
    {
        return strtolower($str);
    }
    elseif($option == 3)
    {
        $str = strtolower($str);
        $cnt = strlen($str);
        for($i=0; $i<$cnt; $i++)
        {
            if($str[($i-1)] == ' ' || $i==0)
                $str[$i] = strtoupper($str[$i]);
        }
        return $str;
    }
    else return '';
}

$str = 'This is a table.';
var_dump($str);
echo '<br>';
$str = convertStr($str,3);
var_dump($str);
echo '<br><hr>';



/* 3.
 * Создать функцию по преобразованию нотаций:
строка вида 'this_is_string' преобразуется
в 'thisIsString' (CamelCase-нотация)
*/
function convertToCamelCase(string $str) :string
{
    $out = '';
    $str = strtolower($str);
    $cnt = strlen($str);
    for($i=0; $i<$cnt; $i++)
    {
        if($str[$i] == '_')
        {
            $i++;
            $out .= strtoupper($str[$i]);
        }
        else $out .= $str[$i];
    }
    return $out;
}

$str = 'my_var_text';
var_dump($str);
echo '<br>';
$str = convertToCamelCase($str);
var_dump($str);
echo '<br><hr>';

/* 4.
 * Сгенерировать 5 массивов из случайных чисел.
Вывести массивы и сумму их элементов на экран.
Найти массив с максимальной суммой элементов.
Вывести его на экран еще раз.
Генерация массива и подсчет суммы - разные функции
*/
function generateArray():array
{
    $arr = [];
    for($i=0;$i<3;$i++)
    {
        $arr[] = rand(0,10);
    }
    return $arr;
}

$arrs = [];
$valuesSum = [];
for($i=0; $i<5; $i++)
{
    $arrs[$i] = generateArray();
    print_r($arrs[$i]);
    $valuesSum[$i] = array_sum($arrs[$i]);
    echo '<br>';
    echo 'Сумма элементов: ' . $valuesSum[$i] ;
    echo '<br>';
}

$max = max($valuesSum);
echo 'Max sum:'.$max.'<br>';
$key = array_search($max, $valuesSum);
print_r($arrs[$key]);
echo '<hr>';

/*Дан массив, состоящий из целых чисел.
Выполнить сортировку массива по возрастанию суммы цифр чисел.
Например, дан массив [13, 55, 100].
После сортировки он будет следующего вида:
[100, 13, 55], тк сумма цифр числа 100 = 1,
сумма цифр числа 13 = 4, а 55 = 10.
На экран вывести исходный массив,
массив после сортировки
и сумму цифр каждого числа отсортированного массива.*/

$arr = [13,55,100];
$sums=[];
echo 'Исходный массив: ';
print_r($arr);
foreach($arr as $k=>$digits)
{
    $digits = (string)$digits;
    $cnt = strlen($digits);
    $sum = 0;
    for($i=0;$i<=$cnt;$i++)
    {
        $sum += (int)$digits[$i];
    }
    $sums[$k] = $sum;
}
echo '<br>';
echo 'Суммы элементов: ';
print_r($sums);
echo '<br>';
asort($sums);
//print_r($sums);
$out=[];
foreach ($sums as $k=>$v)
{
    $out[] = $arr[$k];
}
echo 'Отсортированный массив:';
print_r($out);