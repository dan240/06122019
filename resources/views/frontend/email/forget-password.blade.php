<!DOCTYPE html>
<html>

<head>
    <title></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .padding {
            padding-left: 40px !important;
            padding-right: 40px !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width: 525px) {

            /* ALLOWS FOR FLUID TABLES */
            .wrapper {
                width: 100% !important;
                max-width: 100% !important;
            }

            /* ADJUSTS LAYOUT OF LOGO IMAGE */
            .logo img {
                margin: 0 auto !important;
            }

            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
            .mobile-hide {
                display: none !important;
            }

            .img-max {
                max-width: 100% !important;
                width: 100% !important;
                height: auto !important;
            }

            /* FULL-WIDTH TABLES */
            .responsive-table {
                width: 100% !important;
            }

            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
            .padding {
                padding: 10px 5% 15px 5% !important;
            }

            .padding-meta {
                padding: 30px 5% 0px 5% !important;
                text-align: center;
            }

            .padding-copy {
                padding: 10px 5% 10px 5% !important;
                text-align: center;
            }

            .no-padding {
                padding: 0 !important;
            }

            .section-padding {
                padding: 0px 15px 15px 15px !important;
            }

            /* ADJUST BUTTONS ON MOBILE */
            .mobile-button-container {
                margin: 0 auto;
                width: 100% !important;
            }

            .mobile-button {
                padding: 15px !important;
                border: 0 !important;
                font-size: 16px !important;
                display: block !important;
            }

        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="margin: 0 !important; padding: 0 !important; background: #f2f2f2">

    <!--<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    Entice the open with some amazing preheader text. Use a little mystery and get those subscribers to read through...
</div>-->

    <!-- HEADER -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#f2f2f2" align="center">

                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                    style="max-width: 500px; margin-top: 30px;" class="wrapper">
                    <tr>
                        <td align="center" valign="top" style="padding: 15px 0;background: #fff;" class="logo">
                            <a href="#" target="_blank">
                                <img alt="Logo" src="{{ asset('images/Logo_LondCap.png')}}" width="160" height="auto"
                                    style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;"
                                    border="0">
                            </a>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
            <td bgcolor="#f2f2f2" align="center" style="padding: 0px 15px 0px 15px;" class="section-padding">
                <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                    style="max-width: 500px; background: #fff;" class="responsive-table">
                    <tr>
                        <td>
                            <!-- HERO IMAGE -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center"
                                        style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px; font-weight: 600">
                                        We have received a request to change your password.</td>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- COPY -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="left"
                                                    style="font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;"
                                                    class="padding">
                                                    <p>Hi {{@$userData['name']}},</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left"
                                                    style="padding: 0px 0 0 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;"
                                                    class="padding">
                                                    <p>Use this link to setup a new password to your account. This link
                                                        will expire in 4 hours.</p>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <!-- BULLETPROOF BUTTON -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="padding-top: 25px;padding-bottom: 25px;"
                                                    class="padding">
                                                    <table border="0" cellspacing="0" cellpadding="0"
                                                        class="mobile-button-container">
                                                        <tr>
                                                            <td align="center" style="border-radius: 0px;"
                                                                bgcolor="#002060"><a
                                                                    href="{{ url('User/resetPassword/').'/'.$userData['email']}}"
                                                                    target="_blank"
                                                                    style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 12px 30px; border: 1px solid #256F9C; display: inline-block;"
                                                                    class="mobile-button">Change Password</a></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left"
                                                    style="padding: 0px 0 0 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;"
                                                    class="padding">
                                                    <p>If you did not make this request, you do not need to do anything.
                                                    </p>
                                                </td>    
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- COPY -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="left"
                                                    style="padding: 0px 0 0 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;"
                                                    class="padding">
                                                    <p style="margin-bottom: 0px">Thank you,</p>
                                                    <p style="margin-top: 0px; margin-bottom: 20px"> The LondCap Team.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </td>
        </tr>
        <tr>
            <td bgcolor="#f2f2f2" align="center" style="padding: 20px 0px;">

                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 500px;"
                    class="responsive-table">
                    <tr>
                        <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
                            <a href="mailto:unsubscribe@londcap.com" target="_blank" style="color: #666666; text-decoration: none;">Unsubscribe</a>
                            <br>Level 33, 25 Canada Square, London, E14 5LQ, United Kingdom
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>
