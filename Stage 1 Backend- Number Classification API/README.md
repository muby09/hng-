# Number Classification API

## Description
This API takes a number as input and returns interesting mathematical properties about it along with a fun fact.

## Endpoint

- **GET**  
http://reachme.infinityfreeapp.com/number-api/index.php?number='your-number(371)'

## Response Format
{

        "number": 371,
        "is_prime": false,
        "is_perfect": false,
        "properties": ["armstrong", "odd"],
        "digit_sum": 11,
        "fun_fact": "371 is an Armstrong number because 3^3 + 7^3 + 1^3 = 371"

}

### Successful Response (200 OK)
### Error Response (400 Bad Request)
{

        "error": true,
        "message": "Invalid input."

}


## Setup Instructions

- Clone this repository.
- Install Xampp 
- Copy project to htdocs
-  Run Locally using browser
http://localhost/number-api/index.php?number=23
## Backlink

For more information on PHP development, visit [HNG PHP Developers](https://hng.tech/hire/php-developers).
