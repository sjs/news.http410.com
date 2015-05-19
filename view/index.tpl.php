<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Four-One-Oh</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/css/http410.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>

    <div id="hn-front" class="container">

        <div class="row title">
            <div class="col-sm-12">
                <h3><a href="https://news.ycombinator.com">Hacker News</a> <button class="btn btn-link" onClick="refresh_feed('hn-front')"><i class="fa fa-fw fa-refresh"></i></button></h3>
            </div>
        </div>
        <div class="row feed">

<? $chunks = array_chunk($this->hn_front->channel->item, 10); ?>

            <? foreach($chunks as $chunk) { ?>
    
                <div class="column col-xs-12 col-sm-4">

                    <? foreach($chunk as $item) { ?>

                        <article>
                            <a href="<?= $item->comments; ?>"><i class="fa fa-fw fa-comments"></i></a>
                            <a href="<?= $item->link; ?>"><?= $item->title; ?></a>
                        </article>

                    <? } ?>

                </div>

            <? } ?>

        </div>
    </div><!-- /.container -->

    <div class="container">

        <div class="row">
            <div id='hn-ask' class="col-sm-12 col-md-4">
                <div class="row title">
                    <div class="col-sm-12">
                        <h3><a href="https://news.ycombinator.com/ask">Ask HN</a> <button class="btn btn-link" onClick="refresh_feed('hn-front')"><i class="fa fa-fw fa-refresh"></i></h3>
                    </div>
                </div>
                <div class="row feed">

<? $chunks = array_chunk($this->hn_ask->channel->item, 10); ?>

                    <div class="column col-xs-12">

                        <? foreach($chunks[0] as $item) { ?>

                            <article>
                                <a href="<?= $item->comments; ?>"><i class="fa fa-fw fa-comments"></i></a>
                                <a href="<?= $item->link; ?>"><?= $item->title; ?></a>
                            </article>

                        <? } ?>

                    </div>

                </div>
            </div>
            <div id='hn-show' class="col-sm-12 col-md-4">
                <div class="row title">
                    <div class="col-sm-12">
                        <h3><a href="https://news.ycombinator.com/show">Show HN</a> <button class="btn btn-link" onClick="refresh_feed('hn-front')"><i class="fa fa-fw fa-refresh"></i></h3>
                    </div>
                </div>
                <div class="row feed">

<? $chunks = array_chunk($this->hn_show->channel->item, 10); ?>

                    <div class="column col-xs-12">

                        <? foreach($chunks[0] as $item) { ?>

                            <article>
                                <a href="<?= $item->comments; ?>"><i class="fa fa-fw fa-comments"></i></a>
                                <a href="<?= $item->link; ?>"><?= $item->title; ?></a>
                            </article>

                        <? } ?>

                    </div>

                </div>
            </div>
            <div id='dn-front' class="col-sm-12 col-md-4">
                <div class="row title">
                    <div class="col-sm-12">
                        <h3><a href="https://news.layervault.com">Designer News</a> <button class="btn btn-link" onClick="refresh_feed('hn-front')"><i class="fa fa-fw fa-refresh"></i></h3>
                    </div>
                </div>
                <div class="row feed">

<? $chunks = array_chunk($this->dn_front->channel->item, 10); ?>

                    <div class="column col-xs-12">

                        <? foreach($chunks[0] as $item) { ?>

                            <? if (filter_var(trim($item->description), FILTER_VALIDATE_URL) !== false) { ?>

                                <article>
                                    <a href="<?= str_replace('/click','',$item->link); ?>"><i class="fa fa-fw fa-comments"></i></a>
                                    <a href="<?= trim($item->description); ?>"><?= $item->title; ?></a>
                                </article>

                            <? } else { ?>

                                <article>
                                    <a href="<?= str_replace('/click','',$item->link); ?>"><i class="fa fa-fw fa-comments"></i></a>
                                    <a href="<?= str_replace('/click','',$item->link); ?>"><?= $item->title; ?></a>
                                </article>

                            <? } ?>

                        <? } ?>

                    </div>

                </div>
            </div>
        </div>
    </div><!-- /.container -->

    <div id="lobsters" class="container">

        <div class="row title">
            <div class="col-sm-12">
                <h3><a href="https://lobste.rs">Lobste.rs</a> <button class="btn btn-link" onClick="refresh_feed('hn-front')"><i class="fa fa-fw fa-refresh"></i></h3>
            </div>
        </div>
        <div class="row feed">

<? $chunks = array_chunk($this->lobsters->channel->item, 8); ?>

            <? foreach($chunks as $chunk) { ?>

                <div class="column col-xs-12 col-sm-4">

                    <? foreach($chunk as $item) { ?>

                        <article>
                            <a href="<?= $item->comments; ?>"><i class="fa fa-fw fa-comments"></i></a>
                            <a href="<?= $item->link; ?>"><?= $item->title; ?></a>
                        </article>

                    <? } ?>

                </div>

            <? } ?>

        </div>
    </div><!-- /.container -->

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/http410.js"></script>

  </body>
</html>
