# MediMystic API

## About
The MedicaMystic API is an API for the web-based drug dispensing tool, MedicaMystic. It is able to fetch data of drugs and users from the database and display it on the website. It can also collect data based on specific parameters such as id and category. Besides that, it can also perform CRUD operations on the database i.e. it can insert a new record, update a record, delete a record and display all records, depending on the user's demands. It also offers authentication of users to increase data security.
Getting started
Before using the MedicaMystic API, ensure that:
The API must have a connection to the database medicamystic_api_data.
The localhost server must be open on port 8000.
There is an internet connection.

## When using the API:
Input the URLs on the request page and send.
Wait for a confirmation message to check if the request is successful.
If the URL is on the client page, you must acquire authentication through the use of bearer tokens.
When logging in as the API user, use the token given to access the pages that require you to perform database operations on clients.
When logging in as the admin, use the token given to access the pages that require you to perform database operations on API users.
If there are errors in sending the requests, check if the correct URLs have been written on the request page and if authentication is used where required.

## Authentication
The MedicaMystic API uses bearer tokens for authentication which are generated automatically by the controller classes when the API user logs in either as an API user or an admin.
They must be included when the user is performing database operations on clients and API users.
Authentication error response
If the bearer token is missing,a HTTP ststus code of 401 is sent, along with a JSON object with a message that indicates that the request is unauthenticated.
Rate and usage limits:
The API offers a token to each user when they log in to the system. Each of the tokens is unique to the user and expires after a year.
Need some help?

You can check these links for further information :
**API Documentation:** https://medica-mystics-devs.postman.co/workspace/MedicaMystic-API-Workspace~48abf318-5e37-487c-82aa-e6e189b69d7a/collection/31418538-900da663-b174-481a-8c25-639847392b8b?action=share&creator=31418538
**MedicaMystic Website:** https://github.com/Fidelisaboke/MedicaMystic
