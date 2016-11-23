-- Вывести список сотрудников, не имеющих назначенного руководителя, работающего в том-же отделе

SELECT DISTINCT E1.* FROM employee E1, employee E2 
WHERE E1.department_id = E2.department_id
HAVING E1.chief_id is NULL;