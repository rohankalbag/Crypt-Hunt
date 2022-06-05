# Dynamic CryptHunt Website

### Author : Rohan Rajesh Kalbag

## Documentation

The following code is for a dynamic crypt-hunt website containing *user authentication (login and signup)*, *dynamic leaderboard for participants*, ```.json``` *based question insertion*, ```.json``` *based instructions for user*, *XSS vulnerability protection*, *SQL injection vulnerability protection* developed using the following tools
- Frontend : ```HTML, CSS, JavaScript``` 
- Backend: ```PHP```
- Database: ```phpMyAdmin, MySQL ```
- PHP Development Environment: ```XAMPP```

## Instructions to set up on [XAMPP](https://www.apachefriends.org/index.html)
- Install XAMPP
- Move the files all the json and php files to project folder in ```xampp/htdocs```
- *(Optional)*: Move ```./quiz_db``` folder to ```xampp/mysql/data``` the database contains some dummy example data. If not used then make sure to change the database credentials from the default ones in ```./connection.php``` to make the database compatible with the backend
- Run the XAMPP server

## Adding Questions/Instructions to the CryptHunt

### For Questions
- Add the following `.json` block in `./crypt.json` for each new question

```json
{
    "no": 1,
    "question": "<question text>",
    "answer":" <one word answer in lowercase>"
}
```
- Replace the 1 with the relevant question number

### For Instructions
- Add the following `.json` block in `./instructions.json` for each new question

```json
{
    "no": 1,
    "instruction": "<instruction text>"
}
```
- Replace the 1 with the relevant instruction number
