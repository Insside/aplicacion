<?php
$ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;
require_once($ROOT . "librerias/Configuracion.cnf.php");
require_once($ROOT . "modulos/aplicacion/librerias/Compactador.class.php");
require_once($ROOT . "modulos/aplicacion/librerias/Aplicacion_Framework_Clases.class.php");
header('Content-Type: application/x-javascript');
$afc = new Aplicacion_Framework_Clases();
?>
var MUI = InssideUI = {
  'version': '2.1.0 development',
  'idCount': 0,
  'instances': new Hash(),
  'registered': new Hash(),
  'options': {
    'theme': 'default',
    'advancedEffects': false, // Effects that require fast browsers and are cpu intensive.
    'standardEffects': true   // Basic effects that tend to run smoothly.
  },
  'path': {
    source: 'scripts/source/',
    themes: 'themes/',
    plugins: 'plugins/',
    modulos: 'modulos/',
    pqrs: 'modulos/solicitudes/',
    proveedores: 'modulos/proveedores/',
    usuarios: 'modulos/usuarios/',
    distribucion: 'modulos/distribucion/',
    suscriptores: 'modulos/suscriptores/',
    comunicaciones: 'modulos/comunicaciones/',
    empleados: 'modulos/empleados/',
    inventarios: 'modulos/inventarios/',
    medidores: 'modulos/medidores/',
    sincronizacion: 'modulos/sincronizacion/',
    aplicacion: 'modulos/aplicacion/',
    estilos: 'estilos/'
  },
  // Returns the path to the current theme directory
  'themePath': function () {
    return MUI.path.themes + MUI.options.theme + '/';
  },
  'set': function (el, instance) {
    el = this.getID(el);
    this.instances.set(el, instance);
    return instance;
  },
  'getData': function (item, property, dfault) {
    if (!dfault)
      dfault = '';
    if (!item || !property)
      return dfault;
    if (item[property] == null)
      return dfault;
    return item[property];
  },
  'getID': function (el) {
    var type = typeOf(el);
    if (type == 'null')
      return null;
    if (type == 'function') {
      return el;
    }
    if (type == 'string')
      return el;
    if (type == 'element')
      return el.id;
    else if (type == 'object' && el.id)
      return el.id;
    else if (type == 'object' && el.options && el.options.id)
      return el.options.id;
    return el;
  },
  'get': function (el) {
    var id = this.getID(el);
    el = $(id);
    if (el && el.retrieve('instance'))
      return el.retrieve('instance');
    return this.instances[id];
  },
  'files': new Object(),
  'dockWrapper': 'dockWrapper',
  'dock': 'dock',
  'Columns': {'instances': new Hash(),'columnIDCount': 0},
  'Panels': {'instances': new Hash(),'panelIDCount': 0 },
    // Panel Height
  'panelHeight': function(column, changing, action) {
    if (column != null) {
      MUI.panelHeight2($(column), changing, action);
    }
    else {
      $$('.column').each(function(column) {
        MUI.panelHeight2(column);
      }.bind(this));
    }
  },
  /*
   
   actions can be new, collapsing or expanding.
   
   */
  'panelHeight2': function(column, changing, action) {

    var instances = MUI.Panels.instances;

    var parent = column.getParent();
    var columnHeight = parent.getStyle('height').toInt();
    if (Browser.ie4 && parent == MUI.Desktop.pageWrapper) {
      columnHeight -= 1;
    }
    column.setStyle('height', columnHeight);

    // Get column panels
    var panels = [];
    column.getChildren('.panelWrapper').each(function(panelWrapper) {
      panels.push(panelWrapper.getElement('.panel'));
    }.bind(this));

    // Get expanded column panels
    var panelsExpanded = [];
    column.getChildren('.expanded').each(function(panelWrapper) {
      panelsExpanded.push(panelWrapper.getElement('.panel'));
    }.bind(this));

    // All the panels in the column whose height will be effected.
    var panelsToResize = [];

    // The panel with the greatest height. Remainders will be added to this panel
    var tallestPanel;
    var tallestPanelHeight = 0;

    this.panelsTotalHeight = 0; // Height of all the panels in the column
    this.height = 0; // Height of all the elements in the column

    // Set panel resize partners
    panels.each(function(panel) {
      /** 1.2 @todo */
      var instance = instances.get(panel.id);
      if (panel.getParent().hasClass('expanded') && panel.getParent().getNext('.expanded')) {
        instance.partner = panel.getParent().getNext('.expanded').getElement('.panel');
        instance.resize.attach();
        instance.handleEl.setStyles({
          'display': 'block',
          'cursor': Browser.firefox ? 'row-resize' : 'n-resize'
        }).removeClass('detached');
      } else {
        try {
          instance.resize.detach();
        } catch (error) {
        }
        instance.handleEl.setStyles({
          'display': 'none',
          'cursor': null
        }).addClass('detached');
      }
      if (panel.getParent().getNext('.panelWrapper') == null) {
        instance.handleEl.hide();
      }
    }.bind(this));

    // Add panels to panelsToResize
    // Get the total height of all the resizable panels
    // Get the total height of all the column's children
    column.getChildren().each(function(panelWrapper) {

      panelWrapper.getChildren().each(function(el) {

        if (el.hasClass('panel')) {
          /** 1.2 @todo */
          var instance = instances.get(el.id);

          // Are any next siblings Expanded?
          var anyNextSiblingsExpanded = function(el) {
            var test;
            el.getParent().getAllNext('.panelWrapper').each(function(sibling) {
              /** 1.2 @todo */
              var siblingInstance = instances.get(sibling.getElement('.panel').id);
              if (siblingInstance.isCollapsed == false) {
                test = true;
              }
            }.bind(this));
            return test;
          }.bind(this);

          // If a next sibling is expanding, are any of the nexts siblings of the expanding sibling Expanded?
          var anyExpandingNextSiblingsExpanded = function(el) {
            var test;
            changing.getParent().getAllNext('.panelWrapper').each(function(sibling) {
              /** 1.2 @todo */
              var siblingInstance = instances.get(sibling.getElement('.panel').id);
              if (siblingInstance.isCollapsed == false) {
                test = true;
              }
            }.bind(this));
            return test;
          }.bind(this);

          // Is the panel that is collapsing, expanding, or new located after this panel?
          var anyNextContainsChanging = function(el) {
            var allNext = [];
            el.getParent().getAllNext('.panelWrapper').each(function(panelWrapper) {
              allNext.push(panelWrapper.getElement('.panel'));
            }.bind(this));
            var test = allNext.contains(changing);
            return test;
          }.bind(this);

          var nextExpandedChanging = function(el) {
            var test;
            if (el.getParent().getNext('.expanded')) {
              if (el.getParent().getNext('.expanded').getElement('.panel') == changing)
                test = true;
            }
            return test;
          }

          // NEW PANEL
          // Resize panels that are "new" or not collapsed
          if (action == 'new') {
            if (!instance.isCollapsed && el != changing) {
              panelsToResize.push(el);
              this.panelsTotalHeight += el.offsetHeight.toInt();
            }
          }

          // COLLAPSING PANELS and CURRENTLY EXPANDED PANELS
          // Resize panels that are not collapsed.
          // If a panel is collapsing resize any expanded panels below.
          // If there are no expanded panels below it, resize the expanded panels above it.
          else if (action == null || action == 'collapsing') {
            if (!instance.isCollapsed && (!anyNextContainsChanging(el) || !anyNextSiblingsExpanded(el))) {
              panelsToResize.push(el);
              this.panelsTotalHeight += el.offsetHeight.toInt();
            }
          }

          // EXPANDING PANEL
          // Resize panels that are not collapsed and are not expanding.
          // Resize any expanded panels below the expanding panel.
          // If there are no expanded panels below the expanding panel, resize the first expanded panel above it.
          else if (action == 'expanding' && !instance.isCollapsed && el != changing) {
            if (!anyNextContainsChanging(el) || (!anyExpandingNextSiblingsExpanded(el) && nextExpandedChanging(el))) {
              panelsToResize.push(el);
              this.panelsTotalHeight += el.offsetHeight.toInt();
            }
          }

          if (el.style.height) {
            this.height += el.getStyle('height').toInt();
          }
        }
        else {
          this.height += el.offsetHeight.toInt();
        }
      }.bind(this));

    }.bind(this));

    // Get the remaining height
    var remainingHeight = column.offsetHeight.toInt() - this.height;

    this.height = 0;

    // Get height of all the column's children
    column.getChildren().each(function(el) {
      this.height += el.offsetHeight.toInt();
    }.bind(this));

    var remainingHeight = column.offsetHeight.toInt() - this.height;

    panelsToResize.each(function(panel) {
      var ratio = this.panelsTotalHeight / panel.offsetHeight.toInt();
      var newPanelHeight = panel.getStyle('height').toInt() + (remainingHeight / ratio);
      if (newPanelHeight < 1) {
        newPanelHeight = 0;
      }
      panel.setStyle('height', newPanelHeight);
    }.bind(this));

    // Make sure the remaining height is 0. If not add/subtract the
    // remaining height to the tallest panel. This makes up for browser resizing,
    // off ratios, and users trying to give panels too much height.

    // Get height of all the column's children
    this.height = 0;
    column.getChildren().each(function(panelWrapper) {
      panelWrapper.getChildren().each(function(el) {
        this.height += el.offsetHeight.toInt();
        if (el.hasClass('panel') && el.getStyle('height').toInt() > tallestPanelHeight) {
          tallestPanel = el;
          tallestPanelHeight = el.getStyle('height').toInt();
        }
      }.bind(this));
    }.bind(this));

    var remainingHeight = column.offsetHeight.toInt() - this.height;

    if (remainingHeight != 0 && tallestPanelHeight > 0) {
      tallestPanel.setStyle('height', tallestPanel.getStyle('height').toInt() + remainingHeight);
      if (tallestPanel.getStyle('height') < 1) {
        tallestPanel.setStyle('height', 0);
      }
    }

    parent.getChildren('.columnHandle').each(function(handle) {
      var parent = handle.getParent();
      if (parent.getStyle('height').toInt() < 1)
        return; // Keeps IE7 and 8 from throwing an error when collapsing a panel within a panel
      var handleHeight = parent.getStyle('height').toInt() - handle.getStyle('border-top').toInt() - handle.getStyle('border-bottom').toInt();
      if (Browser.ie4 && parent == MUI.Desktop.pageWrapper) {
        handleHeight -= 1;
      }
      handle.setStyle('height', handleHeight);
    });

    panelsExpanded.each(function(panel) {
      MUI.resizeChildren(panel);
    }.bind(this));

  },
  // May rename this resizeIframeEl()
  'resizeChildren': function(panel) {
    /** 1.2 @todo */
    var instances = MUI.Panels.instances;
    var instance = instances.get(panel.id);
    var contentWrapperEl = instance.contentWrapperEl;

    if (instance.iframeEl) {
      if (!Browser.ie) {
        instance.iframeEl.setStyles({
          'height': contentWrapperEl.getStyle('height'),
          'width': contentWrapperEl.offsetWidth - contentWrapperEl.getStyle('border-left').toInt() - contentWrapperEl.getStyle('border-right').toInt()
        });
      }
      else {
        // The following hack is to get IE8 RC1 IE8 Standards Mode to properly resize an iframe
        // when only the vertical dimension is changed.
        instance.iframeEl.setStyles({
          'height': contentWrapperEl.getStyle('height'),
          'width': contentWrapperEl.offsetWidth - contentWrapperEl.getStyle('border-left').toInt() - contentWrapperEl.getStyle('border-right').toInt() - 1
        });
        instance.iframeEl.setStyles({
          'width': contentWrapperEl.offsetWidth - contentWrapperEl.getStyle('border-left').toInt() - contentWrapperEl.getStyle('border-right').toInt()
        });
      }
    }

  },
  'remainingWidth': function(container) {
    container=(container)?container:MUI.Desktop.desktop;
    container.getElements('.remainingWidth').each(function(column) {
      var currentWidth = column.offsetWidth.toInt();
      currentWidth -= column.getStyle('border-left').toInt();
      currentWidth -= column.getStyle('border-right').toInt();

      var parent = column.getParent();
      this.width = 0;

      // Get the total width of all the parent element's children
      parent.getChildren().each(function(el) {
        if (el.hasClass('insside') != true) {
          this.width += el.offsetWidth.toInt();
        }
      }.bind(this));

      // Add the remaining width to the current element
      var remainingWidth = parent.offsetWidth.toInt() - this.width;
      var newWidth = currentWidth + remainingWidth;
      if (newWidth < 1)
        newWidth = 0;
      column.setStyle('width', newWidth);
      column.getChildren('.panel').each(function(panel) {
        panel.setStyle('width', newWidth - panel.getStyle('border-left').toInt() - panel.getStyle('border-right').toInt());
        MUI.resizeChildren(panel);
      }.bind(this));

    });
  }
};
/** <mui>Clases Incorporadas al MUI **/
<?php
$db = new MySQL(Router::getDefaultConexion());
$sql = "SELECT * FROM `aplicacion_framework_clases` WHERE(`nombre` LIKE  '%MUI.%' AND `estado` = 'ACTIVA');";
$consulta = $db->sql_query($sql);
while ($fila = $db->sql_fetchrow($consulta)) {
  echo ($afc->codensador($fila['clase']));
}
?>
/** </mui>Clases Incorporadas al MUI **/
Object.append(MUI,{});

















MUI.files[MUI.path.source + 'Core/Core.js'] = 'loaded';

Object.append(MUI, {
  Windows: {
    //instances: new Hash()
    instances: new Object()
  },
  ieSupport: 'excanvas', // Makes it easier to switch between Excanvas and Moocanvas for testing
  /**
   Function: updateContent
   Remplaza el contenido de un Panel o Ventana   
   Argumentos: updateOptions - (object)
   updateOptions:
   element - The parent window or panel.
   childElement - The child element of the window or panel recieving the content.
   method - ('get', or 'post') The way data is transmitted.
   data - (hash) Data to be transmitted
   title - (string) Change this if you want to change the title of the window or panel.
   content - (string or element) An html loadMethod option.
   loadMethod - ('html', 'xhr', or 'iframe')
   url - Used if loadMethod is set to 'xhr' or 'iframe'.
   scrollbars - (boolean)
   padding - (object)
   onContentLoaded - (function)
   **/
  updateContent: function (options) {
    var options = Object.append({
      element: null,
      childElement: null,
      method: null,
      data: null,
      title: null,
      content: null,
      loadMethod: null,
      url: null,
      scrollbars: null,
      padding: null,
      require: {},
      onContentLoaded: function () {
      }
    }, options);
    options.require = Object.append({
      css: [],
      images: [],
      js: [],
      onload: null
    }, options.require);
    var args = {};
    if (!options.element)
      return;
    var element = options.element;

    /** 1.2 @todo */
    //if (MUI.Windows.instances.get(element.id)){
    if (MUI.Windows.instances.element) {
      args.recipient = 'window';
    }
    else {
      args.recipient = 'panel';
    }
    var instance = element.retrieve('instance');
    if (options.title) {
      instance.titleEl.set('html', options.title);
    }
    var contentEl = instance.contentEl;
    args.contentContainer = options.childElement != null ? options.childElement : instance.contentEl;
    var contentWrapperEl = instance.contentWrapperEl;
    if (!options.loadMethod) {
      if (!instance.options.loadMethod) {
        if (!options.url) {
          options.loadMethod = 'html';
        }
        else {
          options.loadMethod = 'xhr';
        }
      }
      else {
        options.loadMethod = instance.options.loadMethod;
      }
    }
    // Set scrollbars if loading content in main content container.
    // Always use 'hidden' for iframe windows
    var scrollbars = options.scrollbars || instance.options.scrollbars;
    if (args.contentContainer == instance.contentEl) {
      contentWrapperEl.setStyles({
        'overflow': scrollbars != false && options.loadMethod != 'iframe' ? 'auto' : 'hidden'
      });
    }

    if (options.padding != null) {
      contentEl.setStyles({
        'padding-top': options.padding.top,
        'padding-bottom': options.padding.bottom,
        'padding-left': options.padding.left,
        'padding-right': options.padding.right
      });
    }

    /**
     * Autor: Jose Alexis Correa Valencia 
     * Recargar Barra De Herramientas: Este procedimiento era inexistente y permite recargar las barras 
     * herramientas aosicadas aun panel u objeto al actualizar el contenido del mismo
     * options.headerToolbox: Estado barra de herramientas
     * options.headerToolboxURL: Url pasada en las opciones
     * instance.panelHeaderToolboxEl: Elemento Contenedor
     **/
    if (options.headerToolbox) {
      if (options.headerToolboxURL) {
        new Request.HTML({
          url: options.headerToolboxURL,
          update: instance.panelHeaderToolboxEl,
          method: options.headerToolboxMethod != null ? options.headerToolboxMethod : 'get',
          data: options.headerToolboxData != null ? Object.toQueryString(options.headerToolboxData) : '',
          evalScripts: true,
          evalResponse: false,
          onRequest: function () {
          }.bind(this),
          onFailure: function (response) {
          }.bind(this),
          onSuccess: function () {
          }.bind(this),
          onComplete: function () {
          }.bind(this)
        }).send();
      }
    }
    /** Remove old content. **/
    if (args.contentContainer == contentEl) {
      contentEl.empty().show();
      // Panels are not loaded into the padding div, so we remove them separately.
      contentEl.getAllNext('.column').destroy();
      contentEl.getAllNext('.columnHandle').destroy();
    }
    args.onContentLoaded = function () {
      if (options.require.js.length || typeof options.require.onload == 'function') {
        new MUI.Require({
          js: options.require.js,
          onload: function () {
            if (Browser.opera) {
              options.require.onload.delay(100);
            }
            else {
              options.require.onload();
            }
            options.onContentLoaded ? options.onContentLoaded() : instance.fireEvent('onContentLoaded', element);
          }.bind(this)
        });
      }
      else {
        options.onContentLoaded ? options.onContentLoaded() : instance.fireEvent('onContentLoaded', element);
      }

    };
    if (options.require.css.length || options.require.images.length) {
      new MUI.Require({
        css: options.require.css,
        images: options.require.images,
        onload: function () {
          this.loadSelect(instance, options, args);
        }.bind(this)
      });
    }
    else {
      this.loadSelect(instance, options, args);
    }
  },
  loadSelect: function (instance, options, args) {

    // Load new content.
    switch (options.loadMethod) {
      case 'xhr':
        this.updateContentXHR(instance, options, args);
        break;
      case 'iframe':
        this.updateContentIframe(instance, options, args);
        break;
      case 'html':
      default:
        this.updateContentHTML(instance, options, args);
        break;
    }

  },
  updateContentXHR: function (instance, options, args) {
    var contentEl = instance.contentEl;
    var contentContainer = args.contentContainer;
    var onContentLoaded = args.onContentLoaded;
    new Request.HTML({
      url: options.url,
      update: contentContainer,
      method: options.method != null ? options.method : 'get',
      data: options.data != null ? Object.toQueryString(options.data) : '',
      evalScripts: instance.options.evalScripts,
      evalResponse: instance.options.evalResponse,
      onRequest: function () {
        if (args.recipient == 'window' && contentContainer == contentEl) {
          instance.showSpinner();
        } else if (args.recipient == 'panel' && contentContainer == contentEl && $('spinner')) {
          $('spinner').show();
        }
      }.bind(this),
      onFailure: function (response) {
        if (contentContainer == contentEl) {
          var getTitle = new RegExp("<title>[\n\r\s]*(.*)[\n\r\s]*</title>", "gmi");
          var error = getTitle.exec(response.responseText);
          if (!error)
            error = 'Unknown';
          contentContainer.set('html', '<h3>Error: ' + error[1] + '</h3>');
          if (args.recipient == 'window') {
            instance.hideSpinner();
          }
          else if (args.recipient == 'panel' && $('spinner')) {
            $('spinner').hide();
          }
        }
      }.bind(this),
      onSuccess: function () {
        if (contentContainer == contentEl) {
          if (args.recipient == 'window')
            instance.hideSpinner();
          else if (args.recipient == 'panel' && $('spinner'))
            $('spinner').hide();
        }
        Browser.ie4 ? onContentLoaded.delay(750) : onContentLoaded();
      }.bind(this),
      onComplete: function () {
      }.bind(this)
    }).send();
  },
  updateContentIframe: function (instance, options, args) {
    var contentEl = instance.contentEl;
    var contentContainer = args.contentContainer;
    var contentWrapperEl = instance.contentWrapperEl;
    var onContentLoaded = args.onContentLoaded;
    if (instance.options.contentURL == '' || contentContainer != contentEl) {
      return;
    }
    instance.iframeEl = new Element('iframe', {
      'id': instance.options.id + '_iframe',
      'name': instance.options.id + '_iframe',
      'class': 'inssideIframe',
      'src': options.url,
      'marginwidth': 0,
      'marginheight': 0,
      'frameBorder': 0,
      'scrolling': 'auto',
      'styles': {
        'height': contentWrapperEl.offsetHeight - contentWrapperEl.getStyle('border-top').toInt() - contentWrapperEl.getStyle('border-bottom').toInt(),
        'width': instance.panelEl ? contentWrapperEl.offsetWidth - contentWrapperEl.getStyle('border-left').toInt() - contentWrapperEl.getStyle('border-right').toInt() : '100%'
      }
      /** }).injectInside(contentEl); **/
    }).inject(contentEl); // default is bottom inside desktop div


    // Add onload event to iframe so we can hide the spinner and run onContentLoaded()
    instance.iframeEl.addEvent('load', function (e) {
      if (args.recipient == 'window')
        instance.hideSpinner();
      else if (args.recipient == 'panel' && contentContainer == contentEl && $('spinner'))
        $('spinner').hide();
      Browser.ie4 ? onContentLoaded.delay(50) : onContentLoaded();
    }.bind(this));
    if (args.recipient == 'window')
      instance.showSpinner();
    else if (args.recipient == 'panel' && contentContainer == contentEl && $('spinner'))
      $('spinner').show();
  },
  updateContentHTML: function (instance, options, args) {
    var contentEl = instance.contentEl;
    var contentContainer = args.contentContainer;
    var onContentLoaded = args.onContentLoaded;
    var elementTypes = new Array('element', 'textnode', 'whitespace', 'collection');

    /** 1.2 if (elementTypes.contains($type(options.content))){ */
    if (elementTypes.contains(typeOf(options.content))) {
      options.content.inject(contentContainer);

    } else {
      contentContainer.set('html', options.content);
    }
    if (contentContainer == contentEl) {
      if (args.recipient == 'window')
        instance.hideSpinner();
      else if (args.recipient == 'panel' && $('spinner'))
        $('spinner').hide();
    }
    Browser.ie4 ? onContentLoaded.delay(50) : onContentLoaded();
  },
  /*
   
   Function: reloadIframe
   Reload an iframe. Fixes an issue in Firefox when trying to use location.reload on an iframe that has been destroyed and recreated.
   
   Arguments:
   iframe - This should be both the name and the id of the iframe.
   
   Syntax:
   (start code)
   MUI.reloadIframe(element);
   (end)
   
   Example:
   To reload an iframe from within another iframe:
   (start code)
   parent.MUI.reloadIframe('myIframeName');
   (end)
   
   */
  reloadIframe: function (iframe) {
    Browser.firefox ? $(iframe).src = $(iframe).src : top.frames[iframe].location.reload(true);
  },
  roundedRect: function (ctx, x, y, width, height, radius, rgb, a) {
    ctx.fillStyle = 'rgba(' + rgb.join(',') + ',' + a + ')';
    ctx.beginPath();
    ctx.moveTo(x, y + radius);
    ctx.lineTo(x, y + height - radius);
    ctx.quadraticCurveTo(x, y + height, x + radius, y + height);
    ctx.lineTo(x + width - radius, y + height);
    ctx.quadraticCurveTo(x + width, y + height, x + width, y + height - radius);
    ctx.lineTo(x + width, y + radius);
    ctx.quadraticCurveTo(x + width, y, x + width - radius, y);
    ctx.lineTo(x + radius, y);
    ctx.quadraticCurveTo(x, y, x, y + radius);
    ctx.fill();
  },
  triangle: function (ctx, x, y, width, height, rgb, a) {
    ctx.beginPath();
    ctx.moveTo(x + width, y);
    ctx.lineTo(x, y + height);
    ctx.lineTo(x + width, y + height);
    ctx.closePath();
    ctx.fillStyle = 'rgba(' + rgb.join(',') + ',' + a + ')';
    ctx.fill();
  },
  circle: function (ctx, x, y, diameter, rgb, a) {
    ctx.beginPath();
    ctx.arc(x, y, diameter, 0, Math.PI * 2, true);
    ctx.fillStyle = 'rgba(' + rgb.join(',') + ',' + a + ')';
    ctx.fill();
  },
  notification: function (message) {
    new MUI.Window({
      loadMethod: 'html',
      closeAfter: 1500,
      type: 'notification',
      addClass: 'notification',
      content:message,
      width: 220,
      height: 40,
      y: 53,
      padding: {top: 10, right: 12, bottom: 10, left: 12},
      shadowBlur: 5
    });
  },
  /**
   
   Function: toggleEffects
   Turn effects on and off
   
   */
  toggleAdvancedEffects: function (link) {
    if (MUI.options.advancedEffects == false) {
      MUI.options.advancedEffects = true;
      if (link) {
        this.toggleAdvancedEffectsLink = new Element('div', {
          'class': 'check',
          'id': 'toggleAdvancedEffects_check'
        }).inject(link);
      }
    }
    else {
      MUI.options.advancedEffects = false;
      if (this.toggleAdvancedEffectsLink) {
        this.toggleAdvancedEffectsLink.destroy();
      }
    }
  },
  /*
   
   Function: toggleStandardEffects
   Turn standard effects on and off
   
   */
  toggleStandardEffects: function (link) {
    if (MUI.options.standardEffects == false) {
      MUI.options.standardEffects = true;
      if (link) {
        this.toggleStandardEffectsLink = new Element('div', {
          'class': 'check',
          'id': 'toggleStandardEffects_check'
        }).inject(link);
      }
    }
    else {
      MUI.options.standardEffects = false;
      if (this.toggleStandardEffectsLink) {
        this.toggleStandardEffectsLink.destroy();
      }
    }
  },
  /*
   
   The underlay is inserted directly under windows when they are being dragged or resized
   so that the cursor is not captured by iframes or other plugins (such as Flash)
   underneath the window.
   
   */
  underlayInitialize: function () {
    var windowUnderlay = new Element('div', {
      'id': 'windowUnderlay',
      'styles': {
        //'height': parent.getCoordinates().height,
        //'height': this.getCoordinates().height,

        'opacity': .01,
        'display': 'none'
      }
    }).inject(document.body);
  },
  setUnderlaySize: function () {
    //$('windowUnderlay').setStyle('height', parent.getCoordinates().height);
  }
});



/*
 
 function: fixPNG
 Bob Osola's PngFix for IE6.
 
 example:
 (begin code)
 <img src="xyz.png" alt="foo" width="10" height="20" onload="fixPNG(this)">
 (end)
 
 note:
 You must have the image height and width attributes specified in the markup.
 
 */

function fixPNG(myImage) {
  if (Browser.ie4 && document.body.filters) {
    var imgID = (myImage.id) ? "id='" + myImage.id + "' " : "";
    var imgClass = (myImage.className) ? "class='" + myImage.className + "' " : "";
    var imgTitle = (myImage.title) ? "title='" + myImage.title + "' " : "title='" + myImage.alt + "' ";
    var imgStyle = "display:inline-block;" + myImage.style.cssText;
    var strNewHTML = "<span " + imgID + imgClass + imgTitle
            + " style=\"" + "width:" + myImage.width
            + "px; height:" + myImage.height
            + "px;" + imgStyle + ";"
            + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
            + "(src=\'" + myImage.src + "\', sizingMethod='scale');\"></span>";
    myImage.outerHTML = strNewHTML;
  }
}

// Blur all windows if user clicks anywhere else on the page
document.addEvent('mousedown', function (event) {
  MUI.blurAll.delay(50);
});

window.addEvent('domready', function () {
  MUI.underlayInitialize();
});

window.addEvent('resize', function () {
  if ($('windowUnderlay')) {
    MUI.setUnderlaySize();
  }
  else {
    MUI.underlayInitialize();
  }
});

Element.implement({
  hide: function () {
    this.setStyle('display', 'none');
    return this;
  },
  show: function () {
    this.setStyle('display', 'block');
    return this;
  }
});

/*
 
 Shake effect by Uvumi Tools
 http://tools.uvumi.com/element-shake.html
 
 Function: shake
 
 Example:
 Shake a window.
 (start code)
 $('parametrics').shake()
 (end)
 
 */

Element.implement({
  shake: function (radius, duration) {
    radius = radius || 3;
    duration = duration || 500;
    duration = (duration / 50).toInt() - 1;
    var parent = this.getParent();
    if (parent != $(document.body) && parent.getStyle('position') == 'static') {
      parent.setStyle('position', 'relative');
    }
    var position = this.getStyle('position');
    if (position == 'static') {
      this.setStyle('position', 'relative');
      position = 'relative';
    }
    if (Browser.ie) {
      parent.setStyle('height', parent.getStyle('height'));
    }
    var coords = this.getPosition(parent);
    if (position == 'relative' && !Browser.opera) {
      coords.x -= parent.getStyle('paddingLeft').toInt();
      coords.y -= parent.getStyle('paddingTop').toInt();
    }
    var morph = this.retrieve('morph');
    if (morph) {
      morph.cancel();
      var oldOptions = morph.options;
    }
    var morph = this.get('morph', {
      duration: 50,
      link: 'chain'
    });
    for (var i = 0; i < duration; i++) {
      morph.start({
        /** 1.2
         top:coords.y+$random(-radius,radius),
         left:coords.x+$random(-radius,radius)
         */
        top: coords.y + Number.random(-radius, radius),
        left: coords.x + Number.random(-radius, radius)

      });
    }
    morph.start({
      top: coords.y,
      left: coords.x
    }).chain(function () {
      if (oldOptions) {
        this.set('morph', oldOptions);
      }
    }.bind(this));
    return this;
  }
});

String.implement({
  parseQueryString: function () {
    var vars = this.split(/[&;]/);
    var rs = {};
    if (vars.length)
      vars.each(function (val) {
        var keys = val.split('=');
        if (keys.length && keys.length == 2)
          rs[decodeURIComponent(keys[0])] = decodeURIComponent(keys[1]);
      });
    return rs;
  }

});

// Mootools Patch: Fixes issues in Safari, Chrome, and Internet Explorer caused by processing text as XML.
Request.HTML.implement({
  processHTML: function (text) {
    var match = text.match(/<body[^>]*>([\s\S]*?)<\/body>/i);
    text = (match) ? match[1] : text;
    var container = new Element('div');
    return container.set('html', text);
  }

});

/*
 
 Examples:
 (start code)
 getCSSRule('.myRule');
 getCSSRule('#myRule');
 (end)
 Nota: Alexis: Correción realizada debido a un error
 ReferenceError: assignment to undeclared variable i
 */
MUI.getCSSRule = function (selector) {
  for (var ii = 0; ii < document.styleSheets.length; ii++) {
    var mysheet = document.styleSheets[ii];
    var myrules = mysheet.cssRules ? mysheet.cssRules : mysheet.rules;
    for (var i = 0; i < myrules.length; i++) {
      if ((myrules[i].selectorText) && (myrules[i].selectorText == selector)) {
        return(myrules[i]);
      }
    }
  }
  return(false);
}

// This makes it so Request will work to some degree locally
if (location.protocol == "file:") {

  Request.implement({
    isSuccess: function (status) {
      return (status == 0 || (status >= 200) && (status < 300));
    }
  });

  Browser.Request = function () {
    /** 1.2 return $try(function(){ */
    return Function.attempt(function () {
      return new ActiveXObject('MSXML2.XMLHTTP');
    }, function () {
      return new XMLHttpRequest();
    });
  };

}


/** 1.2 $extend(Asset, { */
try {
  Object.append(Asset, {
    /* Fix an Opera bug in Mootools 1.2 */
    javascript: function (source, properties) {
      /** 1.2
       properties = $extend({
       //onload: $empty,
       document: document,
       check: $lambda(true)
       }, properties);
       **/
      properties = Object.append({
        onload: function () {
        },
        document: document,
        check: Function.from(true)
      }, properties);


      if ($(properties.id)) {
        properties.onload();
        return $(properties.id);
      }

      var script = new Element('script', {'src': source, 'type': 'text/javascript'});

      var load = properties.onload.bind(script), check = properties.check, doc = properties.document;
      delete properties.onload;
      delete properties.check;
      delete properties.document;

      /**  1.2 if (!Browser.firefox419 && !Browser.opera){ */
      if (!Browser.chrome && !Browser.opera) {
        script.addEvents({
          load: load,
          readystatechange: function () {
            if (Browser.ie && ['loaded', 'complete'].contains(this.readyState))
              load();
          }
        }).setProperties(properties);
      }
      else {
        var checker = (function () {
          /** 1.2 if (!$try(check)) return; **/
          if (!Function.attempt(check))
            return;

          /** 1.2 $clear(checker); */
          clearInterval(checker);
          // Opera has difficulty with multiple scripts being injected into the head simultaneously. We need to give it time to catch up.
          Browser.opera ? load.delay(500) : load();
        }).periodical(50);
      }
      return script.inject(doc.head);
    },
    // Get the CSS with XHR before appending it to document.head so that we can have an onload callback.
    css: function (source, properties) {
      /** 1.2
       properties = $extend({
       id: null,
       media: 'screen',
       //onload: $empty
       }, properties);
       **/
      properties = Object.append({
        id: null,
        media: 'screen',
        onload: function () {
        }
      }, properties);



      new Request({
        method: 'get',
        url: source,
        onComplete: function (response) {
          var newSheet = new Element('link', {
            'id': properties.id,
            'rel': 'stylesheet',
            'media': properties.media,
            'type': 'text/css',
            'href': source
          }).inject(document.head);
          properties.onload();
        }.bind(this),
        onFailure: function (response) {
        },
        onSuccess: function () {
        }.bind(this)
      }).send();
    }

  });
} catch (error) {
}

/*
 
 REGISTER PLUGINS
 
 Register Components and Plugins for Lazy Loading
 
 How this works may take a moment to grasp. Take a look at MUI.Window below.
 If we try to create a new Window and Window.js has not been loaded then the function
 below will run. It will load the CSS required by the MUI.Window Class and then
 then it will load Window.js. Here is the interesting part. When Window.js loads,
 it will overwrite the function below, and new MUI.Window(arg) will be ran
 again. This time it will create a new MUI.Window instance, and any future calls
 to new MUI.Window(arg) will immediately create new windows since the assets
 have already been loaded and our temporary function below has been overwritten.
 
 REGISTRO PLUGINS
 
   Registro Componentes y Plugins para Lazy Loading
 
   ¿Cómo funciona este pueden tomar un momento de captar. Echa un vistazo a MUI.Window continuación.
   Si tratamos de crear una nueva ventana y Window.js no se ha cargado entonces la función
   a continuación se ejecutará. Se carga el CSS requerida por la Clase MUI.Window y luego
   a continuación, se carga Window.js. Aquí está la parte interesante. Cuando cargas Window.js,
   sobrescribirá la función a continuación, y nueva MUI.Window (arg) se corrió
   de nuevo. Esta vez va a crear una nueva instancia MUI.Window, y cualquier llamada futura
   a la nueva MUI.Window (arg) creará inmediatamente nuevas ventanas ya los activos
   ya se han cargado y nuestra función temporal continuación se ha sobrescrito.
 
 
 
 Example:
 
 MyPlugins.extend({
 
 MyGadget: function(arg){
 new MUI.Require({
 css: [MUI.path.plugins + 'myGadget/css/style.css'],
 images: [MUI.path.plugins + 'myGadget/images/background.gif']
 js: [MUI.path.plugins + 'myGadget/scripts/myGadget.js'],
 onload: function(){
 new MyPlguins.MyGadget(arg);
 }
 });
 }
 
 });
 
 -------------------------------------------------------------------- */

//MUI.extend({

Object.append(MUI, {
  newWindowsFromJSON: function (arg) {
    new MUI.Require({
      js: [MUI.path.source + 'Window/Windows-from-json.js'],
      onload: function () {
        new MUI.newWindowsFromJSON(arg);
      }
    });
  },
  arrangeCascade: function () {
    new MUI.Require({
      js: [MUI.path.source + 'Window/Arrange-cascade.js'],
      onload: function () {
        new MUI.arrangeCascade();
      }
    });
  },
  arrangeTile: function () {
    new MUI.Require({
      js: [MUI.path.source + 'Window/Arrange-tile.js'],
      onload: function () {
        new MUI.arrangeTile();
      }
    });
  },
  saveWorkspace: function () {
    new MUI.Require({
      js: [MUI.path.source + 'Layout/Workspaces.js'],
      onload: function () {
        new MUI.saveWorkspace();
      }
    });
  },
  loadWorkspace: function () {
    new MUI.Require({
      js: [MUI.path.source + 'Layout/Workspaces.js'],
      onload: function () {
        new MUI.loadWorkspace();
      }
    });
  },
  Themes: {
    init: function (arg) {
      new MUI.Require({
        js: [MUI.path.source + 'Utilities/Themes.js'],
        onload: function () {
          MUI.Themes.init(arg);
        }
      });
    }
  }

});






Object.append(MUI.options, {
  // Naming options:
  // If you change the IDs of the Insside Desktop containers in your HTML, you need to change them here as well.
  dockWrapper: 'dockWrapper',
  dock: 'dock'
});





/** Layout.js **/

/*
 arguments:
 column - The column to resize the panels in
 changing -  The panel that is collapsing, expanding, or new
 action - collapsing, expanding, or new
 
 */


function addResizeRight(element, min, max) {
  if (!$(element))
    return;
  element = $(element);
  /** 1.2 @todo */
  var instances = MUI.Columns.instances;
  var instance = instances.get(element.id);

  var handle = element.getNext('.columnHandle');
  handle.setStyle('cursor', Browser.firefox ? 'col-resize' : 'e-resize');
  if (!min)
    min = 50;
  if (!max)
    max = 250;
  if (Browser.ie) {
    handle.addEvents({
      'mousedown': function() {
        handle.setCapture();
      },
      'mouseup': function() {
        handle.releaseCapture();
      }
    });
  }
  /*** IEWIN8**/
  try {
    instance.resize = element.makeResizable({
      handle: handle,
      modifiers: {
        x: 'width',
        y: false
      },
      limit: {
        x: [min, max]
      },
      onStart: function() {
        element.getElements('iframe').setStyle('visibility', 'hidden');
        element.getNext('.column').getElements('iframe').setStyle('visibility', 'hidden');
      }.bind(this),
      onDrag: function() {
        if (Browser.firefox) {
          $$('.panel').each(function(panel) {
            if (panel.getElements('.inssideIframe').length == 0) {
              panel.hide(); // Fix for a rendering bug in FF
            }
          });
        }
        MUI.remainingWidth(element.getParent());
        if (Browser.firefox) {
          $$('.panel').show(); // Fix for a rendering bug in FF
        }
        if (Browser.ie4) {
          element.getChildren().each(function(el) {
            var width = $(element).getStyle('width').toInt();
            width -= el.getStyle('border-right').toInt();
            width -= el.getStyle('border-left').toInt();
            width -= el.getStyle('padding-right').toInt();
            width -= el.getStyle('padding-left').toInt();
            el.setStyle('width', width);
          }.bind(this));
        }
      }.bind(this),
      onComplete: function() {
        MUI.remainingWidth(element.getParent());
        element.getElements('iframe').setStyle('visibility', 'visible');
        element.getNext('.column').getElements('iframe').setStyle('visibility', 'visible');
        instance.fireEvent('onResize');
      }.bind(this)
    });
  } catch (error) {
  }
}

function addResizeLeft(element, min, max) {
  if (!$(element))
    return;
  element = $(element);
  /** 1.2 @todo */
  var instances = MUI.Columns.instances;
  var instance = instances.get(element.id);

  var handle = element.getPrevious('.columnHandle');
  handle.setStyle('cursor', Browser.firefox ? 'col-resize' : 'e-resize');
  var partner = element.getPrevious('.column');
  if (!min)
    min = 50;
  if (!max)
    max = 250;
  if (Browser.ie) {
    handle.addEvents({
      'mousedown': function() {
        handle.setCapture();
      },
      'mouseup': function() {
        handle.releaseCapture();
      }
    });
  }
  /** IEWIN8**/
  try {
    instance.resize = element.makeResizable({
      handle: handle,
      modifiers: {x: 'width', y: false},
      invert: true,
      limit: {x: [min, max]},
      onStart: function() {
        $(element).getElements('iframe').setStyle('visibility', 'hidden');
        partner.getElements('iframe').setStyle('visibility', 'hidden');
      }.bind(this),
      onDrag: function() {
        MUI.remainingWidth(element.getParent());
      }.bind(this),
      onComplete: function() {
        MUI.remainingWidth(element.getParent());
        $(element).getElements('iframe').setStyle('visibility', 'visible');
        partner.getElements('iframe').setStyle('visibility', 'visible');
        instance.fireEvent('onResize');
      }.bind(this)
    });
  } catch (error) {
  }
}

function addResizeBottom(element) {
  if (!$(element))
    return;
  var element = $(element);
  /** 1.2 @todo */
  var instances = MUI.Panels.instances;
  var instance = instances.get(element.id);
  var handle = instance.handleEl;
  handle.setStyle('cursor', Browser.firefox ? 'row-resize' : 'n-resize');
  var partner = instance.partner;
  var min = 0;
  var max = function() {
    return element.getStyle('height').toInt() + partner.getStyle('height').toInt();
  }.bind(this);

  if (Browser.ie) {
    handle.addEvents({
      'mousedown': function() {
        handle.setCapture();
      },
      'mouseup': function() {
        handle.releaseCapture();
      }
    });
  }
  try {
    instance.resize = element.makeResizable({
      handle: handle,
      modifiers: {x: false, y: 'height'},
      limit: {y: [min, max]},
      invert: false,
      onBeforeStart: function() {
        partner = instance.partner;
        this.originalHeight = element.getStyle('height').toInt();
        this.partnerOriginalHeight = partner.getStyle('height').toInt();
      }.bind(this),
      onStart: function() {
        if (instance.iframeEl) {
          if (!Browser.ie) {
            instance.iframeEl.setStyle('visibility', 'hidden');
            partner.getElements('iframe').setStyle('visibility', 'hidden');
          }
          else {
            instance.iframeEl.hide();
            partner.getElements('iframe').hide();
          }
        }

      }.bind(this),
      onDrag: function() {
        partnerHeight = partnerOriginalHeight;
        partnerHeight += (this.originalHeight - element.getStyle('height').toInt());
        partner.setStyle('height', partnerHeight);
        MUI.resizeChildren(element, element.getStyle('height').toInt());
        MUI.resizeChildren(partner, partnerHeight);
        element.getChildren('.column').each(function(column) {
          MUI.panelHeight(column);
        });
        partner.getChildren('.column').each(function(column) {
          MUI.panelHeight(column);
        });
      }.bind(this),
      onComplete: function() {
        partnerHeight = partnerOriginalHeight;
        partnerHeight += (this.originalHeight - element.getStyle('height').toInt());
        partner.setStyle('height', partnerHeight);
        MUI.resizeChildren(element, element.getStyle('height').toInt());
        MUI.resizeChildren(partner, partnerHeight);
        element.getChildren('.column').each(function(column) {
          MUI.panelHeight(column);
        });
        partner.getChildren('.column').each(function(column) {
          MUI.panelHeight(column);
        });
        if (instance.iframeEl) {
          if (!Browser.ie) {
            instance.iframeEl.setStyle('visibility', 'visible');
            partner.getElements('iframe').setStyle('visibility', 'visible');
          }
          else {
            instance.iframeEl.show();
            partner.getElements('iframe').show();
            // The following hack is to get IE8 Standards Mode to properly resize an iframe
            // when only the vertical dimension is changed.
            var width = instance.iframeEl.getStyle('width').toInt();
            instance.iframeEl.setStyle('width', width - 1);
            MUI.remainingWidth();
            instance.iframeEl.setStyle('width', width);
          }
        }
        instance.fireEvent('onResize');
      }.bind(this)
    });
  } catch (error) {
  }
}
<?php require_once("Windows.js");?>
<?php require_once("Workspaces.js");?>
<?php require_once("ArrangeTile.js");?>
<?php require_once("ArrangeCascade.js");?>



document.addEvent('keydown', function (event) {
  if (event.key == 'q' && event.control && event.alt) {
    MUI.toggleWindowVisibility();
  }
});



/**
 * Este componente permite  en un solo elemento generalmente conformado por un panel, cargar multiples
 * datos html mediante la invocacion de un actualizador de contenidos (updateContent) cada carga de datos
 * esta asociada a un vinculo activo en el encabezado. Como componente grafico esta previsto
 * para visualizarse en la barra de herramientas de un componente tipo ventana o en la parte superior de 
 * un panel. La creacion grafica del objeto corresponde a un elemento tipo UL cuya apariencia se controla 
 * mediante CSS con las clases "toolbarTabs" y "tab-menu" , las urls cargadas al accionar los vinculos son 
 * tomadas textualmente de los vinculos contenidos en los LI de la lista, la instruccion de inicializacion 
 * InssideUI.initializeTabs('tabs', 'content'); hace referencia a la identidad del objeto que se controlara "tabs" 
 * y la identidad del objeto que recibira las actualizaciones "content".
 * @param {type} param1
 * @param {type} param2
 */
Object.append(InssideUI, {
  initializeTabs: function(el, target) {
    $(el).getElements('li').each(function(listitem) {
      var link = listitem.getFirst('a').addEvent('click', function(e) {
        e.preventDefault();
      });
      listitem.addEvent('click', function(e) {
        var wcw = $(target).id + "_contentWrapper";
        var wc = $(target).id + "_content";
        var cargador = new Spinner($(wcw), {message: '...Procesando...'});
        if ($(wc) && MUI.options.standardEffects == true) {
          $(wc).setStyle('opacity', 1).get('morph').start({'opacity': 0});
        }
        cargador.show();
        InssideUI.updateContent({
          'element': $(target),
          'loadMethod': 'xhr',
          'url': link.get('href'),
          'require': {
            onload: function() {
            }
          }, onContentLoaded: function() {
            cargador.hide();
            if ($(wc) && MUI.options.standardEffects == true) {
              $(wc).setStyle('opacity', 0).get('morph').start({'opacity': 1});
            }
          }
        });
        InssideUI.selected(this, el);
      });
    });
  },
  selected: function(el, parent) {
    $(parent).getChildren().each(function(listitem) {
      listitem.removeClass('selected');
    });
    el.addClass('selected');
  }
});





