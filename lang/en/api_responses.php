<?php

return [
    "messages" => [
        "success" => [
            "user" => [
                "create" => "Account Created Successully",
                "login" => "User logged In Successfully",
                "logout" => "User logged Out Successfully",
            ],

            "parent" => [
                "create" => "Partner Account Created Successully",
            ],

            "child" => [
                "create" => "Child Added Successfully",
                "update" => "Child updated Successfully",
                "delete" => "Child deleted Successfully",
            ]
        ],
        "failed" => [
            "user" => [
                "login" => "Your Email or password is Incorrect, plese check and try again",
            ],

            "child" => [
                "not_found" => "This child is not exist or it does not belongs to You!"
            ],

            "parent" => [
                "exists" => "This User Has Partner already, You can not added another partner"
            ],

            "general" => [
                "server_error" => "Something went wrong! Please Try again later."
            ]
        ]
    ]
];