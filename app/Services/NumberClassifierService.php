<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NumberClassifierService
{
    protected function isPrime(int $number): bool
    {
        if ($number < 2) return false;
        if ($number == 2) return true;
        if ($number % 2 == 0) return false;

        $sqrt = (int) sqrt($number);
        for ($i = 3; $i <= $sqrt; $i += 2) {
            if ($number % $i == 0) return false;
        }
        return true;
    }

    protected function isPerfect(int $number): bool
    {
        if ($number <= 1) return false;

        $sum = 1;
        $sqrt = (int) sqrt($number);

        for ($i = 2; $i <= $sqrt; $i++) {
            if ($number % $i == 0) {
                $sum += $i;
                if ($i != $number / $i) {
                    $sum += $number / $i;
                }
            }
        }

        return $sum == $number;
    }

    protected function isArmstrong(int $number): bool
    {
        $digits = str_split((string) $number);
        $power = count($digits);
        $sum = 0;

        foreach ($digits as $digit) {
            $sum += pow((int) $digit, $power);
        }

        return $sum == $number;
    }

    protected function digitSum(int $number): int
    {
        return array_sum(str_split((string) abs($number)));
    }

    protected function getFunFact(int $number): string
    {
        $response = Http::get("http://numbersapi.com/{$number}/math");

        if ($response->successful()) {
            return $response->body();
        }

        // Fallback if API fails
        return "Fun fact about {$number} could not be retrieved";
    }

    protected function getProperties(int $number): array
    {
        $properties = [];

        // Check if number is Armstrong
        if ($this->isArmstrong($number)) {
            $properties[] = 'armstrong';
        }

        // Check if odd or even
        $properties[] = ($number % 2 == 0) ? 'even' : 'odd';

        return $properties;
    }

    public function classify(int $number): array
    {
        return [
            'number' => $number,
            'is_prime' => $this->isPrime($number),
            'is_perfect' => $this->isPerfect($number),
            'properties' => $this->getProperties($number),
            'digit_sum' => $this->digitSum($number),
            'fun_fact' => $this->getFunFact($number)
        ];
    }
}