-- Показать список сотрудников, получающих максимальную заработную плату в своем отделе

SELECT E1.* FROM employee E1
WHERE  E1.salary = (
SELECT MAX(salary) FROM employee E2
WHERE  E2.department_id = E1.department_id );