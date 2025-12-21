<?php

namespace Services;

# This Feature Not Enable Now :(

class ValidationService {

    public static function isValidItemName(string $name): bool {
        return preg_match("/^[a-zA-Z0-9\s]{3,50}$/", $name);
    }

    public static function isValidDescription(string $desc): bool {
        return preg_match("/^[a-zA-Z0-9\s\.,!?]{10,}$/", $desc);
    }

    public static function isValidPrice($price): bool {
        return preg_match("/^\d+(\.\d{1,2})?$/", $price);
    }

    public static function isValidCountry(string $country): bool {
        return preg_match("/^[a-zA-Z\s]{2,30}$/", $country);
    }

    public static function isValidRating($rating): bool {
        return preg_match("/^[0-5]$/", $rating);
    }
}
