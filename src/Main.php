<?php

namespace App;

class Main
{
    public static function run(): void
    {
        $add_one = function (int $x): int {
            return $x + 1;
        };

        $multiply_by_two = function (?int $x): int {
            return $x * 2;
        };

        $safe_divide = function (float $x, float $y): Maybe {
            // if ($y === 0.0) {
            //     return new Maybe();
            // }
            return new Maybe($y === 0.0 ? null : $x / $y);
        };


        $parse_int = fn(string $value): Maybe => new Maybe(is_numeric($value) ? (int) $value : null);

        $is_positive = fn(?int $value): Maybe => new Maybe((int) $value > 0 ? $value : null);



        // $validate_and_process = function(string $inputStr) use ($parse_int, $is_positive, $multiply_by_two): Maybe {
        //     return (new Maybe($inputStr))
        //     ->bind($parse_int)
        //     ->bind($is_positive)
        //     ->bind(fn($n) => new Maybe($multiply_by_two($n)));
        // };

        $validate_and_process = fn(string $inputStr): Maybe => (new Maybe($inputStr))
            ->bind($parse_int)
            ->bind($is_positive)
            ->bind(fn(?int $n): Maybe => new Maybe($multiply_by_two((int) $n)));

        // $f = new Functor(5);
        // var_dump($f->map($add_one)->map($multiply_by_two)->getValue());
        // var_dump($f->map(fn($x) => $multiply_by_two($add_one($x)))->getValue());

        // $monad = new Monad(5);

        // var_dump(
        //     $monad
        //     ->bind(fn($x) => new Monad($add_one($x)))
        //     ->bind(fn($x) => new Monad($multiply_by_two($x)))
        //     ->getValue()
        // );

        // var_dump(
        //     $monad
        //     ->bind(fn($x) => Monad::unit($x))
        //     ->getValue()
        // ); // assert value

        // var_dump(
        //     (new Maybe((float)10))
        //     ->bind(fn(float $x) => $safe_divide($x, 2))
        //     ->bind(fn(float $x) => $safe_divide($x, 2))
        //     ->getValue()
        // );


        $inputs = ["5", "-3", "foo"];

        foreach ($inputs as $inputStr) {
            printf("processing %s \n", $inputStr);
            $result = $validate_and_process($inputStr);

            $msg = match (true) {
                $result->getValue() === null => sprintf("invalid input %s \n", $inputStr),
                is_numeric($result->getValue()) => printf("result %s \n", $result->getValue()),
                default => sprintf("unexpected input %s \n", $result->getValue()),
            };

            echo $msg;
        }
    }
}
