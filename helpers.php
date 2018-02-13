<?php

/**
 * Write to Slim\Response
 *
 * @param Response $response
 * @param string $output
 * @return void
 */
function write( $response, $output )
{
    return $response->write($output);
}

/**
 * Convert >HTML to entities
 *
 * @param string $input
 * @return string
 */
function nohtml( $input )
{
    return htmlentities($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Render a template file
 *
 * @param string $template
 * @param array $data
 * @throws RuntimeException
 * @return string
 */
function render( $template, array $data = [] )
{
    $file = 'templates/'.$template.'.php';

    if( !is_readable($file) )
    {
        throw new RuntimeException('Cannot render "' . $file . '" : template is not readable');
    }

    // ob, fetch content

    extract($data);

    ob_start();

    require $file;

    return ob_get_clean();
}

/**
 * Simple json encode
 *
 * @param array $data
 * @param integer $options
 * @return string
 */
function json( $data = [], $options = 0 )
{
    $options = JSON_PRETTY_PRINT; // debug

    return json_encode($data, $options);
}

/**
 * Password hash
 *
 * @param string $value
 * @param string $salt
 * @return string
 */
function passhash( $value, $salt = '' )
{
    // fixme: random salt

    return hash('sha512', $value.$salt); // 128chars
}

/**
 * exit, and redrect to a page
 *
 * @param string $url
 * @return void
 */
function redirect( $url )
{
    return exit(header('Location: '.$url));
}

/**
 * Guess the prefered language based on http header
 *
 * @param string $default
 * @param array $langsAvailable
 * @return string
 */
function getPreferedLanguage( $default, array $langsAvailable = [] )
{
    static $prefered;

    if( isset($prefered) )
    {
        return $prefered;
    }

    $httpAccept = getenv('HTTP_ACCEPT_LANGUAGE');

    if( isset($httpAccept) ) // fr,fr-FR;q=0.8,en-US;q=0.5,en;q=0.3
    {
        $langs = [];

        foreach( explode(',', $httpAccept) as $values )
        {
            list($lang, $quality) = array_pad(explode(';q=', $values, 2), 2, 1); // default q=1

            $langs[$lang] = $quality;
        }

        if( !empty($langs) )
        {
            // sort list based on value	
            arsort($langs, SORT_NUMERIC);

            // get the first of the list
            $prefered = key($langs);

            $prefered = substr($prefered, 0, 2); // 2 frst char 'fr-FR'
        }
    }

    if( !isset($prefered) && in_array($prefered, $langsAvailable) )
    {
        return $prefered;
    }

    return $prefered = $default;
}

/**
 * Basic String translation
 *
 * @param [type] $phrase
 * @return void
 */
function __( $phrase )
{
    static $translations = [];

    if( is_string($phrase) ) // get a translate
    {
        $args = func_get_args();
        $format = array_shift($args); // phrase
		
        if( isset($translations[$phrase]) )
        {
            $format = $translations[$phrase];
        }

        return vsprintf($format, $args);
    }
    elseif( is_array($phrase) ) // set the translations
    {
        $translations = $phrase;
    }
}

/**
 * Fetch data from sessions
 *
 * @param string $key
 * @param mixed $value
 * @return mixed
 */
function session( $key, $value = null )
{
    $sess =& $_SESSION;

    if( isset($key, $value) ) // simple set
    {
        $sess[$key] = $value;
    }
    elseif( isset($key) ) // try to get a prop
    {
        return ( isset($sess[$key]) ) ? $sess[$key] : null;
    }
}

/**
 * add events ; fire events
 * second parameter is sended to callbacks
 *
 * @param string $event
 * @param callable $callback
 * @return void
 */
function event( $event, $callback = null )
{
	static $events = [];

    if( isset($callback) && is_callable($callback) ) // add event
    {
        $events[$event][] = $callback;
    }
    elseif(isset($events[$event])) // fire a callback
    {
        $result = $callback; // value passed thru

		foreach( $events[$event] as $function )
		{
			$result = call_user_func($function, $result);
		}

		return $result;
    }
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

/**
 * Send mail function
 *
 * @param array $options
 * @return bool
 */
function xmail( array $options = [] )
{
    $result = false;

    try {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        //$mail->SMTPDebug = 2;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->CharSet = 'utf-8';

        $mail->Username = 'testaa131231232812346@gmail.com';
        $mail->Password = ('QSDbuqndbuh2346bnQSDFSQBH');

        //Recipients
        $mail->setFrom('testaa131231232812346@gmail.com', 'CoffeeTask');
        $mail->addReplyTo('testaa131231232812346@gmail.com', 'CoffeeTask');

        if( isset($options['address']) )
        {
            list($address, $recipient) = $options['address'];

            // $address = 'aatestaatest98@gmail.com';//test

            $mail->addAddress($address, $recipient);     // Add a recipient
        }
    
        //Content
        $mail->isHTML(true);
    
        if( isset($options['subject']) )
        {
            $mail->Subject = 'CoffeeTask - '.$options['subject'];
        }

        if( isset($options['body']) )
        {
            $mail->Body = $options['body']; // html
        }

        if( isset($options['body-txt']) )
        {
            $mail->Body = $options['body-txt']; // text
        }

        $result = $mail->send();

    } catch (PHPMailerException $e) {
        //echo 'Mailer Error: ' . $mail->ErrorInfo;

        return false;
    }

    return $result;
}




// https://github.com/danielstjules/php-pretty-datetime
// Licence MIT
/*
use DateTime;
use DateTimeZone;

function prettyDate( DateTime $dateTime, DateTime $reference = null )
{
    // The constants correspond to units of time in seconds
    // const MINUTE = 60;
    // const HOUR   = 3600;
    // const DAY    = 86400;
    // const WEEK   = 604800;
    // const MONTH  = 2628000;
    // const YEAR   = 31536000;

    // If not provided, set $reference to the current DateTime
    if( !$reference ) {
        $timezone = new DateTimeZone($dateTime->getTimezone()->getName());
        $reference = new DateTime(null, $timezone);
    }
    // Get the difference between the current date and the supplied $dateTime
    $difference = $reference->format('U') - $dateTime->format('U');
    $absDiff = abs($difference);
    // Get the date corresponding to the $dateTime
    $date = $dateTime->format('Y/m/d');
    // Throw exception if the difference is NaN
    if (is_nan($difference)) {
        throw new Exception('The difference between the DateTimes is NaN.');
    }

    //http://php.net/manual/fr/datetime.diff.php#example-2585

    // Today
    if ($reference->format('Y/m/d') == $date) {
        if (0 <= $difference && $absDiff < MINUTE) {
            return 'Moments ago';
        } elseif ($difference < 0 && $absDiff < MINUTE) {
            return 'Seconds from now';
        } elseif ($absDiff < HOUR) {
            return prettyFormat($difference / MINUTE, 'minute');
        } else {
            return prettyFormat($difference / HOUR, 'hour');
        }
    }

    $yesterday = clone $reference;
    $yesterday->modify('- 1 day');

    $tomorrow = clone $reference;
    $tomorrow->modify('+ 1 day');

    if ($yesterday->format('Y/m/d') == $date) {
        return 'Yesterday';
    } else if ($tomorrow->format('Y/m/d') == $date) {
        return 'Tomorrow';
    } else if ($absDiff / DAY <= 7) {
        return prettyFormat($difference / DAY, 'day');
    } else if ($absDiff / WEEK <= 5) {
        return prettyFormat($difference / WEEK, 'week');
    } else if ($absDiff / MONTH < 12) {
        return prettyFormat($difference / MONTH, 'month');
    }

    // Over a year ago
    return prettyFormat($difference / YEAR, 'year');
}
function prettyFormat( $difference, $unit )
{
    // $prepend is added to the start of the string if the supplied
    // difference is greater than 0, and $append if less than
    $prepend = ($difference < 0) ? 'In ' : '';
    $append = ($difference > 0) ? ' ago' : '';
    $difference = floor(abs($difference));

    // If difference is plural, add an 's' to $unit
    if( $difference > 1 ) {
        $unit = $unit . 's';
    }

    return sprintf('%s%d %s%s', $prepend, $difference, $unit, $append);
}
*/

