<?php

class CtrlAfishaDefault extends CtrlMimlList {
  use DdCrudParamFilterCtrl;

  // from CtrlThemeFourDd

  protected function id() {
    return $this->req->rq('id');
  }

  protected function getStrName() {
    return $this->themeFourModule();
  }

  // from CtrlAfishaDefault

  protected function themeFourModule() {
    return 'afisha';
  }

  protected function paramFilterN() {
    return 0;
  }

  protected function paramFilterDateField() {
    return 'eventDate';
  }

  // ...

  function action_default() {
    $items = $this->items();
    $items->setN(100);
    $this->d['items'] = $_items = $items->getItems();
    $this->d['body'] = Tt()->getTpl('afisha/list', $this->d);
    //
    $items->cond->setOrder('eventDate DESC, eventTime');
    $_items = $items->getItems();
    $this->d['today'] = $this->setFilterDate(date('j;n;Y'), 'eventDate', true);
    if ($this->day) {
      $cnt = ' ('.count($_items).' шт.)';
      if (in_array('dateCreate', $this->items->cond->filterKeys) and $this->day == date('j') and $this->month == date('n') and $this->year == date('Y')) {
        $this->setPageTitle('Добавлено сегодня'.$cnt);
      }
      else {
        if ($this->d['today']) {
          $this->setPageTitle('Сегодня '.$cnt);
        }
        else {
          $this->setPageTitle($this->day.' '.Config::getVar('ruMonths2')[$this->month].' '.$this->year.$cnt);
        }
      }
    }
    elseif ($this->month) {
      $this->setPageTitle(Config::getVar('ruMonths')[$this->month].' '.$this->year);
    }
    $this->d['menu'][] = [
      'title' => 'Сегодня',
       'link' => '/afisha'
    ];
    // special mobile calendar data
//    $calendar = new AfishaCalendar('');
//    $month = $this->month ?: date('n');
//    $year = $this->year ?: date('Y');
//    $r = $calendar->getDaysDataExists($month, $year);
//    sort($r);
//    foreach ($r as $day) {
//      $this->d['menu'][] = [
//        'title' => "$day ".Config::getVar('ruMonths2')[$month],
//        'link'  => "/afisha/d.$day;$month;$year"
//      ];
//    }
  }

}