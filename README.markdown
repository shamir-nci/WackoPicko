# WackoPicko - Secure Web Development CA Project

## My Information

- **Name:** Shamir Khan
- **Student ID:** 24244775
- **Course:** Secure Web Development
- **Institution:** National College of Ireland
- **Academic Year:** 2025/2026
- **Project Start:** November 26, 2025

## Project Overview

This is my Secure Web Development CA project based on WackoPicko, a deliberately vulnerable PHP web application.

**Project Goal:** Analyze and fix security vulnerabilities in the application.

**Original Source:** https://github.com/adamdoupe/WackoPicko  
**My Fork:** https://github.com/shamir-nci/WackoPicko  
**Author:** Adam Doupé, Arizona State University

## Application Features

- **CRUD Operations:** Users are able to create, read, update and delete photos.
- **User Roles:** Users and admin with different privileges.
- **Database:** MYSQL database with multiple tables.
- **Technology:** PHP 7.4+, MySQL 5.7+, Apache

## Selected Vulnerabilities to Fix

1. SQL Injection: users/login.php
2. Stored XSS: guestbook.php
3. Weak Sessions: admin/login.php
4. Directory Traversal: pictures/upload.php
5. Reflected XSS: pictures/search.php

## Development Environment

- **Editor:** GitHub Codespaces (VS Code in browser)
- **Version Control:** Git & GitHub
- **Platform:** Cloud-based (no local installation)

## Project Timeline

** Week 1:** Setup, planning and fix vulnerbilities
** Week 2:** Fix 3 vulnerbilities and deploy app.

## Repository Structure

WackoPicko/
├── README.md
├── admin/
├── users/
├── pictures/
├── guestbook.php
├── current.sql
└── upload/

## Current Status

🚧 **Week 1 - Project Setup**

- [x] Repository forked
- [x] GitHub account set up
- [x] Readme Updated

**Last Updated:** November 26, 2025