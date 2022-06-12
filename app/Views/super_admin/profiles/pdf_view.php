<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Resume <?= $profile['full_name']; ?></title>

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font: 16px Helvetica, Sans-Serif;
            line-height: 24px;
            background: url(images/noise.jpg);
        }

        .clear {
            clear: both;
        }

        #page-wrap {
            width: 800px;
            margin: 40px auto 60px;
        }

        #pic {
            float: right;
            margin: -30px 0 0 0;
        }

        h1 {
            margin: 0 0 16px 0;
            padding: 0 0 16px 0;
            font-size: 42px;
            font-weight: bold;
            letter-spacing: -2px;
            border-bottom: 1px solid #999;
        }

        h2 {
            font-size: 20px;
            margin: 0 0 6px 0;
            position: relative;
        }

        h2 span {
            position: absolute;
            bottom: 0;
            right: 0;
            font-style: italic;
            font-family: Georgia, Serif;
            font-size: 16px;
            color: #999;
            font-weight: normal;
        }

        p {
            margin: 0 0 16px 0;
        }

        a {
            color: #999;
            text-decoration: none;
            border-bottom: 1px dotted #999;
        }

        a:hover {
            border-bottom-style: solid;
            color: black;
        }

        ul {
            margin: 0 0 32px 17px;
        }

        #objective {
            width: 500px;
            float: left;
        }

        #objective p {
            font-family: Georgia, Serif;
            font-style: italic;
            color: #666;
        }

        dt {
            font-style: italic;
            font-weight: bold;
            font-size: 18px;
            text-align: right;
            padding: 0 26px 0 0;
            width: 150px;
            float: left;
            height: 100px;
            border-right: 1px solid #999;
        }

        dd {
            width: 600px;
            float: right;
        }

        dd.clear {
            float: none;
            margin: 0;
            height: 15px;
        }
    </style>
</head>

<body>
    <div id="page-wrap">
        <img src="<?= $photoProfile; ?>" alt="Photo" id="pic" width="200" style="margin-top: 60px;">

        <div id="contact-info" class="vcard">
            <!-- Microformats! -->

            <h1 class="fn"><?= $profile['full_name']; ?></h1>
            <h3><?= $profile['position']; ?></h3>
            <br>
            <p>
                <?= $profile['location']; ?>
                <br>
                <span>
                    <?= $profile['contact']; ?>
                </span>
            </p>
        </div>

        <div id="objective">
            <p>
                <?= $profile['summary']; ?>
            </p>
        </div>

        <div class="clear"></div>

        <dl>
            <dd class="clear"></dd>

            <dt>Education</dt>
            <dd>
                <?= $profile['education']; ?>
            </dd>

            <dd class="clear"></dd>

            <dt>Skills</dt>
            <dd>
                <?= $profile['skills']; ?>
            </dd>

            <dd class="clear"></dd>

            <dt>Experience</dt>
            <dd>
                <?= $profile['work_experiece']; ?>
            </dd>

            <dd class="clear"></dd>

            <dt>Portofolio</dt>
            <dd>
                <?= $profile['portofolio']; ?>
            </dd>

            <dd class="clear"></dd>
        </dl>

        <div class="clear"></div>
    </div>
</body>

</html>