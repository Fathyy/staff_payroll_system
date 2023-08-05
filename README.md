# staff_payroll_system
This is a basic staff payroll management system. The system generates a pay slip containing personal and tax details of a staff member.
It was built using PHP, MySQL, JavaScript and Ajax.
A user can sign up as an admin or a staff member.
#Admin
The admin logs into his dashboard and can:
•	Create departments, allowances and deductions. 
•	The allowances and deductions are used to calculate individual taxes for the staff. I used the criteria provided by Kenya Revenue Authority (KRA)
  to calculate individual Pay As You Earn (PAYE).
•	The details are processed into a pay slip which can be generated with a click of a button.
•	The Pay slip can be downloaded immediately after viewing it.
#Staff
If the user is a staff member, he/she can log in and will be redirected to a separate dashboard. 
•	They are prompted to provide extra necessary details such as gender, national id, salary etc. 
•	The above details are useful for pdf generation on the admin side because they are displayed on the pay slip.
•	There is a separate section to view already processed pay slips by the admin. The staff member can proceed to download the pay slips.


