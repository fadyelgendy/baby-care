# API DOCUMENTATION

## Login

```http
POST [URL] /api/login
```
### HEADERS
```json
{
    "Accept-Language": <'ar', 'en'>
}
```

### BODY
```json
{
    "email": "email1@test.com",
    "password": "12345678"
}
```

### Responses
#### Success

```json
{
    "success": true,
    "status_code": 200,
    "data": {
        "message": "User logged In Successfully",
        "user": {
            "id": 1,
            "name": "User One",
            "email": "email1@test.com",
            "phone_number": "01200625881",
            "api_token": "3|gvpRmfg8p6P7ZQGrnWZOUIwFnP8hbp9p2njpNgFb"
        }
    }
}
```

#### failed
```json
{
    "success": false,
    "status_code": 401,
    "errors": {
        "error": "Your Email or password is Incorrect, plese check and try again"
    }
}
```

<hr>

## Register

```http
POST [URL] api/register
```
### HEADERS
```json
{
    "Accept-Language": <'ar', 'en'>
}
```

### BODY
```json
{
    "email": "fady@test.com",
    "phone_number": "01200625885",
    "name": "fady gendy",
    "password" : "12345678",
    "password_confirmation" : "12345678"
}
```

### Responses
#### Success

```json
{
    "success": true,
    "status_code": 200,
    "data": {
        "message": "تم إنشاء الحساب بنجاح",
        "user": {
            "id": 3,
            "name": "fady gendy",
            "email": "fady@test.com",
            "phone_number": "01200625885",
            "api_token": "4|toNcjZziq6ystcmammjjbbAsw1zTZagB5SXZdjPI"
        }
    }
}
```

#### failed
```json
{
    "success": false,
    "status_code": 422,
    "errors": {
        "email": [
            "The email field is required."
        ]
    }
}
```

```json
{
    "success": false,
    "status_code": 500,
    "exception": {
        "message": "حدث خطأ ما, حاول مرة أخرى",
        "error": "SQLSTATE[01000]: Warning: 1265 ...",
        "file": "...",
        "line": 759
    }
}
```

<hr>

## Logout

```http
POST [URL] /api/user/logout
```
### HEADERS
```json
{
    "Accept-Language": <'ar', 'en'>,
    "Authorization": "Bearer 1|bdn..."
}
```

### Responses
#### Success

```json
{
    "success": true,
    "status_code": 200,
    "data": {
        "message": "User logged Out Successfully"
    }
}
```

#### failed
```json
{
    "success": false,
    "status_code": 401,
    "errors": {
        "error": "Action not authorized"
    }
}
```
<hr>

## Children List

```http
GET [URL] /api/user/children/list
```
### HEADERS
```json
{
    "Accept-Language": <'ar', 'en'>,
    "Authorization": "Bearer 1|bdn..."
}
```

### Responses
#### Success

```json
{
    "success": true,
    "status_code": 200,
    "data": {
        "children": [
            {
                "id": 1,
                "name": "Child One",
                "age": 1.5,
                "gender": "Female",
                "parent": [
                    "id": 1,
                    "name": "parent one"
                ]
            }
        ]
    }
}
```

#### failed
```json
{
    "success": false,
    "status_code": 401,
    "errors": {
        "error": "Action not authorized"
    }
}
```
<hr>


## Children Show

```http
GET [URL] /api/user/children/1/show
```
### HEADERS
```json
{
    "Accept-Language": <'ar', 'en'>,
    "Authorization": "Bearer 1|bdn..."
}
```

### Responses
#### Success

```json
{
    "success": true,
    "status_code": 200,
    "data": {
        "id": 1,
        "name": "Child One",
        "age": 1.5,
        "gender": "Female",
        "parent": [
            "id": 1,
            "name": "parent one"
        ]
    }
}
```

#### failed
```json
{
    "success": false,
    "status_code": 401,
    "errors": {
        "error": "Action not authorized"
    }
}
```
```json
{
    "success": false,
    "status_code": 404,
    "errors": {
        "error": "This child is not exist or it does not belongs to You!"
    }
}
```
<hr>

## Children Create

```http
POST [URL] /api/user/children/create
```
### HEADERS
```json
{
    "Accept-Language": <'ar', 'en'>,
    "Authorization": "Bearer 1|bdn..."
}
```

### BODY
```json
{
    "name": "Fady C",
    "gender" : "male",
    "age": 1.5
}
```

### Responses
#### Success

```json
{
    "success": true,
    "status_code": 200,
    "data": {
        "message": "تم إضافة طفل بنجاح"
    }
}
```

#### failed
```json
{
    "success": false,
    "status_code": 401,
    "errors": {
        "error": "Action not authorized"
    }
}
```
```json
{
    "success": false,
    "status_code": 422,
    "errors": {
        "name": [
            "The name field is required."
        ]
    }
}
```

```json
{
    "success": false,
    "status_code": 500,
    "exception": {
        "message": "حدث خطأ ما, حاول مرة أخرى",
        "error": "SQLSTATE[01000]: Warning: 1265 ...",
        "file": "...",
        "line": 759
    }
}
```
<hr>

## Children edit

```http
POST [URL] /api/user/children/1/edit
```
### HEADERS
```json
{
    "Accept-Language": <'ar', 'en'>,
    "Authorization": "Bearer 1|bdn..."
}
```

### BODY
```json
{
    "<any child field>": "<field value>",
}
```

### Responses
#### Success

```json
{
    "success": true,
    "status_code": 200,
    "data": {
        "message": "Child Updated Successfully"
    }
}
```

#### failed
```json
{
    "success": false,
    "status_code": 401,
    "errors": {
        "error": "Action not authorized"
    }
}
```

```json
{
    "success": false,
    "status_code": 500,
    "exception": {
        "message": "حدث خطأ ما, حاول مرة أخرى",
        "error": "SQLSTATE[01000]: Warning: 1265 ...",
        "file": "...",
        "line": 759
    }
}
```
<hr>

## Children delete

```http
POST [URL] /api/user/children/1/delete
```
### HEADERS
```json
{
    "Accept-Language": <'ar', 'en'>,
    "Authorization": "Bearer 1|bdn..."
}
```

### Responses
#### Success

```json
{
    "success": true,
    "status_code": 200,
    "data": {
        "message": "Child Deleted Successfully"
    }
}
```

#### failed
```json
{
    "success": false,
    "status_code": 401,
    "errors": {
        "error": "Action not authorized"
    }
}
```

```json
{
    "success": false,
    "status_code": 404,
    "errors": {
        "error": "This child is not exist or it does not belongs to You!"
    }
}
```
<hr>

```http
POST [URL] /api/user/partner/create
```
### HEADERS
```json
{
    "Accept-Language": <'ar', 'en'>,
    "Authorization": "Bearer 1|bdn..."
}
```

### BODY
```json
{
    "name": "123456",
    "email": "mypartner@email.com",
    "phone_number": "01200625332",
    "password": "12345678",
    "password_confirmation": "12345678"
}
```

### Responses
#### Success

```json
{
    "success": true,
    "status_code": 200,
    "data": {
        "message": "Partner Account Updated Successfully"
    }
}
```

#### failed
```json
{
    "success": false,
    "status_code": 401,
    "errors": {
        "error": "Action not authorized"
    }
}
```

```json
{
    "success": false,
    "status_code": 422,
    "errors": {
        "error": "This User Has Partner already, You can not added another partner"
    }
}
```

```json
{
    "success": false,
    "status_code": 500,
    "exception": {
        "message": "حدث خطأ ما, حاول مرة أخرى",
        "error": "SQLSTATE[01000]: Warning: 1265 ...",
        "file": "...",
        "line": 759
    }
}
```
<hr>

```http
GET [URL] /api/user/partner/show
```
### HEADERS
```json
{
    "Accept-Language": <'ar', 'en'>,
    "Authorization": "Bearer 1|bdn..."
}
```

### Responses
#### Success

```json
{
    "success": true,
    "status_code": 200,
    "data": {
        "partner": {
            "id": 4,
            "name": "123456",
            "email": "mypartner@email.com",
            "phone_number": "01200625332",
            "api_token": "5|md5AmaTlqpfXMz5vTNfTH5L4ctwHTbbjOIWNS5yS"
        }
    }
}
```

#### failed
```json
{
    "success": false,
    "status_code": 401,
    "errors": {
        "error": "Action not authorized"
    }
}
```

```json
{
    "success": false,
    "status_code": 422,
    "errors": {
        "error": "This User Has Partner already, You can not added another partner"
    }
}
```
<hr>