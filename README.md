Задача: Реализация компонента анализа изменения температуры воздуха

1. Разработать структуру БД для хранения прогноза температуры воздуха в нескольких городах

2. Реализовать методы получения этих данных из любого публичного источника по API, например     https://openweathermap.org/forecast   https://www.apixu.com/     https://www.gismeteo.ru/api/#temperature

3. Написать SQL-запрос, считающий изменения по температуре воздуха, по сравнению с предыдущим днем за определенный период примерно в таком виде:

[Изменения в температурах с 2018-06-01 по 2018-06-04]

[город] [дата] [температура] [delta]

Москва   2018-06-01   20    0

Москва   2018-06-02   18    -2

Москва   2018-06-03   19    1

Москва   2018-06-04   24    5

Самара   2018-06-01   28    0

Самара   2018-06-02   22    -6

Самара   2018-06-03   19    -3

Самара   2018-06-04   24    5

4. Реализовать вывод результатов запроса

 

Требования к коду:

1. Yii2/ООП/Любая СУБД
2. Создание структуры БД производить через миграции
3. Получение данных из источника производить при помощи консольной команды

4. Представление реализовать через обычный Web-контроллер
