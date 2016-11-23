<?php

function isStringIsPolindrom($str) {                        // функция проверяет является ли слово подпалиндромом
    $testWord = mb_strtolower($str);                        // если есть uppercase символы, преомразует в lowercase
    return $testWord == strrev($testWord);                  // функцией strrev "разворацаваем слово" и проверяем на равенство с оригиналом. Результат возвращаем.
}

function getSubPolindromsFromString($str) {                 // функция проверяет есть ли в слове подпалиндромы
    $resultArrey = array();                                 // Массив который будет содержать слова подпалиндромы райденные в проверяемом слове
    for ($index = 0; $index < strlen($str)-2; $index++) {   // Первый цикл смещает сммвол скоторого начинается предполагаемый полинтром. 
                                                            //Минимальная длинна полиндрома 3 символа, поэмому strlen($str)-2
        for ($indexSub = 3; $indexSub < strlen($str)-$index+1; $indexSub++) {   // Второй цикл смещает сммвол которым окачивается предполагаемый полинтром. 
                                                                                //Минимальная длинна полиндрома 3 символа, поэмому indexSub = 3
          $testStr = substr($str, $index, $indexSub);       // функцией substr в переменную $testStr копируем часть стоки начинач с $index символа и до $indexSub по счёту
           
          $testLowStr = mb_strtolower($testStr);            // если есть uppercase символы, преомразует в lowercase
          
          if($testLowStr == strrev($testLowStr)){           // функцией strrev "разворацаваем слово" и проверяем на равенство с оригиналом.   
                array_push($resultArrey, $testStr);         // Если слово иолиндром, добавляем его к $resultArrey
            }
        }
    }
    return $resultArrey;                                    // Возвращаем массив со словами. Если полиндромов не найдено размер массива будет равен 0
}
?>