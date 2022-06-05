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
- Open the directory for XAMPP after installation `Xampp`
- Move the files all the json and php files to project folder in ```Xampp/htdocs```
- *(Optional)*: Move ```./quiz_db``` folder to ```Xampp/mysql/data``` the database contains some dummy example data. **If not used then make sure to change the database credentials from the default ones in ```./connection.php``` to make the database compatible with the backend**
- Run the XAMPP server and activate `Apache` and `MySQL`
> ![image](https://user-images.githubusercontent.com/46604893/172038803-c091bf49-8430-4731-81e3-cfa22389ae92.png)
- Open your browser and enter the following URL `localhost:<Port for Apache>/quiz/` for the above example the Port is 80

## Demo Video

https://user-images.githubusercontent.com/46604893/172039628-df7a5ca3-d33c-402b-a98b-18e99d96e6ac.mp4

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

**For suggesting any modifications/fixing errors feel free to create a pull request/issue**
