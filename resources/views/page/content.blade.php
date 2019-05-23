<?php
/**
 * Created by PhpStorm.
 * User: phuckx
 * Date: 7/21/2016
 * Time: 10:14 AM
 */
?>
        <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title of the document</title>
    <style>
        @font-face {
            font-family: MyFont;
        }

        body {
            font-family: MyFont;
            font-size: medium;
            text-align: justify;
        }

        img {
            width: 100%;
            display: block;
            margin: auto;
        }

        * {
            max-width: 100%;
        }

        a {
            color: black;
            text-decoration: none !important;
        }
    </style>
</head>

<body>

<div id="content">
    @if(isset($page[0]))
        {!! $page[0]->content_en !!}
    @endif
</div>
</body>

</html>
