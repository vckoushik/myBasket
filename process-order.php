<?php

function sendmail(string $email,int $orderid)
{
        $connection = mysqli_connect('localhost', 'root', '', 'ecomphp');
        $to ='koushiksiva9@gmail.com';
        $t=time();
        $current_date = date('Y-m-d',$t);
        $subject = 'Order Status';
        $cart = isset($_SESSION['cart'])?$_SESSION['cart']:null;


        $userid = $_SESSION['customerid'];
        $sql = "SELECT * FROM usersmeta WHERE uid=$userid";
        $res1 = mysqli_query($connection, $sql);
        $cus = mysqli_fetch_assoc($res1);
        $cust_name = $cus['firstname']." ".$cus['lastname'];
        $street = $cus['address1'].",".$cus['address2'].$cus['city'].$cus['state'];
        $loc=$cus['state']." ".$cus['zip']." ".$cus['country'];

        $total = 0;
        foreach($cart as $key => $value) {
                //echo $key . ' : ' . $value['quantity'] .'<br>';
                $ordsql = "SELECT * FROM products WHERE id= $key";
                $ordres = mysqli_query($connection, $ordsql);
                $ordr = mysqli_fetch_assoc($ordres);
                $productprice = $ordr['price'];
                $quantity = $value['quantity'];
                $total += $quantity*$productprice;
        }
        $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <head>
            <meta charset='UTF-8'>
            <meta content='width=device-width, initial-scale=1' name='viewport'>
            <meta name='x-apple-disable-message-reformatting'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta content='telephone=no' name='format-detection'>
            <title></title>
          <style>/* CONFIG STYLES Please do not delete and edit CSS styles below */
        /* IMPORTANT THIS STYLES MUST BE ON FINAL EMAIL */
        #outlook a {
            padding: 0;
        }
        
        .ExternalClass {
            width: 100%;
        }
        
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }
        
        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }
        
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        
        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }
        
        [data-ogsb] .es-button {
            border-width: 0 !important;
            padding: 10px 20px 10px 20px !important;
        }
        
        /*
        END OF IMPORTANT
        */
        s {
            text-decoration: line-through;
        }
        
        html,
        body {
            width: 100%;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        
        body {
            font-family: arial, 'helvetica neue', helvetica, sans-serif;
        }
        
        table {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            border-collapse: collapse;
            border-spacing: 0px;
        }
        
        table td,
        html,
        body,
        .es-wrapper {
            padding: 0;
            Margin: 0;
        }
        
        .es-content,
        .es-header,
        .es-footer {
            table-layout: fixed !important;
            width: 100%;
        }
        
        img {
            display: block;
            border: 0;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        
        table tr {
            border-collapse: collapse;
        }
        
        p,
        hr {
            Margin: 0;
        }
        
        h1,
        h2,
        h3,
        h4,
        h5 {
            Margin: 0;
            line-height: 120%;
            mso-line-height-rule: exactly;
            font-family: 'trebuchet ms', helvetica, sans-serif;
        }
        
        p,
        ul li,
        ol li,
        a {
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
            mso-line-height-rule: exactly;
        }
        
        .es-left {
            float: left;
        }
        
        .es-right {
            float: right;
        }
        
        .es-p5 {
            padding: 5px;
        }
        
        .es-p5t {
            padding-top: 5px;
        }
        
        .es-p5b {
            padding-bottom: 5px;
        }
        
        .es-p5l {
            padding-left: 5px;
        }
        
        .es-p5r {
            padding-right: 5px;
        }
        
        .es-p10 {
            padding: 10px;
        }
        
        .es-p10t {
            padding-top: 10px;
        }
        
        .es-p10b {
            padding-bottom: 10px;
        }
        
        .es-p10l {
            padding-left: 10px;
        }
        
        .es-p10r {
            padding-right: 10px;
        }
        
        .es-p15 {
            padding: 15px;
        }
        
        .es-p15t {
            padding-top: 15px;
        }
        
        .es-p15b {
            padding-bottom: 15px;
        }
        
        .es-p15l {
            padding-left: 15px;
        }
        
        .es-p15r {
            padding-right: 15px;
        }
        
        .es-p20 {
            padding: 20px;
        }
        
        .es-p20t {
            padding-top: 20px;
        }
        
        .es-p20b {
            padding-bottom: 20px;
        }
        
        .es-p20l {
            padding-left: 20px;
        }
        
        .es-p20r {
            padding-right: 20px;
        }
        
        .es-p25 {
            padding: 25px;
        }
        
        .es-p25t {
            padding-top: 25px;
        }
        
        .es-p25b {
            padding-bottom: 25px;
        }
        
        .es-p25l {
            padding-left: 25px;
        }
        
        .es-p25r {
            padding-right: 25px;
        }
        
        .es-p30 {
            padding: 30px;
        }
        
        .es-p30t {
            padding-top: 30px;
        }
        
        .es-p30b {
            padding-bottom: 30px;
        }
        
        .es-p30l {
            padding-left: 30px;
        }
        
        .es-p30r {
            padding-right: 30px;
        }
        
        .es-p35 {
            padding: 35px;
        }
        
        .es-p35t {
            padding-top: 35px;
        }
        
        .es-p35b {
            padding-bottom: 35px;
        }
        
        .es-p35l {
            padding-left: 35px;
        }
        
        .es-p35r {
            padding-right: 35px;
        }
        
        .es-p40 {
            padding: 40px;
        }
        
        .es-p40t {
            padding-top: 40px;
        }
        
        .es-p40b {
            padding-bottom: 40px;
        }
        
        .es-p40l {
            padding-left: 40px;
        }
        
        .es-p40r {
            padding-right: 40px;
        }
        
        .es-menu td {
            border: 0;
        }
        
        .es-menu td a img {
            display: inline-block !important;
        }
        
        /* END CONFIG STYLES */
        a {
            text-decoration: underline;
        }
        
        p,
        ul li,
        ol li {
            font-family: arial, 'helvetica neue', helvetica, sans-serif;
            line-height: 150%;
        }
        
        ul li,
        ol li {
            Margin-bottom: 15px;
            margin-left: 0;
        }
        
        .es-menu td a {
            text-decoration: none;
            display: block;
            font-family: arial, 'helvetica neue', helvetica, sans-serif;
        }
        
        .es-wrapper {
            width: 100%;
            height: 100%;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }
        
        .es-wrapper-color {
            background-color: #efefef;
        }
        
        .es-header {
            background-color: transparent;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }
        
        .es-header-body {
            background-color: #fef5e4;
        }
        
        .es-header-body p,
        .es-header-body ul li,
        .es-header-body ol li {
            color: #999999;
            font-size: 14px;
        }
        
        .es-header-body a {
            color: #999999;
            font-size: 14px;
        }
        
        .es-content-body {
            background-color: #ffffff;
        }
        
        .es-content-body p,
        .es-content-body ul li,
        .es-content-body ol li {
            color: #333333;
            font-size: 14px;
        }
        
        .es-content-body a {
            color: #d48344;
            font-size: 14px;
        }
        
        .es-footer {
            background-color: transparent;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }
        
        .es-footer-body {
            background-color: #fef5e4;
        }
        
        .es-footer-body p,
        .es-footer-body ul li,
        .es-footer-body ol li {
            color: #333333;
            font-size: 14px;
        }
        
        .es-footer-body a {
            color: #333333;
            font-size: 14px;
        }
        
        .es-infoblock,
        .es-infoblock p,
        .es-infoblock ul li,
        .es-infoblock ol li {
            line-height: 120%;
            font-size: 12px;
            color: #cccccc;
        }
        
        .es-infoblock a {
            font-size: 12px;
            color: #cccccc;
        }
        
        h1 {
            font-size: 30px;
            font-style: normal;
            font-weight: normal;
            color: #333333;
        }
        
        h2 {
            font-size: 28px;
            font-style: normal;
            font-weight: normal;
            color: #333333;
        }
        
        h3 {
            font-size: 24px;
            font-style: normal;
            font-weight: normal;
            color: #333333;
        }
        
        .es-header-body h1 a,
        .es-content-body h1 a,
        .es-footer-body h1 a {
            font-size: 30px;
        }
        
        .es-header-body h2 a,
        .es-content-body h2 a,
        .es-footer-body h2 a {
            font-size: 28px;
        }
        
        .es-header-body h3 a,
        .es-content-body h3 a,
        .es-footer-body h3 a {
            font-size: 24px;
        }
        
        a.es-button,
        button.es-button {
            border-style: solid;
            border-color: #d48344;
            border-width: 10px 20px 10px 20px;
            display: inline-block;
            background: #d48344;
            border-radius: 0px;
            font-size: 16px;
            font-family: arial, 'helvetica neue', helvetica, sans-serif;
            font-weight: normal;
            font-style: normal;
            line-height: 120%;
            color: #ffffff;
            width: auto;
            text-align: center;
        }
        
        .es-button-border {
            border-style: solid solid solid solid;
            border-color: #d48344 #d48344 #d48344 #d48344;
            background: #2cb543;
            border-width: 0px 0px 0px 0px;
            display: inline-block;
            border-radius: 0px;
            width: auto;
        }
        
        /* RESPONSIVE STYLES Please do not delete and edit CSS styles below. If you don't need responsive layout, please delete this section. */
        @media only screen and (max-width: 600px) {
        
            p,
            ul li,
            ol li,
            a {
                line-height: 150% !important;
            }
        
            h1,
            h2,
            h3,
            h1 a,
            h2 a,
            h3 a {
                line-height: 120% !important;
            }
        
            h1 {
                font-size: 30px !important;
                text-align: center;
            }
        
            h2 {
                font-size: 26px !important;
                text-align: center;
            }
        
            h3 {
                font-size: 20px !important;
                text-align: center;
            }
        
            .es-header-body h1 a,
            .es-content-body h1 a,
            .es-footer-body h1 a {
                font-size: 30px !important;
            }
        
            .es-header-body h2 a,
            .es-content-body h2 a,
            .es-footer-body h2 a {
                font-size: 26px !important;
            }
        
            .es-header-body h3 a,
            .es-content-body h3 a,
            .es-footer-body h3 a {
                font-size: 20px !important;
            }
        
            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 16px !important;
            }
        
            .es-content-body p,
            .es-content-body ul li,
            .es-content-body ol li,
            .es-content-body a {
                font-size: 16px !important;
            }
        
            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 16px !important;
            }
        
            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 12px !important;
            }
        
            *[class='gmail-fix'] {
                display: none !important;
            }
        
            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important;
            }
        
            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important;
            }
        
            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important;
            }
        
            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important;
            }
        
            .es-button-border {
                display: block !important;
            }
        
            a.es-button,
            button.es-button {
                font-size: 20px !important;
                display: block !important;
                border-left-width: 0px !important;
                border-right-width: 0px !important;
            }
        
            .es-btn-fw {
                border-width: 10px 0px !important;
                text-align: center !important;
            }
        
            .es-adaptive table,
            .es-btn-fw,
            .es-btn-fw-brdr,
            .es-left,
            .es-right {
                width: 100% !important;
            }
        
            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important;
            }
        
            .es-adapt-td {
                display: block !important;
                width: 100% !important;
            }
        
            .adapt-img {
                width: 100% !important;
                height: auto !important;
            }
        
            .es-m-p0 {
                padding: 0px !important;
            }
        
            .es-m-p0r {
                padding-right: 0px !important;
            }
        
            .es-m-p0l {
                padding-left: 0px !important;
            }
        
            .es-m-p0t {
                padding-top: 0px !important;
            }
        
            .es-m-p0b {
                padding-bottom: 0 !important;
            }
        
            .es-m-p20b {
                padding-bottom: 20px !important;
            }
        
            .es-mobile-hidden,
            .es-hidden {
                display: none !important;
            }
        
            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important;
            }
        
            tr.es-desk-hidden {
                display: table-row !important;
            }
        
            table.es-desk-hidden {
                display: table !important;
            }
        
            td.es-desk-menu-hidden {
                display: table-cell !important;
            }
        
            .es-menu td {
                width: 1% !important;
            }
        
            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important;
            }
        
            table.es-social {
                display: inline-block !important;
            }
        
            table.es-social td {
                display: inline-block !important;
            }
        
            .es-menu td a {
                font-size: 16px !important;
            }
        
            .es-desk-hidden {
                display: table-row !important;
                width: auto !important;
                overflow: visible !important;
                max-height: inherit !important;
            }
        }
        
        /* END RESPONSIVE STYLES */</style>
        </head>
        
        <body>
            <div class='es-wrapper-color'>
                <!--[if gte mso 9]>
                    <v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>
                        <v:fill type='tile' color='#efefef'></v:fill>
                    </v:background>
                <![endif]-->
                <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'>
                    <tbody>
                        <tr>
                            <td class='esd-email-paddings' valign='top'>
                                <table cellpadding='0' cellspacing='0' class='es-header' align='center'>
                                    <tbody>
                                        <tr>
                                            <td class='esd-stripe' esd-custom-block-id='1735' align='center'>
                                                <table class='es-header-body' style='background-color: #fef5e4;' width='600' cellspacing='0' cellpadding='0' bgcolor='#fef5e4' align='center'>
                                                    <tbody>
                                                        <tr>
                                                            <td class='esd-structure es-p5t es-p5b es-p15r es-p15l' align='left'>
                                                                <!--[if mso]><table width='570' cellpadding='0' cellspacing='0'><tr><td width='180' valign='top'><![endif]-->
                                                                <table class='es-left' cellspacing='0' cellpadding='0' align='left'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='es-m-p0r esd-container-frame' width='180' valign='top' align='center'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-image es-m-p0l es-p15l es-m-txt-c' align='left' style='font-size:0'><h2><strong>myBasket<i class='fa fa-shopping-basket' aria-hidden='true'></i></strong></h2></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class='es-content' cellspacing='0' cellpadding='0' align='center'>
                                    <tbody>
                                        <tr>
                                            <td class='esd-stripe' esd-custom-block-id='1754' align='center'>
                                                <table class='es-content-body' width='600' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center'>
                                                    <tbody>
                                                        <tr>
                                                            <td class='esd-structure es-p10t es-p10b es-p20r es-p20l' esd-general-paddings-checked='false' align='left'>
                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='esd-container-frame' width='560' valign='top' align='center'>
                                                                                <table style='border-radius: 0px; border-collapse: separate;' width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-text es-p10t es-p15b' align='center'>
                                                                                                <h1>Thanks for your order<br></h1>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class='esd-block-text es-p5t es-p5b es-p40r es-p40l' align='center'>
                                                                                                <p style='color: #333333;'>You'll receive an email when your items are shipped. If you have any questions, Call us 1-800-1234-5678.</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class='esd-block-button es-p15t es-p10b' align='center'><span class='es-button-border' style='border-radius: 5px; background: #d48344 none repeat scroll 0% 0%; border-style: solid; border-color: #2cb543; border-top: 0px solid #2cb543; border-bottom: 0px solid #2cb543;'><a href='http://localhost/ecomphp/my-account.php' class='es-button' target='_blank' style='font-size: 16px; border-top-width: 10px; border-bottom-width: 10px; border-radius: 5px; background: #d48344 none repeat scroll 0% 0%; border-color: #d48344;'>View order status</a></span></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class='es-content' cellspacing='0' cellpadding='0' align='center'>
                                    <tbody>
                                        <tr>
                                            <td class='esd-stripe' esd-custom-block-id='1755' align='center'>
                                                <table class='es-content-body' width='600' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center'>
                                                    <tbody>
                                                        <tr>
                                                            <td class='esd-structure es-p20t es-p30b es-p20r es-p20l' align='left'>
                                                                <!--[if mso]><table width='560' cellpadding='0' cellspacing='0'><tr><td width='280' valign='top'><![endif]-->
                                                                <table class='es-left' cellspacing='0' cellpadding='0' align='left'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='es-m-p20b esd-container-frame' width='280' align='left'>
                                                                                <table style='background-color: #fef9ef; border-color: #efefef; border-collapse: separate; border-width: 1px 0px 1px 1px; border-style: solid;' width='100%' cellspacing='0' cellpadding='0' bgcolor='#fef9ef'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-text es-p20t es-p10b es-p20r es-p20l' align='left'>
                                                                                                <h4>SUMMARY:</h4>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class='esd-block-text es-p20b es-p20r es-p20l' align='left'>
                                                                                                <table style='width: 100%;' class='cke_show_border' cellspacing='1' cellpadding='1' border='0' align='left'>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td><span style='font-size: 14px; line-height: 150%;'>Order #:</span></td>
                                                                                                            <td><span style='font-size: 14px; line-height: 150%;'>$orderid </span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td><span style='font-size: 14px; line-height: 150%;'>Order Date:</span></td>
                                                                                                            <td><span style='font-size: 14px; line-height: 150%;'>$current_date</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td><span style='font-size: 14px; line-height: 150%;'>Order Total:</span></td>
                                                                                                            <td><span style='font-size: 14px; line-height: 150%;'> $total </span></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <p style='line-height: 150%;'><br></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td><td width='0'></td><td width='280' valign='top'><![endif]-->
                                                                <table class='es-right' cellspacing='0' cellpadding='0' align='right'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='esd-container-frame' width='280' align='left'>
                                                                                <table style='background-color: #fef9ef; border-collapse: separate; border-width: 1px; border-style: solid; border-color: #efefef;' width='100%' cellspacing='0' cellpadding='0' bgcolor='#fef9ef'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-text es-p20t es-p10b es-p20r es-p20l' align='left'>
                                                                                                <h4>SHIPPING ADDRESS:<br></h4>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class='esd-block-text es-p20b es-p20r es-p20l' align='left'>
                                                                                                <p>$cust_name</p>
                                                                                                <p>$street</p>
                                                                                                <p>$loc</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td></tr></table><![endif]-->
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class='es-content' cellspacing='0' cellpadding='0' align='center'>
                                    <tbody>
                                        <tr>
                                            <td class='esd-stripe' esd-custom-block-id='1758' align='center'>
                                                <table class='es-content-body' width='600' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center'>
                                                    <tbody>
                                                        <tr>
                                                            <td class='esd-structure es-p10t es-p10b es-p20r es-p20l' esd-general-paddings-checked='false' align='left'>
                                                                <!--[if mso]><table width='560' cellpadding='0' cellspacing='0'><tr><td width='270' valign='top'><![endif]-->
                                                                <table class='es-left' cellspacing='0' cellpadding='0' align='left'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='es-m-p0r es-m-p20b esd-container-frame' width='270' valign='top' align='center'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-text es-p20l' align='left'>
                                                                                                <h4>Product Name</h4>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td><td width='20'></td><td width='270' valign='top'><![endif]-->
                                                                <table cellspacing='0' cellpadding='0' align='right'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='esd-container-frame' width='270' align='left'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-text' align='left'>
                                                                                                <table style='width: 100%;' class='cke_show_border' cellspacing='1' cellpadding='1' border='0'>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                           
                                                                                                            <td style='text-align: center;' width='60'><span style='font-size:13px;'><span style='line-height: 100%;'>QUANTITY</span></span></td>
                                                                                                            <td style='text-align: center;' width='100'><span style='font-size:13px;'><span style='line-height: 100%;'>PRICE</span></span></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td></tr></table><![endif]-->
                                                            </td>
                                                        </tr>
                                                        <!--line-->
                                                        <tr>
                                                            <td class='esd-structure es-p20r es-p20l' esd-general-paddings-checked='false' align='left'>
                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='esd-container-frame' width='560' valign='top' align='center'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-spacer es-p10b' align='center' style='font-size:0'>
                                                                                                <table width='100%' height='100%' cellspacing='0' cellpadding='0' border='0'>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td style='border-bottom: 1px solid #efefef; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;'></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <!--table row-->";
                                                        foreach($cart as $key => $value) {
                                                            //echo $key . ' : ' . $value['quantity'] .'<br>';
                                                            $ordsql = "SELECT * FROM products WHERE id= $key";
                                                            $ordres = mysqli_query($connection, $ordsql);
                                                            $ordr = mysqli_fetch_assoc($ordres);
                                                            $productname=$ordr['name'];
                                                            $productprice = $ordr['price'];
                                                            $quantity = $value['quantity'];
                                                            $thumb =$ordr['thumb'];

                                                    $message .= "<tr>
                                                            <td class='esd-structure es-p5t es-p10b es-p20r es-p20l' esd-general-paddings-checked='false' align='left'>
                                                                <!--[if mso]><table width='560' cellpadding='0' cellspacing='0'><tr><td width='178' valign='top'><![endif]-->
                                                                <table class='es-left' cellspacing='0' cellpadding='0' align='left'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='es-m-p0r es-m-p20b esd-container-frame' width='178' valign='top' align='center'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                        <td>$productname</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td><td width='20'></td><td width='362' valign='top'><![endif]-->
                                                                <table cellspacing='0' cellpadding='0' align='right'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='esd-container-frame' width='362' align='left'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-text' align='left'>
                                                                                                <p><br></p>
                                                                                                <table style='width: 100%;' class='cke_show_border' cellspacing='1' cellpadding='1' border='0'>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            
                                                                                                            <td style='text-align: center;' width='150'>$quantity</td>
                                                                                                            <td style='text-align: center;' width='80'>$ $productprice</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <p><br></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td></tr></table><![endif]-->
                                                            </td>
                                                        </tr>";
                                                        
                                                        }
                                                        
                                                    
                                              $message .="<tr>
                                                            <td class='esd-structure es-p5t es-p10b es-p20r es-p20l' esd-general-paddings-checked='false' align='left'>
                                                                <!--[if mso]><table width='560' cellpadding='0' cellspacing='0'><tr><td width='178' valign='top'><![endif]-->
                                                                <table class='es-left' cellspacing='0' cellpadding='0' align='left'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='es-m-p0r es-m-p20b esd-container-frame' width='178' valign='top' align='center'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align='center' class='esd-empty-container' style='display: none;'></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td><td width='20'></td><td width='362' valign='top'><![endif]-->
                                                                <table cellspacing='0' cellpadding='0' align='right'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='esd-container-frame' width='362' align='left'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align='center' class='esd-empty-container' style='display: none;'></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td></tr></table><![endif]-->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class='esd-structure es-p20r es-p20l' esd-general-paddings-checked='false' align='left'>
                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='esd-container-frame' width='560' valign='top' align='center'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-spacer es-p10b' align='center' style='font-size:0'>
                                                                                                <table width='100%' height='100%' cellspacing='0' cellpadding='0' border='0'>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td style='border-bottom: 1px solid #efefef; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;'></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class='esd-structure es-p5t es-p30b es-p40r es-p20l' align='left'>
                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='esd-container-frame' width='540' valign='top' align='center'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-text' align='right'>
                                                                                                <table style='width: 500px;' class='cke_show_border' cellspacing='1' cellpadding='1' border='0' align='right'>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td style='text-align: right; font-size: 18px; line-height: 150%;'>Subtotal (3 items):</td>
                                                                                                            <td style='text-align: right; font-size: 18px; line-height: 150%;'>$ $total</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td style='text-align: right; font-size: 18px; line-height: 150%;'>Flat-rate Shipping:</td>
                                                                                                            <td style='text-align: right; font-size: 18px; line-height: 150%; color: #d48344;'><strong>FREE</strong></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td style='text-align: right; font-size: 18px; line-height: 150%;'>Discount:</td>
                                                                                                            <td style='text-align: right; font-size: 18px; line-height: 150%;'>$0.00</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td style='text-align: right; font-size: 18px; line-height: 150%;'><strong>Order Total:</strong></td>
                                                                                                            <td style='text-align: right; font-size: 18px; line-height: 150%; color: #d48344;'><strong>$ $total</strong></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <p style='line-height: 150%;'><br></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding='0' cellspacing='0' class='es-footer' align='center'>
                                    <tbody>
                                        <tr>
                                            <td class='esd-stripe' esd-custom-block-id='1748' align='center'>
                                                <table class='es-footer-body' width='600' cellspacing='0' cellpadding='0' align='center'>
                                                    <tbody>
                                                        <tr>
                                                            <td class='esd-structure es-p20' esd-general-paddings-checked='false' align='left'>
                                                                <!--[if mso]><table width='560' cellpadding='0' cellspacing='0'><tr><td width='178' valign='top'><![endif]-->
                                                                <table class='es-left' cellspacing='0' cellpadding='0' align='left'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='es-m-p0r es-m-p20b esd-container-frame' width='178' valign='top' align='center'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-image es-m-p0l es-m-txt-c' align='left' style='font-size:0'><h2><strong>myBasket<i class='fa fa-shopping-basket' aria-hidden='true'></i></strong></h2></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class='esd-block-text es-p10t es-p5b es-m-txt-c' align='left'>
                                                                                                <p>Po Box 3453 Colins St.</p>
                                                                                                <p>Ceduna 4096 Australia</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class='esd-block-text es-p5t es-m-txt-c' align='left'>
                                                                                                <p><a target='_blank' href='tel:123456789'>123456789</a><br><a target='_blank' href='mailto:your@mail.com'>your@mail.com</a></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td><td width='20'></td><td width='362' valign='top'><![endif]-->
                                                                <table cellspacing='0' cellpadding='0' align='right'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='esd-container-frame' width='362' align='left'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class='esd-block-text es-p15t es-p20b es-m-txt-c' align='left'>
                                                                                                <p style='line-height: 150%;'><span style='font-size: 20px; line-height: 150%;'>Information</span></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class='esd-block-text es-m-txt-c' align='left'>
                                                                                                <p>Vector graphics designed by <a target='_blank' href='http://www.freepik.com/'>Freepik</a>.<br></p>
                                                                                                <p>You are receiving this email because you have visited our site or asked us about regular newsletter<br></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align='left' class='esd-block-text es-p10t es-m-txt-c'>
                                                                                                <p style='line-height: 150%; font-size: 12px;'><a target='_blank' href style='line-height: 150%; font-size: 12px;' class='unsubscribe'>Unsubscribe</a> ♦ <a target='_blank' href='https://viewstripo.email' style='font-size: 12px;'>Update Preferences</a> ♦ <a target='_blank' href='https://viewstripo.email' style='font-size: 12px;'>Customer Support</a></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td></tr></table><![endif]-->
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </body>
        
        </html>";




        // $message = '<html><body>';
        // $message .='
        // <h1>Order Details<h1>
        // <p>Your order $orderid has been placed successfully.</p>
        // </br>
        // <table rules='all' style='border-color: #666;' cellpadding='10'> 
        // <tr style='background: #eee';><th>id</th><th>name</th><th>price</th><th>quantity</th></tr>';
        // foreach ($cart as $key => $value) {
        //     //echo $key . ' : ' . $value['quantity'] .'<br>';
        //     $ordsql = 'SELECT * FROM products WHERE id=$key';
        //     $ordres = mysqli_query($connection, $ordsql);
        //     $ordr = mysqli_fetch_assoc($ordres);

        //     $pid = $ordr['id'];
        //     $pname = $ordr['name'];
        //     $productprice = $ordr['price'];
        //     $quantity = $value['quantity'];
        //     $message .= '<tr><td>$pid</td><td>$pname</td><td>$productprice</td><td>$quantity</td></tr>';
            
        // }
        // $message .='</table>';
        // $message .= '</body></html>';
        $header = "From:vckoushiksiva@gmail.com \r\n";    
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html;charset=UTF-8\r\n";
        mail ($to,$subject,$message,$header);


        
        
      
}



?>

