<?php

return [
    "messages" => [
        "success" => [
            "user" => [
                "create" => "تم إنشاء الحساب بنجاح",
                "login" => "تم تسجيل الدخول بنجاح",
                "logout" => "تم تسجيل الخروج بنجاح",
            ],

            "parent" => [
                "create" => "تم إنشاء حساب الشريك بنجاح",
            ],

            "child" => [
                "create" => "تم إضافة طفل بنجاح",
                "update" => "تم تعديل طفل بنجاح",
                "delete" => "تم حذف طفل بنجاح",
            ]
        ],
        "failed" => [
            "user" => [
                "login" => "الايميل أو كلمة السر غير صحيح , من فضلك حاول مرة أخرى",
            ],

            "child" => [
                "not_found" => "هذا الطفل غير موجود أو لا ينتمي الى هذا المستخدم"
            ],

            "parent" => [
                "exists" => "هذا المستخدم لديه شريك بالفعل, لا يمكن إضافة شريك اخر"
            ],

            "general" => [
                "server_error" => "حدث خطأ ما, حاول مرة أخرى"
            ]
        ]
    ]
];