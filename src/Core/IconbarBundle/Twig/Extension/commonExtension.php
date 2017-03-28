<?php


namespace Core\IconbarBundle\Twig\Extension;


class commonExtension extends \Twig_Extension {



    /**
     * FONCTIONS CUSTOM
     *
     * @return array
     */
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('arraySum', array($this, 'arraySum')),
            new \Twig_SimpleFunction('round', array($this, 'round')),
        );
    }
    
    /**
     * Somme des élements d'une liste
     *
     * @param $array
     * @return number
     */
    public function arraySum($array)
    {
        return array_sum($array);
    }

    /**
     * Arrondi à l'unité d'une valeur
     *
     * @param $num
     * @return float
     */
    public function round($num)
    {
        return round($num,0);
    }


    /**
     * FILTRES CUSTOM
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('elapsedTime', array($this, 'elapsedTimeFilter')),
            new \Twig_SimpleFilter('format_percent', array($this, 'percentFilter')),
            new \Twig_SimpleFilter('format_integer', array($this, 'integerFilter')),
            new \Twig_SimpleFilter('base64enc', array($this, 'base64encodeFilter')),
            new \Twig_SimpleFilter('base64dec', array($this, 'base64decodeFilter')),
            new \Twig_SimpleFilter('sort', array($this, 'twig_sort')),
            new \Twig_SimpleFilter('removeSpecialChars', array($this, 'removeSpecialCharsFilter')),
        );
    }


    /**
     * Remove special chars in string
     *
     * @param $input
     * @return string
     */
    public function removeSpecialCharsFilter($input)
    {

        // All char to lower
        $str = strtolower($input);

        // Remove accents
        // throw new \Exception($str);
        $str = str_replace(
            array(
                'à', 'â', 'ä', 'á', 'ã', 'å',
                'î', 'ï', 'ì', 'í',
                'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
                'ù', 'û', 'ü', 'ú',
                'é', 'è', 'ê', 'ë',
                'ç', 'ÿ', 'ñ',
            ),
            array(
                'a', 'a', 'a', 'a', 'a', 'a',
                'i', 'i', 'i', 'i',
                'o', 'o', 'o', 'o', 'o', 'o',
                'u', 'u', 'u', 'u',
                'e', 'e', 'e', 'e',
                'c', 'y', 'n',
            ),
            $str
        );

        // Remove special chars
        $str = preg_replace('/[^\da-z_-]/i', " ", $str);

        return $str;
    }





    /**
     * Retourne le temps écoulé littéralement depuis la date en entrée
     *
     * @param $input
     * @return string
     */
    public function elapsedTimeFilter($input)
    {
        $timestamp = $input->format('U');

        $estimate_time = time() - $timestamp;

        if( $estimate_time < 1 )
        {
            return 'less than 1 second ago';
        }

        $condition = array(
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $estimate_time / $secs;

            if( $d >= 1 )
            {
                $r = round( $d );
                return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }

        return "";
    }

    /**
     * Transforme un nombre réel en pourcentage. Le float 80,143 fera retourner la string 80.1%.
     *
     * @param $input
     * @return string
     */
    public function percentFilter($input)
    {
        $number=floatval($input);
        if ($number < 10 and $number > -10)
            return round($number,2)."%";
        return round($number,1)."%";
    }

    /**
     * Rendre un nombre élevé plus lisible
     *
     * @param $input
     * @return string
     */
    public function integerFilter($input)
    {
        $number = intval($input);
        if ($number > 1000000) 
            return number_format(round($number/10000)/100,2,'.',',').'m'; 
        else if ($number > 100000) 
            return intval($number/1000).'k'; 
        else if ($number > 1000) 
            return number_format(round($number/100)/10,1,'.',',').'k';
        return $number;
    }


    /**
     * Encode une chaîne de caractère en base 64
     *
     * @param $input
     * @return string
     */
    public function base64encodeFilter($input)
    {
        if (is_array($input))
            return base64_encode(json_encode($input));
        return base64_encode($input);
    }

    /**
     * Décode une chaîne de caractère base 64
     *
     * @param $input
     * @return string
     */
    public function base64decodeFilter($input)
    {
        return base64_decode($input);
    }


    /**
     * Tri une liste selon les méthodes de tr php
     *
     * @param $array
     * @param string $method
     * @param string $sort_flag
     * @return mixed
     */
    public function twig_sort($array, $method='asort', $sort_flag='SORT_REGULAR')
    {
          settype($sort_flag, 'integer');

          switch ($method)
          {
                  case 'asort':
                          asort($array, $sort_flag);
                          break;

                  case 'arsort':
                          arsort($array, $sort_flag);
                          break;

                  case 'krsort':
                          krsort($array, $sort_flag);
                          break;

                  case 'ksort':
                          ksort($array, $sort_flag);
                          break;

                  case 'natcasesort':
                          natcasesort($array);
                          break;

                  case 'natsort':
                          natsort($array);
                          break;

                  case 'rsort':
                          rsort($array, $sort_flag);
                          break;

                  case 'sort':
                          sort($array, $sort_flag);
                          break;
          }

          return $array;
    }



    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'cp_iconbar_extension';
    }
}


