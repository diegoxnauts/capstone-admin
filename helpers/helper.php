<?php
class Helper
{
    private $defaultPath;

    public function __construct()
    {
        $this->defaultPath = ($_SERVER['SERVER_NAME'] == 'localhost') ? '/capstone-admin/' : '/' ;
    }

    public function subviewPath($file) { // return a path to include subviews
        $file =  __DIR__ . '/../views/sub-views/'. $file;
        return $file;
    }

    public function viewPath() {
        $file = __DIR__ . '/../views/' . $file;
        return $file;
    }

    function cssPath($file) { // return a css file path to for href attributes
        $hrefPath = $this->defaultPath .'assets/css/'. $file;
        return $hrefPath;
    }

    function jsPath($file) { // return a js file path to for src attributes
        $hrefPath = $this->defaultPath . 'assets/js/'. $file;
        return $hrefPath;
    }

    function pageUrl($file) { // return a page path for href navigation
        $httpProtocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https';
        $url = $httpProtocol . '://' . $_SERVER['HTTP_HOST'] . $this->defaultPath;
        if ($file !== 'index.php') {
            $url .= 'views/' . $file;
        }
        return $url;
    }

    function processUrl($file) {
        $httpProtocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https';
        $url = $httpProtocol . '://' . $_SERVER['HTTP_HOST'] . $this->defaultPath;
        return $url .= 'process/' . $file;
    }

    function subPageUrl($file) { // return a page path for href navigation
        $httpProtocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https';
        $url = $httpProtocol . '://' . $_SERVER['HTTP_HOST'] . $this->defaultPath;
        if ($file !== 'index.php') {
            $url .= 'views/sub-views/' . $file;
        }
        return $url;
    }

    function secondsToTime($inputSeconds) {
        $secondsInAMinute = 60;
        $secondsInAnHour = 60 * $secondsInAMinute;
        $secondsInADay = 24 * $secondsInAnHour;
    
        // Extract days
        $days = floor($inputSeconds / $secondsInADay);
    
        // Extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);
    
        // Extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);
    
        // Extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);
    
        // Format and return
        $timeParts = [];
        $sections = [
            'day' => (int)$days,
            'hour' => (int)$hours,
            'minute' => (int)$minutes,
            'second' => (int)$seconds,
        ];
    
        foreach ($sections as $name => $value){
            if ($value > 0 || $name == 'second'){
                $timeParts[] = $value. ' '.$name.($value == 1 ? '' : 's');
            }
        }
    
        return implode(', ', $timeParts);
    }
}
?>