<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        @font-face {
            font-family: 'GothamBook';
            src: url('<?= __DIR__ ?>/fonts/GothamBook.ttf') format('truetype');
        }
        
        @font-face {
            font-family: 'Blacksword';
            src: url('<?= __DIR__ ?>/fonts/Blacksword.otf');
        }
        
        @font-face {
            font-family: 'Gotham-Bold';
            src: url('<?= __DIR__ ?>/fonts/Gotham-Bold.otf');
        }
        
        body {
            line-height: 1;
            width: 1169px;
            height: 826px;
            background-image: url('data:image/png;base64,<?= base64_encode(file_get_contents(__DIR__ . "/img/dip_template.png")) ?>');
            background-repeat: no-repeat;
        }
        
        html,
        body,
        div {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        
        #main {
            font-family: Arial, sans-serif;
        }
        
        #container {
            height: 100%;
            position: relative;
        }
        
        .bold {
            font-weight: bold;
        }
        
        .clear {
            clear: both;
        }
        
        .left {
            float: left;
        }
        
        .col1 {
            width: 322px;
            height: 826px;
            position: relative;
        }
        
        .col2 {
            width: 800px;
            height: 826px;
            position: relative;
        }
        
        .title {
            height: 312px;
            position: relative;
            line-height: 30px;
        }
        
        .name {
            height: 100px;
            position: relative;
        }
        
        .body {
            height: 105px;
            position: relative;
        }
        
        .titleContent {
            text-align: center;
            width: 800px;
            font-family: 'Gotham-Bold';
            font-size: 20px;
            color: #575756FF;
            padding-top: 230px;
        }
        
        .nameContent {
            text-align: center;
            width: 800px;
            font-family: 'Blacksword';
            font-size: 58px;
            color: #00548bff;
        }
        
        .bodyContent {
            text-align: center;
            width: 800px;
            font-family: 'GothamBook';
            font-size: 18px;
            color: #575756ff;
        }
    </style>
</head>

<body>
    <div id="main">
        <div id="container">
            <div class="left col1">&nbsp;</div>
            <div class="left col2">
                <div class="title">
                    <div class="tcontent">
                        <div class="titleContent">El Departamento de Vinculación con la Sociedad<br/>conﬁere el presente certiﬁcado a:</div>
                    </div>
                </div>
                <div class="name">
                    <div class="ncontent">
                        <div class="nameContent">
                            Félix Javier Alejandro Escalante
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="bcontent">
                        <div class="bodyContent">
                            Por haber participado en el curso:<span>"Habilidades blandas para la Vinculación <br />con la Sociedad",</span> realizado <span>desde el 3 hasta el 17 de marzo del 2020</span> con una duracion de <span>20 horas pedagogicas.</span>
                        </div>
                    </div>
                </div>
                <div class="qr"><?php echo $content; ?></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</body>

</html>