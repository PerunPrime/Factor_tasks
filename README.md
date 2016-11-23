# Factor_tasks

Для загрузки проэкта, пожалуйста нажмите зелёную кнопку "Clone or download", затем выберете "Download ZIP".

Проэкт разбит на 4 папки:
Factor_task_1
Factor_task_2
Factor_task_3
Factor_task_4
Названых в соответствии с номерами заданий.

1. Factor_task_1 содержит в себе один файл functions.php в котором реализованы указанные в задании функции.

2. Для запуска Factor_task_2 поместите папку Factor_task_2 в корневую директорию сайта.
    К примеру дял lamp XAMPP это c:\xampp\htdocs\
    
    Проэкт состоит из:
    index.php - Основной индекс файл.
    PDOConnect.php - Файл класса PDOConnect реализующего подключение к БД.
    NavigationManager.php - Файл класса NavigationManager реализующего построение меню и дополнительные методы работы с БД.
    factor_task_2.sql - Дамп базы данных.
    
    Создать базу данных при помощи дампа.
    В файле PDOConnect.php в строке $this->connectionString = 'mysql:host=localhost;dbname=factor_task_2'; изменить factor_task_2     на название созданной вами в предыдущем пункте БД.
    Далее в браузере введете адресс http://localhost/Factor_task_2/ либо http://localhost/Factor_task_2/index.php

3. Запуск Factor_task_3 аналогичен Factor_task_2.
    Дамп базы данных указан вами в задании.

4. Factor_task_4 содержит в себе 4 файла:
    query_1.sql
    query_2.sql
    query_3.sql
    query_4.sql
    С соответствующими заданиям запросами
