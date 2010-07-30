<?php
require 'Xlib.php';

$font = "/Library/Fonts/Hiragino Sans GB W6.otf";

$x = XDisplay::create();
$bc = $x->allocColor($x->screens[0]->colormap, 0xffff, 0xffff, 0xffff);
$wnd = $x->createWindow($x->screens[0]->rootWindow,
        0, 0, $x->screens[0]->width, $x->screens[0]->height, 0, XClient::InputOutput, null,
        array('backgroundPixel' => $bc['pixel'],
              'eventMask' => XClient::ExposureMask
                             | XClient::KeyPressMask
                             | XClient::StructureNotifyMask,
              'overrideRedirect' => true));
$_motif_wm_hints = $x->internAtom("_MOTIF_WM_HINTS");
$wnd->changeProperty(XClient::PropModeReplace, $_motif_wm_hints, $_motif_wm_hints, 32, "\x00\x00\x00\x02\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00");

$gc = $wnd->createGC(
        array('function' => 3, 'lineWidth' => 8, 'lineStyle' => 0));
$x->mapWindow($wnd);

$im = imagecreatetruecolor($x->screens[0]->width, $x->screens[0]->height);

function imageToBitmap($im) {
    ob_start();
    imagegd2($im, NULL, 64);
    $data = ob_get_clean();
    return substr($data, 18 + 1 + 4);
}

function drawText($text, $sz) {
    global $im, $font;
    $white = imagecolorallocate($im, 255, 255, 255);
    $black = imagecolorallocate($im, 0, 0, 0);
    imagefill($im, 0, 0, $white);
    $bbox = imagettfbbox($sz, 0, $font, $text);
    imagettftext($im, $sz, 0, (imagesx($im) - $bbox[2]) / 2, (imagesy($im) - $bbox[3]) / 2, $black, $font, $text);
    return imageToBitmap($im);
}

function drawImage($wnd, $gc, $x, $y, $width, $height, $data) {
    $ncx = (int)($width / 64);
    $ncy = (int)($height / 64);
    for ($j = 0; $j < $ncy; $j++) {
        $ch = min(64, $height - $j * 64);
        for ($i = 0; $i < $ncx; $i++) {
            $cw = min(64, $width - $i * 64);
            $wnd->putImage(2, $gc, $cw, $ch, $x + $i * 64, $y + $j * 64, 0, 24, substr($data, $i * 16384 + $j * $width * 256, 16384));
        }
    }
}

$data = drawText("テスト", 128);

for (;;) {
    switch ($x->nextEvent($ev)) {
    case XClient::Expose:
        drawImage($wnd, $gc, 0, 0, imagesx($im), imagesy($im), $data);
        break;
    case XClient::KeyPress:
        var_dump("?");
        break;
    case XClient::MotionNotify:
        break;
    }
}
