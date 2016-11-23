-- Вывести список ID отделов, количество сотрудников в которых не превышает 3 человек

SELECT department_id FROM employee
GROUP BY department_id
HAVING count(id) < 3;
