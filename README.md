# Contract Management System

<p align="center">
    <img src="https://laravel.com/img/logomark.min.svg" width="100" alt="Laravel Logo">
</p>

<p align="center">
    <strong>Web-based Contract Management System</strong>
</p>

<p align="center">
    A web application for managing employee employment contracts from contract creation, document generation, distribution, employee review, and digital signing.
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-PHP-red" alt="Laravel">
    <img src="https://img.shields.io/badge/JavaScript-ES6-yellow" alt="JavaScript">
    <img src="https://img.shields.io/badge/MySQL-Database-blue" alt="MySQL">
    <img src="https://img.shields.io/badge/Bootstrap-UI-purple" alt="Bootstrap">
</p>

---

## 📌 About The Project

**Contract Management System** is a web-based application designed to help HRD manage employee employment contracts in a centralized system.

The system supports the contract management process starting from contract creation, employee assignment, contract data management, contract document generation, contract distribution to employees, employee review, and digital signature.

This system was developed to reduce manual contract management processes and provide better visibility of contract status for both HRD and employees.

---

## 🎯 Project Objectives

The main objectives of this system are:

- Centralize employee contract management.
- Reduce manual contract administration.
- Simplify the process of creating and managing contracts.
- Allow HRD to monitor contract status.
- Allow employees to view their assigned contracts.
- Provide digital contract signing using a signature canvas.
- Store signed signatures securely as image files.
- Improve traceability of contract information.
- Provide a structured workflow between HRD and employees.

---

## 👥 User Roles

The system currently supports different roles with different responsibilities.

### HRD

HRD is responsible for managing employee contracts.

Main capabilities:

- Create contracts
- Edit contract information
- Assign contracts to employees
- Assign contract signing authority
- Manage contract data
- Send contracts to employees
- Monitor contract status
- View employee contract details
- View employee signatures
- Manage contract documents

### Employee

Employees are responsible for reviewing and signing assigned contracts.

Main capabilities:

- View assigned contracts
- Open contract documents
- Review contract information
- Sign contracts digitally
- Confirm agreement
- View signed contract status

---

## 🔄 Contract Workflow

The contract follows a structured approval and signing workflow:

**Draft**
↓
**Sent**
↓
**Viewed**
↓
**Employee Signed**
↓
**HRD Approved**
↓
**Head of Branch Approved**
↓
**Completed**

> **Expired** — A contract is marked as expired when its contract period has ended.

### Workflow Overview

| Status                      | Description                                               |
| --------------------------- | --------------------------------------------------------- |
| **Draft**                   | Contract is created and prepared by HRD                   |
| **Sent**                    | Contract has been assigned to the employee                |
| **Viewed**                  | Employee has opened the contract                          |
| **Employee Signed**         | Employee has signed the contract                          |
| **HRD Approved**            | HRD has reviewed and approved the signed contract         |
| **Head of Branch Approved** | Head of Branch has completed the final approval           |
| **Completed**               | All required signing and approval processes are completed |
| **Expired**                 | Contract period has ended                                 |

---

## 🚀 Getting Started

### Quick Start

```bash
# Clone the repository
git clone https://github.com/username/contract-management.git
cd contract-management

# Install PHP and JS dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure your database in .env, then run:
php artisan migrate --seed
php artisan storage:link

# Build assets and serve
npm run dev
php artisan serve