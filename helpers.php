<?php


function write( $response, $output )
{
    return $response->write($output);
}

function nohtml( $input )
{
    return htmlentities($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}


// Render a template file

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

// json encode

function json( $data = [], $options = 0 )
{
    $options = JSON_PRETTY_PRINT; // debug

    return json_encode($data, $options);
}

// pass word hash

function passhash( $value, $salt = '' )
{
    // fixme: random salt

    return hash('sha512', $value.$salt); // 128chars
}

// exit, and redrect to a page

function redirect( $url )
{
    return exit(header('Location: '.$url));
}

// guess the prefered language based on http header

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


// basic String translation

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


// Fetch data from sessions

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


// add events ; fire events ( second parameter is sended to callbacks )

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
use PHPMailer\PHPMailer\PHPMailerException;

function xmail()
{
    $mail = new PHPMailer(true);

    try {
        //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'user@example.com';                 // SMTP username
        $mail->Password = 'secret';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();

        return true;
    
    } catch (PHPMailerException $e) {
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    
    return false;
}
