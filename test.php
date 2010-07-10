<?php
require 'Xlib.php';

$x = XDisplay::create();
$bc = $x->allocColor($x->screens[0]->colormap, 0xeeee, 0xeeee, 0xffff);
$wnd = $x->createWindow($x->screens[0]->rootWindow,
        64, 64, 420, 240, 0, XClient::InputOutput, null,
        array('backgroundPixel' => $bc['pixel'],
              'eventMask' => XClient::ExposureMask
                             | XClient::PointerMotionMask
                             | XClient::StructureNotifyMask));

$gc = $wnd->createGC(
        array('function' => 3, 'lineWidth' => 8, 'lineStyle' => 0));
$x->mapWindow($wnd);

function drawEye($wnd, $gc, $x, $y, $width, $height, $px, $py) {
    $wnd->changeGC($gc, array('foreground' => $wnd->display->screens[0]->whitePixel));
    $wnd->fillArc($gc, $x, $y, $width, $height);
    $wnd->changeGC($gc, array('foreground' => $wnd->display->screens[0]->blackPixel));
    $wnd->drawArc($gc, $x, $y, $width, $height);
    $cx = $x + $width / 2; $cy = $y + $height / 2;
    $vx = $px - $cx; $vy = $py - $cy;
    $a = 2 / $width + pow($vy / $vx, 2) * 2 / $height;
    if ($a) {
        $c = ($width / 30) * sqrt($a) / $a / abs($vx);
        $iwidth = $width / 10; $iheight = $height / 10;
        $ix = $cx + $vx * $c - $iwidth / 2; $iy = $cy + $vy * $c - $iheight / 2;
        $wnd->fillArc($gc, (int)$ix, (int)$iy, $iwidth, $iheight);
    }
}

$width = 640; $height = 480;
$px = 320; $py = 240;
for (;;) {
    switch ($x->nextEvent($ev)) {
    case XClient::Expose:
        drawEye($wnd, $gc, 0, 0, $width / 2, $height, $px, $py);
        drawEye($wnd, $gc, $width / 2, 0, $width / 2, $height, $px, $py);
        break;
    case XClient::MotionNotify:
        $px = $ev['eventX']; $py = $ev['eventY'];
        drawEye($wnd, $gc, 0, 0, $width / 2, $height, $px, $py);
        drawEye($wnd, $gc, $width / 2, 0, $width / 2, $height, $px, $py);
        break;
    case XClient::ConfigureNotify:
        $width = $ev['width']; $height = $ev['height'];
        break;
    }
}
