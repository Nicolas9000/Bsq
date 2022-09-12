<?php

if ($argv[1]) {

    if (is_file($argv[1])) {

        $file = file_get_contents($argv[1]);

        function tab($file)
        {
            $tab = [];

            $explode = explode("\n", $file);
            array_shift($explode);
            array_pop($explode);

            // print_r($explode);
            $count = count($explode);

            for ($i = 0; $i < $count; $i++) {

                $ligne = $explode[$i];

                $ligne = str_replace(".", "1", $ligne);

                $ligne = str_replace("o", "0", $ligne);

                $ligne = str_split($ligne);


                array_push($tab, $ligne);
            }

            return $tab;
        }

        $tab = tab($file);
        // print_r($tab);

        $countL = count($tab);
        $countC = count($tab[0]);

        $checkTab = [[]];

        for ($i = 0; $i < $countL; $i++) {

            $checkTab[$i][0] = $tab[$i][0];
            // echo $checkTab[$i][0].PHP_EOL;
        }

        for ($j = 0; $j < $countC; $j++) {
            $checkTab[0][$j] = $tab[0][$j];
        }


        for ($i = 1; $i < $countL; $i++) {
            for ($j = 1; $j < $countC; $j++) {
                if ($tab[$i][$j] === "1") {
                    $checkTab[$i][$j] = min($checkTab[$i][$j - 1], $checkTab[$i - 1][$j], $checkTab[$i - 1][$j - 1]) + 1;
                } else {

                    $checkTab[$i][$j] = 0;
                }
            }
        }

        $maxCT = $checkTab[0][0];
        $maxI = 0;
        $maxJ = 0;

        for ($i = 0; $i < $countL; $i++) {
            for ($j = 0; $j < $countC; $j++) {

                if ($maxCT < $checkTab[$i][$j]) {

                    $maxCT = $checkTab[$i][$j];

                    $maxI = $i;
                    $maxJ = $j;
                }
            }
        }

        for ($i = $maxI; $i > $maxI - $maxCT; $i--) {

            for ($j = $maxJ; $j > $maxJ - $maxCT; $j--) {

                $tab[$i][$j] = str_replace("1", "x", $tab[$i][$j]);
            }
        }



        for ($i = 0; $i < $countL; $i++) {
            for ($j = 0; $j < $countC; $j++) {
                if ($tab[$i][$j] === "1") {
                    $tab[$i][$j] = str_replace("1", ".", $tab[$i][$j]);
                    echo $tab[$i][$j];
                }else if($tab[$i][$j] === "0"){
                    $tab[$i][$j] = str_replace("0", "o", $tab[$i][$j]);
                    echo $tab[$i][$j];
                }else{
                    echo $tab[$i][$j];
                }

            }
            echo "\n";
        }

    } else {
        echo "file pas bon" . PHP_EOL;
    }
}
