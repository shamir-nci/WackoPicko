# WackoPicko - Secure Web Development CA Project

## My Information

- **Name:** Shamir Khan
- **Course:** Secure Web Development
- **Institution:** National College of Ireland
- **Academic Year:** 2025/2026
- **Project Start:** November 26, 2025

## Project Overview

This repository contains the coursework for the Secure Web Development module. The project is based on WackoPicko, a deliberately vulnerable PHP web application designed for security training.

The primary purpose of this project is to analyze, identify, and remediate critical security vulnerabilities within the application. The main security focus is on fixing common but severe web application flaws to make the application safe for use.

**Project Goal:** Analyze and fix security vulnerabilities in the application.

**Original Source:** https://github.com/adamdoupe/WackoPicko  
**My Fork:** https://github.com/shamir-nci/WackoPicko  
**Author:** Shamir Khan, National College of Ireland

## Application Features

- **CRUD Operations:** Users are able to create, read, update and delete photos.
- **User Roles:** Users and admin with different privileges.
- **Database:** MYSQL database with multiple tables.
- **Technology:** PHP 7.4+, MySQL 5.7+, Apache

## Features and Security Objectives

- **User Management:** User registration, login, and profile viewing.
- **Image Hosting:** Authenticated users can upload, view, and manage photos (CRUD operations).
- **Guestbook:** A public guestbook for users to leave comments.
- **User Roles:** The application supports standard user and admin roles with different access levels.

## Security Objectives

The main objective is to identify and remediate the following five critical vulnerabilities:

- **SQL Injection:** Prevent unauthorized database access and manipulation.
- **Stored Cross-Site Scripting (XSS):** Stop malicious scripts from being permanently saved on the server.
- **Weak Session Management:** Secure administrative sessions against hijacking.
- **Directory Traversal:** Prevent attackers from accessing arbitrary files on the server.
- **Reflected Cross-Site Scripting (XSS):** Mitigate the reflection of malicious scripts from web requests.

## Selected Vulnerabilities to Fix

1. **SQL Injection 1 - 3:** `users.php`
2. **Stored XSS:** `guestbook.php`
3. **Weak Sessions:** `admin/login.php`
4. **Directory Traversal:** `pictures/upload.php`

## Development Environment

- **Editor:** GitHub Codespaces (VS Code in browser)
- **Version Control:** Git & GitHub
- **Platform:** Cloud-based (no local installation)

## Project Timeline

- **Week 1:** Setup, planning and analyze vulnerabilities
- **Week 2:** Fix 2 vulnerabilities and deploy app

## Repository Structure

WackoPicko/

-- README.markdown/

-- admin/

-- users/

-- pictures/

-- guestbook.php

-- current.sql

-- upload/


## Current Status

🚧 **Week 1 - Project Setup**

- [x] Repository forked
- [x] GitHub account set up
- [x] README updated

**Last Updated:** November 26, 2025