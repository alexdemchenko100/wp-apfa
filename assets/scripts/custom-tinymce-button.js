/* eslint-disable no-undef */
(function () {
  tinymce.PluginManager.add('yellow_button', function(editor, url) {
      editor.addButton('yellow_button', {
          icon: false,
          text: 'Yellow Button',
          onclick: function (e) {
              editor.windowManager.open( {
                  title: 'Button',
                  body: [{
                      type: 'textbox',
                      name: 'url',
                      label: 'URL',
                  },
                  {
                      type: 'textbox',
                      name: 'link',
                      label: 'Link Text',
                  }],
                  onsubmit: function( e ) {
                      // wrap it with a div and give it a class name
                      var content = '<a class="btn-fill-yellow tinymce-yellow-button" href="' + e.data.url + '" target="_self">' +
                        '<span>' + e.data.link + '</span>' +
                        '</a>';
                      editor.insertContent(content);
                  },
              });
          },
      });
  });
})();