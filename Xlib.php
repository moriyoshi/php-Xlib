<?php
class InvalidArgument extends Exception {}

class IOException extends Exception {
    public function __construct($errstr, $errno = -1) {
        parent::__construct($errstr);
        $this->errno = $errno;
    }
}

class XClientException extends Exception {}

class XProtocolException extends Exception {}

interface XAuth {
    function getName();

    function getData();
}

class XHostAuth implements XAuth {
    public function __construct() {}

    public function getName() { return ""; }

    public function getData() { return ""; }
}

class XScreen {
    public $display;
    public $id;
    public $rootWindow;
    public $colormap;
    public $whitePixel;
    public $blackPixel;
    public $currentInputMasks;
    public $width;
    public $height;
    public $widthInMillis;
    public $heightInMillis;
    public $minInstalledMaps;
    public $maxInstalledMaps;
    public $rootVisual;
    public $backingStore;
    public $saveUnders;
    public $rootDepth;
    public $depths;
    public $visuals;

    public function __construct($display, $id) {
        $this->display = $display;
        $this->id = $id;
    }
}

class XVisual {
    public $id;
    public $class;
    public $bitsPerRGB;
    public $colormapEntries;
    public $redMask;
    public $greenMask;
    public $blueMask;

    public function __construct($id) {
        $this->id = $id;
    }
}

class XDrawable {
    public $display;
    public $id;

    public function __construct($display, $id) {
        $this->display = $display;
        $this->id = $id;
    }

    public function getGeometry() {
        return $this->display->getGeometry($this);
    }

    public function createGC($attrs = array()) {
        return $this->display->createGC($this, $attrs);
    }

    public function changeGC($gc, $attrs) {
        $this->display->changeGC($gc, $attrs);
        return $this;
    }

    public function drawArc($gc, $x, $y, $width, $height, $angle1 = 0, $angle2 = 23040) {
        $this->display->drawArc($this, $gc, $x, $y, $width, $height, $angle1, $angle2);
    }

    public function fillArc($gc, $x, $y, $width, $height, $angle1 = 0, $angle2 = 23040) {
        $this->display->fillArc($this, $gc, $x, $y, $width, $height, $angle1, $angle2);
    }
}

class XWindow extends XDrawable {
    public function map() {
        $this->display->mapWindow($this);
        return $this;
    }
}

class XClient {
    const TCP_PORT = 6000;

    const None = 0;
    const ParentRelative = 1;
    const CopyFromParent = 0;
    const PointerWindow = 0;
    const InputFocus = 1;
    const PointerRoot = 1;
    const AnyPropertyType = 0;
    const AnyKey = 0;
    const AnyButton = 0;
    const AllTemporary = 0;
    const CurrentTime = 0;
    const NoSymbol = 0;
    const NoEventMask = 0;
    const KeyPressMask = 1;
    const KeyReleaseMask = 2;
    const ButtonPressMask = 4;
    const ButtonReleaseMask = 8;
    const EnterWindowMask = 16;
    const LeaveWindowMask = 32;
    const PointerMotionMask = 64;
    const PointerMotionHintMask = 128;
    const Button1MotionMask = 256;
    const Button2MotionMask = 512;
    const Button3MotionMask = 1024;
    const Button4MotionMask = 2048;
    const Button5MotionMask = 4096;
    const ButtonMotionMask = 8192;
    const KeymapStateMask = 16384;
    const ExposureMask = 32768;
    const VisibilityChangeMask = 65536;
    const StructureNotifyMask = 131072;
    const ResizeRedirectMask = 262144;
    const SubstructureNotifyMask = 524288;
    const SubstructureRedirectMask = 1048576;
    const FocusChangeMask = 2097152;
    const PropertyChangeMask = 4194304;
    const ColormapChangeMask = 8388608;
    const OwnerGrabButtonMask = 16777216;
    const KeyPress = 2;
    const KeyRelease = 3;
    const ButtonPress = 4;
    const ButtonRelease = 5;
    const MotionNotify = 6;
    const EnterNotify = 7;
    const eaveNotify = 8;
    const FocusIn = 9;
    const FocusOut = 10;
    const KeymapNotify = 11;
    const Expose = 12;
    const GraphicsExpose = 13;
    const NoExpose = 14;
    const VisibilityNotify = 15;
    const CreateNotify = 16;
    const DestroyNotify = 17;
    const UnmapNotify = 18;
    const MapNotify = 19;
    const MapRequest = 20;
    const ReparentNotify = 21;
    const ConfigureNotify = 22;
    const ConfigureRequest = 23;
    const GravityNotify = 24;
    const ResizeRequest = 25;
    const CirculateNotify = 26;
    const CirculateRequest = 27;
    const PropertyNotify = 28;
    const SelectionClear = 29;
    const SelectionRequest = 30;
    const SelectionNotify = 31;
    const ColormapNotify = 32;
    const ClientMessage = 33;
    const MappingNotify = 34;
    const GenericEvent = 35;
    const ASTEvent = 36;
    const ShiftMask = 1;
    const ockMask = 2;
    const ControlMask = 4;
    const Mod1Mask = 8;
    const Mod2Mask = 16;
    const Mod3Mask = 32;
    const Mod4Mask = 64;
    const Mod5Mask = 128;
    const ShiftMapIndex = 0;
    const ockMapIndex = 1;
    const ControlMapIndex = 2;
    const Mod1MapIndex = 3;
    const Mod2MapIndex = 4;
    const Mod3MapIndex = 5;
    const Mod4MapIndex = 6;
    const Mod5MapIndex = 7;
    const Button1Mask = 256;
    const Button2Mask = 512;
    const Button3Mask = 1024;
    const Button4Mask = 2048;
    const Button5Mask = 4096;
    const AnyModifier = 32768;
    const Button1 = 1;
    const Button2 = 2;
    const Button3 = 3;
    const Button4 = 4;
    const Button5 = 5;
    const NotifyNormal = 0;
    const NotifyGrab = 1;
    const NotifyUngrab = 2;
    const NotifyWhileGrabbed = 3;
    const NotifyHint = 1;
    const NotifyAncestor = 0;
    const NotifyVirtual = 1;
    const NotifyInferior = 2;
    const NotifyNonlinear = 3;
    const NotifyNonlinearVirtual = 4;
    const NotifyPointer = 5;
    const NotifyPointerRoot = 6;
    const NotifyDetailNone = 7;
    const VisibilityUnobscured = 0;
    const VisibilityPartiallyObscured = 1;
    const VisibilityFullyObscured = 2;
    const PlaceOnTop = 0;
    const PlaceOnBottom = 1;
    const FamilyInternet = 0;
    const FamilyDECnet = 1;
    const FamilyChaos = 2;
    const FamilyInternet6 = 6;
    const FamilyServerInterpreted = 5;
    const PropertyNewValue = 0;
    const PropertyDelete = 1;
    const ColormapUninstalled = 0;
    const ColormapInstalled = 1;
    const GrabModeSync = 0;
    const GrabModeAsync = 1;
    const GrabSuccess = 0;
    const AlreadyGrabbed = 1;
    const GrabInvalidTime = 2;
    const GrabNotViewable = 3;
    const GrabFrozen = 4;
    const AsyncPointer = 0;
    const SyncPointer = 1;
    const ReplayPointer = 2;
    const AsyncKeyboard = 3;
    const SyncKeyboard = 4;
    const ReplayKeyboard = 5;
    const AsyncBoth = 6;
    const SyncBoth = 7;
    const RevertToNone = 0;
    const RevertToPointerRoot = 1;
    const RevertToParent = 2;
    const Success = 0;	
    const BadRequest = 1;	
    const BadValue = 2;	
    const BadWindow = 3;	
    const BadPixmap = 4;	
    const BadAtom = 5;	
    const BadCursor = 6;	
    const BadFont = 7;	
    const BadMatch = 8;	
    const BadDrawable = 9;	
    const BadAccess = 10;	
    const BadAlloc = 11;	
    const BadColor = 12;	
    const BadGC = 13;	
    const BadIDChoice = 14;	
    const BadName = 15;	
    const Badength = 16;	
    const BadImplementation = 17;	
    const InputOutput = 1;
    const InputOnly = 2;
    const CWBackPixmap = 1;
    const CWBackPixel = 2;
    const CWBorderPixmap = 4;
    const CWBorderPixel = 8;
    const CWBitGravity = 16;
    const CWWinGravity = 32;
    const CWBackingStore = 64;
    const CWBackingPlanes = 128;
    const CWBackingPixel = 256;
    const CWOverrideRedirect = 512;
    const CWSaveUnder = 1024;
    const CWEventMask = 2048;
    const CWDontPropagate = 4096;
    const CWColormap = 8192;
    const CWCursor = 16384;
    const CWX = 1;
    const CWY = 2;
    const CWWidth = 4;
    const CWHeight = 8;
    const CWBorderWidth = 16;
    const CWSibling = 32;
    const CWStackMode = 64;
    const ForgetGravity = 0;
    const NorthWestGravity = 1;
    const NorthGravity = 2;
    const NorthEastGravity = 3;
    const WestGravity = 4;
    const CenterGravity = 5;
    const EastGravity = 6;
    const SouthWestGravity = 7;
    const SouthGravity = 8;
    const SouthEastGravity = 9;
    const StaticGravity = 10;
    const UnmapGravity = 0;
    const NotUseful = 0;
    const WhenMapped = 1;
    const Always = 2;
    const IsUnmapped = 0;
    const IsUnviewable = 1;
    const IsViewable = 2;
    const SetModeInsert = 0;
    const SetModeDelete = 1;
    const DestroyAll = 0;
    const RetainPermanent = 1;
    const RetainTemporary = 2;
    const Above = 0;
    const Below = 1;
    const TopIf = 2;
    const BottomIf = 3;
    const Opposite = 4;
    const Raiseowest = 0;
    const owerHighest = 1;
    const PropModeReplace = 0;
    const PropModePrepend = 1;
    const PropModeAppend = 2;
    const GXclear = 0x0;
    const GXand = 0x1;
    const GXandReverse = 0x2;
    const GXcopy = 0x3;
    const GXandInverted = 0x4;
    const GXnoop = 0x5;
    const GXxor = 0x6;
    const GXor = 0x7;
    const GXnor = 0x8;
    const GXequiv = 0x9;
    const GXinvert = 0xa;
    const GXorReverse = 0xb;
    const GXcopyInverted = 0xc;
    const GXorInverted = 0xd;
    const GXnand = 0xe;
    const GXset = 0xf;
    const ineSolid = 0;
    const ineOnOffDash = 1;
    const ineDoubleDash = 2;
    const CapNotast = 0;
    const CapButt = 1;
    const CapRound = 2;
    const CapProjecting = 3;
    const JoinMiter = 0;
    const JoinRound = 1;
    const JoinBevel = 2;
    const FillSolid = 0;
    const FillTiled = 1;
    const FillStippled = 2;
    const FillOpaqueStippled = 3;
    const EvenOddRule = 0;
    const WindingRule = 1;
    const ClipByChildren = 0;
    const IncludeInferiors = 1;
    const Unsorted = 0;
    const YSorted = 1;
    const YXSorted = 2;
    const YXBanded = 3;
    const CoordModeOrigin = 0;
    const CoordModePrevious = 1;
    const Complex = 0;
    const Nonconvex = 1;
    const Convex = 2;
    const ArcChord = 0;
    const ArcPieSlice = 1;
    const GCFunction = 1;
    const GCPlaneMask = 2;
    const GCForeground = 4;
    const GCBackground = 8;
    const GCineWidth = 16;
    const GCineStyle = 32;
    const GCCapStyle = 64;
    const GCJoinStyle = 128;
    const GCFillStyle = 256;
    const GCFillRule = 512;
    const GCTile = 1024;
    const GCStipple = 2048;
    const GCTileStipXOrigin = 4096;
    const GCTileStipYOrigin = 8192;
    const GCFont = 16384;
    const GCSubwindowMode = 32768;
    const GCGraphicsExposures = 65536;
    const GCClipXOrigin = 131072;
    const GCClipYOrigin = 262144;
    const GCClipMask = 524288;
    const GCDashOffset = 1048576;
    const GCDashist = 2097152;
    const GCArcMode = 4194304;
    const GCastBit = 22;
    const FonteftToRight = 0;
    const FontRightToeft = 1;
    const FontChange = 255;
    const XYBitmap = 0;
    const XYPixmap = 1;
    const ZPixmap = 2;
    const AllocNone = 0;
    const AllocAll = 1;
    const DoRed = 1;
    const DoGreen = 2;
    const DoBlue = 4;
    const CursorShape = 0;
    const TileShape = 1;
    const StippleShape = 2;
    const AutoRepeatModeOff = 0;
    const AutoRepeatModeOn = 1;
    const AutoRepeatModeDefault = 2;
    const edModeOff = 0;
    const edModeOn = 1;
    const KBKeyClickPercent = 1;
    const KBBellPercent = 2;
    const KBBellPitch = 4;
    const KBBellDuration = 8;
    const KBed = 16;
    const KBedMode = 32;
    const KBKey = 64;
    const KBAutoRepeatMode = 128;
    const MappingSuccess = 0;
    const MappingBusy = 1;
    const MappingFailed = 2;
    const MappingModifier = 0;
    const MappingKeyboard = 1;
    const MappingPointer = 2;
    const DontPreferBlanking = 0;
    const PreferBlanking = 1;
    const DefaultBlanking = 2;
    const DisableScreenSaver = 0;
    const DisableScreenInterval = 0;
    const DontAllowExposures = 0;
    const AllowExposures = 1;
    const DefaultExposures = 2;
    const ScreenSaverReset = 0;
    const ScreenSaverActive = 1;
    const HostInsert = 0;
    const HostDelete = 1;
    const EnableAccess = 1;
    const DisableAccess = 0;
    const StaticGray = 0;
    const GrayScale = 1;
    const StaticColor = 2;
    const PseudoColor = 3;
    const TrueColor = 4;
    const DirectColor = 5;
    const SBFirst = 0;
    const MSBFirst = 1;

    const X_CreateWindow = 1;
    const X_ChangeWindowAttributes = 2;
    const X_GetWindowAttributes = 3;
    const X_DestroyWindow = 4;
    const X_DestroySubwindows = 5;
    const X_ChangeSaveSet = 6;
    const X_ReparentWindow = 7;
    const X_MapWindow = 8;
    const X_MapSubwindows = 9;
    const X_UnmapWindow = 10;
    const X_UnmapSubwindows = 11;
    const X_ConfigureWindow = 12;
    const X_CirculateWindow = 13;
    const X_GetGeometry = 14;
    const X_QueryTree = 15;
    const X_InternAtom = 16;
    const X_GetAtomName = 17;
    const X_ChangeProperty = 18;
    const X_DeleteProperty = 19;
    const X_GetProperty = 20;
    const X_ListProperties = 21;
    const X_SetSelectionOwner = 22;
    const X_GetSelectionOwner = 23;
    const X_ConvertSelection = 24;
    const X_SendEvent = 25;
    const X_GrabPointer = 26;
    const X_UngrabPointer = 27;
    const X_GrabButton = 28;
    const X_UngrabButton = 29;
    const X_ChangeActivePointerGrab = 30;
    const X_GrabKeyboard = 31;
    const X_UngrabKeyboard = 32;
    const X_GrabKey = 33;
    const X_UngrabKey = 34;
    const X_AllowEvents = 35;
    const X_GrabServer = 36;
    const X_UngrabServer = 37;
    const X_QueryPointer = 38;
    const X_GetMotionEvents = 39;
    const X_TranslateCoords = 40;
    const X_WarpPointer = 41;
    const X_SetInputFocus = 42;
    const X_GetInputFocus = 43;
    const X_QueryKeymap = 44;
    const X_OpenFont = 45;
    const X_CloseFont = 46;
    const X_QueryFont = 47;
    const X_QueryTextExtents = 48;
    const X_ListFonts = 49;
    const X_ListFontsWithInfo = 50;
    const X_SetFontPath = 51;
    const X_GetFontPath = 52;
    const X_CreatePixmap = 53;
    const X_FreePixmap = 54;
    const X_CreateGC = 55;
    const X_ChangeGC = 56;
    const X_CopyGC = 57;
    const X_SetDashes = 58;
    const X_SetClipRectangles = 59;
    const X_FreeGC = 60;
    const X_ClearArea = 61;
    const X_CopyArea = 62;
    const X_CopyPlane = 63;
    const X_PolyPoint = 64;
    const X_PolyLine = 65;
    const X_PolySegment = 66;
    const X_PolyRectangle = 67;
    const X_PolyArc = 68;
    const X_FillPoly = 69;
    const X_PolyFillRectangle = 70;
    const X_PolyFillArc = 71;
    const X_PutImage = 72;
    const X_GetImage = 73;
    const X_PolyText8 = 74;
    const X_PolyText16 = 75;
    const X_ImageText8 = 76;
    const X_ImageText16 = 77;
    const X_CreateColormap = 78;
    const X_FreeColormap = 79;
    const X_CopyColormapAndFree = 80;
    const X_InstallColormap = 81;
    const X_UninstallColormap = 82;
    const X_ListInstalledColormaps = 83;
    const X_AllocColor = 84;
    const X_AllocNamedColor = 85;
    const X_AllocColorCells = 86;
    const X_AllocColorPlanes = 87;
    const X_FreeColors = 88;
    const X_StoreColors = 89;
    const X_StoreNamedColor = 90;
    const X_QueryColors = 91;
    const X_LookupColor = 92;
    const X_CreateCursor = 93;
    const X_CreateGlyphCursor = 94;
    const X_FreeCursor = 95;
    const X_RecolorCursor = 96;
    const X_QueryBestSize = 97;
    const X_QueryExtension = 98;
    const X_ListExtensions = 99;
    const X_ChangeKeyboardMapping = 100;
    const X_GetKeyboardMapping = 101;
    const X_ChangeKeyboardControl = 102;
    const X_GetKeyboardControl = 103;
    const X_Bell = 104;
    const X_ChangePointerControl = 105;
    const X_GetPointerControl = 106;
    const X_SetScreenSaver = 107;
    const X_GetScreenSaver = 108;
    const X_ChangeHosts = 109;
    const X_ListHosts = 110;
    const X_SetAccessControl = 111;
    const X_SetCloseDownMode = 112;
    const X_KillClient = 113;
    const X_RotateProperties = 114;
    const X_ForceScreenSaver = 115;
    const X_SetPointerMapping = 116;
    const X_GetPointerMapping = 117;
    const X_SetModifierMapping = 118;
    const X_GetModifierMapping = 119;
    const X_NoOperation = 127;

    public function getLocalSocketPath($dpy) {
        return sprintf("/tmp/.X11-unix/X%d", $dpy);
    }

    public function makeConnection($descr) {
        $conn_str = false;
        if ($descr['host'] == "" || $descr['host']{0} == '/') {
            $conn_str = "unix://" . self::getLocalSocketPath($dpy);
        } else {
            $conn_str = sprintf("tcp://%s:%d", $descr['host'], self::TCP_PORT + $descr['display']);
        }
        $conn = stream_socket_client($conn_str, $errno, $errstr);
        if ($conn === false) {
            throw IOException($errstr, $errno);
        }
        return $conn;
    }

    public static function pad($str) {
        return str_pad($str, (strlen($str) + 3) & ~3, "\x00");
    }

    public static function readPadded($conn, $len) {
        return substr(fread($conn, ($len + 3) & ~3), 0, $len);
    }

    public function negotiate($conn, $auth) {
        $packet = pack("Cxnnnnx2", 0x42,
                       $this->majorVersion, $this->minorVersion,
                       strlen($auth_name), strlen($auth_data));
        $packet .= self::pad($auth->getName());
        $packet .= self::pad($auth->getData());
        fwrite($conn, $packet);
        $buf = fread($conn, 8);
        switch (ord($buf{0})) {
        default:
            throw new XProtocolException();
        case 0:
            $data = unpack("Ccode/Clen/nmajor/nminor/nlenx", $buf);
            if ($data['major'] != $this->majorVersion
                    || $data['minor'] != $this->minorVersion)
                throw XProtocolException();
            $reason = substr(fread($conn, $data['lenx'] * 4), 0, $data['len']);
            throw new XClientException($reason);
        case 2:
            $data = unpack("Ccode/x5/nlenx", $buf);
            $reason = rtrim(fread($conn, $data['lenx'] * 4), "\0");
            throw new XClientException($reason);
        case 1:
            $data = unpack("Ccode/Clen/nmajor/nminor/nlenx", $buf);
            if ($data['major'] != $this->majorVersion
                    || $data['minor'] != $this->minorVersion)
                throw XProtocolException();
            $buf = fread($conn, $data['lenx'] * 4);
            $data = unpack("NreleaseNumber/NresourceIdBase/NresourceIdMask/NmotionBufferSize/nlengthOfVendor/nmaxRequestLength/CnumberOfScreens/CnumberOfFormats/CimageByteOrder/CbitmapFormatBitOrder/CbitmapFormatScanlineUnit/CbitmapFormatScanlinePad/CminKeycode/CmaxKeycode/x4", $buf);
            $offset = 32;
            $data['vendor'] = substr($buf, $offset, $data['lengthOfVendor']);
            $offset += ($data['lengthOfVendor'] + 3) & ~3;
            $formats = array();
            for ($i = $data['numberOfFormats']; --$i >= 0;) {
                $formats[] = unpack("x$offset/Cdepth/CbitsPerPixel/CscanlinePad", $buf);
                $offset += 8;
            }
            unset($data['numberOfFormats']);
            $data['formats'] = $formats;
            $screens = array();
            for ($i = $data['numberOfScreens']; --$i >= 0;) {
                $screen = unpack("x$offset/NrootWindow/Ncolormap/NwhitePixel/NblackPixel/NcurrentInputMasks/nwidth/nheight/nwidthInMillis/nheightInMillis/nminInstalledMaps/nmaxInstalledMaps/NrootVisualId/CbackingStore/CsaveUnders/CrootDepth/CnumberOfDepths", $buf);
                $offset += 40;
                $depths = array();
                for ($j = $screen['numberOfDepths']; --$j >= 0;) {
                    $depth = unpack("x$offset/Cdepth/x1/nnumberOfVisualTypes/x4", $buf);
                    $offset += 8;
                    $visual_types = array();
                    for ($k = $depth['numberOfVisualTypes']; --$k >= 0;) {
                        $visual_types[] = unpack("x$offset/Nid/Cclass/CbitsPerRGB/ncolormapEntries/NredMask/NgreenMask/NblueMask", $buf);
                        $offset += 24;
                    }
                    unset($depth['numberOfVisualTypes']);
                    $depth['visualTypes'] = $visual_types;
                    $depths[] = $depth;
                }
                unset($screen['numberOfDepths']);
                $screen['depths'] = $depths;
                $screens[] = $screen;
            }
            unset($data['numberOfScreens']);
            $data['screens'] = $screens;
            return $data;
        }
    }

    public static function parseDisplayName($str) {
        if (!preg_match("#^\s*([^:]*):([^.]+)(?:\\.([^.]*))?\s*$#", $str, $matches))
            throw new InvalidArgument();

        if (!is_numeric($matches[2]))
            throw new InvalidArgument();

        return array(
            "host" => $matches[1],
            "display" => $matches[2],
            "screen" => $matches[3]
        );
    }

    public static function sendPacket($conn, $packet) {
        if (fwrite($conn, $packet) != strlen($packet))
            throw IOException(sprintf("Failed to send %d bytes", strlen($packet)));
    }

    public function sendCreateWindow($conn, $depth, $window, $parent, $x, $y, $width, $height, $border_width, $class, $visual, $attrs) {
        $attr_portion = "";
        $attr_mask = 0;
        if (isset($attrs['backgroundPixmap'])) {
            $attr_portion .= pack('N', $attrs['backgroundPixmap']);
            $attr_mask |= 0x0001;
        }
        if (isset($attrs['backgroundPixel'])) {
            $attr_portion .= pack('N', $attrs['backgroundPixel']);
            $attr_mask |= 0x0002;
        }
        if (isset($attrs['borderPixmap'])) {
            $attr_portion .= pack('N', $attrs['borderPixmap']);
            $attr_mask |= 0x0004;
        }
        if (isset($attrs['borderPixel'])) {
            $attr_portion .= pack('N', $attrs['borderPixel']);
            $attr_mask |= 0x0008;
        }
        if (isset($attrs['bitGravity'])) {
            $attr_portion .= pack('N', $attrs['bitGravity']);
            $attr_mask |= 0x0010;
        }
        if (isset($attrs['winGravity'])) {
            $attr_portion .= pack('N', $attrs['winGravity']);
            $attr_mask |= 0x0020;
        }
        if (isset($attrs['backingStore'])) {
            $attr_portion .= pack('N', $attrs['backingStore']);
            $attr_mask |= 0x0040;
        }
        if (isset($attrs['backingPlanes'])) {
            $attr_portion .= pack('N', $attrs['backingPlanes']);
            $attr_mask |= 0x0080;
        }
        if (isset($attrs['backingPixel'])) {
            $attr_portion .= pack('N', $attrs['backingPixel']);
            $attr_mask |= 0x0100;
        }
        if (isset($attrs['overrideRedirect'])) {
            $attr_portion .= pack('N', $attrs['overrideRedirect']);
            $attr_mask |= 0x0200;
        }
        if (isset($attrs['saveUnder'])) {
            $attr_portion .= pack('N', $attrs['saveUnder']);
            $attr_mask |= 0x0400;
        }
        if (isset($attrs['eventMask'])) {
            $attr_portion .= pack('N', $attrs['eventMask']);
            $attr_mask |= 0x0800;
        }
        if (isset($attrs['doNotPropagateMask'])) {
            $attr_portion .= pack('N', $attrs['doNotPropagateMask']);
            $attr_mask |= 0x1000;
        }
        if (isset($attrs['colormap'])) {
            $attr_portion .= pack('N', $attrs['colormap']);
            $attr_mask |= 0x2000;
        }
        if (isset($attrs['cursor'])) {
            $attr_portion .= pack('N', $attrs['cursor']);
            $attr_mask |= 0x4000;
        }
        $packet = pack("CCnNNnnnnnnNN",
                self::X_CreateWindow, $depth, 8 + strlen($attr_portion) / 4,
                $window, $parent, $x, $y, $width, $height, $border_width,
                $class, $visual, $attr_mask) . $attr_portion;
        self::sendPacket($conn, $packet);
    }

    public function sendMapWindow($conn, $window) {
        $packet = pack("CxnN", self::X_MapWindow, 2, $window);
        self::sendPacket($conn, $packet);
    }

    public function packGCAttributes($attrs) {
        $attr_portion = "";
        $attr_mask = 0;
        if (isset($attrs['function'])) {
            $attr_portion .= pack('N', $attrs['function']);
            $attr_mask |= 0x00000001;
        }
        if (isset($attrs['planeMask'])) {
            $attr_portion .= pack('N', $attrs['planeMask']);
            $attr_mask |= 0x00000002;
        }
        if (isset($attrs['foreground'])) {
            $attr_portion .= pack('N', $attrs['foreground']);
            $attr_mask |= 0x00000004;
        }
        if (isset($attrs['background'])) {
            $attr_portion .= pack('N', $attrs['background']);
            $attr_mask |= 0x00000008;
        }
        if (isset($attrs['lineWidth'])) {
            $attr_portion .= pack('N', $attrs['lineWidth']);
            $attr_mask |= 0x00000010;
        }
        if (isset($attrs['lineStyle'])) {
            $attr_portion .= pack('N', $attrs['lineStyle']);
            $attr_mask |= 0x00000020;
        }
        if (isset($attrs['capStyle'])) {
            $attr_portion .= pack('N', $attrs['capStyle']);
            $attr_mask |= 0x00000040;
        }
        if (isset($attrs['joinStyle'])) {
            $attr_portion .= pack('N', $attrs['joinStyle']);
            $attr_mask |= 0x00000080;
        }
        if (isset($attrs['fillStyle'])) {
            $attr_portion .= pack('N', $attrs['fillStyle']);
            $attr_mask |= 0x00000100;
        }
        if (isset($attrs['fillRule'])) {
            $attr_portion .= pack('N', $attrs['fillRule']);
            $attr_mask |= 0x00000200;
        }
        if (isset($attrs['tile'])) {
            $attr_portion .= pack('N', $attrs['tile']);
            $attr_mask |= 0x00000400;
        }
        if (isset($attrs['stipple'])) {
            $attr_portion .= pack('N', $attrs['stipple']);
            $attr_mask |= 0x00000800;
        }
        if (isset($attrs['tileStippleXOrigin'])) {
            $attr_portion .= pack('N', $attrs['tileStippleXOrigin']);
            $attr_mask |= 0x00001000;
        }
        if (isset($attrs['tileStippleYOrigin'])) {
            $attr_portion .= pack('N', $attrs['tileStippleYOrigin']);
            $attr_mask |= 0x00002000;
        }
        if (isset($attrs['font'])) {
            $attr_portion .= pack('N', $attrs['font']);
            $attr_mask |= 0x00004000;
        }
        if (isset($attrs['subwindowMode'])) {
            $attr_portion .= pack('N', $attrs['subwindowMode']);
            $attr_mask |= 0x00008000;
        }
        if (isset($attrs['graphicsExposures'])) {
            $attr_portion .= pack('N', $attrs['graphicExposures']);
            $attr_mask |= 0x00010000;
        }
        if (isset($attrs['clipXOrigin'])) {
            $attr_portion .= pack('N', $attrs['clipXOrigin']);
            $attr_mask |= 0x00020000;
        }
        if (isset($attrs['clipYOrigin'])) {
            $attr_portion .= pack('N', $attrs['clipYOrigin']);
            $attr_mask |= 0x00040000;
        }
        if (isset($attrs['clipMask'])) {
            $attr_portion .= pack('N', $attrs['clipMask']);
            $attr_mask |= 0x00080000;
        }
        if (isset($attrs['dashOffset'])) {
            $attr_portion .= pack('N', $attrs['dashOffset']);
            $attr_mask |= 0x00100000;
        }
        if (isset($attrs['dashes'])) {
            $attr_portion .= pack('N', $attrs['dashes']);
            $attr_mask |= 0x00200000;
        }
        if (isset($attrs['arcMode'])) {
            $attr_portion .= pack('N', $attrs['arcMode']);
            $attr_mask |= 0x00400000;
        }
        return array($attr_portion, $attr_mask);
    }

    public function sendCreateGC($conn, $cid, $drawable, $attrs) {
        list($attr_portion, $attr_mask) = $this->packGCAttributes($attrs);
        $packet = pack("CxnNNN", self::X_CreateGC,
                4 + strlen($attr_portion) / 4, $cid, $drawable,
                $attr_mask) . $attr_portion;
        self::sendPacket($conn, $packet);
    }

    public function sendChangeGC($conn, $cid, $attrs) {
        list($attr_portion, $attr_mask) = $this->packGCAttributes($attrs);
        $packet = pack("CxnNN", self::X_ChangeGC,
                3 + strlen($attr_portion) / 4, $cid,
                $attr_mask) . $attr_portion;
        self::sendPacket($conn, $packet);
    }

    public function sendFreeGC($conn, $gc) {
        $packet = pack("CxnN", self::X_FreeGC, 2, $gc);
        self::sendPacket($conn, $packet);
    }

    public function sendPolyArc($conn, $drawable, $gc, $arcs) {
        $packet = pack("CxnNN", self::X_PolyArc, 3 + 3 * count($arcs), $drawable, $gc);
        foreach ($arcs as $arc) {
            $packet .= $this->packArc($arc);
        }
        self::sendPacket($conn, $packet);
    }

    public function sendPolyFillArc($conn, $drawable, $gc, $arcs) {
        $packet = pack("CxnNN", self::X_PolyFillArc, 3 + 3 * count($arcs), $drawable, $gc);
        foreach ($arcs as $arc) {
            $packet .= $this->packArc($arc);
        }
        self::sendPacket($conn, $packet);
    }

    public function sendAllocColor($conn, $cmap, $red, $green, $blue) {
        $packet = pack("CxnNnnnx2", self::X_AllocColor, 4, $cmap, $red, $green, $blue);
        self::sendPacket($conn, $packet);
    }

    public function parseAllocColorResponse($data) {
        $retval = unpack('Ctype/x1/nserial/x4/nred/ngreen/nblue/x2/Npixel/x12', $data);
        if ($retval['type'] != 1)
            throw new XProtocolException();
        unset($retval['type'], $retval['serial']);
        return $retval;
    }

    public function sendGetGeometry($conn, $drawable) {
        $packet = pack("CxnN", self::X_GetGeometry, 2, $drawable);
        self::sendPacket($conn, $packet);
    }

    public function parseGetGeometryResponse($data) {
        $retval = unpack('Ctype/Cdepth/nserial/x4/Nroot/nx/ny/nwidth/nheight/nborderWidth/x10', $data);
        if ($retval['type'] != 1)
            throw new XProtocolException();
        unset($retval['type'], $retval['serial']);
        return $retval;
    }

    public function packArc($arc) {
        return pack("nnnnnn",
                $arc['x'], $arc['y'], $arc['width'], $arc['height'],
                $arc['angle1'], $arc['angle2']);
    }

    public function getResponseLength() {
        return 32;
    }

    public function parseEvent($data) {
        $retval = unpack('Ctype/Cdetail/nserial', $data);
        switch ($retval['type']) {
        case self::Expose:
            $retval += unpack("x4/Nwindow/nx/ny/nwidth/nheight/ncount", $data);
            break;
        case self::MotionNotify:
            $retval += unpack("x4/Ntime/Nroot/Nevent/Nchild/nrootX/nrootY/neventX/neventY/nstate/CsameScreen/x1", $data);
            break;
        case self::ConfigureNotify:
            $retval += unpack("x4/Nevent/Nwindow/NaboveSibling/nx/ny/nwidth/nheight/nborderWidth/CoverrideRedirect/x5", $data);
            break;
        case self::ConfigureRequest:
            $retval += unpack("x4/Nparent/Nwindow/Nsibling/nx/ny/nwidth/nheight/nborderWidth/nvalueMask/x4", $data);
            break;
        case self::ResizeRequest:
            $retval += unpack("x4/Nwindow/Nwidth/Nheight", $data);
            break;
        }
        return $retval;
    }

    public function __construct($major = 11, $minor = 0) {
        $this->majorVersion = $major;
        $this->minorVersion = $minor;
    }

    protected $majorVersion;
    protected $minorVersion;
}

class XDisplay {
    public static function create($display_str = "", $majorVersion = 11, $minorVersion = 0) {
        if ($display_str === "") {
            $display_str = getenv("DISPLAY");
        }
        $xc = new XClient($majorVersion, $minorVersion);
        $conn = $xc->makeConnection(XClient::parseDisplayName($display_str));
        return new XDisplay($xc, $conn);
    }

    public function __construct($xc, $conn) {
        $this->xc = $xc;
        $this->conn = $conn;
        $data = $xc->negotiate($conn, new XHostAuth());
        $this->releaseNumber = $data['releaseNumber'];
        $this->resourceIdBase = $data['resourceIdBase'];
        $this->resourceIdMask = $data['resourceIdMask'];
        $this->motionBufferSize = $data['motionBufferSize'];
        $this->maxRequestLength = $data['maxRequestLength'];
        $this->imageByteOrder = $data['imageByteOrder'];
        $this->bitmapFormat = array(
            'order' => $data['bitmapFormatBitOrder'],
            'scanlineUnit' => $data['bitmapFormatScanlineUnit'],
            'scanLinePad' => $data['bitmapFormatScanlinePad'],
        );
        $this->keycodeRange = array($data['minKeycode'], $data['maxKeycode']);
        $this->vendor = $data['vendor'];
        $this->availableFormats = $data['formats'];
        $screens = array();
        foreach ($data['screens'] as $id => $screen_data) {
            $all_visuals = array();
            $depths = array();
            foreach ($screen_data['depths'] as $depth_data) {
                $visuals = array();
                foreach ($depth_data['visualTypes'] as $visual_data) {
                    $visual = new XVisual($visual_data['id']);
                    $visual->class = $visual_data['class'];
                    $visual->bitsPerRGB = $visual_data['bitsPerRGB'];
                    $visual->colormapEntries = $visual_data['colormapEntries'];
                    $visual->redMask = $visual_data['redMask'];
                    $visual->greenMask = $visual_data['greenMask'];
                    $visual->blueMask = $visual_data['blueMask'];
                    $visuals[] = $visual;
                    $all_visuals[$visual->id] = $visual;
                }
                $depths[$depth_data['depth']] = $visuals;
            } 
            $screen = new XScreen($this, $id);
            $screen->colormap = $screen_data['colormap'];
            $screen->whitePixel = $screen_data['whitePixel'];
            $screen->blackPixel = $screen_data['blackPixel'];
            $screen->currentInputMasks = $screen_data['currentInputMasks'];
            $screen->width = $screen_data['width'];
            $screen->height = $screen_data['height'];
            $screen->widthInMillis = $screen_data['widthInMillis'];
            $screen->heightInMillis = $screen_data['heightInMillis'];
            $screen->minInstalledMaps = $screen_data['minInstalledMaps'];
            $screen->maxInstalledMaps = $screen_data['maxInstalledMaps'];
            $screen->backingStore = $screen_data['backingStore'];
            $screen->saveUnders = $screen_data['saveUnders'];
            $screen->rootDepth = $screen_data['rootDepth'];
            $screen->depths = $depths;
            $screen->rootVisual = $all_visuals[$screen_data['rootVisualId']]; 
            $screen->rootWindow = new XWindow($this, $screen_data['rootWindow']);
            $screen->visuals = $all_visuals;
            $screens[] = $screen;
        }
        $this->screens = $screens;
        $this->nextResourceId = $this->resourceIdBase;
    }

    public function allocColor($colormap, $red, $green, $blue) {
        $this->xc->sendAllocColor($this->conn, $colormap, $red, $green, $blue);
        return $this->xc->parseAllocColorResponse($this->waitForReply());
    }

    public function createWindow(XWindow $parent, $x, $y, $width, $height, $border_width, $class, XVisual $visual = null, $attrs = array()) {
        $window_id = ++$this->nextResourceId;
        if (!$visual)
            $visual_id = XClient::CopyFromParent;
        else
            $visual_id = $visual->id;
        $this->xc->sendCreateWindow($this->conn,
            0, $window_id, $parent->id,
            $x, $y, $width, $height, $border_width, $class, $visual_id, $attrs);
        return new XWindow($this, $window_id);
    }

    public function mapWindow(XWindow $window) {
        $this->xc->sendMapWindow($this->conn, $window->id);
    }

    public function getGeometry(XDrawable $drawable) {
        $this->xc->sendGetGeometry($this->conn, $drawable->id);
        return $this->xc->parseGetGeometryResponse($this->waitForReply());
    }

    public function createGC(XDrawable $drawable, $attrs = array()) {
        $gc = ++$this->nextResourceId;
        $this->xc->sendCreateGC($this->conn, $gc, $drawable->id, $attrs);
        return $gc;
    }

    public function changeGC($gc, $attrs) {
        $this->xc->sendChangeGC($this->conn, $gc, $attrs);
    }

    public function drawArc(XDrawable $drawable, $gc, $x, $y, $width, $height, $angle1 = 0, $angle2 = 23040) {
        $this->xc->sendPolyArc($this->conn, $drawable->id, $gc,
            array(
                array(
                    'x' => $x, 'y' => $y,
                    'width' => $width, 'height' => $height,
                    'angle1' => $angle1, 'angle2' => $angle2)));
    }

    public function fillArc(XDrawable $drawable, $gc, $x, $y, $width, $height, $angle1 = 0, $angle2 = 23040) {
        $this->xc->sendPolyFillArc($this->conn, $drawable->id, $gc,
            array(
                array(
                    'x' => $x, 'y' => $y,
                    'width' => $width, 'height' => $height,
                    'angle1' => $angle1, 'angle2' => $angle2)));
    }

    public function fetchResponse() {
        $packet_len = $this->xc->getResponseLength();
        $buf = fread($this->conn, $packet_len);
        if ($buf === false)
            return false;
        else if (strlen($buf) != $packet_len)
            throw new IOException("Unexpected EOF");
        $this->responseQueue[] = $buf;
    }    

    public function waitForReply() {
        for (;;) {
            for ($i = 0; $i < count($this->responseQueue); $i++) {
                $resp = $this->responseQueue[$i];
                if ($resp{0} == "\x01") {
                    array_splice($this->responseQueue, $i, 1);
                    return $resp;
                }
            }
            $this->fetchResponse();
        }
    }

    public function nextEvent(&$data) {
        for (;;) {
            for ($i = 0; $i < count($this->responseQueue); $i++) {
                $resp = $this->responseQueue[$i];
                if ($resp{0} != "\x01") {
                    array_splice($this->responseQueue, $i, 1);
                    $data = $this->xc->parseEvent($resp);
                    return $data['type'];
                }
            }
            $this->fetchResponse();
        }
    }

    protected $xc;
    protected $conn;
    protected $releaseNumber;
    protected $resourceIdBase;
    protected $resourceIdMask;
    protected $motionBufferSize;
    protected $maxRequestLength;
    protected $imageByteOrder;
    protected $bitmapFormat;
    protected $keycodeRange;
    protected $vendor;
    protected $availableFormats;
    protected $nextResourceId;
    protected $responseQueue;
    public $screens;
}
