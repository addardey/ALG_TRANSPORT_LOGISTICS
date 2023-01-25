<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= (isset($this->title)) ? $this->title : 'Kalajha' ?></title>
        <meta name="description" content="<?= (isset($this->description)) ? $this->description : 'W3 Multimedia Incorporation' ?>">
        <meta name="author" content="<?= (isset($this->author)) ? $this->author : 'W3 Multimedia Incorporation' ?>">
        <meta name="keywords" content="<?= (isset($this->keywords)) ? $this->keywords : 'w3,w3-multimedia,media,W3,W3-MULTIMEDIA,MEDIA, software,Development, SOFTWARE,Web, WEB, Design ,DESIGN ,software companyin ghana,WatchGhana,ghana,gh,website developers, web developers, website development services, web development services, web development companies, website development company, web design services, website design services, w3 multimedia, Frontend-developer, Website Designer, C and C++ Programmer, Java Programmer, Java Web Application Developer, Android Application Developer, PHP Programmer, Java Enterprise Application Developer, MS SQL Server 2016, Red Hat Enterprise 7, Google Search Engine Tools, Google Adwords, JSF, Struts, MySQL,Apache,Software Project Management' ?>" />
        <?php
        if (isset($this->css)) {
            foreach ($this->css as $css) {
                echo '<link href="' . URL . $css . '" rel="stylesheet" />';
            }
        }
        ?>
    </head>

    <body>