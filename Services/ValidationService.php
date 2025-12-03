<?php

namespace Services;

class ValidationService {

    public static function isValidItemName(string $name): bool {
        // اسم المنتج: حروف + أرقام + مسافات، من 3 إلى 50 حرف
        return preg_match("/^[a-zA-Z0-9\s]{3,50}$/", $name);
    }

    public static function isValidDescription(string $desc): bool {
        // الوصف: على الأقل 10 أحرف، يسمح بالحروف والأرقام وبعض الرموز
        return preg_match("/^[a-zA-Z0-9\s\.,!?]{10,}$/", $desc);
    }

    public static function isValidPrice($price): bool {
        // السعر: رقم صحيح أو عشري بحد أقصى منزلتين عشريتين
        return preg_match("/^\d+(\.\d{1,2})?$/", $price);
    }

    public static function isValidCountry(string $country): bool {
        // البلد: حروف فقط، من 2 إلى 30 حرف
        return preg_match("/^[a-zA-Z\s]{2,30}$/", $country);
    }

    public static function isValidRating($rating): bool {
        // التقييم: رقم من 0 إلى 5
        return preg_match("/^[0-5]$/", $rating);
    }
}
