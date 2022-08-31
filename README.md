# Simple Payment Helper In Lumen

Built a Simple Payment Helper using The Strategy Design pattern with lumen.

## Why Use Strategy Pattern

-   Strategy Pattern Creates a way to Implement a solution for deferent situations where they have the same purpose or result, and when you have a lot of similar classes that only differ in the way they execute some behavior.

## To Reproduce

```bash
    composer install
```

## Endpoints

-   To Use Paypal Payment hit: `/paymentByPaypal` | `POST`

    -   Payload:

        ```json
        {
            "data": {
                "username": "username",
                "password": 123456789,
                "token": "Ho76m0Ti6NiAFWpAWi2RSqNTyoRjpI4W",
                "Paid": false
            }
        }
        ```

-   Response:

    -   Successful response `200`:

        ```json
        {
            "response": {
                "successful": "Payment Taken! Make sure to check your balance"
            },
            "data": {
                "username": "username",
                "password": "$2y$10$q.D1Su2QFKhpzHpVzR9tpuctOgXqOclbB2oZBbN2bmP5wuvr9CON.",
                "token": "Ho76m0Ti6NiAFWpAWi2RSqNTyoRjpI4W",
                "Paid": true
            }
        }
        ```

        -   Failed response `500`:

        ```json
        {
            "response": {
                "error": "Payment Failed! Make Sure The Details Are Filled Correctly"
            },
            "data": ""
        }
        ```

-   To Use Card Payment: `/paymentByCard` | `POST`

    -   Payload:

        ```json
        {
            "data": {
                "fullName": "Test Name",
                "cardNumber": "4354656543223322",
                "expiryMonth": 6,
                "expiryYear": 2021,
                "cvv": 342,
                "Paid": false
            }
        }
        ```

-   Response:

    -   Successful response `200`:

        ```json
        {
            "response": {
                "successful": "Payment Taken! Make sure to check your balance"
            },
            "data": {
                "Full Name": "Badr Choujai",
                "Card Number": "************3322",
                "Expiry Month": 6,
                "Expiry Year": 2021,
                "CVV": 342,
                "Paid": true
            }
        }
        ```

        -   Failed response `500`:

        ```json
        {
            "response": {
                "errors": "Payment Failed! Try To Fill The Correct Details."
            },
            "data": ""
        }
        ```

### For more info Official Documentation for lumen

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).
