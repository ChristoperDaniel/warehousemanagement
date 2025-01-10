# II3160 Integrated Systems Technology
## WAREHOUSE MANAGEMENT SYSTEM

## Description
This system is used as a center for stock management and employees/staff management working in a warehouse.

## Requirement
- XAMPP
- CodeIgniter 4
- PHP
  
## System Description for Product List Management
The use case of the system designed is warehouse stock management (subdomain: Product List Management). This subdomain focuses on recording stock to ensure the availability of every product in the warehouse. Before employees can access the product management system, they must authenticate themselves (subdomain: Authentication) by entering their email and password. However, the system does not provide a sign-up feature (creating new accounts) because it cannot be accessed by unauthorized users. Accounts are manually registered into the database by someone who has access to it.

In the product list management system, there are two main functionalities that are the core of this system. These functionalities are product data input and editing existing data. Product data input consists of three required fields: product name, product category, and the quantity of the product in stock. All fields must be filled, and none can be left blank. If any field is left empty, the product data cannot be added to the database.

The second functionality, which is editing existing data, allows users to update the quantity of products available. In the data table displaying product details, there is a column called “Actions” that contains the “Edit” and “Delete” functions. When editing, users can modify the stock quantity and then save the changes. For deletion, the system will provide a confirmation prompt asking if the user really wants to delete the product. Once the user confirms, the product will be permanently removed from the table.

## System Description for Employee Management
The main use case of the warehouse system is employee management through the Employee Management subdomain. This subdomain plays a crucial role in ensuring the smooth operation of the warehouse. To access employee management, a role-based authentication feature ensures that only specific users can access certain data or functions according to their access rights. In this system, there are three main roles: Admin, Manager, and Staff. Each role has different data access rights for employee management.

Admins or managers have full access to the Employee Information, Attendance, and Job Assignment modules. In contrast, staff have limited access to view their work schedules in Job Assignment and to record attendance through Attendance. Employee Information contains personal data of employees, including name, email, phone number, department, status, start date, and role (position), which can only be accessed by admins or managers. The status in Employee Information includes active, on leave, and inactive. This sub-subdomain includes features to update an employee's status and delete employee data that is no longer needed.

Attendance provides a feature for employees to mark their attendance by filling in their name, email, department, and status. Attendance can be accessed by all roles with the same interface, and the attendance statuses are present, absent, and on leave. The Job Assignment interface differs for the three roles. Admins/Managers can assign tasks to employees by filling in the name, email, product name, and task status. The task status options are not started, in progress, and finished. In this sub-subdomain, admins/managers can update the product name and task status and delete assignments for specific employees.

Unlike the interface for admins/managers, staff can only view the assignments created by admins/managers and update their task status. This separation helps maintain data security and ensures that users can only access features according to their roles. User authentication is conducted using a username and password provided by the company. Users cannot register new accounts to prevent unauthorized access to confidential data. This system is designed for integration with other subdomains, such as Inventory Management, Product Management, or Shipping Management, providing an overall view of warehouse operations.

## How to Run via Localhost
- Clone this repository in htdocs inside the XAMPP folder (/Applications/XAMPP/htdocs)

```
git clone https://github.com/ChristoperDaniel/warehousemanagement.git
```

- Make sure the app.baseURL = 'http://localhost:8080/' in .env

- Make sure the public string $baseURL = 'http://localhost:8080/' in App.php

- Run 'php spark serve' in terminal

- Insert http://localhost:8080/ in browser

## How to Run via Deployed Link
- Run tstwarehouse.my.id/

## Contribution
| NIM           | Name                         | Contribution  |
| ------------- | ---------------------------- | ------------- |
| 18222034      | Christoper Daniel            | Product Feature Management|
| 18222100      | Ervina Limka                 | Employee Management|
