/*
 Script: Window.js
 Build windows.
 Copyright:
 Copyright (c) 2013 Jose Alexis Correa Valencia, <jalexiscv@gmail.com>.
 License:
 MIT-style license.
 Requires:
 Core.js
 */

//$require(MUI.themePath() + '/css/Dock.css');
/*
 Class: Window
 Creates a single InssideUI window.
 
 Syntax:
 (start code)
 new MUI.Window(options);
 (end)
 
 Arguments:
 options
 
 Options:
 id - The ID of the window. If not defined, it will be set to 'win' + windowIDCount.
 title - The title of the window.
 icon - Place an icon in the window's titlebar. This is either set to false or to the url of the icon. It is set up for icons that are 16 x 16px.
 type - ('window', 'modal', 'modal2', or 'notification') Defaults to 'window'. Modals should be created with new MUI.Modal(options).
 loadMethod - ('html', 'xhr', or 'iframe') Defaults to 'html' if there is no contentURL. Defaults to 'xhr' if there is a contentURL. You only really need to set this if using the 'iframe' method.
 contentURL - Used if loadMethod is set to 'xhr' or 'iframe'.
 closeAfter - Either false or time in milliseconds. Closes the window after a certain period of time in milliseconds. This is particularly useful for notifications.
 evalScripts - (boolean) An xhr loadMethod option. Defaults to true.
 evalResponse - (boolean) An xhr loadMethod option. Defaults to false.
 content - (string or element) An html loadMethod option.
 toolbar - (boolean) Create window toolbar. Defaults to false. This can be used for tabs, media controls, and so forth.
 toolbarPosition - ('top' or 'bottom') Defaults to top.
 toolbarHeight - (number)
 toolbarURL - (url) Defaults to 'pages/lipsum.html'.
 toolbarContent - (string)
 toolbarOnload - (function)
 toolbar2 - (boolean) Create window toolbar. Defaults to false. This can be used for tabs, media controls, and so forth.
 toolbar2Position - ('top' or 'bottom') Defaults to top.
 toolbar2Height - (number)
 toolbar2URL - (url) Defaults to 'pages/lipsum.html'.
 toolbar2Content - (string)
 toolbar2Onload - (function)
 container - (element ID) Element the window is injected in. The container defaults to 'desktop'. If no desktop then to document.body. Use 'pageWrapper' if you don't want the windows to overlap the toolbars.
 restrict - (boolean) Restrict window to container when dragging.
 shape - ('box' or 'gauge') Shape of window. Defaults to 'box'.
 collapsible - (boolean) Defaults to true.
 minimizable - (boolean) Requires MUI.Desktop and MUI.Dock. Defaults to true if dependenices are met.
 maximizable - (boolean) Requires MUI.Desktop. Defaults to true if dependenices are met.
 closable - (boolean) Defaults to true.
 storeOnClose - (boolean) Hides a window and it's dock tab rather than destroying them on close. If you try to create the window again it will unhide the window and dock tab.
 modalOverlayClose - (boolean) Whether or not you can close a modal by clicking on the modal overlay. Defaults to true.
 draggable - (boolean) Defaults to false for modals; otherwise true.
 draggableGrid - (false or number) Distance in pixels for snap-to-grid dragging. Defaults to false.
 draggableLimit - (false or number) An object with x and y properties used to limit the movement of the Window. Defaults to false.
 draggableSnap - (boolean) The distance to drag before the Window starts to respond to the drag. Defaults to false.
 resizable - (boolean) Defaults to false for modals, notifications and gauges; otherwise true.
 resizeLimit - (object) Minimum and maximum width and height of window when resized.
 addClass - (string) Add a class to the window for more control over styling.
 width - (number) Width of content area.
 height - (number) Height of content area.
 headerHeight - (number) Height of window titlebar.
 footerHeight - (number) Height of window footer.
 cornerRadius - (number)
 x - (number) If x and y are left undefined the window is centered on the page.
 y - (number)
 scrollbars - (boolean)
 padding - (object)
 shadowBlur - (number) Width of shadows.
 shadowOffset - Should be positive and not be greater than the ShadowBlur.
 controlsOffset - Change this if you want to reposition the window controls.
 useCanvas - (boolean) Set this to false if you don't want a canvas body.
 useCanvasControls - (boolean) Set this to false if you wish to use images for the buttons.
 useSpinner - (boolean) Toggles whether or not the ajax spinners are displayed in window footers. Defaults to true.
 headerStartColor - ([r,g,b,]) Titlebar gradient's top color
 headerStopColor - ([r,g,b,]) Titlebar gradient's bottom color
 bodyBgColor - ([r,g,b,]) Background color of the main canvas shape
 minimizeBgColor - ([r,g,b,]) Minimize button background color
 minimizeColor - ([r,g,b,]) Minimize button color
 maximizeBgColor - ([r,g,b,]) Maximize button background color
 maximizeColor - ([r,g,b,]) Maximize button color
 closeBgColor - ([r,g,b,]) Close button background color
 closeColor - ([r,g,b,]) Close button color
 resizableColor - ([r,g,b,]) Resizable icon color
 onBeforeBuild - (function) Fired just before the window is built.
 onContentLoaded - (function) Fired when content is successfully loaded via XHR or Iframe.
 onFocus - (function)  Fired when the window is focused.
 onBlur - (function) Fired when window loses focus.
 onResize - (function) Fired when the window is resized.
 onMinimize - (function) Fired when the window is minimized.
 onMaximize - (function) Fired when the window is maximized.
 onRestore - (function) Fired when a window is restored from minimized or maximized.
 onClose - (function) Fired just before the window is closed.
 onCloseComplete - (function) Fired after the window is closed.
 
 Returns:
 Window object.
 
 Example:
 Define a window. It is suggested you name the function the same as your window ID + "Window".
 (start code)
 var mywindowWindow = function(){
 new MUI.Window({
 id: 'mywindow',
 title: 'My Window',
 loadMethod: 'xhr',
 contentURL: 'pages/lipsum.html',
 width: 340,
 height: 150
 });
 }
 (end)
 
 Example:
 Create window onDomReady.
 (start code)
 window.addEvent('domready', function(){
 mywindow();
 });
 (end)
 
 Example:
 Add link events to build future windows. It is suggested you give your anchor the same ID as your window + "WindowLink" or + "WindowLinkCheck". Use the latter if it is a link in the menu toolbar.
 
 If you wish to add links in windows that open other windows remember to add events to those links when the windows are created.
 
 (start code)
 // Javascript:
 if ($('mywindowLink')){
 $('mywindowLink').addEvent('click', function(e) {
 e.stop();
 mywindow();
 });
 }
 
 // HTML:
 <a id="mywindowLink" href="pages/lipsum.html">My Window</a>
 (end)
 
 
 Loading Content with an XMLHttpRequest(xhr):
 For content to load via xhr all the files must be online and in the same domain. If you need to load content from another domain or wish to have it work offline, load the content in an iframe instead of using the xhr option.
 
 Iframes:
 If you use the iframe loadMethod your iframe will automatically be resized when the window it is in is resized. If you want this same functionality when using one of the other load options simply add class="inssideIframe" to those iframes and they will be resized for you as well.
 
 */
// Having these options outside of the Class allows us to add, change, and remove
// individual options without rewriting all of them.
/**
 MUI.extend({
 Windows: {
 instances:      new Hash(),
 indexLevel:     100,          // Used for window z-Index
 windowIDCount:  0,            // Used for windows without an ID defined by the user
 windowsVisible: true,         // Ctrl-Alt-Q to toggle window visibility
 focusingWindow: false
 }
 });
 **/
Object.append(MUI, {
    Windows: {
        /** 1.2 @todo */
        instances: new Hash(),
        indexLevel: 100, // Used for window z-Index
        windowIDCount: 0, // Used for windows without an ID defined by the user
        windowsVisible: true, // Ctrl-Alt-Q to toggle window visibility
        focusingWindow: false
    }
});
MUI.Windows.windowOptions = {
    id: null,
    title: 'New Window',
    icon: false,
    type: 'window',
    require: {
        css: [],
        images: [],
        js: [],
        onload: null
    },
    loadMethod: null,
    method: 'get',
    contentURL: null,
    data: null,
    closeAfter: false,
    // xhr options
    evalScripts: true,
    evalResponse: false,
    // html options
    content: 'Window content',
    // Toolbar
    toolbar: false,
    toolbarPosition: 'top',
    toolbarHeight: 29,
    toolbarURL: 'pages/lipsum.html',
    toolbarData: null,
    toolbarContent: '',
    toolbarOnload: function () {
    },
    // Toolbar
    toolbar2: false,
    toolbar2Position: 'bottom',
    toolbar2Height: 29,
    toolbar2URL: 'pages/lipsum.html',
    toolbar2Data: null,
    toolbar2Content: '',
    toolbar2Onload: function () {
    },
    // Container options
    container: null,
    restrict: true,
    shape: 'box',
    // Window Controls
    collapsible: true,
    minimizable: true,
    maximizable: true,
    closable: true,
    // Close options
    storeOnClose: false,
    // Modal options
    modalOverlayClose: true,
    // Draggable
    draggable: null,
    draggableGrid: false,
    draggableLimit: false,
    draggableSnap: false,
    // Resizable
    resizable: null,
    resizeLimit: {
        'x': [250, 2500],
        'y': [125, 2000]
    },
    // Style options:
    addClass: '',
    width: 300,
    height: 125,
    headerHeight: 25,
    footerHeight: 25,
    cornerRadius: 8,
    x: null,
    y: null,
    scrollbars: false,
    padding: {
        top: 10,
        right: 12,
        bottom: 10,
        left: 12
    },
    shadowBlur: 5,
    shadowOffset: {
        'x': 0,
        'y': 1
    },
    controlsOffset: {
        'right': 6,
        'top': 6
    },
    useCanvas: true,
    useCanvasControls: true,
    useSpinner: true,
    // Color options:
    headerStartColor: [250, 250, 250],
    headerStopColor: [229, 229, 229],
    bodyBgColor: [229, 229, 229],
    minimizeBgColor: [255, 255, 255],
    minimizeColor: [0, 0, 0],
    maximizeBgColor: [255, 255, 255],
    maximizeColor: [0, 0, 0],
    closeBgColor: [255, 255, 255],
    closeColor: [0, 0, 0],
    resizableColor: [254, 254, 254],
    // Events
    onBeforeBuild: function () {
    },
    onContentLoaded: function () {
    },
    onFocus: function () {
    },
    onBlur: function () {
    },
    onResize: function () {
    },
    onMinimize: function () {
    },
    onMaximize: function () {
    },
    onRestore: function () {
    },
    onClose: function () {
    },
    onCloseComplete: function () {
    }
};
