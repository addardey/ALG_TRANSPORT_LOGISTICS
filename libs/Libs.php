<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require MAILER_DIR . 'Exception.php';
require MAILER_DIR . 'PHPMailer.php';
require MAILER_DIR . 'SMTP.php';
require_once('getid3/getid3.php');

/**
 * Description of libs
 *
 * @author albidar
 */
class Libs {

    public static function Email($recipient, $recipient_name, $subject, $message) {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.watchghana.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'no-reply@watchghana.com';                 // SMTP username
            $mail->Password = '<PAUSA0000>';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 26;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom('no-reply@watchghana.com', 'WatchGhana.com');
            $mail->addAddress($recipient, $recipient_name);     // Add a recipient
            $mail->addReplyTo('no-reply@watchghana.com', 'No Reply');
            $mail->addCC('cc@watchghana.com');
            $mail->addBCC('bcc@watchghana.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    public static function MinifierCSS($cssFiles) {
        /**
         * Ideally, you wouldn't need to change any code beyond this point.
         */
        $buffer = "";
        foreach ($cssFiles as $cssFile) {
            $buffer .= file_get_contents($cssFile);
        }
        // Remove comments
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        // Remove space after colons
        $buffer = str_replace(': ', ':', $buffer);
        // Remove whitespace
        $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
        $buffer = str_replace(', ', ',', $buffer);
        $buffer = str_replace(' ,', ',', $buffer);

        // Remove space before brackets
        $buffer = str_replace('{ ', '{', $buffer);
        $buffer = str_replace('} ', '}', $buffer);
        $buffer = str_replace(' {', '{', $buffer);
        $buffer = str_replace(' }', '}', $buffer);

        // Remove last dot with comma
        $buffer = str_replace(';}', '}', $buffer);
        // Enable GZip encoding.
        //ob_start("ob_gzhandler");
        // Enable caching
        header('Cache-Control: public');
        // Expire in one day
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
        // Set the correct MIME type, because Apache won't set it for us
        //header("Content-type: text/css");
        // Write everything out
        echo('<style>' . $buffer . '</style>');
    }

    public static function Input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function Date($datetime, $full = false) {
        date_default_timezone_set(DateTimeZone::listIdentifiers(DateTimeZone::UTC)[0]);
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public static function VideoDuration($filename) {
        $getID3 = new getID3;
        $file = $getID3->analyze($filename);
        return $file['playtime_string'];    // returns the codec_name property
    }

    public static function Hash($algo, $data, $salt) {
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);
        return hash_final($context);
    }

    public static function ImageCreate($word) {
        $width = strlen($word) * 9.3;
        $height = 20;
        $image = imagecreate($width, $height);
        $background = imagecolorallocate($image, 0, 0, 0);
        $foreground = imagecolorallocate($image, 255, 255, 255);
        imagestring($image, 5, 5, 1, $word, $foreground);
        header("Content-type: image/jpeg");
        imagejpeg($image);
    }

    public static function ImageSharpe($pic) {
        list($width, $height, $type, $attr) = getimagesize($pic);
        switch ($type) {
            case IMAGETYPE_JPEG:
        // Create image from PNG image file
                $image = imagecreatefromjpeg($pic);

        // Thanks to magilvia for this code: http://docs.php.net/manual/en/function.imageconvolution.php#104006
                function imagesharpe($image) {
                    // Matrix
                    $sharpen = array(
                        array(-1.2, -1, -1.2),
                        array(-1, 20, -1),
                        array(-1.2, -1, -1.2),
                    );

                    // Calculate the sharpen divisor
                    $divisor = array_sum(array_map('array_sum', $sharpen));

                    // Apply matrix
                    imageconvolution($image, $sharpen, $divisor, 0);
                    header("Content-Type: image/jpeg");
                    imagejpeg($image, NULL, 100);
                }

        // Apply function
                imagesharpe($image);
                break;

            case IMAGETYPE_PNG:

                $image = imagecreatefrompng($pic);
                $bg = imagecreatetruecolor(imagesx($image), imagesy($image));

                imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
                imagealphablending($bg, TRUE);
                imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                imagedestroy($image);

                header('Content-Type: image/jpeg');

                $quality = 70;
                imagejpeg($bg);
                imagedestroy($bg);
                break;
        }
    }
    
    public static function split_words($text, $length) {
        if (strlen($text) <= $length) {
            echo $text;
        } else {
            $y = substr($text, 0, $length) . '...';
            echo $y;
        }
    }

}
