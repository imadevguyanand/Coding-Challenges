<?php

/**
 * @description: Function that takes 2 colors as arguments and returns the 
 * average color
 * @author Anand Rajendran
 */

class AverageColorCalculator
{
    /**
     * Average color - The average color is calculated by taking the arithmetic mean for each component: red, green and blue.
     * 
     * @param String $colorOne
     * @param String $colorTwo
     * @return String
     * @complexities Time => O(1) | Space => O(1)
     */
    public function average(string $colorOne, string $colorTwo) 
    {
        $RGBColorOne = $this->getRGBColors($colorOne); 
        $RGBColorTwo = $this->getRGBColors($colorTwo); 

        if(count($RGBColorOne) === 3) {
            $redOne = $RGBColorOne[0];
            $greenOne = $RGBColorOne[1];
            $blueOne = $RGBColorOne[2];
        }

        if(count($RGBColorTwo) === 3) {
            $redTwo = $RGBColorTwo[0];
            $greenTwo = $RGBColorTwo[1];
            $blueTwo = $RGBColorTwo[2];
        }

        // Get the mean
         $meanRed = $this->calculateMean($redOne, $redTwo);
         $meanGreen = $this->calculateMean($greenOne, $greenTwo);
         $meanBlue = $this->calculateMean($blueOne, $blueTwo);
         
         return $this->getHexadecimalString($meanRed, $meanGreen, $meanBlue);
    }

    /**
     * Convert hexidecimal color into an array
     * 
     * @param String $color 
     * @return Array
     * @complexities Time => O(1) | Space => O(1), length of the hexadecimal is always 6 so its a constant time operation even though we use a hashTable
     */
    public function getRGBColors(string $color) 
    {
        $hashTable = [];
        $string = "";
        for($idx = 0; $idx < strlen($color); $idx++) 
        {
            $string .= $color[$idx];
            if(strlen($string) === 2) {
                $decimal = hexdec($string);
                // Push to the end of the array, the operation is O(1) as we are pushing to the end
                array_push($hashTable, $decimal);
                $string = "";
            }
        }
        return $hashTable;
    }

    /**
     * Arithmetic mean of 2 colors
     * 
     * @param Integer $numberOne
     * @param Integer $numberTwo
     * @return Integer 
     */
    public function calculateMean(int $numberOne, int $numberTwo) 
    {
        $numbers = $numberOne + $numberTwo;
        return round($numbers / 2);
    }

    /**
     * Convert decimal to hexadecimal 
     * 
     * @param Integer $red
     * @param Integer $green
     * @param Integer $blue
     * @return String
     */
    public function getHexadecimalString(int $red, int $green, int $blue) 
    {
        return dechex($red) . "" . dechex($green) . "" . dechex($blue);
    }

    /**
     * Get random hexadecimals
     * 
     * @return String
     */
    public function generateRandomHexadecimal() 
    {
        return substr(md5(rand()), 0, 6);
    }
}

//Test cases
$obj = new AverageColorCalculator();
$colorOne = $obj->generateRandomHexadecimal();
$colorTwo = $obj->generateRandomHexadecimal();
$data = [
    "colorOne:" => $colorOne,
    "colorTwo:" => $colorTwo,
    "average:" => $obj->average($colorOne, $colorTwo)
];

print_r(json_encode($data, JSON_PRETTY_PRINT));