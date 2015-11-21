<?//die2($d['items'])?>
<style>
.list .title {
height: 45px;
display: table;
}
.list .date,
.list .tit {
display: table-cell;
vertical-align: middle;
}
.list .tit {
padding-left: 7px;
}
.list .date {
font-size: 12px;
width: 50px;
border-right: 1px solid #ccc;
}
.text img {
max-width: 100%;
}
</style>

<div class="frame">
  <div class="list">
    <? foreach ($d['items'] as $v) { ?>
    <div class="item" data-id="<?= $v['id'] ?>">
      <div class="title">
        <div class="date">
          <?= date('d', $v['eventDate_tStamp']).' '.mb_substr(Config::getVarVar('ruMonths', date('n')), 0, 3, CHARSET) ?>
          <br><?= preg_replace('/(\d+:\d+):\d+/', '$1', $v['eventTime']) ?>
        </div>
        <div class="tit"><?= $v['title'] ?></div>
        <div style="clear:both"></div>
      </div>
      <div class="text">
        <? if ($v['md_image']) { ?>
          <p><img src="<?= $v['md_image']?>"></p>
        <? } ?>
        <? if ($v['place']) { ?>
          <p><b>Место:</b> <?= $v['place'] ?></p>
        <? } ?>
        <? if ($v['price']) { ?>
          <p><b>Вход:</b> <?= $v['price'] ?></p>
        <? } ?>
        <p><b>Дата, время:</b> <?= Date::str($v['eventDate_tStamp']).' в '.preg_replace('/(\d+:\d+):\d+/', '$1', $v['eventTime']) ?></p>
        <?= $v['text'] ?>
      </div>
    </div>
    <? } ?>
  </div>
</div>

<script>
new Ngn.ListSlider(
  new Ngn.FramesSlider.List(document.getElement('#body')), {
    itemTitleSelector: '.title .tit'
  }
);
</script>
