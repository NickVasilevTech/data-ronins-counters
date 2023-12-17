This is my solution to the given task of creating a WordPress plugin. The specifications given are:

Create a WordPress plugin that:
1. overrides the login and register links and shows JavaScript alert accordingly: 
  - Login button clicked!
  - Register button clicked!
2. increments login/register attempts on every click of login/register button via AJAX call and refreshes the page (after JS alert from point 1) and shows on page current status:
  - Login attempts: 5 (for example)
  - Register attempts 3 (for example)

SETUP:  
Prerequisites: Docker, Docker Compose, Git  
 
Steps to install:  
1. Clone the repo
2. In the repo's folder run `docker compose up -d`
3. Try to access the solution at http://localhost:8000
4. To test the solution, please use the standard URL for the default WP login page - http://localhost:8000/wp-login.php

Info on the design:  
I've tried to use comments in the code to show understanding of what's different WP built-in functionalities do.  
I've selected CamelCase as the naming convention for the custom variables and functions. This was done with the idea of making it easier to find and identify custom business logic and data.  
Work time was around 8 hours, spread over two days.


