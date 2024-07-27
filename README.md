# cs338project

### Overview
 
This repo contains all the scripts for Group 11's CS338 project. The project focuses on building a company (equity) exploration application that aids users in company selection and analysis.
 
Primary functional features include:

1. the ability to create a user account with a login page, with an option for either CEO or Investor. CEOs can create new companies
2. Query public and private companies for given conditions with their respective information
3. Create and name a shortlist and delete a created shortlist
4. Add/delete companies from the shortlist 
5. Search for a specific shortlist type
6. View a summary of all companies in the repo
7. CEOs can update the info of the private company which they manage

Outlined below is the installation instructions for running the application on your local machine. 

### Prerequisites

We used the same tech stack as described in the Project example on the course homepage. 

As such, this repo uses MySQL for all database logic and PHP for web-based logic (the primary GUI for the user). Thus it assumed that users have the following installed on their local machine:

- PHP 

- MySQL 

### Installation

#### 1. Git Repo

Clone the repository to a dedicated folder using:

```bash
   git clone https://github.com/martinturuta/cs338-project.git
```


#### 2. MySQL
Ensure that MySQL is installed correctly.
After installing MySQL, create a schema name into which you will populate our tables. 

#### 2. PHP

Ensure that PHP is installed correctly. 
After installing PHP, open the following files and change the following placeholders in capitals within the lines to your relevant setup:
Do the same thing in the following files:
 - getCompanyInfoByParams.php (Lines 41-44)
 - project_db.php (Lines 5-8)
 - Addshortlist.php (Lines 7-10)
 - Deleteshortlist.php (Lines 7-10)
 - setupProduction.php (Lines 6-9)
 - setupSample.php (Lines 6-9)
 - viewShortlists.php (Lines 11-14)
 - viewShortlistcontents.php (10-13)


```php
  	$servername = "127.0.0.1";
	$username = "USERNAME";
	$password = "PASSWORD";
	$dbname = "SCHEMA NAME"
```

Run these two commands in your terminal. Ensure you are in a terminal already in the git folder. ForOtherwise, specify the absolute path to the setup file. For running with the sample date run this:

```bash
   sudo /usr/local/mysql/support-files/mysql.server start
   php setupSample.php
```

For running with the production database date run this:

```bash
   sudo /usr/local/mysql/support-files/mysql.server start
   php setupProduction.php
```
To start the application, open your terminal in the same directory as the index.php file and type the following command:
```
php -S 127.0.0.1:8000
```
Once you receive the "(http://127.0.0.1:8000) started" message near the end of the terminal. Head over to http://127.0.0.1:8000/ to navigate over to the application.

To run the application with a pre-loaded test user dataset, login with username = test@gmail.com and password = test. 











