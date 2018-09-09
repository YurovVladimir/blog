@extends('layouts.app')
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width"/>

    <style type="text/css">

        * {
            margin: 0;
            padding: 0;
            font-size: 100%;
            font-family: 'Avenir Next', "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            line-height: 1.65;
        }

        img {
            max-width: 100%;
            margin: 0 auto;
            display: block;
        }

        body,
        .body-wrap {
            width: 100% !important;
            height: 100%;
            background: #efefef;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
        }

        a {
            color: #71bc37;
            text-decoration: none;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .button {
            display: inline-block;
            color: white;
            background: #71bc37;
            border: solid #71bc37;
            border-width: 10px 20px 8px;
            font-weight: bold;
            border-radius: 4px;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-bottom: 20px;
            line-height: 1.25;
        }

        h1 {
            font-size: 32px;
        }

        h2 {
            font-size: 28px;
        }

        h3 {
            font-size: 24px;
        }

        h4 {
            font-size: 20px;
        }

        h5 {
            font-size: 16px;
        }

        p, ul, ol {
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 20px;
        }

        .container {
            display: block !important;
            clear: both !important;
            margin: 0 auto !important;
            max-width: 580px !important;
        }

        .container table {
            width: 100% !important;
            border-collapse: collapse;
        }

        .container .masthead {
            padding: 80px 0;
            background: #71bc37;
            color: white;
        }

        .container .masthead h1 {
            margin: 0 auto !important;
            max-width: 90%;
            text-transform: uppercase;
        }

        .container .content {
            background: white;
            padding: 30px 35px;
        }

        .container .content.footer {
            background: none;
        }

        .container .content.footer p {
            margin-bottom: 0;
            color: #888;
            text-align: center;
            font-size: 14px;
        }

        .container .content.footer a {
            color: #888;
            text-decoration: none;
            font-weight: bold;
        }

    </style>
</head>

<body style="margin: 0;padding: 0;font-size: 100%;font-family: 'Avenir Next', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;line-height: 1.65;">
<table style="width: 100% !important;height: 100%;background: #efefef;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;">
    <tr>
        <td style="display: block !important;clear: both !important;margin: 0 auto !important;max-width: 580px !important;">
            <!-- Message start -->
            <table style=" width: 100% !important;border-collapse: collapse;">
                <tr>
                    <td align="center" style="padding: 80px 0;background: #71bc37;color: white;">
                        <h1 style="margin: 0 auto !important;max-width: 90%;text-transform: uppercase;">Something
                            Big...</h1>
                    </td>
                </tr>
                <tr>
                    <td style="background: white;padding: 30px 35px;">
                        <h2>Hi ,</h2>
                        @foreach($posts as $post)
                            <h2 style="font-size: 28px;">
                                {{ $post->name }}
                            </h2>
                            <br>
                            @foreach($post->comments->take(5) as $comment)
                                @php /** @var \App\Models\Comment $comment */ @endphp
                                <div style="background: white;padding: 30px 35px;">
                                    <div class="card-body">
                                        <h2 style="font-size: 28px;">
                                            {{ $comment->text }}
                                        </h2>
                                        <div class="card-text text-right">
                                            <h3 style="font-size: 24px;">
                                                {{ $comment->user->name }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                        @endforeach
                        <table>
                            <tr>
                                <td align="center">
                                    <p style="margin-bottom: 0;
                                    color: #888;
                                    text-align: center;
                                    font-size: 14px;">
                                        <a href="#"
                                           style="display: inline-block;color: white;background: #71bc37;border: solid #71bc37;border-width: 10px 20px 8px;font-weight: bold;border-radius: 4px;">Share
                                            the Awesomeness</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="display: block !important;clear: both !important;margin: 0 auto !important;max-width: 580px !important;">
            <!-- Message start -->
            <table>
                <tr>
                    <td style="background: none;" align="center">
                        <p style="margin-bottom: 0;
                                    color: #888;
                                    text-align: center;
                                    font-size: 14px;">Sent by <a
                                    style="color: #888;text-decoration: none;font-weight: bold;">Company Name</a>, 1234
                            Yellow Brick Road, OZ, 99999</p>
                        <p style="margin-bottom: 0;
                                    color: #888;
                                    text-align: center;
                                    font-size: 14px;"><a style="color: #888;text-decoration: none;font-weight: bold;">hello@company.com</a>
                            |
                            <a href="#">Unsubscribe</a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>